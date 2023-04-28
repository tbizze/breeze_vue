<?php

namespace App\Http\Controllers;

use App\Models\LctoGrupo;
use App\Http\Requests\StoreLctoGrupoRequest;
use App\Http\Requests\UpdateLctoGrupoRequest;
use Inertia\Inertia;

class LctoGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define o título da página.
        $titulo = 'Grupos de Lançamentos';

        // Faz busca dos registros.
        $grupos = LctoGrupo::paginate();
        
        // Renderiza a View Inertia.
        return Inertia::render('Lcto/GrupoIndex',[
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
        $titulo = 'Criar Grupo de Lançamentos';

        return Inertia::render('Lcto/GrupoCreate',[
            'titulo' => $titulo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLctoGrupoRequest $request)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        // Persiste model criado no DB.
        LctoGrupo::create($input);

        // Redireciona para index.
        return redirect()->route('lcto.grupos');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LctoGrupo $lctoGrupo)
    {
        // Define o título da página.
        $titulo = 'Editar Grupo de Lançamentos';

        return Inertia::render('Lcto/GrupoEdit',[
            'titulo' => $titulo,
            'grupo' => $lctoGrupo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLctoGrupoRequest $request, LctoGrupo $lctoGrupo)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        $lctoGrupo->fill($input);
        // Persiste model atualizado no DB.
        $lctoGrupo->save($input);

        // Redireciona para index.
        return redirect()->route('lcto.grupos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LctoGrupo $lctoGrupo)
    {
        // Exclui do DB o registro.
        $lctoGrupo->delete();
        
        // Redireciona para index.
        return redirect()->route('lcto.grupos');
    }
}
