<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Message;
use App\Enums\StatesClass;
use Illuminate\Support\Str;
use App\Models\LeaveRequest;
use Illuminate\Console\Command;
use App\Filament\Resources\NotificationResource\Pages\CreateNotification;

class LeaveCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check dates for a leave and send recall sms';

    /**
     * Execute the console command.
     */
    public function handle()
    {

       
        $leaveRequests = LeaveRequest::where("status", StatesClass::onGoing()->value)->get();

        if ($leaveRequests->count() == 0) {
            $this->info('No leaves found');
        } else {
            $this->info($leaveRequests->count().' Leaves found');
        }

        foreach ($leaveRequests as $leaveRequest) {

            $staffMember = Staff::find($leaveRequest->staff_id);

            $staffMemberPhone = $staffMember->phoneNumber;
   
            if ($this->startDateCheck($leaveRequest)) {

                $params = $this->setMessageParameters( $leaveRequest);

                CreateNotification::sendSms($params["staffMemberPhone"], $params["message"]);
            }

            if ($this->endDateCheck($leaveRequest)) {

                $params = $this->setMessageParameters( $leaveRequest);

                CreateNotification::sendSms($params["staffMemberPhone"], $params["message"]);

                $leaveRequest->update(["status" => StatesClass::completed()->value]);
            }
        }

    }

    public function startDateCheck(LeaveRequest $leaveRequest): bool
    {
        $startDate = Carbon::parse($leaveRequest->startDate);

        $today = Carbon::parse(today());

        $interval = config("app.interval", 3);
 
        return intval($startDate->diffInDays($today)) == $interval ? true : false;
    }

    public function endDateCheck(LeaveRequest $leaveRequest): bool
    {
        $endDate = Carbon::parse($leaveRequest->endDate);

        $today = Carbon::parse(today());

        $interval = config("app.interval", 3);
 
        return $endDate->diffInDays($today)  == $interval ? true : false;
    }

    function setMessageParameters(LeaveRequest $leaveRequest)
    {
            $staffMember = Staff::find($leaveRequest->staff_id);

            $staffMemberName = $staffMember->name;

            $staffMemberPhone = $staffMember->phoneNumber;

            $startDate = Carbon::parse($leaveRequest->startDate)->format("d/m/y");

            $endDate = Carbon::parse($leaveRequest->endDate)->format("d/m/y");

            $params = [];

            $params = [
                "nom" => $staffMemberName,
                "date_debut" => $startDate,
                "date_fin" =>  $endDate
            ];
            
        $messageTemplate = Message::where("leave_reason_id", $leaveRequest->leave_reason_id)->first();

        preg_match_all('/\[(.*?)\]/', $messageTemplate, $matches);

        // get placeholders in template
        $placeholders = $matches[1];

        $message = $messageTemplate->message;

        // loop through placeholders and replace values
        foreach ($placeholders as $placeholder) {
            // if placeholder found, replace
            if (isset($params[$placeholder])) {
                // replace placeholder
                $message = str_replace("[$placeholder]", $params[$placeholder], $message);
            }
        }

        return [

            "message" => $message,
            "staffMemberName" => $staffMemberName,
            "staffMemberPhone" => $staffMemberPhone
        ] ;
    }
}
