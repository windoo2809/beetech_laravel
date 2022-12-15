<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Alert;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\userRequest;

class ShowUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Users::select(
            'id',
            'user_name',
            'email',
            'first_name',
            'last_name',
            'birthday',
            'flag_delete')->paginate(15);
        return view('admin.layout.user.show', compact('users'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userRequest $request)
    {

        $user = new Users();
        $user->email = $request->email;
        $user->user_name = $request->user_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->password = $request->password;
        $user->save();

        Alert::success('success', 'Create success');
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
        if(Users::where('id',$id)->exists()){
            $users = Users::find($id);
           return view('admin.layout.user.update',compact('users'));
        }else{
            Alert::error('Error', 'ID does not exist');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $users = Users::find($id);

        $users->email= $data['email'];
        $users->user_name= $data['user_name'];
        $users->first_name= $data['first_name'];
        $users->last_name= $data['last_name'];
        $users->birthday= $data['birthday'];
        $users->save();

        Alert::success('success', 'Edit succes');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = Users::find($id);
        $users->delete();

        Alert::success('success', 'Delete succes');
        return redirect()->route('user.index');
    }
}