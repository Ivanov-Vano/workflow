<?php

namespace App\Filament\Resources\IncomingResource\Pages;

use App\Filament\Resources\IncomingResource;
use App\Models\Incoming;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Illuminate\Database\Eloquent\Builder;

class ListIncomings extends ListRecords
{
    protected static string $resource = IncomingResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Все входящие'),
            'is_controled' => Tab::make('на контроле')
                ->badge(Incoming::query()
                    ->where('is_complete', false)
                    ->whereNotNull('deadline')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_complete', false)
                    ->whereNotNull('deadline')),
            'is_completed' => Tab::make('исполненные')
                ->badge(Incoming::query()
                    ->where('is_complete', true)
                    ->whereNotNull('deadline')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query
                    ->where('is_complete', true)
                    ->whereNotNull('deadline')),
/*            'paid' => Tab::make('Счета не оплачены')
                ->badge(Incoming::query()->where('paid', false)->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('paid', false)),
            'delivery_id' => Tab::make('Сертификаты не доставлены')
                ->badge(Incoming::query()->whereNull('delivery_id')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->whereNull('delivery_id')),*/
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
