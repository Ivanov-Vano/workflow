<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
//use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Classifiers\Department;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Справочник';

    protected static ?string $modelLabel = 'подразделение';

    protected static ?string $pluralModelLabel = 'подразделения';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_short')
                    ->autofocus()
                    ->label('Краткое наименование' )
                    ->required(),
                TextInput::make('name')
                    ->label('Наименование'),
                Toggle::make('actual')
                    ->label('Действующее')
                    ->default('True')
                    ->required(),
                select::make('parent_id')
                    ->label('Кому подчинен')
                    ->relationship('parent', 'name_short'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->label('Наименование'),
                TextColumn::make('name_short')
                    ->sortable()
                    ->label('Краткое наименование'),
                TextColumn::make('parent.name_short')
                    ->searchable()
                    ->label('Центр'),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->getStateUsing(fn (Department $record): string => $record->actual ? 'Актуален' : 'Неактуален')
                    ->colors([
                        'success' => 'Актуален',
                        'warning' => 'Неактуален',
                    ]),
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
