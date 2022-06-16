<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoriaStoreUpdate;
use App\Models\ServicoCategoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubCategoriaController extends Controller
{
    protected $subcategoria;
    protected $categoria;

    public function __construct(Subcategoria $subcategoria, ServicoCategoria $categoria)
    {
        $this->subcategoria = $subcategoria;
        $this->categoria = $categoria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = $this->categoria->all();

        $subcategorias = $this->subcategoria::when($request->filter, function ($query, $filter) {
            $query->where('descricao', 'LIKE', '%' . $filter . '%');
        })->with('categoria')->latest()->paginate()->withQueryString();


        return Inertia::render('Admin/Servicos/Subcategorias/Index', [
            'subcategorias' => $subcategorias,
            'categorias' => $categorias,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoriaStoreUpdate $request)
    {
        $this->subcategoria->create($request->all());

        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoria criada com sucesso!');
    }


    public function update(Request $request, $id)
    {
        $subcategoria = $this->subcategoria->findOrFail($id);
        $subcategoria->update($request->all());

        return redirect()->route('admin.subcategorias.index')->with('success', 'Subcategoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategoria = $this->subcategoria->findOrFail($id);
        $subcategoria->delete();

        return redirect()->route('admin.subcategorias.index');
    }
}
