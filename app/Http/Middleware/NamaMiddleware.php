<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;

class NamaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd("ada nih");
        // dd(session()->get('tokenUser'));
        if (!session()->has('tokenUser')) {
            session()->put('tokenUser',null) ;      
        }

        $testToken = session()->get('tokenUser');
        $response = Http::withToken($testToken)
                    ->get(env("REST_API_ENDPOINT").'/api/cek-token'); 
                    
                    // dd(env("REST_API_ENDPOINT").'/api/cek-token');
                    // dd($response);
        $dataResponse =json_decode($response);
        //  dd($dataResponse);
        if ($dataResponse && $dataResponse->status == true) {
            session()->put('userLogged',$dataResponse->data);
            return $next($request);
        }            
            else {
                session()->put('userLogged',null);
                return redirect()->route('login')->with('danger','Silakan login terlebih dahulu!');
            }

        
    }
}
