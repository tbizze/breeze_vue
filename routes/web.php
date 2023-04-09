<?php

use App\Http\Controllers\ContactController;
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

});




