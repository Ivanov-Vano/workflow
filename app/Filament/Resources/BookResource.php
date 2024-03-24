<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Справочник';

    protected static ?string $modelLabel = 'книга';

    protected static ?string $pluralModelLabel = 'книги';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')
                    ->maxLength(10)
                    ->required()
                    ->autofocus()
                    ->label('Номер'),
                TextInput::make('registered_at')
                    ->type('date')
                    ->required()
                    ->label('Зарегистрирована'),
                TextInput::make('part')
                    ->label('Номер тома')
                    ->numeric()
                    ->minValue(1),
                TextInput::make('note')
                    ->maxLength(255)
                    ->label('Примечание'),
                Textarea::make('description')
                    ->label('Описание'),
                TextInput::make('order')
                    ->label('Сортировка')
                    ->numeric()
                    ->minValue(1),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->sortable()
                    ->label('Номер')
                    ->searchable(),
                TextColumn::make('registered_at')
                    ->date('d.m.Y')
                    ->sortable()
                    ->label('Зарегистрирована'),
                TextColumn::make('part')
                    ->label('Номер тома'),
                TextColumn::make('note')
                    ->searchable()
                    ->label('Примечание'),
            ])
            ->defaultSort('order')
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                    ->slideOver(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBooks::route('/'),
        ];
    }
}
