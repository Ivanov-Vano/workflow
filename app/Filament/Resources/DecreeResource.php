<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DecreeResource\Pages;
//use App\Filament\Resources\DecreeResource\RelationManagers;
use App\Filament\Resources\Traits\HasTags;
use App\Models\Accesses\User;
use App\Models\Decree;
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
use Illuminate\Database\Eloquent\Model;

class DecreeResource extends Resource
{
    use HasTags;

    protected static ?string $model = Decree::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $modelLabel = 'приказ';

    protected static ?string $pluralModelLabel = 'приказы';

    protected static ?int $navigationSort = 3;

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
                        Select::make('type')
                            ->options([
                                'Приказ' => 'Приказ',
                                'Приказание' => 'Приказание',
                            ])
                            ->default('Приказ')
                            ->preload()
                            ->label('Тип'),
                    ])
                    ->columns(3),
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(255)
                            ->required()
                            ->columnSpanFull()
                            ->label('Наименование'),
                        TextArea::make('description')
                            ->columnSpanFull()
                            ->label('Описание'),
                        Select::make('commander_id')
                            ->relationship('commander', 'short_name')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label('Чей приказ'),
                        Select::make('signed_who')
                            ->relationship('signedWho', 'surname')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label('Кто подписал'),
                        FileUpload::make('image')
                            ->directory('decrees')
                            ->preserveFilenames()
                            ->downloadable()
                            ->label('Документ'),
                        Select::make('confidential')
                            ->label('Гриф')
                            ->required()
                            ->options([
                                'ns' => 'ns',
                                'dsp' => 'dsp',
                            ])
                            ->default('ns'),
                        TextInput::make('exemplar_count')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required()
                            ->label('Количество экземпляров'),
                    ])
                    ->columns(2),
//                    ->columnSpan(['lg' => fn (?Incoming $record) => $record === null ? 3 : 2]),

                Section::make('Основание')
                    ->schema([
                        Select::make('incoming_id')
                            ->relationship('incoming', 'number')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label('Основание входящий')
                            ->columnSpanFull(),
                    ]),
                Section::make('Хранение')
                    ->schema([
                        Select::make('registry_id')
                            ->relationship('registry', 'number')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) =>
                            "№ {$record->number} / год {$record->year} / {$record->name} ")
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
                    ->columnSpan(['md' => 2, 'lg' => 3]),//можно подставить из настроек
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
                TextColumn::make('type')
                    ->searchable()
                    ->toggleable()
                    ->label('Тип'),
                TextColumn::make('confidential')
                    ->searchable()
                    ->toggleable()
                    ->label('Гриф'),
                TextColumn::make('commander.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Чей приказ'),
                TextColumn::make('signed_who.surname')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Чей приказ'),
                TextColumn::make('option.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Чей приказ'),
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->description(fn (Model $record): string => $record->description)
                    ->label('Наименование'),
                TextColumn::make('incoming.number')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Основание'),
                TextColumn::make('registry.number')
                    ->sortable()
                    ->toggleable()
                    ->label('Номер дела'),
                TextColumn::make('page_start')
                    ->toggleable()
                    ->label('Страница в деле'),
                TextColumn::make('mainNode.name_short')
                    ->toggleable()
                    ->searchable()
                    ->label('Старший'),
                TextColumn::make('image')
                    ->label('Документ')
                    ->badge()
                    ->toggleable()
                    ->getStateUsing(fn (Model $record): string => $record->image == null ? '' : 'Вложение')
                    ->colors([
                        'success' => 'Вложение',
                    ]),
                self::tagsColumn(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DecreeResource\RelationManagers\NodesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDecrees::route('/'),
            'create' => Pages\CreateDecree::route('/create'),
            'view' => Pages\ViewDecree::route('/{record}/view'),
            'edit' => Pages\EditDecree::route('/{record}/edit'),
        ];
    }
}
