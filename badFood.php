<?php	
	$username="root";$password="1234";$database="hw3";
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	if( isset($_GET['accept']))
	{
		if($_GET['accept']=='yes')
		{
			if(mysql_query("DELETE FROM food WHERE adddate(DatePurchased, INTERVAL shelflife month)<curdate()")
			)
				echo "The food has been deleted.";
		}
		if($_GET['accept']=='no')
			echo "The food will not be deleted.<br>";
	}
	
	$result = mysql_query("SELECT FID, adddate(DatePurchased, 
	INTERVAL shelflife month) as ExpirationDate FROM `food` WHERE adddate(DatePurchased, INTERVAL shelflife month)<curdate()");
	
		
	if(!isset($_GET['accept']))
		echo "These foods have expired!<br>";
	$fields_num = mysql_num_fields($result);	

	
	echo "<table border='1'><tr>";
	for($j=0;$j<$fields_num;$j++)
	{
		$field = mysql_fetch_field($result);
		echo "<td>{$field->name}</td>";
	}
	echo "</tr>\n";
	
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";
		foreach($row as $cell)
			echo"<td>$cell</td>";
	}
	mysql_free_result($result);
	
?>

<html>
	<head>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<div id = "mainbackground"></div>
</head>
<body>
<a href="goats.php">Back to Main Page</a><br>
<form action="badFood.php" method="get">
Would you like to delete this food?:<br><input type="radio" name="accept"
<?php if (isset($accept) && $accept=="yes") echo "checked";?>
value="yes">Yes
<input type="radio" name="accept"
<?php if (isset($accept) && $accept=="no") echo "checked";?>
value="no">No
<input type="submit">
</body>
</html>
