<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Staff;
use Illuminate\Console\Command;
use App\Filament\Resources\NotificationResource\Pages\CreateNotification;

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
        $concerned = Staff::get()->filter(fn($item, $key) => Carbon::parse($item->birthDate)->format("d/m") == Carbon::today()->format("d/m"));

        $message = config("app.StandardMessages.birthday", " ");

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
