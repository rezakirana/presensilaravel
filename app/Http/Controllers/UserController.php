<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct() {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->type != 'admin') {
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
        $this->data['users'] = User::where('id', '!=', Auth::id())->get();

        return view('user.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'type' => 'required|in:admin,dokter,pasien,pimpinan',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->type = $request->type;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        if ($request->type == 'dokter') {
            return redirect()->route('dokter.create')->with('success', 'User berhasil ditambahkan, lengkapi data dokter!');
        }elseif ($request->type == 'pasien') {
            return redirect()->route('pasien.create')->with('success', 'User berhasil ditambahkan, lengkapi data pasien!');
        }
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
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
        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->route('')->with('danger', 'User tidak ditemukan!');
        }
        $this->data['user'] = $user;

        return view('user.edit', $this->data);
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
            'type' => 'required|in:admin,dokter,pasien,pimpinan',
            'username' => 'required|string|unique:users,username,'.$id,
            'password' => 'nullable|min:6'
        ]);

        $user = User::findOrFail($id);
        if (!$user) {
            return redirect()->back('danger', 'User tidak ditemukan!');
        }
        $user->type = $request->type;
        $user->username = $request->username;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();;

        return redirect()->route('users.edit',$id)->with('success', 'User telah berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('users.index')->with('success', 'Berhasil menghapus data');
    }
}
