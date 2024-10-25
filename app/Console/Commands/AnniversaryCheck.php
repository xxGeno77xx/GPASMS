<?php

namespace App\Console\Commands;

use App\Filament\Resources\NotificationResource\Pages\CreateNotification;
use App\Models\Staff;
use Illuminate\Console\Command;

class AnniversaryCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'anniversary:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check staff anniversary dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $concerned = Staff::whereDate("birthDate", today())->get();

        $message = config("app.StandardMessages", " ");

        if($concerned->count() >= 1)
        {
            $this->info('Anniversaries found');

            foreach($concerned as $birthdayPerson)
            {
                $phone = $birthdayPerson->phoneNumber;

                CreateNotification::sendSms($phone, $message);
            }
        }

        else
        {
            $this->info('No anniversaries found');
        }
    }
}
