<?php

namespace App\Exports;

use App\Models\Auto;
use Maatwebsite\Excel\Concerns\FromCollection;

class AutoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auto::all();
    }
}
