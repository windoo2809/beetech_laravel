<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\SendPassword;
use App\Jobs\SendPasswordJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\Users;
use App\Models\PasswordReset;
use Exception;
use Carbon\Carbon;




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
            if(Auth::guard('web')->attempt($data)){
                return redirect('user');
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

    public function getForgot(){
        return view('user.layout.send-email-password');
    }
    public function postForgot(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);
        $token = Str::random(64);

        $password_reset = new PasswordReset();
        $password_reset->email = $request->email;
        $password_reset->token = $token;
        $password_reset->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $password_reset->save();

        $action_link = route('user.layout.resetpassword',['token'=>$token]);
        $body = "We are received a request to reset the password for account associated with ".$request->email.". You can reset your password by clicking the link below";

        Mail::send('user.layout.mail',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
             $message->from('noreply@example.com','Your App Name');
             $message->to($request->email,'Your name')
                     ->subject('Reset Password');
       });

        // $SendPassword = new SendPassword();
        // $SendPasswordJob = new SendPasswordJob($SendPassword,$token);
        // dispatch($SendPasswordJob);

        return back()->with('success','Send email successfully');
    }

    public function getResetPassword(Request $request, $token=null){
        return view('user.layout.resetpassword')->with(['token'=>$token]);
    }

    public function postResetPassword(Request $request){
        $request->validate([
            'password'=>'required|min:5',
            'reset_password'=>'required',
        ]);

        $check_token = PasswordReset::where([
            'token' => $request->token,
        ])->get();

        if(!$check_token){
            return back()->with('error', 'Invalid token');
        }else{

            Users::select('email', $request->email)->update([
                'password'=> \bcrypt($request->password)
            ]);

            PasswordReset::select([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('user.layout.login')->with('success', 'Your password has been changed! You can login with new password');
    }
    }

}
