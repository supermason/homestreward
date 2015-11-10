<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{trans('adminTip.pageTitle')}}">
    <meta name="keywords" content="weixin, wd, weishang">
    <meta name="author" content="Mason Ding: <jijiiscoming@hotmail.com>">
    <!-- Favicons -->
    <link rel="icon" href="/img/wd/favicon.ico">

    <title>{{trans('adminTip.pageTitle')}}</title>

    <link href="{{asset('/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/admin.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar admin-navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="{{asset('/img/wd/admin/wd_admin_logo_reverse.png')}}"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav admin-nav">
                    <li><a class="active" href="#">{{trans('adminTip.nav.leftNav.product')}}</a> </li>
                    <li><a href="#">{{trans('adminTip.nav.leftNav.activities')}}</a> </li>
                </ul>
                <ul class="nav navbar-nav admin-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">{{trans('adminTip.nav.rightNav.login')}}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{trans('adminTip.nav.rightNav.welcome')}}&nbsp;<span class="fa fa-user"></span>&nbsp;{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu admin-dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/auth/logout') }}">
                                        {{trans('adminTip.nav.rightNav.logout')}}<i class="fa fa-sign-out"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="banner">
        <div class="container">
            <h1>{{trans('adminTip.banner.title')}}</h1>
            <p>{{trans('adminTip.banner.content')}}</p>
        </div>
    </div>

    @yield('content')

    <footer class="footer">
        <p>@2015 <a href="mailto:jijiiscoming@hotmial.com">Mason</a>. All Rights Reserved.&nbsp;&nbsp;
            <a href="http://www.miitbeian.gov.cn/">鲁ICP备15023821</a></p>
    </footer>

    <script src="{{asset('/js/lib/jquery.2.1.4.min.js')}}"></script>
    <script src="{{asset('js/lib/bootstrap.min.js')}}"></script>
</body>
</html>