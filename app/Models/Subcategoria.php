<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'descricao',
        'categoria_id',
        'prefeitura_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(ServicoCategoria::class, 'categoria_id');
    }
}
