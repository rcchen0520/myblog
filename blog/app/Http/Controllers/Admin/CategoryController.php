<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationServiceProvider;

class CategoryController extends CommanController
{
    //get;admin/category
    public function index()
    {
        $categorys = (new Category())->tree();
//        $categorys = Category::tree();
//        $data = $this->getTree($categorys,'cate_name','cate_id','cate_pid',0);
        return view('admin.category.index')->with('data',$categorys);
    }

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
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


    //post;admin/category
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'cate_name' => 'required',
        ];
        $messages = [
            'cate_name.required' => '分类名称不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','添加分类失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }
    //get;admin/category/create 添加分类
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }
    //delete;admin/category/{category} 删除分类
    public function destroy($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
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
    //put|patch;admin/category/{category}
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $re = Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','修改分类失败，请稍后再试！');
        }
    }
    //get;admin/category{category}
    public function show()
    {
        
    }
    //get;admin/category/{category}/edit
    public function edit($cate_id)
    {
        $data = Category::where('cate_pid',0)->get();
        $field = Category::find($cate_id);
        return view('admin.category.edit',compact('field','data'));
    }
}
