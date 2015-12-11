
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

            passwordChanged: function(data) {
                // 必须先关闭界面，因为picker也属于modal的一种
                app.closePickerModal();
                if (data.success) {
                    this.alert(lang.user.changePassword.ok);
                } else {
                    this.alert(lang.getErrByTag('user', 'changePassword', data.msgTag), function() {
                        app.openPickerModal('.picker-modal.change-password-picker');
                    });
                }
            },

            updateFace: function(data) {
                // 关闭界面
                app.closePickerModal();

                $("div[id='view-temp'] .avatar-container .avatar>img").attr('src', data.newFace);
                $("div.user-panel .avatar>img").attr('src', data.newFace);
            },

            alert: function(msg, callback) {
                app.alert(msg, callback);
            }
        };

    return userView;

});