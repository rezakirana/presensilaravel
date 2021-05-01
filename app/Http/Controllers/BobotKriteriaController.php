<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kriteria;
use App\Model\BobotKriteria;
use DB;
use Illuminate\Support\Facades\Auth;

class BobotKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bobotKriteria = DB::table('bobot_kriteria')
                            ->join('kriteria', 'kriteria.id', '=', 'bobot_kriteria.id_kriteria')
                            ->where('bobot_kriteria.id_user',Auth::id())
                            ->select([
                                'kriteria.nama',
                                'bobot_kriteria.bobot'
                            ])->get();
        
        return view('bobot_kriteria.index', [
            'data' => $bobotKriteria
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Kriteria::all(['id','nama']);
        
        return view('bobot_kriteria.create', [
            'data' => $data
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
        $cekBobotKriteria = BobotKriteria::where('id_user',Auth::id())->get();
        if (count($cekBobotKriteria) > 0) {
            return redirect()->route('bobot-kriteria.index');
        }

        foreach ($request->kriteria as $key => $value) {
            $bobotKriteria = new BobotKriteria();
            $bobotKriteria->id_user = Auth::id();
            $bobotKriteria->id_kriteria = $value;
            $bobotKriteria->bobot = $request->bobot[$key];
            $bobotKriteria->save();
        }

        return redirect()->route('bobot-kriteria.index')->with('success', 'Berhasil menambahkan bobot kriteria');
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
        // 
    }

    public function editBobotKriteria()
    {
        $data = BobotKriteria::join('kriteria', 'kriteria.id', '=', 'bobot_kriteria.id_kriteria')
                            ->where('id_user', Auth::id())
                            ->select([
                                'kriteria.nama',
                                'bobot_kriteria.id_kriteria',
                                'bobot_kriteria.bobot'
                            ])->get();
        
        return view('bobot_kriteria.edit', [
            'data' => $data
        ]);
    }

    public function updateBobotKriteria(Request $request)
    {
        foreach ($request->kriteria as $key => $value) {
            $bobotKriteria = BobotKriteria::where([
                                                    'id_kriteria' => $value,
                                                    'id_user' => Auth::id()
                                                    ])->first();
            $bobotKriteria->id_kriteria = $value;
            $bobotKriteria->bobot = $request->bobot[$key];
            $bobotKriteria->save();
        }

        return redirect()->route('bobot-kriteria.index')->with('success', 'Berhasil mengubah bobot kriteria');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
