/**
 * Created by mac on 16/7/16.
 */

define(['ngmodule', 'contacts/ContactView'], function (ngmodule, view) {
    'use strict';

    view.init();

    var ContactsController = function ($scope, ContactService) {

        view.addService("search", function (keywords) {
            if (!keywords || keywords === "") return;
            // 搜索
            ContactService.search(keywords).then(function (response) {
                view.renderView(response);
            }, function (response) {
                view.error(response);
            });
        }).addService("update", function (searchResult) {
            // 更scope数据,自动刷新页面
            $scope.contact.searchResult.setData(searchResult);
            if (searchResult.id > 0) {
                // 更新查找频率
                ContactService.update({id: searchResult.id}).then(function (response) {
                    // 不作处理
                }, function (response) {
                    // 不作处理
                });
            }
        });

        $scope.contact = {
            // 新增客户
            data: {
                name: "",
                phone: "",
                address: "",
                reset: function () {
                    this.name = "";
                    this.phone = "";
                    this.address = "";
                }
            },
            // 查询最终确定的客户
            searchResult: {
                name: "",
                phone: "",
                address: "",
                setData: function (data) {
                    this.name = data.name;
                    this.phone = data.phone;
                    this.address = data.address;
                }
            },
            addNew: function () {
                // 新增客户信息
                ContactService.add($scope.contact.data).then(function (response) {
                    view.addOk();
                    $scope.contact.data.reset();
                }, function (response) {
                    view.error(response);
                });
            }
        };
    };

    ngmodule.controllers
        .controller("ContactsController", ['$scope', 'ContactService', ContactsController]);

    return ContactsController;
});