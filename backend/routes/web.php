<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas públicas
Route::get('/nosotros', [AboutController::class, 'index'])->name('about.index');
Route::get('/recetario', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recetario/categoria/{category}', [RecipeController::class, 'category'])->name('recipes.category');
Route::get('/recetario/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::post('/recetario/{recipe}/combo', [RecipeController::class, 'addCombo'])->name('recipes.add-combo');

// Rutas de contacto
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

// Rutas de tienda
Route::get('/tienda', [ShopController::class, 'index'])->name('shop.index');
Route::get('/tienda/categoria/{category}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/tienda/producto/{product}', [ShopController::class, 'show'])->name('shop.show');

// Rutas de carrito
Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrito/agregar/{product}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/carrito/actualizar/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrito/eliminar/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/carrito/contar', [CartController::class, 'count'])->name('cart.count');

// Rutas de checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/exito', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de pedidos del usuario
    Route::get('/mis-pedidos', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pedido/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/pedido/{order}/cancelar', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/pedido/{order}/repetir', [OrderController::class, 'reorder'])->name('orders.reorder');
});

// Rutas de administración
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard administrativo
    Route::get('/dashboard', [AdminOrderController::class, 'dashboard'])->name('dashboard');
    
    // Gestión de pedidos
    Route::get('/pedidos', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/pedidos/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/pedidos/{order}/estado', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/pedidos/{order}/notas', [AdminOrderController::class, 'notes'])->name('orders.notes');
    
    // Gestión de pagos
    Route::post('/pedidos/pagos/{payment}/verificar', [AdminOrderController::class, 'verifyPayment'])->name('orders.verify-payment');
    Route::post('/pedidos/pagos/{payment}/reembolso', [AdminOrderController::class, 'processRefund'])->name('orders.process-refund');
    
    // Acciones en lote
    Route::post('/pedidos/lote', [AdminOrderController::class, 'bulkAction'])->name('orders.bulk-action');
    
    // Exportaciones
    Route::get('/pedidos/exportar', [AdminOrderController::class, 'export'])->name('orders.export');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
