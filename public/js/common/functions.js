jQuery.fn.extend({
    toggleText: function(a, b) {
        var that = this;
        if (that.text() != a && that.text() != b) {
            that.text(a);
        }
        else if (that.text() == a) {
            that.text(b);
        }
        else if (that.text() == b) {
            that.text(a);
        }
        return this;
    },
    toggleHtml: function(a, b) {
        var that = this;
        if (that.html() != a && that.html() != b) {
            that.html(a);
        }
        else if (that.html() == a) {
            that.html(b);
        }
        else if (that.html() == b) {
            that.html(a);
        }
        return this;
    }
});