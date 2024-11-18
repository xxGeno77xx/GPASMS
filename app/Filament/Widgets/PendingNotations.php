<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables;
use App\Models\Staff;
use App\Models\Notation;
use Filament\Tables\Table;
use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\Action;
use function Laravel\Prompts\select;

use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingNotations extends BaseWidget
{
    protected static ?string $heading = "Notation non assignées à la hiérarchie";

    protected static ?int $sort = 2;

    protected  array|string|int $columnSpan = "full";

    public function table(Table $table): Table
    {

        return $table
            ->query(
                Notation::join("staff", "staff.id", "notations.staff_id")
                    ->whereNull("firstValidator")
                    ->whereNull("secondValidator")
                // ->whereNull("thirdValidator")
            )
            ->columns([
                TextColumn::make("name")
                    ->label(__("Nom de l'employé")),

                TextColumn::make("period")
                    ->label("Période")
                    ->formatStateUsing(fn($state) => "Période de " . Carbon::parse($state)->translatedFormat("M Y") . " à " . Carbon::parse($state)->addMonths(9)->translatedFormat("M Y"))
                    ->badge()
            ])
            ->actions([
         
                $this->editAction()

            ]);
    }


    private function editAction()
    {
        return Action::make("set")
            ->label(__("Définir les supérieurs"))
            ->form(function($record){
                
                return 
                    [
                        Select::make("immediate_chief")
                            ->label(__("Chef immédiat"))
                            ->options(Staff::whereNotIn("id", [$record->staff_id])->pluck("name", "id")),
        
                        Select::make("chief_a")
                            ->label(__("Chef hiérarchique niveau 1"))
                            ->options(Staff::whereNotIn("id", [$record->staff_id])->pluck("name", "id")),
        
                        Select::make("chief_b")
                            ->label(__("Chef hiérarchique niveau 2"))
                            ->options(Staff::whereNotIn("id", [$record->staff_id])->pluck("name", "id"))
                    ];
                
            })
            ->action(fn($record, $data) => $record ->update([
                "firstValidator" => $data["immediate_chief"],
                "secondValidator" => $data["chief_a"],
                // "thirdValidator" => $data["chief_b"],
            ]))
            ->requiresConfirmation();
    }
}
