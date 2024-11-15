<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Notation;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NotationCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notation:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create notations for staff when time is ripe!!!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get latest notations for every staff member
        $latestNotationsForEveryStaffMember = Notation::whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('notations')
                ->groupBy('staff_id');
        })
            ->get();

        $this->createNotationSheetsBasedOnHireDate();

        $this->createNotationSheetsBasedOnOlderOnes($latestNotationsForEveryStaffMember);


    }

    /**
     * /
     * @param mixed $date
     * @return bool
     * Checks if today  equals last date + 9 months
     */
    private function checkNotationPeriod($date)
    {

        $convertedDate = Carbon::parse($date);

        $nextNotationDate = $convertedDate->addDay();

        return today() == $nextNotationDate ? true : false;
    }

    /**
     * /
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @return void
     */
    private function createNotationSheetsBasedOnOlderOnes(Collection $collection)
    {
        $returnString = " ";

        // Create new notations for staff members based on previous notation Sheets
        if($collection->count() > 0)
        {
            foreach ($collection as $latestNotation) {

                if ($this->checkNotationPeriod($latestNotation->period)) {
    
                    Notation::firstOrCreate([
                        "staff_id" => $latestNotation->staff_id,
                        "period" => today(),
                    ]);
                }
            }
        }
       else

        $returnString = "No need for creation of notation Sheets as there are no newcommers!" ;

        return $this->info($returnString);
    }

    /**
     * /
     * @return void
     */
    private function createNotationSheetsBasedOnHireDate()
    {
        $returnString = " ";
        // Create new notations for staff members based onhire date
        $membersWithoutNotationSheet = Staff::doesntHave('notations')->get();

        if ($membersWithoutNotationSheet->count() > 0) {

            foreach ($membersWithoutNotationSheet as $memberToBeNoted) {

                if ($this->checkNotationPeriod($memberToBeNoted->hireDate)) {
 
                    $convertedHireDate = Carbon::parse($memberToBeNoted->hireDate);

                    Notation::firstOrCreate([
                        "staff_id" => $memberToBeNoted->id,
                        "period" => today(),
                    ]);
                }
            }
            $returnString = "Notation sheets created for newcommers!!";
        }else{
            $returnString = "No need for creation of notation Sheets as there are no newcommers!" ;
        }
        
        

        return $this->info($returnString);
    }


}
