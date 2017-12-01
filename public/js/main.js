var flash = {
    icon: 'fa-exclamation-triangle',
    fadeout: true,
    navclass: 'info',
    init: function (elem, message, navclass, fadeout, gotop) {

        if(typeof gotop === 'undefined') gotop = true;

        this.setFadeOut(fadeout);
        this.setNavclass(navclass);
        this.setMessage(message);
        elem.empty();
        elem.hide();
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

            $("#nav-message").delay(3500).fadeOut("slow");
        }

        if(gotop) goTop();
    },
    setFadeOut: function(value) {
        this.fadeout = value;
    },
    setMessage: function(value) {
        this.message = value;
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



