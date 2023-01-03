<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use Exception;



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
     * @param \App\Http\Requests\LoginUserRequest $request
     * @return response()
     */
    public function postLogin(LoginUserRequest $request){
        DB::beginTransaction();
        try {
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if(Auth::guard('users')->attempt($data)){
                return view('user.dashboard', $data);
            }
            else{
                return redirect()->back()->with('error','Wrong email or password');
            }
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Something wrong!');
            throw new Exception($e->getMessage());
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
     * @param \App\Http\Requests\RegisterUserRequest $request
     * @return response()
     */
    public function postRegister(RegisterUserRequest $request) {
        DB::beginTransaction();
        try {
            $user = new Users();
            $user->email = $request->email;
            $user->user_name = $request->user_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->birthday = $request->birthday;
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();

            return redirect()->route('user.layout.login')->with('success','Registered successfully');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','Something wrong!');
            throw new Exception($e->getMessage());
        }
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
