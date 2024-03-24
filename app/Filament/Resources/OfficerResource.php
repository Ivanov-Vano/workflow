<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficerResource\Pages;
//use App\Filament\Resources\OfficerResource\RelationManagers;
use App\Models\Classifiers\Officer;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficerResource extends Resource
{
    protected static ?string $model = Officer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Справочник';

    protected static ?string $modelLabel = 'сотрудник';

    protected static ?string $pluralModelLabel = 'сотрудники';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('surname')
                            ->autofocus()
                            ->required()
                            ->label('Фамилия'),
                        TextInput::make('name')
                            ->required()
                            ->label('Имя'),
                        TextInput::make('patronymic')
                            ->label('Отчество'),
                        TextInput::make('birthdate')
                            ->type('date')
                            ->label('Дата рождения'),
                        Radio::make('gender')
                            ->options([
                                'мужской' => 'Муж',
                                'женский' => 'Жен',
                            ])
                            ->label('Пол'),
                        Select::make('rank_id')
                            ->relationship('rank', 'short_name')
                            ->label('Звание'),
                        TextInput::make('post')
                            ->autofocus()
                            ->label('Должность'),
                        Select::make('department_id')
                            ->relationship('department', 'name_short')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name_short} / {$record->name}")
                            ->preload()
                            ->searchable()
                            ->label('Подразделение'),
                        TextInput::make('personal_number')
                            ->maxLength(8)
                            ->label('Личный номер'),
                        TextInput::make('phone')
                            ->label('Контакт'),
                        Toggle::make('actual')
                            ->label('Действующий')
                            ->default('True')
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpan(['lg' => fn (?Officer $record) => $record === null ? 3 : 2]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rank.short_name')
                    ->searchable()
                    ->label('Звание'),
                TextColumn::make('fullName')
                    ->sortable(['surname','name', 'patronymic'])
                    ->searchable(['surname','name', 'patronymic'])
                    ->label('Фамилия Имя Отчество'),
                TextColumn::make('department.name_short')
                    ->searchable()
                    ->label('Подразделение'),
                TextColumn::make('post')
                    ->searchable()
                    ->label('Должность'),
            ])
            ->searchPlaceholder('Поиск (Звание, ФИО, Подразделение, Должность)')
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
            'index' => Pages\ListOfficers::route('/'),
            'create' => Pages\CreateOfficer::route('/create'),
            'edit' => Pages\EditOfficer::route('/{record}/edit'),
        ];
    }
}
