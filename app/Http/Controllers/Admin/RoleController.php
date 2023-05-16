<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name'],
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
        $roles = Role::with('permissions');
        //$roles = Role::all();
        //dd($roles->items());
        
        // Se existe dados do histórico, no request, monta Query com esse parâmetro.
        $roles->when($request->search, function ($query, $vl){
            $query->where('name', 'like', '%' . $vl . '%');
            dd('query',$query);
        });
        
        // Se existe dados do histórico ou da data, no request, 
        // monta OrderBy com esse parâmetro.
        $roles->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
            //dd('query',$query);
        });
        
        // Executa Query com paginação.
        $roles = $roles->paginate(10);

        //dd($roles);

        // Define o título da página.
        $titulo = 'Usuários do Sistema';

        // Faz busca dos registros.
        //$users = User::paginate();
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/RoleIndex',[
            'titulo' => $titulo,
            'roles' => $roles,
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
    public function edit(Role $role)
    {
               


        $permissions = Permission::all();

        $arrMeses = [
            Permission::all()->pluck('model')
        ];
        $itens = Permission::select(DB::raw('model, name, id'))
          //->groupBy(DB::raw("model"))
          ->orderBy('model')
          //->lists('id', 'model')
          //->pluck();
          ->get();
          //dd('itens',$itens);
        
        // Lista de Modelos, pegando somente um de cada. Não se repete.
        $permissions_models = Permission::select(DB::raw('model'))
          ->groupBy(DB::raw("model"))
          ->orderBy('model')
          ->get();

    
        $role_permissions = $role->permissions->pluck('id');
        //$role_permissions = $role->permissions()->allRelatedIds(); // o mesmo q linha acima.


        //dd($role_permissions);
        
        // Define o título da página.
        $titulo = 'Função Usuário';

        return Inertia::render('Admin/RoleEdit',[
            'titulo' => $titulo,
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
            'permissions_models' => $permissions_models,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //dd($request,$role);
        //$role->roles()->sync($request->roles);
        $role->syncPermissions($request->permissions);
        // Carrega na variável apenas os campos aprovados nas validações.
        //$input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        //$lctoGrupo->fill($input);
        // Persiste model atualizado no DB.
        //$lctoGrupo->save($input);

        // Redireciona para index.
        return redirect()->route('admin.roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
