<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\Pasien;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string'],
            'ttl' => ['required'],
            'alamat' => ['required', 'string'],
            'nik' => ['required', 'string', 'max:255', 'unique:pasien'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'role_id' => 3,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function store_pasien(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jk' => 'required|string',
            'ttl' => 'required',
            'alamat' => 'required|string',
            'nik' => 'required|string|max:255|unique:pasien,nik',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ]);
        
        $user = new User();
        $user->type = 'pasien';
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        $pasien = new Pasien();
        $pasien->user_id = $user->id;
        $pasien->nama = $request->name;
        $pasien->alamat = $request->alamat;
        $pasien->nik = $request->nik;
        $pasien->jk = $request->jk;
        $tgl = explode('/',$request->ttl);
        $pasien->ttl = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];
        $pasien->save();

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (auth()->attempt(array($fieldType => $request->username, 'password' => $request->password))){
            return redirect('/pendaftaran');
        }else{
            return redirect()->route('login')
                ->with('error','Username and Password are wrong!');
        }
    }
}
