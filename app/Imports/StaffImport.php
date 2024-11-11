<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Affectation;
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
                "legacy_id" => $staffMember[1],
                "name" => $staffMember[2],
                "gender" => $staffMember[3],
                // "birthDate" =>  Carbon::createFromFormat('d/m/Y',$staffMember[4]),
                "affectation_id" => Affectation::where("libelle", $staffMember[6])->first()->id,
                "group" => $staffMember[7],
                "function" => $staffMember[8],
                // "phoneNumber" => "228".$staffMember[2],
            ]);
        }

        Notification::make("imported")
        ->title(__("Import"))
        ->body(__("La liste du personnel a été mise à jour."))
        ->send();
    }
}
