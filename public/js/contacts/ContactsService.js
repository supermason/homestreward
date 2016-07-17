/**
 * Created by mac on 16/7/16.
 */
define(['ngmodule', 'app'], function(ngmodule, app) {

    'use strict';

    var baseAPI = app.config.apiRoot + 'contact';

    ngmodule.services.factory("ContactService", ["$http", function($http) {

        return {
            /**
             * 搜索
             */
            search: function (keywords) {
                return $http.get(baseAPI + "?keywords=" + keywords);
            },
            /**
             * 添加
             */
            add: function (contact) {
                return $http({
                    method: 'POST',
                    url: baseAPI,
                    data: contact
                });
            },
            /**
             * 更新
             */
            update: function (contact) {
                return $http({
                    method: 'PUT',
                    url: baseAPI + "/" + contact.id,
                    data: contact
                });
            }
        };
    }]);
});