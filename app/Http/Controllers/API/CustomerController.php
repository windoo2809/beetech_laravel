<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiUpdateCustomerRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $customer = Customer::select(
            'id',
            'email',
            'phone',
            'birthday',
            'full_name',
            'password',
            'reset_password',
            'address',
            'province_id',
            'district_id',
            'commune_id',
            'status',
            'flag_delete'
        )->get();

        if ($customer != null) {
            return response()->json([
                'customer' => $customer,
            ]);
        } else {
            return response()->json([
                'message' => 'No customer was found',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     *@param mixed $id
     * @param \App\Http\Request\ApiUpdateCustomerRequest  $request
     *@return \Illuminate\Http\JsonResponse
     */
    public function update(ApiUpdateCustomerRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var \App\Models\Customer $customer */
            $customer = Auth::guard('api')->user();

            if ($customer != null) {
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->password = bcrypt($request->password);
                $customer->save();
                DB::commit();

                return response()->json([
                    'customer' => $customer,
                    'message' => 'Customer has been updated successfully',
                ]);
            } else {
                return response()->json([
                    'message' => 'Something wrong!',
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Somgthing wrong!',
                throw new Exception($e->getMessage())
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Show infor customer after login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $customer = Auth::guard('api')->user();

        if ($customer != null) {
            return response()->json([
                'customer' => $customer,
                'message' => 'Customer found',
            ]);
        } else {
            return response()->json([
                'message' => 'Customer not found',
            ]);
        }
    }
}
