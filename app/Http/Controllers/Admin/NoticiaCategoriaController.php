<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Requests\Admin\NoticiaCategoriaStoreUpdate;
use App\Models\NoticiaCategoria;

class NoticiaCategoriaController extends Controller
{
    protected $noticiaCategoria;

    public function __construct(NoticiaCategoria $noticiaCategoria)
    {
        $this->noticiaCategoria = $noticiaCategoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* dd($request->all()); */
        return Inertia::render('Admin/Noticias/Categorias/Index', [
            'categorias' => $this->noticiaCategoria::when($request->filter, function ($query, $filter) {
                $query->where('descricao', 'LIKE', '%' . $filter . '%');
            })->latest()->paginate()->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaCategoriaStoreUpdate $request)
    {
        $data = $request->all();

        $categoria = $this->noticiaCategoria->create($data);

        return redirect()->route('admin.noticias-categoria.index')->with('success', "{$categoria->descricao} cadastrada com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(NoticiaCategoriaStoreUpdate $request, $id)
    {
        $categoria = $this->noticiaCategoria->findOrFail($id);

        $categoria->update($request->all());

        return redirect()->route('admin.noticias-categoria.index')->with('success', "{$categoria->descricao} editada com sucesso!");
    }

    public function destroy($id)
    {
        $categoria = $this->noticiaCategoria->findOrFail($id);
        if ($categoria)
            $categoria->delete();

        return redirect()->route('admin.noticias-categoria.index');
    }
}
