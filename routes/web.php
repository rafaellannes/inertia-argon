<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


use App\Http\Controllers\Admin\{
    DashboardController,
    PrefeituraController,
    NoticiaCategoriaController,
    NoticiaController,
    UserController,
    UserTenantController,
    ServicoCategoriaController,
    SubCategoriaController,
    TagController,
    ServicoController,
    LojistaController,
    PermissionController,
    RoleController,
};


/* Route::get('/', function () {
    return redirect('/admin/dashboard');
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
}); */

Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //ROTA DE Roles (PERFIS) - ADMIN
    Route::resource('roles', RoleController::class);

    //ROTA DE PERMISSÕES - ADMIN
    Route::resource('permissions', PermissionController::class);

    //**ROTA DE CADASTRO DE USUÁRIO - ADMIN*/
    Route::get('prefeituras/usuarios', [UserController::class, 'index'])->name('prefeitura.usuarios.index');
    Route::post('prefeituras/usuarios', [UserController::class, 'store'])->name('prefeitura.usuarios.store');
    Route::patch('prefeituras/usuarios/{prefeitura}', [UserController::class, 'update'])->name('prefeitura.usuarios.update');
    //**ROTA DE CADASTRO DE USUÁRIO - ADMIN*/

    //ROTA DE PREFEITURA - ADMIN
    Route::resource('prefeituras', PrefeituraController::class);

    //NOTICIAS
    Route::resource('noticias-categoria', NoticiaCategoriaController::class);
    Route::resource('noticias', NoticiaController::class);

    //SERVIÇOS
    Route::resource('servicos-categoria', ServicoCategoriaController::class);
    Route::resource('subcategorias', SubCategoriaController::class);
    Route::resource('tags', TagController::class);

     //**ROTA DE CADASTRO DE LOJISTA*/
     Route::get('servicos/lojistas', [LojistaController::class, 'index'])->name('servico.lojistas.index');
     Route::post('servicos/lojistas', [LojistaController::class, 'store'])->name('servico.lojistas.store');
     Route::patch('servicos/lojistas/{servico}', [LojistaController::class, 'update'])->name('servico.lojistas.update');
     //**ROTA DE CADASTRO DE LOJISTA*/

    Route::resource('servicos', ServicoController::class);



    //USUÁRIOS - USUARIOS TENANT(PREFEITURA)
    Route::resource('usuarios', UserTenantController::class);
});
