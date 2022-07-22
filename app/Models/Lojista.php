<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lojista extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'prefeitura_id',
        'servico_id',
        'name',
        'email',
        'password',
        'profile_photo_path',

    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
}
