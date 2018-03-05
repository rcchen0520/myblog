@extends('layouts.home')
@section('info')
    <meta charset="utf-8">
    <title>{{Config::get('web.web_title')}}</title>
    <meta name="keywords" content="{{Config::get('web.keywords')}}" />
    <meta name="description" content="{{Config::get('web.description')}}" />
@endsection
@section('content')
    <!-- <div class="banner">
    <section class="box">
        <ul class="texts">
            <p>博看人生</p>
        </ul>
    </section>
    </div> -->
    <div class="template">
        <div class="box">
            <h3>
                <p><span>站长</span>推荐 Recommend</p>
            </h3>
            <ul>
                @foreach($pics as $p)
                <li><a href="{{'a/'.$p->art_id}}"  target="_blank"><img src="{{url($p->art_thumb)}}"></a><span>{{$p->art_title}}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
    <article>
        <h2 class="title_tj">
            <p>文章<span>推荐</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($data as $d)
                <h3>{{$d->art_title}}</h3>
                <figure><img src="{{url($d->art_thumb)}}"></figure>
                <ul>
                    <p>{{$d->art_description}}</p>
                    <a title="{{$d->art_title}}" href="{{url('a/'.$d->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <p class="dateview">&nbsp;<span>{{date('Y-m-d',$d->art_time)}}</span><span>作者：{{$d->art_editor}}</span></p>
            @endforeach
                <div class="page">
                    {{$data->links()}}
                </div>

        </div>
        <aside class="right">
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
            {{--<div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>--}}
            <div class="news" style="float: left">
                @parent
                <h3 class="links">
                    <p>友情<span>链接</span></p>
                </h3>
                <ul class="website">
                    @foreach($links as $l)
                        <li><a href="{{$l->link_url}}" target="_blank">{{$l->link_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </article>
@endsection
