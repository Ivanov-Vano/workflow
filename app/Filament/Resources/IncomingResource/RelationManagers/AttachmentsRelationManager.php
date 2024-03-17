<?php

namespace App\Filament\Resources\IncomingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Вложение';

    protected static ?string $pluralModelLabel = 'Вложения документы';

    protected static ?string $title = 'Вложения документы';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->directory('attachments')
                    ->preserveFilenames()
                    ->downloadable()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('name', pathinfo($state->getClientOriginalName(), PATHINFO_FILENAME)))
                    ->label('Документ'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Наименование'),
                TextInput::make('description')
                    ->columnSpanFull()
                    ->label('Описание'),
                Select::make('confidential')
                    ->label('Гриф')
                    ->required()
                    ->options([
                        'НС' => 'НС',
                        'ДПС' => 'ДПС',
                    ])
                    ->default('НС'),
                TextInput::make('page_count')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->label('Количество страниц'),
                TextInput::make('page_start')
                    ->numeric()
                    ->minValue(1)
                    ->label('Начало страницы'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Наименование'),
                TextColumn::make('page_count')
                    ->label('Количество страниц'),
                TextColumn::make('image')
                    ->label('Документ')
                    ->badge()
                    ->getStateUsing(fn (Model $record): string => $record->image == null ? '' : 'Вложение')
                    ->colors([
                        'success' => 'Вложение',
                    ]),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
