
define(['app', 'lang'], function (app, lang) {
    'use strict';

    var f7App = app.f7App,
        $ = app.$$,
        userView = {
            $scope: null,
            service: {},
            addService: function(key, func) {
                this.service[key] = func;
                return this;
            },
            init: function($scope) {
                this.$scope = $scope;

                f7App.onPageInit("personal-page", function(page) {
                    var pageCon = $(page.container);
                    pageCon.find("a.icon-only.prompt-title-ok-cancel").click(function(){
                        f7App.prompt(lang.user.changeNickname.info, lang.user.changeNickname.title,
                            function (value) {
                                if (value.trim() === '') {
                                    app.alert(lang.user.changeNickname.emptyError);
                                } else {
                                    userView.service.changeNickname(value);
                                }
                            },
                            function (value) {

                            }
                        );
                    });
                    // 从页面获取昵称，反向绑定$scope.user.name

                });

                return this;
            },

            updateNickname: function(data) {
                $("span[id='user-info']").html(data.newName);
                $("p[id='userName']").text(data.newName);
            },

            alert: function(msg, callback) {
                app.alert(msg, callback);
            }
        };

    return userView;

});