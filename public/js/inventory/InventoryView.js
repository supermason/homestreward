/**
 * Created by mac on 16/1/3.
 */
define(['app', 'lang', 'util'], function(app, lang, util) {

    var f7App = app.f7App,
        $ = app.$$,
        service = {},
        pad = {
            view: null,
            render: null
        },
        inventoryView = {
            addService: function(key, func) {
                service[key] = func;
                return this;
            },
            init: function() {
                f7App.onPageInit("inventory-page", function(page) {
                    pad.view = f7App.autocomplete({
                        input: '#product-autocomplete-dropdown',
                        openIn: 'dropdown',
                        preloader: true, //enable preloader
                        valueProperty: 'id', //object's "value" property name
                        textProperty: 'name', //object's "text" property name
                        limit: 10, //limit to 20 results
                        dropdownPlaceholderText: '试着输入名称中的关键字即可',
                        expandInput: true, // expand input
                        source: function (autocomplete, query, render) {
                            var results = [];
                            if (query.length === 0) {
                                render(results);
                                return;
                            }
                            // Show Preloader
                            autocomplete.showPreloader();
                            // keep a reference to the render function
                            pad.render = render;
                            // Do Ajax request to Autocomplete data
                            service.searchPName(query);
                        }
                    });
                });
            },
            renderACP: function(response) {
                pad.view.hidePreloader();
                pad.render(response.data.data);
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