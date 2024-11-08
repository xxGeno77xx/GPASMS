<?php

namespace Database\Seeders;

use App\Models\MailingList;
use Illuminate\Database\Seeder;
use App\Enums\MailingListsClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MailingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motives = MailingListsClass::toValues();
    
        foreach ($motives as $key => $name) {
            MailingList::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}
