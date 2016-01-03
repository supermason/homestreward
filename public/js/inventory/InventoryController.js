/**
 * Created by mac on 16/1/3.
 */

define(['ngmodule', 'inventory/InventoryView'], function(ngmodule, view){

    'use strict';

    var inventoryCtrl = {
        inventoryInController: function($scope, InventoryService) {
            $scope.product = {
                p_id: 0,
                p_count: 0,
                p_price: 0,
                disabled: function() {
                    return this.p_count == 0 || this.p_id == 0 || this.p_price == 0;
                },
                reset: function() {
                    this.p_id = this.p_count = this.p_price = 0;
                },
                purchase: function() {
                    InventoryService.inventoryIn($scope.product).then(
                        function(response) { // success
                            $scope.reset();
                            view.alert(response.data);
                        },
                        function(response) { // error
                            view.error(response);
                        }
                    );
                }
            };
        },

        inventoryOutController: function($scope, InventoryService) {
            $scope.product = {
                p_id: 0,
                p_count: 0,
                p_price: 0,
                disabled: function() {
                    return this.p_count == 0 || this.p_id == 0 || this.p_price == 0;
                },
                reset: function() {
                    this.p_id = this.p_count = this.p_price = 0;
                },
                sell: function() {
                    InventoryService.inventoryOut($scope.product).then(
                        function(response) {
                            $scope.reset();
                            view.alert(response.data);
                        }, function(response) {
                            view.error(response);
                        }
                    );
                }
            };
        }
    };

    ngmodule.controllers
        .controller("InventoryInController", ['$scope', 'InventoryService', inventoryCtrl.inventoryInController])
        .controller("InventoryOutController", ['$scope', 'InventoryService', inventoryCtrl.inventoryOutController]);

    return inventoryCtrl;
});