<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommanderResource\Pages;
use App\Models\Classifiers\Commander;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommanderResource extends Resource
{
    protected static ?string $model = Commander::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Справочник';

    protected static ?string $modelLabel = 'руководитель';

    protected static ?string $pluralModelLabel = 'руководители';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('short_name')
                    ->maxLength(100)
                    ->required()
                    ->autofocus()
                    ->label('Наименование'),
                TextInput::make('name')
                    ->label('Полное наименование'),
                Toggle::make('actual')
                    ->default('True')
                    ->label('Актуальность'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('short_name')
                    ->label('Наименование')
                    ->searchable(),
                TextColumn::make('name')
                    ->words(2)
                    ->label('Полное наименование')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->label('Статус')
                    ->getStateUsing(fn (Commander $record): string => $record->actual ? 'Актуален' : 'Неактуален')
                    ->colors([
                        'success' => 'Актуален',
                        'warning' => 'Неактуален',
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCommanders::route('/'),
        ];
    }
}
