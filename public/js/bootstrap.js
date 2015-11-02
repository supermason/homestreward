﻿/**
 * 初始化app
 */
require(['app', 'util'], function (app, util) {
    'use strict';

    require(['../services', '../controllers'], function () {
        // angular 应用
        app.angularApp = angular.module(app.name, [app.name + ".controllers", app.name + ".services"]/*, function($interpolateProvider){
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        }*/);
        // 手动初始化angular
        angular.bootstrap(document, [app.name]);
        // 最后初始化f7App
        app.init({
            hasInit:false,
            hasMainView: false
        });
    });
});