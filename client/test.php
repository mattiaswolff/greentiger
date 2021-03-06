<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Zowgle.com</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#profile">Profile</a></li>
              <li><a href="#profile">Definitions</a></li>
              <li><a href="#plugins">Plugins</a></li>
            </ul>
            <p class="navbar-text pull-right">Logged in as <a href="#">username</a></p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well">
            <a href="#" class="thumbnail">
              <img src="http://placehold.it/260x180" alt="">
            </a>
            <h2>Mattias Wolff</h2>
            <p><a href="http://www.dif.se">www.dif.se</a></p>
            <p>lsdfkj lasjf lasjf lajf lajsdf lakjsdf lajsd flajsd lfja dslfjal djsflaj sfljalsfjals fjlajs flajsd lfjalsdfj lkjs dflajsd lfajsd lfj alsf las flajs dflajsd lfjals f</p>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span7 main">
          <div>
            <div class="tabbable">
                <ul class="nav nav-tabs">
                </ul>
                <div class="tab-content">
                </div>
            </div>
          </div>
        </div><!--/span-->
        <div class="span2">
          <div class="well">
          </div><!--/.well -->
        </div>
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div><!--/.fluid-container-->
    
    <div id="myModal" class="modal hide fade in">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h3>Edit form element</h3>
            </div>
            <div class="modal-body">
              <form>
                <label>Id</label>
                <input id="id" name="id"></textarea>
                <span class="help-inline">Set element id</span>                
                <label>Help text</label>
                <textarea id="description" name="description"></textarea>
                <span class="help-inline">Add help text to the element</span>
                <label>Type</label>
                <select id="type" name="type">
                    <option>Text</option>
                    <option>Textarea</option>
                    <option>Drop down</option>
                    <option>Checkbox</option>
                    <option>Radio</option>
                    <option>Range</option>
                    <option>Number</option>  
                    <option>Email</option>
                    <option>URL</option>
                    <option>Date</option>
                    <option>Time</option>
                </select>
                <span class="help-inline">Choose input type</span>
                <label>Configuration</label>
                <textarea id="config" name="config"></textarea>
                <span class="help-inline">Add configuration to the element</span>
                <label class="checkbox"><input type="checkbox">Required?</label>
            </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" data-dismiss="modal">Save changes</a>
              <button class="btn" data-dismiss="modal">Close</a>
            </div>
    </div>
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="../js/jQuery.js"></script>
    <script src="../js/bootstrap-transition.js"></script>
    <script src="../js/bootstrap-alert.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-dropdown.js"></script>
    <script src="../js/bootstrap-scrollspy.js"></script>
    <script src="../js/bootstrap-tab.js"></script>
    <script src="../js/bootstrap-tooltip.js"></script>
    <script src="../js/bootstrap-popover.js"></script>
    <script src="../js/bootstrap-button.js"></script>
    <script src="../js/bootstrap-collapse.js"></script>
    <script src="../js/bootstrap-carousel.js"></script>
    <script src="../js/bootstrap-typeahead.js"></script>
    
    <script src="../js/jquery.greentiger.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function(){
        $(".alert").alert();
        var strAccessToken = 'test';
        
        /* GET TASKS
        * ============ */
        $.getJSON(getUrlApi('users/4f0c1ab5212602cc79000006/tasks'), {access_token: strAccessToken},function(json) {
          $.each(json.results, function(key, value) {
            $('.main').append('<div class="row-fluid"><div class="span10"><h3><span class="label label-info">Heading</span> <span class="heading">This is a Heading!</span></h3><p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p><p><a class="btn" href="#">View details »</a></p></div></div>');  
          });
        });
        
         /* GET DEFINITIONS
        * ============ */
        $.getJSON(getUrlApi('users/4f0c1ab5212602cc79000006'), {access_token: strAccessToken},function(json) {
            $.each(json.definitions, function(key, value) {
                
                var strDefinitionId = value._id.$id;  
                $('.nav-tabs').append('<li><a href="#' + value._id.$id + '" name="' + value._id.$id + '" data-toggle="tab">' + value.name + '</a></li>');
                
                var arrHTML = new Array();
                arrHTML.push('<div class="tab-pane fade" id="' + strDefinitionId + '">');
                arrHTML.push('<form class="form-horizontal"><fieldset>');
                /* GET FORM FOR DEFINITION
                * ============ */
                $.ajax({
                type: "GET",
                dataType: "json",
                async: false,
                url: getUrlApi('definitions/' + value._id.$id),
                success: function(json) {
                    $.each(json.results[0].elements, function(key, value) {
                        if (value == null) {
                          return 1;
                        }
                        arrHTML.push('<div class="control-group"><label class="control-label" for="' + value.id + '"><i name="' + value.id + '" class="icon-edit" data-toggle="modal" href="#myModal"></i>   ' + value.id + '</label><div class="controls">');
                        switch (value.type) {
                            case "Text": case "Email": case "URL": case "Date": case "Time":
                                arrHTML.push('<input type="' + value.type + '" class="input-xlarge" id="' + value.id + '">'); 
                                break;
                            case "Textarea":
                                arrHTML.push('<textarea class="input-xlarge" id="' + value.id + '"></textarea>');
                                break;
                            case "Drop down":
                                arrHTML.push('<select class="input-xlarge" id="' + value.id + '">');
                                $.each(value.config.split(";"), function (key1, value1) {
                                  arrHTML.push('<option value="' + value1 + '">' + value1 + '</option>');
                                });
                                arrHTML.push('</select>');
                                break;
                            case "Checkbox": case "Radio":
                                $.each(value.config.split(";"), function (key1, value1) {
                                  arrHTML.push('<label class="'+ value.type +'"><input type="' + value.type + '" class="input-xlarge" id="' + value1 + '" value="' + value1 + '" name="' + value.id + '" >   ' + value1 + '</label>');
                                });
                                break;
                            case "Number": case "Range":
                                var arrConfig = value.config.split(";");
                                arrHTML.push('<input type="' + value.type + '" class="input-xlarge" id="' + value.id + '" name="' + name + '" min="' + arrConfig[0] + '" max="' + arrConfig[1] + '" step="' + arrConfig[2] + '">'); 
                                break;
                        }
                        arrHTML.push('<a class="close delete-element" name="' + value.id + '" data-dismiss="alert">×</a><p class="help-block">' + value.description + '</p></div></div>');
                    });
                }
                });
                arrHTML.push('<div class="control-group"><div class="controls"><button class="btn btn-small add-element" name="" data-toggle="modal" href="#myModal"><i class="icon-plus"></i> Add element</button></div></div><div class="form-actions"><button type="submit" class="btn btn-primary">Save changes</button>   <button class="btn">Cancel</button></div></fieldset></form>');  
                $('.tab-content').append(arrHTML.join(""));
                
            });
            $('.nav-tabs').append('<li><a href="#1" data-toggle="tab"><i class="icon-plus"></i></a></li>');
            $('.tab-content').append('<div class="tab-pane fade" id="1"><form class="form-horizontal"><fieldset><div class="control-group"><div class="controls"><button class="btn add-element" name="" data-toggle="modal" href="#myModal"><i class="icon-plus"></i> Add element</button></div></div><div class="form-actions"><button type="submit" class="btn btn-primary">Save changes</button> <button class="btn">Cancel</button></div></fieldset></form></div>');
        });
        
        $("#myModal").delegate("button.btn-primary", "click", function(event) {
          var values = {};
          $.each($('#myModal form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
          });
          if (window.sessionStorage.getItem("element_id") == '') {
            var strType = "POST";
            var strUrl = getUrlApi('definitions/' + window.sessionStorage.getItem("definition_id") + '/elements');
          }
          else {
            var strType = "PUT";
            var strUrl = getUrlApi('definitions/' + window.sessionStorage.getItem("definition_id") + '/elements/' + window.sessionStorage.getItem("element_id"));  
            $("#id").attr("disabled", "true");  
          }
          $.ajax({
                type: strType,
                url: strUrl,
                dataType: 'json',
                data: values,
                async: false,
                success: function(data) {
                  $('#' + window.sessionStorage.getItem("element_id")).parents(".controls").children("p.help-block").text(values["description"]);
                  },
                error: function(data) {
                  $('div.main').append('<div class="alert alert-block"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">Warning!</h4>Best check yo self, youre not...</div>')
                  }
            });
        });   
        
        $(".nav-tabs").delegate("a", "click", function(event) {
          window.sessionStorage.setItem("definition_id", $(this).attr('name'));
        });
        
        $(".tab-content").delegate("button.btn-primary", "click", function(event) {
          if (event.preventDefault()) {
                event.preventDefault();// cancels the form submission
            }
            else {
                event.returnValue = false;
            }
            var values = {};
            
            $.each($(this).parents('form').serializeArray(), function(i, field) {
              values[field.name] = field.value;
            });
            
            var strUrl = getUrlApi('definitions/' + window.sessionStorage.getItem("definition_id"));    
            
            $.ajax({
                type: 'POST',
                url: strUrl,
                dataType: 'json',
                data: values,
                async: false,
                success: function(data) {
                  $('#' + window.sessionStorage.getItem("element_id")).parents(".controls").children("p.help-block").text(values["description"]);
                  },
                error: function(data) {
                  $('div.main').append('<div class="alert alert-block"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">Warning!</h4>Best check yo self, youre not...</div>')
                  }
            });
        });  
        
        $("body").delegate("a.delete-element", "click", function(event) {
          var strUrl = getUrlApi('definitions/' + window.sessionStorage.getItem("definition_id") + '/elements/' + $(this).attr("name"));
          $.ajax({
                type: 'DELETE',
                url: strUrl,
                dataType: 'json',
                async: false,
                success: function(data) {
                  $('#' + window.sessionStorage.getItem("element_id")).parents(".controls").children("p.help-block").text(values["description"]);
                  },
                error: function(data) {
                  $('div.main').append('<div class="alert alert-block"><a class="close" data-dismiss="alert">×</a><h4 class="alert-heading">Warning!</h4>Best check yo self, youre not...</div>')
                  }
            });
        });
        
        /* EDIT DEFINITION FORM ROWS
        * ============ 
        $("body").delegate(".icon-edit", "click", function(event) {
          $(".modal-header").children("h3").text("Edit " + $(this).parents(".control-label").children("span").text());
          $("#description").attr("value", $(this).parents(".control-group").children(".controls").children(".help-block").text());
          if ($(this).parents(".control-group").children(".controls").children("input").size() == 1) {    
            $("#type").attr("value", $(this).parents(".control-group").children(".controls").children("input").attr("type"));
            $("#config").attr("value", "");
            $("#config").attr("disabled", "true");
          }
          else if ($(this).parents(".control-group").children(".controls").children("textarea").size() == 1) {    
            $("#type").attr("value", "Textarea");
            $("#config").attr("value", "");
            $("#config").attr("disabled", "true");
          }
        });*/
      });
      
      $('#myModal').on('show', function () {
        $("#id").removeAttr("disabled");
        $("#id").attr("value", "");
        $("#description").attr("value", "");
        $("#type").attr("value", "");
        $("#config").attr("value", "");
        if (window.sessionStorage.getItem("element_id") != "") {
          $("#id").attr("disabled", "true");
          $.getJSON(getUrlApi('definitions/' + window.sessionStorage.getItem("definition_id") + '/elements/' + window.sessionStorage.getItem("element_id")), function(json) {
            $("#id").attr("value", json.elements[0].id);
            $("#description").attr("value", json.elements[0].description);
            $("#type").attr("value", json.elements[0].type);
            $("#config").attr("value", json.elements[0].config);
          });
        }
      });
      
      $('#myModal').on('hidden', function () {
        window.sessionStorage.removeItem("element_id");
      });
    </script>

  </body>
</html>