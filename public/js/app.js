/**
 * 创建myApp 对象
 * myApp包含：f7-Framework7的对象
 *           $$-Framework7的选择器变体
 *           mv-Framework7的主视图
 */
define(['framework7'], function () {
    'use strict';

    var myApp = {};

    // 名称
    myApp.name = "myApp";

    // 配置
    myApp.config = {
        apiRoot: 'http://192.168.1.108:8080/'
    };

    // f7应用
    myApp.f7App = new Framework7({
        init: false,
        modalTitle: "提示",
        modalButtonOk: '确定',
        modalButtonCancel: '取消',
        //smartSelectBackOnSelect: true,
        cache: false,
        pushState: true,
        preloadPreviousPage: false
        //onAjaxStart: function (xhr) {
        //    myApp.f7App.showIndicator();
        //},
        //onAjaxComplete: function (xhr) {
        //    myApp.f7App.showIndicator();
        //}
    });
    myApp.$$ = Framework7.$;
    //myApp.mv = myApp.f7App.addView('.view-main', {
    //    dynamicNavbar: true
    //});
    // alert
    myApp.alert = function (msg, callback) {
        myApp.f7App.alert(msg, callback);
    };
    // toString
    myApp.toString = function () {
        return "app-version: 1.0.0.0"
                + "\nangular-version: " + angular.version.full
                + "\nframework7-version: " + myApp.f7App.version
    };

    return myApp;
});



    

