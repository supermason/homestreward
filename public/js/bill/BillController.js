/**
 * bill专属控制器
 */
define(['ngmodule', 'bill/BillView'], function (ngmodule, view) {
    'use strict';

    var billCtrl = {
            searchController: function ($scope, BillService) {
                
                $scope.data = {
                    bills: []
                };

                //what's in response
                //data – {string|Object} – The response body transformed with the transform functions.
                //status – {number} – HTTP status code of the response.
                //headers – {function([headerName])} – Header getter function.
                //config – {Object} – The configuration object that was used to generate the request.
                //statusText – {string} – HTTP status text of the response.
                view.init($scope)
                    .addService("getBill",  function () {
                        BillService.get(view.curPage+1, view.date)
                            .then(view.update, view.error);
                    })
                    .addService("getTotalExpense", function(){
                        BillService.getTotalExpense()
                            .then(function(response){
                                view.alert("本月消费总额：" + response.data.total);
                            }, function(response){

                            });
                    })
                    .query();
            },

            addController: function ($scope, BillService, BillCTService) {
                $scope.newData = {
                    bill: {
                        amount: "",
                        categoryId: 0,
                        remark: "",
                        consumptionDate: "",
                        reset: function() {
                            this.amount = "";
                            this.categoryId = 0;
                            this.remark = "";
                            this.consumptionDate = "";
                        },
                        updateData: function(data) {
                            //this.categoryId = data.category.id;
                            //alert("In Scope: " + this.categoryId);
                            this.categoryId = data.category.id;
                        }
                    },
                    categories: [],
                    addBill: function() {
                        if ($scope.newData.bill.amount === "" || parseFloat($scope.newData.bill.amount) == 0) {
                            view.alert("请输入消费金额！");
                        }else if ($scope.newData.bill.categoryId == 0) {
                            view.alert("请选择消费类型！");
                        } else {
                            //alert($scope.newData.bill.categoryId);
                            //return;
                            BillService.add($scope.newData.bill).then(function(response){
                                view.alert("记录添加成功！", function() {
                                    $scope.newData.bill.reset();
                                    view.reset();
                                    view.query();
                                });
                            }, function(response){
                                view.alert(response.data);
                            });
                        }
                    }

                };

                function getCT() {
                    BillCTService.get().then(
                        function(response){
                            $scope.newData.categories = response.data.cc;
                        }, function(response) {

                        });
                }

                view.addService("addCT", function(value) {
                    if (value && value !== "") {
                        BillCTService.add({name: value}).then(function(response) {
                            view.alert("新消费类型添加成功！");
                            getCT();
                        }, function(response) {
                            view.alert(response.data);
                        });
                    } else {
                        view.alert("请填写新的消费类型！");
                    }
                });

                getCT();
            }
        };


    ngmodule.controllers
        .controller("SearchController", ['$scope', 'BillService', billCtrl.searchController])
        .controller("AddController", ['$scope', 'BillService', 'BillCTService', billCtrl.addController]);

    return billCtrl;

});