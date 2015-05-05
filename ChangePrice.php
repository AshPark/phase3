<html>
	<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<div id = "mainbackground"></div>
</head>
<body>
<a href="goats.php">Back to Main Page</a><br><br>
Please fill out the following information to change the price: <br><br>

<form name = "changePrice" action="" method="post">
ID: <input type="text" name="ID" id="ID"><br>
New Price: $<input type="text" name="Price" id="Price"><br><br>
<input type="submit" name = "changePrice" id = "changePrice" value = "Submit">
</form>

<?php
	//Connect to Database
	error_reporting( error_reporting() & ~E_NOTICE );
	$username="root";$password="1234";$database="hw3";
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$ID = $_POST['ID'];
	$Price = $_POST['Price'];
	$IDType = 'FID';
	$searchType = 'Food';

	$sqlChecker = "SELECT * from `$searchType`
					WHERE `$IDType` = '$ID';"; 

		$Updater = "UPDATE `$searchType`
       		SET `Price` = $Price 
       		WHERE `$IDType` = '$ID';";
       			mysql_query($Updater);

	//Checks if valid ID
	if(mysql_num_rows(mysql_query($sqlChecker)) == 0)
	{
		$searchType = 'Toy';
		$IDType = 'TID';
			$Updater = "UPDATE `$searchType`
       		SET `Price` = $Price 
       		WHERE `$IDType` = '$ID';";
       			mysql_query($Updater);
	}
	if(mysql_num_rows(mysql_query($sqlChecker)) == 0)
	{
		$searchType = 'Pet';
			$IDType = 'PID';
				$Updater = "UPDATE `$searchType`
       		SET `Price` = $Price 
       		WHERE `$IDType` = '$ID';";
       			mysql_query($Updater);
	}

	//Updates Price of item, once found
	$Updater = "UPDATE `$searchType`
       		SET `Price` = $Price 
       		WHERE `$IDType` = '$ID';";

	mysql_query($Updater);
	mysql_close();
?>
</body>
</html>
