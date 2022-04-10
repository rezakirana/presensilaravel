<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PresensiSingle2Export;

class PresensiAllExport implements WithMultipleSheets 
{

    protected $presensi;
    protected $getNamaSiswa;

    function __construct($presensi,$getNamaSiswa) {
        $this->presensi = $presensi;
        $this->getNamaSiswa = $getNamaSiswa;
    }
   
    public function sheets(): array
    {
        $jml = count($this->presensi);                        
        if ($jml == 1) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 2) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 3) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 4) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 5) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 6) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 7) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 8) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 9) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 10) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 11) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 12) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 13) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 14) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 15) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiSingle2Export($this->presensi[14]),
                15 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 16) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiSingle2Export($this->presensi[14]),
                15 => new PresensiSingle2Export($this->presensi[15]),
                16 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 17) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiSingle2Export($this->presensi[14]),
                15 => new PresensiSingle2Export($this->presensi[15]),
                16 => new PresensiSingle2Export($this->presensi[16]),
                17 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 18) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiSingle2Export($this->presensi[14]),
                15 => new PresensiSingle2Export($this->presensi[15]),
                16 => new PresensiSingle2Export($this->presensi[16]),
                17 => new PresensiSingle2Export($this->presensi[17]),
                18 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 19) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiSingle2Export($this->presensi[14]),
                15 => new PresensiSingle2Export($this->presensi[15]),
                16 => new PresensiSingle2Export($this->presensi[16]),
                18 => new PresensiSingle2Export($this->presensi[18]),
                19 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }elseif ($jml == 20) {
            return [            
                0 => new PresensiSingle2Export($this->presensi[0]),
                1 => new PresensiSingle2Export($this->presensi[1]),
                2 => new PresensiSingle2Export($this->presensi[2]),
                3 => new PresensiSingle2Export($this->presensi[3]),
                4 => new PresensiSingle2Export($this->presensi[4]),
                5 => new PresensiSingle2Export($this->presensi[5]),
                6 => new PresensiSingle2Export($this->presensi[6]),
                7 => new PresensiSingle2Export($this->presensi[7]),
                8 => new PresensiSingle2Export($this->presensi[8]),
                9 => new PresensiSingle2Export($this->presensi[9]),
                10 => new PresensiSingle2Export($this->presensi[10]),
                11 => new PresensiSingle2Export($this->presensi[11]),
                12 => new PresensiSingle2Export($this->presensi[12]),
                13 => new PresensiSingle2Export($this->presensi[13]),
                14 => new PresensiSingle2Export($this->presensi[14]),
                15 => new PresensiSingle2Export($this->presensi[15]),
                16 => new PresensiSingle2Export($this->presensi[16]),
                18 => new PresensiSingle2Export($this->presensi[18]),
                19 => new PresensiSingle2Export($this->presensi[19]),
                20 => new PresensiKeterangan($this->getNamaSiswa)
            ];
        }  
    }
}