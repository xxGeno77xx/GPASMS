<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Staff;
use Filament\Forms\Form;
use App\Enums\StatesClass;
use Filament\Tables\Table;
use App\Models\leaveReason;
use App\Models\LeaveRequest;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LeaveRequestResource\Pages;
use App\Filament\Resources\LeaveRequestResource\RelationManagers;

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $label = "Demandes d'absence";
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make("")
                    ->schema([

                        Grid::make(2)
                            ->schema([
                                Select::make("staff_id")
                                    ->searchable()
                                    ->label(__("Nom du personnel"))
                                    ->options(Staff::pluck("name", "id")),

                                Select::make("leave_reason_id")
                                    ->searchable()
                                    ->label(__("Motif"))
                                    ->options(leaveReason::pluck("label", "id")),

                                DatePicker::make("startDate")
                                    ->label(__("Date de début")),

                                DatePicker::make("endDate")
                                    ->label(__("Date de fin"))
                                    ->after("startDate"),
                            ]),



                        Hidden::make("status")->default(StatesClass::onGoing()->value)
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("staff"),

                TextColumn::make("motif"),

                BadgeColumn::make("startDate")
                    ->date("d. M Y")
                    ->color(Color::Green)
                    ->label("Date début"),

                BadgeColumn::make("endDate")
                    ->date("d. M Y")
                    ->color(Color::Red)
                    ->label("Date fin"),
                 
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
            ])
            ->modifyQueryUsing(function($query){
                $query->join("staff", "staff.id", "leave_requests.staff_id")
                ->join("leave_reasons", "leave_reasons.id", "leave_requests.leave_reason_id")
                ->select("leave_requests.*", "leave_reasons.label as motif", "staff.name as staff");
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
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
        ];
    }
}
