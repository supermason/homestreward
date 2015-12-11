/**
 * Created by mac on 15/9/12.
 */

define(['ngmodule', 'user/UserView'], function(ngmodule, view, lang) {
    'use strict';

    var userCtrl = {
        infoController: function($scope, UserService) {

            view.init($scope)
                .addService("changeNickname", function(newName) {
                    UserService.changeNickname({name: newName})
                        .then(function(response){
                            view.updateNickname(response.data);
                        },function(response){

                        });
                }
            );
        },

        changePasswordController: function($scope, UserService) {
            $scope.password = {
                email: '',
                new_password: '',
                new_password_confirmation: '',

                reset: function() {
                    this.email = "";
                    this.new_password = "";
                    this.new_password_confirmation = "";
                },

                changePassword: function() {

                    UserService.changePassword($scope.password).then(function(response) {
                        $scope.password.reset();
                        view.passwordChanged(response.data);
                    }, function(response) {
                        view.passwordChanged(response.data);
                    });
                }
            };
        },

        changeFaceController: function($scope, UserService) {
            $scope.face = {
                new_face: null,

                reset: function() {
                    this.new_face = null;
                },

                changeFace: function() {
                    UserService.changeFace($scope.face).then(function(response) {

                    }, function(response) {
                        view.alert(response.data);
                    });
                }
            }
        }

    };

    ngmodule.controllers
        .controller("UserController", ['$scope', 'UserService', userCtrl.infoController])
        .controller("UserChangePasswordController", ['$scope', 'UserService', userCtrl.changePasswordController])
        .controller("UserChangeFaceController", ['$scope', 'UserService', userCtrl.changeFaceController]);

    return userCtrl;
});