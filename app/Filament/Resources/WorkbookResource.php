<?php

namespace App\Filament\Resources;

use App\Exports\WorkbookExport;
use App\Filament\Resources\WorkbookResource\Pages;
//use App\Filament\Resources\WorkbookResource\RelationManagers;
use App\Models\Workbook;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkbookResource extends Resource
{
    protected static ?string $model = Workbook::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $modelLabel = 'рабочая тетрадь';

    protected static ?string $pluralModelLabel = 'рабочие тетради';

    protected static ?string $navigationGroup = 'Инвентарные носители';

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
                        TextInput::make('registered_at')
                            ->type('date')
                            ->required()
                            ->label('Дата регистрации'),
                        TextInput::make('name')
                            ->label('Наименование')
                            ->required(),
                        TextInput::make('page_count')
                            ->label('Количество страниц')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->maxValue(100),
                        Select::make('confidential')
                            ->label('Гриф')
                            ->required()
                            ->options([
                                'НС' => 'НС',
                                'ДСП' => 'ДСП',
                            ])
                            ->default('НС'),
                        TextInput::make('destroyed_at')
                            ->type('date')
                            ->label('Уничтожен'),
                        Select::make('book_id')
                            ->relationship('book', 'number')
                            ->required()
                            ->label('Книга учета'),

                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?Workbook $record) => $record === null ? 3 : 2]),
                Section::make()
                    ->schema([
                        Repeater::make('workbookPerformers')
                            ->relationship()
                            ->schema([
                                Select::make('officer_id')
                                    ->label('Фамилия Имя Отчество')
                                    ->required()
                                    ->relationship('officer', 'fullName')
                                    ->preload()
                                    ->searchable(),
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
                            //   ->orderable('received_at')
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
                TextColumn::make('number')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Номер'),
                TextColumn::make('registered_at')
                    ->date('d.m.Y')
                    ->sortable()
                    ->toggleable()
                    ->label('Зарегистрован'),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    ->label('Наименование'),
                TextColumn::make('confidential')
                    ->searchable()
                    ->toggleable()
                    ->label('Гриф'),
                TextColumn::make('book.number')
                    ->searchable()
                    ->toggleable()
                    ->label('Книга'),
                TextColumn::make('workbookPermormer.officer.fullName')
                    ->searchable()
                    ->toggleable()
                    ->label('За кем числится'),
                TextColumn::make('workbookPermormer.officer.department.name_short')
                    ->searchable()
                    ->toggleable()
                    ->label('Подразделение'),
                TextColumn::make('status')
                    ->label('Статус')
                    ->toggleable()
                    ->badge()
                    ->getStateUsing(fn (Workbook $record): string => $record->destroyed_at == null ? '' : 'Уничтожен')
                    ->colors([
                        'warning' => 'Уничтожен',
                    ]),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
                BulkAction::make('export')
                    ->label('Экспортировать выделенные')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(fn (Collection $records) => (new WorkbookExport($records))->download('рабочие тетради.xlsx'))
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkbooks::route('/'),
            'create' => Pages\CreateWorkbook::route('/create'),
            'view' => Pages\ViewWorkbook::route('/{record}'),
            'edit' => Pages\EditWorkbook::route('/{record}/edit'),
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
            ->whereHas('WorkbookPermormer.officer.department', function (Builder $query) {
                $query
                    ->where('departments.id', '=', auth()->user()->officer()->value('department_id'))
                    ->orWhere('departments.parent_id', '=', auth()->user()->officer()->value('department_id'));
            })
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }}
