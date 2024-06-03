<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin_login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class adminLoginController extends Controller
{
    public function adminLogin(){
        return view('admin.pages.sign-in');
    }
    public function authLogin(Request $request){
        $validation = validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validation->passes())
        {
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
                return redirect()->route('home');
            }else{
                return redirect()->route('adminLogin')->with('error','Either Email Or Password is incorrect.');
            }
        }else{
            return redirect()->route('adminLogin')->withInput()->withErrors($validation);
        }
    }
}
