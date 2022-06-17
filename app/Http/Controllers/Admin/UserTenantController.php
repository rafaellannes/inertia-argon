<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserTenantController extends Controller
{
    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userLogado = auth()->user()->prefeitura_id;

        $users = $this->user::when($request->filter, function ($query, $filter) {
            $query->where('name', 'LIKE', '%' . $filter . '%');
        })->where('prefeitura_id', $userLogado)->latest()->paginate()->withQueryString();

        return Inertia::render('Admin/Usuarios/Index', [
            'users' => $users,
        ]);
    }


    public function store(UserStoreUpdateRequest $request)
    {
        $request->merge(['prefeitura_id' => auth()->user()->prefeitura_id]);

        $this->user->create($request->all());

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }


    public function update(UserStoreUpdateRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);

        $data = $request->only('name', 'email');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
