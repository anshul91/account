<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    function __construct(){
        if (!Auth::check()) {
            return view('/auth/login');
        }
        $this->middleware('auth');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('login');
    }
    
    

    public function updateProfile(Request $request){
        $user_id = Auth::id();
        if ($request->isMethod('post')) {
            
            $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                'name' => 'required|max:255',
            ]);
            $users = User::find($user_id);
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->save();
            // $request->session()->flash('success', '!');
        }        
        $user_data = User::where(['id'=>$user_id])->first();
       
        if($user_data){
            return view('admin/my-profile',['user'=>$user_data]);
        }else{
            return view('admin/my-profile',['user'=>$user_data]);
        }
    }

    public function changePassword(Request $request){
        $user_id = Auth::id();
        if($request->isMethod('post')){
            $validateData = $request->validate([               
                'password' => 'required|max:20|min:8|string',
                'confirm_password' => 'required|same:password|max:20|min:8|string',
            ]);
            $user = User::find($user_id);
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }
        return view('auth/passwords/change-password');
    }
}
