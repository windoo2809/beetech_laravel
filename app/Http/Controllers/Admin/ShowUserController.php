<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Alert;
use File;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;

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
            'flag_delete');

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
        return view('admin.layout.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $image_name = time().'.'.$request->avatar->getClientOriginalName();
        $request->avatar->move('upload/user/', $image_name);

        $user = new Users();
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->avatar = $image_name;
        $user->password =  Hash::make($request->password);
        $user->save();

        $SendMail = new SendMail();
        $SendMailJob = new SendMailJob($SendMail);
        dispatch($SendMailJob);

        Alert::success('Success', 'Create success');
        return redirect()->route('user.index');
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

        if($user != null){
           return view('admin.layout.user.update',compact('user'));
        }else{
            Alert::error('Error', 'ID does not exist');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = Users::find($id);

        if($user != null){

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $image_name = $avatar->getClientOriginalName();
                $storedPath = $avatar->move('upload/user',$image_name);
                $oldimage = $user->avatar;
                File::delete('upload/user/' . $oldimage);

                $user->avatar = $image_name;
            }

            $user->email = $request->email;
            $user->user_name = $request->user_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->birthday = $request->birthday;

            $user->save();

            $SendMail = new SendMail();
            $SendMailJob = new SendMailJob($SendMail);
            dispatch($SendMailJob);

            Alert::success('Success', 'Update success');
            return redirect()->route('user.index');
         }else{
             Alert::error('Error', 'ID does not exist');
             return redirect()->back();
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
        $user = Users::find($id);

        if($user != null){
            $user->delete();
            Alert::success('Success', 'Delete succes');
            return redirect()->route('user.index');
        }else{
            Alert::error('Error', 'ID does not exist');
            return redirect()->back();
        }
    }
}
