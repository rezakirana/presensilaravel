<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Rule;
use App\Model\Gejala;
use App\Model\Penyakit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['rules'] = Rule::join('gejala', 'gejala.id', '=', 'rule.gejala_id')
                                    ->join('penyakit', 'penyakit.id', '=', 'rule.penyakit_id')
                                    ->select([
                                        'rule.id',
                                        'rule.bobot',
                                        'gejala.kode as kodeGejala',
                                        'gejala.gejala',
                                        'penyakit.kode as kodePenyakit',
                                        'penyakit.penyakit'
                                    ])
                                    ->orderBy('penyakit.kode')
                                    ->get();
        
        return view('rules.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $existRules = Rule::groupBy('penyakit_id')->get(['penyakit_id'])->toArray();
        if (count($existRules)) {
            $penyakit = Penyakit::whereNotIn('id',$existRules)->get(['id', 'kode', 'penyakit']);
        }else{
            $penyakit = Penyakit::all(['id', 'kode', 'penyakit']);
        }
        $this->data['penyakit'] = $penyakit;
        $this->data['gejala'] = Gejala::all(['id', 'kode', 'gejala']);
        
        return view('rules.create', $this->data);
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
            'penyakit_id' => 'required|integer|exists:penyakit,id',
            'gejala_id' => 'required|array'
        ]);
        if(count(array_unique($request->gejala_id))<count($request->gejala_id)){
            return back()->with('danger', 'Duplikat data gejala!');
        }
        foreach ($request->gejala_id as $key => $value) {
            $rule = new Rule();
            $rule->gejala_id = $value;
            $rule->penyakit_id = $request->penyakit_id;
            $rule->bobot = $request->bobot[$key];
            $rule->save();
        }
        return redirect()->route('rules.index')->with('success', 'Rules berhasil ditambahkan!');
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
        $rule = Rule::find($id);
        if (!$rule) {
            return back()->with('danger', 'Rule tidak ditemukan!');
        }
        $this->data['penyakit'] = Penyakit::all(['id', 'kode', 'penyakit']);;
        $this->data['gejala'] = Gejala::all(['id', 'kode', 'gejala']);
        $this->data['rule'] = $rule;

        return view('rules.edit', $this->data);
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
        $rule = Rule::find($id);
        if (!$rule) {
            return back()->with('danger', 'Rule tidak ditemukan!');
        }
        $this->validate($request,[
            'penyakit_id' => 'required|integer|exists:penyakit,id',
            'gejala_id' => 'required|integer|exists:gejala,id'
        ]);
        $checkRule = Rule::where([
                                    'penyakit_id' => $request->penyakit_id,
                                    'gejala_id' => $request->gejala_id
                                ])
                                ->where('id', '!=', $id)
                                ->first();
        if ($checkRule) {
            return back()->with('danger', 'Rule sudah ada!');
        }
        $rule->gejala_id = $request->gejala_id;
        $rule->penyakit_id = $request->penyakit_id;
        $rule->bobot = $request->bobot;
        $updateRule = $rule->save();
        if (!$updateRule) {
            return back()->with('danger', 'Rule gagal diupdate!');
        }
        return redirect()->route('rules.index')->with('success', 'Rule sukses diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rule::where('id', $id)->delete();

        return redirect()->route('rules.index')->with('success', 'Berhasil menghapus data');
    }
}
