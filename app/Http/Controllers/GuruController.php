<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class GuruController extends Controller
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
        ->get(env("REST_API_ENDPOINT").'/api/guru');
        

        $dataResponse = json_decode($response);
        $gurus = $dataResponse->data;


        return view('guru.index',[
            'gurus' => $gurus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::withToken(session()->get('tokenUser'))
        ->get(env("REST_API_ENDPOINT").'/api/user-untuk-guru');
        $dataResponse = json_decode($response);
        $this->data['users'] = $dataResponse->data;

        return view('guru.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        $ttl = explode('/',$request->tgl_lahir);
        $request->merge([
            'tgl_lahir' => $ttl[2].'-'.$ttl[0].'-'.$ttl[1]
        ]);
        $response = Http::withToken(session('tokenUser'))
                        ->post(
                            env("REST_API_ENDPOINT").'/api/guru',
                            $request->except('_token')
                        );  
       

        $data = json_decode($response);
        if ($data && $data->status == true) {
            return redirect()->route('guru.index')->with('success','Data guru berhasil ditambahkan!');
        } else {
            return redirect()->route('guru.create')->with('validationErrors', ['message' => 'Gagal menyimpan data']);
        }
        return view ('guru.index',$this->data);
    }

    public function account_profile(Request $request)
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
        // $ttl = explode('/',$request->tgl_lahir);
        // $request->merge([
        //     'tgl_lahir' => $ttl[2].'-'.$ttl[0].'-'.$ttl[1]
        // ]);

        $responseGuru = Http::withToken(session('tokenUser'))
                        ->get(env("REST_API_ENDPOINT").'/api/guru/'.$id);  
        $guru = json_decode($responseGuru);

        $responseUserGuru = Http::withToken(session()->get('tokenUser'))
                            ->get(env("REST_API_ENDPOINT").'/api/user-untuk-guru');
        $userGuru = json_decode($responseUserGuru);
                            
        // dd($kedua);

        if ($guru->status == true) {

            $dataGuru = $guru->data;

            // dd($dataGuru);
            if ($dataGuru->tgl_lahir){
                $ttl = explode('-',$dataGuru->tgl_lahir);
                $dataGuru->tgl_lahir =$ttl[1].'/'.$ttl[2].'/'.$ttl[0];
            }

            return view('guru.edit', [
                'guru' => $dataGuru,
                'users' => $userGuru->data
            ]);
        } 
        return view ('guru.index');

        // if ($data->status == true) {
        //     return redirect()->route('guru.edit', [
        //         'guru'  => $guru->data
        //     ]);
        // } else {
        //     return redirect()->route('guru.create')->with('validationErrors',$data->message);
        // }
        // return view ('guru.index',$this->data);

        // //
        // $response = Http::withToken(session()->get('tokenUser'))
        // ->get(env("REST_API_ENDPOINT").'/api/guru/'.$id);
        // $dataResponse = json_decode($response);

        // $responseDataDepedencies = Http::withToken(session()->get('tokenUser'))
        // ->get(env("REST_API_ENDPOINT").'/api/kelas');
        // $dataDepedencies = json_decode($responseDataDepedencies);
        
        // if ($dataResponse->status == true) {
        //     $siswa = $dataResponse->data;
        //     $siswa = $dataResponse->data;
        //     $ttl = explode('-',$guru->tgl_lahir);
        //     $siswa->tgl_lahir =$ttl[1].'/'.$ttl[2].'/'.$ttl[0];
        //     $this->data['guru'] = $guru;
        //     $this->data['users'] = $dataResponse->data;

        //     return view('guru.edit',$this->data);
            
        // } else {
        //     return redirect()->route('guru.index')->with('danger', 'Data guru tidak ditemukan!');
        // }
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
        $ttl = explode('/',$request->tgl_lahir);
        $request->merge([
            'tgl_lahir' => $ttl[2].'-'.$ttl[0].'-'.$ttl[1]
        ]);
        $response = Http::withToken(session('tokenUser'))
                        ->put(env("REST_API_ENDPOINT").'/api/guru/'.$id,
                            $request->except(['_token','_method'])
                        );  
        $data = json_decode($response);
        //dd($data);
        if ($data->status == true) {
            return redirect()->route('guru.index')->with('success','Data guru berhasil ditambahkan!');
        } else {
            return redirect()->route('guru.create')->with('validationErrors',$data->message);
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
                            env("REST_API_ENDPOINT").'/api/guru/'.$id);  
        $data = json_decode($response);

        //dd($data);
        if ($data->status == true) {
            return redirect()->route('guru.index')->with('success','Data guru berhasil dihapus!');
        } 
    }

    public function account()
    {
        return view('guru.account');
    }

    public function account_save(Request $request)
    {
        // 
    }
}
