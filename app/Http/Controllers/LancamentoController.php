<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Http\Requests\StoreLancamentoRequest;
use App\Http\Requests\UpdateLancamentoRequest;
use App\Models\Grupo;
use App\Models\LctoGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {      
        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:lcto_data,lcto_historico'],
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
        $lctos = Lancamento::with('toLctoGrupo');
        
        // Se existe dados do histórico, no request, monta Query com esse parâmetro.
        $lctos->when($request->search, function ($query, $vl){
            $query->where('lcto_historico', 'like', '%' . $vl . '%');
            //dd('query',$query);
        });

        // Se existe dados do histórico ou da data, no request, 
        // monta OrderBy com esse parâmetro.
        $lctos->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
            //dd('query',$query);
        });
        
        // Executa Query com paginação.
        $lctos = $lctos->paginate(10);

        // Faz soma na coluna 'lcto_valor'
        $total = $lctos->sum('lcto_valor');
 
        // Define o título da página.
        $titulo = 'Lançamentos';

        // Renderiza a View Inertia.
        return Inertia::render('Lcto/Index',[
            'titulo' => $titulo,
            'lancamentos' => $lctos,
            'filters' => $request,
            'total' => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $grupos = DB::table('lcto_grupos')
            ->select('id as value', 'nome as label')
            ->get();
        
            // Monta os tipos para passar ao ListBox.
        $tipos = [
            0 => [
                'value' => 'C',
                'label' => 'C - Crédito',
            ],[
                'value' => 'D',
                'label' => 'D - Débito',
            ]            
        ];

        // Define o título da página.
        $titulo = 'Criar lançamentos';

        // Renderiza a View Inertia.
        return Inertia::render('Lcto/Create',[
            'titulo' => $titulo,
            'grupos' => $grupos,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLancamentoRequest $request)
    {
        // Chama as validações.
        $input = $request->validated();
        
        // Passado nas validações, persiste o $input no DB.
        //Lancamento::create($input);


        if (Lancamento::create($input)) {
            return redirect()
                ->route('financa')
                ->with('message', 'Registro criado com sucesso!');
        };

        // Redireciona para index.
        //return redirect()->route('financa');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lancamento $lancamento)
    {
        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $grupos = DB::table('lcto_grupos')
            ->select('id as value', 'nome as label')
            ->get();
        
            // Monta os tipos para passar ao ListBox.
        $tipos = [
            0 => [
                'value' => 'C',
                'label' => 'C - Crédito',
            ],[
                'value' => 'D',
                'label' => 'D - Débito',
            ]            
        ];

        // Define o título da página.
        $titulo = 'Editar Lançamentos';

        // Renderiza a View Inertia.
        return Inertia::render('Lcto/Edit',[
            'titulo' => $titulo,
            'grupos' => $grupos,
            'tipos' => $tipos,
            'lancamento' => $lancamento,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLancamentoRequest $request, Lancamento $lancamento)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        $lancamento->fill($input);
        // Persiste model atualizado no DB.
        $lancamento->save($input);

        // Redireciona para index.
        return redirect()->route('lcto');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lancamento $lancamento)
    {
        // Exclui do DB o registro.
        $lancamento->delete();
        
        // Redireciona para index.
        return redirect()->route('lcto');
    }
}
