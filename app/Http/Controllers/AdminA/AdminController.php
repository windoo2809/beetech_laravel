<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{   
  /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(){
        
            return view('admin.dashboard');
    }
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function getLogin(){
        return view('admin.layout.login');
    } 
    /**
     * Write code on Method
     * @param request $request
     * @return response()
     */
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::guard('admin')->attempt($data)){
            return view('admin.dashboard', $data);
         }
         else{
             return redirect()->route('admin.layout.login')->with('error','Wrong email or password');
         }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getRegister(){
        return view('admin.layout.register');
    }

    /**
     * Write code on Method
     *
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
        //
        $admin = new Admin();
        $admin->email = $request->email;
        $admin->user_name = $request->user_name;
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->birthday = $request->birthday;
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect('admin.layout.login')->with('success','Register success');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.layout.login')->with('success','Logout success');

    }

}