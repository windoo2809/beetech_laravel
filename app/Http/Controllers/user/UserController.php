<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{   
    public function index(){
        return view('user.dashboard');
    }
    //getLogin
    public function getLogin(){
        return view('user.layout.login');
    } 
    //postLogin
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::attempt($data)){
           return view('user.dashboard', $data);
        }
        else{
         return redirect('user-login')->with('error','Wrong email or password');
        }
      
    }
    //getRegister
    public function getRegister(){
        return view('user.layout.register');
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
        $user = new Users();
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('user-login')->with('success','Register success');
    }

}