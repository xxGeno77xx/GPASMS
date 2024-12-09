<?php

namespace App\Filament\Resources\StaffResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use App\Models\Notation;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Radio;

use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Guava\FilamentClusters\Forms\Cluster;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Split;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class NotationsRelationManager extends RelationManager
{
    protected static string $relationship = 'notations';

    public function form(Form $form): Form
    {
        return $form

            ->schema(NotationsRelationManager::notationForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('period')
                ->label("Période")
                ->formatStateUsing(fn($state) => "Période de " . Carbon::parse($state)->translatedFormat("M Y") . " à " . Carbon::parse($state)->addMonths(9)->translatedFormat("M Y")),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make()
                // ->label(__("Créer une fiche de notation l'employé"))
                // ->modalWidth('7xl')
                // ->modalHeading("Notation de l'employé"),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label(__("Attribuer les notes"))
                        ->modalWidth("7xl")
                        ->modalHeading(function ($record) {

                            $staffMemberName = Staff::find($record->staff_id)->name;

                            return "Notes de " . $staffMemberName . " à la période de " . Carbon::parse($record->period)->translatedFormat("M Y") . " à " . Carbon::parse($record->period)->addMonths(9)->translatedFormat("M Y");
                        }),

                    Self::sheetAction(),
                    // Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function notationForm()
    {
        return [

            DatePicker::make("period")
                ->label("Période du au..."),

            Section::make(new HtmlString("
            <span style ='padding-left: 325pt'>Chef immédiat</span>
        <span style ='padding-left: 100pt'>Chef hiérarchique suivant(1)</span>
        <span style ='padding-left: 30pt'>Chef hiérarchique suivant(2)</span>
            "))
                ->schema([

                    Cluster::make([

                        TextInput::make("assiduite1")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->firstValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("assiduite2")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->secondValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("assiduite3")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->thirdValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),

                    ])
                        ->inlineLabel()
                        ->label(__("Assiduité et disponibilité")),

                    Cluster::make([

                        TextInput::make("commerciale1")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->firstValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("commerciale2")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->secondValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("commerciale3")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->thirdValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),

                    ])
                        ->inlineLabel()
                        ->label(__("Capacité commerciale, d’initiative et de créativité")),

                    Cluster::make([

                        TextInput::make("connaissance1")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->firstValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("connaissance2")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->secondValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("connaissance3")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->thirdValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),

                    ])
                        ->inlineLabel()
                        ->label(__("Connaissance et conscience professionnelles")),

                    Cluster::make([

                        TextInput::make("encadrement1")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->firstValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("encadrement2")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->secondValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("encadrement3")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->thirdValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),

                    ])
                        ->inlineLabel()
                        ->label(__("Capacité d'encadrer et de travailler en groupe")),

                    Cluster::make([

                        TextInput::make("promptitude1")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->firstValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("promptitude2")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->secondValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),
                        TextInput::make("promptitude3")
                        ->numeric()
                        ->disabled(fn($record) => auth()->user()->id == $record->thirdValidator? false : true)
                        ->maxValue(5)
                        ->minValue(1),

                    ])
                        ->inlineLabel()
                        ->label(__("Promptitude a rendre compte et à transmettre les ordres")),
                ])
        ];
    }



    public static function sheetAction()
    {
        return Action::make("sheet")
            ->label("Fiche de notation")
            // ->modalDescription("Voulez vous imprimer la fiche ou l'envoyer par mail?")
            // ->form([
            //     Radio::make("choice")
            //         ->label("")
            //         ->options([
            //             "Mail" => "Envoyer par Mail",
            //             "Print" => "Imprimer"
            //         ])->inline()
            // ])
            // ->modalAlignment(Alignment::Left)
            ->icon("heroicon-o-envelope")
            // ->requiresConfirmation()
            ->url(fn($record) => route('notationSheet.generate', $record))
            ->openUrlInNewTab()
            // ->action(function(Notation $record, $data, $action){

            //     if($data["choice"] == "Mail")
            //     {

            //     }
            //     else{

            //        return  redirect()->route('notationSheet.generate', $record);
            //     }

            // });;*
        ;
    }
}
