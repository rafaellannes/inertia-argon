<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IconesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icones = [
            [
                'descricao' => 'search',
                'icone' => 'e88a',
                'link_img' => '/assets/img/icons/search.png',
            ],
            [
                'descricao' => 'star',
                'icone' => 'e838',
                'link_img' => '/assets/img/icons/star.png',
            ],
        ];

        foreach ($icones as $icone) {
            \App\Models\Icone::create($icone);
        }
    }
}
