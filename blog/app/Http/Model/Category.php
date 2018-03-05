<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded =[];
    //
    public function tree()
    {
        $categorys = $this->orderby('cate_order','asc')->get();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid',0);

//        $categorys = Category::all();
//        return (new Category)->getTree($categorys,'cate_name','cate_id','cate_pid',0);

//        return $this->getTree($categorys,'cate_name','cate_id','cate_pid',0);

    }
    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach($data as $k => $v) {
            if ($v->$field_pid == $pid){
                $data[$k]["_".$field_name] = $data[$k][$field_name];
                $arr[] = $data[$k];
                foreach($data as $m =>$n){
                    if($n->$field_pid == $v->$field_id){
                        $data[$m]["_".$field_name] = "├─ ".$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;

    }

    //获取相册分类信息
    public function getPictureCate(){
        $cate = $this->where('cate_pid','=','15')->orderby('cate_order')->get(array(
            'cate_id',
            'cate_name',
        ));
        $cate_info = array();
        if(count($cate)!=0){
            foreach($cate as $key => $val){
                $cate_info[] = $cate[$key];
            }
        }
        return $cate_info;

    }
}
