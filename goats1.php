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
			$TID = $_GET['tid'];
			$sellToyquery = "SELECT TID, Quantity, Name, Price
						FROM `Toy`
						WHERE TID = '$TID';"; 
			$currentQuantity = "SELECT Quantity
								FROM `Toy`
								WHERE TID = '$TID';";

			$sellToyresult = mysql_query($sellToyquery);

			echo "<table border = '1'><tr>";
			echo "<td> Toy ID</td>";
			echo "<td>Quantity</td>";
			echo "<td>Name</td>";
			echo "<td>Price</td>";

    		while($F7rows = mysql_fetch_row($sellToyresult))
    		{
    			echo "<tr>";
    			foreach($F7rows as $F7Cell)
    					echo"<td>$F7Cell</td>";
    			echo "</tr>";
    		}
   
    		echo"</table> <br>";

    		echo'<form name = "changePrice" action="" method="post">
					Quantity to be sold: <input type="text" name="Quantity" id="Quantity"><br>
					<input type="submit" name = "changeQuantity" id = "changeQuantity" value = "Submit">
					</form>';
			$Quantitysold = $_POST['Quantity'];
			$Quantityresult = mysql_query($currentQuantity);
			while($row = mysql_fetch_assoc($Quantityresult))
			{
				$quantityNumerical = $row['Quantity'];
			}

			if($Quantitysold > $quantityNumerical)
				echo "Not enough in stock!";
			else
			{
				$finalQuantity = $quantityNumerical - $Quantitysold;
				$sellToy = "UPDATE `Toy`
       						SET `Quantity` = '$finalQuantity'
       						WHERE `TID` = '$TID'";

       			mysql_query($sellToy);
       			echo "Items sold! <br>";
       			echo "New Quantity: $finalQuantity";
			}

		}
		else if($_GET['option']=="quantity")
		{
			echo "The change quantity of a toy function goes here.";
		}
		else if($_GET['option']=="supplier")
		{
			$TID = $_GET['tid'];

			$sqlresult = "SELECT Name, Phone, Street, City, SuppState, Zip
    		 			  FROM `Supplier`, `SuppAddr`, `SuppToys`
    					  WHERE TID = '$TID' AND `SuppToys`.SuppName = `Supplier`.Name AND `SuppToys`.SuppName = `SuppAddr`.SuppName ";

    		$queryresult = mysql_query($sqlresult) or die(mysql_error());

    		echo "<table border = '1'><tr>";
    		echo "<td>Name</td>";
    		echo "<td>Phone Number</td>";
    		echo "<td>Street</td>";
    		echo "<td>City</td>";
    		echo "<td>State</td>";
    		echo "<td>Zip Code</td>";

    		while($F7rows = mysql_fetch_row($queryresult))
    		{
    			echo "<tr>";
    			foreach($F7rows as $F7Cell)
    					echo"<td>$F7Cell</td>";
    			echo "</tr>";
    		}
    		echo"</table>";
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
			$FID = $_GET['fid'];
			$sellFoodquery = "SELECT FID, Quantity, Name, Price
								FROM `Food`
								WHERE FID = '$FID'"; 

			$currentQuantity = "SELECT Quantity
								FROM `Food`
								WHERE FID = '$FID'";

			$sellFoodresult = mysql_query($sellFoodquery);

			echo "<table border = '1'><tr>";
			echo "<td> Food ID</td>";
			echo "<td>Quantity</td>";
			echo "<td>Name</td>";
			echo "<td>Price</td>";

    		while($F10rows = mysql_fetch_row($sellFoodresult))
    		{
    			echo "<tr>";
    			foreach($F10rows as $F10Cell)
    					echo"<td>$F10Cell</td>";
    			echo "</tr>";
    		}
    		echo"</table> <br>";

    		echo'<form name = "changePrice" action="" method="post">
					Quantity to be sold: <input type="text" name="Quantity" id="Quantity"><br>
					<input type="submit" name = "changeQuantity" id = "changeQuantity" value = "Submit">
					</form>';
			$Quantitysold = $_POST['Quantity'];
			$Quantityresult = mysql_query($currentQuantity);
			while($row = mysql_fetch_assoc($Quantityresult))
			{
				$quantityNumerical = $row['Quantity'];
			}

			if($Quantitysold > $quantityNumerical)
				echo "Not enough in stock!";
			else
			{
				$finalQuantity = $quantityNumerical - $Quantitysold;
				$sellToy = "UPDATE `Food`
       						SET `Quantity` = '$finalQuantity'
       						WHERE `FID` = '$FID'";

       			mysql_query($sellToy);
       			echo "Food sold! <br>";
       			echo "New Quantity: $finalQuantity";
			}

		}
		else if($_GET['option1']=="quantity")
		{
			echo "The change quantity of a food function goes here.";
		}
		else if($_GET['option1']=="supplier")
		{
			$FID = $_GET['fid'];

			$sqlresult = "SELECT Name, Phone, Street, City, SuppState, Zip
    		 			  FROM `Supplier`, `SuppAddr`, `SuppFood`
    					  WHERE FID = '$FID' AND `suppFood`.SuppName = `Supplier`.Name AND `suppFood`.SuppName = `SuppAddr`.SuppName ";

    		$queryresult = mysql_query($sqlresult) or die(mysql_error());

    		echo "<table border = '1'><tr>";
    		echo "<td>Name</td>";
    		echo "<td>Phone Number</td>";
    		echo "<td>Street</td>";
    		echo "<td>City</td>";
    		echo "<td>State</td>";
    		echo "<td>Zip Code</td>";

    		while($F7rows = mysql_fetch_row($queryresult))
    		{
    			echo "<tr>";
    			foreach($F7rows as $F7Cell)
    					echo"<td>$F7Cell</td>";
    			echo "</tr>";
    		}
    		echo"</table>";
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
			$PID = $_GET['pid'];

			$sqlresult = "SELECT Name, Phone, Street, City, SuppState, Zip
    		 			  FROM `Supplier`, `SuppAddr`, `SuppPets`
    					  WHERE PID = '$PID' AND `suppPets`.SuppName = `Supplier`.Name AND `suppPets`.SuppName = `SuppAddr`.SuppName ";

    		$queryresult = mysql_query($sqlresult) or die(mysql_error());

    		echo "<table border = '1'><tr>";
    		echo "<td>Name</td>";
    		echo "<td>Phone Number</td>";
    		echo "<td>Street</td>";
    		echo "<td>City</td>";
    		echo "<td>State</td>";
    		echo "<td>Zip Code</td>";

    		while($F7rows = mysql_fetch_row($queryresult))
    		{
    			echo "<tr>";
    			foreach($F7rows as $F7Cell)
    					echo"<td>$F7Cell</td>";
    			echo "</tr>";
    		}
    		echo"</table>";
		}

		else if($_GET['option2']=="priceFix")
		{
			echo "The change price of pet function goes here.";
		}
		else if($_GET['option2']=="sell")
		{
			$PID = $_GET['pid'];
			if(mysql_query("DELETE FROM pet WHERE pid='$PID'"))
				echo "$PID had been adopted!";	
		}
	}
	if( isset($_GET['alg']))
	{
		echo "The allergen function goes here.";
	}
?>
