<?php

namespace App\Exports;

use App\Models\Workbook;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WorkbookExport implements FromQuery, WithColumnFormatting, WithMapping
{
    use Exportable;

    public $workbooks;

    public function __construct(Collection $workbooks)
    {
        $this->workbooks = $workbooks;
    }

    public function query(): \Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Eloquent\Builder|\Laravel\Scout\Builder|\Illuminate\Database\Query\Builder
    {
        return Workbook::whereKey($this->workbooks->pluck('id')->toArray());
    }

    /**
     * @var Workbook $workbooks
     */
    public function map($workbooks): array
    {
        return [
            $workbooks->number,
            $workbooks->registered_at,
            $workbooks->name,
            $workbooks->confidential,
            $workbooks->book->number,
            $workbooks->workbookPermormer->officer->person->full_name ?? '',
            $workbooks->workbookPermormer->officer->department->name_short ?? '',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
