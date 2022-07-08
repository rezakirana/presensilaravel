<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // validation
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
        $response = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/users');
        $dataResponse = json_decode($response);
        $users = $dataResponse->data;

        return view('user.index', [
            'users' => $users,
        ]);
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

        $response = Http::withToken(session('tokenUser'))
            ->post(env("REST_API_ENDPOINT") . '/api/users', [
                'type' => $request->type,
                'username' => $request->username,
                'password' => $request->password,
            ]);

        $data = json_decode($response);

        if ($data->status == true) {
            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
        } else {
            return redirect()->route('users.create')->with('validationErrors', $data->message);
        }
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
        $response = Http::withToken(session()->get('tokenUser'))
            ->get(env("REST_API_ENDPOINT") . '/api/users/' . $id);
        $dataResponse = json_decode($response);

        if ($dataResponse->status == true) {
            return view('user.edit', [
                'user' => $dataResponse->data,
            ]);

        } else {
            return redirect()->route('users.index')->with('danger', 'User tidak ditemukan!');
        }
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

        $response = Http::withToken(session('tokenUser'))
            ->put(env("REST_API_ENDPOINT") . '/api/users/' . $id, [
                'type' => $request->type,
                'username' => $request->username,
                'password' => $request->password,

            ]);
        $data = json_decode($response);
        if ($data && $data->status == true) {
            return redirect()->route('users.index')->with('success', 'Data users berhasil ditambahkan');
        } else {
            // return redirect()->route('users.edit')->with('validationErrors', $data->message);
            return back()->with('validationErrors', $data->message);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withToken(session('tokenUser'))
            ->delete(env("REST_API_ENDPOINT") . '/api/users/' . $id);
        
        $data = json_decode($response);
        if ($data->status == true) {
            return redirect()->route('users.index')->with('success', 'Data user berhasil dihapus!');
        } else {
            return redirect()->route('users.index')->with('validationErrors', $data->message);
        }

    }
}
