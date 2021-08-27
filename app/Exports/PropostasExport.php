<?php
namespace App\Exports;

use App\Models\Proposta;
use Maatwebsite\Excel\Concerns\FromCollection;


class PropostasExport implements FromCollection
{
    public function collection()
    {        
        return Proposta::lista(100);
    }
}