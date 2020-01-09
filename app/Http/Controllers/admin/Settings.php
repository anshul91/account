<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Settings extends Controller
{
    function __construct(){
        if (!Auth::check()) {
        }
        $this->middleware('auth');
    }
    public function myProfile(){
        return view('admin/my-profile');
    }
}
