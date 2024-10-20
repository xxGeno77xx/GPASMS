<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MailingList;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MailingListResource\Pages;
use App\Filament\Resources\MailingListResource\RelationManagers;
use App\Filament\Resources\MailingListResource\RelationManagers\StaffsRelationManager;
use Filament\Tables\Columns\TextColumn;

class MailingListResource extends Resource
{
    protected static ?string $model = MailingList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make("name")
                            ->label(__("Nom de la liste de diffusion"))
                    ]),

                    Self::mailingListMembers("staffs")

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                            ->label(__("Nom de la liste de diffusion"))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StaffsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMailingLists::route('/'),
            'create' => Pages\CreateMailingList::route('/create'),
            'edit' => Pages\EditMailingList::route('/{record}/edit'),
        ];
    }

    public static function mailingListMembers($name)
    {
        return  
            Section::make(__("Concernés"))
            ->hiddenOn("edit")
                ->schema([

                    Select::make("staffs")
                        ->relationship(name: $name, titleAttribute: 'name')
                        ->searchable()
                        ->label(__("Membres du personnel"))
                        ->multiple()
                        ->preload()
                        
                ]);
        
    }
}
