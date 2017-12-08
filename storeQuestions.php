<html>
<?php
	$servername = "localhost"; //Name of the server
	$dbname = "ExamiNation"; //Name of the database
	$username = "root"; //Username used to connect to the database
	$password = NULL; //Password used to connect to the database

	$conn = new mysqli($servername, $username, $password, $dbname); //Connecting to the database
	if($conn->error){ //Checking connection for errors
		die("Could not establish connection to database."); //Terminating this page
	}

	echo "reached here";
	
		$course = $_POST['course']; //Getting the value of testName
		$userName = $_POST['userName'];
		
		//Constructing an sql query to get the number of MCQ and essay questions
		$sql = "SELECT numMCQ, numEssay FROM courses WHERE id = \"".$course.$userName."\"";
		$data = mysqli_query($conn, $sql); //Executing the query
		$result = mysqli_fetch_row($data); //Extracting information from the executed query
		echo $numMCQ = $result[0]; //Storing the number of MCQ
		echo $numEssay = $result[1]; //Storing the number of essay questions

		//Constructing an sql query to create a table which will store all the questions and options
		echo $sql = "CREATE TABLE ".preg_replace('/\s+/', '', $course)."(quesNum INT UNSIGNED PRIMARY KEY,
		question VARCHAR(300),
		isMCQ BOOLEAN,
		isEssay BOOLEAN,
		opta VARCHAR(300),
		optb VARCHAR(300),
		optc VARCHAR(300),
		optd VARCHAR(300),
		corrAns VARCHAR(1),
		ansEssay VARCHAR(700))";
		$data = mysqli_query($conn, $sql); //Executing the query

		echo "entering the MCQ loop";
		for($i = 1; $i <= $numMCQ; $i++){ //Loop to store all the MCQ
			//Checking if all parts of the questions have been entered
			if(!($_POST['ques'.$i] == "" || $_POST['opt'.$i.'a'] == "" || $_POST['opt'.$i.'b'] == "" || $_POST['opt'.$i.'c'] == "" || $_POST['opt'.$i.'d'] == "" || $_POST['ans'.$i] == "")){
				//Constructing an sql query to store the question and the answers
				echo $sql = "INSERT INTO ".preg_replace('/\s+/', '', $course)." (quesnum, question, isMCQ, isEssay, opta, optb, optc, optd, corrAns) VALUES (\"".$i."\",\"".$_POST['ques'.$i]."\",true,false,\"".$_POST['opt'.$i.'a']."\",\"".$_POST['opt'.$i.'b']."\",\"".$_POST['opt'.$i.'c']."\",\"".$_POST['opt'.$i.'d']."\",\"".$_POST['ans'.$i]."\")";
				$data = mysqli_query($conn, $sql); //Executing the query
			}
		}
		echo "exiting the mcq loop";
		
		for($i = 1; $i <= $numEssay; $i++){ //Loop to store all the essay questions
			if(!($_POST['quesEssay'.$i] == "") && !($_POST['ansEssay'.$i] == "")){ //Checking if the question has been entered
				//Constructing an sql query to store the question
				$sql = "INSERT INTO ".preg_replace('/\s+/', '', $course)." (quesnum, question, isMCQ, isEssay, ansEssay) VALUES (\"".($i+$numMCQ)."\",\"".$_POST['quesEssay'.$i]."\",false,true,\"".$_POST['ansEssay'.$i]."\")";
				$data = mysqli_query($conn, $sql); //Executing the sql query
				echo $sql;
				echo "Storing essay question   ";
			}
		}
		
		$check = true; //Initializing check
		for($i = 1; $i <= $numMCQ; $i++){ //Loop to check if all the questions have been entered
			if($_POST['ques'.$i] == "" || $_POST['opt'.$i.'a'] == "" || $_POST['opt'.$i.'b'] == "" || $_POST['opt'.$i.'c'] == "" || $_POST['opt'.$i.'d'] == "" || $_POST['ans'.$i] == ""){
				$check = false; //Changing check value
			}
		}
		
		if($check){ //Checking check value
			header("Location: teacherCoursesPage.php?userName=".$userName); //Redirecting to the next page
			die; //Terminating this page
		}
		else{
			header("Location: courseQuestions.php?userName=".$userName."&course=".$course); //Redirecting to the previous page
			die; //Terminating this page
		}
	?>
	</html>