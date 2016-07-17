/**
 * Created by mac on 16/7/16.
 */

define(['app', 'lang', 'util'], function(app, lang, util) {

    var f7App = app.f7App,
        $ = app.$$,
        service = {},
        autoCompleteObj = {
            view: null,
            render: null
        },
        contactView = {
            addService: function (key, func) {
                service[key] = func;
                return this;
            },
            init: function () {
                f7App.onPageInit("contacts-page", function(page) {
                    autoCompleteObj.view = f7App.autocomplete({
                        input: '#contacts-autocomplete-dropdown',
                        openIn: 'dropdown',
                        preloader: true, //enable preloader
                        valueProperty: 'id', //object's "value" property name
                        textProperty: 'name', //object's "text" property name
                        limit: 10, //limit to 20 results
                        dropdownPlaceholderText: '请输入名称或地址中的关键字',
                        expandInput: true, // expand input
                        source: function (autocomplete, query, render) {
                            var results = [];
                            if (query.trim().length === 0 || (query = util.stripScript(query)) === "") {
                                render(results);
                                // 如果关键字为空了
                                updateFormData({id: 0, name: "", address: ""});
                                return;
                            }
                            // Show Preloader
                            autocomplete.showPreloader();
                            // keep a reference to the render function
                            autoCompleteObj.render = render;
                            // Do Ajax request to Autocomplete data
                            service.search(query);
                        },
                        onChange: function (a, clickedItem) {
                            updateFormData(clickedItem);
                        }
                    });
                });
            },
            renderView: function(response) {
                autoCompleteObj.view.hidePreloader();
                autoCompleteObj.render(response.data.contacts);
            },
            ok: function (data) {
                this.alert(data, function() {
                    // 清除input中的数据
                    $('#contacts-autocomplete-dropdown').val("");
                });
            },
            addOk: function () {
              app.alert(lang.contacts.addOK);
            },
            error: function(response) {
                app.handleError(response);
            }

        };

    /**
     * 根据autocomplete的选择,更新表单数据
     *
     * @param selectedItem
     */
    function updateFormData(selectedItem) {
        service.update(selectedItem);
    }

    return contactView;

});