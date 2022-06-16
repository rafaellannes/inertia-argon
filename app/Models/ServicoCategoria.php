<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoCategoria extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'descricao',
        'icone_id',
        'prefeitura_id',
    ];

    public function icone()
    {
        return $this->belongsTo(Icone::class);
    }
}
