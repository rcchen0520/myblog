<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommanController
{
    //
    /**
     *
     */
//    function index(){
//        $pdo = DB::connection()->getPdo();
//        dd($pdo);
//    }
    public function index()
    {
        return view('admin/index');
    }

    public function info()
    {
        return view('admin/info');
    }

    public function pass()
    {
        if($input=Input::all()) {
            $rules = [
                'password' => 'required|between:6,20|confirmed'
            ];
            $message = [
              'password.required' => '新密码不能为空',
              'password.between'  => '新密码必须在6-20位之间',
              'password.confirmed'=> '新密码与确认密码必须相同',
            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user=User::first();
                $pass_o=Crypt::decrypt($user->user_pass);
//                $pass_o=$user->user_pass;
                if($input['password_o']!=$pass_o){
                    return back()->with('errors','原密码错误');
                }else{
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','修改密码成功');
                }
            }else{
//               dd($validator->errors()->all());
                return back()->withErrors($validator);
            }
        }
        return view('admin/pass');
    }



}
