<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Models\Staff;
use Filament\Actions;
use App\Models\Notification;
use Filament\Actions\Action;
use App\Models\MailingListStaff;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\NotificationResource;
use Filament\Notifications\Notification as PushNotification;

class CreateNotification extends CreateRecord
{
    protected static string $resource = NotificationResource::class;

    protected static bool $canCreateAnother = false;

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__("Envoyer"))
            ->icon("heroicon-o-envelope-open")
            ->color(Color::Green)
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

    protected function handleRecordCreation(array $data): Model
    {

        // TODO if insertion in imobile is successful, insert in table here
        
        $message = $data["message"];

        if ($data["grouping"] == false) {

            foreach ($data["staff_id"] as $key => $staffMemberId) {

                $phone = Staff::find($staffMemberId)->phoneNumber;

                if (count($data) > 1) { 
                    if ($key == array_key_last($data["staff_id"])) {

                        Self::sendSms($phone, $message);

                        return Notification::create([
                            "staff_id" => $staffMemberId,
                            "message" => strtoupper($message),
                            "notification_type" => 1
                        ]);
                    }
                    else{ 
                        Notification::create([
                            "staff_id" => $staffMemberId,
                            "message" => strtoupper($message),
                            "notification_type" => 1
                        ]);
                        Self::sendSms($phone, $message);
                    }
                }
                else{

                    Self::sendSms($phone, strtoupper($message));
                    return Notification::create([
                        "staff_id" => $staffMemberId,
                        "message" => strtoupper($message),
                        "notification_type" => 1
                    ]);
                }
                


                Self::sendSms($phone, $message); /*TODO: api integration*/
            }
        } else {

            $concernedStaffMembers = MailingListStaff::where("mailing_list_id", $data["mailing_list_id"])
                ->pluck("staff_id");

            foreach ($concernedStaffMembers as $staffMemberId) {

                $phone = Staff::find($staffMemberId)->phoneNumber;

                $message = $data["message"];

              Self::sendSms($phone, $message); /*TODO: api integration*/
            }

            return Notification::create([
                "mailing_list_id" => $data["mailing_list_id"],
                "message" => strtoupper($message),
                "notification_type" => 1
            ]);
        }
    }

    public static function sendSms($phone, $message)
    {

        try {

            $endpoint = config('app.endpoints.sms_url');

            Http::post($endpoint, [
                'phoneNumber' => "228$phone",
                'message' => strtoupper($message),
            ]);

            PushNotification::make()
                ->body('Les SMS ont été envoyés!!')
                ->title('SMS')
                ->color('primary')
                ->send();
        } catch (\Exception $e) {

            PushNotification::make()
                ->title('Erreur')
                ->body($e->getMessage())
                ->color('danger')
                ->send();
        }
    }
}
