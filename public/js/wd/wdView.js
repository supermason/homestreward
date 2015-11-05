/**
 * Created by mason.ding on 2015/10/30.
 */
require(['app', 'util', 'service', 'template'], function(wdApp, util, serivce, template){

    var $$ = wdApp.$$,
        loading = false,
        pageData = {
            current: 1,
            total: 1,
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
                this.curCategory = category;
            },
            /**
             * 获取分页查询地址
             *
             * @return {String}
             */
            getURL: function () {
                return "search/" + this.curCategory + "?page=" + this.current;
            },
            /**
             * 重置数据分页信息
             */
            reset: function(){
                this.current = this.total = 1;
            }
        },
        productListTemplate = Template7.compile(template.productList);

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
        // 无限滚动初始化

        // 左侧面板点击事件
        $$('.panel.panel-left div.list-block.media-list ul li a').click(function(){
            var aEle = $$(this);
            //
            pageData.setData(1, 1, aEle.data('category'));
            //
            serivce.call({
                url: pageData.getURL(),
                onError: function(xhr, status) {
                    wdApp.alert(status.toString());
                },
                onSuccess: function(data) {
                    updateProductList(data);
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
     */
    function updateProductList(data) {
        pageData.total = data.last_page;
        var pageCon = $$('.page-content');
        var ul =  pageCon.find('.list-block.cards-list ul');
        // 移除现有数据
        if (data.total == 0) {
            container.html("<li>抱歉，暂时没有您要找的宝贝T_T</li>");
            // 隐藏无限滚动提示
            setInfiniteScrollPreloader(pageCon, false);
        } else {
            var newContent = productListTemplate(data);
            ul.html(newContent);
        }
    }

    /**
     * 设置无限滚动提示图片的状态
     *
     * @param {Object} container
     * @param {Boolean} show
     */
    function setInfiniteScrollPreloader(container, show) {
        var preloader = container.find('infinite-scroll-preloader');
        if (preloader.length > 0) {
            if (show) {
                if (preloader.hasClass('hidden')) {
                    preloader.removeClass('hidden');
                }
            } else {
                if (!preloader.hasClass('hidden')) {
                    preloader.addClass('hidden');
                }
            }
        }
    }
});