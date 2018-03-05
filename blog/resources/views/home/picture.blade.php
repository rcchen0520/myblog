<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta charset="utf-8">
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
</head>
<body>
<header>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach
        &nbsp;&nbsp;
        <a href="#" style='font-size: 10px;padding-right: 0px'><span>登录&nbsp;/</span><span class="en">login</span></a>
        <a href="#" style='font-size: 10px;padding-left: 0px;margin-left: 0px;'><span>注册</span><span class="en">register</span></a>
    </nav>
</header>
<article class="blogs">
  <h1 class="t_nav"><span>您当前的位置：<a href="/index.html">首页</a>&nbsp;&gt;&nbsp;<a href="/news/s/">慢生活</a>&nbsp;&gt;&nbsp;<a href="/news/s/">日记</a></span><a href="/" class="n1">网站首页</a><a href="{{url('/picture')}}" class="n2">相册</a></h1>
  <div class="index_about">
  <div class="template" style="width:800px;">
        <div class="box" style="width:800px;">
            <ul>
                @foreach($data as $val)
            <li><a href="{{url('/picture/detail/'.$val->pic_id)}}"  target="_blank"><img src="{{'/'.$val->pic_thumb}}"></a><span>{{$val->pic_name}}</span></li>
                @endforeach
          </ul>
        </div>
    </div>
    
    {{--<div class="ad"> </div>--}}
      <div class="page">
          {{$data->links()}}
      </div>
    
  </div>
  <aside class="right">
      @if(count($count))
          <div class="rnav">
              <ul>
                  @foreach($count as $k => $v)
                      <li class="rnav{{$k+1}}"><a href="{{url('picture/'.$v->pic_cate_id)}}" target="_blank">{{$v->cate_name.'('.$v->total.')'}}</a></li>
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
          </div>

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
          {{--<div class="visitors">--}}

    {{--</div>--}}
  </aside>
</article>
<footer>
  <p> <a href="/">网站统计</a></p>
</footer>
<script src="js/silder.js"></script>
</body>
</html>