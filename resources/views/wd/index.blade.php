<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Your app title -->
    <title>{{trans('tip.shopTitle')}}</title>
    <!-- Path to Framework7 Library CSS, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.min.css">
    <!-- Path to Framework7 color related styles, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.colors.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="/css/wd.css">
    <!-- Favicons -->
    <link rel="icon" href="/img/wd/favicon.ico">
</head>
<body>
<!-- Status bar overlay for full screen mode (PhoneGap) -->
<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>
<div class="panel panel-left-add panel-left panel-reveal p-category-list">
    <div class="content-block-title"><p>{{trans('tip.leftPanel.naviTitle')}}</p></div>
    <div class="list-block media-list">
        <ul>
            @foreach($data['menu'] as $menu)
            <li>
                <a href="{{url('/wd/search/'.$menu->product_category.'?page=1')}}" class="item-link item-content">
                    <div class="item-media"><img src="{{asset($menu->icon)}}"> </div>
                    <div class="item-inner">
                        <div class="item-title-row">
                            <div class="item-title">{{$menu->label}}</div>
                            <div class="item-after">{{$menu->after_txt}}</div>
                        </div>
                        <div class="item-text">{{$menu->description}}</div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="panel logo-panel panel-right panel-reveal">
    <div class="content-block">
        <div class="content-block-inner">
            <div class="logo">
                <img src="{{asset('img/wd/bb_miya_logo.jpg')}}">
            </div>
        </div>
    </div>
    <div class="content-block-title">
        {{trans('tip.rightPanel.title')}}
    </div>
    <div class="content-block">
       <p>{{trans('tip.rightPanel.content1')}}</p>
    </div>
    <div class="content-block">
        <img class="img-responsive" src="{{asset('/img/wd/code.jpg')}}" />
    </div>
</div>
<!-- Views -->
<div class="views toolbar-through theme-m theme-red">
    <!-- Your main view, should have "view-main" class -->
    <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left sliding">
                    <a href="#" data-panel="left" class="link icon-only open-panel">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
                <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                <div class="center sliding app-icon-container">
                    <img class="app-icon" src="/img/wd/icon_32x32_reverse.png">
                    <span class="wd-title app-icon-txt">{{trans('tip.shopTitle')}}</span>
                </div>
                <div class="right">
                    <a href="#" data-panel="right" class="link icon-only open-panel">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through">
            <!-- Page, "data-page" contains page name -->
            <div data-page="home-page" class="page">

                <!-- Scrollable page content -->
                <div class="page-content infinite-scroll" data-distance="100">
                    <div class="swiper-container swiper-container-horizontal" data-speed="400" data-pagination=".swiper-pagination">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <!-- Search bar with "searchbar-init" class for auto initialization -->
                    <form class="searchbar" data-found=".searchbar-found" data-not-found=".searchbar-not-found">
                        <div class="searchbar-input">
                            <input type="search" placeholder="{{trans('tip.search.keywords')}}"  >
                            <a href="#" class="searchbar-clear"></a>
                        </div>
                        <a href="#" class="searchbar-cancel">{{trans('tip.cancel')}}</a>
                    </form>
                    <!-- Search bar overlay -->
                    <div class="searchbar-overlay"></div>
                    <div class="content-block-title"></div>
                    <!-- This block will be displayed if nothing found -->
                    <div class="list-block searchbar-not-found">
                        <div class="content-block-inner">{{trans('tip.search.notFound')}}</div>
                    </div>
                    <div class="list-block cards-list search-here searchbar-found hidden" >
                        @if (count($data['products']) == 0)
                           <p>{{trans('tip.search.notFound')}}</p>
                        @else
                            <ul>
                                @foreach($data['products'] as $product)
                                <li  class="card wd-card-header-pic">
                                    <div style="background-color: #ff6666" valign="bottom" class="card-header color-white no-border">Journey To Mountains</div>
                                    <div class="card-content">
                                        <div class="card-content-inner">
                                            <p class="color-gray">Posted on January 21, 2015</p>
                                            <p>Quisque eget vestibulum nulla...</p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="link">Like</a>
                                        <a href="#" class="link">Read more</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!-- 加载提示符 -->
                    <div class="infinite-scroll-preloader center">
                        <div class="preloader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Path to your app js-->
<script data-main="/js/wd/main" src="{{asset('/js/lib/require.js')}}"></script>
</body>
</html>
