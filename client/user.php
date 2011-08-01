         $("#email").val(json.users[0].email);
                    $("#userId").val(json.users[0]._id);
                    $.each(json.users[0].definitions, function(key, value) {
                        var strNewRow = document.createElement('div');
                        strNewRow.innerHTML = '<a href="http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/user.php?definitionId=' + key + '">' + value.name + '</a> <input name="state" type="radio" value="private" /> <input name="state" type="radio" value="public" />';
                        document.getElementById("definitions").appendChild(strNewRow);
                    });
                });
            }
	    });
    </script>
</head>

<body id="home">
    <section>
        User
				<form>
   		 			    UserId: <input id="userId" type="text" name="userId" value=""<?php echo (isset($_GET['userId']) ? 'readonly="readonly"' : '') ?> /><br/>
                        Name: <input id="name" type="text" name="name" value="" /><br/>
                        Email: <input id="email" type="text" name="email" maxlength="30" value="" /><br/>
                        Redirect Uri: <input id="redirectUri" type="text" name="redirectUri" maxlength="200" value="" /><br/>
				</form>
                <span onClick=<?php echo (!isset($_GET['userId']) ? '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users', 'POST')" . '"' : '"' . "submitFormJSON('http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/api/users/" . $_GET['userId'] ."', 'PUT')" . '"' ); ?>>Save user</span>
    <section>
</body>
</html>