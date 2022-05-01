<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Presensi;
use App\Model\Jadwal;
use App\Model\Kelas;
use App\Model\Siswa;
use App\Model\Semester;
use App\Model\Account;
use App\Model\Mapel;
use App\Model\TahunAjaran;
use Carbon\Carbon;
use App\Mail\EmailWaliSiswa;
use PDF;
use App\Exports\PresensiSingleExport;
use App\Exports\PresensiAllExport;
use Maatwebsite\Excel\Facades\Excel;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == 'guru') {
            $this->data['data'] = Jadwal::where('guru_id',auth()->user()->guru->id)->paginate(2);
        } else {
            $this->data['data'] = Jadwal::orderBy('created_at','DESC')->paginate(2);
        }

        return view('presensi.index', $this->data);
    }

    public function data_presensi(Request $request)
    {
        $this->data['semester'] = Semester::all();
        $this->data['kelas'] = Kelas::all();
        $this->data['mapel'] = Mapel::all();
        $this->data['guru'] = Account::all();
        $this->data['tahunAjaran'] = TahunAjaran::all();
        if (auth()->user()->type == 'guru') {
            $data = Jadwal::where('guru_id',auth()->user()->guru->id)->where('is_active',1);
        } else {
            $data = Jadwal::where('is_active',1)->orderBy('created_at','DESC');
        }
        if ($request->isMethod('post')) {            
            if ($request->session()->has('data_tahun_ajaran')) {
                $request->session()->forget('data_tahun_ajaran');
            }
            if ($request->session()->has('data_semester')) {
                $request->session()->forget('data_semester');
            }
            if ($request->session()->has('data_mapel')) {
                $request->session()->forget('data_mapel');
            }
            if ($request->session()->has('data_guru')) {
                $request->session()->forget('data_guru');
            }
            if ($request->session()->has('data_kelas')) {
                $request->session()->forget('data_kelas');
            }
            $request->session()->put('data_tahun_ajaran', $request->tahun_ajaran_id);
            $request->session()->put('data_semester', $request->semester_id);
            $request->session()->put('data_mapel', $request->mapel_id);
            $request->session()->put('data_guru', $request->guru_id);
            $request->session()->put('data_kelas', $request->kelas_id);
            if ($request->tahun_ajaran_id) {
                $data = $data->where('tahun_ajaran_id',$request->tahun_ajaran_id);
            }
            if ($request->semester_id) {
                $data = $data->where('semester_id',$request->semester_id);
            }
            if ($request->mapel_id) {
                $data = $data->where('mapel_id',$request->mapel_id);
            }
            if ($request->guru_id) {
                $data = $data->where('guru_id',$request->guru_id);
            }
            if ($request->kelas_id) {
                $data = $data->where('kelas_id',$request->kelas_id);
            }
        } else {
            if (session()->get('tahun_ajaran')) {
                $data = $data->where('tahun_ajaran_id',session()->get('tahun_ajaran'));
            }
            if (session()->get('data_semester')) {
                $data = $data->where('semester_id',session()->get('data_semester'));
            }            
            if (session()->get('data_mapel')) {
                $data = $data->where('mapel_id',session()->get('data_mapel'));
            }            
            if (session()->get('data_guru')) {
                $data = $data->where('guru_id',session()->get('data_guru'));
            }            
            if (session()->get('data_kelas')) {
                $data = $data->where('kelas_id',session()->get('data_kelas'));
            }            
        }
        $this->data['data'] = $data->paginate(15);
        
        return view('presensi.index', $this->data);
    }

    public function list_presensi($id)
    {
        $jadwal = Jadwal::findOrFail($id);        
        if (!$jadwal) {
            return redirect()->route('presensi.index')->with('warning', 'Jadwal tidak ditemukan!');
        }
        $this->data['presensi'] = Presensi::where('jadwal_id',$jadwal->id)->orderBy('created_at','ASC')->get();
        $this->data['jadwal'] = $jadwal;

        return view('presensi.list',$this->data);
    }

    public function add_presensi($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        if (!$jadwal) {
            return redirect()->route('presensi.index')->with('warning', 'Jadwal tidak ditemukan!');
        }

        $this->data['jadwal'] = $jadwal;

        return view('presensi.create',$this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('presensi.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'jadwal_id' => 'required|exists:jadwal,id',            
            'kelas_id' => 'required|exists:kelas,id',            
            'pertemuan' => 'required|string',
            'materi_pertemuan' => 'required|string',
            'silabus' => 'required'
        ]);
        $kelas = Kelas::findOrFail($request->kelas_id);
        $presensi = new Presensi();
        $presensi->jadwal_id = $request->jadwal_id;
        $presensi->tanggal = Carbon::now()->format('Y-m-d');
        $presensi->pertemuan = $request->pertemuan;
        $presensi->materi_pertemuan = $request->materi_pertemuan;
        $presensi->silabus = $request->silabus;
        $tmpData = [];
        foreach ($kelas->siswas as $key => $siswa) {
            $tmp = [];
            $tmp['id'] = $siswa->id;
            $tmp['nis'] = $siswa->nis;
            $tmp['nama'] = $siswa->nama;
            $tmp['status'] = null;
            $tmp['keterangan'] = null;
            array_push($tmpData,$tmp);
        }
        $presensi->data = json_encode($tmpData);
        $presensi->save();        

        return redirect()->route('lengkapi.presensi',$presensi->id);
    }

    public function lengkapi_presensi($id)
    {        
        $data = Presensi::findOrFail($id);
        $data->data = json_decode($data->data);
        $this->data['data'] = $data;

        return view('presensi.detail', $this->data);
    }

    public function detail_presensi($id)
    {
        $presensi = Presensi::findOrFail($id);
        if (!$presensi) {
            return redirect()->route('list.presensi',$presensi->jadwal_id)->with('warning', 'Presensi tidak ditemukan!');
        }
        $presensi->data = json_decode($presensi->data);
        $this->data['data'] = $presensi;

        return view('presensi.detail_presensi',$this->data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('presensi.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('presensi.edit', $this->data);
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
        $this->validate($request,[
            'id' => 'required|array',            
            'nis' => 'required|array',            
            'nama' => 'required|array',           
            'keterangan' => 'required|array'
        ]);
        $presensi = Presensi::findOrFail($id);
        $data = [];
        $dataStatus = ['ijin','sakit','alpha', 'izin'];
        foreach ($request->id as $key => $idSiswa) {
            $tmp = [];
            $tmp['id'] = $idSiswa;
            $tmp['nis'] = $request->nis[$key];
            $tmp['nama'] = $request->nama[$key];
            $status = 'siswa'.$key;
            $tmp['status'] = $request->$status;
            $tmp['keterangan'] = $request->keterangan[$key];
            if (in_array($request->$status, $dataStatus)) {
                $siswa = Siswa::findOrFail($idSiswa);
                $dataEmail = [
                    'title' => 'Laporan Presensi Harian Siswa',                    
                    'namaSiswa' => $siswa->nama,
                    'gender' => $siswa->gender,
                    'alamat' => $siswa->alamat,
                    'kelas' => $siswa->kelas->nama_kelas,
                    'namaWali' => $siswa->nama_ortu,
                    'guru' => $presensi->jadwal->guru->nama,
                    'mapel' => $presensi->jadwal->mapel->nama_mapel,
                    'hari' => $presensi->jadwal->hari,
                    'jamPelajaran' => $presensi->jadwal->jam_pelajaran,
                    'semester' => $presensi->jadwal->semester->semester,
                    'tahun_ajaran' => $presensi->jadwal->tahun_ajaran->tahun_ajaran,
                    'status' => $request->$status,
                    'tanggal' => $presensi->tanggal,
                    'alasan' => $request->keterangan[$key]
                ];               
                \Mail::to($siswa->email)->send(new EmailWaliSiswa($dataEmail));
            }
            array_push($data,$tmp);
        }
        $presensi->data = json_encode($data);
        $presensi->save();

        return redirect()->route('lengkapi.presensi',$id)->with('success', 'Presensi berhasil disimpan!');
    }

    public function cetak_semua($id)
    {
        $presensi = Presensi::where('jadwal_id',$id)->orderBy('created_at','ASC')->get();                
        $getNamaSiswa = [];
        if (count($presensi)) {
            foreach (json_decode($presensi[0]->data) as $kunci => $nilai) {
                $tmpArray = [];
                $tmpArray['nis'] = $nilai->nis;
                $tmpArray['nama'] = $nilai->nama;
                $tmpArray['hadir'] = 0;
                $tmpArray['izin'] = 0;
                $tmpArray['sakit'] = 0;
                $tmpArray['alpha'] = 0;
                array_push($getNamaSiswa,$tmpArray);
            }
            foreach ($presensi as $key => $value) {
                foreach (json_decode($value->data) as $key2 => $value2) {
                    if ($value2->status == 'hadir') {
                        $getNamaSiswa[$key2]['hadir'] = (int)$getNamaSiswa[$key2]['hadir'] + 1;
                    }elseif ($value2->status == 'ijin' || $value->status == 'izin') {
                        $getNamaSiswa[$key2]['izin'] = (int)$getNamaSiswa[$key2]['izin'] + 1;
                    }elseif ($value2->status == 'sakit') {
                        $getNamaSiswa[$key2]['sakit'] = (int)$getNamaSiswa[$key2]['sakit'] + 1;
                    }else {
                        $getNamaSiswa[$key2]['alpha'] = (int)$getNamaSiswa[$key2]['alpha'] + 1;
                    }
                }            
            }
        }
        
        $data = [
                'data' => $presensi,
                'getNamaSiswa' => $getNamaSiswa
            ];
        $pdf = PDF::loadView('presensi.pdf_semua',$data);

        return $pdf->download('laporan_presensi.pdf');
    }

    public function export_semua($id)
    {
        $presensi = Presensi::where('jadwal_id',$id)->orderBy('created_at','ASC')->get();  
        $nama = 'no_data.xlsx';
        $getNamaSiswa = [];
        if (count($presensi)) {
            $nama = $presensi[0]->jadwal->mapel->nama_mapel.'-'.$presensi[0]->jadwal->kelas->nama_kelas.'.xlsx';                    
            foreach (json_decode($presensi[0]->data) as $kunci => $nilai) {
                $tmpArray = [];
                $tmpArray['nis'] = $nilai->nis;
                $tmpArray['nama'] = $nilai->nama;
                $tmpArray['hadir'] = 0;
                $tmpArray['izin'] = 0;
                $tmpArray['sakit'] = 0;
                $tmpArray['alpha'] = 0;
                array_push($getNamaSiswa,$tmpArray);
            }
            foreach ($presensi as $key => $value) {
                foreach (json_decode($value->data) as $key2 => $value2) {
                    if ($value2->status == 'hadir') {
                        $getNamaSiswa[$key2]['hadir'] = (int)$getNamaSiswa[$key2]['hadir'] + 1;
                    }elseif ($value2->status == 'ijin' || $value->status == 'izin') {
                        $getNamaSiswa[$key2]['izin'] = (int)$getNamaSiswa[$key2]['izin'] + 1;
                    }elseif ($value2->status == 'sakit') {
                        $getNamaSiswa[$key2]['sakit'] = (int)$getNamaSiswa[$key2]['sakit'] + 1;
                    }else {
                        $getNamaSiswa[$key2]['alpha'] = (int)$getNamaSiswa[$key2]['alpha'] + 1;
                    }
                }            
            }
        }        

        return Excel::download(new PresensiAllExport($presensi,$getNamaSiswa), $nama); 
    }

    public function cetak_satuan($id)
    {
        $presensi = Presensi::findOrFail($id);
        $presensi->data = json_decode($presensi->data);

        $data = ['data' => $presensi];

        $pdf = PDF::loadView('presensi.pdf_satuan', $data);

        return $pdf->download('laporan_presensi.pdf');
    }

    public function export_satuan($id)
    {
        $presensi = Presensi::with('jadwal')->where('id',$id)->first();
        $presensi->data = json_decode($presensi->data);
        $nama = $presensi->jadwal->mapel->nama_mapel.'-'.$presensi->jadwal->kelas->nama_kelas.'.xlsx';

        return Excel::download(new PresensiSingleExport($presensi), $nama);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);
        $idJadwal = $presensi->jadwal_id ;

        Presensi::where('id', $id)->delete();

        return redirect()->route('list.presensi',$idJadwal)->with('success', 'Data presensi berhasil dihapus!');
    }
}
