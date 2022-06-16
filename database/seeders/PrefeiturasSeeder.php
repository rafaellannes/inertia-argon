<?php

namespace Database\Seeders;

use App\Models\Prefeitura;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PrefeiturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prefeitura::create([
            'descricao' => 'London',
            'dominio' => 'london.enjoy.com.br',
            'uuid' => Str::uuid(),
        ]);
    }
}
