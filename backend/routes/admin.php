<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group.
|
*/

// Grupo de rutas admin con middleware de autenticación y autorización
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin.access'])->group(function () {
    
    // Dashboard principal
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Gestión de usuarios con permisos específicos
    Route::resource('users', UserController::class);
    Route::get('users/{user}/roles', [UserController::class, 'roles'])->name('users.roles');
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assign-role');
    Route::delete('users/{user}/revoke-role', [UserController::class, 'revokeRole'])->name('users.revoke-role');
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Gestión de productos
    Route::resource('products', ProductController::class);
    Route::delete('products/{product}/images/{media}', [ProductController::class, 'deleteImage'])
        ->name('products.delete-image');
    
    // Gestión de categorías
    Route::resource('categories', CategoryController::class);
    
    // Gestión de órdenes
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.update-status');
    
    // Gestión de recetas
    Route::resource('recipes', RecipeController::class);
    Route::delete('recipes/{recipe}/images/{media}', [RecipeController::class, 'deleteImage'])
        ->name('recipes.delete-image');
    
    // Gestión de combos
    // Route::resource('combos', ComboController::class);
    
    // Gestión de mensajes de contacto
    // Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    // Route::patch('contact-messages/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])
    //     ->name('contact-messages.update-status');
    
    // Gestión de FAQs
    // Route::resource('faqs', FaqController::class);
    
    // Gestión de contenido de empresa
    // Route::resource('company-content', CompanyContentController::class);
    
    // Reportes
    // Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    // Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    // Route::get('reports/products', [ReportController::class, 'products'])->name('reports.products');
    // Route::get('reports/users', [ReportController::class, 'users'])->name('reports.users');
    
    // Configuraciones del sistema
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminSettingsController::class, 'index'])->name('index');
        Route::put('/', [AdminSettingsController::class, 'update'])->name('update');
        
        Route::get('/payment', [AdminSettingsController::class, 'paymentMethods'])->name('payment');
        Route::put('/payment', [AdminSettingsController::class, 'updatePaymentMethods'])->name('payment.update');
        
        Route::get('/shipping', [AdminSettingsController::class, 'shipping'])->name('shipping');
        Route::put('/shipping', [AdminSettingsController::class, 'updateShipping'])->name('shipping.update');
        
        Route::post('/clear-cache', [AdminSettingsController::class, 'clearCache'])->name('clear-cache');
        Route::get('/export', [AdminSettingsController::class, 'exportConfig'])->name('export');
    });
    
    // Sistema de notificaciones
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [AdminNotificationController::class, 'index'])->name('index');
        Route::get('/settings', [AdminNotificationController::class, 'settings'])->name('settings');
        Route::put('/settings', [AdminNotificationController::class, 'updateSettings'])->name('settings.update');
        
        Route::post('/test-email', [AdminNotificationController::class, 'testEmail'])->name('test-email');
        Route::post('/bulk-send', [AdminNotificationController::class, 'sendBulkNotification'])->name('bulk-send');
        
        Route::post('/retry-failed', [AdminNotificationController::class, 'retryFailedJobs'])->name('retry-failed');
        Route::post('/clear-failed', [AdminNotificationController::class, 'clearFailedJobs'])->name('clear-failed');
        
        Route::get('/queue-stats', [AdminNotificationController::class, 'queueStats'])->name('queue-stats');
        
        Route::post('/orders/{order}/resend', [AdminNotificationController::class, 'resendOrderNotification'])->name('orders.resend');
        Route::post('/payments/{payment}/resend', [AdminNotificationController::class, 'resendPaymentNotification'])->name('payments.resend');
    });
    
    // Configuración del sistema
    // Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    // Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});