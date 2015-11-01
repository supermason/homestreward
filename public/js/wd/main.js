
/**
 * requirejs 专属配置文件
 */
requirejs.config({
    baseUrl: '/js/lib',
    paths: {
        app: '../app',
        service: '../wd/wdService'
    },
    deps: ['../wd/wdView'],
    urlArgs: "bust=" + (new Date()).getTime()  //防止读取缓存，调试用
});