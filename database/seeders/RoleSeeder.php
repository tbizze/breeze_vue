<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create roles and assign existing permissions
        $role1 = Role::create([
            'name' => 'Admin',
            'description' => 'Usuário super administrador. Acesso total, inclusive administra usuários e permissões.'
        ]);
        $role2 = Role::create([
            'name' => 'Medio',
            'description' => 'Usuário com amplos poderes no sistema, com exceção na administração de usuários e permissões.'
        ]); // Semi-total. Só não pode acessar configurações, usuários e permissões
        $role3 = Role::create([
            'name' => 'Basico',
            'description' => 'Usuário com poucas permissões, apenas consultar.'
        ]); // Apenas consulta informações. Não pode edital/apagar.

        /**
         * ### CRIAR PERMISSÕES ########################
         * Além de criar as permissões, já lhe atribui funções através do método
        */

        // Usuários
        Permission::create([
            'name'          => 'admin.users',
            'description'   => 'Ver usuários',
            'model'         => 'Permissões',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.edit',
            'description'   => 'Editar usuários',
            'model'         => 'Permissões',
            ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.users.delete',
            'description'   => 'Deletar usuários',
            'model'         => 'Permissões',
            ])->syncRoles([$role1]);

        // Funções de Usuários
        Permission::create([
            'name'          => 'admin.roles',
            'description'   => 'Ver funções',
            'model'         => 'Permissões',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.edit',
            'description'   => 'Editar funções',
            'model'         => 'Permissões',
            ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.roles.delete',
            'description'   => 'Deletar funções',
            'model'         => 'Permissões',
            ])->syncRoles([$role1]);

        // Funções de Usuários
        Permission::create([
            'name'          => 'admin.permissions',
            'description'   => 'Ver permissões',
            'model'         => 'Permissões',
        ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.edit',
            'description'   => 'Editar permissões',
            'model'         => 'Permissões',
            ])->syncRoles([$role1]);
        Permission::create([
            'name'          => 'admin.permissions.delete',
            'description'   => 'Deletar permissões',
            'model'         => 'Permissões',
            ])->syncRoles([$role1]);
        
        // create permissions => Grupos de lançamentos
        /* Permission::create(['name' => 'lcto.grupos'])->syncRoles([$role2,$role3]);
        Permission::create(['name' => 'lcto.grupos.create'])->syncRoles([$role2]);
        Permission::create(['name' => 'lcto.grupos.edit'])->syncRoles([$role2]);
        Permission::create(['name' => 'lcto.grupos.delete'])->syncRoles([$role2]); */
        
        // create permissions => Grupos de Fatura
        /* Permission::create(['name' => 'fat.grupos'])->syncRoles([$role2, $role3]);
        Permission::create(['name' => 'fat.grupos.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'fat.grupos.edit'])->syncRoles([$role1]); */

        // create permissions => Operadoras de Fatura
        /* Permission::create(['name' => 'fat.opers'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'fat.opers.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'fat.opers.edit'])->syncRoles([$role1]); */
        
    }
}
