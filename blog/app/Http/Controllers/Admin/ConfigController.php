<?php

namespace App\Http\Controllers\Admin;


use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends commanController
{
    //
    public function index()
    {
        $data = Config::orderBy('conf_order','asc')->get();
        foreach($data as $k => $v){
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html = '<input type="text" class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea class="lg" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                    $arr = explode(',',$v->field_value);
                    $str = '';
                    $c = '';
                    foreach($arr as $m => $n){
                        $r = explode('|',$n);
                        if($v->conf_content == $r[0]){
                            $c .= ' checked ';
                        }
                        $str .= '<input type="radio" name="conf_content[]" value="'.$r[0].'"'.$c.'>'.$r[1].'　';
                    }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.config.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $conf = Config::find($input['conf_id']);
        $conf->conf_order = $input['conf_order'];
        $re = $conf->update();
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
        return view('admin.config.add');
    }

    //post;admin/config
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'conf_name' => 'required',
            'conf_title' => 'required',
        ];
        $messages = [
            'conf_name.required' => '导航名称不能为空！',
            'conf_title.required' => '导航地址不能为空！',
        ];
        $validator = Validator::make($input,$rules,$messages);
        if($validator->passes()){
            $re = Config::create($input);
            if($re){
                return redirect('admin/config');
            }else{
                return back()->with('errors','添加配置失败，请稍后再试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }

    //put|patch;admin/config/{config}
    public function update($conf_id)
    {
        $input = Input::except('_token','_method');
        $re = Config::where('conf_id',$conf_id)->update($input);
        if($re){
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back()->with('errors','修改链接失败，请稍后再试！');
        }
    }
    //delete;admin/config/{config} 删除分类
    public function destroy($conf_id)
    {
        $re = Config::where('conf_id',$conf_id)->delete();
        if($re){
            $this->putFile();
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

    public function changeContent()
    {
        $input = Input::all();
        foreach($input['conf_id'] as $k => $v){
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','更新内容成功！');
    }

    public function putFile(){
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path().'\config\web.php';
        $str = '<?php return '.var_export($config,true).';';
        file_put_contents($path,$str);
    }
}