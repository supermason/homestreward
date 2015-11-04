/**
 * Created by mason.ding on 2015/10/30.
 */
require(['app', 'util', 'service'], function(wdApp, util, serivce){

    var $$ = wdApp.$$,
        loading = false;

    wdApp.f7App.onPageInit("home-page", function(page){

        // slider自动滚动
        var swiper = wdApp.f7App.swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            loop: true,
            paginationHide: false,
            paginationClickable: true
        });

        util.timer.start(function(){
            swiper.slideNext();
        }, 4000);
        // 无限滚动初始化

    });

    wdApp.init({
        hasInit:false,
        hasMainView: true
    });
});