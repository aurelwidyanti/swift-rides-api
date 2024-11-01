<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('car_id')
                    ->relationship('car', 'name')
                    ->required()
                    ->label('Car'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('User'),

                Forms\Components\DateTimePicker::make('start_date')
                    ->required()
                    ->label('Start Date'),

                Forms\Components\DateTimePicker::make('end_date')
                    ->required()
                    ->label('End Date'),

                Forms\Components\TextInput::make('total_price')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        $car = $get('car_id');
                        $start = $get('start_date');
                        $end = $get('end_date');

                        if ($car && $start && $end) {
                            $start = \Carbon\Carbon::parse($start);
                            $end = \Carbon\Carbon::parse($end);
                            $days = $end->diffInDays($start);

                            if ($days > 0) {
                                $set('total_price', $car->price * $days);
                            }
                        }
                    })
                    ->label('Total Price')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'canceled' => 'Canceled',
                        'completed' => 'Completed',
                    ])->default('pending'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car.name')->label('Car'),
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('start_date')->label('Start Date')->dateTime(),
                Tables\Columns\TextColumn::make('end_date')->label('End Date')->dateTime(),
                Tables\Columns\TextColumn::make('total_price')->label('Total Price'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
