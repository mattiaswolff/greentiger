var projectCopperfield = {
    org_slug : null,
    id: null,
    base_url : "http://www.zowgle.com", 
    static_base_url : "http://static.kundo.se", 
    lang: "sv", 
    image_align: "right", 
    image_top: "200px", 
    close_text : {
        sv: "St\u00E4ng", 
        en : "Close", 
        da: "Luk", 
        no: "Lukk"
    }, //test
    custom_image_url : null,
    embed_url : "/client/embed.php?userId=", 
    image_url : "/images/tycktill-1", 
    btn_close_url : "/static/images/projectCopperfield-close-", 
    user_name : null, 
    user_email : null, 
    old_browser : function(){
        var c = document.all&&/MSIE\s?6/.test(navigator.userAgent);
        var b = document.all&&/MSIE\s?7/.test(navigator.userAgent);
        var a = document.all&&/MSIE\s?8/.test(navigator.userAgent);
        var d = document.compatMode == "BackCompat";
        return c || ((b||a) && d)
    }, 
    get_fixed_style : function() {
        if (projectCopperfield.old_browser()) {
            return "position: absolute;"
        }
        return "position: fixed;"
    },
    get_or_create_div : function(c) {
        var b = document.getElementById(c);
        if (!b) {
            var a = document.getElementsByTagName("body")[0];
            var b = document.createElement("div"); 
            b.id = c; 
            a.appendChild(b)
        } 
        return b
    },
    toggle_box : function() {
        var a = document.getElementById("projectCopperfield_container"); 
        if (a) {
            projectCopperfield.delete_frame()
        } 
        else { 
            a = projectCopperfield.get_or_create_div("projectCopperfield_container"); 
            projectCopperfield.create_overlay(a); 
            projectCopperfield.create_frame(a)
        }
    }, 
    create_overlay: function(b) { 
        var a="top: 0; bottom:0; min-height:600px; left: 0; background: #000; opacity: 0.25; z-index: 1000; width: 100%;";
        a += projectCopperfield.get_fixed_style();
        if (projectCopperfield.old_browser()) { 
            var c = Math.max (document.body.clientHeight, document.documentElement.clientHeight); 
            a += "height:" + c + "px;"
        }
        b.innerHTML += '<div id="projectCopperfield_overlay" style="' + a + '"></div>'
    },
    create_button : function() { 
        var b = projectCopperfield.get_or_create_div ("projectCopperfield_button_container");
        var c = "top: " + projectCopperfield.image_top + "; " + projectCopperfield.image_align + ": 0; z-index: 99999; cursor: pointer; margin: 0; -webkit-box-shadow: 0px 0px 20px #000; -webkit-border-radius: 5px 0 0 5px; -moz-box-shadow: 0px 0px 20px #000; -moz-border-radius: 5px 0 0 5px; box-shadow: 0px 0px 20px #000; border-radius: 5px 0 0 5px;";
        c += projectCopperfield.get_fixed_style();
        var a = projectCopperfield.custom_image_url || projectCopperfield.static_base_url + projectCopperfield.image_url + "-" + projectCopperfield.lang + "-" + projectCopperfield.image_align + ".png"; 
        b.innerHTML += '<img src="' + a + '" alt="" id="projectCopperfield_feedback" style="' + c + '" onclick= "projectCopperfield.toggle_box()">'
        },
        
    create_frame : function(d) {
        var b = projectCopperfield.close_text[projectCopperfield.lang];
        var e = "cursor:pointer; height:26px; left:50%; margin-left:376px; top:9px; width:90px; z-index:100100;"; 
        e += projectCopperfield.get_fixed_style(); 
        d.innerHTML += '<div style="cursor: pointer;height: 30px;left: 50%;margin-left: -484px;top: 30px;width: 30px;z-index: 100100; position: fixed; background-image: url(' + "'http://a.unbounce.com/s/images/fancybox/fancybox.png'" + '); background-position: -40px 0px;" onclick="projectCopperfield.delete_frame()">'; 
        var c = projectCopperfield.base_url + projectCopperfield.embed_url + projectCopperfield.id + "&lang=" + projectCopperfield.lang; 
        if (projectCopperfield.user_name && projectCopperfield.user_email) { 
            c += "&name=" + projectCopperfield.user_name + "&useremail=" + projectCopperfield.user_email; 
            c = encodeURI();
        }
        //c = "http://www.zowgle.com/client/embed.php?userId=" + _projectCopperfield["id"];
        var a= "background: white; border: none; height: 540px; left: 50%; margin-left: -470px; position: fixed; top: 40px; width: 940px; z-index: 100000; -webkit-box-shadow: 0px 0px 40px #000; -webkit-border-radius: 10px; -moz-box-shadow: 0px 0px 40px #000; -moz-border-radius: 10px; box-shadow: 0px 0px 40px #000; border-radius: 10px;";
        a += projectCopperfield.get_fixed_style();
        d.innerHTML += '<iframe src="' + c + '" id="projectCopperfield_iframe" scrolling="auto" frameborder="no" style="' + a + '"></iframe>'
    },
    delete_frame : function() { 
        var a = projectCopperfield.get_or_create_div("projectCopperfield_container");
        a.parentNode.removeChild(a)
    }, 
    settings_value_exists : function(a) { 
        return _projectCopperfield[a] && (typeof _projectCopperfield[a] === "string")
    },
    is_valid_lang : function() { 
        var a=_projectCopperfield.lang;
        return a==="en" || a==="sv" || a==="da" || a==="no" || a==="de"
    },
    is_valid_align:function() {
        var a=_projectCopperfield.align;
        return a==="right" || a==="left"
    }, 
    init : function() { 
        
        projectCopperfield.org_slug = _projectCopperfield.org;
        
        if (projectCopperfield.settings_value_exists("align") && projectCopperfield.is_valid_align()) { 
            projectCopperfield.image_align = _projectCopperfield.align
        }
        
        if (projectCopperfield.settings_value_exists("top")) {     projectCopperfield.image_top = _projectCopperfield.top
        }
        
        if (projectCopperfield.settings_value_exists("lang") && projectCopperfield.is_valid_lang()) { 
            projectCopperfield.lang = _projectCopperfield.lang
        }
        
        if (projectCopperfield.settings_value_exists("image")) {         projectCopperfield.custom_image_url = _projectCopperfield.image 
        }
        
        if (projectCopperfield.settings_value_exists("base_url")) { projectCopperfield.base_url = _projectCopperfield.base_url
        }
        
        if (projectCopperfield.settings_value_exists("user_name")) { 
            projectCopperfield.user_name = _projectCopperfield.user_name 
        }
        
        if (projectCopperfield.settings_value_exists("user_email")) {     projectCopperfield.user_email = _projectCopperfield.user_email
        }
        
        if (projectCopperfield.settings_value_exists("id")) {     projectCopperfield.id = _projectCopperfield.id
        }
        
        projectCopperfield.create_button()
    }
};
projectCopperfield.init();