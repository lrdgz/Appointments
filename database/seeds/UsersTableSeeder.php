<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        User::create([
            'name'              => 'Luis',
            'email'             => 'dev@dev.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'remember_token'    =>  '',
            'dni'               => '12345678',
            'address'           => 'test dir',
            'phone'             => '8292635555',
            'role'              => 'admin'
        ]);

        factory(User::class, 50)->create();
    }
}
