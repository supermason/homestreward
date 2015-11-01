/**
 * Created by mac on 15/10/31.
 */

/**
 * 定一个工具模块
 */
define([], function() {

    /*
     * 对字符串加入各种trim
     */
    (function(){

        String.prototype.trim = function () {
            return this.replace(/(^\s*)|(\s*$)/g, "");
        };

        String.prototype.ltrim = function () {
            return this.replace(/(^\s*)/g, "");
        };

        String.prototype.rtrim = function () {
            return this.replace(/(\s*$)/g, "");
        };

        /*
         * 对字符串加入startWith和endWith方法
         */
        String.prototype.startWith = function (str) {
            var reg = new RegExp("^" + str);
            return reg.test(this);
        };

        String.prototype.endWith = function (str) {
            var reg = new RegExp(str + "$");
            return reg.test(this);
        };
    })();

    //==========================================
    // 创建工具对象
    //==========================================
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