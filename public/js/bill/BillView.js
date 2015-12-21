﻿define(['app', 'lang', 'chart.min'], function (app, lang, chart) {
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
                    var queryDate = $("input[id='dateTime-picker']").val().split('-'),
                        year = null,
                        month = null;
                    if (queryDate.length > 1) {
                        year = queryDate[0];
                        month = queryDate[1]
                    } else if (queryDate.length == 1) {
                        if (queryDate[0].trim() === '') {
                            year = new Date().getFullYear();
                        } else {
                            year = queryDate[0];
                        }
                    }

                    billView.service.getTotalExpense(year, month);
                });

                var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
                var lineChartData = {
                    labels : ["January","February","March","April","May","June","July"],
                    datasets : [
                        {
                            label: "My First dataset",
                            fillColor : "rgba(220,220,220,0.2)",
                            strokeColor : "rgba(220,220,220,1)",
                            pointColor : "rgba(220,220,220,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(220,220,220,1)",
                            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                        },
                        {
                            label: "My Second dataset",
                            fillColor : "rgba(151,187,205,0.2)",
                            strokeColor : "rgba(151,187,205,1)",
                            pointColor : "rgba(151,187,205,1)",
                            pointStrokeColor : "#fff",
                            pointHighlightFill : "#fff",
                            pointHighlightStroke : "rgba(151,187,205,1)",
                            data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                        }
                    ]

                };

                $('.popup-chart').on('opened', function () {
                    var ctx = $("canvas")[0].getContext("2d");
                    new chart(ctx).Line(lineChartData, {
                        responsive: true
                    });
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

        closeAccordion: function(data) {
            $('li.accordion-item a.item-link div.item-inner > p').text(data.name);
            // 顺便收起界面
            app.closeAccordion("li.accordion-item");
        },

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

        error: function (response) {
            alert("status: " + response.status + ", statusText: " + response.statusText);
            f7App.pullToRefreshDone();
        },

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