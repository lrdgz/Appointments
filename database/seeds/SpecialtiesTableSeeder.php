<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Specialty;

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

        foreach ($specialties as $specialtyNAme){

            $specialty = Specialty::create([
                'name' => $specialtyNAme
            ]);

            //save -> un modelo
            //saveMany -> colleccion de modelos

            $specialty->users()->saveMany(
                factory(User::class, 3)->state('doctor')->make()
            );
        }

        //Buscamos el medico (Test)
        User::find(2)->specialties()->save($specialty);

    }
}
