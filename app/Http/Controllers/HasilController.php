<?php

namespace App\Http\Controllers;

use App\Model\BobotKriteria;
use App\Model\Kriteria;
use App\Model\Alternatif;
use App\Model\SubKriteria;
use App\Model\NilaiAlternatif;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Charts\PenilaianLineChart;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilExport;

class HasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hasil_perhitungan()
    {
        $jumBobot = BobotKriteria::where(['id_user' => Auth::id()])->sum('bobot');
        if (!$jumBobot) {
            return redirect()->route('bobot-kriteria.index')->with('warning','Silakan tambahkan bobot kriteria terlebih dahulu!');
        }
        $step1 = [];
        $kriteria = Kriteria::join('bobot_kriteria', 'bobot_kriteria.id_kriteria','=','kriteria.id')
                                ->where(['bobot_kriteria.id_user' => Auth::id()])
                                ->select([
                                    'kriteria.id as kriteria_id',
                                    'kriteria.nama',
                                    'kriteria.jenis',
                                    'bobot_kriteria.bobot',
                                ])->get();
        $alternatif = Alternatif::all();
        // normalisasi bobot
        foreach ($kriteria as $key => $k) {
            $tmp = 0;
            $tmp = (int)$k->bobot/(int)$jumBobot;
            $step1[$k->nama] = $tmp;
        }
        // end normalisasi bobot
        
        $step2 = [];
        // step 2 rating kecocokan
        foreach ($alternatif as $key => $value) {
            $penilaianTmp = Alternatif::join('nilai_alternatif', 'nilai_alternatif.id_alternatif','=','alternatif.id')
                                ->join('sub_kriteria','sub_kriteria.id','=','nilai_alternatif.id_sub_kriteria')
                                ->join('kriteria', 'kriteria.id', '=', 'sub_kriteria.id_kriteria')
                                ->join('bobot_kriteria', 'bobot_kriteria.id_kriteria', '=', 'kriteria.id')
                                ->where([
                                        'nilai_alternatif.id_alternatif' => $value->id,
                                        'bobot_kriteria.id_user' => Auth::id()
                                        ])
                                ->select([
                                    'alternatif.id as id_alternatif',
                                    'alternatif.nama as nama_alternatif',
                                    'kriteria.id as kriteria_id',
                                    'kriteria.jenis as kriteria_jenis',
                                    'kriteria.nama as nama_kriteria',
                                    'sub_kriteria.id as sub_kriteria_id',
                                    'sub_kriteria.nama as nama_subKriteria',
                                    'sub_kriteria.keterangan as keterangan_subKriteria',
                                    'sub_kriteria.bobot as bobot_subKriteria',
                                    'bobot_kriteria.bobot as bobot_kriteria',
                                ])->get();
            foreach ($penilaianTmp as $kunci => $nilai) {
                if(!isset($step2[$key])) {
                    $step2[$key] = new \StdClass();
                }
                // $step2[$key]->id = $nilai->id;
                $step2[$key]->alternatif_id = $nilai->id_alternatif;
                $step2[$key]->alternatif_nama = $nilai->nama_alternatif;
                $step2[$key]->kriteria_id[$kunci] = $nilai->kriteria_id;
                $step2[$key]->sub_kriteria_id[$kunci] = $nilai->sub_kriteria_id;
                $step2[$key]->kriteria[$kunci] = $nilai->nama_kriteria;
                $step2[$key]->namaSubKriteria[$kunci] = $nilai->nama_subKriteria;
                $step2[$key]->keterangan[$kunci] = $nilai->keterangan_subKriteria;
                $step2[$key]->sub_bobot[$kunci] = $nilai->bobot_subKriteria;
                $step2[$key]->bobot[$kunci] = $nilai->bobot_kriteria;
                $step2[$key]->jenis[$kunci] = $nilai->kriteria_jenis;
            }
        }
        // end step 2

        $subKriteriaData = [];
        foreach ($kriteria as $key => $value) {
            $sub = SubKriteria::where('id_kriteria',$value->kriteria_id)->get();
            foreach ($sub as $key2 => $s) {
                if(!isset($subKriteriaData[$key])) {
                    $subKriteriaData[$key] = new \StdClass();
                }
                $subKriteriaData[$key]->kriteria = $value->nama;
                $subKriteriaData[$key]->sub_kriteriaNama[$key2] = $s->nama;  
                $subKriteriaData[$key]->sub_kriteria[$key2] = $s->keterangan;  
                $subKriteriaData[$key]->bobot_sub[$key2] = $s->bobot;  
            }
        }

        // perhitungan vector S
        $step3 = [];
        $jumVectorS = 0;
        foreach ($step2 as $key => $s) {
            $remanen2 = null;
            $tmp = null;
            $tmp2 = 1;
            if(!isset($step3[$key])) {
                $step3[$key] = new \StdClass();
            }
            $step3[$key]->alternatif = $s->alternatif_nama;
            foreach ($s->sub_bobot as $key2 => $nilai) {
                $remanen = null;
                if ($s->jenis[$key2] == 'benefit') {
                    $tmp = pow($nilai, $step1[$s->kriteria[$key2]]);
                    $remanen = "(".$nilai."^".$step1[$s->kriteria[$key2]].")";
                } else {
                    $tmp = pow($nilai,-$step1[$s->kriteria[$key2]]);
                    $remanen = "(".$nilai."^-".$step1[$s->kriteria[$key2]].")";
                }
                $tmp2 = $tmp2 * $tmp;
                if (is_null($remanen2)) {
                    $remanen2 = $remanen;
                } else {
                    $remanen2 =  $remanen2 . ' * '. $remanen;
                }      
            }
            $step3[$key]->perhitungan = $remanen2;
            $step3[$key]->nilai = $tmp2;
            $jumVectorS+= $tmp2;
        }
        // end perhitungan vector s

        // perhitungan vector V
        $step4 = [];
        foreach ($step3 as $key => $value) {
            if(!isset($step4[$key])) {
                $step4[$key] = new \StdClass();
            }
            $step4[$key]->nilai = $value->nilai/$jumVectorS;
            $step4[$key]->perhitungan = $value->nilai.' / '.$jumVectorS;
            $step4[$key]->alternatif = $value->alternatif;
        }
        // end perhitungan vector V
        
        // perankingan
        $sort = collect($step4);
        $ranking = $sort->sortByDesc('nilai');
        $label = [];
        $dataset = [];
        foreach ($ranking as $key => $value) {
            array_push($label, $value->alternatif);
            array_push($dataset, $value->nilai);
        }

        $penilaianChart = new PenilaianLineChart;
        $penilaianChart->labels($label);
        $penilaianChart->dataset('Hasil Penilaian', 'line', $dataset)
                         ->color("rgb(255, 99, 132)")
                        ->backgroundcolor("rgb(255, 99, 132)");
        // end perangkingan

        return view('nilai_alternatif.nilai', [
            'kriteria' => $kriteria,
            'subKriteriaData' => $subKriteriaData,
            'step1' => $step1,
            'step2' => $step2,
            'step3' => $step3,
            'step4' => $step4,
            'ranking' => $ranking,
            'jumBobot' => $jumBobot,
            'jumVectorS' => $jumVectorS,
            'penilaianChart' => $penilaianChart,
            'label' => json_encode($label),
            'dataset' => json_encode($dataset,JSON_NUMERIC_CHECK)
        ]);
    }

    public function unduh_hasil_perhitungan()
    {
        $jumBobot = BobotKriteria::where(['id_user' => Auth::id()])->sum('bobot');
        if (!$jumBobot) {
            return redirect()->route('bobot-kriteria.index')->with('warning','Silakan tambahkan bobot kriteria terlebih dahulu!');
        }
        $step1 = [];
        $kriteria = Kriteria::join('bobot_kriteria', 'bobot_kriteria.id_kriteria','=','kriteria.id')
                                ->where(['bobot_kriteria.id_user' => Auth::id()])
                                ->select([
                                    'kriteria.id as kriteria_id',
                                    'kriteria.nama',
                                    'kriteria.jenis',
                                    'bobot_kriteria.bobot',
                                ])->get();
        $alternatif = Alternatif::all();
        // normalisasi bobot
        foreach ($kriteria as $key => $k) {
            $tmp = 0;
            $tmp = (int)$k->bobot/(int)$jumBobot;
            $step1[$k->nama] = $tmp;
        }
        // end normalisasi bobot
        
        $step2 = [];
        // step 2 rating kecocokan
        foreach ($alternatif as $key => $value) {
            $penilaianTmp = Alternatif::join('nilai_alternatif', 'nilai_alternatif.id_alternatif','=','alternatif.id')
                                ->join('sub_kriteria','sub_kriteria.id','=','nilai_alternatif.id_sub_kriteria')
                                ->join('kriteria', 'kriteria.id', '=', 'sub_kriteria.id_kriteria')
                                ->join('bobot_kriteria', 'bobot_kriteria.id_kriteria', '=', 'kriteria.id')
                                ->where([
                                        'nilai_alternatif.id_alternatif' => $value->id,
                                        'bobot_kriteria.id_user' => Auth::id()
                                        ])
                                ->select([
                                    'alternatif.id as id_alternatif',
                                    'alternatif.nama as nama_alternatif',
                                    'kriteria.id as kriteria_id',
                                    'kriteria.jenis as kriteria_jenis',
                                    'kriteria.nama as nama_kriteria',
                                    'sub_kriteria.id as sub_kriteria_id',
                                    'sub_kriteria.nama as nama_subKriteria',
                                    'sub_kriteria.keterangan as keterangan_subKriteria',
                                    'sub_kriteria.bobot as bobot_subKriteria',
                                    'bobot_kriteria.bobot as bobot_kriteria',
                                ])->get();
            foreach ($penilaianTmp as $kunci => $nilai) {
                if(!isset($step2[$key])) {
                    $step2[$key] = new \StdClass();
                }
                // $step2[$key]->id = $nilai->id;
                $step2[$key]->alternatif_id = $nilai->id_alternatif;
                $step2[$key]->alternatif_nama = $nilai->nama_alternatif;
                $step2[$key]->kriteria_id[$kunci] = $nilai->kriteria_id;
                $step2[$key]->sub_kriteria_id[$kunci] = $nilai->sub_kriteria_id;
                $step2[$key]->kriteria[$kunci] = $nilai->nama_kriteria;
                $step2[$key]->namaSubKriteria[$kunci] = $nilai->nama_subKriteria;
                $step2[$key]->keterangan[$kunci] = $nilai->keterangan_subKriteria;
                $step2[$key]->sub_bobot[$kunci] = $nilai->bobot_subKriteria;
                $step2[$key]->bobot[$kunci] = $nilai->bobot_kriteria;
                $step2[$key]->jenis[$kunci] = $nilai->kriteria_jenis;
            }
        }
        // end step 2

        $subKriteriaData = [];
        foreach ($kriteria as $key => $value) {
            $sub = SubKriteria::where('id_kriteria',$value->kriteria_id)->get();
            foreach ($sub as $key2 => $s) {
                if(!isset($subKriteriaData[$key])) {
                    $subKriteriaData[$key] = new \StdClass();
                }
                $subKriteriaData[$key]->kriteria = $value->nama;
                $subKriteriaData[$key]->sub_kriteriaNama[$key2] = $s->nama;  
                $subKriteriaData[$key]->sub_kriteria[$key2] = $s->keterangan;  
                $subKriteriaData[$key]->bobot_sub[$key2] = $s->bobot;  
            }
        }

        // perhitungan vector S
        $step3 = [];
        $jumVectorS = 0;
        foreach ($step2 as $key => $s) {
            $remanen2 = null;
            $tmp = null;
            $tmp2 = 1;
            if(!isset($step3[$key])) {
                $step3[$key] = new \StdClass();
            }
            $step3[$key]->alternatif = $s->alternatif_nama;
            foreach ($s->sub_bobot as $key2 => $nilai) {
                $remanen = null;
                if ($s->jenis[$key2] == 'benefit') {
                    $tmp = pow($nilai, $step1[$s->kriteria[$key2]]);
                    $remanen = "(".$nilai."^".$step1[$s->kriteria[$key2]].")";
                } else {
                    $tmp = pow($nilai,-$step1[$s->kriteria[$key2]]);
                    $remanen = "(".$nilai."^-".$step1[$s->kriteria[$key2]].")";
                }
                $tmp2 = $tmp2 * $tmp;
                if (is_null($remanen2)) {
                    $remanen2 = $remanen;
                } else {
                    $remanen2 =  $remanen2 . ' * '. $remanen;
                }      
            }
            $step3[$key]->perhitungan = $remanen2;
            $step3[$key]->nilai = $tmp2;
            $jumVectorS+= $tmp2;
        }
        // end perhitungan vector s

        // perhitungan vector V
        $step4 = [];
        foreach ($step3 as $key => $value) {
            if(!isset($step4[$key])) {
                $step4[$key] = new \StdClass();
            }
            $step4[$key]->nilai = $value->nilai/$jumVectorS;
            $step4[$key]->perhitungan = $value->nilai.' / '.$jumVectorS;
            $step4[$key]->alternatif = $value->alternatif;
        }
        // end perhitungan vector V
        
        // perankingan
        $sort = collect($step4);
        $ranking = $sort->sortByDesc('nilai');
        $label = [];
        $dataset = [];
        foreach ($ranking as $key => $value) {
            array_push($label, $value->alternatif);
            array_push($dataset, $value->nilai);
        }

        $penilaianChart = new PenilaianLineChart;
        $penilaianChart->labels($label);
        $penilaianChart->dataset('Hasil Penilaian', 'line', $dataset)
                         ->color("rgb(255, 99, 132)")
                        ->backgroundcolor("rgb(255, 99, 132)");
        // end perangkingan

        return (new HasilExport ($ranking))->download('hasil-perangkingan.xlsx');
    }
}
