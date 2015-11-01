<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Your app title -->
    <title>牛妞的小店</title>
    <!-- Path to Framework7 Library CSS, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.min.css">
    <!-- Path to Framework7 color related styles, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.colors.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="/css/wd.css">
</head>
<body>
<!-- Status bar overlay for full screen mode (PhoneGap) -->
<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>
<div class="panel panel-left-add panel-left panel-reveal">
    <div class="content-block-title"><p>宝贝分类</p></div>
    <div class="list-block">
        <ul>
            <li>
                <a href="#" class="item-link item-content">
                    <div class="item-media"><i class="icon icon-form-url"></i> </div>
                    <div class="item-inner">
                        <div class="item-title">分类1</div>
                        <div class="item-after">副标题</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item-link item-content">
                    <div class="item-media"><i class="icon icon-form-url"></i> </div>
                    <div class="item-inner">
                        <div class="item-title">分类1</div>
                        <div class="item-after">副标题</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item-link item-content">
                    <div class="item-media"><i class="icon icon-form-url"></i> </div>
                    <div class="item-inner">
                        <div class="item-title">分类1</div>
                        <div class="item-after">副标题</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item-link item-content">
                    <div class="item-media"><i class="icon icon-form-url"></i> </div>
                    <div class="item-inner">
                        <div class="item-title">分类1</div>
                        <div class="item-after">副标题</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item-link item-content">
                    <div class="item-media"><i class="icon icon-form-url"></i> </div>
                    <div class="item-inner">
                        <div class="item-title">分类1</div>
                        <div class="item-after">副标题</div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="panel panel-right-profile panel-right panel-reveal">
    <div class="content-block">
        <div class="content-block-inner">

        </div>
    </div>

</div>
<!-- Views -->
<div class="views toolbar-through theme-m">
    <!-- Your main view, should have "view-main" class -->
    <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left sliding">
                    <a href="#" data-panel="left" class="link icon-only open-panel">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
                <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                <div class="center sliding"><span class="app-title">牛妞的小店</span></div>
                <div class="right">

                </div>
            </div>
        </div>
        <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through">
            <!-- Page, "data-page" contains page name -->
            <div data-page="home-page" class="page">
                <!-- Search bar overlay -->
                <div class="searchbar-overlay"></div>
                <!-- Scrollable page content -->
                <div class="page-content">
                    <div class="swiper-container swiper-init swiper-container-horizontal" data-speed="400" data-space-between="40" data-pagination=".swiper-pagination">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">Slide 1</div>
                            <div class="swiper-slide">Slide 2</div>
                            <div class="swiper-slide">Slide 3</div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <!-- Search bar with "searchbar-init" class for auto initialization -->
                    <form class="searchbar" data-found=".searchbar-found" data-not-found=".searchbar-not-found">
                        <div class="searchbar-input">
                            <input type="search" placeholder="请输入关键字"  >
                            <a href="#" class="searchbar-clear"></a>
                        </div>
                        <a href="#" class="searchbar-cancel">取消</a>
                    </form>
                    <div class="content-block-title">新BB到货咯</div>
                    <!-- This block will be displayed if nothing found -->
                    <div class="list-block searchbar-not-found">
                        <div class="content-block-inner">抱歉，暂无您查找的宝贝</div>
                    </div>
                    <div class="list-block media-list pull-to-refresh-content infinite-scroll" data-ptr-distance="30" data-distance="50" search-here searchbar-found >
                        <div class="pull-to-refresh-layer">
                            <div class="preloader"></div>
                            <div class="pull-to-refresh-arrow"></div>
                        </div>
                        <div class="card wd-card-header-pic">
                            <div style="background-color: #080808" valign="bottom" class="card-header color-white no-border">Journey To Mountains</div>
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
                        </div>
                        <div class="card wd-card-header-pic">
                            <div style="background-color: #080808" valign="bottom" class="card-header color-white no-border">Journey To Mountains</div>
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
                        </div>
                    </div>
                    <div class="list-block-label">
                        <p style="text-align:center;">下拉加载更多内容</p>
                    </div>
                    <!-- ������ʾ�� -->
                    <div class="infinite-scroll-preloader center">
                        <div class="preloader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>@2015 <a href="mailto:jijiiscoming@hotmial.com">Mason</a>. All Rights Reserved.&nbsp;&nbsp;
            <a href="http://www.miitbeian.gov.cn/">鲁ICP备15023821</a></p>
    </div>
</div>
<!-- Path to your app js-->
<script data-main="/js/wd/main" src="{{asset('/js/lib/require.js')}}"></script>
</body>
</html>
