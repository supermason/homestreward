<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Your app title -->
    <title>JM的小管家</title>
    <!-- Path to Framework7 Library CSS, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.min.css">
    <!-- Path to Framework7 color related styles, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.colors.min.css">
      <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="/css/app.css" />
  </head>
  <body>
    <!-- Status bar overlay for full screen mode (PhoneGap) -->
    <div class="statusbar-overlay"></div>
    <div class="panel-overlay"></div>
    <div class="panel panel-left-add panel-left panel-reveal" ng-controller="AddController">
      <div class="content-block-title"><p>添加消费记录</p></div>
      <form method="post" id="addForm" name="addForm" ng-submit="newData.addBill()">
        <div class="list-block">
          <ul>
            <li>
              <div class="item-content">
                <div class="item-inner">
                  <div class="item-input">
                    <input type="text" name="amount" placeholder="今天花了多少票票" required ng-pattern="/^\d+$/" title="请输入数字" ng-model="newData.bill.amount">
                  </div>
                </div>
              </div>
            </li>
            <li class="accordion-item">
                <a href="#" class="item-link item-content">
                    <div class="item-inner">
                        <p>消费类型</p>
                    </div>
                </a>
                <div class="accordion-item-content">
                    <div class="list-block">
                        <ul>
                            <li ng-repeat="category in newData.categories">
                                <label class="label-radio item-content">
                                    <!-- Checked by default -->
                                    <input type="radio" name="categoryId" value="{{category.id}}" ng-model="newData.bill.categoryId">
                                    <div class="item-inner">
                                        <small>{{category.name}}</small>
                                    </div>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
              <div class="item-content">
                <div class="item-inner">
                  <div class="item-input">
                    <input type="text" name="remark" ng-model="newData.bill.remark" placeholder="有什么想补充的，写在这里吧">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="item-content">
                <div class="item-inner">
                  <input type="submit" class="button right" value="添加" ng-disabled="newData.bill.amount==undefined||newData.bill.amount==''||newData.bill.categoryId==0" />
                </div>
              </div>
            </li>
          </ul>
        </div>
      </form>
        <div class="content-block">
            <p><a href="#" id="addNewCT" class="button button-fill prompt-title-ok-cancel">新增消费类型</a></p>
            <p><a href="#" id="calTotal" class="button button-fill">当月消费总和</a></p>
        </div>
    </div>
    <div class="panel panel-right-profile panel-right panel-reveal">
      <div class="content-block">
        <div class="content-block-inner">

        </div>
      </div>

    </div>
    <!-- Views -->
    <div class="views tabs toolbar-through theme-m">
      <!-- Your main view, should have "view-main" class -->
      <div class="view tab active" id="view-bill">
        <!-- Top Navbar-->
        <div class="navbar">
          <div class="navbar-inner">
            <div class="left sliding">
              <a href="#" data-panel="left" class="link icon-only open-panel">
                <i class="icon icon-plus">+</i>
              </a>
            </div>
            <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
            <div class="center sliding">记帐吧</div>
              <div class="right"></div>
          </div>
        </div>
        <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through">
          <!-- Page, "data-page" contains page name -->
          <div data-page="bill-page" class="page">
            <!-- Search bar with "searchbar-init" class for auto initialization -->
            <form class="searchbar" data-found=".searchbar-found" data-not-found=".searchbar-not-found">
              <div class="searchbar-input">
                <input type="search" placeholder="请输入日期"  id="calendar-default" >
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
              <div class="content-block-title">消费记录</div>
              <!-- This block will be displayed if nothing found -->
              <div class="list-block searchbar-not-found">
                <div class="content-block-inner">您查找的日期没有消费记录</div>
              </div>
              <div class="list-block media-list search-here searchbar-found hidden">
                <div class="card" ng-repeat="bill in data.bills">
                  <div class="card-content">
                    <div class="card-header">{{$index+1}}、{{bill.who}} [{{bill.date}}]</div>
                    <div class="card-content">
                      <div class="card-content-inner">{{bill.category}}: {{bill.amount}}</div>
                    </div>
                    <div class="card-footer" ng-if="bill.remark !== null && bill.remark !==''">
                      备注：{{bill.remark}}
                    </div>
                  </div>
                </div>
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
      </div>
      <!-- Second view -->
        <div class="view tab" id="view-ws">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="left sliding">

                    </div>
                    <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                    <div class="center sliding">库存查询</div>
                </div>
            </div>
        </div>
        <!--  Third view     -->
        <div class="view tab" id="view-temp">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="left sliding">

                    </div>
                    <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                    <div class="center sliding">我的信息</div>
                </div>
            </div>
            <div class="pages navbar-through">
                <div class="page" data-page="personal-page" ng-controller="UserController">
                    <div class="page-content">
                        <div class="content-block avatar-container">
                            <div class="content-block-inner">
                                <div class="avatar"><img  /></div>
                                <p>
                                    <span id="user-info">
                                        <?php echo Auth::User()->name ?>
                                    </span>
                                    <a href="#" class="icon-only  prompt-title-ok-cancel" title="修改昵称">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--  Bottom Tabbar  -->
        <div class="toolbar tabbar toolbar-through tabbar-through tabbar-labels">
            <div class="toolbar-inner">
                <a href="#view-bill" class="tab-link active">
                    <i class="fa fa-yen fa-2x"></i>
                    <span class="tabbar-label">记帐</span>
                </a>
                <a href="#view-ws" class="tab-link">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="tabbar-label">库存</span>
                </a>
                <a href="#view-temp" class="tab-link">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="tabbar-label">我</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Path to your app js-->
    <script data-main="js/main" src="/js/lib/require.js"></script>
  </body>
</html>
