<?php

namespace App\Filament\Resources\IncomingResource\Pages;

use App\Filament\Resources\IncomingResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateIncoming extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = IncomingResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Создан новый входящий документ';
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSteps(): array
    {
        return [
            Step::make('first')
                ->label('первый шаг')
                ->description('Внесите реквизиты документа')
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
                        ]),
                    Section::make()
                        ->schema([
                            TextInput::make('name')
                                ->maxLength(255)
                                ->required()
                                ->label('Наименование'),
                            TextArea::make('description')
                                ->label('Описание'),
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

                ]),
            Step::make('second')
                ->label('второй шаг')
                ->description('Выберите отправителя')
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
                        ]),
                    TextInput::make('sender_number')
                        ->label('Номер'),
                    TextInput::make('sender_date')
                        ->type('date')
                        ->label('Дата'),
                    TextInput::make('sender_name')
                        ->label('Исполнитель'),
                    TextInput::make('sender_phone')
                        ->label('Контакты'),
                ]),

            Step::make('third')
                ->label('третий шаг')
                ->description('Контроль исполнения')
                ->schema([
                    Select::make('whose_resolution')
                        ->relationship(
                            'whoseResolution', 'surname'
                        )
                        ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->surname} {$record->name} {$record->patronymic} ")
                        ->preload()
                        ->searchable(['surname', 'name', 'patronymic'])
                        ->label('Автор резолюции'),
                    TextInput::make('resolution')
                        ->label('Текст'),
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
                        ->relationship(
                            'officer',
                            modifyQueryUsing: fn(Builder $query) => $query->orderBy('surname')->orderBy('name'),
                        )
                        ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->surname} {$record->name} {$record->patronymic}")
                        ->searchable(['surname', 'name', 'patronymic'])
                        ->preload(),
                ])
        ];
    }





}
