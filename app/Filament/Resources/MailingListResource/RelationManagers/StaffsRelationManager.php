<?php

namespace App\Filament\Resources\MailingListResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\MailingList;
use Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\AttachAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MailingListResource;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class StaffsRelationManager extends RelationManager
{
    protected static string $relationship = 'staffs';

    protected static bool $isLazy = false;

    protected static ?string $title = "Personnel inclus dans cette liste de diffusion";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // 
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->emptyStateDescription(__("Aucun membre du personnel ne fait partie de cette liste de diffusion."))
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__("Nom")),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->label(__("Ajouter des membres du personnel"))->preloadRecordSelect()
                    ->form(fn(AttachAction $action): array => [

                        $action->getRecordSelect()
                            ->multiple(),

                        // TODO: Add additionnal filtering options here
                    ])
                    ->modalSubmitActionLabel(__("Ajouter"))
                    ->modalWidth("7xl")
                    ->modalHeading(__("Ajouter des membres à la liste de diffusion")),
            ])
            ->actions([

                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
