
define(["ngmodule", "app"], function (ngmodule, app) {
    'use strict';

    var baseApi = app.config.apiRoot + "user";

    ngmodule.services.factory("UserService", ["$http", function ($http) {

        var baseAPI = app.config.apiRoot + 'user/';

        return {
            get: function () {
                return $http.get(baseApi);
            },
            changeNickname: function(user) {
                return $http({
                    method: 'PUT',
                    url: baseAPI + "edit/",
                    dataType: 'json',
                    //headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    data: user
                });
            }
        };
    }]);
})