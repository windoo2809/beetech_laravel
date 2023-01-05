<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\MessageController as MessageController;
use App\Http\Requests\ApiAuthLoginRequest;
use App\Http\Requests\ApiAuthRegisterRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends MessageController
{
    /**
     * Post Login api
     *
     * @param  \App\Http\Request\ApiAuthLoginRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postLogin(ApiAuthLoginRequest $request)
    {

        $customer = [
            'phone' => $request->phone,
            'password' => $request->password,
        ];

        if (Auth::guard('customer')->attempt($customer)) {

            $customer = Auth::guard('customer')->user();

            $success['email'] = $customer->email;
            $success['phone'] = $customer->phone;
            $success['token'] = $customer->createToken('Token')->accessToken;

            return $this->SendResponse($success, 'Customer login successfully');
        } else {
            return $this->SendError('Phone or password wrong!');
        }
    }
    /**
     * Post Register api
     *
     * @param  \App\Http\Request\ApiAuthRegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRegister(ApiAuthRegisterRequest $request)
    {

        $customer = Customer::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);

        $success['email'] = $customer->email;
        $success['password'] = $customer->password;
        $success['phone'] = $customer->phone;

        return $this->SendResponse($success, 'Customer register successfully');
    }
}
