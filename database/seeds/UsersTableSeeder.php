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
            'role'              => 'admin'
        ]);

        User::create([
            'name'              => 'DR. 1',
            'email'             => 'doctordev.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'role'              => 'doctor'
        ]);

        User::create([
            'name'              => 'Paciente 1',
            'email'             => 'patient@dev.com',
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'),
            'role'              => 'patient'
        ]);

        factory(User::class, 50)->create();
    }
}
