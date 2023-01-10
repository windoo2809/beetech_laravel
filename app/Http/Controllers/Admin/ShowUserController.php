<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\File;
use Exception;
use App\Models\Users;
use App\Models\Province;
use App\Models\District;
use App\Models\Commune;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;


class ShowUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Users::select(
            'id',
            'user_name',
            'email',
            'first_name',
            'last_name',
            'birthday',
            'avatar',
            'flag_delete',
            'province_id'
        );

        $search = request()->search;
            if($search){
                $user = Users::where('first_name', 'LIKE','%'.$search.'%')
                    ->orWhere('last_name', 'LIKE','%'.$search.'%')
                    ->orWhere('user_name', 'LIKE','%'.$search.'%')
                    ->orWhere('email', 'LIKE','%'.$search.'%');
            }
        $user = $user->paginate(15);

        return view('admin.layout.user.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = Province::select(
            'id',
            'name'
        )->get();

        return view('admin.layout.user.create', compact('province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $image_name = time().'.'.$request->avatar->getClientOriginalName();
            $request->avatar->move('upload/user/', $image_name);

            $user = new Users();
            $user->email = $request->email;
            $user->user_name = $request->user_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->birthday = $request->birthday;
            $user->avatar = $image_name;
            $user->province_id = $request->province_id;
            $user->district_id = $request->district_id;
            $user->commune_id = $request->commune_id;
            $user->password =  Hash::make($request->password);
            $user->save();
            DB::commit();

            $SendMail = new SendMail();
            $SendMailJob = new SendMailJob($SendMail);
            dispatch($SendMailJob);

            Alert::success('Success', Lang::get('Created successfully'));
            return redirect()->route('user.index');
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', Lang::get('Something wrong!'));
            return redirect()->back();
            throw new Exception($e->getMessage());
        }
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
        $user = Users::find($id);
        $province = Province::select(
            'id',
            'name'
        )->get();
        if($user != null){
            $district = District::where('province_id', $user->province_id)->get();
            $commune = Commune::where('district_id', $user->district_id)->get();

           return view('admin.layout.user.update',compact('user','province','district','commune'));
        }else{
            Alert::error('Error', Lang::get('Something wrong!'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = Users::find($id);

            if($user != null){
                if ($request->hasFile('avatar')) {
                    $avatar = $request->file('avatar');
                    $image_name = $avatar->getClientOriginalName();
                    $avatar->move('upload/user/', $image_name);
                    $oldimage = $user->avatar;
                    File::delete('upload/user/' . $oldimage);
                    $user->avatar = $image_name;
                }

                $user->email = $request->email;
                $user->user_name = $request->user_name;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->birthday = $request->birthday;
                $user->province_id = $request->province_id;
                $user->district_id = $request->district_id;
                $user->commune_id = $request->commune_id;

                $user->save();
                DB::commit();

                $SendMail = new SendMail();
                $SendMailJob = new SendMailJob($SendMail);
                dispatch($SendMailJob);

                Alert::success('Success', Lang::get('Updated successfully'));
                return redirect()->route('user.index');
            }else{
                Alert::error('Error', Lang::get('Something wrong!'));
                return redirect()->back();
            }
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', Lang::get('Something wrong!'));
            return redirect()->back();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = Users::find($id);

        if($user != null){
            $user->delete();
            Alert::success('Success', Lang::get('Deleted successfully'));
            return redirect()->route('user.index');
        }else{
            Alert::error('Error', Lang::get('Something wrong!'));
            return redirect()->back();
        }
    }

    /**
     * return district list.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getDistrict(Request $request)
    {
        $district = District::where('province_id', $request->province_id)->get();

        if (count($district) > 0) {
            return response()->json($district);
        }
    }

    /**
     * return commune list
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getCommune(Request $request)
    {
        $commune = Commune::where('district_id', $request->district_id)
            ->get();

        if (count($commune) > 0) {
            return response()->json($commune);
        }
    }

}
