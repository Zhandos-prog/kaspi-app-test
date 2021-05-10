<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'Руководитель',
                'email'=>'ruk1@kaspi.kz',
                'password'=>Hash::make('WENYNymm34'),
                'remember_token'=>null,
            ],
            [
                'name' => 'Руководитель',
                'email'=>'ruk2@kaspi.kz',
                'password'=>Hash::make('WENYNymm34'),
                'remember_token'=>null,
            ],
            [
                'name' => 'Администратор',
                'email'=>'admin@kaspi.kz',
                'password'=>Hash::make('WENYNymm34'),
                'remember_token'=>null,
            ],
        ];
        foreach ($users as $user) {
            User::create($user)->each(function ($user) {
                if($user->name === 'Администратор') {
                    $user->assignRole('admin');
                }else {
                    $user->assignRole('user');
                }
            });
        }

    }
}
