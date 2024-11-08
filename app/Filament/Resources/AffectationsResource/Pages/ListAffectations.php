<?php

namespace App\Filament\Resources\AffectationsResource\Pages;

use App\Filament\Resources\AffectationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAffectations extends ListRecords
{
    protected static string $resource = AffectationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
