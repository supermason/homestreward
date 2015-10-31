
/**
 * requirejs 专属配置文件
 */
requirejs.config({
    baseUrl: '../js/lib',
    paths: {
        wdApp: '../wd'
    },
    deps: ['../wd/wd'],
    urlArgs: "bust=" + (new Date()).getTime()  //防止读取缓存，调试用
});