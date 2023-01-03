<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;

use Exception;

class AdminController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return response()
     */
    public function index(){
            return view('admin.dashboard');
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return response()
     */
    public function getLogin(){
        return view('admin.layout.login');
    }
    /**
     * postLogin a newly created resource in storage.
     * @param \App\Http\Requests\LoginAdminRequest $request
     * @return response()
     */
    public function postLogin(LoginAdminRequest $request){
        DB::beginTransaction();
        try {
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
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return response()
     */
    public function getRegister(){
        return view('admin.layout.register');
    }

    /**
     *  postRegister a newly created resource in storage.
     * @param \App\Http\Requests\RegisterAdminRequest $request
     * @return response()
     */
    public function postRegister(RegisterAdminRequest $request) {
        DB::beginTransaction();
        try {
            $admin = new Admin();
            $admin->email = $request->emails;
            $admin->user_name = $request->user_name;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->birthday = $request->birthday;
            $admin->password = bcrypt($request->password);

            $admin->save();
            DB::commit();
            return redirect()->route('admin.layout.login')->with('success','Register success');
        } catch (Exception $e) {
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
        return redirect()->route('admin.layout.login')->with('success','Logout success');

    }

}
