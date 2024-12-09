<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MailingList;
use App\Models\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    protected static ?string $label = "Envois de sms";

    protected static ?string $navigationGroup = "Messagerie";

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::smsForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("message"),

                TextColumn::make("mailing_list")
                    ->label(__("Liste de diffusion"))
                    ->placeholder("-"),

                TextColumn::make("staff_name")
                    ->label(__("Destinataire"))
                    ->placeholder("-"),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {

                return $query->leftJoin('mailing_lists', 'mailing_lists.id', '=', 'notifications.mailing_list_id')
                    ->leftJoin('staff', 'staff.id', '=', 'notifications.staff_id')
                    ->select(['notifications.*', 'staff.name as staff_name', 'mailing_lists.name as mailing_list']);
            });
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            // 'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }

    public static function smsForm()
    {
        return [
            Section::make("")
                ->schema([

                    Toggle::make("grouping")
                        ->label(__("Message diffusé"))
                        ->onIcon("heroicon-o-user-group")
                        ->onColor(Color::Green)
                        ->offIcon("heroicon-o-user")
                        ->offColor(Color::Red)
                        ->live(),

                    Select::make("mailing_list_id")
                        ->label(__("Liste de diffusion"))
                        ->options(MailingList::pluck("name", "id"))
                        ->searchable()
                        ->visible(fn($get) => $get("grouping") ? true : false)
                        ->required(fn($get) => $get("grouping") ? true : false),

                    Select::make("staff_id")
                        ->label(__("Membres du personnel"))
                        ->options(Staff::pluck("name", "id"))
                        ->searchable()
                        ->multiple()
                        ->visible(fn($get) => $get("grouping") ? false : true)
                        ->required(fn($get) => $get("grouping") ? false : true),

                    Textarea::make('message')
                        ->columnSpanFull()
                        ->required()
                        ->maxLength(160)
                        ->characterLimit(160)
                        ->showInsideControl(true),
                ])
        ];
    }
}
