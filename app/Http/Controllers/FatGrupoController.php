<?php

namespace App\Http\Controllers;

use App\Models\FatGrupo;
use App\Http\Requests\StoreFatGrupoRequest;
use App\Http\Requests\UpdateFatGrupoRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FatGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /* public function index()
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
    } */

    public function index(Request $request)
    {
        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:nome'],
        ]);

        /** 
         * #### MONTA A QUERY ###############################
         * 1) Relacionamentos com técnica otimização
         * 2) Aplica Filtros
         * 3) Aplica Ordenamentos
         * 4) Executa com Paginação
         * 5) Totais
         * */
        // Estabelece relacionamentos.
        $grupos = FatGrupo::query();
        
        // Se existe dados do histórico, no request, monta Query com esse parâmetro.
        $grupos->when($request->search, function ($query, $vl){
            $query->where('nome', 'like', '%' . $vl . '%');
            //dd('query',$query);
        });

        // Se existe dados do histórico ou da data, no request, 
        // monta OrderBy com esse parâmetro.
        $grupos->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
            //dd('query',$query);
        });
        
        // Executa Query com paginação.
        $grupos = $grupos->paginate(10);

        //dd($request);
        
        
        
        // Define o título da página.
        $titulo = 'Grupos de Faturas';

        // Faz busca dos registros.
        //$grupos = FatGrupo::paginate();
        
        // Renderiza a View Inertia.
        return Inertia::render('Fatura/GrupoIndex',[
            'titulo' => $titulo,
            'grupos' => $grupos,
            'filters' => $request,
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
