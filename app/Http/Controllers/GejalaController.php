<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Gejala;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GejalaController extends Controller
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
        $this->data['gejalas'] = Gejala::orderBy('kode')->get();

        return view('gejala.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gejala.create');
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
            'kode' => 'required|string|unique:gejala,kode',
            'gejala' => 'required|string'
        ]);

        $gejalaSave = Gejala::create([
            'kode' => $request->kode,
            'gejala' => $request->gejala,
        ]);

        if ($gejalaSave) {
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan');
        }

        return redirect()->route('gejala.create')->with('error', 'Gejala gagal ditambahkan');
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
        $gejala = Gejala::find($id);
        if (!$gejala) {
            return back()->with('error', 'Gejala tidak ditemukan');
        }

        $this->data['gejala'] = $gejala;

        return view('gejala.edit', $this->data);
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
            'kode' => 'required|string|unique:gejala,kode,'.$id,
            'gejala' => 'required|string'
        ]);

        $gejala = Gejala::find($id);
        if (!$gejala) {
            return back()->with('error', 'Gejala tidak ditemukan');
        }
        $gejala->kode = $request->kode;
        $gejala->gejala = $request->gejala;
        $gejalaSave = $gejala->save();

        if ($gejalaSave) {
            return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diupdate');
        }

        return redirect()->route('gejala.edit',$id)->with('error', 'Gejala gagal diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gejala::where('id', $id)->delete();

        return redirect()->route('gejala.index')->with('success', 'Berhasil menghapus data');
    }

    public function get_gejala(Request $request)
    {
        $gejala = Gejala::all(['id', 'kode', 'gejala']);
        $dataGejala = '<tr>
        <td style="width: 85%">
            <select name="gejala_id[]" id="penyakit_id[]" class="form-control" required>
                <option value="">Pilih Gejala</option>';
        foreach ($gejala as $key => $value) {
            $dataGejala = $dataGejala.'<option value="'.$value->id.'">'.$value->kode.' - '.$value->gejala.'</option>';
        }
        $dataGejala = $dataGejala.'</select>
                                        </td>
                                        <td style="text-align: right">
                                            <button type="button" id="deleteGejala" class="btn btn-round btn-sm btn-danger"><i class="fa fa-minus"></i> Remove</button>
                                        </td>
                                    </tr>';
        
        return json_encode(array('dataGejala' => $dataGejala));
    }
}
