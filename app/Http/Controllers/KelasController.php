<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KelasController extends Controller
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
            ->get(env("REST_API_ENDPOINT").'/api/kelas');
            
            $dataResponse = json_decode($response);
            $kelas = $dataResponse->data;
    
            return view('kelas.index',[
                'data_kelas' => $kelas
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $testToken = session()->get('tokenUser');
            $response = Http::withToken($testToken)
            ->post(env("REST_API_ENDPOINT").'/api/kelas',[
                'kode_kelas' => $request->kode_kelas,
                'nama_kelas' => $request->nama_kelas
            ]);
            
            $data = json_decode($response);
    
             if ($data && $data->status == true) {
                return redirect()->route('kelas.index')->with('success','Data kelas berhasil ditambahkan');
            } else {
                return redirect()->route('kelas.create')->with('validationErrors', ['message' => 'Data gagal disimpan']);
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
        $response = Http::withToken(session()->get('tokenUser'))
        ->get(env("REST_API_ENDPOINT").'/api/kelas/'.$id);
        $dataResponse = json_decode($response);
        
        if ($dataResponse->status == true) { 
            
            return view('kelas.edit', [
                'kelas' => $dataResponse->data
            ]);
        } else {
            return redirect()->route('kelas.index')->with('danger', 'Kelas tidak ditemukan!');
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
        ->put(env("REST_API_ENDPOINT").'/api/kelas/'.$id,
        [
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
        ]);

        $data = json_decode($response);

        if ($data->status == true) {
         return redirect ()->route('kelas.index')->with('success','Kelas berhasil diupdate!');
        }
        else {
         return redirect ()->route('kelas.create')->with('validationErrors',$data->message);
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
            env("REST_API_ENDPOINT").'/api/kelas/'.$id);  
        $data = json_decode($response);       

        //dd($data);
        if ($data->status == true) {
                return redirect()->route('kelas.index')->with('success','Kelas user berhasil dihapus!');
        } else {     
                return redirect()->route('kelas.create')->with('validationErrors',$data->message);
            }    
    }
}
