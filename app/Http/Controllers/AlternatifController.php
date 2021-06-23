<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Alternatif;
use App\Model\Kriteria;
use App\Model\NilaiAlternatif;
use Illuminate\Support\Facades\Auth;

class AlternatifController extends Controller
{
    public function __construct() {

        $this->middleware('isAdmin', ['only' => ['create','store','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatif = Alternatif::all();
        $destination_path = public_path('/img/image/alternatif/');
        foreach ($alternatif as $key => $value) {
            $alternatifImage = $destination_path.$value->image;
            if (is_null($value->gambar) || !file_exists($alternatifImage)) {
                $value->gambar = null;
            }
        }

        return view('alternatif.index')->with('data', $alternatif);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriterias = Kriteria::all();

        return view('alternatif.create')->with('kriterias', $kriterias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Alternatif;
        if (!is_null($request->gambar)) {
            $this->validate($request,[
                'nilai' => 'required|array',
                'nama' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
             ]);
            
            $fileGambar = $request->file('gambar');
            $destination_path = public_path('/img/image/alternatif/');
            $imageName = time().'-'.$fileGambar->getClientOriginalName();
            $simpanGambar = $fileGambar->move($destination_path, $imageName);
            $data->gambar = $imageName;
        }else{
            $this->validate($request,[
                'nilai' => 'required|array',
                'nama' => 'required'
             ]);
        }
        $data->nama = request('nama');
        $data->save();

        if(isset($request->nilai)){
            foreach (request('nilai') as $key => $value) {
                $data_nilai = new NilaiAlternatif;
                $data_nilai->id_alternatif = $data->id;
                $data_nilai->id_sub_kriteria = $value;
                $data_nilai->save();
            }
        }

        return redirect()->route('alternatif.index')->with('success',
        'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Alternatif::with('nilai_alternatif.sub_kriteria.kriteria')->where('id', $id)->first();
        if($data){
            return view('alternatif.nilai_alternatif')->with('data', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alternatif = Alternatif::with('nilai_alternatif')->where('id', $id)->first();
        $data = Kriteria::with('sub_kriteria')->get();
        if($data){
            return view('alternatif.edit')->with(['data' => $data, 'alternatif' => $alternatif]);
        }
        return redirect()->route('alternatif.index');
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
        $alternatif = Alternatif::find($id);
        if (!is_null($request->gambar)) {
            $this->validate($request,[
                'nilai' => 'required|array',
                'nama' => 'required',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
             ]);
            
            $fileGambar = $request->file('gambar');
            $destination_path = public_path('/img/image/alternatif/');
            $alternatifImage = $destination_path.$alternatif->gambar;
            if (file_exists($alternatifImage) && !is_null($alternatif->gambar)) {
                unlink($alternatifImage);
            }
            $imageName = time().'-'.$fileGambar->getClientOriginalName();
            $simpanGambar = $fileGambar->move($destination_path, $imageName);
            $alternatif->gambar = $imageName;
        }else{
            $this->validate($request,[
                'nilai' => 'required|array',
                'nama' => 'required'
             ]);
        }
        $alternatif->nama = $request->nama;
        $alternatif->save();
        $delete =  NilaiAlternatif::where('id_alternatif', $alternatif->id)->delete();
        foreach (request('nilai') as $key => $value) {
            $data_nilai = new NilaiAlternatif;
            $data_nilai->id_alternatif = $alternatif->id;
            $data_nilai->id_sub_kriteria = $value;
            $data_nilai->save();
        }
        return redirect()->route('alternatif.index')->with('success',
        'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Alternatif::where('id', $id)->first();
        if($data){
            $destination_path = public_path('/img/image/alternatif/');
            $alternatifImage = $destination_path.$data->gambar;
            if (file_exists($alternatifImage) && !is_null($data->gambar)) {
                unlink($alternatifImage);
            }
            $data->delete();
        }
        return redirect()->route('alternatif.index')->with('danger',
        'Berhasil menghapus data');
    }
}
