?/**
 * Created by mason.ding on 2015/10/30.
 * 创建wdApp 对象
 * wdApp包含：f7-Framework7的对象
 *           $$-Framework7的选择器变体
 *           mv-Framework7的主视图
 */
define(['framework7'], function () {
    'use strict';

    var wdApp = {};

    // 名称
    wdApp.name = "wdApp";

    // 配置
    wdApp.config = {

    };

    // f7应用
    wdApp.f7App = new Framework7({
        init: false,
        modalTitle: "提示",
        modalButtonOk: '确定',
        modalButtonCancel: '取消',
        smartSelectBackOnSelect: true,
        cache: false,
        pushState: true,
        preloadPreviousPage: false,
        onAjaxStart: function (xhr) {
            wdApp.f7App.showIndicator();
        },
        onAjaxComplete: function (xhr) {
            wdApp.f7App.showIndicator();
        }
    });
    wdApp.$$ = Framework7.$;
    wdApp.mv = wdApp.f7App.addView('.view-main', {
        dynamicNavbar: true
    });
    // alert
    wdApp.alert = function (msg, callback) {
        wdApp.f7App.alert(msg, callback);
    };

    return wdApp;
});