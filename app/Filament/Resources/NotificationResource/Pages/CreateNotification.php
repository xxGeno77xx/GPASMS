<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Models\Staff;
use Filament\Actions;
use App\Static\Unaccent;
use App\Models\Notification;
use Filament\Actions\Action;
use App\Models\MailingListStaff;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\NotificationResource;
use Filament\Notifications\Notification as PushNotification;

class CreateNotification extends CreateRecord
{
    protected static string $resource = NotificationResource::class;
    public function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? __('Envoyer sms');
    }



    protected static bool $canCreateAnother = false;

    public function getTitle(): string | Htmlable
    {
        return __('Envoyer un SMS',  );
    }
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
        
        $message = $data["message"];

        if ($data["grouping"] == false) {

            foreach ($data["staff_id"] as $key => $staffMemberId) {

                $phone = Staff::find($staffMemberId)->phoneNumber;

                if (count($data) > 1) { 
                    if ($key == array_key_last($data["staff_id"])) {

                        Self::sendSms($phone, $message);

                        return Notification::create([
                            "staff_id" => $staffMemberId,
                            "message" => strtoupper(Unaccent::unaccent($message)),
                            "notification_type" => 1
                        ]);
                    }
                    else{ 
                        Notification::create([
                            "staff_id" => $staffMemberId,
                            "message" => strtoupper(Unaccent::unaccent($message)),
                            "notification_type" => 1
                        ]);
                        Self::sendSms($phone, $message);
                    }
                }
                else{

                    Self::sendSms($phone, strtoupper($message));
                    return Notification::create([
                        "staff_id" => $staffMemberId,
                        "message" => strtoupper(Unaccent::unaccent($message)),
                        "notification_type" => 1
                    ]);
                }
                


                Self::sendSms($phone, $message);  
            }
        } else {

            $concernedStaffMembers = MailingListStaff::where("mailing_list_id", $data["mailing_list_id"])
                ->pluck("staff_id");

            foreach ($concernedStaffMembers as $staffMemberId) {

                $phone = Staff::find($staffMemberId)->phoneNumber;

                $message = $data["message"];

              Self::sendSms($phone, $message);  
            }

            return Notification::create([
                "mailing_list_id" => $data["mailing_list_id"],
                "message" => strtoupper(Unaccent::unaccent($message)),
                "notification_type" => 1
            ]);
        }
    }

    public static function sendSms($phone, $message)
    {

        try {

            $endpoint = config('app.endpoints.sms_url');

            Http::post($endpoint, [
                'phoneNumber' => "$phone",
                'message' => strtoupper( Unaccent::unaccent($message)),
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
