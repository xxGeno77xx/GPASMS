<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Staff;
use App\Enums\StatesClass;
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

        foreach ($leaveRequests as $leaveRequest) {

            $staffMemberPhone = Staff::find($leaveRequest->staff_id)->phoneNumber;

            if($this->startDateCheck($leaveRequest))
            {
                // $message = Model::where("leave_reason_id", $leaveRequest->leave_reason_id) TODO:: create model and migration for stardardized messages to send on various leave reasons

                // CreateNotification::sendSms($staffMemberPhone, $message);
            }

            if($this->endDateCheck($leaveRequest))
            {
                // $message = Model::where("leave_reason_id", $leaveRequest->leave_reason_id) TODO:: create model and migration for stardardized messages to send on various leave reasons

                // CreateNotification::sendSms($staffMemberPhone, $message);
            }

            if($this->endDateCheck($leaveRequest) && $this->startDateCheck($leaveRequest))
            {
                $leaveRequest->update(["status" => StatesClass::completed()->value]);
            }
        }

        if($leaveRequests->count() == 0)
        {
            $this->info('No leaves found');
        }
        else
        {
            $this->info('Leaves found');
        }
    }

    public function startDateCheck(LeaveRequest $leaveRequest): bool
    {
        $startDate = Carbon::parse($leaveRequest->startDate);

        $today = Carbon::parse(today());

        $interval = config("app.interval", 3);

        return $today - $startDate == $interval ? true : false;
    }

    public function endDateCheck(LeaveRequest $leaveRequest): bool
    {
        $endDate = Carbon::parse($leaveRequest->endDate);

        $today = Carbon::parse(today());

        $interval = config("app.interval", 3);

        return  $endDate - $today == $interval ? true : false;
    }
}
