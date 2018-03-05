<?php
namespace App\Http\Controllers\Admin;
use App\Http\Model\Category;
use App\Http\Model\Picture;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PictureController extends CommanController
{
    //图片列表显示
    public function index()
    {
        $pic_info = Picture::orderby('pic_time')->paginate(6);
//        print_r($pic_info);exit;
        return view('admin.picture.index',compact('pic_info'));
    }

    //添加图片
    public function create()
    {
        $cate = new Category();
        $cate_info = $cate->getPictureCate();
        return view('admin.picture.add',compact('cate_info'));
    }

    //处理添加图片数据
    public function store()
    {
        $data = Input::except('_token');
        $data['pic_time'] = time();
        $rule = [
            'pic_name' => 'required',
        ];
        $messages = [
            'pic_name.required' => '图片名称不能为空',
        ];
        $validator = Validator::make($data,$rule,$messages);
        if($validator->passes()){
            $url = Input::get('pic_url');
            $path = base_path().'/'.$url;
            $img = Image::make($path)->resize(220,150);
//            $entension = substr($url,strrpos($url,'.'));
            $newname = '220x150_'.substr($url,strrpos($url,'/')+1);
            $thumb_url = 'uploads/'.$newname;
//            print_r($newname);exit;
            $img->save($thumb_url);
            $data['pic_thumb'] = $thumb_url;
            $re = Picture::create($data);
            if($re){
                return redirect('admin/picture');
            }else{
                return back()->with('添加图片失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }

    }

    //修改图片信息
    public function edit($pic_id)
    {
        $cate = new Category();
        $cate_info = $cate->getPictureCate();
        $pic_info = Picture::find($pic_id);

        return view('admin.picture.edit',compact('cate_info','pic_info'));
    }

    //更新图片信息
    public function update($pic_id)
    {
        $data = Input::except('_token','_method');
        $re = Picture::where('pic_id','=',$pic_id)->update($data);
        if($re){
            return redirect('admin/picture');
        }else{
            return back()->with('errors','修改图片信息出错，请稍后再试。');
        }
    }

    //删除图片
    public function destroy($pic_id)
    {
        $re = Picture::where('pic_id','=',$pic_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '删除图片成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除图片失败，请稍后再试！',
            ];
        }
        return $data;
    }
}