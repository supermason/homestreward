/**
 * Created by mac on 16/1/3.
 */
define(['app', 'lang', 'util'], function(app, lang, util) {

    var f7App = app.f7App,
        $ = app.$$,
        inventoryView = {
            init: function() {
                f7App.onPageInit("inventory-page", function(page) {

                });
            },
            alert: function(data) {
                var type = data.type;
                if (data.success) {
                    app.alert(lang.inventory.success);
                } else {
                    app.alert(lang.getErrByTag('inventory', type == 1 ? "in" : "out", data.msgTag));
                }
            },
            error: function(response) {
                app.handleError(response);
            }
        };


    return inventoryView;

});