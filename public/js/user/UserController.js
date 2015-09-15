/**
 * Created by mac on 15/9/12.
 */

define(['ngmodule', 'user/UserView'], function(ngmodule, view) {

    var userCtrl = {
        infoController: function($scope, UserService) {
            $scope.user = {
                pre_password: '',
                new_password: '',
                reset: function() {
                    this.pre_password = "";
                    this.new_password = "";
                },
            };

            view.init($scope)
                .addService("changeNickname", function(newName) {
                    UserService.changeNickname({name: newName})
                        .then(function(response){
                            view.updateNickname(response.data);
                        },function(response){

                        });
                }
            );
        }

    };

    ngmodule.controllers
        .controller("UserController", ['$scope', 'UserService', userCtrl.infoController]);

    return userCtrl;
});