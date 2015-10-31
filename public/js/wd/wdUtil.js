/**
 * Created by mac on 15/10/31.
 */

/**
 * 定一个工具模块
 */
define([], function() {

    var util = {};

    /**
     * 判断是否为方法
     * @param fun {function} 待判断的方法
     * @returns {boolean} 为方法－true｜否则－false
     */
    util.isFunction = function (fun) {
        if (fun && typeof(fun) === 'function') {
            return true;
        } else {
            return false;
        }
    }

    return util;
});