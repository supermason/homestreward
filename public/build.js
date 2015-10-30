/**
 * Created by mac on 15/9/21.
 */
({
    appDir: "./",
    baseUrl: "./js/lib",
    dir: "./build",
    fileExclusionRegExp: /^(r|build)\.js$/,
    optimizeCss: 'standard',
    //paths: {
    //    bill: '../bill',
    //    user: '../user',
    //    app: '../app',
    //    ngmodule: '../ngmodule',
    //    bootstrap: '../bootstrap'
    //},
    shim:{
        'angular': {
            exports: 'angular'
        }
    }
})