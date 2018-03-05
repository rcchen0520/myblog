<!doctype html>
<html>
<head>
    @yield('info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <!-- <div id="logo"><a href="{{url('/')}}"></a></div> <-->
    <form action="{{$_SERVER['REQUEST_URI']}}">
        <div id="search"><input type="text" name="search" value="" placeholder="输入搜索内容" onmouseover="this.style.borderColor='#99ccff'" onmouseout="this.style.borderColor=''"><button type="submit">搜索</button></div>
    </form>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach
        &nbsp;&nbsp;
        <a href="#" style='font-size: 10px;padding-right: 0px'><span>登录&nbsp;/</span><span class="en">login</span></a>
        <a href="#" style='font-size: 10px;padding-left: 0px;margin-left: 0px;'><span>注册</span><span class="en">register</span></a>

    </nav>
    <!-- <div><input type="text" style=''></div> -->
</header>
@section('content')
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
@show
<footer>
    <p>{!! Config::get('web.copyright') !!} {!! Config::get('web.web_count') !!}
</footer>
{{--<script src="{{asset('resources/views/home/js/silder.js')}}"></script>--}}
</body>
</html>
