<?php

namespace App\Http\Controllers;

use App\Models\User;


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
        if(!empty($request->matricule)){
            $user = User::where('matricule', $request->matricule)->first();
            if(!empty($user)){
                Auth::login($user);
                return redirect('/');
            }
            else{
                return "Login Fail!";
            }

        }
        else{

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect('/'); 
            }else{
                return "Login Fail!";
            }
        }
    }
}
