<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KerajangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AlamatUserController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\MediaSosialController;
use App\Http\Middleware\EnsureAuthDataKeranjang;
use App\Http\Controllers\PesananDikirimController;
use App\Http\Controllers\PesananDiterimaController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});


Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('home')->with('success', 'berhasil logout');
})->name('logout');

Route::get('/', [indexController::class, 'index'])->name('home');
Route::get('kontak', [indexController::class, 'kontak'])->name('kontak');
Route::get('produk', [indexController::class, 'produk'])->name('produk');
Route::post('/pesan-kontak', [indexController::class, 'store'])->name('pesan-kontak.store');
Route::get('produk/{kategori}', [indexController::class, 'kategori'])->name('produk.kategori');
Route::get('detail-produk/{produk}', [ProdukController::class, 'show'])->name('product-details');

// raja ongkir
Route::get('/data-provinsi', [RajaOngkirController::class, 'getProvinsi'])->name('data.provinsi');
Route::get('/data-distrik', [RajaOngkirController::class, 'getDataDistrik'])->name('data.distrik');
Route::get('/data-ekspedisi', [RajaOngkirController::class, 'getDataEkspedisi'])->name('data.ekspedisi');
Route::post('/', [RajaOngkirController::class, 'getDataPaket'])->name('data.paket');

// Route::get('/cek-ongkir', [RajaOngkirController::class, 'index']);
// Route::post('/cek-ongkir', [RajaOngkirController::class, 'cekOngkir']);




Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::middleware(EnsureAuthDataKeranjang::class)->group(
        function () {

            // Route::get('keranjang', [KerajangController::class, 'index'])->name('kerajang.index');
            Route::get('checkout-keranjang', [KerajangController::class, 'checkout'])->name('keranjang.checkout');
            Route::resources([
                'keranjang' => KerajangController::class,
                // 'alamat' => AlamatUserController::class,
            ]);
        }
    );
    Route::resources([
        'alamat' => AlamatUserController::class,
    ]);
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
    Route::post('/cek-ongkir', [AdminController::class, 'cekOngkir']);
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('setting', [AdminController::class, 'setting'])->name('admin.setting');
    Route::post('setting', [AdminController::class, 'store'])->name('setting.store');
    Route::get('footer', [FooterController::class, 'index'])->name('footer.index');
    Route::post('footer', [FooterController::class, 'store'])->name('footer.store');
    Route::get('medsos', [MediaSosialController::class, 'index'])->name('medsos.index');
    Route::post('medsos', [MediaSosialController::class, 'store'])->name('medsos.store');
    Route::get('/pesanan/cari', [PesananController::class, 'show']);
    // Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');

    Route::resources([
        'kategori' => KategoriController::class,
        'produk' => ProdukController::class,
        'pesanan' => PesananController::class,
        'pesanan-dikirim' => PesananDikirimController::class,
        'transaksi' => TransaksiController::class,
        'kontak' => KontakController::class,
        'slider' => SliderController::class
    ]);
    Route::get('/tolak-pesanan', [PesananController::class, 'tolak'])->name('pesanan.tolak');
    Route::get('/terima-pesanan', [PesananController::class, 'terima'])->name('pesanan.terima');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'verified', 'role:User']], function () {
    Route::get('/pesanan/cari', [UserController::class, 'show']);
    Route::get('pesanan-saya/{order_id}', [UserController::class, 'show'])->name('pesanan-saya.show');
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('pesanan-saya', [UserController::class, 'index'])->name('pesanan-saya.index');
    Route::post('/terima-diterima', [PesananDiterimaController::class, 'store'])->name('pesanan.diterima');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/email/verify', function () {
//     // return view('auth.verif_adminkit');
//     $data['kerajangs'] = null;
//     return view('auth.verifyemail_onlineshop', $data);
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


require __DIR__ . '/auth.php';
