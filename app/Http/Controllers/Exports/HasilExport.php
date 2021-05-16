<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class HasilExport implements FromView
{
    use Exportable;
    protected $ranking;
    public function __construct($ranking)
    {
        $this->ranking = $ranking;
    }

    public function view(): View
    {
        return view('nilai_alternatif.cetak_hasil', ['ranking' => $this->ranking]);
    }
}
