<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "prefeitura_id" => null,
            "isAdmin" => true,
            "name" => "Administrador",
            "email" => "enjoy@enjoy.com.br",
            "password" => bcrypt("@enjoy01")
        ]);
    }
}
