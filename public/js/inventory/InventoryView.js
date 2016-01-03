/**
 * Created by mac on 16/1/3.
 */
define(['app', 'lang', 'util'], function(app, lang, util) {

    var f7App = app.f7App,
        $ = app.$$,
        inventoryView = {
            init: function() {
                f7App.onPageInit("inventory-page", function(page) {
                    // Fruits data demo array
                    var fruits = ('Apple Apricot Avocado Banana Melon Orange Peach Pear Pineapple').split(' ');

                    // Simple Dropdown
                    var autocompleteDropdownSimple = f7App.autocomplete({
                        input: '#product-autocomplete-dropdown',
                        openIn: 'dropdown',
                        source: function (autocomplete, query, render) {
                            var results = [];
                            if (query.length === 0) {
                                render(results);
                                return;
                            }
                            // Find matched items
                            for (var i = 0; i < fruits.length; i++) {
                                if (fruits[i].toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(fruits[i]);
                            }
                            // Render items by passing array with result items
                            render(results);
                        }
                    });
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