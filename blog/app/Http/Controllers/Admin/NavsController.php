<?php

namespace App\Http\Controllers\Admin;


use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends commanController
{
    //
    public function index()
    {
        $data = Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $re = $nav->update();
        if($re){
            $data = [
                'status' => 0,
                'msg'    => '恭喜，修改排序成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg'    => '修改排序失败，请稍后再试！',
            ];
        }
        return $data;
    }

    //get;admin/category/create 添加分类
    public function create()
    {
        return view('admin.navs.add');
    }

    //post;admin/category
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $messages = [
            'nav_name.required' => '导航名称不能为空！',
            'nav_url.required' => '导航地址不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Navs::create($input);
            if($re){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','添加链接失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        return view('admin.navs.edit',compact('field'));
    }

    //put|patch;admin/category/{category}
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $re = Navs::where('nav_id',$nav_id)->update($input);
        if($re){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','修改链接失败，请稍后再试！');
        }
    }
    //delete;admin/navs/{navs} 删除分类
    public function destroy($nav_id)
    {
        $re = Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '删除分类成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除分类失败，请稍后再试！',
            ];
        }
        return $data;
    }
}
