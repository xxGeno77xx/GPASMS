<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables;
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
                // ActionGroup::make([
                //    
                // ])
                 $this->editAction()
            ]);
    }


    private function editAction()
    {
        return Action::make("set")
            ->label(__("Définir les supérieurs"))
            ->form([
                Select::make("lv")
            ]);
    }
}
