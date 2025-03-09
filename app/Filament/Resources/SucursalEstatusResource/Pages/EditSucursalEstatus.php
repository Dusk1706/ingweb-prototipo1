<?php

namespace App\Filament\Resources\SucursalEstatusResource\Pages;

use App\Filament\Resources\SucursalEstatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSucursalEstatus extends EditRecord
{
    protected static string $resource = SucursalEstatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
