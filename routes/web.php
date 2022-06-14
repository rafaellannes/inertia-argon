<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\Admin\{
    DashboardController,
    PrefeituraController,
    NoticiaCategoriaController,
    UserController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('prefeituras/usuarios', [UserController::class, 'index'])->name('prefeitura.usuarios.index');
    Route::post('prefeituras/usuarios', [UserController::class, 'store'])->name('prefeitura.usuarios.store');
    Route::patch('prefeituras/usuarios/{prefeitura}', [UserController::class, 'update'])->name('prefeitura.usuarios.update');
    Route::resource('prefeituras', PrefeituraController::class);


    Route::resource('noticias-categoria', NoticiaCategoriaController::class);
});
