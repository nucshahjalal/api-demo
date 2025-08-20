<?php
namespace App\Exports;

use App\Models\Current;
use Maatwebsite\Excel\Concerns\FromCollection;

class CurrentExport implements FromCollection
{
    public function collection()
    {
        return Current::all();
    }
}