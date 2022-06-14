<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'titulo',
        'descricao',
        'prefeitura_id',
        'noticia_categoria_id',
        'user_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(NoticiaCategoria::class, 'noticia_categoria_id');
    }
}
