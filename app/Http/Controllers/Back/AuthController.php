<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginRequest;



class AuthController extends Controller
{
	public function login(){
		return view('back.auth.login');
	}

	public function loginPost(loginRequest $request){

		if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {

			return redirect()->route('admin.dashboard');
		}
		return redirect()->route('admin.login')->withErrors('Email veya şifre hatalı!');

	}
	public function logout(){
		Auth::logout();
		return redirect()->route('admin.login');
	}
}
