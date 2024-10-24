<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\LeaveReason;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LeaveReasonResource\Pages;
use App\Filament\Resources\LeaveReasonResource\RelationManagers;

class LeaveReasonResource extends Resource
{
    protected static ?string $model = LeaveReason::class;
    protected static ?string $label = "Motifs d'absence";
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("")
                    ->schema([
                        Select::make("label")
                            ->label(__("Intitulé du motif"))
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("label")
                    ->label(__("Intitulé"))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListLeaveReasons::route('/'),
            'create' => Pages\CreateLeaveReason::route('/create'),
            'edit' => Pages\EditLeaveReason::route('/{record}/edit'),
        ];
    }
}
