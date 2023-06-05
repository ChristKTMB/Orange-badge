<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1,100) as $index){
            $gender = $faker->randomElement(['Hmme', 'Femme']);
            DB::table('badge_requests')->insert([
                'demandeur_nom' => $faker->name($gender),
                'demandeur_prenom' =>  $faker->name($gender),
                'demandeur_directeur' => $faker->name($gender),
                'demandeur_fonction' =>  $faker->name($gender),
                'demandeur_telephone' =>  $faker->numerify('0828863897'),
                'demandeur_matricule' => $faker->unique('082'),
                'date' => $faker->dateTimeBetween('-20 year')->format('Y-m-d'),
                'beneficiaire_nom' => $faker->name($gender),
                'beneficiaire_prenom' => $faker->name($gender),
                'beneficiaire_direction' => $faker->name($gender),
                'beneficiaire_fonction' =>$faker->name($gender),
                'beneficiaire_telephone' => $faker->numerify('0828863897'),
                'beneficiaire_employeur' => $faker->name($gender),
                'beneficiaire_matricule' => $faker->unique('082'),
                'categorie_badge' => $faker->name($gender),
                'date_debut' => $faker->dateTimeBetween('-20 year')->format('Y-m-d'),
                'date_fin' =>$faker->dateTimeBetween('-20 year')->format('Y-m-d') ,
                'motivation' =>$faker->name($gender), ,
                'user_id',
            ]);
        }
    }
}
