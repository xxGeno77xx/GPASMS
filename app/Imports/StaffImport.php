<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Staff;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Concerns\ToCollection;

class StaffImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //skipping header
        $dataWithoutHeader = $collection->skip(1);
        
        foreach($dataWithoutHeader as $staffMember)
        {
            Staff::updateOrCreate([
                "name" => $staffMember[1],
                "phoneNumber" => "228".$staffMember[2],
                // "birthDate" =>  Carbon::createFromFormat('d/m/Y',$staffMember[2]),
                // "endDate" => Carbon::createFromFormat('d/m/Y',$staffMember[3]),
                // "status" => $staffMember[4],
            ]);
        }

        Notification::make("imported")
        ->title(__("Import"))
        ->body(__("La liste du personnel a été mise à jour."))
        ->send();
    }
}
