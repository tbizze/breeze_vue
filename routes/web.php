<?php

use App\Http\Controllers\ContactController;
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

});




