/**
 * Created by mason.ding on 2015/10/30.
 * ����wdApp ����
 * wdApp������f7-Framework7�Ķ���
 *           $$-Framework7��ѡ��������
 *           mv-Framework7������ͼ
 */
define(['framework7', 'wdUtil'], function (wdUtil) {
    'use strict';

    var wdApp = {};

    // 应用名称
    wdApp.name = "wdApp";

    // 配置
    wdApp.config = {

    };

    // 创建f7对象
    wdApp.f7App = new Framework7({
        init: false,
        modalTitle: "牛妞提示ʾ",
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

    /**
     * 初始化应用
     */
    wdApp.init = function() {
        wdApp.$$.ajaxSetup({"dataType": "json"});
        wdApp.f7App.init();
    };

    /**
     * 调用api接口获取数据
     * @param api {String} api接口地址
     * @param param {Object} 传入的参数
     */
    wdApp.call = function(api, param) {
        wdApp.$$.ajax({
            method: param.method ? param.method : "GET",
            url: api,
            beforeSend: function (xhr) {
                if (wdUtil.isFunction(param.beforeSend)) {
                    param.beforeSend.call(null, xhr);
                }
            },
            error: function (xhr) {
                if (wdUtil.isFunction(param.error)) {
                    param.error.call(null, xhr);
                }
            },
            success: function (data) {
                if (wdUtil.isFunction(param.success)) {
                    param.success.call(null, data);
                }
            }
        });
    };

    return wdApp;
});