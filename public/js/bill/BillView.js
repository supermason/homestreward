define(['app', 'lang', 'MyBarChart', 'util'], function (app, lang, myChart, util) {
    'use strict';

    var f7App = app.f7App,
        $ = app.$$,
        loading = false,
        queryDate = {
            year: null,
            month: null,
            reset: function() {
                this.year = this.month = null;
            }
        },
        billView = {
            // this是包含它的函数作为方法被调用时所属的对象
            curPage: 0,
            totalPage: 0,
            date: null, // 用于搜索的日期
            $scope: null,
            service: {},
            /**
             * 为视图添加服务
             *
             * @param key
             * @param func
             * @returns {billView}
             */
            addService: function(key, func) {
                this.service[key] = func;
                return this;
            },
            /**
             * 是否还有更多页数
             *
             * @returns {boolean}
             */
            hasNoMore: function () {
                return this.curPage >= this.totalPage && this.totalPage != 0;
            },
            /**
             * 初始化视图
             *
             * @param $scope
             * @returns {billView}
             */
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
                    // 计算某个日期下的消费总和或查看当前日期下的消费图表
                    var dateTimePicker = app.createDateTimePicker({
                        input: "#dateTime-picker"
                    });
                    $("a[id='calTotal']").on('click', function() {
                        adjustQueryDate();
                        billView.service.getTotalExpense(queryDate.year, queryDate.month);
                    });

                    $("a[id='getChartData']").on("click", function() {
                        adjustQueryDate();
                        billView.service.getExpenseChartData(queryDate.year, queryDate.month);
                    });
                });

                return this;
            },
            /**
             * 查询账单
             *
             */
            query: function () {
                this.service.getBill();
            },
            /**
             * 账单查询结果更新视图
             *
             * @param response
             */
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

            /**
             * 打开图表所在的popover
             *
             * @param data
             */
            openChart: function(data) {
                // 修改popup-over的标题
                $('.popup-chart .navbar .navbar-inner .center > span.app-title').text(data.title + lang.bill.chart.title);
                // 创建图表
                data.maxDay = util.getMaxDayInGivenMonth(queryDate.year, queryDate.month);
                myChart.update(data);

                // 打开图表所在的popupover
                app.openPopUp(".popup-chart");
            },

            /**
             * 关闭视图内的 手风琴视图
             *
             * @param data
             */
            closeAccordion: function(data) {
                $('li.accordion-item a.item-link div.item-inner > p').text(data.name);
                // 顺便收起界面
                app.closeAccordion("li.accordion-item");
            },

            /**
             * 添加新的账单信息
             *
             * @param response
             */
            addNewRecords: function(response) {
                var data = response.data;
                if (data.success) {
                    f7App.alert(lang.bill.addRecords.ok, function() {
                        billView.reset();
                        billView.query();
                    });
                } else {
                    this.alert(lang.bill.addRecords.fail);
                }
            },

            /**
             * 处理报错信息
             *
             * @param response
             */
            error: function (response) {
                alert("status: " + response.status + ", statusText: " + response.statusText);
                f7App.pullToRefreshDone();
            },

            /**
             * 重置视图
             *
             */
            reset: function () {
                this.date = null,
                this.curPage = 0;
                this.totalPage = 0;
                this.$scope.data.bills = [];
                // 这里设置为无滚动，否则会有问题
                $("div.page-content").scrollTop(0);
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

    /**
     * 校准费用汇总或者图标查询的日期
     *
     */
    function adjustQueryDate() {
        // 先清理一下数据
        queryDate.reset();

        var date = $("input[id='dateTime-picker']").val().split('-');
        if (date.length > 1) {
            queryDate.year = date[0];
            queryDate.month = date[1]
        } else if (date.length == 1) {
            if (date[0].trim() === '') {
                queryDate.year = new Date().getFullYear();
            } else {
                queryDate.year = date[0];
            }
        }
    }

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