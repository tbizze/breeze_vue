<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users')->only('index');
        $this->middleware('can:admin.users.create')->only('create','store');
        $this->middleware('can:admin.users.edit')->only('edit','update');
        $this->middleware('can:admin.users.delete')->only('destroy');
        //$this->middleware(['permission:admin.users']);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Valida request
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email'],
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
        $users = User::with('roles');

        //dd($users);
        
        // Se existe dados do histórico, no request, monta Query com esse parâmetro.
        $users->when($request->search, function ($query, $vl){
            $query->where('name', 'like', '%' . $vl . '%');
            //dd('query',$query);
        });

        // Se existe dados do histórico ou da data, no request, 
        // monta OrderBy com esse parâmetro.
        $users->when($request->field, function ($query, $vl){
            $query->orderBy($vl, request()->direction);
            //dd('query',$query);
        });
        
        // Executa Query com paginação.
        $users = $users->paginate(10);
        //dd('query',$users);

        /* foreach ($users as $produto){
            echo $produto->id . ' - ' . $produto->name . '<br>';
            echo 'Email: ' . $produto->email . '<br>';
            echo 'Nasc.: ' . $produto->toContact()->dt_nasc . '<br>';
            //echo 'Celular: ' . $produto->toContact->celular . '<br>';
            echo '<br>';
        } */


        
        // Define o título da página.
        $titulo = 'Usuários do Sistema';

        // Faz busca dos registros.
        //$users = User::paginate();
        
        // Renderiza a View Inertia.
        return Inertia::render('Admin/UserIndex',[
            'titulo' => $titulo,
            'users' => $users,
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
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $a = $user->getPermissionsViaRoles()->toArray();        
        $b = $user->getAllPermissions()->toArray();   
        $c = $user->permissions();  

        $x = $user->getRoleNames();
        //$y = $user->getAllPermissions();
        $y = $user->getPermissionNames();

//print_r($y);
        //dd($user->hasPermissionTo('admin.users'));
        //dd($user->getAllPermissions());
        //dd($user->getRoleNames());
        
        
        //dd($a, $b, $c);
        
        $roles = Role::all();
    
        $user_roles = $user->roles()->allRelatedIds();

        //$user_roles = $user->roles();
        //$all_users_with_all_their_roles = User::with('roles')->get();
        //dd($user->hasAllRoles(Role::all()));

        // Define o título da página.
        $titulo = 'Função Usuário';

        return Inertia::render('Admin/UserEdit',[
            'titulo' => $titulo,
            'user' => $user,
            'roles' => $roles,
            'user_roles' => $user_roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $user->roles()->sync($request->roles);
        // Carrega na variável apenas os campos aprovados nas validações.
        //$input = $request->validated();
        
        // Carrega no model os dados carregados na variável, para persistir no DB.
        //$lctoGrupo->fill($input);
        // Persiste model atualizado no DB.
        //$lctoGrupo->save($input);

        // Redireciona para index.
        return redirect()->route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
