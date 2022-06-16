<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServicoCategoriaStoreUpdate;
use App\Models\Icone;
use App\Models\ServicoCategoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicoCategoriaController extends Controller
{
    protected $categoria;

    public function __construct(ServicoCategoria $categoria)
    {
        $this->categoria = $categoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $icones = Icone::all();
        $categorias = $this->categoria::when($request->filter, function ($query, $filter) {
            $query->where('descricao', 'LIKE', '%' . $filter . '%');
        })->with('icone')->latest()->paginate()->withQueryString();

        return Inertia::render('Admin/Servicos/Categorias/Index', [
            'categorias' => $categorias,
            'icones' => $icones,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicoCategoriaStoreUpdate $request)
    {

        $data = $request->only('descricao');

        $data['icone_id'] = $request->icone['id'];
        $categoria = $this->categoria->create($data);

        return redirect()->route('admin.servicos-categoria.index')->with('success', "{$categoria->descricao} cadastrada com sucesso!");
    }


    public function update(Request $request, $id)
    {

        $categoria = $this->categoria->findOrFail($id);

        $data = $request->only('descricao');
        $data['icone_id'] = $request->icone['id'];

        $categoria->update($data);

        return redirect()->route('admin.servicos-categoria.index')->with('success', "{$categoria->descricao} atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = $this->categoria->findOrFail($id);

        $categoria->delete();

        return redirect()->route('admin.servicos-categoria.index');
    }
}
