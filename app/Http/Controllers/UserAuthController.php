<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    //
    protected $guard='admin';
    public function store(Request $request){
        $this->validate($request,['email'=>'required','password'=>'required']);
        if(auth()->guard($this->guard)->attempt($request->only(['email','password']))){
            return redirect()->route('index_path');
        }
        else{
            return redirect()->route('inicio_path')
                ->withErrors(['No encontramos al usuario'])
                ->withInput();
        }
    }
    public function destroy(){
        auth()->guard('admin')->logout();
        return redirect()->route('inicio_path');
    }
//    public function dashboard(){
//        return view('admin_auth_index_path');
//    }
}
