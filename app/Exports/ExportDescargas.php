<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportDescargas implements FromArray, WithHeadings, WithStyles
{
   
   
        protected $Resultado;
        protected $Titulos;

        public function __construct(array $Resultado, array $Titulos)
        {
            $this->Resultado = $Resultado;
            $this->Titulos = $Titulos;
        }

        public function array(): array
        {
            
            return $this->Resultado; 
        }

        public function headings(): array
        {
            return $this->Titulos;
            
        }

        public function styles(Worksheet $sheet)
        {

            return [
                        // Style the first row as bold text.
                        1    => ['font' => ['bold' => true]                       
                        ]
                ];
            
       
        }
        
    
    
}
