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

		echo "entering the MCQ loop";
		
		for($i = 1; $i <= $numMCQ; $i++){ //Loop to store new questions
			//Constructing an sql query to get the question number and to check if it is an MCQ question or not
			$sql = "SELECT quesNum, isMCQ, isEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum = \"".$i."\"";
			$data = mysqli_query($conn, $sql); //Executing query
			$result = mysqli_fetch_row($data); //Extracting information from the query
			
			if($result){ //Checking if information was received
				
				if($_POST['ques'.$i] != ""){
					//Constructing an sql query to store the new question
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET question=\"".$_POST['ques'.$i]."\" WHERE quesNum=".$i;
					$data = mysqli_query($conn, $sql); //Executing query
				}

				if($_POST['opt'.$i.'a'] != ""){
					//Constructing an sql query to store the new option
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET opta=\"".$_POST['opt'.$i.'a']."\" WHERE quesNum=".$i;
					$data = mysqli_query($conn, $sql); //Executing query
				}

				if($_POST['opt'.$i.'b'] != ""){
					//Constructing an sql query to store the new option
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET optb=\"".$_POST['opt'.$i.'b']."\" WHERE quesNum=".$i;
					$data = mysqli_query($conn, $sql); //Executing query
				}

				if($_POST['opt'.$i.'c'] != ""){
					//Constructing an sql query to store the new option
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET optc=\"".$_POST['opt'.$i.'c']."\" WHERE quesNum=".$i;
					$data = mysqli_query($conn, $sql); //Executing query
				}

				if($_POST['opt'.$i.'d'] != ""){
					//Constructing an sql query to store the new option
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET optd=\"".$_POST['opt'.$i.'d']."\" WHERE quesNum=".$i;
					$data = mysqli_query($conn, $sql); //Executing query
				}

				if($_POST['ans'.$i] != ""){
					//Constructing an sql query to store the new answer
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET corrAns=\"".$_POST['ans'.$i]."\" WHERE quesNum=".$i;
					$data = mysqli_query($conn, $sql); //Executing query
				}
			}
			else{
				if($_POST['ques'.$i] != "" && $_POST['opt'.$i.'a'] != "" && $_POST['opt'.$i.'b'] != "" && $_POST['opt'.$i.'c'] != "" && $_POST['opt'.$i.'d'] != "" && $_POST['ans'.$i] != ""){
					//Constructing an sql query to insert the new question and options into the database
					$sql = "INSERT INTO ".preg_replace('/\s+/', '', $course)." (quesnum, question, isMCQ, isEssay, opta, optb, optc, optd, corrAns) VALUES (".$i.",\"".$_POST['ques'.$i]."\",true,false,\"".$_POST['opt'.$i.'a']."\",\"".$_POST['opt'.$i.'b']."\",\"".$_POST['opt'.$i.'c']."\",\"".$_POST['opt'.$i.'d']."\",\"".$_POST['ans'.$i]."\")";
					$data = mysqli_query($conn, $sql); //Executing query
				}
			}
		}
		echo "exiting the mcq loop";
		
		for($i = 1; $i <= $numEssay; $i++){ //Loop to ass new essay questions
			//Constructing an sql query to check if a question exists in that spot
			$sql = "SELECT quesNum, isMCQ, isEssay FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum = \"".($i+$numMCQ)."\"";
			$data = mysqli_query($conn, $sql); //Executing query
			$result = mysqli_fetch_row($data); //Extracting information from executed query
			
			if($result){ //Checking if any information was received
			
				if($_POST['quesEssay'.$i] != ""){
					//Constructing an sql query to store the new question
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET question=\"".$_POST['quesEssay'.$i]."\" WHERE quesNum=".($i+$numMCQ);
					$data = mysqli_query($conn, $sql); //Executing query
				}
				
				if($_POST['ansEssay'.$i] != ""){
					$sql = "UPDATE ".preg_replace('/\s+/', '', $course)." SET ansEssay=\"".$_POST['ansEssay'.$i]."\" WHERE quesNum=".($i+$numMCQ);
					$data = mysqli_query($conn, $sql); //Executing query
				}
				
				//Constructing an sql query to indicate that this is an essay question
				$sql = "UPDATE ".$testName." SET isMCQ=false WHERE quesNum=".($i+$numMCQ);
				$data = mysqli_query($conn, $sql); //Executing query
				
				//Constructing an sql query to indicate that this not an MCQ
				$sql = "UPDATE ".$testName." SET isEssay=true WHERE quesNum=".($i+$numMCQ);
				$data = mysqli_query($conn, $sql); //Executing query
			}
			else{
				if($_POST['quesEssay'.$i] != "" && $_POST['ansEssay'.$i] != ""){
					//Constructing an sql query to insert the new question into the database
					$sql = "INSERT INTO ".preg_replace('/\s+/', '', $course)." (quesnum, question, isMCQ, isEssay, ansEssay) VALUES (\"".($i+$numMCQ)."\",\"".$_POST['quesEssay'.$i]."\", false, true, \"".$_POST['ansEssay'.$i]."\")";
					$data = mysqli_query($conn, $sql); //Executing query
				}
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