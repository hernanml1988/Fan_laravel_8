<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithColumnLimit;

class RegistroAutoImport implements ToCollection, WithLimit, WithColumnLimit
{
    //  protected $startRow;

    // public function __construct(int $startRow)
    // {
    //     $this->startRow = $startRow;
    // }
    // public function startRow(): int
    // {
    //     return $this->startRow;
    // }

    
     
    public function collection(Collection $rows)
    {
        $resultado= Array();
        // foreach ($rows[0] as $row) 
        // {            
        //         $resultado[] = [$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]];
            
        // }
        return $resultado;
    } 
    // public function chunkSize(): int
    // {
    //     return 1000;
    // }
    public function limit(): int
    {
        return 10;
    }
    public function endColumn(): string
    {
        return 's';
    }
    // public function batchSize(): int
    // {
    //     return 10;
    // }
    
}
