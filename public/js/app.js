/**
 * 创建myApp 对象
 * myApp包含：f7-Framework7的对象
 *           $$-Framework7的选择器变体
 *           mv-Framework7的主视图
 */
define(['framework7', 'lang'], function (fw7, lang) {
    'use strict';

    var myApp = {
            name: "myApp", // 名称
            config: { // 配置
                apiRoot: 'http://www.homestreward.cn/'
            }
        },

        f7App = new Framework7({ // f7应用，默认不初始化
            init: false,
            modalTitle: lang.app.modalTitle,
            modalButtonOk: lang.app.modalButtonOk,
            modalButtonCancel: lang.app.modalButtonCancel,
            smartSelectBackOnSelect: true,
            cache: false,
            pushState: true,
            preloadPreviousPage: false
        }),

        $$ = Framework7.$;
    // 变体
    myApp.$$ = $$;
    // 显示preloader
    myApp.showPreloader = function() {
        f7App.showPreloader(lang.app.preloaderTip);
    };
    // 隐藏preloader
    myApp.hidePreloader = function() {
        f7App.hidePreloader();
    }
    // alert
    myApp.alert = function (msg, callback) {
        f7App.alert(msg, callback);
    };
    // 赋值
    myApp.f7App = f7App;
    // toString
    myApp.toString = function () {
        return "app-version: 1.0.0.0"
                + "\nframework7-version: " + f7App.version
    };

    // 其他公有方法
    /**
     * 初始化应用
     * @param option {Object} - 根据不同的应用，做对应的初始化
     */
    myApp.init = function(options) {
        myApp.$$.ajaxSetup({"dataType": "json"});
        if (options) {
            if (!options.hasInit) {
                f7App.init();
            }
            // 主视图：对于tab类型的应用，没有view-main 这个class
            if (options.hasMainView) {
                f7App.addView('.view-main', {
                    dynamicNavbar: true
                });
            }
        }
    };

    /**
     * 结束下拉刷新
     *
     */
    myApp.pullToRefreshDone = function() {
        f7App.pullToRefreshDone();
    }

    /**
     * 设置一个组件显示或者隐藏
     *
     * @param {string} selector
     * @param {boolean} show
     */
    myApp.setElementShowOrHide = function (selector, show) {
        var element = $$(selector);
        if (element.length > 0) {
            if (show) {
                if (element.hasClass('hidden')) {
                    element.removeClass('hidden');
                }
            } else {
                if (!element.hasClass('hidden')) {
                    element.addClass('hidden');
                }
            }
        }
    }

    /**
     * 更新一组列表的高亮状态
     *
     * @param {string} selector
     * @param {dom-element} selected
     * @param {string} className
     */
    myApp.updateHighlight = function(selector, selected, className) {
        if (selected && selected.length > 0) {
            var eleName = selected[0].localName;
            $$(selector).find(eleName).removeClass(className);
            selected.addClass(className);
        }

    }

    return myApp;
});



    

