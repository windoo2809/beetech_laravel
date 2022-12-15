<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{    
/**
    * Display a listing of the resource.
    *
    * @return response()
    */
    public function index(){
        return view('user.dashboard');
    }  

    /**
    *  Show the form for creating a new resource.
    *
    * @return response()
    */
    public function getLogin(){
        return view('user.layout.login');
    } 

    /**
     * postLogin a newly created resource in storage.
     *
     * @return response()
     */
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::guard('user')->attempt($data)){
           return view('user.dashboard', $data);
        }
        else{
            return redirect()->route('user.layout.login')->with('error','Wrong email or password');
        }
    }

    /**
     *  Show the form for creating a new resource.
     *
     * @return response()
     */
    public function getRegister(){
        return view('user.layout.register');
    }

    /**
     * postRegister a newly created resource in storage.
     * @param request $request
     * @return response()
     */
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
        return redirect()->route('user.layout.login')->with('success','Register success');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @return response()
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('user.layout.login')->with('success','Logout success');

    }

}