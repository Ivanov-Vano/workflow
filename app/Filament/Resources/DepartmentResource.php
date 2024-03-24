<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\Classifiers\Department;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                IconColumn::make('actual')
                    ->label('Статус')
                    ->boolean()
                    ->action(function($record, $column) {
                        $name = $column->getName();
                        $record->update([
                            $name => !$record->$name
                        ]);
                    }),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
