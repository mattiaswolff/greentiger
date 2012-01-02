var zowgle = {
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
    btn_close_url : "/static/images/zowgle-close-", 
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
        if (zowgle.old_browser()) {
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
        var a = document.getElementById("zowgle_container"); 
        if (a) {
            zowgle.delete_frame()
        } 
        else { 
            a = zowgle.get_or_create_div("zowgle_container"); 
            zowgle.create_overlay(a); 
            zowgle.create_frame(a)
        }
    }, 
    create_overlay: function(b) { 
        var a="top: 0; bottom:0; min-height:600px; left: 0; background: #000; opacity: 0.25; z-index: 1000; width: 100%;";
        a += zowgle.get_fixed_style();
        if (zowgle.old_browser()) { 
            var c = Math.max (document.body.clientHeight, document.documentElement.clientHeight); 
            a += "height:" + c + "px;"
        }
        b.innerHTML += '<div id="zowgle_overlay" style="' + a + '"></div>'
    },
    create_button : function() { 
        var b = zowgle.get_or_create_div ("zowgle_button_container");
        var c = "top: " + zowgle.image_top + ";right: -2em; z-index: 99999; cursor: pointer; margin: 0; -webkit-box-shadow: 0px 0px 20px #000; -webkit-border-radius: 5px; -moz-box-shadow: 0px 0px 20px #000; -moz-border-radius: 5px; box-shadow: 0px 0px 20px #000; border-radius: 5px;position: fixed;    -moz-transform: rotate(-90deg);  -webkit-transform: rotate(-90deg);  -o-transform: rotate(-90deg);  transform: rotate(-90deg);background: #333;color: #FFF;font-size: 1.5em;border: 2px solid white;padding: 0.5em;";
        c += zowgle.get_fixed_style();
        var a = zowgle.custom_image_url || zowgle.static_base_url + zowgle.image_url + "-" + zowgle.lang + "-" + zowgle.image_align + ".png"; 
        b.innerHTML += '<button alt="" id="zowgle_feedback" style="' + c + '" onclick= "zowgle.toggle_box()">Contact us!</button>'
        },
        
    create_frame : function(d) {
        var b = zowgle.close_text[zowgle.lang];
        var e = "cursor:pointer; height:26px; left:50%; margin-left:376px; top:9px; width:90px; z-index:100100;"; 
        e += zowgle.get_fixed_style(); 
        d.innerHTML += '<div style="cursor: pointer;height: 30px;left: 50%;margin-left: -484px;top: 30px;width: 30px;z-index: 100100; position: fixed; background-image: url(' + "'http://a.unbounce.com/s/images/fancybox/fancybox.png'" + '); background-position: -40px 0px;" onclick="zowgle.delete_frame()">'; 
        var c = zowgle.base_url + zowgle.embed_url + zowgle.id + "&lang=" + zowgle.lang; 
        if (zowgle.user_name && zowgle.user_email) { 
            c += "&name=" + zowgle.user_name + "&useremail=" + zowgle.user_email; 
            c = encodeURI();
        }
        //c = "http://www.zowgle.com/client/embed.php?userId=" + _zowgle["id"];
        var a= "background: white; border: none; height: 540px; left: 50%; margin-left: -470px; position: fixed; top: 40px; width: 940px; z-index: 100000; -webkit-box-shadow: 0px 0px 40px #000; -webkit-border-radius: 10px; -moz-box-shadow: 0px 0px 40px #000; -moz-border-radius: 10px; box-shadow: 0px 0px 40px #000; border-radius: 10px;";
        a += zowgle.get_fixed_style();
        d.innerHTML += '<iframe src="' + c + '" id="zowgle_iframe" scrolling="auto" frameborder="no" style="' + a + '"></iframe>'
    },
    delete_frame : function() { 
        var a = zowgle.get_or_create_div("zowgle_container");
        a.parentNode.removeChild(a)
    }, 
    settings_value_exists : function(a) { 
        return _zowgle[a] && (typeof _zowgle[a] === "string")
    },
    is_valid_lang : function() { 
        var a=_zowgle.lang;
        return a==="en" || a==="sv" || a==="da" || a==="no" || a==="de"
    },
    is_valid_align:function() {
        var a=_zowgle.align;
        return a==="right" || a==="left"
    }, 
    init : function() { 
        
        zowgle.org_slug = _zowgle.org;
        
        if (zowgle.settings_value_exists("align") && zowgle.is_valid_align()) { 
            zowgle.image_align = _zowgle.align
        }
        
        if (zowgle.settings_value_exists("top")) {     zowgle.image_top = _zowgle.top
        }
        
        if (zowgle.settings_value_exists("lang") && zowgle.is_valid_lang()) { 
            zowgle.lang = _zowgle.lang
        }
        
        if (zowgle.settings_value_exists("image")) {         zowgle.custom_image_url = _zowgle.image 
        }
        
        if (zowgle.settings_value_exists("base_url")) { zowgle.base_url = _zowgle.base_url
        }
        
        if (zowgle.settings_value_exists("user_name")) { 
            zowgle.user_name = _zowgle.user_name 
        }
        
        if (zowgle.settings_value_exists("user_email")) {     zowgle.user_email = _zowgle.user_email
        }
        
        if (zowgle.settings_value_exists("id")) {     zowgle.id = _zowgle.id
        }
        
        zowgle.create_button()
    }
};
zowgle.init();