reentiger/client/definition.php?definitionId=' + value._id.$id + '">' + value.name + '</a></span><br/><span>' + value.description + '</span></br><span><a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/task.php?userId=' + strUserId + '&definitionId=' + value._id.$id + '">Add task</a></span>';
		                document.getElementById("definitions").appendChild(newrow);
                    });
            });
            var strUrl = "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" + strUserId + "/tasks?group=definition";
            $.getJSON(strUrl, function(json) {
                $.each(json.results, function(key, value) {
                    $.each(value, function(key1, value1) {
                        var objNewRow = document.createElement('div');
                        var counter = document.getElementsByClassName('dasboard_definition').length;
                        objNewRow.className = 'dasboard_definition_task';
                        objNewRow.id = value1._id;
                        strHtml = '';
                        $.each(value1.content, function(key2, value2) {
                            strHtml = strHtml + key2 + ': ' + value2 + '<br/>';
                        });
                        objNewRow.innerHTML = strHtml;
                        document.getElementById(key).appendChild(objNewRow);
                    });
                });
            });
        });
    
	</script>

</head>

<body id="home">
    <div id = "container">
        <nav>
            <a href="">home</a> | <a href="">definitions</a> | <a href="">tasks</a>
        </nav>
        <section id="top">
            LOGO
        </section>
        <aside>
        </aside>
        <section id="createTask">
        </section>
        <section id="definitions">
            <article>
                FooDefinition
                <div><span>Updated</span><span>Title</span><span>C</span><span>L</span></div>
                <div><span>2011-08-03</span><span>Support</span><span>10</span><span>3</span></div>
                <div><span>2011-08-03</span><span>Why is it like this?</span><span>8</span><span>2</span></div>
                <div><span>2011-08-03</span><span>I don't know</span><span>0</span><span>8</span></div>
                <div><span>2011-08-02</span><span>Run run run into the forrest</span><span>7</span><span>1</span></div>
                <div><span>2011-08-01</span><span>Where the wild roses grow</span><span>5</span><span>5</span></div>
            </article>
        </section>
    </div>
</body>
</html>