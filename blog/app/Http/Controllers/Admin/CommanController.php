<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommanController extends Controller
{
    //
    public function upload()
    {
        $file = Input::file('Filedata');
        if($file->isValid()){
//            $clientName = $file->getClientOriginalName();//获取文件名称
//            $realPath = $file->getRealPath();//获取临时文件
            $entension = $file->getClientOriginalExtension();//获取文件后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $path = $file ->move(base_path().'/uploads',$newName);
            return 'uploads/'.$newName;
        }
    }
}
