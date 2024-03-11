<?php

namespace App\Filament\Resources\DiscResource\Pages;

use App\Filament\Resources\DiscResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisc extends EditRecord
{
    protected static string $resource = DiscResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
