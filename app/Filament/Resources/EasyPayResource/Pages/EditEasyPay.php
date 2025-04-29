<?php

namespace App\Filament\Resources\EasyPayResource\Pages;

use App\Filament\Resources\EasyPayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEasyPay extends EditRecord
{
    protected static string $resource = EasyPayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
