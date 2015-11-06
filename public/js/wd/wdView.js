/**
 * Created by mason.ding on 2015/10/30.
 */
require(['app', 'util', 'service', 'template'], function(wdApp, util, serivce, template){

    var $ = wdApp.$$,
        loading = false,
        pageData = {
            current: 1,
            total: 9999, // 首次进入页面，不知道有多少页，所以默认有一堆数据
            curCategory: 1,
            /**
             * 初始化分页信息
             *
             * @param {int} cur
             * @param {int} total
             * @param {int} category
             */
            setData: function(cur, total, category) {
                this.current = cur;
                this.total = total;
                if (category != -1) {
                    this.curCategory = category;
                }
            },
            /**
             * 没有更多内容
             * @return {boolean}
             */
            hasNoMore: function() {
                return this.total == 0 || this.current == this.total;
            },
            /**
             * 获取分页查询地址
             *
             * @param {String} keyword
             * @return {String}
             */
            getURL: function (keyword) {
                return "search/"
                    + this.curCategory
                    + (keyword && keyword.trim() !== "" ? ("/" + encodeURIComponent(keyword)) : "")
                    + "?page=" + this.current;
            },
            /**
             * 重置数据分页信息
             */
            reset: function(){
                this.current = this.total = 1;
            }
        },
        productListTemplate = Template7.compile(template.productList),
        oprType = {
            pullToRefresh: 1,
            infiniteScroll: 2
        },
        curOprType = 2;

    // 页面初始化
    wdApp.f7App.onPageInit("home-page", function(page){

        // slider自动滚动
        var swiper = wdApp.f7App.swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            loop: true,
            paginationHide: false,
            paginationClickable: true
        });

        util.timer.start(function(){
            swiper.slideNext();
        }, 10000);

        // 搜索栏

        // 下拉刷新
        var pullContent = $('.pull-to-refresh-content');
        pullContent.on("refresh", function (e) {
            if (canQuery()) {
                curOprType = oprType.pullToRefresh;
                queryProduct(function() {
                    wdApp.pullToRefreshDone();
                });
            } else {
                wdApp.pullToRefreshDone();
            }
        });

        // 无限滚动初始化
        var infiniteScroll = $(".infinite-scroll");
        infiniteScroll.on("infinite", function (e) {
            if (canQuery()) {
                curOprType = oprType.infiniteScroll;
                queryProduct(null);
            }
        });

        // 左侧面板第一个链接。默认选中
        var firstAEle = $('.panel.panel-left div.list-block.media-list ul li:first-child a');
        firstAEle.addClass("active");
        // 中部产品列表标题默认设置为第一个链接的内容
        updateProductListTitle(firstAEle);

        // 左侧面板点击事件
        $('.panel.panel-left div.list-block.media-list ul li a').click(function(event){
            var aEle = $(this);
            // 更新产品列表标题
            updateProductListTitle(aEle);
            // 更新一下高亮状态
            wdApp.updateHighlight(".panel.panel-left div.list-block.media-list ul", aEle, "active");
            //
            var category = aEle.data('category');
            // 如果点击的是同一个分类，则无需交互
            if (category == pageData.curCategory) {
                return;
            }
            pageData.setData(1, 1, category);
            //
            serivce.call({
                url: pageData.getURL(),
                onError: function(xhr, status) {
                    wdApp.alert(status.toString());
                },
                onSuccess: function(data) {
                    // 滚动到最顶部
                    $(".page-content").scrollTop(0, 10, function(){
                        updateProductList(data, false);
                    });
                }
            });
        });
    });

    wdApp.init({
        hasInit:false,
        hasMainView: true
    });

    /**
     * 用户点击左侧分类后，刷新主界面的产品列表
     *
     * @param {Json} data
     * @param {boolean} append
     */
    function updateProductList(data, append) {
        loading = false;
        pageData.setData(data.current_page, data.last_page, -1);
        var pageCon = $('.page-content');
        var ul =  pageCon.find('.list-block.cards-list ul');
        // 移除现有数据
        if (data.total == 0) {
            ul.html(template.notFound);
            // 隐藏无限滚动提示
            wdApp.setElementShowOrHide(".infinite-scroll-preloader", false);
        } else {
            var newContent = productListTemplate(data);
            if (append) {
                if (curOprType == oprType.infiniteScroll) {
                    ul.append(newContent);
                } else {
                    ul.prepend(newContent);
                }
            } else {
                ul.html(newContent);
            }

            var noMore = pageData.hasNoMore();
            wdApp.setElementShowOrHide(".infinite-scroll-preloader", !noMore);
            wdApp.setElementShowOrHide(".list-block-label", noMore);
        }
    };

    /**
     * 是否还能够调用后台api
     *
     * @returns {boolean}
     */
    function canQuery() {
        return !loading && !pageData.hasNoMore();
    }

    /**
     * 查找商品(无限滚动或者搜索时)
     *
     * @param {function} callback
     */
    function queryProduct(callback) {
        loading = true;
        // 查找下一页的数据
        pageData.current++;
        // 获取一下是否有关键字
        var keyword = util.stripScript($("div.page-content form input[type=search]").val());
        serivce.call({
            url: pageData.getURL(keyword),
            onError: function (xhr, status) {
                wdApp.alert(status.toString());
                util.invokeFunction(callback);
            },
            onSuccess: function (data) {
                updateProductList(data, true);
                util.invokeFunction(callback);
            }
        });
    };

    /**
     * 更新产品列表的标题
     *
     * @param {f7 object} dsEle
     */
    function updateProductListTitle(dsEle) {
        var title = dsEle.find('div.item-title').text();
        $('.page-content .content-block-title.product-list-title').text(title);
    }
});