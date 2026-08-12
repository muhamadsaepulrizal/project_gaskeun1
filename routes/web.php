<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\RolePermissionController;
use App\Http\Controllers\SuperAdmin\ActivityLogController;

// Disperindag Controllers
use App\Http\Controllers\Disperindag\KecamatanController;
use App\Http\Controllers\Disperindag\DesaController;
use App\Http\Controllers\Disperindag\KkController;
use App\Http\Controllers\Disperindag\PendudukController;
use App\Http\Controllers\Disperindag\NelayanController;
use App\Http\Controllers\Disperindag\PetaniController;
use App\Http\Controllers\Disperindag\UmkmController;
use App\Http\Controllers\Disperindag\RumahTanggaSasaranController;
use App\Http\Controllers\DisperindagKeluhanController;

// Transaction Controllers
use App\Http\Controllers\AgenController;
use App\Http\Controllers\PangkalanController;

// Dashboard Controllers
use App\Http\Controllers\Dashboard\PimpinanDaerahController;
use App\Http\Controllers\Dashboard\HiswanaMigasController;
use App\Http\Controllers\Dashboard\DisperindagController;

// Public Controllers
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PublicKeluhanController;


use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Bebas, Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post')->middleware('guest');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Protected Public Routes (Wajib Login NIK)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Publik|Super Admin'])->group(function () {
    // Keluhan
    Route::get('/keluhan', [PublicKeluhanController::class, 'create'])->name('public.keluhan.create');
    Route::post('/keluhan', [PublicKeluhanController::class, 'store'])->name('public.keluhan.store');

    // Peta & Heatmap
    Route::get('/peta', [PublicController::class, 'peta'])->name('public.peta');
    Route::get('/heatmap', [PublicController::class, 'heatmap'])->name('public.heatmap');
    
    // Publik Beranda
    Route::get('/publik/beranda', function () {
        return view('welcome');
    })->name('publik.beranda');
});


/*
|--------------------------------------------------------------------------
| Login Redirect / Dashboard Gateway
|--------------------------------------------------------------------------
| Mengarahkan (redirect) user yang baru login atau mengakses /dashboard
| ke halaman spesifik sesuai dengan role masing-masing menggunakan Spatie.
*/
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->hasRole('Super Admin')) {
        return redirect()->route('superadmin.dashboard');
    } elseif ($user->hasRole('Pimpinan Daerah')) {
        return redirect()->route('pimpinan.dashboard');
    } elseif ($user->hasRole('Hiswana Migas')) {
        return redirect()->route('hiswana.dashboard');
    } elseif ($user->hasRole('Disperindag')) {
        return redirect()->route('disperindag.dashboard');
    } elseif ($user->hasRole('Agen LPG')) {
        return redirect()->route('agen.dashboard');
    } elseif ($user->hasRole('Pangkalan LPG')) {
        return redirect()->route('pangkalan.dashboard');
    } elseif ($user->hasRole('Publik')) {
        return redirect()->route('publik.beranda');
    }
    
    // Fallback jika tidak memiliki role (atau tambahkan abort 403)
    return redirect('/');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| Actor Specific Routes (Diisolasi dengan Spatie Role Middleware)
|--------------------------------------------------------------------------
*/

// 1. Super Admin
Route::middleware(['auth', 'role:Super Admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    
    Route::get('roles', [RolePermissionController::class, 'index'])->name('roles.index');
    Route::post('roles', [RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::post('permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::post('roles/{role}/permissions', [RolePermissionController::class, 'assignPermission'])->name('roles.assign-permissions');
    
    Route::get('logs', [ActivityLogController::class, 'index'])->name('logs.index');
});

// 2. Disperindag
Route::middleware(['auth', 'role:Disperindag'])->prefix('disperindag')->name('disperindag.')->group(function () {
    Route::get('dashboard', [DisperindagController::class, 'index'])->name('dashboard');
    
    // Master Data Manajemen RTS, dll
    Route::resource('kecamatans', KecamatanController::class)->except(['show']);
    Route::resource('desas', DesaController::class)->except(['show']);
    Route::resource('kks', KkController::class)->except(['show']);
    Route::resource('penduduks', PendudukController::class)->except(['show']);
    Route::resource('nelayans', NelayanController::class)->except(['show']);
    Route::resource('petanis', PetaniController::class)->except(['show']);
    Route::resource('umkms', UmkmController::class)->except(['show']);
    Route::resource('rts', RumahTanggaSasaranController::class)->except(['show']);
    
    // Keluhan Management & Verifikasi
    Route::get('keluhan', [DisperindagKeluhanController::class, 'index'])->name('keluhan.index');
    Route::put('keluhan/{keluhan}', [DisperindagKeluhanController::class, 'update'])->name('keluhan.update');
});

// 3. Agen LPG
Route::middleware(['auth', 'role:Agen LPG'])->prefix('agen')->name('agen.')->group(function () {
    Route::get('dashboard', [AgenController::class, 'dashboard'])->name('dashboard');
    Route::get('profil', [AgenController::class, 'profil'])->name('profil');
    Route::put('profil', [AgenController::class, 'updateProfil'])->name('profil.update');
    
    // Transaksi Pengiriman
    Route::get('pengiriman/create', [AgenController::class, 'pengirimanCreate'])->name('pengiriman.create');
    Route::post('pengiriman', [AgenController::class, 'pengirimanStore'])->name('pengiriman.store');
    Route::post('pengiriman/import', [AgenController::class, 'pengirimanImport'])->name('pengiriman.import');
    Route::get('pengiriman/status', [AgenController::class, 'pengirimanStatus'])->name('pengiriman.status');
});

// 4. Pangkalan LPG
Route::middleware(['auth', 'role:Pangkalan LPG'])->prefix('pangkalan')->name('pangkalan.')->group(function () {
    Route::get('dashboard', [PangkalanController::class, 'dashboard'])->name('dashboard');
    // Penerimaan LPG
    Route::get('pengiriman', [PangkalanController::class, 'terimaPengiriman'])->name('pengiriman.index');
    Route::post('pengiriman/{pengiriman}/konfirmasi', [PangkalanController::class, 'konfirmasiPenerimaan'])->name('pengiriman.konfirmasi');
    Route::post('pengiriman/{pengiriman}/koreksi', [PangkalanController::class, 'ajukanKoreksi'])->name('pengiriman.koreksi');
    
    // Penyaluran ke Masyarakat
    Route::get('penyaluran/create', [PangkalanController::class, 'penyaluranCreate'])->name('penyaluran.create');
    Route::post('penyaluran', [PangkalanController::class, 'penyaluranStore'])->name('penyaluran.store');
    
    Route::get('stok', [PangkalanController::class, 'sisaStok'])->name('stok');
});

// 5. Pimpinan Daerah (Dashboard Executive)
Route::middleware(['auth', 'role:Pimpinan Daerah'])->prefix('pimpinan')->name('pimpinan.')->group(function () {
    Route::get('dashboard', [PimpinanDaerahController::class, 'index'])->name('dashboard');
});

// 6. Hiswana Migas
Route::middleware(['auth', 'role:Hiswana Migas'])->prefix('hiswana')->name('hiswana.')->group(function () {
    Route::get('dashboard', [HiswanaMigasController::class, 'index'])->name('dashboard');
});
