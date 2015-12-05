define(['app'], function (app) {
    'use strict';

    var f7App = app.f7App,
        $ = app.$$,
        loading = false,
        billView = {
        // this是包含它的函数作为方法被调用时所属的对象
        curPage: 0,
        totalPage: 0,
        date: null, // 用于搜索的日期
        $scope: null,
        service: {},
        addService: function(key, func) {
            this.service[key] = func;
            return this;
        },
        hasNoMore: function () {
            return this.curPage >= this.totalPage && this.totalPage != 0;
        },

        init: function ($scope) {

            this.$scope = $scope;

            f7App.onPageInit("bill-page", function (page) {

                var pageCon = $(page.container);
                // 下拉获取
                var pullContent = pageCon.find('.pull-to-refresh-content');
                pullContent.on("refresh", function (e) {
                    if (!billView.hasNoMore()) {
                        billView.query();
                    } else {
                        resetUI();
                    };
                });
                // 无限滚动
                var infiniteScroll = $(".infinite-scroll");
                infiniteScroll.on("infinite", function () {
                    if (loading) return;
                    if (billView.hasNoMore()) return;
                    loading = true;
                    billView.query();
                });
                // 日期搜索
                var selectedDay = "";
                //var myCalendar = f7App.calendar({
                //    input: '#calendar-default',
                //    inputReadOnly: false,
                //    //value: [new Date()],
                //    monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                //    dayNames: ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期天'],
                //    dayNamesShort: ['星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期天'],
                //    closeOnSelect: true,
                //    onDayClick: function (p, dayContainer, year, month, day) {
                //        selectedDay = year + month + day;
                //        billView.reset();
                //        billView.date = [year, parseInt(month) + 1, day];
                //        billView.query();
                //    },
                //    onClose: function () {
                //
                //    }
                //});
                var mySearchCalender = app.createCalendar({
                    input: '#calendar-default',
                    onDayClick: function (p, dayContainer, year, month, day) {
                        selectedDay = year + month + day;
                        billView.reset();
                        billView.date = [year, parseInt(month) + 1, day];
                        billView.query();
                    }
                });

                var mySearch = f7App.searchbar(".searchbar", {
                    onDisable: function () {
                        if (selectedDay !== "") {
                            selectedDay = "";
                            billView.reset();
                            billView.query();
                        }
                    }
                });
                // 添加消费日期
                var myConsumptionCalender = app.createCalendar({
                    input: '#calendar-consumption',
                    onDayClick: function (p, dayContainer, year, month, day) {

                    }
                });

                // 新增消费类型的modal
                $("a[id='addNewCT']").on('click', function () {
                    f7App.prompt('新的消费类型名称', '消费新花样',
                        function (value) {
                            billView.service.addCT(value);
                        },
                        function (value) {

                        }
                    );
                });
                // 当月消费总和
                $("a[id='calTotal']").on('click', function(){
                    billView.service.getTotalExpense();
                });
            });

            return this;
        },

        query: function () {
            this.service.getBill();
        },

        update: function (response) {

            var data = response.data;
            if (!billView.hasNoMore()) {
                billView.$scope.data.bills = (billView.$scope.data.bills || []).concat(data.data);
            }
            showResultList();
            billView.curPage = data.current_page;
            billView.totalPage = data.last_page == 0 ? 1 : data.last_page;
            // 如果没有了，就改变一下提示文字
            if (billView.hasNoMore()) {
                $('.infinite-scroll-preloader').remove();
                $("div.list-block-label > p").text("没有更多了");
            }

            resetUI();
        },

        error: function (response) {
            alert("status: " + response.status + ", statusText: " + response.statusText);
            f7App.pullToRefreshDone();
        },

        reset: function () {
            this.date = null,
            this.curPage = 0;
            this.totalPage = 0;
            this.$scope.data.bills = [];
            $("div.list-block-label > p").text("下拉加载更多内容");
        },

        alert: function(msg, callback) {
            f7App.alert(msg, function(){
                if (callback !== undefined && callback !== null && (typeof(callback) === 'function')) {
                    callback.call();
                }
            });
        }
    };

    function resetUI() {
        // 加载完毕需要重置
        f7App.pullToRefreshDone();
        //
        loading = false;
    }

    function showResultList() {
        var resultList = $(".list-block.media-list.search-here.searchbar-found");
        if (resultList.hasClass("hidden")) {
            resultList.removeClass("hidden");
        }
    }

    return billView;
})