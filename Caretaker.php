<html>
<body>
Please fill out the following information to add a new caretaker to the database: <br><br>

<form name = "addCaretaker" action="" method="post">
Pet ID#: <input type="text" name="PID" id="PID"><br>
Caretaker's Name: <input type="text" name="Name" id="Name"><br>
Weekly Hours: <input type = "text" name = "WeeklyHrs" id="WeeklyHrs"><br>
Home Phone # (without spaces): <input type = "text" name="HomePhone" id="HomePhone"><br>
Work Phone # (without spaces): <input type = "text" name = "WorkPhone" id ="WorkPhone"><br> 
<input type="submit" name = "addCaretaker" id = "addCaretaker" value = "Add Caretaker">
</form>

<?php
	//Connect to Database
	$username="root";$password="1234";$database="hw3";
	#mysql_connect('localhost');
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	error_reporting( error_reporting() & ~E_NOTICE );

	$PID = $_POST['PID'];
	$Name = $_POST['Name'];
	$WeeklyHrs = $_POST['WeeklyHrs'];
	$HomePhone = $_POST['HomePhone'];
	$WorkPhone = $_POST['WorkPhone'];

	$sql = "INSERT INTO `hw3`.`caretaker`(`PID`, `Name`, `WeeklyHrs`, `HomePhone`, `WorkPhone`)
       		VALUES('$PID','$Name',$WeeklyHrs, $HomePhone, $WorkPhone);";

	mysql_query($sql);
	mysql_close();

?>
</body>
</html>

