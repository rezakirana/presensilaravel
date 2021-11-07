<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Jadwal;
use App\Model\Dokter;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 'admin' || Auth::user()->type == 'pasien') {
            $this->data['jadwals'] = Jadwal::all();
        }elseif (Auth::user()->type == 'dokter') {
            $this->data['jadwals'] = Jadwal::where('dokter_id',Auth::user()->dokter->id)->get();
        }
        return view('jadwal.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['dokters'] = Dokter::all();

        return view('jadwal.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'dokter_id' => 'required|integer|exists:dokter,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'mulai' => 'required',
            'selesai' => 'required'
        ]);
        
        $jadwal = new Jadwal();
        $jadwal->dokter_id = $request->dokter_id;
        $jadwal->hari = $request->hari;
        $jadwal->jam_praktik = $request->mulai.'-'.$request->selesai;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
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
        $jadwal = Jadwal::findOrFail($id);
        $tmp = explode('-',$jadwal->jam_praktik);
        $jadwal->mulai = $tmp[0];
        $jadwal->selesai = $tmp[1];
        $this->data['jadwal'] = $jadwal;
        $this->data['dokters'] = Dokter::all();

        return view('jadwal.edit',$this->data);
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
            'dokter_id' => 'required|integer|exists:dokter,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'mulai' => 'required',
            'selesai' => 'required'
        ]);
        
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->dokter_id = $request->dokter_id;
        $jadwal->hari = $request->hari;
        $jadwal->jam_praktik = $request->mulai.'-'.$request->selesai;
        $jadwal->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::where('id', $id)->delete();

        return redirect()->route('jadwal.index')->with('success', 'Berhasil menghapus data');
    }
}
