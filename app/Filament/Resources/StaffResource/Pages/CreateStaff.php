<?php

namespace App\Filament\Resources\StaffResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use App\Filament\Resources\StaffResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;

    protected function getCreateFormAction(): Action
    {
        return Action::make('create')
            ->label(__("Ajouter"))
            ->icon("heroicon-o-user-plus")
            ->color(Color::Green)
            ->submit('create')
            ->keyBindings(['mod+s']);
    }

 
}
