<?php

namespace Database\Seeders;

use App\Enums\PostesClass;
use App\Models\Poste;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $postes = PostesClass::toValues();
    
        foreach ($postes as $key => $name) {
            Poste::firstOrCreate([
                'label' => $name,
            ]);
        }//
    }
}
