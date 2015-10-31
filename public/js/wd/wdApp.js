?/**
 * Created by mason.ding on 2015/10/30.
 * ����wdApp ����
 * wdApp������f7-Framework7�Ķ���
 *           $$-Framework7��ѡ��������
 *           mv-Framework7������ͼ
 */
define(['framework7'], function () {
    'use strict';

    var wdApp = {};

    // ����
    wdApp.name = "wdApp";

    // ����
    wdApp.config = {

    };

    // f7Ӧ��
    wdApp.f7App = new Framework7({
        init: false,
        modalTitle: "��ʾ",
        modalButtonOk: 'ȷ��',
        modalButtonCancel: 'ȡ��',
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