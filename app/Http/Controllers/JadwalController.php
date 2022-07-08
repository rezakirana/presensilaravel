<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testToken = session()->get('tokenUser');
        $response = Http::withToken($testToken)
            ->get(env("REST_API_ENDPOINT") . '/api/jadwal');

        $dataResponse = json_decode($response);

        $jadwals = [];
        if ($dataResponse && $dataResponse->status) {
            $jadwals = $dataResponse->data;
        }

        return view('jadwal.index', [
            'jadwals' => $jadwals,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $responseKelas = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/kelas');
        $responseMapel = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/mapel');
        $responseGuru = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/guru');
        $dataKelas = json_decode($responseKelas);
        $dataMapel = json_decode($responseMapel);
        $dataGuru = json_decode($responseGuru);

        $this->data['dataKelas'] = $dataKelas->data;
        $this->data['dataGuru'] = $dataGuru->data;
        $this->data['dataMapel'] = $dataMapel->data;

        return view('jadwal.create', $this->data);

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
            ->post(
                env("REST_API_ENDPOINT") . '/api/jadwal',
                $request->except('_token')
            );
        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil ditambahkan');

        } else {
            return redirect()->route('jadwal.create')->with('validationErrors', $data->message);
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
        $jadwal = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/jadwal/' . $id);

        $kelas = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/kelas/');
        $mapel = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/mapel');
        $guru = Http::withToken(session()->get('tokenUser'))->get(env("REST_API_ENDPOINT") . '/api/guru');

        $dataJadwal = json_decode($jadwal);
        // dd($dataJadwal->data);

        $dataKelas = json_decode($kelas);
        $dataMapel = json_decode($mapel);
        $dataGuru = json_decode($guru);

        if ($dataJadwal->status == true) {
            return view('jadwal.edit', [
                'dataJadwal' => $dataJadwal->data,
                'dataKelas' => $dataKelas->data,
                'dataMapel' => $dataMapel->data,
                'dataGuru' => $dataGuru->data,
            ]);

        } else {
            return redirect()->route('jadwal.index')->with('danger', 'Jadwal tidak ditemukan!');
        }
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
        // dd($request->all());
        $response = Http::withToken(session('tokenUser'))
            ->put(env("REST_API_ENDPOINT") . '/api/jadwal/' . $id, 
                $request->all()
            );
        $data = json_decode($response);
        if ($data->status == true) {
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil ditambahkan');
        } else {
            return redirect()->route('jadwal.create')->with('validationErrors', $data->message);
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
            ->delete(
                env("REST_API_ENDPOINT") . '/api/jadwal/' . $id);
        $data = json_decode($response);

        //dd($data);
        if ($data->status == true) {
            return redirect()->route('jadwal.index')->with('success', 'Data jadwal berhasil dihapus!');
        } else {
            return redirect()->route('jadwal.create')->with('validationErrors', $data->message);
        }
    }
}
