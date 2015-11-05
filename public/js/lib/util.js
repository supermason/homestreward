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
     *
     * @param fun {function} 待判断的方法
     * @returns {boolean} 为方法－true｜否则－false
     */
    util.isFunction = function (fun) {
        if (fun && typeof(fun) === 'function') {
            return true;
        } else {
            return false;
        }
    };

    /**
     * 判断一个对象是否为数组
     *
     * @param {object} v
     * @returns {boolean}
     */
    util.isArray = function (v) {
        return toString.apply(v) === '[object Array]';
    }

    /**
     * 判断一个对象是否为字符串
     *
     * @param {object} v
     * @returns {boolean}
     */
    util.isString = function (v) {
        return toString.apply(v) === '[object String]';
    }

    /**
     * 判断一个对象里是否包含URL节点
     *
     * @param {object} obj
     * @returns {boolean}
     */
    util.hasURL = function(obj) {
        if (!obj) return false;
        if (this.isArray(obj)) return false;

        if (this.isString(obj) && obj !== '') {
            return true;
        } else {
            for (var k in obj) {
                if (k.toLocaleLowerCase() === 'url') {
                    if (this.isString(obj[k]) && obj[k] !== '') {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    // 计时器
    var intervalId = 0;
    /**
     * 计时器对象
     * @type {{start: Function, stop: Function}}
     */
    util.timer = {
        /**
         * 开启计时器
         * @param {int} delay
         * @param {function} callback
         */
          start: function(callback, delay) {
              this.stop();

              if (util.isFunction(callback)) {
                  intervalId = setInterval(callback, delay);
              } else {
                  console.log('回调方法类型错误！');
              }

          },
        /**
         * 计时器结束
         */
          stop: function() {
            if (intervalId != 0) {
                clearInterval(intervalId);
            }
          }
    };

    return util;
});