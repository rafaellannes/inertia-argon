<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class PermissonsRolesSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //PERMISSÃO DASHBOARD
        $dashboardPermission = Permission::create([
            'name' => 'read:dashboard',
            'descricao' => 'Acesso ao dashboard',
        ]);

        //PERMISSÃO PREFEITURA
        $prefeituraPermission1 = Permission::create([
            'name' => 'read:prefeitura',
            'descricao' => 'Acesso ao cadastro de prefeituras',
        ]);

        $prefeituraPermission2 = Permission::create([
            'name' => 'update:prefeitura',
            'descricao' => 'Edição de prefeituras',
        ]);

        $prefeituraPermission3 = Permission::create([
            'name' => 'delete:prefeitura',
            'descricao' => 'Exclusão de prefeituras',
        ]);

        $prefeituraPermission4 = Permission::create([
            'name' => 'create:prefeitura',
            'descricao' => 'Cadastro de prefeituras',
        ]);

        //PERMISSÃO PERFIL
        $perfilPermission1 = Permission::create([
            'name' => 'read:perfil',
            'descricao' => 'Acesso ao cadastro de perfis',
        ]);

        $perfilPermission2 = Permission::create([
            'name' => 'update:perfil',
            'descricao' => 'Edição de perfis',
        ]);

        $perfilPermission3 = Permission::create([
            'name' => 'delete:perfil',
            'descricao' => 'Exclusão de perfis',
        ]);

        $perfilPermission4 = Permission::create([
            'name' => 'create:perfil',
            'descricao' => 'Cadastro de perfis',
        ]);

        //PERMISSÃO PERMISSÃO
        $permissoesPermission1 = Permission::create([
            'name' => 'read:permissoes',
            'descricao' => 'Acesso ao cadastro de permissões',
        ]);

        $permissoesPermission2 = Permission::create([
            'name' => 'update:permissoes',
            'descricao' => 'Edição de permissões',
        ]);

        $permissoesPermission3 = Permission::create([
            'name' => 'delete:permissoes',
            'descricao' => 'Exclusão de permissões',
        ]);

        $permissoesPermission4 = Permission::create([
            'name' => 'create:permissoes',
            'descricao' => 'Cadastro de permissões',
        ]);

        //PERMISSÃO USUÁRIO
        $usuarioPermission1 = Permission::create([
            'name' => 'read:usuario',
            'descricao' => 'Acesso ao cadastro de usuários',
        ]);

        $usuarioPermission2 = Permission::create([
            'name' => 'update:usuario',
            'descricao' => 'Edição de usuários',
        ]);

        $usuarioPermission3 = Permission::create([
            'name' => 'delete:usuario',
            'descricao' => 'Exclusão de usuários',
        ]);

        $usuarioPermission4 = Permission::create([
            'name' => 'create:usuario',
            'descricao' => 'Cadastro de usuários',
        ]);

        //PERMISSÃO CATEGORIA-NOTICIA
        $categoriaNoticiaPermission1 = Permission::create([
            'name' => 'read:categoria-noticia',
            'descricao' => 'Acesso ao cadastro de categorias de notícias',
        ]);

        $categoriaNoticiaPermission2 = Permission::create([
            'name' => 'update:categoria-noticia',
            'descricao' => 'Edição de categorias de notícias',
        ]);

        $categoriaNoticiaPermission3 = Permission::create([
            'name' => 'delete:categoria-noticia',
            'descricao' => 'Exclusão de categorias de notícias',
        ]);

        $categoriaNoticiaPermission4 = Permission::create([
            'name' => 'create:categoria-noticia',
            'descricao' => 'Cadastro de categorias de notícias',
        ]);

        //PERMISSÃO NOTICIA
        $noticiaPermission1 = Permission::create([
            'name' => 'read:noticia',
            'descricao' => 'Acesso ao cadastro de notícias',
        ]);

        $noticiaPermission2 = Permission::create([
            'name' => 'update:noticia',
            'descricao' => 'Edição de notícias',
        ]);

        $noticiaPermission3 = Permission::create([
            'name' => 'delete:noticia',
            'descricao' => 'Exclusão de notícias',
        ]);

        $noticiaPermission4 = Permission::create([
            'name' => 'create:noticia',
            'descricao' => 'Cadastro de notícias',
        ]);

        //PERMISSÃO CATEGORIA-SERVICO
        $categoriaServicoPermission1 = Permission::create([
            'name' => 'read:categoria-servico',
            'descricao' => 'Acesso ao cadastro de categorias de serviços',
        ]);

        $categoriaServicoPermission2 = Permission::create([
            'name' => 'update:categoria-servico',
            'descricao' => 'Edição de categorias de serviços',
        ]);

        $categoriaServicoPermission3 = Permission::create([
            'name' => 'delete:categoria-servico',
            'descricao' => 'Exclusão de categorias de serviços',
        ]);

        $categoriaServicoPermission4 = Permission::create([
            'name' => 'create:categoria-servico',
            'descricao' => 'Cadastro de categorias de serviços',
        ]);

        //PERMISSÃO SUBCATEGORIA-SERVICO
        $subcategoriaServicoPermission1 = Permission::create([
            'name' => 'read:subcategoria-servico',
            'descricao' => 'Acesso ao cadastro de subcategorias de serviços',
        ]);

        $subcategoriaServicoPermission2 = Permission::create([
            'name' => 'update:subcategoria-servico',
            'descricao' => 'Edição de subcategorias de serviços',
        ]);

        $subcategoriaServicoPermission3 = Permission::create([
            'name' => 'delete:subcategoria-servico',
            'descricao' => 'Exclusão de subcategorias de serviços',
        ]);

        $subcategoriaServicoPermission4 = Permission::create([
            'name' => 'create:subcategoria-servico',
            'descricao' => 'Cadastro de subcategorias de serviços',
        ]);

        //PERMISSÃO TAGS
        $tagsPermission1 = Permission::create([
            'name' => 'read:tags',
            'descricao' => 'Acesso ao cadastro de tags',
        ]);

        $tagsPermission2 = Permission::create([
            'name' => 'update:tags',
            'descricao' => 'Edição de tags',
        ]);

        $tagsPermission3 = Permission::create([
            'name' => 'delete:tags',
            'descricao' => 'Exclusão de tags',
        ]);

        $tagsPermission4 = Permission::create([
            'name' => 'create:tags',
            'descricao' => 'Cadastro de tags',
        ]);

        //PERMISSÃO SERVICO
        $servicoPermission1 = Permission::create([
            'name' => 'read:servico',
            'descricao' => 'Acesso ao cadastro de serviços',
        ]);

        $servicoPermission2 = Permission::create([
            'name' => 'update:servico',
            'descricao' => 'Edição de serviços',
        ]);

        $servicoPermission3 = Permission::create([
            'name' => 'delete:servico',
            'descricao' => 'Exclusão de serviços',
        ]);

        $servicoPermission4 = Permission::create([
            'name' => 'create:servico',
            'descricao' => 'Cadastro de serviços',
        ]);


        //PERFIS
        $superAdminRole = Role::create([
            'name' => 'Super Admin',
        ]);

        $adminRole = Role::create([
            'name' => 'Admin',
        ]);

        $moderadorRole = Role::create([
            'name' => 'Moderador',
        ]);

        $editorNoticiaRole = Role::create([
            'name' => 'Editor Notícias',
        ]);

        $editorServicoRole = Role::create([
            'name' => 'Editor Serviços',
        ]);


        //PERMISSÃO PERFIL SUPER ADMIN
        $superAdminRole->syncPermissions([
            $dashboardPermission,

            $prefeituraPermission1,
            $prefeituraPermission2,
            $prefeituraPermission3,
            $prefeituraPermission4,

            $perfilPermission1,
            $perfilPermission2,
            $perfilPermission3,
            $perfilPermission4,

            $permissoesPermission1,
            $permissoesPermission2,
            $permissoesPermission3,
            $permissoesPermission4,
        ]);

        //PERMISSÃO PERFIL ADMIN
        $adminRole->syncPermissions([
            $usuarioPermission1,
            $usuarioPermission2,
            $usuarioPermission3,
            $usuarioPermission4,

            $categoriaNoticiaPermission1,
            $categoriaNoticiaPermission2,
            $categoriaNoticiaPermission3,
            $categoriaNoticiaPermission4,

            $noticiaPermission1,
            $noticiaPermission2,
            $noticiaPermission3,
            $noticiaPermission4,

            $categoriaServicoPermission1,
            $categoriaServicoPermission2,
            $categoriaServicoPermission3,
            $categoriaServicoPermission4,

            $subcategoriaServicoPermission1,
            $subcategoriaServicoPermission2,
            $subcategoriaServicoPermission3,
            $subcategoriaServicoPermission4,

            $tagsPermission1,
            $tagsPermission2,
            $tagsPermission3,
            $tagsPermission4,

            $servicoPermission1,
            $servicoPermission2,
            $servicoPermission3,
            $servicoPermission4,
        ]);

        //PERMISSÃO PERFIL MODERADOR
        $moderadorRole->syncPermissions([
            $usuarioPermission1,
            $usuarioPermission2,
            $usuarioPermission3,
            $usuarioPermission4,

            $categoriaNoticiaPermission1,
            $categoriaNoticiaPermission2,
            $categoriaNoticiaPermission3,
            $categoriaNoticiaPermission4,

            $noticiaPermission1,
            $noticiaPermission2,
            $noticiaPermission3,
            $noticiaPermission4,

            $categoriaServicoPermission1,
            $categoriaServicoPermission2,
            $categoriaServicoPermission3,
            $categoriaServicoPermission4,

            $subcategoriaServicoPermission1,
            $subcategoriaServicoPermission2,
            $subcategoriaServicoPermission3,
            $subcategoriaServicoPermission4,

            $tagsPermission1,
            $tagsPermission2,
            $tagsPermission3,
            $tagsPermission4,

            $servicoPermission1,
            $servicoPermission2,
            $servicoPermission3,
            $servicoPermission4,
        ]);

        //PERMISSÃO PERFIL EDITOR DE NOTICIAS
        $editorNoticiaRole->syncPermissions([
            $categoriaNoticiaPermission1,
            $categoriaNoticiaPermission2,
            $categoriaNoticiaPermission3,
            $categoriaNoticiaPermission4,

            $noticiaPermission1,
            $noticiaPermission2,
            $noticiaPermission3,
            $noticiaPermission4,
        ]);

        //PERMISSÃO PERFIL EDITOR DE SERVIÇOS
        $editorServicoRole->syncPermissions([
            $categoriaServicoPermission1,
            $categoriaServicoPermission2,
            $categoriaServicoPermission3,
            $categoriaServicoPermission4,

            $subcategoriaServicoPermission1,
            $subcategoriaServicoPermission2,
            $subcategoriaServicoPermission3,
            $subcategoriaServicoPermission4,

            $tagsPermission1,
            $tagsPermission2,
            $tagsPermission3,
            $tagsPermission4,

            $servicoPermission1,
            $servicoPermission2,
            $servicoPermission3,
            $servicoPermission4,
        ]);

        //USUÁRIO SUPER ADMIN
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'enjoy@enjoy.com',
            'password' => bcrypt('@enjoy01'),
            'isAdmin' => true,
            "prefeitura_id" => null,
        ]);

        //USUÁRIO ADMIN
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@london.com',
            'password' => bcrypt('@enjoy01'),
            'isAdmin' => false,
            "prefeitura_id" => 1,
        ]);

        //USUÁRIO MODERADOR
        $moderador = User::create([
            'name' => 'Moderador',
            'email' => 'moderador@london.com',
            'password' => bcrypt('@enjoy01'),
            'isAdmin' => false,
            "prefeitura_id" => 1,
        ]);

        //USUÁRIO EDITOR DE NOTICIAS
        $editorNoticia = User::create([
            'name' => 'Editor de Notícias',
            'email' => 'editornoticias@london.com',
            'password' => bcrypt('@enjoy01'),
            'isAdmin' => false,
            "prefeitura_id" => 1,
        ]);

        //USUÁRIO EDITOR DE SERVIÇOS
        $editorServico = User::create([
            'name' => 'Editor de Serviços',
            'email' => 'editorservicos@london.com',
            'password' => bcrypt('@enjoy01'),
            'isAdmin' => false,
            "prefeitura_id" => 1,
        ]);


        //Sync roles

        $superAdmin->syncRoles([$superAdminRole]);
        $admin->syncRoles([$adminRole]);
        $moderador->syncRoles([$moderadorRole]);
        $editorNoticia->syncRoles([$editorNoticiaRole]);
        $editorServico->syncRoles([$editorServicoRole]);

    }
}
