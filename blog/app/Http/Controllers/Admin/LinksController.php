<?php

namespace App\Http\Controllers\Admin;


use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends commanController
{
    //
    public function index()
    {
        $data = Links::orderBy('link_order','asc')->get();
        return view('admin.links.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $re = $link->update();
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
        return view('admin.links.add');
    }

    //post;admin/category
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];
        $messages = [
            'link_name.required' => '链接名称不能为空！',
            'link_url.required' => '链接地址不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Links::create($input);
            if($re){
                return redirect('admin/links');
            }else{
                return back()->with('errors','添加链接失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    public function edit($cate_id)
    {
        $field = Links::find($cate_id);
        return view('admin.links.edit',compact('field'));
    }

    //put|patch;admin/category/{category}
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $re = Links::where('link_id',$link_id)->update($input);
        if($re){
            return redirect('admin/links');
        }else{
            return back()->with('errors','修改链接失败，请稍后再试！');
        }
    }
    //delete;admin/links/{links} 删除分类
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
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
