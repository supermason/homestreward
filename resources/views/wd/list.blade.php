<!-- Top Navbar-->
<div class="navbar">
    <div class="navbar-inner">
        <div class="left sliding">
            <a href="#" data-panel="left" class="link icon-only open-panel">
                <i class="icon icon-back"></i>
            </a>
        </div>
        <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
        <div class="center sliding"><span class="app-title">读取吧</span></div>
    </div>
</div>
<!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
<div class="pages navbar-through">
    <!-- Page, "data-page" contains page name -->
    <div data-page="home-page" class="page">
        <!-- Search bar with "searchbar-init" class for auto initialization -->
        <form class="searchbar" data-found=".searchbar-found" data-not-found=".searchbar-not-found">
            <div class="searchbar-input">
                <input type="search" placeholder="请输入查询关键字"  >
                <a href="#" class="searchbar-clear"></a>
            </div>
            <a href="#" class="searchbar-cancel">取消</a>
        </form>

        <!-- Search bar overlay -->
        <div class="searchbar-overlay"></div>
        <!-- Scrollable page content -->
        <div class="page-content pull-to-refresh-content infinite-scroll" data-ptr-distance="30" data-distance="50" ng-controller="SearchController" >
            <div class="pull-to-refresh-layer">
                <div class="preloader"></div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div class="content-block-title">最新宝贝</div>
            <!-- This block will be displayed if nothing found -->
            <div class="list-block searchbar-not-found">
                <div class="content-block-inner">没有找到您需要的宝贝</div>
            </div>
            <div class="list-block media-list search-here searchbar-found hidden">
                <ul>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX商品</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">副标题</div>
                                <div class="item-text">一些简单的介绍</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX商品</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">副标题</div>
                                <div class="item-text">一些简单的介绍</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX商品</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">副标题</div>
                                <div class="item-text">一些简单的介绍</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX商品</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">副标题</div>
                                <div class="item-text">一些简单的介绍</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX商品</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">副标题</div>
                                <div class="item-text">一些简单的介绍</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="list-block-label">
                <p style="text-align:center;">下拉加载更多内容</p>
            </div>
            <!-- 加载提示符 -->
            <div class="infinite-scroll-preloader center">
                <div class="preloader"></div>
            </div>
        </div>
    </div>
</div>