/**
 * 页面中使用的各种模板
 *
 * Created by mason.ding on 2015/11/4.
 */

define([], function() {

    var wdTemplate = {

        /**
         * 无查询结果模板
         */
        notFound: "",
        /**
         * 产品列表模板
         */
        productList:
            "{{#each data}}<li  class=\"card wd-card-header-pic\">"
            + "<div style=\"background-image: url('/img/wd/product/{{category_id}}/{{thumbnail}}')\" valign=\"bottom\" class=\"card-header color-white no-border\"><span>{{name}}</span></div>"
            + "<div class=\"card-content\">"
            +   "<div class=\"card-content-inner\">"
            +      "<p class=\"color-gray\">{{subtitle}}</p>"
            +      "<p>{{description}}</p>"
            +   "</div>"
            +   "</div>"
            +   "<div class=\"card-footer\">"
            +      "<a href=\"#\" class=\"link\"></a>"
            +      "<a href=\"#\" class=\"link\">查看宝贝</a>"
            +   "</div>"
          + "</li>{{/each}}"
    };

    return wdTemplate;
});
