/**
 * 语言定义文件
 *
 * Created by mason.ding on 2015/11/5.
 */

define([], function(){

    var lang = {
        /**
         * app定义相关文字
         */
        app: {
            modalTitle: "提示",
            modalButtonOk: '确定',
            modalButtonCancel: '取消',
            preloaderTip: "宝贝努力加载中...",
            calendar: {
                monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                dayNames: ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
                dayNamesShort: ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六']
            }
        },
        /**
         * 产品相关文字
         */
        product: {
            priceTitle: "售价：",
            view: "查看宝贝",
            notFound: "抱歉，暂时没有您要找的宝贝T_T，请看点别的吧~",
            hasNoMore: "没有更多宝贝了"
        },
        /**
         * 用户相关文字
         */
        user: {
            changeNickname: {
                title: '修改昵称',
                info: '你想叫什么好呢？',
                emptyError: '请输入新的昵称'
            }
        }
    };

    return lang;
});