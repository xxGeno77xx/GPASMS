<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\LeaveRequest;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Concerns\ToCollection;

class LeaveRequestImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $dataWithoutHeader = $collection->skip(1);
        
        foreach($dataWithoutHeader as $leaveRequest)
        {
            LeaveRequest::updateOrCreate([
                "staff_id" => $leaveRequest[0],
                "leave_reason_id" => $leaveRequest[1],
                "startDate" =>  Carbon::createFromFormat('d/m/Y',$leaveRequest[2]),
                "endDate" => Carbon::createFromFormat('d/m/Y',$leaveRequest[3]),
                "status" => $leaveRequest[4],
            ]);
        }

        Notification::make("imported")
        ->title(__("Import"))
        ->body(__("Les demandes ont été importées"))
        ->send();
    }
}
