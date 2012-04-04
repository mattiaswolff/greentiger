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
        <div class="span7 main">
          <div id="definitionapp">
            <div class="tabbable">
                <ul class="nav nav-tabs"></ul>
                <div class="tab-content"></div>
            </div>
          </div>        
          <div>
            
          </div>
        </div><!--/span-->
        <div class="span3">
          <div class="well">
            <a href="#" class="thumbnail">
              <img src="http://placehold.it/260x180" alt="">
            </a>
            <h2>Mattias Wolff</h2>
            <p><a href="http://www.dif.se">www.dif.se</a></p>
            <p>lsdfkj lasjf lasjf lajf lajsdf lakjsdf lajsd flajsd lfja dslfjal djsflaj sfljalsfjals fjlajs flajsd lfjalsdfj lkjs dflajsd lfajsd lfj alsf las flajs dflajsd lfjals f</p>
          </div><!--/.well -->
        </div>
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div>
    
    
    
    <!-- Templates -->
    <script type="text/template" id="definition-template">
      <a href="#test" name="TEST" data-toggle="tab"><%= description %></a>
        <form class="form-horizontal">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">Text input</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01">
                        <p class="help-block">Supporting help text</p>
                    </div>
                </div>
            </fieldset>
        </form>
    </script>
    
    <script type="text/template" id="definition-template-form">
        <form class="form-horizontal">
            <fieldset>
                <legend>Legend text</legend>
                <div class="control-group">
                    <label class="control-label" for="input01">Text input</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01">
                        <p class="help-block">Supporting help text</p>
                    </div>
                </div>
            </fieldset>
        </form>
    </script>
    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="../js/jQuery.js"></script>
    <script src="../js/json2.js"></script>
    <script src="../js/underscore.js"></script>
    <script src="../js/backbone.js"></script>
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
  
    <script type="text/javascript">
    // Models
$(function(){
  
window.Definition = Backbone.Model.extend({                                     
    defaults: function() {
      return {
        description:  "Please enter a description"
      };
    }
});
 
window.DefinitionList = Backbone.Collection.extend({
    model: Definition,
    url: 'http://www.zowgle.com/rest/index.php/users/matwo065/definitions'
});
 
window.Definitions = new DefinitionList;

window.DefinitionView = Backbone.View.extend({

    //... is a list tag.
    tagName:  "div",

    // Cache the template function for a single item.
    template: _.template($('#definition-template-form').html()),

    // The DefinitionView listens for changes to its model, re-rendering.
    initialize: function() {
      this.model.bind('change', this.render, this);
      this.model.bind('destroy', this.remove, this);
    },

    // Re-render the contents of the definition item.
    render: function() {
      $(this.el).html(this.template(this.model.toJSON()));
      this.setText();
      return this;
    },

    // To avoid XSS (not that it would be harmful in this particular app),
    // we use `jQuery.text` to set the contents of the todo item.
    setText: function() {
      var text = this.model.get('text');
      this.$('.definition-text').text(text);
      this.$('div').addClass('tab-pane');
      //this.input = this.$('.todo-input');
      //this.input.bind('blur', _.bind(this.close, this)).val(text);
    },
  });
 
 // The Application
  // ---------------

  // Our overall **AppView** is the top-level piece of UI.
  window.AppView = Backbone.View.extend({
    // Instead of generating a new element, bind to the existing skeleton of
    // the App already present in the HTML.
    el: $("#definitionapp"),
    
    events: {
      "keypress #new-definition":  "createOnEnter",
    },
    // At initialization we bind to the relevant events on the `Todos`
    // collection, when items are added or changed. Kick things off by
    // loading any preexisting todos that might be saved in *localStorage*.
    initialize: function() {
      this.input    = this.$("#new-definition");
      Definitions.on('add',   this.addOne, this);
      Definitions.on('reset', this.addAll, this);
      Definitions.on('all',   this.render, this);
      
      Definitions.fetch();
    },
    // Re-rendering the App just means refreshing the statistics -- the rest
    // of the app doesn't change.
    render: function() {
      $("#definitionapp ul.nav").append('<li class="active"><a href="#test" name="TEST" data-toggle="tab">testing</a></li>');
    },
    // Add a single todo item to the list by creating a view for it, and
    // appending its element to the `<ul>`.
    addOne: function(definition) {
      var view = new DefinitionView({model: definition});
      $("#definitionapp div.tab-content").append(view.render().el);
    },
    // Add all items in the **Todos** collection at once.
    addAll: function() {
      Definitions.each(this.addOne);
    },
    // If you hit return in the main input field, and there is text to save,
    // create new **Todo** model persisting it to *localStorage*.
    createOnEnter: function(e) {
      var text = this.input.val();
      if (!text || e.keyCode != 13) return;
      Definitions.create({text: text});
      this.input.val('');
    },
    // Clear all done todo items, destroying their models.
    clearCompleted: function() {
      _.each(Todos.done(), function(todo){ todo.destroy(); });
      return false;
    },
  });
  // Finally, we kick things off by creating the **App**.
  window.App = new AppView;
  });
  </script>
  </body>
</html>