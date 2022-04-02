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

class PresensiSingle2Export implements WithEvents
{
    use Exportable, RegistersEventListeners;
    protected $presensi;
 
    function __construct($presensi) {
        $this->presensi = $presensi;
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
                        'bold' => true,
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
                $dataPresensi = $this->presensi;
                $dataPresensi->data = json_decode($dataPresensi->data);
                $event->sheet->setCellValue('A1', $dataPresensi->pertemuan);
                $event->sheet->setCellValue(
                                'A2',
                                $dataPresensi->jadwal->mapel->nama_mapel.'('.$dataPresensi->materi_pertemuan.')'
                            );
                $event->sheet->setCellValue(
                                'A3',
                                'Guru Pengampu : '.$dataPresensi->jadwal->guru->nama
                            );
                $event->sheet->setCellValue(
                                'A4',
                                'Kelas : '.$dataPresensi->jadwal->kelas->nama_kelas
                            );
                $event->sheet->setCellValue(
                                'A7',
                                'Materi Pelajaran : '.$dataPresensi->materi_pertemuan
                            );
                $event->sheet->setCellValue(
                                'A8',
                                'Silabus : '
                            );                
                $event->sheet->setCellValue(
                                'A9',
                                $dataPresensi->silabus
                            );
                $event->sheet->setCellValue(
                                'A11',
                                'Data Siswa'
                            );
                $event->sheet->setCellValue(
                                'F1',
                                'Tahun Ajaran : '.$dataPresensi->jadwal->tahun_ajaran->tahun_ajaran.' ('.$dataPresensi->jadwal->semester->semester.')'
                            );
                $event->sheet->setCellValue(
                                'F2',
                                ucwords($dataPresensi->jadwal->hari).', '.$dataPresensi->jadwal->jam_pelajaran
                            );
                $event->sheet->setCellValue(
                                'F3',
                                'Jumlah Siswa : '.count($dataPresensi->data)
                            ); 
                $mulai = 13;     
                $event->sheet->setCellValue(
                                        'A12',
                                        'NO'
                                    );              
                $event->sheet->setCellValue(
                                        'B12',
                                        'NIS'
                                    );              
                $event->sheet->setCellValue(
                                        'C12',
                                        'NAMA'
                                    );              
                $event->sheet->setCellValue(
                                        'D12',
                                        'STATUS'
                                    );              
                $event->sheet->setCellValue(
                                        'E12',
                                        'KETERANGAN'
                                    );                 
                foreach ($dataPresensi->data as $key => $value) {                    
                    $event->sheet->setCellValue('A'.$mulai, ($key+1));
                    $event->sheet->setCellValue('B'.$mulai, $value->nis);
                    $event->sheet->setCellValue('C'.$mulai, $value->nama);
                    $event->sheet->setCellValue('D'.$mulai, ucwords($value->status));
                    if ($value->keterangan) {
                        $keterangan = $value->keterangan;
                    }else {
                        $keterangan = '-';
                    }
                    $event->sheet->setCellValue('E'.$mulai, $keterangan);
                    $mulai++;
                }                
                $event->sheet->styleCells('A11', $headerTitle);
                // $event->sheet->styleCells('A12', $styleBorder2);
                $event->sheet->styleCells('A12:E'.$mulai, $styleBorder);
                $event->sheet->getStyle('A12:E12')->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFFFFF00');
                $event->sheet->verticalAlign('A12:A1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->horizontalAlign('A12:A1000' , \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);                                              
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
            }
        ];
    }
}
