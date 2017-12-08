
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Exami-Nation</title>
  	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
	<link href="../index.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../style.css" rel="stylesheet" type="text/css" media="screen" />

</head>

<body>
	<div id="wrapper">
		<div id="header-wrapper">
			<div id="header">
				<div id="logo">
					<h1><a href="#">Exami-Nation</a></h1>
					
				</div>
			</div>
		</div>

	<!-- end #header -->

		<div id="menu-wrapper">
			<div id="menu">
				<ul>
					<!-- <li class="current_page_item"><a href="#">Notifications</a></li> -->
					<!-- <li><a href="#">Current Courses</a></li> -->
					<!-- <li><a href="#">Achievements</a></li> -->
				</ul>
			</div>
		<!-- end #menu -->
		</div>

		<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					<div id="content">


						<!-- Tabs -->
						<h1>Exam 1</h1>
						<p id="demo"></p>
						<head>
						<script>
						function secondsLeft() {
 						 now = new Date()
						  mins = now.getMinutes();
						  secs = now.getSeconds();
						  document.f1.t1.value = 60 * 60 - (mins * 60 + secs);
						}

						function init() {
						  timer = setInterval("secondsLeft()", 1000);
						}
						</script>
						</head>
						<body onload="init()">
						<form name="f1" onsubmit="return false">
						You have <input type="text" name="t1" size=1> seconds left.
						</form>
						</body>
						<dl class="responsive-tabs">
						  <dt>Multiple Choice</dt>
						  <dd>
						  	
						      <form action="/action_page.php">
						      	Question 1:  This is question 1.<br>
						      	
						      </form>
						      <div>
						      	<input type="radio">A</input>
			    		  	  	
			    		  	  </div>
			    		  	  <div>
						      	<input type="radio">B</input>
			    		  	  	
			    		  	  </div>
			    		  	  <div>
						      	<input type="radio">C</input>
			    		  	  	
			    		  	  </div>
			    		  	  <div>
						      	<input type="radio">D</input>
			    		  	  </div>
			    		  	
						  </dd>

						  <dt>Short Response</dt>
						  <dd>
						  	<div>
						     <form action="/action_page.php">
						      	Question 2:  This is a short response question.<br>
						  	</div>
						  	<div>
						  	  <textarea rows="1" cols="140" placeholder="Answer"></textarea>
						  	</div>
						  </dd>

						  <dt>Essay</dt>
						  <dd>
						      <div>
						     <form action="/action_page.php">
						      	Question 3:  This is an essay question.<br>
						  	</div>

						  	<div>
						  	  <textarea rows="30" cols="140" id="text" placeholder="Answer"></textarea>
						  	</div>
        					<div id="result">
					        </div>
						  </dd>
						</dl>

						<div style="clear: both;">&nbsp;</div>
						<div style="clear: both;">&nbsp;</div>
						
						<div>
							<input type="submit" value="Submit">
						</div>


						<div style="clear: both;">&nbsp;</div>
					</div>
				<!-- end #content -->
				
					<div style="clear: both;">&nbsp;</div>
				</div>
			</div>
		</div>
	<!-- end #page -->
	</div>



	<div>
		<p></p>
	</div>



	<script language="javascript" type="text/javascript" src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script language="javascript" type="text/javascript" src="../index.js"></script>
</body>
</html>
