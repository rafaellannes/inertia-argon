<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        dd($request->all());
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
