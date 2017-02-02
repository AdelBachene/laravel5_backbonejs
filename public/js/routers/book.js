define(['jquery', 'backbone'], function($, Backbone) {
    var Router = Backbone.Router.extend({
        routes: {
            "book":           "showContent",
            "book/*anything": "showContent"
        },
        showContent: function() {
            this._loadAjaxContent(function() {
                $('#page-content .action-delete').submit(function () {
                    return confirm('Are you sure you want to delete this book ?');
                });
            });
        },
        _loadAjaxContent: function(callback) {
            $.ajax({
                method: "GET",
                url: Backbone.history.root + Backbone.history.fragment,
                success: function(msg) {
                    document.querySelector('#page-content').innerHTML = msg;
                    if(typeof callback == 'function') {
                        callback();
                    }
                }
            });
        }
    });
    return new Router();
});