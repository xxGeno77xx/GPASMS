<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MailingListStaff;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\StaffResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\MailingList;
use Filament\Notifications\Notification;
use Ramsey\Uuid\Type\Integer;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("name")
                    ->label(__("Nom")),
                    
                    TextInput::make("phoneNumber")
                    ->label(__("Téléphone"))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Nom")
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    
                    Tables\Actions\BulkAction::make(__("Inclure dans une liste de diffusion"))
                        ->icon("heroicon-o-speaker-wave")
                        ->color(Color::Blue)
                        ->form(self::mailinglistSelect())
                        ->modalSubmitActionLabel(__("Soumettre"))
                        ->action(function (array $data, Collection $selectedRecords):void{

                            $selectedRecords->each(
                                fn (Model $selectedRecord) =>MailingListStaff::firstOrCreate([
                                    "staff_id" => $selectedRecord->id,
                                    "mailing_list_id" => $data["mailingList"],
                                 ]),
                            );

                            Notification::make("added")
                                ->title(__("Inclusion effectuée"))
                                ->body(__("Le personnel sélectionné a été inclus dans la liste de diffusion."))
                                ->icon("heroicon-o-bell")
                                ->color(Color::Blue)
                                ->send();
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }

    public static function mailinglistSelect()
    {
        return [
            Select::make("mailingList")
            ->options(MailingList::pluck("name", "id"))
            ->searchable()
            ->label(__("Liste de diffusion"))
            ->preload()
            ->required()
        ];
    }

}
