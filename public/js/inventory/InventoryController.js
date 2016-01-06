/**
 * Created by mac on 16/1/3.
 */

define(['ngmodule', 'inventory/InventoryView'], function(ngmodule, view){

    'use strict';

    view.init();

    var inventoryCtrl = {

        inventoryController: function($scope, InventoryService) {

            view.addService('searchPName', function(keywords) {
                if (keywords === "") return;

                InventoryService.search(keywords)
                    .then(function(response) {
                        view.renderACP(response);
                    }, function(response) {
                        view.error(response);
                    });
            }).addService('updatePID', function(selectedPID) {
                $scope.product.data.p_id = selectedPID;
            });

            $scope.product = {
                data: createScopeData(),
                purchase: function() {
                    InventoryService.inventoryIn($scope.product.data).then(
                        function(response) { // success
                            $scope.product.data.reset();
                            view.ok(response.data);
                        },
                        function(response) { // error
                            view.error(response);
                        }
                    );
                },
                sell: function() {
                    InventoryService.inventoryOut($scope.product.data).then(
                        function(response) {
                            $scope.product.data.reset();
                            view.ok(response.data);
                        },
                        function(response) {
                            view.error(response);
                        }
                    );
                }
            };
        }
    };

    /**
     * 创建scope内使用的数据模型对象
     *
     * @return Object
     */
    function createScopeData() {
        var modle = {
            p_id: "",
            p_count: "",
            p_price: "",
            disabled: function() {
                return this.p_count == 0 || this.p_id == 0 || this.p_price == 0 || this.p_count === "" || this.p_id === "" || this.p_price === "";
            },
            reset: function() {
                this.p_id = this.p_count = this.p_price = "";
            }
        };

        return modle;
    }

    ngmodule.controllers
        .controller("InventoryController", ['$scope', 'InventoryService', inventoryCtrl.inventoryController]);

    return inventoryCtrl;
});