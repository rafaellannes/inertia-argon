<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreUpdate;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    protected $role;
    protected $permissions;

    public function __construct(Role $role, Permission $permissions)
    {
        $this->role = $role;
        $this->permissions = $permissions;
    }

    public function index(Request $request)
    {
        $permissions = $this->permissions->all();
        $roles = $this->role->when($request->filter, function ($query, $filter) {
            $query->where('name', 'LIKE', '%' . $filter . '%');
        })
            ->with('permissions')
            ->latest()
            ->paginate()
            ->withQueryString();

        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(RoleStoreUpdate $request)
    {

        $role = $this->role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        if ($request->has('permissions')) {
            $role->givePermissionTo(collect($request->permissions)->pluck('id')->toArray());
        }

        return redirect()->route('admin.roles.index')->with('success', 'Registro criado com sucesso!');
    }

    public function update(RoleStoreUpdate $request, $id)
    {
        $role = $this->role->findOrFail($id);

        $role->syncPermissions(collect($request->permissions)->pluck('id')->toArray());
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.roles.index')->with('success', 'Registro editado com sucesso!');
    }

    public function destroy($id)
    {
        $role = $this->role->findOrFail($id);
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Registro excluído com sucesso!');
    }
}
