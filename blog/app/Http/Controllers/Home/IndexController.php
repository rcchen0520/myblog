<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Picture;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    //文章列表显示
    public function index()
    {
        $search = Input::get('search');
        // print_r($_SERVER['SERVER_NAME']);
        //点击量最高6篇(推荐)
        $pics = Article::orderBy('art_view','desc')->take(6)->get();
        //图文列表5篇（分页）
        if ($search=='') {
            $data = Article::orderBy('art_time','desc')->paginate(5);
        }else{
            $data = Article::where('art_title','like','%'.$search.'%')->paginate(5);     
        }

        //友情连接
        $links = Links::orderBy('link_order','asc')->get();

            return view('home.index',compact('pics','hot','data','new','links'));
    }


    public function cate($cate_id)
    {
        
        $search = Input::get('search');
        //分类查看次数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');
        $cateid = Category::where('cate_id',$cate_id)->orWhere('cate_pid',$cate_id)->get(array(
            'cate_id',
        ));
        foreach($cateid as $val){
            $ids[] = $val->cate_id;
        }
        //图文列表4篇分页
        if ($search=='') {
            $data = Article::whereIn('art_cate_id',$ids)->orderBy('art_time','desc')->paginate(5);
        }else{
            $data = Article::whereIn('art_cate_id',$ids)->where('art_title','like','%'.$search.'%')->orderBy('art_time','desc')->paginate(5);
        }
        
        $submenu = Category::where('cate_pid',$cate_id)->orderBy('cate_order','asc')->get();
        $field = Category::find($cate_id);
        return view('home.list',compact('field','data','submenu'));
    }

    public function article($art_id)
    {
        //文章查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');
        $field = Article::join('category','article.art_cate_id','=','category.cate_id')->where('art_id',$art_id)->first();
        $article['pre'] = Article::where('art_id','<',$field->art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id','>',$field->art_id)->orderBy('art_id','asc')->first();
        $data = Article::where('art_cate_id',$field->art_cate_id)->orderBy('art_time','desc')->take(6)->get();
        return view('home.new',compact('field','article','data'));
    }

    public function picture($cate_id){
        Category::where('cate_id',$cate_id)->increment('cate_view');
        $cateid = Category::where('cate_id',$cate_id)->orWhere('cate_pid',$cate_id)->get(array(
            'cate_id',
        ));
        foreach($cateid as $val){
            $ids[] = $val->cate_id;
        }
        $data = Picture::whereIn('pic_cate_id',$ids)->paginate(12);
        //获取相册分类图片数量
        $count = DB::select("select b.cate_name,count('pic_cate_id') as total,pic_cate_id from blog_picture as a join blog_category as b on a.pic_cate_id=b.cate_id GROUP BY a.pic_cate_id");
        return view('home.picture',compact('data','count'));
    }

    //图片详情页
    public function detail($pic_id){
        //图片查看次数自增
        Picture::where('pic_id',$pic_id)->increment('pic_view');

        $picture['pre'] = Picture::where('pic_id','<',$pic_id)->orderBy('pic_id','desc')->first();
        $picture['next'] = Picture::where('pic_id','>',$pic_id)->orderBy('pic_id','asc')->first();
        $data = Picture::where('pic_id','=',$pic_id)->first();

        return view('home.detail',compact('data','picture','count'));
    }
}
