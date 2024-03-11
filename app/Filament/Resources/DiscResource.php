<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiscResource\Pages;
//use App\Filament\Resources\DiscResource\RelationManagers;
use App\Models\Disc;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscResource extends Resource
{
    protected static ?string $model = Disc::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';

    protected static ?string $modelLabel = 'диск';

    protected static ?string $pluralModelLabel = 'диски';

    protected static ?string $navigationGroup = 'Инвентарные носители';

    protected static ?int $navigationSort = 2;

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
                TextInput::make('name')
                    ->maxLength(255)
                    ->required()
                    ->label('Наименование'),
                Select::make('confidential')
                    ->label('Гриф')
                    ->required()
                    ->options([
                        'НС' => 'НС',
                        'ДПC' => 'ДПC',
                    ])
                    ->default('НС'),
                Select::make('type_id')
                    ->relationship('mediaType', 'short_name')
                    ->label('Тип дискового носителя'),
                TextArea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
                Select::make('registry_id')
                    ->relationship('registry', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => " № {$record->number} ({$record->name}) от {$record->year}")
                    ->searchable()
                    ->preload()
                    ->label('Дело'),
                TextInput::make('destroyed_at')
                    ->type('date')
                    ->label('Уничтожен'),
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
            DiscResource\RelationManagers\OfficersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiscs::route('/'),
            'create' => Pages\CreateDisc::route('/create'),
            'edit' => Pages\EditDisc::route('/{record}/edit'),
        ];
    }
}
