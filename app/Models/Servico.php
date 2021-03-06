<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'titulo',
        'descricao',
        'contato',
        'endereco',
        'latitude',
        'longitude',
        'prefeitura_id',
        'subcategoria_id',
        'user_id',
        'ativo',
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'servico_tag');
    }

    public function redes()
    {
        return $this->belongsToMany(Rede::class, 'servico_rede')->withPivot('link');
    }
}
