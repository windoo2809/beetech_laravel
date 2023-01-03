<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;


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
     * Show the form for creating a new resource.
     *
     * @return response()
     */
    public function getLogin(){
        return view('user.layout.login');
    }
    /**
     * postLogin a newly created resource in storage.
     *
     * @param \App\Http\Requests\LoginAdminRequest $request
     * @return response()
     */
    public function postLogin(LoginUserRequest $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(Auth::guard('users')->attempt($data)){
            return view('user.dashboard', $data);
         }
         else{
             return redirect()->route('user.layout.login')->with('error','Wrong email or password');
         }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return response()
     */
    public function getRegister(){
        return view('user.layout.register');
    }

    /**
     *  postRegister a newly created resource in storage.
     *
     * @return response()
     */
    public function postRegister(RegisterUserRequest $request) {

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
