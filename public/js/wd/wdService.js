/**
 * Created by mac on 15/11/1.
 */

define(['app', 'util'], function(app, util) {

    // 该模块的api地址
    var wdApiRoot = createSubServiceApiRoot();
    // 该模块的服务对象
    var service = {
        apiRoot: wdApiRoot
    };

    /**
     * 调用api接口获取数据
     * @param param {Object} 传入的参数
     */
    service.call = function(param) {
        app.$$.ajax({
            method: param.method ? param.method : "GET",
            url: wdApiRoot,
            beforeSend: function (xhr) {
                if (util.isFunction(param.beforeSend)) {
                    param.beforeSend.call(null, xhr);
                }
            },
            error: function (xhr) {
                if (util.isFunction(param.error)) {
                    param.error.call(null, xhr);
                }
            },
            success: function (data) {
                if (util.isFunction(param.success)) {
                    param.success.call(null, data);
                }
            }
        });
    };

    function createSubServiceApiRoot() {
        return app.config.apiRoot + "wd/";
    }

    return service;
});