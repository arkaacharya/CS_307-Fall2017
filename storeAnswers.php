
<html>
<head>
<head>
<body>
<form>

<?php
$servername = "localhost"; //Name of the server
$dbname = "ExamiNation"; //Name of the database
$username = "root"; //Username used to connect to the database
$password = NULL; //Password used to connect to the database

$conn = new mysqli($servername, $username, $password, $dbname); //Connecting to the database
if($conn->error){ //Checking connection for errors
	die("Could not establish connection to database."); //Terminating this page
}

$userName = $_POST['userName'];
$course = $_POST['course'];

$sql = "SELECT teacher FROM ".$userName." WHERE course='".$course."'";
$data = mysqli_query($conn, $sql);
$result = mysqli_fetch_row($data);
$teacher = $result[0];

$sql = "INSERT INTO studentanswers (studentname, course) VALUES ('".$userName."', '".$course."')";
$data = mysqli_query($conn, $sql);

//Constructing an sql query to get the test information
$sql = "SELECT numMCQ, numEssay FROM courses WHERE id=\"".$course.$teacher."\"";
$data = mysqli_query($conn, $sql); //Executing the sql query
$result = mysqli_fetch_row(mysqli_query($conn, $sql)); //Extracting infromation from the executed query
$numMCQ = $result[0]; //Storing the number of MCQ in another variable
$numEssay = $result[1]; //Storing the number of essay questions in another variable

$numCorrect = 0;

for ($i = 1; $i <= $numMCQ; $i++){ //Loop to check if all the answers are correct
	
	if(isset($_POST['ans'.$i])){
		$sql = "SELECT corrAns FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=\"".$i."\"";
		$data = mysqli_query($conn, $sql); //Executing the sql query
		$result = mysqli_fetch_row(mysqli_query($conn, $sql)); //Extracting infromation from the executed query
		
		if($result[0] == $_POST['ans'.$i]){
			$numCorrect = $numCorrect + 1;
		}
	}
	
	//Constructing an sql query to check if the coulmn for the answer is there
	$sql = "SELECT ans".$i." FROM studentanswers";

	$data = mysqli_query($conn, $sql); //Executing the sql query
	$res = false; //Initializing the variable
	if($data){ //Checking if the query was executed properly
		$res = mysqli_fetch_row($data);	 //Extracting information from the executed query
	}
	
	if($res){ //Checking if the column is there
		if(isset($_POST['ans'.$i])){ //Checking if the answer has been entered
			//Constructing an sql query to insert the answer of the user in the correct position
			echo $sql = "UPDATE studentanswers SET ans".$i."=\"".$_POST['ans'.$i]."\" WHERE studentname='".$userName."' AND course='".$course."'";

			$data = mysqli_query($conn, $sql); //Executing the query
			if($_POST['ans'.$i] == $adminAns[0]) //Checking if the answer entered by the user is correct
				$corrAns++; //Incrementing counter
		}
		else if(isset($_GET['ans'.$i])){ //Checking if the answer has been entered
			//Constructing an sql query to insert the answer of the user in the correct position

			echo $sql = "UPDATE studentanswers SET ans".$i."=\"".$_GET['ans'.$i]."\" WHERE studentname='".$userName."' AND course='".$course."'";

			$data = mysqli_query($conn, $sql); //Executing the query
			if($_GET['ans'.$i] == $adminAns[0]) //Checking if the answer entered by the user is correct
				$corrAns++; //Incrementing counter
		}
	}
	else{
		//Constructing an sql query to add the appropriate column in the table

		echo $sql = "ALTER TABLE studentanswers ADD ans".$i." VARCHAR(1);";

		$data = mysqli_query($conn, $sql); //Executing the sql query
		
		if(isset($_POST['ans'.$i])){ //Checking if the answer has been entered
			//Constructing an sql query to insert the answer of the user in the correct position

			$sql = "UPDATE studentanswers SET ans".$i."='".$_POST['ans'.$i]."' WHERE studentname='".$userName."' AND course='".$course."'";

			$data = mysqli_query($conn, $sql); //Executing the query
			if($_POST['ans'.$i] == $adminAns[0]) //Checking if the answer entered by the user is correct
				$corrAns++; //Incrementing counter
		}
	}
}

for($i = 1; $i <= $numEssay; $i++){ //Loop for entering the essay answers into the database
	//Constructing an sql query to check if the appropriate column exists

	$sql = "SELECT ansEssay".$i." FROM studentanswers";

	$data = mysqli_query($conn, $sql); //Executing the query
	$res = false; //Initializing the variable
	if($data){ //Checking if the query was executed
		$res = mysqli_fetch_row($data); //Extracting information from the executed query
	}
	
	if($res){ //Checking if information was received
		if(isset($_POST['ansEssay'.$i])){ //Checking if the answer was entered
			//Constructing an sql query to insert the answer of the user in the correct position

			$sql = "UPDATE studentanswers SET ansEssay".$i."=\"".$_POST['ansEssay'.$i]."\" WHERE studentname='".$userName."' AND course='".$course."'";

			$data = mysqli_query($conn, $sql); //Executing the query
		}
	}
	else{
		//Constructing an sql query to add the appropriate column in the table

		$sql = "ALTER TABLE studentanswers ADD ansEssay".$i." VARCHAR(300);";

		$data = mysqli_query($conn, $sql); //Executing the query
		
		//Constructing an sql query to insert the answer of the user in the correct position
		if(isset($_POST['ansEssay'.$i])){ //Checking if the answer was entered

			$sql = "UPDATE studentanswers SET ansEssay".$i."='".$_POST['ansEssay'.$i]."' WHERE studentname='".$userName."' AND course='".$course."'";

			$data = mysqli_query($conn, $sql); //Executing the query
		}
	}
}

//Constructing an sql query to to mark the test as completed

$sql = "UPDATE studentanswers SET testTaken=true, totalCorrect=".$numCorrect.", finalPercentage=".($numCorrect*100/$numMCQ)." WHERE studentname='".$userName."' AND course='".$course."'";
$data = mysqli_query($conn, $sql); //Executing the query

//Redirecting to the next page
header("Location: studentTestStatistics.php?userName=".$userName."&course=".$course);
die; //Terminating this page
?>

</form>
</body>
</html>
