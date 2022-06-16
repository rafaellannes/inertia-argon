<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoticiaStoreUpdateRequest;
use App\Models\Noticia;
use App\Models\NoticiaCategoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NoticiaController extends Controller
{
    protected $noticia;
    protected $categoria;

    public function __construct(Noticia $noticia, NoticiaCategoria $categoria)
    {
        $this->noticia = $noticia;
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

        $noticias = $this->noticia::when($request->filter, function ($query, $filter) {
            $query->where('titulo', 'LIKE', '%' . $filter . '%');
        })->with('categoria')->latest()->paginate()->withQueryString();

        return Inertia::render('Admin/Noticias/Index', [
            'noticias' => $noticias,
            'categorias' => $categorias,
        ]);
    }


    public function store(NoticiaStoreUpdateRequest $request)
    {
        $request->merge([
            'user_id' => auth()->id(),
        ]);

        $noticia = $this->noticia->create($request->all());

        return redirect()->route('admin.noticias.index')->with('success', "{$noticia->titulo} cadastrada com sucesso!");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticiaStoreUpdateRequest $request, $id)
    {
        $noticia = $this->noticia->findOrFail($id);

        $noticia->update($request->all());

        return redirect()->route('admin.noticias.index')->with('success', "{$noticia->titulo} atualizada com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = $this->noticia->findOrFail($id);

        $noticia->delete();

        return redirect()->route('admin.noticias.index');
    }
}
