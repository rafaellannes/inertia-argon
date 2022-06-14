<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreUpdateRequest;
use App\Models\Prefeitura;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $prefeitura;
    protected $user;

    public function __construct(Prefeitura $prefeitura, User $user)
    {
        $this->prefeitura = $prefeitura;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pref = $this->prefeitura->where('uuid', $request->uuid)->first();

        if (!$pref)
            return redirect()->back();

        return Inertia::render('Admin/Prefeituras/Usuarios/Index', [
            'prefeitura' => $pref,
            'users' => $this->user::when($request->filter, function ($query, $filter) {
                $query->where('name', 'LIKE', '%' . $filter . '%');
            })->where('prefeitura_id', $pref->id)->latest()->paginate()->withQueryString(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreUpdateRequest $request)
    {
        $pref = $this->prefeitura->where('uuid', $request->uuid)->first();

        if (!$pref)
            return redirect()->back();

        $data = $request->all();
        $data['prefeitura_id'] = $pref->id;
        $data['password'] = bcrypt($data['password']);

        $user = $this->user->create($data);

        return redirect()->route('admin.prefeitura.usuarios.index', ["uuid" => $pref->uuid])->with('success', "{$user->name} cadastrada com sucesso!");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreUpdateRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $pref = $this->prefeitura->where('uuid', $request->uuid)->first();

        if (!$pref)
            return redirect()->back();

        $data = $request->only('name', 'email');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.prefeitura.usuarios.index', ["uuid" => $pref->uuid])->with('success', "{$user->name} alterado com sucesso!");
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
