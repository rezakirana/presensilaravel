<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Penyakit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PenyakitController extends Controller
{
    function __construct() {
        $this->middleware(function ($request, $next) {
            $cekUser = Auth::user()->role->role;
            if ($cekUser != 'admin') {
                return redirect()->route('notFound');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['penyakits'] = Penyakit::orderBy('kode')->get();

        return view('penyakit.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penyakit.create');
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
            'kodePenyakit' => 'required|string|unique:penyakit,kode',
            'namaPenyakit' => 'required|string',
            'probabilitas' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keteranganPenyakit' => 'nullable|string',
            'penangananPenyakit' => 'required|string'
        ]);
        $penyakit = new Penyakit();
        if ($request->image) {
            $fileGambar = $request->file('image');
            $destination_path = public_path('/img/penyakit/');
            $imageName = time().'-'.$fileGambar->getClientOriginalName();
            $simpanGambar = $fileGambar->move($destination_path, $imageName);
            $penyakit->image = $imageName;
        }
        $penyakit->kode = $request->kodePenyakit;
        $penyakit->penyakit = $request->namaPenyakit;
        $penyakit->keterangan = $request->keteranganPenyakit;
        $penyakit->penanganan = $request->penangananPenyakit;
        $penyakit->probabilitas = $request->probabilitas;
        $savePenyakit = $penyakit->save();

        if ($savePenyakit) {
            return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil ditambahkan');
        }
        return back()->with('danger', 'Penyakit gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penyakit = Penyakit::find($id);
        if (!$penyakit) {
            return redirect()->route('penyakit.index')->with('danger', 'Penyakit tidak ditemukan');
        }

        $this->data['penyakit'] = $penyakit;

        return view('penyakit.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penyakit = Penyakit::find($id);
        if ($penyakit) {
            $this->data['penyakit'] = $penyakit;

            return view('penyakit.edit',$this->data);
        }

        return redirect()->route('penyakit.index')->with('danger', 'Penyakit tidak ditemukan');
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
            'kodePenyakit' => 'required|string|unique:penyakit,kode,'.$id,
            'namaPenyakit' => 'required|string',
            'probabilitas' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keteranganPenyakit' => 'nullable|string',
            'penangananPenyakit' => 'required|string'
        ]);
        $penyakit = Penyakit::find($id);
        if (!$penyakit) {
            return redirect()->route('penyakit.edit',$id)->with('danger', 'Penyakit tidak ditemukan');
        }
        if ($request->image) {
            $fileGambar = $request->file('image');
            $destination_path = public_path('/img/penyakit/');
            $penyakitImage = $destination_path.$penyakit->image;
            if (file_exists($penyakitImage) && !is_null($penyakit->image)) {
                unlink($penyakitImage);
            }
            $imageName = time().'-'.$fileGambar->getClientOriginalName();
            $simpanGambar = $fileGambar->move($destination_path, $imageName);
            $penyakit->image = $imageName;
        }
        $penyakit->kode = $request->kodePenyakit;
        $penyakit->penyakit = $request->namaPenyakit;
        $penyakit->keterangan = $request->keteranganPenyakit;
        $penyakit->penanganan = $request->penangananPenyakit;
        $penyakit->probabilitas = $request->probabilitas;
        $savePenyakit = $penyakit->save();

        if ($savePenyakit) {
            return redirect()->route('penyakit.index')->with('success', 'Penyakit berhasil diupdate');
        }
        return redirect()->route('penyakit.edit',$id)->with('danger', 'Penyakit gagal diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penyakit = Penyakit::where('id', $id)->first();
        if (!$penyakit) {
            return redirect()->route('penyakit.index')->with('danger', 'Penyakit tidak ditemukan');
        }
        if ($penyakit->image) {
            $destination_path = public_path('/img/penyakit/');
            $penyakitImage = $destination_path.$penyakit->image;
            if (file_exists($penyakitImage) && !is_null($penyakit->image)) {
                unlink($penyakitImage);
            }
        }
        $penyakit->delete();

        return redirect()->route('penyakit.index')->with('success', 'Berhasil menghapus data');
    }
}
