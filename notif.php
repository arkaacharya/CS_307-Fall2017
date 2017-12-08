
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Exami-Nation</title>
  	<meta charset="UTF-8">
	<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
	<link href="tab.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

</head>

<body>
	
	<div id="wrapper">

		<div id="header-wrapper">

			<div id="header">
				<div id="logo">
					<h1><a href="#">Exami-Nation</a></h1>
					<p>[Logo goes here]</p>
				</div>
			</div>
		</div>

	<!-- end #header -->
	<div>
			<ul class="menu">
				<li><a href="#" data-bubble="#">Notifications</a></li>
			</ul>
	</div>
		<div id="menu-wrapper">
			<div id="menu">
				<ul>
					<!-- <li class="current_page_item"><a href="#">Notifications</a></li> -->
					<!-- <li><a href="#">Current Courses</a></li> -->
					<!-- <li><a href="#">Achievements</a></li> -->
					<li class="current_page_item"><a href="#">Account</a></li>
					<li><a href="logout.php?account=student&userName=<?php echo $userName; ?>">Logout</a></li>
				</ul>
			</div>
		<!-- end #menu -->
			<a href='#'>Welcome, <?php echo $name; ?></a>
		</div>

		<div id="page">
			<div id="page-bgtop">
				<div id="page-bgbtm">
					<div id="content">


						<!-- Tabs -->
						<h1>Notifications</h1>




						<div style="clear: both;">&nbsp;</div>
						<div style="clear: both;">&nbsp;</div>
						
						<div>
							<h3 class="link"><a href="logout.php?account=student&userName=<?php echo $userName; ?>">Logout</a></h3>
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
		<p>\n\n</p>
	</div>



	<script language="javascript" type="text/javascript" src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script language="javascript" type="text/javascript" src="tab.js"></script>
</body>
</html>
