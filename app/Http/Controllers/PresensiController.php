<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/presensi');
        $dataResponse = json_decode($response);

        $presensi = $dataResponse->data;
        return view('presensi.index', [
            'dataPresensi' => $presensi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responseKelas = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/kelas');
        $dataResponseKelas = json_decode($responseKelas);

        $responseMapel = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/mapel');
        $dataResponseMapel = json_decode($responseMapel);


        $responseJadwal = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/jadwal');
        $dataResponseJadwal = json_decode($responseJadwal);

        return view('presensi.create', [
            'dataKelas' => $dataResponseKelas->data,
            'dataMapel' => $dataResponseMapel->data,
            'dataJadwal'  => $dataResponseJadwal->data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session()->get('tokenUser'))
            ->post(env("REST_API_ENDPOINT") . '/api/presensi', $request->except('_token'));
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil ditambahkan');
        } else {
            return redirect()->route('presensi.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $response = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/presensi/' . $id);
        $dataResponse = json_decode($response);

        $presensi = $dataResponse->data;
        $presensiDetail = $dataResponse->data_detail;


        $status = [
            0 => 'Hadir',
            1 => 'Sakit',
            2 => 'Izin',
            3 => 'Absen',
        ];

        // Hadir, sakit , izin, absesn
        return view('presensi.show', [
            'dataPresensi' => $presensi,
            'dataPresensiDetail' => $presensiDetail,
            'dataStatus' => $status,
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
        $response = Http::withToken(session()->get('tokenUser'))
            ->put(env("REST_API_ENDPOINT") . '/api/presensi/' . $id, $request->except('_token'));
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('presensi.show', $id)->with('success', 'Data presensi berhasil diubah');
        } else {
            return redirect()->route('presensi.show', $id)->with('failed', 'Data presensi gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withToken(session('tokenUser'))
            ->delete(env("REST_API_ENDPOINT") . '/api/presensi/' . $id);
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil dihapus!');
        } else {
            return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil dihapus!');
        }
    }
}
