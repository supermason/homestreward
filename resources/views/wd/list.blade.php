<!-- Top Navbar-->
<div class="navbar">
    <div class="navbar-inner">
        <div class="left sliding">
            <a href="#" data-panel="left" class="link icon-only open-panel">
                <i class="icon icon-back"></i>
            </a>
        </div>
        <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
        <div class="center sliding"><span class="app-title">��ȡ��</span></div>
    </div>
</div>
<!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
<div class="pages navbar-through">
    <!-- Page, "data-page" contains page name -->
    <div data-page="home-page" class="page">
        <!-- Search bar with "searchbar-init" class for auto initialization -->
        <form class="searchbar" data-found=".searchbar-found" data-not-found=".searchbar-not-found">
            <div class="searchbar-input">
                <input type="search" placeholder="�������ѯ�ؼ���"  >
                <a href="#" class="searchbar-clear"></a>
            </div>
            <a href="#" class="searchbar-cancel">ȡ��</a>
        </form>

        <!-- Search bar overlay -->
        <div class="searchbar-overlay"></div>
        <!-- Scrollable page content -->
        <div class="page-content pull-to-refresh-content infinite-scroll" data-ptr-distance="30" data-distance="50" ng-controller="SearchController" >
            <div class="pull-to-refresh-layer">
                <div class="preloader"></div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div class="content-block-title">���±���</div>
            <!-- This block will be displayed if nothing found -->
            <div class="list-block searchbar-not-found">
                <div class="content-block-inner">û���ҵ�����Ҫ�ı���</div>
            </div>
            <div class="list-block media-list search-here searchbar-found hidden">
                <ul>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX��Ʒ</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">������</div>
                                <div class="item-text">һЩ�򵥵Ľ���</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX��Ʒ</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">������</div>
                                <div class="item-text">һЩ�򵥵Ľ���</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX��Ʒ</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">������</div>
                                <div class="item-text">һЩ�򵥵Ľ���</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX��Ʒ</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">������</div>
                                <div class="item-text">һЩ�򵥵Ľ���</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item-link item-content">
                            <div class="item-media"><img src="..." width="80"></div>
                            <div class="item-inner">
                                <div class="item-title-row">
                                    <div class="item-title">XXX��Ʒ</div>
                                    <div class="item-after">$15</div>
                                </div>
                                <div class="item-subtitle">������</div>
                                <div class="item-text">һЩ�򵥵Ľ���</div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="list-block-label">
                <p style="text-align:center;">�������ظ�������</p>
            </div>
            <!-- ������ʾ�� -->
            <div class="infinite-scroll-preloader center">
                <div class="preloader"></div>
            </div>
        </div>
    </div>
</div>