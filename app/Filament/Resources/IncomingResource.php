<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IncomingResource\Pages;
//use App\Filament\Resources\IncomingResource\RelationManagers;
use App\Filament\Resources\Traits\HasTags;
use App\Models\Accesses\User;
use App\Models\Incoming;
use DateTime;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class IncomingResource extends Resource
{
    use HasTags;

    protected static ?string $model = Incoming::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $modelLabel = 'входящий';

    protected static ?string $pluralModelLabel = 'входящие';

    protected static ?int $navigationSort = 1;

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
                            ->label('Тип получения'),
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
                        Select::make('confidential')
                            ->label('Гриф')
                            ->required()
                            ->options([
                                'НС' => 'НС',
                                'ДПC' => 'ДПC',
                            ])
                            ->default('НС'),
                        TextInput::make('exemplar_count')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required()
                            ->label('Количество экземпляров'),
                        FileUpload::make('image')
                            ->directory('incomings')
                            ->preserveFilenames()
                            ->downloadable()
                            ->label('Документ'),
                    ])
                    ->columns(2),
//                    ->columnSpan(['lg' => fn (?Incoming $record) => $record === null ? 3 : 2]),

                Section::make('Отправитель')
                    ->schema([
                        Toggle::make('is_internal')
                            ->label('внутренний документ'),
                        Select::make('organization_id')
                            ->relationship('organization', 'short_name')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->label('Отправитель')
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
                        TextInput::make('sender_number')
                            ->label('Номер'),
                        TextInput::make('sender_date')
                            ->type('date')
                            ->label('Дата'),
                        TextInput::make('sender_name')
                            ->label('Исполнитель'),
                        TextInput::make('sender_phone')
                            ->label('Контакты'),
                    ])
                    ->columns(2),
                Section::make('Резолюция')
                    ->schema([
                        Select::make('whose_resolution')
                            ->relationship('whoseResolution', 'full_name',
                                fn (Builder $query) => $query
                                    /*->whereHas('user.roles', function (Builder $query) {
                                        $query
                                            ->where('roles.name', '=', 'Начальник');
                                    })*/
                                    ->where('actual', true))
                            ->preload()
                            ->searchable()
                            ->label('Автор резолюции'),
                        TextInput::make('resolution')
                            ->label('Текст'),
                    ])
                    ->columns(2),
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
                Section::make('Контроль исполнения')
                    ->schema([
                        Select::make('importance')
                            ->label('Оперативность')
                            ->options([
                                'Выбрать дату' => 'Выбрать дату',
                                'Весьма срочно' => 'Весьма срочно',
                                'Срочно' => 'Срочно',
                                'Оперативно' => 'Оперативно',
                                'Обычная' => 'Обычная',
                            ])
                            ->default('Выбрать дату'),
                        TextInput::make('deadline')
                            ->type('date')
                            ->label('Срок до'),
                        Toggle::make('is_complete')
                            ->label('Выполнено'),
                        TextInput::make('completed_at')
                            ->type('date')
                            ->label('Исполнено'),
                        TextInput::make('result_text')
                            ->label('Основание для снятия'),
                        Select::make('officer_id')
                            ->label('ФИО исполнителя')
                            ->relationship('officer', 'full_name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),
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
                        Select::make('sign_completed_who')
                            ->options(User::query()
                                ->pluck('username', 'users.id'))
                            ->label('Кто поставил отметку о выполнении'),
                        DateTimePicker  ::make('sign_completed_at')
                            ->label('Когда поставлена отметка о выполнении'),
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
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->label('Наименование'),
                TextColumn::make('sender_number')
                    ->searchable()
                    ->toggleable()
                    ->label('Номер исходящего'),
                TextColumn::make('sender_date')
                    ->sortable()
                    ->toggleable()
                    ->label('Дата исходящего'),
                TextColumn::make('sender_name')
                    ->searchable()
                    ->toggleable()
                    ->label('Имя отправителя'),
                TextColumn::make('sender_phone')
                    ->sortable()
                    ->toggleable()
                    ->label('Контакты отправителя'),
                TextColumn::make('organization.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Отправитель'),
                TextColumn::make('option.short_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Тип получения'),
                TextColumn::make('confidential')
                    ->searchable()
                    ->toggleable()
                    ->label('Гриф'),
                TextColumn::make('exemplar_count')
                    ->toggleable()
                    ->numeric()
                    ->label('Количество экземпляров'),
                TextColumn::make('registry.number')
                    ->sortable()
                    ->toggleable()
                    ->label('Номер дела'),
                TextColumn::make('whoseResolution.full_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Чья резолюция'),
                TextColumn::make('resolution.name')
                    ->toggleable()
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->label('Резолюция'),
/*                TextColumn::make('OverdueDays')
                    ->getStateUsing(function(Model $record) {
                        if ($record->implementation==Null) {
                            return '';
                        }
                        $fdate = $record->deadline;
                        $tdate = $record->implementation;
                        $datetime1 = new DateTime($fdate);
                        $datetime2 = new DateTime($tdate);
                        $interval = $datetime1->diff($datetime2);
                        $days = $interval->format('%a');//
                        return $days;
                    })
                    ->toggleable()
                    ->label('Задержка (дней)'),*/
                TextColumn::make('deadline')
                    ->toggleable()
                    ->sortable()
                    ->label('Срок исполнения'),
                TextColumn::make('completed_at')
                    ->toggleable()
                    ->sortable()
                    ->label('Дата выполнения'),
                TextColumn::make('officer.full_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('ФИО исполнителя'),
                TextColumn::make('importance')
                    ->sortable()
                    ->toggleable()
                    ->label('Срочность'),
                TextColumn::make('is_internal')
                    ->badge()
                    ->sortable()
                    ->toggleable()
                    ->label('Признак внутреннего документа'),
                TextColumn::make('mainNode.name_short')
                    ->toggleable()
                    ->searchable()
                    ->label('Старший'),
                TextColumn::make('image')
                    ->label('Документ')
                    ->badge()
                    ->toggleable()
                    ->getStateUsing(fn (Incoming $record): string => $record->image == null ? '' : 'Вложение')
                    ->colors([
                        'success' => 'Вложение',
                    ]),
                TextColumn::make('signCompletedWho.officer.full_name')
                    ->toggleable()
                    ->searchable()
                    ->label('Кто поставил отметку о выполнении'),
                TextColumn::make('sign_completed_at')
                    ->toggleable()
                    ->sortable()
                    ->label('Время отметки о выполнении'),
                self::tagsColumn(),
                TextColumn::make('createdWho.officer.full_name')
                    ->toggleable()
                    ->searchable()
                    ->label('Кто создал запись'),
                TextColumn::make('created_at')
                    ->toggleable()
                    ->sortable()
                    ->label('Время создания записи'),
                TextColumn::make('updatedWho.officer.full_name')
                    ->toggleable()
                    ->searchable()
                    ->label('Кто обновил запись'),
                TextColumn::make('updated_at')
                    ->toggleable()
                    ->sortable()
                    ->label('Время обновления записи'),
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
            'index' => Pages\ListIncomings::route('/'),
            'create' => Pages\CreateIncoming::route('/create'),
            'view' => Pages\ViewIncoming::route('/{record}/view'),
            'edit' => Pages\EditIncoming::route('/{record}/edit'),
        ];
    }
}
