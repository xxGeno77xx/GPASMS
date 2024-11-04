<?php

namespace App\Filament\Resources\StaffResource\Pages;

use Filament\Actions;
use App\Imports\StaffImport;
use Filament\Support\Colors\Color;
use App\Filament\Resources\StaffResource;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use Illuminate\Database\Eloquent\Collection as Icollection;

class ListStaff extends ListRecords
{
    protected static string $resource = StaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label(__("Ajouter un membre du personnel")),

            ExcelImportAction::make()
            ->color(Color::Amber)
            ->use(StaffImport::class)
            ->label(__("Imorter les membres du personnel"))
            ->processCollectionUsing(function (string $modelClass, Icollection $collection) {
              
                return $collection;
            }),
        ];
    }
}
