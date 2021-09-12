<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Gejala;
use App\Model\Penyakit;
use App\Model\Rule;
use App\User;
use App\Model\Konsultasi;
use Illuminate\Support\Facades\Auth;
use DB;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role->role != 'user') {
            $this->data['konsultasi'] = Konsultasi::join('users', 'users.id', '=', 'konsultasi.user_id')
                                                    ->select([
                                                        'users.id',
                                                        'users.name',
                                                        'konsultasi.id as idKonsultasi',
                                                        DB::raw("COUNT(konsultasi.id) as jumlahKonsultasi")
                                                    ])
                                                    ->groupBy('users.id')
                                                    ->orderBy('konsultasi.id', 'DESC')
                                                    ->get();
        }else {
            $this->data['konsultasi'] = Konsultasi::where('user_id', Auth::id())->get();
        }
        
        $this->data['role'] = Auth::user()->role->role;

        return view('konsultasi.index', $this->data);
    }

    public function konsultasi_pengguna($id)
    {
        if (Auth::user()->role->role == 'user' && Auth::id() != $id) {

            return redirect()->route('konsultasi.index');

        }
        $this->data['konsultasi'] = Konsultasi::where('user_id', $id)->get();
        
        $this->data['user'] = User::find($id);

        return view('konsultasi.pengguna', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['gejalas'] = Gejala::all(['id', 'kode', 'gejala']);

        return view('konsultasi.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'gejala' => 'required|min:2'
        ],
        [
            'gejala.min' => 'Gejala yang di pilih minimal 2',
            'gejala.required' => 'Gejala wajib dipilih'
        ]);

        $gejalas = Gejala::whereIn('id', $request->gejala)->get(['id', 'kode', 'gejala']);
        $penyakits = Penyakit::orderBy('id')->get();
        $jmlRule = Rule::groupBy('penyakit_id')->get(['penyakit_id'])->count();
        
        $jmlPenyakit = $penyakits->count();
        if (!$jmlPenyakit) {
            session()->flash('danger', 'Maaf, terjadi kesalahan. Data penyakit belum ditambahkan, silakan hubungi administrator!');

            return redirect()->route('konsultasi.index');
        }
        if ($jmlPenyakit != $jmlRule) {
            session()->flash('danger', 'Maaf, terjadi kesalahan. Terdapat penyakit yang belum memiliki rule dengan gejala yang dipilih!');

            return redirect()->route('konsultasi.index');
        }
        $jmlKonsultasi = Konsultasi::where('user_id',Auth::id())->count();
        if ($jmlKonsultasi) {
            $periode = (int)$jmlKonsultasi + 1;
        }else {
            $periode = 1;
        }
        $konsultasi = new Konsultasi();
        $konsultasi->user_id = Auth::id();
        $konsultasi->periode_konsultasi = $periode;
        $konsultasi->gejala = json_encode($gejalas);
        $konsultasi->save();

    	return redirect()->route('konsultasi.show', $konsultasi->id);
        
    }

    private function langkahSatu($penyakits, $gejalaParam)
    {
        $no = 0;
        foreach ($penyakits as $penyakit) {
            $dataLangkahSatu[] = [
                                'id' => $penyakit->id,
                                'kode_penyakit' => $penyakit->kode,
                                'nama_penyakit' => $penyakit->penyakit,
                                'probabilitas' => $penyakit->probabilitas,
                                'keterangan' => $penyakit->keterangan,
                                'penanganan' => $penyakit->penanganan,
                                'image' => $penyakit->image,
                                'gejala' => null,
                                'sum' => null,
                                'persen' => null
                            ];

            $gejalaTerpilih = collect($gejalaParam)
                                    ->sort()
                                    ->values()
                                    ->all();

            foreach ($gejalaTerpilih as $gejala) {
                $rule = Rule::select('rule.*')
                                ->where('penyakit_id', $penyakit->id)
                                ->where('gejala_id', $gejala)
                                ->first();
                $dataGejala = Gejala::select('gejala.*')
                                ->where('id', $gejala)
                                ->first();

                if ($rule) {
                    $bobot = $rule->bobot;
                } else {
                    $bobot = 0;
                }

                $dataLangkahSatu[$no]['gejala'][] = [
                                                'gejala_id' => $gejala,
                                                'kode_gejala' => $dataGejala->kode,
                                                'nama_gejala' => $dataGejala->gejala,
                                                'bobot' => $bobot,
                                                'atas' => null,
                                                'bawah' => null,
                                                'dibagi' => null
                                                ];
            }
            $no++;
        }

        return $dataLangkahSatu;
    }

    private function langkahDua($dataLangkahSatu, $gejalaParam)
    {
        for ($i=0; $i < count($dataLangkahSatu); $i++) {
            $gejalaTerpilih = collect($gejalaParam)
                                    ->sort()
                                    ->values()
                                    ->all();
            for ($j=0; $j < count($gejalaTerpilih); $j++) {
                $dataLangkahSatu[$i]['gejala'][$j]['atas'] = $dataLangkahSatu[$i]['gejala'][$j]['bobot'] * $dataLangkahSatu[$i]['probabilitas'];
                for ($k=0; $k < count($dataLangkahSatu); $k++) {
                    $bawah[] = $dataLangkahSatu[$k]['gejala'][$j]['bobot'] * $dataLangkahSatu[$k]['probabilitas'];
                }

                $dataLangkahSatu[$i]['gejala'][$j]['bawah'] = array_sum($bawah);
                unset($bawah);
                $dibagi = 0;
                if ($dataLangkahSatu[$i]['gejala'][$j]['bawah']) {
                    $dibagi = $dataLangkahSatu[$i]['gejala'][$j]['atas'] / $dataLangkahSatu[$i]['gejala'][$j]['bawah'];
                }
                $dataLangkahSatu[$i]['gejala'][$j]['dibagi'] = round($dibagi, 6);
                $arrDibagi[] = $dataLangkahSatu[$i]['gejala'][$j]['dibagi'];
            }

            $dataLangkahSatu[$i]['sum'] = array_sum($arrDibagi);
            unset($arrDibagi);

            $dataLangkahSatu[$i]['persen'] = $dataLangkahSatu[$i]['sum'] * 100 / count($gejalaTerpilih);
        }

        return $dataLangkahSatu;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $konsultasi = Konsultasi::find($id);
        $penyakits = Penyakit::orderBy('id')->get();
        $gejalaParam = [];
        foreach (json_decode($konsultasi->gejala) as $key => $value) {
            array_push($gejalaParam,$value->id);
        }
        $dataLangkahSatu = $this->langkahSatu($penyakits, $gejalaParam);

        $dataLangkahDua = $this->langkahDua($dataLangkahSatu, $gejalaParam);
        $sum = [];
        foreach ($dataLangkahDua as $item) {
            $sum[] = $item['sum'];
        }
        array_multisort($sum, SORT_DESC, $dataLangkahDua);
        $hasil = collect($dataLangkahDua)
                        ->sortByDesc(function($value, $key) {
                            return $value['persen'];
                        })
                        ->values()
                        ->first();
        
        return view('konsultasi.show', [
            'hasilSemua' => $dataLangkahDua,
            'hasilTerpilih' => $hasil,
            'gejala' => json_decode($konsultasi->gejala)
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $konsultasi = Konsultasi::where([
                                            'id' => $id,
                                            'user_id' => Auth::id()
                                        ])->first();
        $konsultasi->gejala = json_decode($konsultasi->gejala);
        $gejalas = Gejala::all(['id', 'kode', 'gejala']);
        foreach ($gejalas as $key => $gejala) {
            $gejala->attr = null;
            foreach ($konsultasi->gejala as $key2 => $oldGejala) {
                if ($gejala->id == $oldGejala->id) {
                    $gejala->attr = 'checked';
                }
            }
        }
        $this->data['gejalas'] = $gejalas;
        $this->data['konsultasi'] = $konsultasi;

        return view('konsultasi.edit', $this->data);
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
        $this->validate($request,
        [
            'gejala' => 'required|min:2'
        ],
        [
            'gejala.min' => 'Gejala yang di pilih minimal 2',
            'gejala.required' => 'Gejala wajib dipilih'
        ]);

        $gejalas = Gejala::whereIn('id', $request->gejala)->get(['id', 'kode', 'gejala']);
        $penyakits = Penyakit::orderBy('id')->get();
        $jmlRule = Rule::groupBy('penyakit_id')->get(['penyakit_id'])->count();
        
        $jmlPenyakit = $penyakits->count();
        
        if ($jmlPenyakit != $jmlRule) {
            session()->flash('danger', 'Maaf, terjadi kesalahan. Terdapat penyakit yang belum memiliki rule dengan gejala yang dipilih!');

            return redirect()->route('konsultasi.edit', $id);
        }        
        $konsultasi = Konsultasi::find($id);
        $konsultasi->gejala = json_encode($gejalas);
        $konsultasi->save();

    	return redirect()->route('konsultasi.show', $konsultasi->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Konsultasi::where('id', $id)->delete();

        return redirect()->route('konsultasi.index')->with('success', 'Berhasil menghapus data');
    }
}
