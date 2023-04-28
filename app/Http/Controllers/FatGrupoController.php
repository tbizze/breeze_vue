<?php

namespace App\Http\Controllers;

use App\Models\FatGrupo;
use App\Http\Requests\StoreFatGrupoRequest;
use App\Http\Requests\UpdateFatGrupoRequest;
use Inertia\Inertia;

class FatGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define o título da página.
        $titulo = 'Grupos de Faturas';

        // Faz busca dos registros.
        $grupos = FatGrupo::paginate();
        
        // Renderiza a View Inertia.
        return Inertia::render('Fatura/GrupoIndex',[
            'titulo' => $titulo,
            'grupos' => $grupos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Define o título da página.
        $titulo = 'Criar Grupo de Faturas';

        return Inertia::render('Fatura/GrupoCreate',[
            'titulo' => $titulo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFatGrupoRequest $request)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        // Persiste model criado no DB.
        FatGrupo::create($input);

        // Redireciona para index.
        return redirect()->route('fat.grupos');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FatGrupo $fatGrupo)
    {
        // Define o título da página.
        $titulo = 'Editar Grupo de Faturas';

        // Renderiza a View Inertia.
        return Inertia::render('Fatura/GrupoEdit',[
            'titulo' => $titulo,
            'grupo' => $fatGrupo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFatGrupoRequest $request, FatGrupo $fatGrupo)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        $fatGrupo->fill($input);
        // Persiste model atualizado no DB.
        $fatGrupo->save($input);

        // Redireciona para index.
        return redirect()->route('fat.grupos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FatGrupo $fatGrupo)
    {
        // Exclui do DB o registro.
        $fatGrupo->delete();
        
        // Redireciona para index.
        return redirect()->route('fat.grupos');
    }
}
