<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;


class ShowUserController extends Controller{

    public function index(){
        $users = Users::paginate(1);
       
        return view('admin.layout.user.show', compact('users'));
    }
    public function create(){
        return view('admin.layout.user.create');
    }
    public function store(){

    }
    public function show(){}
    public function edit(){}
    public function update(){}
    public function delete(){}
}