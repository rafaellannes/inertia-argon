<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionStoreUpdate;
use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        $permissions = $this->permission->when($request->filter, function ($query, $filter) {
            $query->where('name', 'LIKE', '%' . $filter . '%');
            $query->orWhere('descricao', 'LIKE', '%' . $filter . '%');
        })
            ->latest()
            ->paginate()
            ->withQueryString();

        return Inertia::render('Admin/Permissions/Index', [
            'permissions' => $permissions,
        ]);
    }

    public function store(PermissionStoreUpdate $request)
    {
        $this->permission->create([
            'name' => $request->name,
            'descricao' => $request->descricao,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão criada com sucesso!');
    }

    public function update(PermissionStoreUpdate $request, $id)
    {

        $this->permission->findOrFail($id)->update([
            'name' => $request->name,
            'descricao' => $request->descricao,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permissão editada com sucesso!');
    }

    public function destroy($id)
    {
        $this->permission->findOrFail($id)->delete();

        return redirect()->route('admin.permissions.index');
    }
}
