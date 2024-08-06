<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class WisataExport implements WithMultipleSheets
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheetNames = [
            'hotel' => 'Hotel',
            'hiburan' => 'Hiburan',
            'fnb' => 'Fnb'
        ];
        foreach ($this->data as $key => $value) {
            $sheets[] = new WisataSheetExport(collect($value), $sheetNames[$key] ?? ucfirst($key));
        }
        return $sheets;
    }
}

class WisataSheetExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;
    protected $sheetName;
    protected $rowNumber;

    public function __construct(Collection $data, $sheetName)
    {
        $this->data = $data;
        $this->sheetName = $sheetName;
        $this->rowNumber = 1; // Initialize row number
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        // Get the first item to extract the keys (excluding 'id')
        $firstItem = $this->data->first();
        $keys = array_keys($firstItem->toArray());
        $keys = array_diff($keys, ['id']);

        return array_merge(['no'], $keys);
    }

    public function map($row): array
    {
        // Remove 'id' from the row
        $rowArray = $row->toArray();
        unset($rowArray['id']);

        // Add row number (starts from 1)
        $rowArray = array_merge([$this->rowNumber++], $rowArray);

        return $rowArray;
    }

    public function title(): string
    {
        return $this->sheetName;
    }
}
