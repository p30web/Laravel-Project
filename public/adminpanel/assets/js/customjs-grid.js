! function(document, window, $) {
    "use strict";
    var Site = window.Site;
    $(document).ready(function($) {

    }), jsGrid.setDefaults({
        tableClass: "jsgrid-table table table-striped table-hover"
    }), jsGrid.setDefaults("text", {
        _createTextBox: function() {
            return $("<input>").attr("type", "text").attr("class", "form-control input-sm")
        }
    }), jsGrid.setDefaults("number", {
        _createTextBox: function() {
            return $("<input>").attr("type", "number").attr("class", "form-control input-sm")
        }
    }), jsGrid.setDefaults("textarea", {
        _createTextBox: function() {
            return $("<input>").attr("type", "textarea").attr("class", "form-control")
        }
    }), jsGrid.setDefaults("control", {
        _createGridButton: function(cls, tooltip, clickHandler) {
            var grid = this._grid;
            return $("<button>").addClass(this.buttonClass).addClass(cls).attr({
                type: "button",
                title: tooltip
            }).on("click", function(e) {
                clickHandler(grid, e)
            })
        }
    }), jsGrid.setDefaults("select", {
        _createSelect: function() {
            var $result = $("<select>").attr("class", "form-control input-sm"),
                valueField = this.valueField,
                textField = this.textField,
                selectedIndex = this.selectedIndex;
            return $.each(this.items, function(index, item) {
                var value = valueField ? item[valueField] : index,
                    text = textField ? item[textField] : item,
                    $option = $("<option>").attr("value", value).text(text).appendTo($result);
                $option.prop("selected", selectedIndex === index)
            }), $result
        }
    }),


        function() {
            $("#st2aticgrid").jsGrid({
                height: "500px",
                width: "100%",
                sorting: !0,
                paging: !0,
                data: db.clients,
                fields: [{
                    name: "Name",
                    title: "نام",
                    type: "text",
                    width: 150
                }, {
                    name: "Age",
                    title: "سن",
                    type: "number",
                    width: 70
                }, {
                    name: "Address",
                    title: "آدرس",
                    type: "text",
                    width: 200
                }, {
                    name: "Country",
                    type: "select",
                    items: db.countries,
                    valueField: "Id",
                    title: "کشور",
                    textField: "Name"
                }, {
                    name: "Married",
                    type: "checkbox",
                    title: "مجرد یا متاهل"
                }]
            })
        }(),

    function() {
        $("#staticgrid").jsGrid({
            height: "300px",
            width: "100%",
            autoload: !0,
            selecting: !1,
            data: db.expertpanel,
            fields: [{
                name: "Name",
                title: "نام",
                type: "text",
                width: 150
            }, {
                name: "Age",
                title: "سن",
                type: "number",
                width: 50
            }, {
                name: "Address",
                type: "text",
                title: "آدرس",
                width: 200
            }, {
                name: "Country",
                type: "select",
                items: db.countries,
                valueField: "Id",
                title: "کشور",
                textField: "Name"
            }, {
                name: "Married",
                type: "checkbox",
                title: "مجرد یا متاهل"
            }]
        }), $("#sortingField").on("change", function() {
            var field = $(this).val();
            $("#exampleSorting").jsGrid("sort", field)
        })
    }()

}(document, window, jQuery);