<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class AdminSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin.access']);
        $this->middleware('permission:view settings')->only(['index']);
        $this->middleware('permission:edit settings')->only(['update']);
        $this->middleware('permission:manage payment methods')->only(['paymentMethods', 'updatePaymentMethods']);
        $this->middleware('permission:manage shipping')->only(['shipping', 'updateShipping']);
    }

    /**
     * Display general settings.
     */
    public function index()
    {
        $settings = $this->getSystemSettings();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:500',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string|max:500',
            'timezone' => 'required|string',
            'currency' => 'required|string|size:3',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'min_order_amount' => 'required|numeric|min:0',
            'max_order_amount' => 'required|numeric|min:0',
            'order_processing_time' => 'required|integer|min:1|max:72',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $settings = $request->only([
            'app_name', 'app_description', 'contact_phone', 'contact_email',
            'contact_address', 'timezone', 'currency', 'tax_rate',
            'min_order_amount', 'max_order_amount', 'order_processing_time'
        ]);

        $this->updateSystemSettings($settings);

        return redirect()->back()
            ->with('success', 'Configuración general actualizada exitosamente.');
    }

    /**
     * Display payment methods settings.
     */
    public function paymentMethods()
    {
        $paymentSettings = $this->getPaymentSettings();
        return view('admin.settings.payment', compact('paymentSettings'));
    }

    /**
     * Update payment methods settings.
     */
    public function updatePaymentMethods(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cash_on_delivery_enabled' => 'boolean',
            'card_payment_enabled' => 'boolean',
            'qr_payment_enabled' => 'boolean',
            'bank_transfer_enabled' => 'boolean',
            
            // Configuración de tarjeta
            'stripe_public_key' => 'nullable|string',
            'stripe_secret_key' => 'nullable|string',
            'paypal_client_id' => 'nullable|string',
            'paypal_client_secret' => 'nullable|string',
            
            // Configuración QR
            'qr_bank_name' => 'nullable|string|max:100',
            'qr_account_number' => 'nullable|string|max:50',
            'qr_account_holder' => 'nullable|string|max:100',
            'qr_verification_required' => 'boolean',
            
            // Configuración general
            'payment_timeout_minutes' => 'required|integer|min:5|max:1440',
            'auto_verification_enabled' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $paymentSettings = $request->all();
        $this->updatePaymentSettings($paymentSettings);

        return redirect()->back()
            ->with('success', 'Configuración de métodos de pago actualizada exitosamente.');
    }

    /**
     * Display shipping settings.
     */
    public function shipping()
    {
        $shippingSettings = $this->getShippingSettings();
        return view('admin.settings.shipping', compact('shippingSettings'));
    }

    /**
     * Update shipping settings.
     */
    public function updateShipping(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'free_shipping_threshold' => 'required|numeric|min:0',
            'standard_shipping_cost' => 'required|numeric|min:0',
            'express_shipping_cost' => 'required|numeric|min:0',
            'delivery_zones' => 'required|array',
            'delivery_zones.*.name' => 'required|string|max:100',
            'delivery_zones.*.cost' => 'required|numeric|min:0',
            'delivery_zones.*.estimated_time' => 'required|string|max:50',
            'max_delivery_distance' => 'required|numeric|min:1',
            'pickup_available' => 'boolean',
            'pickup_address' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $shippingSettings = $request->all();
        $this->updateShippingSettings($shippingSettings);

        return redirect()->back()
            ->with('success', 'Configuración de envíos actualizada exitosamente.');
    }

    /**
     * Clear application cache.
     */
    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');

            return redirect()->back()
                ->with('success', 'Caché del sistema limpiado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al limpiar el caché: ' . $e->getMessage());
        }
    }

    /**
     * Export system configuration.
     */
    public function exportConfig()
    {
        $config = [
            'general' => $this->getSystemSettings(),
            'payment' => $this->getPaymentSettings(),
            'shipping' => $this->getShippingSettings(),
            'exported_at' => now()->toISOString(),
        ];

        $filename = 'system_config_' . now()->format('Y-m-d_H-i-s') . '.json';

        return response()->json($config)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Content-Type', 'application/json');
    }

    /**
     * Get system settings from cache or defaults.
     */
    private function getSystemSettings(): array
    {
        return Cache::remember('system_settings', 3600, function () {
            return [
                'app_name' => config('app.name', 'Cielo Carnes'),
                'app_description' => 'Carnes premium y productos gourmet',
                'contact_phone' => '+591 70000000',
                'contact_email' => 'contacto@cielocarnes.com',
                'contact_address' => 'La Paz, Bolivia',
                'timezone' => config('app.timezone', 'America/La_Paz'),
                'currency' => 'BOB',
                'tax_rate' => 13.0,
                'min_order_amount' => 50.0,
                'max_order_amount' => 5000.0,
                'order_processing_time' => 24,
            ];
        });
    }

    /**
     * Get payment settings from cache or defaults.
     */
    private function getPaymentSettings(): array
    {
        return Cache::remember('payment_settings', 3600, function () {
            return [
                'cash_on_delivery_enabled' => true,
                'card_payment_enabled' => true,
                'qr_payment_enabled' => true,
                'bank_transfer_enabled' => false,
                
                'stripe_public_key' => config('services.stripe.key'),
                'stripe_secret_key' => config('services.stripe.secret'),
                'paypal_client_id' => config('services.paypal.client_id'),
                'paypal_client_secret' => config('services.paypal.client_secret'),
                
                'qr_bank_name' => 'Banco Unión',
                'qr_account_number' => '1234567890',
                'qr_account_holder' => 'Cielo Carnes SRL',
                'qr_verification_required' => true,
                
                'payment_timeout_minutes' => 60,
                'auto_verification_enabled' => false,
            ];
        });
    }

    /**
     * Get shipping settings from cache or defaults.
     */
    private function getShippingSettings(): array
    {
        return Cache::remember('shipping_settings', 3600, function () {
            return [
                'free_shipping_threshold' => 200.0,
                'standard_shipping_cost' => 15.0,
                'express_shipping_cost' => 30.0,
                'delivery_zones' => [
                    ['name' => 'Zona Sur', 'cost' => 15.0, 'estimated_time' => '2-4 horas'],
                    ['name' => 'Zona Norte', 'cost' => 20.0, 'estimated_time' => '3-5 horas'],
                    ['name' => 'El Alto', 'cost' => 25.0, 'estimated_time' => '4-6 horas'],
                ],
                'max_delivery_distance' => 30,
                'pickup_available' => true,
                'pickup_address' => 'Av. Principal 123, La Paz',
            ];
        });
    }

    /**
     * Update and cache system settings.
     */
    private function updateSystemSettings(array $settings): void
    {
        Cache::put('system_settings', $settings, 3600);
        
        // Opcionalmente, guardar en base de datos
        // Setting::updateOrCreate(['key' => 'system'], ['value' => json_encode($settings)]);
    }

    /**
     * Update and cache payment settings.
     */
    private function updatePaymentSettings(array $settings): void
    {
        Cache::put('payment_settings', $settings, 3600);
        
        // Opcionalmente, guardar en base de datos
        // Setting::updateOrCreate(['key' => 'payment'], ['value' => json_encode($settings)]);
    }

    /**
     * Update and cache shipping settings.
     */
    private function updateShippingSettings(array $settings): void
    {
        Cache::put('shipping_settings', $settings, 3600);
        
        // Opcionalmente, guardar en base de datos
        // Setting::updateOrCreate(['key' => 'shipping'], ['value' => json_encode($settings)]);
    }
}