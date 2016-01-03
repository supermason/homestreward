/**
 * Created by mac on 16/1/3.
 */
define(['ngmodule', 'app'], function(ngmodule, app) {

    'use strict';

    var baseApi = app.config.apiRoot + "wd/admin/products/",
        inApi = baseApi + "in",
        outApi = baseApi + "out";

    ngmodule.services.factory("InventoryService", ["$http", function($http) {

        return {
            search: function(keywords){

                return $http({
                    method: "PUT",
                    url: baseApi + inApi,
                    dataType: 'json',
                    //headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    data: {

                    }
                });
            },
            inventoryIn: function(product) {
                return $http({
                    method: "PUT",
                    url: baseApi + inApi,
                    dataType: 'json',
                    data: product
                });
            },
            inventoryOut: function(product) {
                return $http({
                    method: "PUT",
                    url: baseApi + outApi,
                    dataType: 'json',
                    data: product
                });
            }
        };

    }]);

});