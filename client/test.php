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
            <form class="form-horizontal">
              <fieldset>
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#1" data-toggle="tab">Fråga oss</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="1">
                            <div class="control-group">
                                <label class="control-label" for="input01">Text input</label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge" id="input01">
                                    <p class="help-block">Please add information</p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input02">Text input</label>
                                <div class="controls">
                                    <textarea class="input-xlarge" id="input02"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="2">
                            <div class="control-group">
                                <label class="control-label" for="input01">Text input2</label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge" id="input01">
                                    <p class="help-block">Please add information</p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input02">Text input2</label>
                                <div class="controls">
                                    <textarea class="input-xlarge" id="input02"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  <button class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>
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
                $.getJSON(getUrlApi('definitions/' + value._id.$id), {access_token: strAccessToken},function(json) {
                    $.each(json.results[0].content, function(key, value) {
                        var arrHtml = new Array();
                        arrHTML.push('<div class="tab-pane" id="' + strDefinitionId + '">');
                        arrHTML.push('<label class="control-label" for="' + value.name + '">' + value.name + '</label>');
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
                        $('.tab-content').append(arrHtml.join(""));
                    });
                }); 
            });
        });
        
      });
    </script>

  </body>
</html>