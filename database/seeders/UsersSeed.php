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
        $users = [
            [
                "name" => "Administrador",
                "email" => "enjoy@enjoy.com",
                "password" => bcrypt("@enjoy01"),
                "prefeitura_id" => null,
                "isAdmin" => true,

            ],
            [
                'name' => 'Funcionário London',
                'email' => 'london@london.com',
                'password' => bcrypt("@enjoy01"),
                'prefeitura_id' => 1,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
