<?php

namespace App\Filament\Resources\MessageResource\Pages;

use Filament\Actions;
use App\Static\Unaccent;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\MessageResource;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data["message"] = strtoupper(Unaccent::unaccent($data["message"])); 
        
        return $data;
    }
}
