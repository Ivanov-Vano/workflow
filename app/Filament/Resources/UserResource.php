<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
//use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Models\Accesses\User;
use App\Models\Classifiers\Officer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $modelLabel = 'пользователь';

    protected static ?string $pluralModelLabel = 'пользователи';

    protected static ?string $navigationGroup = 'Администрирование';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('officer_id')
                    ->columnSpanFull()
                    ->preload()
                    ->relationship('officer', 'fullName')
                    ->getOptionLabelFromRecordUsing(fn (Officer $record): string => "{$record->fullName()} / {$record->post}/ {$record->department->name_short}")
                    /*                    ->reactive()
                                        ->afterStateUpdated(fn ($state, callable $set) => $set('username', $state))*///ToDo: подставить значение ФИО выбранного сотрудника
                    ->label('Сотрудник'),
                TextInput::make('username')
                    ->columnSpanFull()
                    ->required()
                    ->label('Логин')
                    ->unique(ignoreRecord: true)
                    ->minLength(2)
                    ->maxLength(255),
                TextInput::make('password')
                    ->columnSpanFull()
                    ->label('Пароль')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (Page $livewire) => ($livewire instanceof CreateUser))
                    ->maxLength(255),
                Select::make('roles')
                    ->columnSpanFull()
                    ->label('Роли')
                    ->multiple()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function (\Filament\Forms\Set $set, \Filament\Forms\Get $get) {
                        if((! in_array(3, $get('roles'))) && (! in_array(1, $get('roles')))){  // 3 and 1 are roles IDs
                            $set('nodes', null);
                        }
                    })
                    ->relationship('roles', 'name'),
                Select::make('nodes')
                    ->columnSpanFull()
                    ->label('Ответственные')
                    ->multiple()
                    ->hidden(fn (\Filament\Forms\Get $get): bool => ! (in_array(3, $get('roles')) || in_array(2, $get('roles')))) // 3 and 2 are role IDs
                    ->preload()
                    ->relationship('nodes', 'name_short'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username')
                    ->searchable()
                    ->label('Имя пользователя'),
                TextColumn::make('roles.name')
                    ->label('Роль'),
                TextColumn::make('nodes.name_short')
                    ->label('Ответственный'),
                TextColumn::make('officer.fullName')
                    ->label('Сотрудник'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
