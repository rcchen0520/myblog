<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    {{--<meta name="keywords" content="{{$field->art_tag}}" />--}}
    {{--<meta name="description" content="{{$field->art_description}}" />--}}
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <!-- <div id="logo"><a href="{{url('/')}}"></a></div> -->
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach
        &nbsp;&nbsp;
        <a href="#" style='font-size: 10px;padding-right: 0px'><span>登录&nbsp;/</span><span class="en">login</span></a>
        <a href="#" style='font-size: 10px;padding-left: 0px;margin-left: 0px;'><span>注册</span><span class="en">register</span></a>
    </nav>
</header>
<article class="blogs">
    <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&gt;&gt;<a href="{{url('picture/detail'.$data->pic_id)}}">图片详情</a></span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('picture/detail'.$data->pic_id)}}" class="n2">{{$data->pic_name}}</a></h1>
    <div class="index_about" align="center">
        <h2 class="c_titile">{{$data->pic_name}}</h2>
        {{--<p class="box_c"><span class="d_time">{{date('Y-m-d',$field->art_time)}}</span><span>编辑：{{$field->art_editor}}</span><span>查看次数：{{$field->art_view}}</span></p>--}}
        <ul class="infos">
            {{--{!! $field->art_content !!}--}}
            <img src="{{'/'.$data->pic_url}}" alt="">
            <span>{{$data->pic_tips}}</span>
        </ul>
        <div class="ad"> </div>
        <div class="nextinfo" align="left">
            <p>上一张：
                @if($picture['pre'])
                    <a href="{{url('picture/detail/'.$picture['pre']->pic_id)}}">{{$picture['pre']->pic_name}}</a>
                @else
                    <span>没有上一张了</span>
                @endif
            </p>
            <p>下一张：
                @if($picture['next'])
                    <a href="{{url('picture/detail/'.$picture['next']->pic_id)}}">{{$picture['next']->pic_name}}</a>
                @else
                    <span>没有下一篇了</span>
                @endif
            </p>
        </div>
            {{--<div class="otherlink">--}}
                {{--<h2>相关文章</h2>--}}
                {{--<ul>--}}
                    {{--@foreach($data as $d)--}}
                        {{--<li><a href="{{url('a/'.$d->art_id)}}" title="{{$d->art_title}}">{{$d->art_title}}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
    </div>
    <aside class="right">
        {{--@if(count($count))--}}
            {{--<div class="rnav">--}}
                {{--<ul>--}}
                    {{--@foreach($count as $k => $v)--}}
                        {{--<li class="rnav{{$k+1}}"><a href="{{url('picture/'.$v->pic_cate_id)}}" target="_blank">{{$v->cate_name.'('.$v->total.')'}}</a></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--@endif--}}
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
        <div class="blank"></div>
        <div class="news">
            <h3>
                <p>最新<span>图片</span></p>
            </h3>
            <ul class="rank">
                @foreach($pic as $p)
                    <li><a href="{{url('picture/detail'.$p->pic_id)}}" title="{{$p->pic_name}}" target="_blank">{{$p->pic_name}}</a></li>
                @endforeach
            </ul>
            <h3 class="ph">
                <p>点击<span>排行</span></p>
            </h3>
            <ul class="paih">
                @foreach($pic_hot as $h)
                    <li><a href="{{'/picture/detail/'.$h->pic_id}}" title="{{$h->pic_name}}" target="_blank">{{$h->pic_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </aside>
</article>
<footer>
    {{--<p>{!! Config::get('web.copyright') !!} {!! Config::get('web.web_count') !!}--}}
</footer>
{{--<script src="js/silder.js"></script>--}}
</body>
</html>