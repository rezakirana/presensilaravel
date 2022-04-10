<?php

namespace App\Exports;

use App\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class PresensiKeterangan implements WithEvents
{
    use Exportable, RegistersEventListeners;    
    protected $dataSiswa;
 
    function __construct($dataSiswa) {        
        $this->dataSiswa = $dataSiswa;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $headerTitle = array(
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  18,
                        'bold'      =>  true
                    )
                );

                $styleBorder = [
                    'font' => [
                        'bold' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
    
                    ]
                ];

                $styleBorder2 = [
                    'font' => [
                        'bold' => false,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
    
                    ]
                ];

                $mergeCells = [];
                //set field header
                $justColumn = [
                    'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
                    'Q','R','S','T','U','V','W','X','Y','Z'
                ];
                $allColumns = [
                    'A1','B1','C1','D1','E1','F1','G1','H1','I1','J1','K1','L1','M1','N1','O1','P1',
                    'Q1','R1','S1','T1','U1','V1','W1','X1','Y1','Z1'
                ];
                $allColumns2 = [
                    'A2','B2','C2','D2','E2','F2','G2','H2','I2','J2','K2','L2','M2','N2','O2','P2',
                    'Q2','R2','S2','T2','U2','V2','W2','X2','Y2','Z2'
                ];
                $end = null;
                
                $keterangan = $this->dataSiswa;
                $event->sheet->setCellValue('A1', "DAFTAR JUMLAH STATUS KEHADIRAN SISWA");
                $event->sheet->setCellValue('A3', "NO");
                $event->sheet->setCellValue('B3', "NIS");
                $event->sheet->setCellValue('C3', "NAMA SISWA");
                $event->sheet->setCellValue('D3', "HADIR");
                $event->sheet->setCellValue('E3', "IZIN");
                $event->sheet->setCellValue('F3', "SAKIT");
                $event->sheet->setCellValue('G3', "ALPHA");
                $mulai = 4;               
                foreach ($keterangan as $key => $value) {                    
                    $event->sheet->setCellValue('A'.$mulai, ($key+1));
                    $event->sheet->setCellValue('B'.$mulai, $value['nis']);
                    $event->sheet->setCellValue('C'.$mulai, $value['nama']);
                    $event->sheet->setCellValue('D'.$mulai, $value['hadir'].' kali');
                    $event->sheet->setCellValue('E'.$mulai, $value['izin'].' kali');
                    $event->sheet->setCellValue('F'.$mulai, $value['sakit'].' kali');
                    $event->sheet->setCellValue('G'.$mulai, $value['alpha'].' kali');                    
                    $mulai++;
                }                
                $event->sheet->getDelegate()->setMergeCells(['A1:G1']);
                $event->sheet->styleCells('A1', $headerTitle);
                $event->sheet->styleCells('A3:G3', $styleBorder);
                $event->sheet->styleCells('A4:G'.$mulai, $styleBorder2);
                $event->sheet->getStyle('A3:G3')->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFFFFF00');
                $event->sheet->verticalAlign('A1:G1' , \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->verticalAlign('B1:B1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->verticalAlign('A3:A1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->horizontalAlign('B1:B1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);                                              
                $event->sheet->horizontalAlign('A3:G3' , \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);                                              
                $event->sheet->horizontalAlign('A3:A1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);                                              
                $event->sheet->horizontalAlign('A1:G1' , \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);   
                $event->sheet->verticalAlign('D4:G1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->horizontalAlign('D4:G1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);                                           
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
            }
        ];
    }
}
