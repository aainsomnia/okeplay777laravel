<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use App\Models\Us_Users;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'user_fname' => 'Teuku Adly',
                'user_email' => 'takasinasi@gmail.com',
                'user_password' => Hash::make('takasinasi'),
                'user_created' => date('Y-m-d H:i:s')
            ],
            [
                'user_fname' => 'developer',
                'user_email' => 'dev@admin.com',
                'user_password' => Hash::make('123456'),
                'user_created' => date('Y-m-d H:i:s')

            ]
        ];

        foreach ($user as $dt) {
            Us_Users::create($dt);
        }
    }
}
