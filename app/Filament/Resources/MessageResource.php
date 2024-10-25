<?php

namespace App\Filament\Resources;

use App\Models\leaveReason;
use Filament\Forms;
use Filament\Tables;
use App\Models\Message;
use Filament\Forms\Form;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MessageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MessageResource\RelationManagers;
use Illuminate\Support\HtmlString;
use Schmeits\FilamentCharacterCounter\Forms\Components\Textarea;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static ?string $label = "Messages Standardisés";
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make("")
                    ->schema([

                        Textarea::make("message")
                            ->label(__("Contenu"))
                            ->maxLength(130)
                            ->characterLimit(130)
                            ->helperText(new HtmlString("
                                <p>
                                    Pour des messages paramétrés, veuillez saisir les paramètres entre crochets. </br>
                                    Ex: Chèr(e) <i style = 'color:orange ; font-weight:bold'> [nom] </i> , nous tenons à vous rappeler que vos congés débutés le <i style = 'color:orange ; font-weight:bold'> [date_debut] </i>, prendront fin ce <i style = 'color:orange ; font-weight:bold'> [date_fin] </i>. Bonne reprise. 
                                </br>
                                </br>
                                <p>Seuls trois paramètres sont autorisés: <i style = 'color:orange ; font-weight:bold'> [nom] </i>, <i style = 'color:orange ; font-weight:bold'> [date_debut] </i>, et <i style = 'color:orange ; font-weight:bold'> [date_fin] </i> </p>
                                </p>
                                ")),

                        Select::make("leave_reason_id")
                            ->label(__("Motif"))
                            ->options(leaveReason::pluck("label", "id"))
                            ->unique(ignoreRecord:true)
                            ->validationMessages([
                                'unique' => 'Il existe déjà un message pour ce motif',
                            ])
                            ->searchable()

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("message")
                    ->label(__("Contenu")),
                    
                    BadgeColumn::make("motive")
                    ->label(__("Motif"))
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
            ])
            ->modifyQueryUsing(function($query){
                $query->join("leave_reasons", "leave_reasons.id", "messages.leave_reason_id")
                ->select("messages.*", "leave_reasons.label as motive");
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
