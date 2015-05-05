<html>
	<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<div id = "mainbackground"></div>
</head>
<body>
<a href="goats.php">Back to Main Page</a><br><br>
Tally of all pets currently in the database, sorted by type: <br><br>

<?php
	//Connect to Database
	$username="root";$password="1234";$database="hw3";
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	error_reporting( error_reporting() & ~E_NOTICE );

	$sqlB = mysql_num_rows(mysql_query("SELECT * FROM `Bird`;"));
	$sqlM = mysql_num_rows(mysql_query("SELECT * FROM `Mammal`;"));
	$sqlR = mysql_num_rows(mysql_query("SELECT * FROM `Reptile`;"));
	$sqlF = mysql_num_rows(mysql_query("SELECT * FROM `Fish`;"));

	echo "<table border='1'>
			<tr>
				<td>Bird</td>
				<td>$sqlB</td>
			</tr>
			<tr>
				<td>Mammal</td>
				<td>$sqlM</td>
			</tr>
			<tr>
				<td>Reptile</td>
				<td>$sqlR</td>
			</tr>
			<tr>
				<td>Fish</td>
				<td>$sqlF</td>
			</tr>
		</table>";

	mysql_close();
?>
</body>
</html>
