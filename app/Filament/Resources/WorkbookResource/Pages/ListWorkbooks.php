<?php

namespace App\Filament\Resources\WorkbookResource\Pages;

use App\Filament\Resources\WorkbookResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkbooks extends ListRecords
{
    protected static string $resource = WorkbookResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
