<?php

namespace App\Observers;

use App\Models\Prefeitura;
use Illuminate\Support\Str;

class PrefeituraObserver
{
    public function creating(Prefeitura $prefeitura)
    {
        $prefeitura->uuid = Str::uuid();
    }
}
