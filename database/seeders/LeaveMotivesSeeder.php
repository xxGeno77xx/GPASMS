<?php

namespace Database\Seeders;

use App\Models\leaveReason;
use Illuminate\Database\Seeder;
use App\Enums\LeaveMotivesClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaveMotivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motives = LeaveMotivesClass::toValues();
    
            foreach ($motives as $key => $name) {
                leaveReason::firstOrCreate([
                    'label' => $name,
                ]);
            }
    }
}
