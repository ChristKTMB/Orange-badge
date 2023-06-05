<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\approving;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ApprovingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         Approving::truncate();
    
        approving::create([
            'name' =>'espoir',
            'approving' => 'kakesa'
        ]);
    
    }
}
