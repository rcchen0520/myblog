<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$field->cate_name}}-{{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{$field->art_tag}}" />
    <meta name="description" content="{{$field->art_description}}" />
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
    <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&gt;&gt;<a href="{{url('cate/'.$field->cate_id)}}">{{$field->cate_name}}</a></span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$field->cate_id)}}" class="n2">{{$field->cate_name}}</a></h1>
    <div class="index_about">
        <h2 class="c_titile">{{$field->art_title}}</h2>
        <p class="box_c"><span class="d_time">{{date('Y-m-d',$field->art_time)}}</span><span>编辑：{{$field->art_editor}}</span><span>查看次数：{{$field->art_view}}</span></p>
        <ul class="infos">
           {!! $field->art_content !!}
        </ul>
        <div class="keybq">
            <p><span>关键字词</span>：{{$field->art_tag}}</p>
        </div>
        <div class="ad"> </div>
        <div class="nextinfo">
            <p>上一篇：
                @if($article['pre'])
                    <a href="{{url('a/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a>
                @else
                    <span>没有上一篇了</span>
                @endif
            </p>
            <p>下一篇：
                @if($article['next'])
                    <a href="{{url('a/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a>
                @else
                    <span>没有下一篇了</span>
                @endif
            </p>
        </div>
        <div class="otherlink">
            <h2>相关文章</h2>
            <ul>
                @foreach($data as $d)
                    <li><a href="{{url('a/'.$d->art_id)}}" title="{{$d->art_title}}">{{$d->art_title}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <aside class="right">
        <!-- Baidu Button BEGIN -->
        {{--<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>--}}
        {{--<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>--}}
        {{--<script type="text/javascript" id="bdshell_js"></script>--}}
        {{--<script type="text/javascript">--}}
            {{--document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)--}}
        {{--</script>--}}
        <!-- Baidu Button END -->

        <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        <div class="blank"></div>
        <div class="news">
            <h3>
                <p>最新<span>文章</span></p>
            </h3>
            <ul class="rank">
                @foreach($new as $n)
                    <li><a href="{{url('a/'.$n->art_id)}}" title="{{$n->art_title}}" target="_blank">{{$n->art_title}}</a></li>
                @endforeach
            </ul>
            <h3 class="ph">
                <p>点击<span>排行</span></p>
            </h3>
            <ul class="paih">
                @foreach($hot as $h)
                    <li><a href="{{'a/'.$h->art_id}}" title="{{$h->art_title}}" target="_blank">{{$h->art_title}}</a></li>
                @endforeach
            </ul>
        </div>
    </aside>
</article>
<footer>
    <p>{!! Config::get('web.copyright') !!} {!! Config::get('web.web_count') !!}
</footer>
{{--<script src="js/silder.js"></script>--}}
</body>
</html>