<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KerajangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Middleware\EnsureAuthDataKeranjang;
use App\Http\Controllers\PesananDikirimController;

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

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('home')->with('success', 'berhasil logout');
})->name('logout');

Route::get('/', [indexController::class, 'index'])->name('home');
Route::get('kontak', [indexController::class, 'kontak'])->name('kontak');
Route::get('produk', [indexController::class, 'produk'])->name('produk');
Route::get('produk/{kategori}', [indexController::class, 'kategori'])->name('produk.kategori');
Route::get('detail-produk/{produk}', [ProdukController::class, 'show'])->name('product-details');

Route::middleware(EnsureAuthDataKeranjang::class)->group(
    function () {

        // Route::get('keranjang', [KerajangController::class, 'index'])->name('kerajang.index');
        Route::get('checkout-keranjang', [KerajangController::class, 'checkout'])->name('keranjang.checkout');
        Route::resources([
            'keranjang' => KerajangController::class
        ]);
    }
);

Route::group(['middleware' => ['auth']], function () {

    // Route::resources([
    //     'keranjang' => KerajangController::class
    // ]);
    // Route::get('keranjang', [indexController::class, 'index'])->name('keranjang.index');

});



Route::get('/dashboard', function () {
    // return dd(implode('|',auth()->user()->getRoleNames()->toArray()));
    if (auth()->user()->hasRole('Admin')) {
        // return redirect()->route('admin.dashboard');
        return redirect()->route('home')->with('success', 'Berhasil Login Dan Silakan Berbelanja');
    }
    if (auth()->user()->hasRole('User')) {
        return redirect()->route('home')->with('success', 'Berhasil Login Dan Silakan Berbelanja');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'role:Admin']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resources([
        'kategori' => KategoriController::class,
        'produk' => ProdukController::class,
        'pesanan' => PesananController::class,
        'pesanan-dikirim' => PesananDikirimController::class,
        'transaksi' => TransaksiController::class
    ]);
    Route::get('/tolak-pesanan', [PesananController::class, 'tolak'])->name('pesanan.tolak');
    Route::get('/terima-pesanan', [PesananController::class, 'terima'])->name('pesanan.terima');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'verified', 'role:User']], function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('pesanan-saya', [UserController::class, 'pesanan_Saya'])->name('pesanan-saya');
    Route::get('pesanan-saya/{slug}', [UserController::class, 'show'])->name('pesanan-details');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
