<?php
	$username="root";$password="1234";$database="hw3";
	#mysql_connect('localhost');
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");
	
	if((isset($_GET['type']))and( $_GET['type']!=""))
	{	
		$type = $_GET['type'];
		echo "Your selection: $type<br>";

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
	
	if((isset($_GET['tid']))and($_GET['tid']!="")and(isset($_GET['option'])))
	{
		if($_GET['option']=="price")
		{
			echo "The look up price of toy function goes here.";
		}
		else if($_GET['option']=="priceFix")
		{
			echo "The change price of a toy function goes here.";
		}
		else if($_GET['option']=="sell")
		{
			echo "The sell a toy function goes here.";
		}
		else if($_GET['option']=="quantity")
		{
			echo "The change quantity of a toy function goes here.";
		}
		else if($_GET['option']=="supplier")
		{
			echo "The find supplier of a toy function goes here.";
		}
	}
	
	if((isset($_GET['fid']))and($_GET['fid']!="")and(isset($_GET['option1'])))
	{
		if($_GET['option1']=="price")
		{
			echo "The look up price of food function goes here.";
		}
		else if($_GET['option1']=="priceFix")
		{
			echo "The change price of a food function goes here.";
		}
		else if($_GET['option1']=="sell")
		{
			echo "The sell a food function goes here.";
		}
		else if($_GET['option1']=="quantity")
		{
			echo "The change quantity of a food function goes here.";
		}
		else if($_GET['option1']=="supplier")
		{
			echo "The find supplier of a food function goes here.";
		}
	}
	
	
	if((isset($_GET['pid']))and($_GET['pid']!="")and(isset($_GET['option2'])))
	{
		if($_GET['option2']=="price")
		{
			echo "Look up price of pet goes here.";
		}
		else if($_GET['option2']=="food")
		{
			$pid = $_GET['pid'];
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
		else if($_GET['option2']=="toy")
		{
			echo "The find favorite toy function goes here.";
		}
		else if($_GET['option2']=="care")
		{
			$pid = $_GET['pid'];
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
		else if($_GET['option2']=="supplier")
		{
			echo "The find supplier of pet function goes here";
		}
		else if($_GET['option2']=="priceFix")
		{
			echo "The change price of pet function goes here.";
		}
		else if($_GET['option2']=="sell")
		{
			echo "The sell a pet function goes here.";
		}
	}
	if( isset($_GET['alg']))
	{
		echo "The allergen function goes here.";
	}
?>