<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SucursalEstatusResource\Pages;
use App\Filament\Resources\SucursalEstatusResource\RelationManagers;
use App\Models\SucursalEstatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SucursalEstatusResource extends Resource
{
    protected static ?string $model = SucursalEstatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_sucursal')
                    ->label('ID Sucursal')
                    ->numeric()
                    ->required(),

                Forms\Components\Toggle::make('caja_abierta')
                    ->label('Caja Abierta')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_sucursal'),
                Tables\Columns\ToggleColumn::make('caja_abierta')
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
            'index' => Pages\ListSucursalEstatuses::route('/'),
            'create' => Pages\CreateSucursalEstatus::route('/create'),
            'edit' => Pages\EditSucursalEstatus::route('/{record}/edit'),
        ];
    }
}
