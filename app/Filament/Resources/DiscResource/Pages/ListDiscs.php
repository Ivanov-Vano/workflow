<?php

namespace App\Filament\Resources\DiscResource\Pages;

use App\Filament\Resources\DiscResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiscs extends ListRecords
{
    protected static string $resource = DiscResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
