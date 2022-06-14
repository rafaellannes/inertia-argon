<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PrefeituraStoreUpdateRequest;
use App\Models\Prefeitura;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrefeituraController extends Controller
{
    protected $prefeitura;

    public function __construct(Prefeitura $prefeitura)
    {
        $this->prefeitura = $prefeitura;
    }

    public function index(Request $request)
    {
        /* dd($request->all()); */
        return Inertia::render('Admin/Prefeituras/Index', [
            'prefeituras' => $this->prefeitura::when($request->filter, function ($query, $filter) {
                $query->where('descricao', 'LIKE', '%' . $filter . '%');
            })->latest()->paginate()->withQueryString(),
        ]);
    }

    public function store(PrefeituraStoreUpdateRequest $request)
    {
        $prefeitura = $this->prefeitura->create($request->all());

        return redirect()->route('admin.prefeituras.index')->with('success', "{$prefeitura->descricao} cadastrada com sucesso!");
    }

    public function update(PrefeituraStoreUpdateRequest $request, Prefeitura $prefeitura)
    {
        $prefeitura->update($request->all());

        return redirect()->route('admin.prefeituras.index')->with('success', "{$prefeitura->descricao} editada com sucesso!");
    }

    public function destroy(Prefeitura $prefeitura)
    {
        if ($prefeitura)
            $prefeitura->delete();

        return redirect()->route('admin.prefeituras.index');
    }

  /*   public function show($id)
    {

    } */
}
