<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapelController extends Controller
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
            ->get(env("REST_API_ENDPOINT") . '/api/mapel');

        $dataResponse = json_decode($response);
        $mapels = $dataResponse->data;

        return view('mapel.index', [
            'mapels' => $mapels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::withToken(session('tokenUser'))
            ->post(env("REST_API_ENDPOINT") . '/api/mapel', [
                'kode_mapel' => $request->kode_mapel,
                'nama_mapel' => $request->nama_mapel]);

        $data = json_decode($response);
        if ($data && $data->message == 'success') {
            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil ditambahkan');
        } else {
            return redirect()->route('mapel.create')->with('validationErrors', ['message' => 'Data gagal disimpan']);
        }

        // return view('mapel.index', $this->data);
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
        $testToken = session()->get('tokenUser');
        $response = Http::withToken($testToken)
            ->get(env("REST_API_ENDPOINT") . '/api/mapel/'. $id); // masuk show berarti ya

        $dataResponse = json_decode($response);

        if ($dataResponse->status == true) {
            return view('mapel.edit',[
                'mapel' => $dataResponse->data
            ]);
        } else {
            return redirect()->route('mapel.index')->with('danger', 'Mapel tidak ditemukan!');
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
        $response = Http::withToken(session('tokenUser'))
            ->put(env("REST_API_ENDPOINT") . '/api/mapel/' . $id, [
                'kode_mapel' => $request->kode_mapel,
                'nama_mapel' => $request->nama_mapel]);
        $data = json_decode($response);
        if ($data->status == true) {
            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil ditambahkan');
        } else {
            return redirect()->route('mapel.create')->with('validationErrors', $data->message);
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
                env("REST_API_ENDPOINT") . '/api/mapel/' . $id);
        $data = json_decode($response);

        //dd($data);
        if ($data && $data->status == true) {
            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil dihapus!');
        } else {
            return redirect()->route('mapel.create')->with('validationErrors', $data->message);
        }
    }
}
