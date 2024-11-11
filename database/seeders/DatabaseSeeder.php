<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MailingListSeeder;
use Database\Seeders\RolesPermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesPermissionSeeder::class,
            LeaveMotivesSeeder::class,
            MailingListSeeder::class
        ]);
    }
}
