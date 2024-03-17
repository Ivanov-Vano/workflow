<?php

namespace App\Filament\Resources\IncomingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class   NodesRelationManager extends RelationManager
{
    protected static string $relationship = 'nodes';

    protected static ?string $title = 'Ответственный';

    protected static ?string $pluralLabel = 'исполнители';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_short')
                    ->required()
                    ->label('Наименование')
                    ->maxLength(255),
                Toggle::make('is_main')
                    ->inline(False)
                    ->label('главный'),
                TextInput::make('comment')
                    ->maxLength(255)
                    ->label('пояснения'),
                TextInput::make('report_text')
                    ->maxLength(255)
                    ->label('отчет'),
                FileUpload::make('report')
                    ->directory('reports')
                    ->preserveFilenames()
                    ->downloadable()
                    ->label('отчетный документ'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_short')
                    ->label('Наименование'),
                ToggleColumn::make('is_main')
                    ->label('Старший'),
                TextColumn::make('report_text')
                    ->words(2)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return $state;
                    })
                    ->label('Что выполнено'),
                TextColumn::make('viewed_at')
                    ->date('d.m.Y h:m')
                    ->label('Просмотрено в'),
            ])
            ->defaultSort('is_main', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectOptionsQuery(fn (Builder $query) => $query->where('actual', '=', 'true'))
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Toggle::make('is_main')
                            ->label('главный'),
                        TextInput::make('comment')
                            ->maxLength(255)
                            ->label('пояснения'),
                        TextInput::make('report_text')
                            ->maxLength(255)
                            ->label('отчет'),
                        FileUpload::make('report')
                            ->directory('reports')
                            ->preserveFilenames()
                            ->downloadable()
                            ->label('отчетный документ'),
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DetachAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
