<?php

namespace App\Http\Controllers;

use App\Models\FatOperadora;
use App\Http\Requests\StoreFatOperadoraRequest;
use App\Http\Requests\UpdateFatOperadoraRequest;
use Inertia\Inertia;

class FatOperadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define o título da página.
        $titulo = 'Operadoras de Cartões';

        // Faz busca dos registros.
        $operadoras = FatOperadora::paginate();

        // Renderiza a View Inertia.
        return Inertia::render('Fatura/OperIndex',[
            'titulo' => $titulo,
            'operadoras' => $operadoras,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Define o título da página.
        $titulo = 'Criar Operadora de Cartão';

        return Inertia::render('Fatura/OperCreate',[
            'titulo' => $titulo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFatOperadoraRequest $request)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        // Persiste model criado no DB.
        FatOperadora::create($input);

        // Redireciona para index.
        return redirect()->route('fat.opers');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FatOperadora $fatOperadora)
    {
        // Define o título da página.
        $titulo = 'Editar Operadora de Cartões';

        return Inertia::render('Fatura/OperEdit',[
            'titulo' => $titulo,
            'operadora' => $fatOperadora,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFatOperadoraRequest $request, FatOperadora $fatOperadora)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        $fatOperadora->fill($input);
        // Persiste model atualizado no DB.
        $fatOperadora->save($input);

        // Redireciona para index.
        return redirect()->route('fat.opers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FatOperadora $fatOperadora)
    {
        // Exclui do DB o registro.
        $fatOperadora->delete();
        
        // Redireciona para index.
        return redirect()->route('fat.opers');
    }
}
