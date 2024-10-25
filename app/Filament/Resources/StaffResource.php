<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MailingList;
use Ramsey\Uuid\Type\Integer;
use App\Models\MailingListStaff;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\StaffResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StaffResource\RelationManagers;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;
use App\Filament\Resources\NotificationResource\Pages\CreateNotification;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;
    protected static ?string $label = "Membres du personnel";
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make("Informations ")
                    ->schema([
                        TextInput::make("name")
                            ->label(__("Nom"))
                            ->required(),

                        TextInput::make("phoneNumber")
                            ->label(__("Téléphone"))
                            ->required(),

                        DatePicker::make("birthDate")
                            ->label(__("Date de naissance"))
                            ->displayFormat("d/m/y")
                            ->required()
                    ])
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
                        ->action(function (array $data, Collection $selectedRecords): void {

                            $selectedRecords->each(
                                fn(Model $selectedRecord) => MailingListStaff::firstOrCreate([
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

                        Tables\Actions\BulkAction::make("individual")
                        ->label(__("Envoyer un ". strtoupper(__("sms"))))
                        ->icon("heroicon-o-envelope-open")
                        ->color(Color::Blue)
                        ->form(self::individualSms())
                        ->modalSubmitActionLabel(__("Soumettre"))
                        ->action(function (array $data, Collection $selectedRecords): void {

                            
                            $selectedRecords->each(
                                fn(Model $selectedRecord) => CreateNotification::sendSms($selectedRecord->phoneNumber, $data["message"]),
                            );

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

    public static function individualSms()
    {
        return [
            Textarea::make("message")
                ->label(__("Contenu"))
                ->required()
                ->maxLength(160)
                ->characterLimit(160)
        ];
    }
}
