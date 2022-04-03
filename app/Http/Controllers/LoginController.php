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
            switch (Auth::user()->role){
                case 0:
                    return redirect('/');
                    break;
                case 1:
                    return redirect('employee');
                    break;
                case 2:
                    return redirect('agent');
                    break;    
            }
        }else{
            return "Login Fail!";
        }
    }
}
