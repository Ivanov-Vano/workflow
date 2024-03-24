<?php

namespace App\Filament\Resources\IncomingResource\Pages;

use App\Filament\Resources\IncomingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIncoming extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = IncomingResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Создан новый входящий документ';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }




}
