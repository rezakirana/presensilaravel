<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\Account;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['data'] = Account::all();

        return view('account.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        if (session()->has('dataUser')) {
            $this->validate($request,[
                'nip' => 'required|unique:guru,nip',
                'nama' => 'required',                
                'tempat_lahir' => 'required',                
                'tgl_lahir' => 'required',                
                'phone_number' => 'required',                
                'alamat' => 'required',                
                'pendidikan' => 'required',                
                'email' => 'required|unique:guru,email',                
                'gender' => 'required|in:laki-laki,perempuan'
            ]);
            $guru = new Account();
            $guru->nip = $request->nip;            
            $guru->user_id = session()->get('dataUser')->id;            
            $guru->nama = $request->nama;  
            $guru->phone_number = $request->phone_number;  
            $guru->tempat_lahir = $request->tempat_lahir;  
            $ttl = explode('/',$request->tgl_lahir);          
            $guru->tgl_lahir = $ttl[2].'-'.$ttl[0].'-'.$ttl[1];            
            $guru->alamat = $request->alamat;
            $guru->pendidikan = $request->pendidikan;
            $guru->email = $request->email;
            $guru->gender = $request->gender;
            $guru->save();
            session()->forget('dataUser');
        }else {
            $this->validate($request,[
                'nip' => 'required|unique:guru,nip',
                'nama' => 'required',                
                'tempat_lahir' => 'required',                
                'tgl_lahir' => 'required',                
                'phone_number' => 'required',                
                'alamat' => 'required',                
                'pendidikan' => 'required',                
                'email' => 'required|unique:guru,email',                
                'gender' => 'required|in:laki-laki,perempuan',
                'type' => 'required|in:guru',
                'password' => 'required|string|min:6'
            ]);
            $user = new User();
            $user->type = $request->type;
            $user->username = $request->nip;
            $user->password = Hash::make($request->password);
            $user->save();
            $guru = new Account();
            $guru->nip = $request->nip;            
            $guru->user_id = $user->id;            
            $guru->nama = $request->nama;  
            $guru->tempat_lahir = $request->tempat_lahir;  
            $guru->phone_number = $request->phone_number;  
            $ttl = explode('/',$request->tgl_lahir);          
            $guru->tgl_lahir = $ttl[2].'-'.$ttl[0].'-'.$ttl[1];
            $guru->phone_number = $request->phone_number;
            $guru->alamat = $request->alamat;
            $guru->pendidikan = $request->pendidikan;
            $guru->email = $request->email;
            $guru->gender = $request->gender;
            $guru->save();
        }
        
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function account_profile(Request $request)
    {
        if (Auth::user()->type == 'dokter') {
            $dokter = Dokter::where('user_id',Auth::id())->first();
            $dokter->nama_dokter = $request->nama_dokter;
            $dokter->jk = $request->jk;
            $dokter->pendidikan_terakhir = $request->pendidikan_terakhir;
            $dokter->save();
        } else {
            $pasien = Pasien::where('user_id',Auth::id())->first();
            $pasien->nama = $request->nama;
            $pasien->jk = $request->jk;
            $pasien->nik = $request->nik;
            $pasien->alamat = $request->alamat;
            $ttl = explode('/',$request->ttl);
            $pasien->ttl = $ttl[2].'-'.$ttl[1].'-'.$ttl[0];
            $pasien->save();
        }
        return redirect()->route('account.index')->with('success', 'Your profile changed successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['guru'] = Account::findOrFail($id);

        return view('account.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Account::findOrFail($id);
        $ttl = explode('-',$guru->tgl_lahir->format('Y-m-d'));
        $guru->ttl = $ttl[1].'/'.$ttl[2].'/'.$ttl[0];        
        $this->data['guru'] = $guru;

        return view('account.edit', $this->data);
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
            'nip' => 'required|unique:guru,nip,'.$id,
            'nama' => 'required',                
            'tempat_lahir' => 'required',                
            'tgl_lahir' => 'required',                
            'phone_number' => 'required',                
            'alamat' => 'required',                
            'pendidikan' => 'required',                
            'email' => 'required|unique:guru,email,'.$id,                
            'gender' => 'required|in:laki-laki,perempuan'
        ]);
        $guru = Account::findOrFail($id);
        $guru->nip = $request->nip;            
        $guru->nama = $request->nama;  
        $guru->phone_number = $request->phone_number;  
        $guru->tempat_lahir = $request->tempat_lahir;  
        $ttl = explode('/',$request->tgl_lahir);          
        $guru->tgl_lahir = $ttl[2].'-'.$ttl[0].'-'.$ttl[1];        
        $guru->alamat = $request->alamat;
        $guru->pendidikan = $request->pendidikan;
        $guru->email = $request->email;
        $guru->gender = $request->gender;
        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Account::findOrFail($id);
        User::where('id', $guru->user_id)->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus!');
    }

    public function account()
    {
        return view('account.account');
    }

    public function account_save(Request $request)
    {
        $this->validate($request,[
            'currentPassword' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        $user = Auth::user();
        $cekPassword = Hash::check($request->currentPassword, $user->password);
        if (!$cekPassword) {
            return redirect()->route('account.index')->with('danger','Current password does not match!');
        }
        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.index')->with('success', 'Your password changed successfully!');
    }
}
