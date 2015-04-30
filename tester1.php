<?php
	$username="root";$password="1234";$database="hw3";
	#mysql_connect('localhost');
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	if( isset($_POST['type']))
	{
		if ( $_POST['type']!="")
		{
			$type = $_POST['type'];
			echo "Your selection: $type";

			$result = mysql_query("SELECT * from $type t, pet p where t.PID=p.PID");
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
		}
		else
		{
			echo "Please specify a pet type!";
		}
	}
	if (isset($_POST['pid']))
	{
		if ( $_POST['pid']!="")
		{
			$pid = $_POST['pid'];
			echo "Care taker for PID: $pid";
			$result1 = mysql_query("SELECT Name, WeeklyHrs, HomePhone, WorkPhone from caretaker where PID='$pid'");
			$fields_num1 = mysql_num_fields($result1);
	
			echo "<table border='2'><tr>";
			for($j=0;$j<$fields_num1;$j++)
			{
			$field = mysql_fetch_field($result1);
			echo "<td>{$field->name}</td>";
			}
			echo "</tr>\n";
	
			while($row = mysql_fetch_row($result1))
			{
				echo "<tr>";
				foreach($row as $cell)
					echo"<td>$cell</td>";
			}
			mysql_free_result($result1);
		}
		else
		{
			echo "Please specify a Pet ID!";
		}
	
	}
	if( isset($_POST['pid1']))
	{
		if($_POST['pid1']!="")
		{
			$pid = $_POST['pid1'];
			echo "Favorite foods of PID: $pid";
			$result1 = mysql_query("SELECT e.PID, Name, Price from food f, eats e where PID='$pid'and f.FID=e.FID");
			$fields_num1 = mysql_num_fields($result1);
	
			echo "<table border='2'><tr>";
			for($j=0;$j<$fields_num1;$j++)
			{
				$field = mysql_fetch_field($result1);
				echo "<td>{$field->name}</td>";
			}
			echo "</tr>\n";
	
			while($row = mysql_fetch_row($result1))
			{	
				echo "<tr>";
				foreach($row as $cell)
					echo"<td>$cell</td>";
			}	
			mysql_free_result($result1);
		}
		else
		{
			echo "Please enter a Pet ID!";
		}
	}
?>
