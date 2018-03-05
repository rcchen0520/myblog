<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommanController
{
    //文章列表;admin/article
    public function index()
    {
        $data = Article::orderBy('art_id','desc')->paginate(10);
        // print_r($data);
        // exit;
        return view('admin.article.index',compact('data'));
    }

    //添加文章；admin/article/create
    public function create()
    {
        $data = (new Category())->tree();
        return view('admin.article.add',compact('data',$data));
    }
    //admin/article;接受添加的数据
    public function store()
    {
        $input = Input::except('_token');
        $input['art_time'] = time();
        $rules = [
            'art_title' => 'required',
            'art_content' => 'required',
        ];
        $messages = [
            'art_title.required' => '标题不能为空',
            'art_content.required' => '内容不能为空',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Article::create($input);
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','添加文章失败，请稍后再试！');
            }
        }else{
                return back()->withErrors($validator);
        }
    }
    //get;admin/article/{article}/edit
    public function edit($art_id)
    {
        $data = (new Category())->tree();
        $field = Article::find($art_id);
        return view('admin.article.edit',compact('data','field'));
    }
    //put|patch;admin/category/{category}
    public function update($art_id)
    {
        $input = Input::except('_token','_method');
        $re = Article::where('art_id',$art_id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return back()->with('errors','修改文章出错，请稍后再试！');
        }
    }
    //delete;admin/article/{article} 删除文章
    public function destroy($art_id)
    {
        $re = Article::where('art_id',$art_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '删除文章成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除文章失败，请稍后再试！',
            ];
        }
        return $data;
    }
}
