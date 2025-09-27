<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
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

Route::get('/', function () {
    return view('welcome');
});

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
});

require __DIR__.'/auth.php';
