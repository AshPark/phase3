<?php
    $username="root";$password="1234";$database="hw3";
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


<p>
What kind of pet are you looking for?
<select name="Type">
  <option value="">Select...</option>
  <option value="Mammal">Mammal</option>
  <option value="Fish">Fish</option>
  <option value="Bird">Bird</option>
  <option value="Reptile">Reptile</option>
</select>
</p>

This is my box
</p>
<form name="form" action="" method="get">
  <input type="text" name="subject" id="subject" value="">
</form>
<?php echo $_GET['subject']; ?>

</body>
</html>
