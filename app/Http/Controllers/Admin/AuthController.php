<?php

namespace App\Http\Controllers\Admin;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers;
use Auth;
use Illuminate\Support\Facades\Cache;
use View;
use DB;



class AuthController extends Controller
{
    public function __construct()
    {
       
    }
    
    public function login(Request $request)
    {
        if (isset($request->login))
        {
            $userdata = array(
                'email' => $request->login,
                'password' => $request->password
            );
           
            if (!Auth::attempt($userdata))
            {
                $error = 'Неправильный логин или пароль';
                return  view('admin.auth.login', [
                    'login' => $request->login,
                    'error' => $error
                ]);
            }
        }

        if (Auth::check()) {

            if(Auth::user()->is_ban == 1){
                $error = 'Вас заблокировали';
                Auth::logout();
                return  view('admin.auth.login', [
                    'login' => $request->login,
                    'error' => $error
                ]);
            }
            elseif(Auth::user()->role_id != 1){
                $error = 'Данный аккаунт не имеет доступа';
                Auth::logout();
                return  view('admin.auth.login', [
                    'login' => $request->login,
                    'error' => $error
                ]);
            }
            return redirect('/admin/category');
        }

        return  view('admin.auth.login',['login'=>'']);
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function clearCache()
    {
        Cache::flush();
    }

}
