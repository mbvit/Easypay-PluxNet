<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EasyPayResource\Pages;
use App\Filament\Resources\EasyPayResource\RelationManagers;
use App\Models\EasyPay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EasyPayResource extends Resource
{
    protected static ?string $model = EasyPay::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customerId')
                    ->relationship('customer', 'id')	
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('splynx_id')
                    ->required(),
                Forms\Components\TextInput::make('easypay_number')
                    ->required(),
                Forms\Components\TextInput::make('reciever_id')
                    ->required(),
                Forms\Components\TextInput::make('charachter_length')
                    ->required(),
                Forms\Components\TextInput::make('check_digit')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customerId')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('splynx_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('easypay_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reciever_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('charachter_length')
                    ->searchable(),
                Tables\Columns\TextColumn::make('check_digit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEasyPays::route('/'),
            'create' => Pages\CreateEasyPay::route('/create'),
            'edit' => Pages\EditEasyPay::route('/{record}/edit'),
        ];
    }
}
