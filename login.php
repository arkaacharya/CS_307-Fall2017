<html>
  <head>
    <link rel="stylesheet" href="login.css" type="text/css">
    <script language="javascript" type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/login.js"></script>
  </head>
  <body>

    <div id="header">
      <div id="header-wrapper">
        <div id="header">
          <div id="logo">
        <h1><a href="#">Exami-Nation</a></h1>
      </div>
    </div>
  </div>
    </div>
<?php
$servername = "localhost"; //Name of server
		$dbname = "examination"; //Name of database
		$username = "root"; //Username used to connedt to database
		$password = NULL; //Password used to connect to database
	
		$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
		if($conn->error){ //Checking connection for errors
			die("Could not establish connection to database."); //Terminating this page
		}
?>

      <div class="login-page">
        <div class="form" id="form">
          <form class="login-form"
            action = "validateLogin.php"
            method = "post">
			<?php if(isset($_GET['failLogin'])){echo "Failed Loin. Please Try Again";} ?>
			<input type="radio" name="account" value="teacher">Teacher</input>
			<input type="radio" name="account" value="student">Student</input>

            <input type="text" placeholder="email" name="username" size="20" maxlength="70"/>

            <input type="password" placeholder="password" name="password"  size="20" maxlength="20"/>
            <button id="login">login</button>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
          </form>
        </div>
      </div>
    
  </body>
</html>