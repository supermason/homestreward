/* 
 * 对JS原型方法的扩展
 */

/* 
 * 对字符串加入各种trim
 */
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