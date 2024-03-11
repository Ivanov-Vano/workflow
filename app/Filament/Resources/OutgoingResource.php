<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutgoingResource\Pages;
//use App\Filament\Resources\OutgoingResource\RelationManagers;
use App\Filament\Resources\Traits\HasTags;
use App\Models\Accesses\User;
use App\Models\Outgoing;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutgoingResource extends Resource
{
    use HasTags;

    protected static ?string $model = Outgoing::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $modelLabel = 'исходящий';

    protected static ?string $pluralModelLabel = 'исходящие';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('number')
                            ->autofocus()
                            ->label('Номер')
                            ->required(),
                        TextInput::make('date')
                            ->type('date')
                            ->required()
                            ->label('Дата'),
                        Select::make('option_id')
                            ->relationship('option', 'short_name')
                            ->searchable()
                            ->preload()
                            ->label('Тип отправки'),
                    ])
                    ->columns(3),
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(255)
                            ->required()
                            ->columnSpanFull()
                            ->label('Наименование'),
                        Textarea::make('description')
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
                        TextInput::make('exemplar_count')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required()
                            ->label('Количество экземпляров'),
                        FileUpload::make('image')
                            ->directory('outgoings')
                            ->preserveFilenames()
                            ->downloadable()
                            ->label('Документ'),
                        Select::make('organization_id')
                            ->relationship('organization', 'short_name')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label('Получатель')
                            ->createOptionForm([
                                TextInput::make('short_name')
                                    ->maxLength(50)
                                    ->required()
                                    ->label('Наименование'),
                                TextInput::make('name')
                                    ->maxLength(255)
                                    ->required()
                                    ->label('Полное наименование'),
                            ])
                            ->columnSpanFull(),
                        Select::make('officer_id')
                            ->label('ФИО исполнителя')
                            ->relationship('officer', 'full_name')
                            ->preload()
                            ->searchable(),
                        TextInput::make('note')
                            ->label('Примечание'),
                    ])
                    ->columns(2),
                Section::make('Хранение')
                    ->schema([
                        Select::make('registry_id')
                            ->relationship('registry', 'number')
//                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "№ {$record->number} / том {$record->part} / год {$record->year} / {$record->name} ")
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('number')
                                    ->maxLength(10)
                                    ->required()
                                    ->label('Номер'),
                                TextInput::make('name')
                                    ->maxLength(255)
                                    ->required()
                                    ->label('Наименование'),
                                TextInput::make('part')
                                    ->label('Номер тома')
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('year')
                                    ->label('Год')
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(2100),
                                TextInput::make('order')
                                    ->label('Сортировка')
                                    ->numeric()
                                    ->minValue(1),
                            ])
                            ->columnSpanFull()
                            ->label('Дело'),
                        TextInput::make('registry_part')
                            ->numeric()
                            ->minValue(1)
                            ->label('Том дела'),
                        TextInput::make('page_count')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->label('Количество страниц'),
                        TextInput::make('page_start')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->label('Начало страницы'),
                    ])->columns(3),
                self::formTagsField()
                    ->columnSpan(['md' => 2, 'lg' => 3]),
                Section::make('Параметры записи')
                    ->schema([
                        Select::make('created_who')
                            ->options(User::query()
                                ->pluck('username', 'users.id'))
                            ->label('Кто добавил'),
                        DateTimePicker::make('created_at')
                            ->label('Создана'),
                        Select::make('updated_who')
                            ->options(User::query()
                                ->pluck('username', 'users.id'))
                            ->label('Кто обновил'),
                        DateTimePicker::make('updated_at')
                            ->label('Обновлена'),

                        ])->columns(2)

            ])->columns(['md' => 2, 'lg' => 3]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                TextColumn::make('confidential')
                    ->searchable()
                    ->toggleable()
                    ->label('Гриф'),
                TextColumn::make('organization.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Получатель'),
                TextColumn::make('option.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Тип отправки'),
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->label('Наименование'),
                TextColumn::make('note')
                    ->searchable()
                    ->toggleable()
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->label('Примечание'),
                TextColumn::make('registry.number')
                    ->sortable()
                    ->toggleable()
                    ->label('Номер дела'),
                TextColumn::make('registry_part')
                    ->toggleable()
                    ->label('Номер тома'),
                TextColumn::make('exemplar_count')
                    ->toggleable()
                    ->label('Количество экземпляров'),
                TextColumn::make('page_start')
                    ->toggleable()
                    ->label('Страница в деле'),
                TextColumn::make('image')
                    ->label('Документ')
                    ->toggleable()
                    ->badge()
                    ->getStateUsing(fn (Outgoing $record): string => $record->image == null ? '' : 'Вложение')
                    ->colors([
                        'success' => 'Вложение',
                    ]),
                self::tagsColumn(),
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
                self::changeTagsAction(),
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
            'index' => Pages\ListOutgoings::route('/'),
            'create' => Pages\CreateOutgoing::route('/create'),
            'view' => Pages\ViewOutgoing::route('/{record}'),
            'edit' => Pages\EditOutgoing::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
