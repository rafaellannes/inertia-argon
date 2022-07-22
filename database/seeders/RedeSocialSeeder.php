<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rede;

class RedeSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $redes = [
            [
                'descricao' => 'Facebook',
            ],
            [
                'descricao' => 'Instagram',

            ],
            [
                'descricao' => 'Twitter',

            ],
            [
                'descricao' => 'Youtube',

            ],
            [
                'descricao' => 'Whatsapp',

            ],

            [
                'descricao' => 'Site',

            ],

        ];

        foreach ($redes as $rede) {
            Rede::create($rede);
        }
    }
}
