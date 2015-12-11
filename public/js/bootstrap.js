/**
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
        // 配置一下$http拦截器，实现自动调用f7 ajax提示的功能
        app.angularApp.factory('wdInterceptor', ['$q', function($q) {
            return {
                'request': function(config) {
                    app.showPreloader();
                    return config;
                },

                'requestError': function(rejection) {
                    return $q.reject(rejection);
                },

                'response': function(response) {
                    app.hidePreloader();

                    return response;
                },

                'responseError': function(rejection) {
                    return $q.reject(rejection);
                }
            };
        }]).config(['$httpProvider'], function($httpProvider) {
            $httpProvider.interceptors.push('wdInterceptor');
        });
        // 最后初始化f7App
        app.init({
            hasInit:false,
            hasMainView: false
        });
    });
});