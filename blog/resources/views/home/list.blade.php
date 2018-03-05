@extends('layouts.home')
@section('info')
    <meta charset="utf-8">
    <title>{{$field->cate_name}}-{{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{$field->cate_keywords}}" />
    <meta name="description" content="{{$field->cate_description}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>{{$field->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$field->cate_id)}}" class="n2">{{$field->cate_name}}</a></h1>
        <div class="newblog left">
            @foreach($data as $d)
                <h2>{{$d->art_title}}</h2>
                <p class="dateview">&nbsp;<span>{{date('Y-m-d',$d->art_time)}}</span><span>作者：{{$d->art_editor}}</span><span>分类：[<a href="{{url('cate/'.$field->cate_id)}}">{{$field->cate_name}}</a>]</span></p>
                <figure><img src="{{url($d->art_thumb)}}"></figure>
                <ul class="nlist">
                    <p>{{$d->art_description}}</p>
                    <a title="{{$d->art_title}}" href="{{url('a/'.$d->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <div class="line"></div>
            @endforeach

            <div class="blank"></div>
            {{--<div class="ad">--}}
                {{--<img src="images/ad.png">--}}
            {{--</div>--}}
            <div class="page">
                {{$data->links()}}
            </div>
        </div>
        <aside class="right">
            @if($submenu->all())
            <div class="rnav">
                <ul>
                    @foreach($submenu as $k => $v)
                    <li class="rnav{{$k+1}}"><a href="{{url('cate/'.$v->cate_id)}}" target="_blank">{{$v->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Baidu Button BEGIN -->
                <div class="bdsharebuttonbox">
                    <a href="#" class="bds_more" data-cmd="more"></a>
                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                </div>
                <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
            <!-- Baidu Button END -->
            <div class="news" style="float:left">
               @parent
            </div>
            <div class="visitors">
                <h3><p>最近访客</p></h3>
                <ul>

                </ul>
            </div>

        </aside>
    </article>
@endsection