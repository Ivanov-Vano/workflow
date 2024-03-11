<?php

namespace App\Filament\Resources\DecreeResource\Pages;

use App\Filament\Resources\DecreeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDecree extends ViewRecord
{
    protected static string $resource = DecreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

}
