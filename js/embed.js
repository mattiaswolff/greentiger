var kundo = {
    org_slug : null, 
    base_url : "http://kundo.se", 
    static_base_url : "http://static.kundo.se", 
    lang: "sv", 
    image_align: "right", 
    image_top: "200px", 
    close_text : {
        sv: "St\u00E4ng", 
        en : "Close", 
        da: "Luk", 
        no: "Lukk"}, 
    custom_image_url : null,
    embed_url : "/embed/landingpage/", 
    image_url : "/images/tycktill-1", 
    btn_close_url : "/static/images/kundo-close-", 
    user_name : null, 
    user_email : null, 
    old_browser:function(){
        var c = document.all&&/MSIE\s?6/.test(navigator.userAgent);
        var b = document.all&&/MSIE\s?7/.test(navigator.userAgent);
        var a = document.all&&/MSIE\s?8/.test(navigator.userAgent);
        var d = document.compatMode == "BackCompat";
        return c || ((b||a) && d)
    }, 
        get_fixed_style : function() {
            if (kundo.old_browser()) {
                return "position: absolute;"
            }
            return "position: fixed;"
        },
        get_or_create_div : function(c) {
            var b = document.getElementById(c);
            if (!b) {
                var a=document.getElementsByTagName("body")[0];
                var b=document.createElement("div"); 
                b.id=c; 
                a.appendChild(b)
            } 
            return b
        },
        toggle_box : function() {
            var a = document.getElementById("kundo_container"); 
            if (a) { 
                kundo.delete_frame() 
            } 
            else { 
                a = kundo.get_or_create_div("kundo_container"); 
                kundo.create_overlay(a); 
                kundo.create_frame(a)
            }
        }, 
        create_overlay: function(b) { 
            var a="top: 0; bottom:0; min-height:600px; left: 0; background: #000;filter: alpha(opacity=70); opacity: 0.7; z-index: 1000; width: 100%;";
            a += kundo.get_fixed_style();
            if (kundo.old_browser()) { 
                var c = Math.max(document.body.clientHeight,document.documentElement.clientHeight); 
                a += "height:" + c + "px;"
            }
            b.innerHTML += '<div id="kundo_overlay" style="' + a + '"></div>'
        },
        create_button : function() { 
            var b = kundo.get_or_create_div("kundo_button_container");
            var c = "top: " + kundo.image_top + "; " + kundo.image_align + ": 0; z-index: 99999; cursor: pointer; margin: 0;";
            c += kundo.get_fixed_style();
            var a = kundo.custom_image_url || kundo.static_base_url + kundo.image_url + "-" + kundo.lang + "-" + kundo.image_align + ".png"; 
            b.innerHTML += '<img src="' + a + '" alt="" id="kundo_feedback" style="'+c+'" onclick="kundo.toggle_box()">'
        },
        create_frame:function(d){var b=kundo.close_text[kundo.lang];var e="cursor:pointer; height:26px; left:50%; margin-left:376px; top:9px; width:90px; z-index:100100;";e+=kundo.get_fixed_style();d.innerHTML+='<img title="'+b+'" src="'+kundo.base_url+kundo.btn_close_url+kundo.lang+'.gif" alt="" id="kundo_close" style="'+e+'" onclick="kundo.delete_frame()">';var c=kundo.base_url+kundo.embed_url+kundo.org_slug+"?lang="+kundo.lang;if(kundo.user_name&&kundo.user_email){c+="&name="+kundo.user_name+"&useremail="+kundo.user_email;c=encodeURI(c)}var a="background: white; border: none; height: 540px; left: 50%; margin-left: -470px; position: fixed; top: 40px; width: 940px; z-index: 100000;";a+=kundo.get_fixed_style();d.innerHTML+='<iframe src="'+c+'" id="kundo_iframe" scrolling="no" frameborder="no" style="'+a+'"></iframe>'},delete_frame:function(){var a=kundo.get_or_create_div("kundo_container");a.parentNode.removeChild(a)},settings_value_exists:function(a){return _kundo[a]&&(typeof _kundo[a]==="string")},is_valid_lang:function(){var a=_kundo.lang;return a==="en"||a==="sv"||a==="da"||a==="no"||a==="de"},is_valid_align:function(){var a=_kundo.align;return a==="right"||a==="left"},init:function(){kundo.org_slug=_kundo.org;if(kundo.settings_value_exists("align")&&kundo.is_valid_align()){kundo.image_align=_kundo.align}if(kundo.settings_value_exists("top")){kundo.image_top=_kundo.top}if(kundo.settings_value_exists("lang")&&kundo.is_valid_lang()){kundo.lang=_kundo.lang}if(kundo.settings_value_exists("image"))
            {kundo.custom_image_url=_kundo.image}
            if("https:"==document.location.protocol) {kundo.static_base_url="https://static-ssl.kundo.se";
            kundo.base_url="https://kundo.se"}
            if(kundo.settings_value_exists("base_url")){kundo.base_url = _kundo.base_url}
            if(kundo.settings_value_exists("user_name"))
            {kundo.user_name=_kundo.user_name}
            if (kundo.settings_value_exists("user_email")) {kundo.user_email=_kundo.user_email}
            kundo.create_button()}};
            kundo.init();