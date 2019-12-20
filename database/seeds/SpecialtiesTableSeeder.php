<?php

use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $specialties = [
            'Oftalmologia',
            'Pedriatria',
            'Neurologia'
        ];

        foreach ($specialties as $specialty){
            \App\Specialty::create([
                'name' => $specialty
            ]);
        }

    }
}
