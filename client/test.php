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
        <div class="span7">
          <div class="alert alert-block">
            <a class="close" data-dismiss="alert">×</a>
            <h4 class="alert-heading">Warning!</h4>Best check yo self, you're not...
          </div>
          <div>
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#1" data-toggle="tab">Mall</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="1">
                        <form class="form-horizontal"><fieldset>
                        <div class="control-group">
                            <label class="control-label" for="input01"><i class="icon-edit" data-toggle="modal" href="#myModal"></i>   <span>Text input</span></label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" id="input01">
                                <p class="help-block">Please add information</p>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input02"><i class="icon-edit" data-toggle="modal" href="#myModal"></i>   <span>Text area</span></label>
                            <div class="controls">
                                <textarea class="input-xlarge" id="input02"></textarea>
                            </div>
                        </div>
                        <div class="form-actions"><button type="submit" class="btn btn-primary">Save changes</button> <button class="btn">Cancel</button></div></fieldset></form>
                    </div>
                </div>
            </div>
          </div>
          <div class="row-fluid">
            <div class="span2">
              <a href="#" class="thumbnail">
                <img src="http://placehold.it/260x180" alt="">
              </a>
            </div><!--/span-->
            <div class="span10">
              <h3>Heading</h3>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span2">
              <a href="#" class="thumbnail">
                <img src="http://placehold.it/260x180" alt="">
              </a>
            </div><!--/span-->
            <div class="span10">
              <h3>Heading</h3>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span2">
              <a href="#" class="thumbnail">
                <img src="http://placehold.it/260x180" alt="">
              </a>
            </div><!--/span-->
            <div class="span10">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span2">
              <a href="#" class="thumbnail">
                <img src="http://placehold.it/260x180" alt="">
              </a>
            </div><!--/span-->
            <div class="span10">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid">
            <div class="span2">
              <a href="#" class="thumbnail">
                <img src="http://placehold.it/260x180" alt="">
              </a>
            </div><!--/span-->
            <div class="span10">
              <h2>Heading</h2>
              <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
              <p><a class="btn" href="#">View details &raquo;</a></p>
            </div><!--/span-->
          </div><!--/row-->
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
                <label>Help text</label>
                <textarea id="description"></textarea>
                <span class="help-inline">Add help text to the element</span>
                <label>Type</label>
                <select id="type">
                    <option>Text</option>
                    <option>Textarea</option>
                    <option>Date</option>
                    <option>Other</option>
                </select>
                <span class="help-inline">Choose input type</span>
                <label>Configuration</label>
                <textarea id="config"></textarea>
                <span class="help-inline">Add configuration to the element</span>
                <label class="checkbox"><input type="checkbox">Required?</label>
            </form>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-primary">Save changes</a>
              <a href="#" class="btn" data-dismiss="modal">Close</a>
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
        
         /* GET DEFINITIONS
        * ============ */
        $.getJSON(getUrlApi('users/4f0c1ab5212602cc79000006'), {access_token: strAccessToken},function(json) {
            $.each(json.definitions, function(key, value) {
                $('.nav-tabs').append('<li><a href="#' + value._id.$id + '" data-toggle="tab">' + value.name + '</a></li>');
                var strDefinitionId = value._id.$id;
                var arrHTML = new Array();
                arrHTML.push('<div class="tab-pane" id="' + strDefinitionId + '">');
                arrHTML.push('<form class="form-horizontal"><fieldset>');
                /* GET FORM FOR DEFINITION
                * ============ */
                $.ajax({
                type: "GET",
                dataType: "json",
                async: false,
                url: getUrlApi('definitions/' + value._id.$id),
                success: function(json) {
                    $.each(json.results[0].content, function(key, value) {
                        arrHTML.push('<label class="control-label" for="' + value.name + '"><i class="icon-edit" data-toggle="modal" href="#myModal"></i>   ' + value.name + '</label>');
                        switch (value.type) {
                            case "text": case "email": case "url": case "date": case "time":
                                arrHTML.push('<div class="controls"><input type="' + value.type + '" class="input-xlarge" id="' + value.name + '"><p class="help-block">' + value.description + '</p></div>'); 
                                break;
                            case "textarea":
                                arrHTML.push('<div class="controls"><textarea class="input-xlarge" id="' + value.name + '"></textarea><p class="help-block">' + value.description + '</p></div>');
                                break;
                            case "dropdown":
                                break;
                            case "checkbox": case "radio":
                                break;
                            case "number": case "range":
                                break;
                        }
                    });
                }
                });
                arrHTML.push('<div class="form-actions"><button type="submit" class="btn btn-primary">Save changes</button><button class="btn">Cancel</button></div></fieldset></form>');
                $('.tab-content').append(arrHTML.join(""));
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
        $.getJSON(getUrlApi('definitions/4f089f522126029455000004/elements/mattiasw'), function(json) {
          $(".modal-header").children("h3").text("Edit " + json.elements[0].id);
          $("#description").attr("value", json.elements[0].description);
          $("#description").attr("value", json.elements[0].type);
          $("#description").attr("value", json.elements[0].config);
        });
      });
    </script>

  </body>
</html>