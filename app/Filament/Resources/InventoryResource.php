<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
//use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $modelLabel = 'документ';

    protected static ?string $pluralModelLabel = 'документы';

    protected static ?string $navigationGroup = 'Инвентарные носители';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')
                    ->required()
                    ->maxLength(255)
                    ->autofocus()
                    ->label('Номер инвентарного'),
                TextInput::make('date')
                    ->type('date')
                    ->required()
                    ->label('Дата инвентарного'),
                Fieldset::make('document_id')
                    ->relationship('document')
                    ->label('Документ')
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(255)
                            ->required()
                            ->label('Наименование'),
                        TextInput::make('date')
                            ->required()
                            ->type('date')
                            ->label('дата'),
                        Select::make('confidential')
                            ->label('Гриф')
                            ->required()
                            ->options([
                                'НС' => 'НС',
                                'ДПС' => 'ДПС',
                            ])
                            ->default('НС'),
                        TextInput::make('exemplar_count')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->label('Количество экземпляров'),
                        TextInput::make('page_count')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->label('Количество страниц'),
                    ]),
                Select::make('book_id')
                    ->relationship('book', 'number')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => " № {$record->number} (том  {$record->number}) зарегистрирована от {$record->registered_at}")
                    ->searchable()
                    ->preload()
                    ->label('Книга'),
                Section::make()
                    ->schema([
                        Repeater::make('inventoryPerformers')
                            ->relationship()
                            ->schema([
                                Select::make('officer_id')
                                    ->label('Фамилия Имя Отчество')
                                    ->required()
                                    ->relationship(
                                        'officer',
                                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('surname')->orderBy('name'),
                                    )
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->surname} {$record->name} {$record->patronymic}")
                                    ->searchable(['surname', 'name', 'patronymic'])
                                    ->preload(),
                                TextInput::make('received_at')
                                    ->type('date')
                                    ->label('Получен')
                                    ->required(),
                                TextInput::make('returned_at')
                                    ->type('date')
                                    ->label('Возвращен'),
                                TextInput::make('note')
                                    ->label('Примечание')
                            ])
                            ->columns(3)
                            ->defaultItems(1)
                            ->label('Исполнители')
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'view' => Pages\ViewInventory::route('/{record}'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();
        if ($user->hasAnyRole(['Администратор', 'Суперпользователь', 'Делопроизводитель'])) {
            return parent::getEloquentQuery()
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]);
        }
        return parent::getEloquentQuery()
            ->whereHas('inventoryPermormer.officer.department', function (Builder $query) {
                $query
                    ->where('departments.id', '=', auth()->user()->officer()->value('department_id'))
                    ->orWhere('departments.parent_id', '=', auth()->user()->officer()->value('department_id'));
            })
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
