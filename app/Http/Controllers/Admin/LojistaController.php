<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LojistaStoreUpdate;
use App\Models\Lojista;
use App\Models\Servico;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LojistaController extends Controller
{

    protected $lojista;
    protected $servico;

    public function __construct(Lojista $lojista, Servico $servico)
    {
        $this->lojista = $lojista;
        $this->servico = $servico;
    }

    public function index(Request $request)
    {
        $servico = $this->servico->where('uuid', $request->uuid)->first();

        if (!$servico)
            return redirect()->back();

        return Inertia::render('Admin/Servicos/Lojistas/Index', [
            'servico' => $servico,
            'lojistas' => $this->lojista::when($request->filter, function ($query, $filter) {
                $query->where('name', 'LIKE', '%' . $filter . '%');
            })->where('servico_id', $servico->id)->latest()->paginate()->withQueryString(),
        ]);
    }


    public function store(LojistaStoreUpdate $request)
    {
        $servico = $this->servico->where('uuid', $request->uuid)->first();

        if (!$servico)
            return redirect()->back();

        $data = $request->all();
        $data['servico_id'] = $servico->id;
        $data['password'] = bcrypt($data['password']);

        $lojista = $this->lojista->create($data);

        return redirect()->route('admin.servico.lojistas.index', ["uuid" => $servico->uuid])->with('success', "{$lojista->name} cadastrado com sucesso!");
    }

    public function update(LojistaStoreUpdate $request, $id)
    {
        $lojista = $this->lojista->findOrFail($id);
        $servico = $this->servico->where('uuid', $request->uuid)->first();

        if (!$servico)
            return redirect()->back();

        $data = $request->only('name', 'email');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $lojista->update($data);

        return redirect()->route('admin.servico.lojistas.index', ["uuid" => $servico->uuid])->with('success', "{$lojista->name} alterado com sucesso!");
    }
}
