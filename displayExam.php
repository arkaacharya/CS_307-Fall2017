<?php
	$servername = "localhost"; //Name of the server
	$dbname = "examination"; //Name of the database
	$username = "root"; //Username used to connect to the database
	$password = NULL; //Password used to connect to the database

	$conn = new mysqli($servername, $username, $password, $dbname); //Establishing connection to the database
	if($conn->error){ //Checking connection for errors
		die("Could not establish connection to database."); //Terminating the page
	}

	$userName = $_GET['userName'];
	$course = $_GET['course'];
	
	$sql = "SELECT loggedIn From students WHERE username='".$userName."'";
	$data = mysqli_query($conn, $sql);
	$result = mysqli_fetch_row($data);
	
	if(!$result[0]){
		header("Location: login.php");
	}
?>
	<html>
	<head>
		<!-- Name on tab of the page -->
		<title><?php
		$sql = "SELECT teacher FROM ".$userName." WHERE course='".$course."'";
		$data = mysqli_query($conn, $sql);
		$result = mysqli_fetch_row($data);
		$teacher = $result[0];
		
		//Constructing an sql query to get the test information
		$sql = "SELECT timeLimit, numMCQ, numEssay FROM courses WHERE id=\"".$course.$teacher."\"";
		$data = mysqli_query($conn, $sql); //Executing the sql query
		$result = mysqli_fetch_row(mysqli_query($conn, $sql)); //Extracting infromation from the executed query
		$timeLimit = $result[0]; //Storing the time limit in another variable
		$numMCQ = $result[1]; //Storing the number of MCQ in another variable
		$numEssay = $result[2]; //Storing the number of essay questions in another variable
		
		echo $course; //Displaying the test name ?></title>

	<!-- JavaScript used to update the timer -->
	<script>
	var distance = <?php echo $timeLimit; ?>;
	distance = distance * 60;
	var x = setInterval(function() {
		
	  distance = distance - 1;
	  var minutes = Math.floor(distance / 60);
	  var seconds = Math.floor(distance % 60);

	  document.getElementById("timer").innerHTML = minutes + "m "
	  + seconds + "s";

	  // If the count down is finished, write some text 
	  if (distance <= 0) {
		document.forms[0].submit();
	  }
	}, 1000);
	</script>


	<head>
	<body>
	<form
	action = "storeAnswers.php"
	method = "post">
	<div id="insideBody">
	
	<table border = "0">
	
	<!-- Used to display the time left on the top of the page -->
	<font size="+2" face="arial"><p id="timer"></p></font>
	
	<tr>
	<!-- Used for the username as it is easier to submit this way.
		It has been nade invisible so that the test taker can't modify it.-->
		<td
		align  = "left">
			<input type = "text"
			name = "userName"
			size = "50"
			value="<?php echo $userName ?>"
			readonly = "readonly"
			maxlength = "50"
			style = "display: none"
			/></td>
	</tr>
	<tr>
	<!-- Used for the testname as it is easier to submit this way.
		It has been nade invisible so that the test taker can't modify it.-->
		<td
		align  = "left">
			<textarea
			name = "course"
			size = "700"
			maxlength = "700"
			readonly = "readonly"
			style = "display: none"
			><?php echo $course ?></textarea>
			
			</td>
	</tr>
	
		<?php
			$i = 1; //Used as a counter
			//Constructing an sql query to get the question of the test
			$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$i;
			$data = mysqli_query($conn, $sql); //Executing the sql query
			$result = mysqli_fetch_row(mysqli_query($conn, $sql)); //Extracting information from the executed query
			while($result && $i <= $numMCQ){ //Condition to loop as long as information is being received, and the number of questions haven't been exceeded
		?>
	<tr><td>
		<!-- Displaying the question -->
		<b></br></br></br><font size="+2" face="arial">Question
			<?php
			echo " ".$i.": ".$result[1]; //Displaying the question
			?></b>
		
		<!-- Displaying the option 'a' -->
		</br></br><input type = "radio" name = "ans<?php echo $i ?>" value = "a"/>
		<font size="+2" face="arial"><?php
		echo " ".$result[4]; //Displaying option
		?></font>
		
		<!-- Displaying the option 'b' -->
		</br></br><input type = "radio" name = "ans<?php echo $i ?>" value = "b"/>
		<font size="+2" face="arial"><?php
		echo " ".$result[5]; //Displaying option
		?></font>
		
		<!-- Displaying the option 'c' -->
		</br></br><input type = "radio" name = "ans<?php echo $i ?>" value = "c"/>
		<font size="+2" face="arial"><?php
		echo " ".$result[6]; //Displaying option
		?></font>
		
		<!-- Displaying the option 'd' -->
		</br></br><input type = "radio" name = "ans<?php echo $i ?>" value = "d"/>
		<font size="+2" face="arial"><?php
		echo " ".$result[7]; //Displaying option
		?></font>
		
		<?php
				$i++; //Inceremnting counter
				//Constructing an sql query to get the question of the test
				$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".$i;
				$data = mysqli_query($conn, $sql); //Executing the sql query
				$result = mysqli_fetch_row($data); //Extracting information from the executed query
			}
		?>
	</td></tr>

	<?php
			$i = 1; //Initializing counter
			//Constructing an sql query to get the question of the test
			$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".($i+$numMCQ);
			$data = mysqli_query($conn, $sql); //Executing the sql query
			$result = mysqli_fetch_row(mysqli_query($conn, $sql)); //Extracting information from the executed query
			while($result && $i <= $numEssay){ //Condition to loop as long as information is being received, and the number of questions haven't been exceeded
		?>
	<tr><td>
		<!-- Displaying the question -->
		<b></br></br></br><font size="+2" face="arial">Essay Question
		<?php
		echo " ".$i.": ".$result[1]." "; //Displaying the question
		?></b>
		<!-- Area for accepting the answer -->
		</br>(Answer in maximum 700 characters)</font>
		</br><textarea
			name = "ansEssay<?php echo $i ?>"
			size = "700"
			maxlength = "700"
			></textarea>
		<?php
				$i++; //Incrementing the counter
				//Constructing an sql query to get the question of the test
				$sql = "SELECT * FROM ".preg_replace('/\s+/', '', $course)." WHERE quesNum=".($i+$numMCQ);
				$data = mysqli_query($conn, $sql); //Executing the sql query
				$result = mysqli_fetch_row($data); //Extracting information from the executed query
			}
		?>
	</td></tr>

	<!-- Button to turn in all the answers -->
	<tr>
		<td
		colspan = "2"
		align  = "center">
			<input type = "submit"
			value = "Submit Answers" /></td>
	</tr>
	</table>
	</div>
	</form>

	</body>
	</html>


<!-- JavaScript file used to disable the back button so that the user's can't retake the test -->
<script>
history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
});
</script>


<script lang uage="javascript"type="text/javascript">//this code handles the F5/Ctrl+F5/Ctrl+R

document.onkeydown = checkKeycode

function checkKeycode(e){var keycode;if(window.event)

keycode = window.event.keyCode;elseif(e)

keycode = e.which;// Mozilla firefoxif($.browser.mozilla){if(keycode ==116||(e.ctrlKey && keycode ==82)){if(e.preventDefault){

e.preventDefault();

e.stopPropagation();}}}// IEelseif($.browser.msie){if(keycode ==116||(window.event.ctrlKey && keycode ==82)){

window.event.returnValue =false;

window.event.keyCode =0;

window.status ="Refresh is disabled";}}}</script>
