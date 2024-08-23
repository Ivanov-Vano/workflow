<?php

namespace App\Filament\Resources\IncomingResource\RelationManagers;

use App\Filament\Resources\IncomingResource;
use App\Filament\Resources\OutgoingResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutgoingsRelationManager extends RelationManager
{
    protected static string $relationship = 'outgoings';

    protected static ?string $title = 'связанные исходящие документы';

    protected static ?string $pluralLabel = 'связанные исходящие документы';

    public function form(Form $form): Form
    {
        return OutgoingResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('number')
            ->columns([
                TextColumn::make('number')
                    ->sortable()
                    ->label('Номер')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('date')
                    ->date('d.m.Y')
                    ->sortable()
                    ->toggleable()
                    ->label('Дата'),
                TextColumn::make('organization.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Получатель'),
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->label('Наименование'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
