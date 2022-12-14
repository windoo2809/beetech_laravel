<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
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
        Users::create($request->all());
        return redirect()->route('user.index')->with("success", "Create success");
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
        $users = Users::find($id);
        $data = [
            'users' =>$users,
        ];
        return view('admin.layout.user.update', $data);


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

        return redirect()->route('user.index')->with("success", "Edit success");
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
}
