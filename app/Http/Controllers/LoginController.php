<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;
class LoginController extends Controller
{
    public function formLogin()
    {
        return view('login');
    }

    protected $redirectTo = RouteServiceProvider::DASHBOARS;
    public function actionLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('/');
            
            
        }else{
            return "Login Fail!";
        }
    }
}
