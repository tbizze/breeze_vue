<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$tabelaList = Grupo::orderBy('id', 'desc')
        //              ->paginate(4);
        $grupos = Grupo::all();
        
        //dd($grupos);


        return Inertia::render('Financa/GrupoIndex',[
            'grupos' => $grupos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Financa/GrupoCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrupoRequest $request)
    {
        // Chama as validações.
        $input = $request->validated();
        
        // Passado nas validações, persiste o $input no DB.
        Grupo::create($input);

        // Redireciona para index.
        return redirect()->route('financa.grupos');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grupo $grupo)
    {
        //dd($grupo);
        return Inertia::render('Financa/GrupoEdit',[
            'grupo' => $grupo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grupo $grupo)
    {
        //dd('update',$request,$grupo->toArray());

        dd($request->id);

        /* $grupo = Grupo::find($request->id);
        $grupo->nome = $request->nome;
        $grupo->observacao = $request->observacao;
        $grupo->save(); */


        // Redireciona para index.
        return redirect()->route('financa.grupos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grupo $grupo)
    {
        dd('destroy',$grupo);
    }
}
