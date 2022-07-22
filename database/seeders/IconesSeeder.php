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
                'link_img' => '/assets/img/icons/search.png',
            ],
            [
                'descricao' => 'star',
                'link_img' => '/assets/img/icons/star.png',
            ],

            [
                'descricao' => 'home',
                'link_img' => '/assets/img/icons/home.png',
            ],
        ];

        foreach ($icones as $icone) {
            \App\Models\Icone::create($icone);
        }
    }
}
