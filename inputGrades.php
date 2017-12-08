<html>
<?php

$servername = "localhost"; //Name of the server
$dbname = "examination"; //Name of the database
$username = "root"; //Username used to connect to the database
$password = NULL; //Password used to connect to the database

$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
if($conn->error){ //Checking connection for errors
	die("Could not establish connection to database."); //Terminating the page
}

$userName = $_POST['userName'];
$student = $_POST['student'];
$course = $_POST['course'];

$sql = "SELECT numEssay,numMCQ From courses WHERE name='".$course."'";
$data = mysqli_query($conn, $sql);
$result = mysqli_fetch_row($data);
$numEssay = $result[0];
$numMCQ = $result[1];

$totalEssayGrade = 0;
$achievedEssayGrade = 0;

for($i=1; $i <= $numEssay; $i++){
	$achievedEssayGrade += $_POST['essay'.$i.'Grade'];
	$totalEssayGrade += $_POST['essay'.$i.'MaxGrade'];
	
	$sql = "SELECT essay".$i."Feedback From studentanswers WHERE course='".$course."' AND studentName='".$student."'";
	$data = mysqli_query($conn, $sql);
	$result = mysqli_fetch_row($data);

	if($result){
		$sql = "UPDATE studentanswers SET essay".$i."Feedback = '".$_POST['essay'.$i.'Feedback']."' WHERE studentname='".$student."' AND course='".$course."'";
		$data = mysqli_query($conn, $sql); //Executing the query
	}
	else{
		$sql = "ALTER TABLE studentanswers ADD essay".$i."Feedback VARCHAR(100);";
		$data = mysqli_query($conn, $sql); //Executing the sql query
		
		$sql = "UPDATE studentanswers SET essay".$i."Feedback = '".$_POST['essay'.$i.'Feedback']."' WHERE studentname='".$student."' AND course='".$course."'";
		$data = mysqli_query($conn, $sql); //Executing the query		
	}
}

$sql = "SELECT totalCorrect From studentanswers WHERE course='".$course."' AND studentName='".$student."'";
$data = mysqli_query($conn, $sql);
$result = mysqli_fetch_row($data);
$totalCorrect = $result[0];


$sql = "UPDATE studentanswers SET testTaken=true, essayGraded=true, totalEssayGrade=".$totalEssayGrade.", 
achievedEssayGrade=".$achievedEssayGrade.", finalPercentage=".(100*($totalCorrect+$achievedEssayGrade)/($numMCQ+$totalEssayGrade))." WHERE studentname='".$student."' AND course='".$course."'";
$data = mysqli_query($conn, $sql); //Executing the query

header("Location: teacherCoursesPage.php?userName=".$userName);

?>
</html>