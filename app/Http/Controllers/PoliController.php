<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Poli;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['poli'] = Poli::all();

        return view('poli.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poli.create');
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
            'nama' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kode' => 'required|unique:poli,kode'
        ]);
        $poli = new Poli();
        $poli->kode = $request->kode;
        $poli->nama = $request->nama;
        if ($request->gambar) {
            $fileGambar = $request->file('gambar');
            $destination_path = public_path('/img/poli/');
            $imageName = time().'-'.$fileGambar->getClientOriginalName();
            $simpanGambar = $fileGambar->move($destination_path, $imageName);
            $poli->gambar = $imageName;
        }
        $poli->save();

        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan');
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
        $this->data['poli'] = Poli::find($id);

        return view('poli.edit', $this->data);
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
            'nama' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kode' => 'required|unique:poli,kode,'.$id
        ]);
        $poli = Poli::find($id);
        $poli->kode = $request->kode;
        $poli->nama = $request->nama;
        if ($request->gambar) {
            $fileGambar = $request->file('gambar');
            $destination_path = public_path('/img/poli/');
            $poliImage = $destination_path.$poli->gambar;
            if (file_exists($poliImage) && !is_null($poli->gambar)) {
                unlink($poliImage);
            }
            $imageName = time().'-'.$fileGambar->getClientOriginalName();
            $simpanGambar = $fileGambar->move($destination_path, $imageName);
            $poli->gambar = $imageName;
        }
        $poli->save();

        return redirect()->route('poli.index')->with('success', 'Poli berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poli = Poli::where('id', $id)->first();
        if (!$poli) {
            return redirect()->route('poli.index')->with('danger', 'Poli tidak ditemukan');
        }
        if ($poli->gambar) {
            $destination_path = public_path('/img/poli/');
            $poliImage = $destination_path.$poli->gambar;
            if (file_exists($poliImage) && !is_null($poli->gambar)) {
                unlink($poliImage);
            }
        }
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Berhasil menghapus data');

    }
}
