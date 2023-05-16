<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExtratoController;
use App\Http\Controllers\FatGrupoController;
use App\Http\Controllers\FatOperadoraController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\LctoGrupoController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    
/*
|--------------------------------------------------------------------------
| ROTAS COM AUTENTICAÇÃO
|--------------------------------------------------------------------------
| Aqui estarão as rotas que exigem autenticação.
| Se tentar acessá-las sem estar logado, será redirecionado à página de login.
*/    
    
    /**
     * Página inicial após logar na aplicação.
     */
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    /**
     * Chama mensagens Toast.
     */
    Route::post('/test', function () {
        return redirect()->back()->with('toast','Toast endpoint!');
    });


    /**
     * Rotas de Contatos.
     */
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/contacts/{contact}/show', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('/contacts/update', [ContactController::class, 'update'])->name('contacts.update');
    /* Route::post('/contacts/{contact}/update', [ContactController::class, 'update'])->name('contacts.update'); */
    /* Route::get('/contacts/{contact}delete', [ContactController::class, 'destroy'])->name('contacts.destroy'); */

    Route::get('/contacts/{contact}/delete', [ContactController::class, 'destroy'])->name('contacts.destroy');

    /**
     * #### ROTAS DE USUÁRIOS #########################
     */
    Route::prefix('admin/users')->group(function (){
        Route::get('/', [UserController::class,'index'])->name('admin.users');
        // Criar
        Route::get('/create', [UserController::class,'create'])->name('admin.users.create');
        Route::post('/', [UserController::class,'store'])->name('admin.users.store');
        // Editar
        Route::get('/{user}/edit', [UserController::class,'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class,'update'])->name('admin.users.update');
        // Deletar
        Route::delete('/{user}', [UserController::class,'destroy'])->name('admin.users.delete');
    });

    /**
     * #### ROTAS DE FUNÇÕES #########################
     */
    Route::prefix('admin/roles')->group(function (){
        Route::get('/', [RoleController::class,'index'])->name('admin.roles');
        // Criar
        Route::get('/create', [RoleController::class,'create'])->name('admin.roles.create');
        Route::post('/', [RoleController::class,'store'])->name('admin.roles.store');
        // Editar
        Route::get('/{role}/edit', [RoleController::class,'edit'])->name('admin.roles.edit');
        Route::put('/{role}', [RoleController::class,'update'])->name('admin.roles.update');
        // Deletar
        Route::delete('/{role}', [RoleController::class,'destroy'])->name('admin.roles.delete');
    });

    /**
     * #### ROTAS DE PERMISSÕES #########################
     */
    Route::prefix('admin/permissions')->group(function (){
        Route::get('/', [PermissionController::class,'index'])->name('admin.permissions');
        // Criar
        Route::get('/create', [PermissionController::class,'create'])->name('admin.permissions.create');
        Route::post('/', [PermissionController::class,'store'])->name('admin.permissions.store');
        // Editar
        Route::get('/{permission}/edit', [PermissionController::class,'edit'])->name('admin.permissions.edit');
        Route::put('/{permission}', [PermissionController::class,'update'])->name('admin.permissions.update');
        // Deletar
        Route::delete('/{permission}', [PermissionController::class,'destroy'])->name('admin.permissions.delete');
    });

    /**
     * #### ROTAS DE GRUPOS DE LANÇAMENTOS #########################
     */
    Route::prefix('lcto/grupos')->group(function (){
        Route::get('/', [LctoGrupoController::class,'index'])->name('lcto.grupos');
        // Criar
        Route::get('/create', [LctoGrupoController::class,'create'])->name('lcto.grupos.create');
        Route::post('/', [LctoGrupoController::class,'store'])->name('lcto.grupos.store');
        // Editar
        Route::get('/{lctoGrupo}/edit', [LctoGrupoController::class,'edit'])->name('lcto.grupos.edit');
        Route::put('/{lctoGrupo}', [LctoGrupoController::class,'update'])->name('lcto.grupos.update');
        // Deletar
        Route::delete('/{lctoGrupo}', [LctoGrupoController::class,'destroy'])->name('lcto.grupos.delete');
    });

    /**
     * #### ROTAS DE GRUPOS DE FATURAS #########################
     */
    Route::prefix('fat/grupos')->group(function (){
        Route::get('/', [FatGrupoController::class,'index'])->name('fat.grupos');
        // Criar
        Route::get('/create', [FatGrupoController::class,'create'])->name('fat.grupos.create');
        Route::post('/', [FatGrupoController::class,'store'])->name('fat.grupos.store');
        // Editar
        Route::get('/{fatGrupo}/edit', [FatGrupoController::class,'edit'])->name('fat.grupos.edit');
        Route::put('/{fatGrupo}', [FatGrupoController::class,'update'])->name('fat.grupos.update');
        // Deletar
        Route::delete('/{fatGrupo}', [FatGrupoController::class,'destroy'])->name('fat.grupos.delete');
    });

    /**
     * #### ROTAS DE OPERADORAS DE FATURAS #########################
     */
    Route::prefix('fat/opers')->group(function (){
        Route::get('/', [FatOperadoraController::class,'index'])->name('fat.opers');
        // Criar
        Route::get('/create', [FatOperadoraController::class,'create'])->name('fat.opers.create');
        Route::post('/', [FatOperadoraController::class,'store'])->name('fat.opers.store');
        // Editar
        Route::get('/{fatOperadora}/edit', [FatOperadoraController::class,'edit'])->name('fat.opers.edit');
        Route::put('/{fatOperadora}', [FatOperadoraController::class,'update'])->name('fat.opers.update');
        // Deletar
        Route::delete('/{fatOperadora}', [FatOperadoraController::class,'destroy'])->name('fat.opers.delete');
    });


    //Route::post('financa/grupos/{grupo}', [LctoGrupoController::class,'update'])->name('rota_teste'); 

    /**
     * #### ROTAS DE LANÇAMENTOS #########################
     */
    Route::prefix('lcto')->group(function (){
        Route::get('/', [LancamentoController::class,'index'])->name('lcto');
        // Criar
        Route::get('/create', [LancamentoController::class,'create'])->name('lcto.create');
        Route::post('/', [LancamentoController::class,'store'])->name('lcto.store');
        // Editar
        Route::get('/{lancamento}/edit', [LancamentoController::class,'edit'])->name('lcto.edit');
        Route::put('/{lancamento}', [LancamentoController::class,'update'])->name('lcto.update');
        // Deletar
        Route::get('/{lancamento}/delete', [LancamentoController::class,'destroy'])->name('lcto.delete');
    });

    /**
     * #### ROTAS DE FATURAS #########################
     */
    Route::prefix('fat')->group(function (){
        Route::get('/', [FaturaController::class,'index'])->name('fat');
        // Criar
        Route::get('/create', [FaturaController::class,'create'])->name('fat.create');
        //Route::get('/create-all', [FaturaController::class,'createAll'])->name('fat.create.all');
        Route::post('/', [FaturaController::class,'store'])->name('fat.store');
        //Route::post('/', [FaturaController::class,'storeAll'])->name('fat.store.all');
        // Editar
        Route::get('/{fatura}/edit', [FaturaController::class,'edit'])->name('fat.edit');
        Route::put('/{fatura}', [FaturaController::class,'update'])->name('fat.update');
        // Deletar
        Route::delete('/{fatura}/delete', [FaturaController::class,'destroy'])->name('fat.delete');
    });

    /**
     * #### ROTAS DE EXTRATO #########################
     */
    Route::prefix('extrato')->group(function (){
        Route::get('/', [ExtratoController::class,'index'])->name('extrato');
        // Criar
        Route::get('/create', [ExtratoController::class,'create'])->name('extrato.create');
        Route::post('/', [ExtratoController::class,'store'])->name('extrato.store');
        // Editar
        Route::get('/{fatura}/edit', [ExtratoController::class,'edit'])->name('extrato.edit');
        Route::put('/{fatura}', [ExtratoController::class,'update'])->name('extrato.update');
        // Deletar
        Route::delete('/{fatura}/delete', [ExtratoController::class,'destroy'])->name('extrato.delete');
    });

});




