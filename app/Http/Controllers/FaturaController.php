<?php

namespace App\Http\Controllers;

use App\Models\Fatura;
use App\Http\Requests\StoreFaturaRequest;
use App\Http\Requests\UpdateFaturaRequest;
use App\Models\FaturaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:dt_venc,dt_pgto'],
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
        $faturas = Fatura::with('toFatOperadora');
        
        // Se existe dados das Notas, no request, monta Query com esse parâmetro.
        $faturas->when($request->search, function ($query, $vl){
            $query->where('notas', 'like', '%' . $vl . '%');
        });

        // Se existe dados do histórico ou da data, no request, 
        // monta OrderBy com esse parâmetro.
        $faturas->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
            //dd('query',$query);
        });

        // Executa Query com paginação.
        $faturas = $faturas->paginate(10);
        //dd($faturas);

        $total = $faturas->sum('valor_pgto');

        // Define o título da página.
        $titulo = 'Faturas';
        
        // Renderiza a View Inertia.
        return Inertia::render('Fatura/Index',[
            'titulo' => $titulo,
            'faturas' => $faturas,
            'total' => $total,
            'filters' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
/*     public function create()
    {
        // Define o título da página.
        $titulo = 'Criar Fatura';

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $operadoras = DB::table('fat_operadoras')
            ->select('id as value', 'nome as label')
            ->get();

        return Inertia::render('Fatura/Create',[
            'titulo' => $titulo,
            'operadoras' => $operadoras,
        ]);
    } */

    public function create()
    {
        // Define o título da página.
        $titulo = 'Criar Fatura Completa';

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $operadoras = DB::table('fat_operadoras')
            ->select('id as value', 'nome as label')
            ->get();

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $grupos = DB::table('fat_grupos')
            ->select('id as value', 'nome as label')
            ->get();

        // Renderiza a View Inertia.
        return Inertia::render('Fatura/Create',[
            'titulo' => $titulo,
            'operadoras' => $operadoras,
            'grupos' => $grupos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
/*     public function store(StoreFaturaRequest $request)
    {
        //dd($request);
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();
        // Persiste model criado no DB.
        Fatura::create($input);

        // Redireciona para index.
        return redirect()->route('fat');
    } */
    public function store(StoreFaturaRequest $request)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $inputFatura = $request->validated(); 
        
        // Com são 2 ações de persistência no DB, realiza dentro de uma transação, 
        // pois se uma falhar, a outra é cancelada.
        DB::beginTransaction();

            // Persiste model criado no DB.
            $fatura = Fatura::create($inputFatura);
            
            // Se existe itens de fatura no Request, persiste no BD.
            // NOTA: usa-se o método 'createMany' do Eloquent que grava a coleção de dados,
            // presente na 'fat_itens', através do relacionamento 'hasFaturaItens'
            if($request->has('fat_itens')) {
                $fatura->hasFaturaItens()->createMany($request->fat_itens);
            }

        // Fecha transação do DB.
        DB::commit();

        // Redireciona para index.
        return redirect()->route('fat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fatura $fatura)
    {
        // Define o título da página.
        $titulo = 'Editar Fatura';

        // Busca os grupos para passar ao ListBox.
        // Renomeia coluna id=>value | nome=>label
        $operadoras = DB::table('fat_operadoras')
            ->select('id as value', 'nome as label')
            ->get();

        return Inertia::render('Fatura/Edit',[
            'titulo' => $titulo,
            'operadoras' => $operadoras,
            'fatura' => $fatura,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaturaRequest $request, Fatura $fatura)
    {
        // Carrega na variável apenas os campos aprovados nas validações.
        $input = $request->validated();

        // Carrega no model os dados carregados na variável, para persistir no DB.
        $fatura->fill($input);
        // Persiste model atualizado no DB.
        $fatura->save($input);

        // Redireciona para index.
        return redirect()->route('fat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fatura $fatura)
    {
        // Se o modelo a excluir não possui itens associado a ele, então deleta.
        // Se a contagem retornar > 0, emite aviso.
        if (count($fatura->hasFaturaItens) > 0){
            // Chamaria rotina para emitir aviso que tem registros.
        } else{
            // Exclui do DB o registro.
            $fatura->delete();

            // Redireciona para index.
            return redirect()->route('fat');
        }
    }
}
