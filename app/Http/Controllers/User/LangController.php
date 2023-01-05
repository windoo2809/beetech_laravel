<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function index($locale){ 
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
