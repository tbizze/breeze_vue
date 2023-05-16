<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$permissions = Permission::all();
        

        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,model'],
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
        $permissions = Permission::with('roles');
        
        // Se existe dados do histórico, no request, monta Query com esse parâmetro.
        $permissions->when($request->search, function ($query, $vl){
            $query->where('name', 'like', '%' . $vl . '%');
            //dd('query',$query);
        });

        // Se existe dados do histórico ou da data, no request, 
        // monta OrderBy com esse parâmetro.
        $permissions->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
        });
        
        // Executa Query com paginação.
        $permissions = $permissions->paginate(10);

        // Define o título da página.
        $titulo = 'Permissões';
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/PermissionIndex',[
            'titulo' => $titulo,
            'permissions' => $permissions,
            'filters' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
