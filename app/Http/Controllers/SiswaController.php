<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Siswa;
use App\Model\Kelas;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['data'] = Siswa::all();
        
        return view('siswa.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['kelas'] = Kelas::all();

        return view('siswa.create', $this->data);
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
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',                
            'tempat_lahir' => 'required',                
            'tgl_lahir' => 'required',                
            'phone_number' => 'required',                
            'alamat' => 'required',                
            'nama_ortu' => 'required',                
            'tahun_masuk' => 'required',                
            'email' => 'required|unique:siswa,email',                
            'gender' => 'required|in:laki-laki,perempuan',
            'kelas_id' => 'required|exists:kelas,id'
        ]);
        $ttl = explode('/',$request->tgl_lahir);          
        $tgl = $ttl[2].'-'.$ttl[0].'-'.$ttl[1];
        $request->merge(['tgl_lahir' => $tgl]);
        Siswa::create($request->except('_token'));

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['siswa'] = Siswa::findOrFail($id);

        return view('siswa.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['kelas'] = Kelas::all();
        $siswa = Siswa::findOrFail($id);
        $ttl = explode('-',$siswa->tgl_lahir->format('Y-m-d'));
        $siswa->ttl = $ttl[1].'/'.$ttl[2].'/'.$ttl[0];        
        $this->data['siswa'] = $siswa;

        return view('siswa.edit', $this->data);
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
            'nis' => 'required|unique:siswa,nis,'.$id,
            'nama' => 'required',                
            'tempat_lahir' => 'required',                
            'tgl_lahir' => 'required',                
            'phone_number' => 'required',                
            'alamat' => 'required',                
            'nama_ortu' => 'required',  
            'tahun_masuk' => 'required',                              
            'email' => 'required|unique:siswa,email,'.$id,                
            'gender' => 'required|in:laki-laki,perempuan',
            'kelas_id' => 'required|exists:kelas,id'
        ]);
        $ttl = explode('/',$request->tgl_lahir);          
        $tgl = $ttl[2].'-'.$ttl[0].'-'.$ttl[1];
        $request->merge(['tgl_lahir' => $tgl]);
        Siswa::where('id',$id)->update($request->except(['_token','_method']));

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::where('id', $id)->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
