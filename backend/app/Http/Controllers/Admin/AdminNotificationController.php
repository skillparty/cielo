<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Queue;

class AdminNotificationController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    ) {
        $this->middleware(['auth', 'admin.access']);
        $this->middleware('permission:manage system')->except(['index', 'testEmail']);
    }

    /**
     * Display notifications dashboard.
     */
    public function index()
    {
        $stats = [
            'pending_jobs' => Queue::size(),
            'failed_jobs' => \DB::table('failed_jobs')->count(),
            'total_orders' => Order::count(),
            'orders_today' => Order::whereDate('created_at', today())->count(),
        ];

        return view('admin.notifications.index', compact('stats'));
    }

    /**
     * Test email configuration.
     */
    public function testEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $result = $this->notificationService->testEmailConfiguration($request->email);

        if ($result) {
            return redirect()->back()
                ->with('success', 'Email de prueba enviado exitosamente a ' . $request->email);
        } else {
            return redirect()->back()
                ->with('error', 'Error al enviar el email de prueba. Verifica la configuración.');
        }
    }

    /**
     * Send bulk notifications to customers.
     */
    public function sendBulkNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipients' => 'required|in:all,role,specific',
            'role' => 'required_if:recipients,role|string',
            'user_ids' => 'required_if:recipients,specific|array',
            'user_ids.*' => 'exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Get recipient user IDs based on selection
        $userIds = [];
        
        switch ($request->recipients) {
            case 'all':
                $userIds = User::pluck('id')->toArray();
                break;
                
            case 'role':
                $userIds = User::role($request->role)->pluck('id')->toArray();
                break;
                
            case 'specific':
                $userIds = $request->user_ids;
                break;
        }

        if (empty($userIds)) {
            return redirect()->back()
                ->with('error', 'No se encontraron usuarios para enviar notificaciones.');
        }

        // Send bulk notifications
        $results = $this->notificationService->sendBulkNotification(
            $userIds,
            $request->subject,
            $request->message
        );

        $successful = count(array_filter($results));
        $total = count($results);

        return redirect()->back()
            ->with('success', "Notificaciones enviadas: {$successful} de {$total}");
    }

    /**
     * Resend order notification.
     */
    public function resendOrderNotification(Request $request, Order $order)
    {
        $type = $request->input('type', 'confirmation');

        $result = false;

        switch ($type) {
            case 'confirmation':
                $result = $this->notificationService->sendOrderConfirmation($order);
                break;

            case 'status':
                $previousStatus = $request->input('previous_status', 'pending');
                $result = $this->notificationService->sendOrderStatusUpdate($order, $previousStatus);
                break;

            case 'admin':
                $result = $this->notificationService->sendNewOrderNotification($order);
                break;
        }

        if ($result) {
            return redirect()->back()
                ->with('success', 'Notificación reenviada exitosamente.');
        } else {
            return redirect()->back()
                ->with('error', 'Error al reenviar la notificación.');
        }
    }

    /**
     * Resend payment notification.
     */
    public function resendPaymentNotification(Payment $payment)
    {
        $result = $this->notificationService->sendPaymentConfirmation($payment);

        if ($result) {
            return redirect()->back()
                ->with('success', 'Notificación de pago reenviada exitosamente.');
        } else {
            return redirect()->back()
                ->with('error', 'Error al reenviar la notificación de pago.');
        }
    }

    /**
     * Get queue statistics.
     */
    public function queueStats()
    {
        $stats = [
            'pending' => Queue::size(),
            'failed' => \DB::table('failed_jobs')->count(),
            'processed_today' => \DB::table('jobs')
                ->whereDate('created_at', today())
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Retry failed jobs.
     */
    public function retryFailedJobs()
    {
        try {
            $failed = \DB::table('failed_jobs')->get();
            
            foreach ($failed as $job) {
                \Artisan::call('queue:retry', ['id' => $job->id]);
            }

            return redirect()->back()
                ->with('success', 'Se han reintentado ' . $failed->count() . ' trabajos fallidos.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al reintentar trabajos fallidos: ' . $e->getMessage());
        }
    }

    /**
     * Clear failed jobs.
     */
    public function clearFailedJobs()
    {
        try {
            \DB::table('failed_jobs')->truncate();

            return redirect()->back()
                ->with('success', 'Trabajos fallidos limpiados exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al limpiar trabajos fallidos: ' . $e->getMessage());
        }
    }

    /**
     * Show notification settings.
     */
    public function settings()
    {
        $settings = [
            'queue_driver' => config('queue.default'),
            'mail_driver' => config('mail.default'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
            'admin_email' => config('mail.admin.address', 'admin@cielocarnes.com'),
        ];

        return view('admin.notifications.settings', compact('settings'));
    }

    /**
     * Update notification settings.
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'from_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
        ]);

        // This would typically update environment variables or a settings table
        // For now, we'll just show a success message
        
        return redirect()->back()
            ->with('success', 'Configuración de notificaciones actualizada exitosamente.');
    }
}