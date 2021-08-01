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
        // $num = ['12','5','1','3','2','8'];
        // if(count(array_unique($num))<count($num))
        // {
        //     dd('duplicate');
        // }
        // else
        // {
        //     dd('not duplicate');
        // }
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
        //
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
