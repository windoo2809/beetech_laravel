<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{   
    public function index(){
        return view('admin.dashboard');
    }
    //getLogin
    public function getLogin(){
        return view('admin.layout.login');
    } 
    //postLogin
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::attempt($data)){
           return view('admin.dashboard', $data);
        }
        else{
         return redirect('admin-login')->with('error','Wrong email or password');
        }
      
    }
    //getRegister
    public function getRegister(){
        return view('admin.layout.register');
    }
    //postRegister
    public function postRegister(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'user_name'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'birthday'=>'required',
            'password'=>'required',
        ]);
        $admin = new Admin();
        $admin->email = $request->email;
        $admin->user_name = $request->user_name;
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->birthday = $request->birthday;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect('admin-login')->with('success','Register success');
    }

}