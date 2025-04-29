<?php

namespace App\Filament\Resources\EasyPayResource\Pages;

use App\Filament\Resources\EasyPayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEasyPays extends ListRecords
{
    protected static string $resource = EasyPayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
