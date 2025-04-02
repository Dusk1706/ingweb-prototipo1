<?php

namespace App\Filament\Resources\SucursalEstatusResource\Pages;

use App\Filament\Resources\SucursalEstatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSucursalEstatuses extends ListRecords
{
    protected static string $resource = SucursalEstatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
