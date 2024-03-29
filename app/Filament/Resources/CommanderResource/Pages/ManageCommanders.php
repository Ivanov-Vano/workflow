<?php

namespace App\Filament\Resources\CommanderResource\Pages;

use App\Filament\Resources\CommanderResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCommanders extends ManageRecords
{
    protected static string $resource = CommanderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
