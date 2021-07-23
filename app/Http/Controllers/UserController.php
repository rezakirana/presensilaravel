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
        $this->data['roles'] = Role::where('role', '!=', 'admin')->get(['id', 'role']);

        return view('user.create', $this->data);
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
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
        ]);

        $user = new User();
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

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
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('')->with('danger', 'User tidak ditemukan!');
        }
        $this->data['user'] = $user;
        $this->data['roles'] = Role::where('role', '!=', 'admin')->get(['id', 'role']);

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
            'role_id' => 'required|integer|exists:roles,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);
        if (!$user) {
            return redirect()->back('danger', 'User tidak ditemukan!');
        }

        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->is_active;
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
