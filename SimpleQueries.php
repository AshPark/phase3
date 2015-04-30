
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>

<body>
	<?php
    $username="root";$password="1234";$database="Goats";
	#mysql_connect('localhost');
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
  	# operator
	print "<h1>Welcome to Goats and Giggles</h1>";

	$type = $_GET['subject'];
	
	$result = mysql_query("SELECT * from $type");
	$num = mysql_numrows($result);
	
	echo $num;
	
	$i=0;
	while($i<$num)
	{
	   $answer = mysql_result($result,$i);
	   echo $answer;
	   echo "\n";
	   $i =$i+1;
	}
	#echo mysql_query("SELECT PID from pet");
	
	mysql_close();
?>




<form action="tester1.php" method="post">
What type of pet are you looking for: <select name="type">
  <option value="">Select...</option>
  <option value="Mammal">Mammal</option>
  <option value="Fish">Fish</option>
  <option value="Bird">Bird</option>
  <option value="Reptile">Reptile</option>
</select>
<input type="submit">
</form>

</body>
</html>

Find a caretaker
<form name="FindCare" action="tester1.php" method="post">
Enter the ID of the pet:  <input type="text" name="pid" id="pid" value="">
</form>

Find the food a pet likes
<form name="FindFood" action="tester1.php" method="post">
Enter the ID of the pet:  <input type="text" name="pid1" id="pid1" value="">
</form>
