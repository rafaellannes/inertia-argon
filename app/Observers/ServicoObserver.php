<?php

namespace App\Observers;

use App\Models\Servico;
use Illuminate\Support\Str;

class ServicoObserver
{
    public function creating(Servico $servico)
    {
        $servico->uuid = Str::uuid();
    }
}
