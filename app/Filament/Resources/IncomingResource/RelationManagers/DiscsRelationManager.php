<?php

namespace App\Filament\Resources\IncomingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscsRelationManager extends RelationManager
{
    protected static string $relationship = 'discs';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Вложение';

    protected static ?string $pluralModelLabel = 'Вложения диски';

    protected static ?string $title = 'Вложения диски';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull()
                    ->label('Наименование'),
                Select::make('confidential')
                    ->label('Гриф')
                    ->required()
                    ->options([
                        'НС' => 'НС',
                        'ДПС' => 'ДПС',
                    ])
                    ->default('НС'),
                Select::make('type_id')
                    ->relationship('mediaType', 'short_name')
                    ->searchable()
                    ->preload()
                    ->label('Тип носителя'),
                TextInput::make('number')
                    ->maxLength(255)
                    ->label('Номер инвентарного'),
                TextInput::make('date')
                    ->type('date')
                    ->label('Дата инвентарного'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Наименование'),
                TextColumn::make('confidential')
                    ->label('Гриф'),
                TextColumn::make('mediaType.short_name')
                    ->label('Тип диска'),
                TextColumn::make('number')
                    ->label('Номер'),
                TextColumn::make('date')
                    ->date('d.m.Y')
                    ->label('Дата'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
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
