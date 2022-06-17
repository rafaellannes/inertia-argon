<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagStoreUpdate;
use App\Models\Icone;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function index(Request $request)
    {
        $icones = Icone::all();
        $tags = $this->tag::when($request->filter, function ($query, $filter) {
            $query->where('descricao', 'LIKE', '%' . $filter . '%');
        })->with('icone')->latest()->paginate()->withQueryString();

        return Inertia::render('Admin/Servicos/Tags/Index', [
            'tags' => $tags,
            'icones' => $icones,
        ]);
    }

    public function store(TagStoreUpdate $request)
    {
        $request->only('descricao');
        $request->merge(['icone_id' => $request->icone['id']]);

        $this->tag->create($request->all());

        return redirect()->route('admin.tags.index')->with('success', 'Tag criada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $tag = $this->tag->findOrFail($id);

        $request->only('descricao');
        $request->merge(['icone_id' => $request->icone['id']]);

        $tag->update($request->all());

        return redirect()->route('admin.tags.index')->with('success', 'Tag atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $tag = $this->tag->findOrFail($id);

        $tag->delete();

        return redirect()->route('admin.tags.index');
    }
}
