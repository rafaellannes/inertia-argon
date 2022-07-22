<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServicoStoreUpdate;
use App\Models\Rede;
use App\Models\Servico;
use App\Models\Subcategoria;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicoController extends Controller
{
    protected $servico;
    protected $subcategoria;
    protected $tag;

    public function __construct(Servico $servico, Subcategoria $subcategoria, Tag $tag)
    {
        $this->servico = $servico;
        $this->subcategoria = $subcategoria;
        $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = $this->tag->with('icone')->get();
        $subcategorias  = $this->subcategoria->all();
        $redes = Rede::all();

        $servicos = $this->servico::when($request->filter, function ($query, $filter) {
            $query->where('titulo', 'LIKE', '%' . $filter . '%');
        })->with('subcategoria', 'redes', 'tags')->latest()->paginate()->withQueryString();

        return Inertia::render('Admin/Servicos/Index', [
            'servicos' => $servicos,
            'subcategorias' => $subcategorias,
            'tags' => $tags,
            'redes' => $redes,

        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicoStoreUpdate $request)
    {
        /* dd($request->all()); */
        $request->merge(['user_id' => auth()->id()]);

        $servico = $this->servico->create($request->all());

        $servico->redes()->sync($request->redes);

        $tags = [];
        foreach ($request->tags as $tag) {
            $tags[] =  ['tag_id' => $tag['id']];
        }

        $servico->tags()->sync($tags);

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $servico = $this->servico->findOrFail($id);

        $servico->update($request->all());

        $servico->redes()->sync($request->redes);

        $tags = [];
        foreach ($request->tags as $tag) {
            $tags[] =  ['tag_id' => $tag['id']];
        }

        $servico->tags()->sync($tags);

        return redirect()->route('admin.servicos.index')->with('success', 'Serviço editado com sucesso!');
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
