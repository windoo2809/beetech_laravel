<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\ResetpasswordRequest;
use App\Http\Requests\ForgotRequest;
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
use App\Notifications\ResetPassword as ResetPasswordNotifications;
use Illuminate\Auth\Notifications\ResetPassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return response()
     */
    public function index()
    {
        return view('user.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return response()
     */
    public function getLogin()
    {
        return view('user.layout.login');
    }

    /**
     * postLogin a newly created resource in storage.
     *
     * @param \App\Http\Requests\LoginUserRequest $request
     * @return response()
     */
    public function postLogin(LoginUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (Auth::guard('web')->attempt($data)) {
                return redirect('user');
            } else {
                return redirect()->back()->with('error', 'Wrong email or password');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something wrong!');
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getRegister()
    {
        return view('user.layout.register');
    }

    /**
     *  postRegister a newly created resource in storage.
     *
     * @param \App\Http\Requests\RegisterUserRequest $request
     * @return response()
     */
    public function postRegister(RegisterUserRequest $request)
    {
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

            return redirect()->route('user.layout.login')->with('success', 'Registered successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something wrong!');
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.layout.login')->with('success', 'Logout success');
    }

    /**
     * Show view send mail
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getForgot()
    {
        return view('user.layout.send-email-password');
    }

    /**
     * Send mail
     *
     * @param \App\Http\Requests\ForgotRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postForgot(ForgotRequest $request)
    {
        DB::beginTransaction();
        try {
            $token = Str::random(60);

            $password_reset = new PasswordReset();
            $password_reset->email = $request->email;
            $password_reset->token = $token;
            $password_reset->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $password_reset->save();

            $user = Users::where('email',  $password_reset->email)->first();
            $user->notify(new ResetPasswordNotifications($token));

            return back()->with('success', 'Send email successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something wrong!');
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Show form reset password
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function getResetPassword(Request $request)
    {
        if ($request->has('token')) {
            $token = $request->query('token');
            return view('user.layout.resetpassword')->with(['token' => $token]);
        }
        abort(404);
    }

    /**
     * create new password
     *
     * @param \App\Http\Requests\ResetpasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postResetPassword(ResetpasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $password_reset = PasswordReset::where([
                'token' => $request->token,
            ])->first();

            if (Carbon::parse($password_reset->created_at)->addHour(3)->isPast()) {
                $password_reset->delete();

                return redirect()->route('user.layout.login')->with('error', 'Invalid token');
            } else {
                Users::select('email', $request->email)->update([
                    'password' => bcrypt($request->password)
                ]);
                $password_reset->delete();

                return redirect()->route('user.layout.login')->with('success', 'Your password has been changed! You can login with new password');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something wrong!');
            throw new Exception($e->getMessage());
        }
    }
}
