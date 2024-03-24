<?php

namespace App\Filament\Resources\DiscResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficersRelationManager extends RelationManager
{
    protected static string $relationship = 'officers';

    protected static ?string $recordTitleAttribute = 'fullName';

    protected static ?string $modelLabel = 'исполнитель';

    protected static ?string $pluralModelLabel = 'исполнители';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('received_at')
                    ->type('date')
                    ->label('Получен')
                    ->required(),
                TextInput::make('returned_at')
                    ->type('date')
                    ->label('Возвращен'),
                TextInput::make('note')
                    ->label('Примечание')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rank.short_name')
                    ->label('Звание'),
                TextColumn::make('fullName')
                    ->label('Фамилия Имя Отчество'),
                TextColumn::make('department.name_short')
                    ->label('Подразделение'),
                TextColumn::make('post')
                    ->label('Должность'),
                TextColumn::make('received_at')
                    ->date('d.m.Y')
                    ->label('Получил'),
                TextColumn::make('returned_at')
                    ->date('d.m.Y')
                    ->label('Вернул'),
                TextColumn::make('note')
                    ->label('Примечание'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->where('actual', '=', 'true'))
                    ->form(fn(AttachAction $action): array => [
                        $action->getRecordSelect(),
                        TextInput::make('received_at')
                            ->type('date')
                            ->label('Получен')
                            ->required(),
                        TextInput::make('returned_at')
                            ->type('date')
                            ->label('Возвращен'),
                        TextInput::make('note')
                            ->label('Примечание')
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DetachAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);

    }
}
