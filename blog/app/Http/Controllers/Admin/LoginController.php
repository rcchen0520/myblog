<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once('resources\org\code\Code.class.php');

class LoginController extends CommanController
{
    //
    function login()
    {
        if ($input = Input::all()) {
//            dd($input['code']);
            $code = new \code;
            $_code = $code->get();
            $user = User::first();
            if (strtoupper($input['code']) != $_code) {
                return back()->with('msg', '验证码错误');
            } elseif ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass']) {
//            } elseif ($user->user_name != $input['user_name'] || $user->user_pass != $input['user_pass']) {

                return back()->with('msg', '用户名或密码错误');

            } else {
                session(['user'=>$user]);
//                dd(session('user'));
                return redirect('admin/');
            }


        } else {
            return view('admin.login');
        }
    }

    public function code()
    {
        $code = new \code;
        echo $code->make();
    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

}
