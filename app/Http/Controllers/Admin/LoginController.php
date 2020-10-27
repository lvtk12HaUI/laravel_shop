<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\Http\Requests\StoreRegister;

class LoginController extends Controller
{
    public function viewLogin(){
        return view('backend.pages.login');
    }

    public function viewRegister(){
        return view('backend.pages.register');
    }

    public function handleLogin(Request $request){
        $data = $request->only('email','password');
        //check login with auth
        if(Auth::attempt($data)){
            $data = Admin::where('email',$request->email)->first();
            $request->session()->put('id',$data->id);
            $request->session()->put('email',$data->email);
            $request->session()->put('name',$data->name);
            $request->session()->put('phone',$data->phone);
            return redirect()->route('viewDashboard');
            
        }
        else{
            // if login fail return notification
            return back()->withInput()->with('notification','Tài khoản hoặc mật khẩu không chính xác');
        }
    }

    public function handleRegister(StoreRegister $request){
        $data = [
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'phone' => $request->phone

        ];
        $checkRegister = Admin::where('email',$request->email)->get();
        $checkRegister = $checkRegister->toArray(); 
        if(!empty($checkRegister)){
            return back()->withInput()->with('notification','Email đã tồn tại');
        }
        else{
            Admin::create($data);
            return redirect()->route('viewLogin');    
        }
    }

    public function handleLogout(Request $request){
        //del session and redirect about view Login
        $request->session()->forget('id');
        $request->session()->forget('email');
        $request->session()->forget('name');
        $request->session()->forget('phone');
        return redirect()->route('viewLogin');
    }
}
