<html>
<body>
<form>
	<?php
		$servername = "localhost"; //Name of server
		$dbname = "examination"; //Name of database
		$username = "root"; //Username used to connedt to database
		$password = NULL; //Password used to connect to database
		
		if(!isset($_POST['account'])){
			header("Location: register.php?failRegister=account");
			die;
		}
		
		$email = $_POST['email']; //Getting the user's username
		$userName = $_POST['userName'];
		$passWord = $_POST['password']; //Getting the user's password
		$account = $_POST['account'];
		$name = $_POST['name'];
	
		if(preg_replace('/\s+/', '', $email) == "" || preg_replace('/\s+/', '', $passWord) == "" || preg_replace('/\s+/', '', $account) == "" || preg_replace('/\s+/', '', $name) == ""){
			header("Location: register.php?failRegister=account");
			die;
		}
	
		$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
		if($conn->error){ //Checking connection for errors
			die("Could not establish connection to database."); //Terminating this page
		}
		
		if($account == "teacher"){
			$sql = "SELECT email FROM teachers WHERE email = \"".$email."\"";
			$data = mysqli_query($conn, $sql); //Executing the query

			if($data == false){ //Checking if the query was executed
				header("Location: errorLogin.php"); //Redirecting to the error page
				die; //Terminating this page
			}
			
			$result = mysqli_fetch_row($data); //Extracting information from the executed query
			
			if(!$result){
				$sql = "SELECT username FROM students WHERE username = \"".$userName."\"";
				$data = mysqli_query($conn, $sql); //Executing the query

				if($data == false){ //Checking if the query was executed
					header("Location: errorLogin.php"); //Redirecting to the error page
					die; //Terminating this page
				}
				
				$result = mysqli_fetch_row($data); //Extracting information from the executed query
				
				if(!$result){
					echo $sql = "INSERT INTO teachers (username, password, name, bio, loggedIn, email) VALUES ('".$userName."', '".$passWord."', '".$name."', 'No Data Available', 0, '".$email."')";
					$data = mysqli_query($conn, $sql); //Executing the query
					
					echo $sql = "CREATE TABLE ".$userName."(course VARCHAR(60) PRIMARY KEY)";
					$data = mysqli_query($conn, $sql); //Executing the query
					
					header("Location: login.php");
					die;
				}
				else{
					header("Location: register.php?failRegister=true");
					die;
				}
			}
			else{
				header("Location: register.php?failRegister=true");
				die;
			}
		}
		else{
			$sql = "SELECT email FROM students WHERE email = \"".$email."\"";
			$data = mysqli_query($conn, $sql); //Executing the query

			if($data == false){ //Checking if the query was executed
				header("Location: errorLogin.php"); //Redirecting to the error page
				die; //Terminating this page
			}
			
			$result = mysqli_fetch_row($data); //Extracting information from the executed query
			
			if(!$result){
				$sql = "SELECT username FROM students WHERE username = \"".$userName."\"";
				$data = mysqli_query($conn, $sql); //Executing the query

				if($data == false){ //Checking if the query was executed
					header("Location: errorLogin.php"); //Redirecting to the error page
					die; //Terminating this page
				}
				
				$result = mysqli_fetch_row($data); //Extracting information from the executed query
				
				if(!$result){
					echo $sql = "INSERT INTO students (username, password, name, bio, loggedIn, email) VALUES ('".$userName."', '".$passWord."', '".$name."', 'No Data Available', 0, '".$email."')";
					$data = mysqli_query($conn, $sql); //Executing the query
					
					echo $sql = "CREATE TABLE ".$userName."(course VARCHAR(60) PRIMARY KEY,  teacher VARCHAR (60))";
					$data = mysqli_query($conn, $sql); //Executing the query
					
					header("Location: login.php");
					die;
				}
				else{
					header("Location: register.php?failRegister=true");
					die;
				}
			}
			else{
				header("Location: register.php?failRegister=true");
				die;
			}
		}
	?>
</form>
</body>
</html>