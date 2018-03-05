@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 文章管理
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>图片信息修改</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
</div>
<div class="result_content">
    <div class="short_wrap">
        <a href="{{url('admin/picture/create')}}"><i class="fa fa-plus"></i>添加图片</a>
        <a href="{{url('admin/picture')}}"><i class="fa fa-recycle"></i>全部图片</a>
    </div>
</div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/picture/'.$pic_info->pic_id)}}" method="post">
        <input type="hidden" name="_method" value="put">
        {{ method_field('PUT') }}
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>分类：</th>
                <td>
                    <select name="pic_cate_id">
                        @foreach($cate_info as $d)
                            <option value="{{$d->cate_id}}"
                                    @if($d->cate_id==$pic_info['pic_cate_id']) selected @endif
                                    >{{$d->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>名称：</th>
                <td>
                    <input type="text" name="pic_name" value="{{$pic_info['pic_name']}}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>图片名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th>图片显示：</th>
                <td>
                    <img src="/{{$pic_info['pic_thumb']}}" alt="" id="pic_thumb_img" style="max-width: 150px;max-height: 100px;">
                </td>
            </tr>
            <tr>
                <th>图片简介：</th>
                <td>
                    <textarea name="pic_tips" >{{$pic_info['pic_tips']}}</textarea>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
@endsection