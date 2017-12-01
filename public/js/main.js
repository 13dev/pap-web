var flash = {
    icon: 'fa-exclamation-triangle',
    fadeout: true,
    navclass: 'info',
    init: function (elem, message, navclass, fadeout, gotop) {

        if(typeof gotop === 'undefined') gotop = true;

        this.setFadeOut(fadeout);
        this.setNavclass(navclass);
        this.setMessage(message);
<<<<<<< HEAD

        elem.empty();
        elem.hide();
=======
        elem.empty().hide();
>>>>>>> 9fd7326416aa1322b963b84bcd0e596c9277a73a
        elem.append("<div id=\"inner-message\" class=\"alert alert-" + this.navclass + "\">\n" +
            "            <div class=\"container\">\n" +
            "                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>\n" +
            "                <i class=\"fa " + this.icon + "\" aria-hidden=\"true\">&nbsp;&nbsp;</i>\n" +
            "                <strong>" + this.message + "</strong>\n" +
            "            </div>\n" +
            "        </div>");

        elem.delay(300).fadeIn(200);

        if(document.getElementById("nav-message") !== null && this.fadeout)
        {
<<<<<<< HEAD
            elem.delay(3500).fadeOut("slow");
=======
            $("#nav-message").delay(3500).fadeOut("slow");
>>>>>>> 9fd7326416aa1322b963b84bcd0e596c9277a73a
        }

        if(gotop) goTop();
    },
    setFadeOut: function(value) {
        this.fadeout = value;
<<<<<<< HEAD
    },
    setMessage: function(value) {
        this.message = value;
=======
        return this;
    },
    setMessage: function(value) {
        this.message = value;
        return this;
>>>>>>> 9fd7326416aa1322b963b84bcd0e596c9277a73a
    },
    setNavclass: function(value) {

        if(this.navclass == "danger"){
            this.icon = "fa-exclamation-triangle";
        }else if(this.navclass == "success"){
            this.icon = "fa-check-circle";
        }else if(this.navclass == "info"){
            this.icon = "fa-exclamation";
        }else {
            this.icon = "fa-exclamation-triangle";
        }
        this.navclass = value;
<<<<<<< HEAD

=======
        return this;
>>>>>>> 9fd7326416aa1322b963b84bcd0e596c9277a73a
    }
};


var redirect = function(url) {
    window.location.href = url;
};

var goTop = function() {
    redirect("#");
}

/*(function($){

})($); */



