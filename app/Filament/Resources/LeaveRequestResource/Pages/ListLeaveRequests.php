<?php

namespace App\Filament\Resources\LeaveRequestResource\Pages;

use App\Imports\LeaveRequestImport;
use Filament\Actions;
use Filament\Support\Colors\Color;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use App\Filament\Resources\LeaveRequestResource;
use Illuminate\Database\Eloquent\Collection as Icollection;

class ListLeaveRequests extends ListRecords
{
    protected static string $resource = LeaveRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExcelImportAction::make()
            ->color(Color::Yellow)
            ->use(LeaveRequestImport::class)
            ->label(__("Imorter les  demandes d'absence"))
            ->processCollectionUsing(function (string $modelClass, Icollection $collection) {
              
                return $collection;
            }),
        ];
    }
}
