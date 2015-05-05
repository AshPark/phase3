<html>
<body>


<!-----Variable Declaration---------->
<?php
//Connect to Database
$username="root";$password="1234";$database="hw3";

$F2Allergen="";
$F2Allergen_error="";
$F2Allergen_pets = array();
$F4PID = "";
$F4PID_error="";
$F4PID_toys=array();
$F8ID="";
$F8ID_error="";
$F12Supplier_Name="";
$F12Supplier_Name_error="";
$F12ID="";
$F12ID_error="";
$F12Quantity = 0;
$F12Quantity_error="";
$F13ID = "";
$F13Lifetime=0;
$F13Allergens = "";
$F13Price = 0.0;
$F13ID_error = "";
$F13Lifetime_error = "";
$F13Allergens_error = "";
$F13Price_error = "";

error_reporting( error_reporting() & ~E_NOTICE );
?>
<!-----End Variable Declaration------->



<!----------Whenever submitted by POST this will run to "clean" the data------>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    //Cleaner function for CompareByAllergen
    if(empty($_POST["F2allergen"]))
    {
		//$F2Allergen_error = "You must enter an allergen";
	}
	else
	{
		$F2Allergen = test_text($_POST["F2allergen"]);
		if($F2Allergen != "Dander" && $F2Allergen != "Dandruff")
		{
			$F2Allergen_error = "The allergen must be dander or dandruff";
			$F2Allergen = "";
		}
	}
	//End Cleaner Function for CompareByAllergen

	//Cleaner function for FindFavoriteToy
    if(empty($_POST["F4PID"]))
    {
		//$F4PID_error = "You must enter an Pet ID";
	}
	else
	{
		$F4PID = test_ID($_POST["F4PID"]);
		mysql_connect('localhost',$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");

		$F4Query = "SELECT Pet.PID
			FROM Pet
			WHERE Pet.PID = '$F4PID'";

		$F4Result = mysql_query($F4Query) or die(mysql_error());
		if(mysql_num_rows($F4Result) == 0)
		{
			$F4PID_error = "There is no pet with PID = $F4PID";
		 	$F4PID = "";
		}
	}
	//End Cleaner Function for FindFavoriteToy

	//Cleaner function for FindPrice
    if(empty($_POST["F8ID"]))
    {
		//$F8ID_error = "You must enter an ID";
	}
	else
	{
		$F8ID = test_ID($_POST["F8ID"]);
		mysql_connect('localhost',$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");

		$F8Query = "SELECT Pet.PID
			FROM Pet
			WHERE Pet.PID = '$F8ID'";
		$F8Result = mysql_query($F8Query) or die(mysql_error());
		if(mysql_num_rows($F8Result) == 0)
		{
			$F8Query = "SELECT Toy.TID
				FROM Toy
				WHERE Toy.TID = '$F8ID'";
			$F8Result = mysql_query($F8Query) or die(mysql_error());
			if(mysql_num_rows($F8Result) == 0)
			{
				$F8Query = "SELECT Food.FID
					FROM Food
					WHERE Food.FID = '$F8ID'";

				$F8Result = mysql_query($F8Query) or die(mysql_error());
				if(mysql_num_rows($F8Result) == 0)
				{
					$F8ID_error = "There is no product with ID = $F8ID";
					$F8ID = "";
				}

			}	
		
		}
	}
	//End Cleaner Function for FindPrice

	//Cleaner function for StockShelves
    if(empty($_POST["F12Supplier_Name"]) && empty($_POST["F12ID"])&& empty($_POST["F12Quantity"]))
    {
		//$F12Supplier_Name_error = "You must enter a Supplier";
		$F12Supplier_Name = "";
		$F12ID = "";
		$F12Quantity = "0";
	}
	else
	{
		if((!empty($_POST["F12Supplier_Name"]) )&& empty($_POST["F12ID"]) && empty($_POST["F12Quantity"]))
		{
			$F12Supplier_Name = test_Supplier_Name($_POST["F12Supplier_Name"]);
			mysql_connect('localhost',$username,$password);
			@mysql_select_db($database) or die( "Unable to select database");

			$F12Query = "SELECT Supplier.Name
				FROM Supplier
				WHERE Supplier.Name = '$F12Supplier_Name'";

			$F12Result = mysql_query($F12Query) or die(mysql_error());
			if(mysql_num_rows($F12Result) == 0)
			{
				$F12Supplier_Name_error = "There is no Supplier named $F12Supplier_Name";
			 	$F12Supplier_Name = "";
			}
		}
		else
		{
			if(empty($_POST["F12Supplier_Name"]) && !empty($_POST["F12Quantity"]) && !empty($_POST["F12ID"]))
			{
				//$F12Supplier_Name = "PleaseNotYet";
				$F12ID = test_ID($_POST["F12ID"]);
				$F12Quantity = test_ID($_POST["F12Quantity"]);
				mysql_connect('localhost',$username,$password);
				@mysql_select_db($database) or die( "Unable to select database");

				$F12Query = "SELECT Toy.TID
					FROM Toy
					WHERE Toy.TID = '$F12ID'";
				$F12Result = mysql_query($F12Query) or die(mysql_error());
				if(mysql_num_rows($F12Result) == 0)
				{
					$F12Query = "SELECT Food.FID
						FROM Food
						WHERE Food.FID = '$F12ID'";

					$F12Result = mysql_query($F12Query) or die(mysql_error());
					if(mysql_num_rows($F12Result) == 0)
					{
						$F12ID_error = "There is no product with ID = $F12ID";
						$F12ID = "";
					}
				}	
			}
			else
			{
				$F12Supplier_Name = test_Supplier_Name($_POST["F12Supplier_Name_catch"]);
				$F12ID_error = "Please enter both an ID and a Quantity";
			}
		}
	}
	//End Cleaner Function for StockShelves

	//Cleaner function for AddNewPet
    if(empty($_POST["F13ID"])||empty($_POST["F13Price"])||empty($_POST["F13Lifetime"]))
    {
		//$F12Supplier_Name_error = "You must enter a Supplier";
	}
	else
	{
		$F13ID = test_ID($_POST["F13ID"]);
		$F13Price = test_Supplier_Name($_POST["F13Price"]);
		$F13Lifetime = test_Supplier_Name($_POST["F13Lifetime"]);
		$F13Allergens = test_text($_POST["F13Allergens"]);
		if($F13Allergens != "Dander" && $F13Allergens != "Dandruff" && $F13Allergens != "")
		{
			$F13Allergens_error = "The allergen must be dander or dandruff";
			$F13Allergens = "";
		}
		mysql_connect('localhost',$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");
		$F13Query = "SELECT Pet.PID
						FROM Pet
						WHERE Pet.PID = '$F13ID'";
		$F13Result = mysql_query($F13Query) or die(mysql_error());
		if(mysql_num_rows($F12Result) != 0)
		{
			$F13ID_error = "There is already a pet with ID = $F13ID";
			$F13ID = "";
		}
	}
	//End Cleaner Function for AddNewPet
}

//Sub Functions of text cleaner function
//Converts all input to harmless lowercase output with first letter capitalized
function test_text($data) 
{
	$data = strtolower($data);
	$data = ucfirst($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function test_Supplier_Name($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function test_ID($data) 
{
	$data = strtoupper($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>
<!---------End text cleaning function------------------------>


<form action="goats1.php" method="get">
What type of pet are you looking for: <select name="type">
  <option value="">Select...</option>
  <option value="Mammal">Mammal</option>
  <option value="Fish">Fish</option>
  <option value="Bird">Bird</option>
  <option value="Reptile">Reptile</option>
</select>
<input type="submit">
</form>

<form action="goats1.php" method="get">
Enter the ID# of the toy:<br><input type="text" name="tid" id="tid" value=""><br>
<input type="radio" name="option"
<?php if (isset($option) && $option=="sell") echo "checked";?>
value="sell">Sell <br>
<input type="radio" name="option"
<?php if (isset($option) && $option=="supplier") echo "checked";?>
value="supplier">Find supplier<br>
<input type="submit">
<br>
<br>
</form>

<form action="goats1.php" method="get">
Enter the ID# of the food:<br><input type="text" name="fid" id="fid" value=""><br>
<input type="radio" name="option1"
<?php if (isset($option1) && $option1=="sell") echo "checked";?>
value="sell">Sell<br>
<input type="radio" name="option1"
<?php if (isset($option1) && $option1=="supplier") echo "checked";?>
value="supplier">Find supplier<br>
<input type="submit">
<br>
<br>
</form>

<form action="goats1.php" method="get">
Enter the ID# of the pet:<br><input type="text" name="pid" id="pid" value=""><br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="food") echo "checked";?>
value="food">Find favorite food <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="care") echo "checked";?>
value="care">Find caretaker <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="supplier") echo "checked";?>
value="supplier">Find supplier <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="sell") echo "checked";?>
value="sell">Sell<br>
<input type="submit">
</form>

<form action="badFood.php">
	<button>Find Expired Food</button>
</form>

<form action="Caretaker.php">
	<button>Hire A Caretaker</button>
</form>

<form action = "ChangePrice.php">
	<button>Change Price of an Item</button>
</form>

<form action="CountPets.php">
	<button>Count Pets</button>
</form>

<!---------------Aaron's Stuff-------------------->

<!----Function 2: Compare Pets By Allergen------>
<div id="Function2" style= "border-top: 2px solid black; display:table; padding: 10px;">
<h4>
Compare Pets By Allergen
</h4>
<!----Error message if input is empty---->
<div id="Function2Error" style ="color:red; font-style:italic;">
<?php
echo "$F2Allergen_error";
?>
</div>
<!---End Error Message------>

<form id="CompareByAllergen" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Enter the allergen you would like to avoid(Dander or Dandruff) <br> <input type="text" name="F2allergen" id="F2allergen" value = ""><br>
<input type="submit">
</form>

<?php
if($F2Allergen_error == "" && $F2Allergen != "")
{
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$F2Query = "SELECT Pet.PID, Pet.price 
			  FROM Pet, Pet_Allergens 
			  WHERE Pet.PID = Pet_Allergens.PID AND Pet_Allergens.Allergen = '$F2Allergen'";

	$F2Result = mysql_query($F2Query) or die(mysql_error());
	echo "Pets without $F2Allergen<br>"; 

	echo "<table border='1'><tr>"; 
	echo "<td>PID</td>";
	echo "<td>Price</td>";
	for($F2j=0;$j<$F2Fields_num;$F2j++)
	{
		$F2Field = mysql_fetch_field($F2Result);
		echo "<td>{$F2Field->name}</td>";
	}	
	echo "</tr>\n";
	$F2counter = 1;
	while($F2Row = mysql_fetch_row($F2Result))
	{
		echo "<tr>";
		foreach($F2Row as $F2Cell)
		{
			if($F2counter%2)
			{
				echo"<td>$F2Cell</td>";
			}
			else
			{
				echo"<td>$$F2Cell</td>";
			}
			$F2counter=$F2counter+1;
		}
		echo"</tr>";
	}
	echo"</table>";
}

?>
</div>
<!----End Function 2: Compare Pets By Allergen----->


<!----Function 4: Find Favorite Toy------>
<div id="Function4" style= "border-top: 2px solid black; display:table; padding: 10px;">
<h4>
Find A Pets Favorite Toy
</h4>
<!----Error message if input is empty---->
<div id="Function4Error" style ="color:red; font-style:italic;">
<?php
echo "$F4PID_error";
?>
</div>
<!---End Error Message------>

<form id="FindFavoriteToy" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Enter the Pet's ID Number to see its favorite toys <br> <input type="text" name="F4PID" id="F4PID" value = ""><br>
<input type="submit">
</form>

<?php
if($F4PID_error == "" && $F4PID != "")
{
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$F4Query = "SELECT Toy.TID, Toy.Name, Toy.Quantity, Toy.Price
			  FROM PlaysWith, Toy 
			  WHERE PlaysWith.TID = Toy.TID AND PlaysWith.PID = '$F4PID'";

	$F4Result = mysql_query($F4Query) or die(mysql_error());
	echo "The pet $F4PID likes<br>"; 

	echo "<table border='1'><tr>"; 
	echo "<td>TID</td>";
	echo "<td>Name</td>";
	echo "<td>Quantity</td>";
	echo "<td>Price</td>";
	for($F4j=0;$F4j<$F4Fields_num;$F4j++)
	{
		$F4Field = mysql_fetch_field($F4Result);
		echo "<td>{$F4Field->name}</td>";
	}	
	echo "</tr>\n";

	$F4counter = 1;
	while($F4Row = mysql_fetch_row($F4Result))
	{
		echo "<tr>";
		foreach($F4Row as $F4Cell)
		{
			if($F4counter%4==0)
			{
				echo"<td>$$F4Cell</td>";
			}
			else
			{
				echo"<td>$F4Cell</td>";
			}
			$F4counter=$F4counter+1;
		}
		echo"</tr>";
	}
	echo"</table>";
}

?>
</div>
<!----End Function 4: Find Favorite Toy----->

<!----Function 8: Find Price------>
<div id="Function8" style= "border-top: 2px solid black; display:table; padding: 10px;">
<h4>
Find A Price
</h4>
<!----Error message if input is empty---->
<div id="Function8Error" style ="color:red; font-style:italic;">
<?php
echo "$F8ID_error";
?>
</div>
<!---End Error Message------>

<form id="FindPrice" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Enter an ID number to see the items price <br> <input type="text" name="F8ID" id="F8ID" value = ""><br>
<input type="submit">
</form>

<?php
if($F8ID_error == "" && $F8ID != "")
{
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$F8Query = "SELECT Pet.PID
		FROM Pet
		WHERE Pet.PID = '$F8ID'";
	$F8Result = mysql_query($F8Query) or die(mysql_error());
	if(mysql_num_rows($F8Result) == 0)
	{
		$F8Query = "SELECT Toy.TID
			FROM Toy
			WHERE Toy.TID = '$F8ID'";
		$F8Result = mysql_query($F8Query) or die(mysql_error());
		if(mysql_num_rows($F8Result) == 0)
		{
			$F8Query = "SELECT Food.FID
				FROM Food
				WHERE Food.FID = '$F8ID'";

			$F8Result = mysql_query($F8Query) or die(mysql_error());
			if(mysql_num_rows($F8Result) == 0)
			{

			}
			else
			{
				$F8Query = "SELECT Food.FID, Food.Name, Food.Price
					FROM Food 
					WHERE Food.FID = '$F8ID'";
				$F8Result = mysql_query($F8Query) or die(mysql_error());
				echo "$F8ID<br>"; 
				echo "<table border='1'><tr>"; 
				echo "<td>ID</td>";
				echo "<td>Name</td>";
				echo "<td>Price</td>";
			}
		}
		else
		{
			$F8Query = "SELECT Toy.TID, Toy.Name, Toy.Price
				FROM Toy 
				WHERE Toy.TID = '$F8ID'";
			$F8Result = mysql_query($F8Query) or die(mysql_error());
			echo "$F8ID<br>"; 
			echo "<table border='1'><tr>"; 
			echo "<td>ID</td>";
			echo "<td>Name</td>";
			echo "<td>Price</td>";
		}
	}
	else
	{
		$F8Query = "SELECT Pet.PID, Pet.Price
			FROM Pet 
			WHERE Pet.PID = '$F8ID'";
		$F8Result = mysql_query($F8Query) or die(mysql_error());
		echo "$F8ID<br>"; 
		echo "<table border='1'><tr>"; 
		echo "<td>ID</td>";
		echo "<td>Price</td>";
	}


	for($F8j=0;$F8j<$F8Fields_num;$F8j++)
	{
		$F8Field = mysql_fetch_field($F8Result);
		echo "<td>{$F8Field->name}</td>";
	}	
	echo "</tr>\n";

	$F8counter = 1;
	while($F8Row = mysql_fetch_row($F8Result))
	{
		echo "<tr>";
		foreach($F8Row as $F8Cell)
		{
			if($F8counter%4==0)
			{
				echo"<td>$$F8Cell</td>";
			}
			else
			{
				echo"<td>$F8Cell</td>";
			}
			$F8counter=$F8counter+1;
		}
		echo"</tr>";
	}
	echo"</table>";
}

?>
</div>
<!----End Function 8: FindPrice----->

<!----Function 13: AddNewPet------>
<div id="Function13" style= "border-top: 2px solid black; display:table; padding: 10px;">
<h4>
Add A New Pet
</h4>
<!----Error message if input is empty---->
<div id="Function13Error" style ="color:red; font-style:italic;">
<?php
echo "$F13ID_error";
echo "$F13Lifetime_error";
echo "$F13Allergens_error";
echo "$F13Price_error";
?>
</div>
<!---End Error Message------>

<form id="AddNewPet" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Enter the NewID Number <input type="text" maxlength="10" name="F13ID" id="F13ID" value = ""><br>
Enter the pets Price $<input type="number" min="0" step="0.01" name="F13Price" id="F13Price" value = ""><br>
Enter the pets Lifetime(years) <input type="number" min="0" step="0.25" name="F13Lifetime" id="F13Lifetime" value = ""><br>
Enter the pets Allergens <input type="text" name="F13Allergens" id="F13Allergens" value = ""><br>
<input type="submit">
</form>

<?php
if($F13ID_error == "" && $F13Price_error == "" && $F13Lifetime_error == "" && $F13ID !="")
{
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$F13Query = "INSERT into Pet 
				Values ('$F13ID','$F13Price', '$F13Lifetime')";
	$F13Result = mysql_query($F13Query) or die(mysql_error());

	if($F13Allergens != "")
	{
		$F13Query2 = "INSERT into Pet_Allergens
				Values ('$F13ID', '$F13Allergens')";
		$F13Result2 = mysql_query($F13Query2) or die(mysql_error());
	}	
}

?>
</div>
<!----End Function 13: Compare Pets By Allergen----->

<!----Function 12: StockShelves------>

<div id="Function12" style= "border-top: 2px solid black; display:table; padding: 10px;">
<h4>
Add Stock To Inventory
</h4>
<?php
    if ($F12Supplier_Name =="" ) {
?>


<!----Error message if input is empty---->
<div id="Function12Error" style ="color:red; font-style:italic;">
<?php
echo "$F12Supplier_Name_error";
?>
</div>
<!---End Error Message------>



<form id="StockShelves" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Enter the Suppliers Name <br> <input type="text" name="F12Supplier_Name" id="F12Supplier_Name" value = ""><br>
<input type="submit">
</form>
<?php
}
if($F12Supplier_Name_error == "")
{
	if($F12Supplier_Name_error == "" && $F12Supplier_Name != "")
	{

		mysql_connect('localhost',$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");

		$F12Query = "SELECT SuppToys.TID
			FROM SuppToys
			WHERE SuppToys.SuppName = '$F12Supplier_Name'";
		$F12Result = mysql_query($F12Query) or die(mysql_error());
		if(mysql_num_rows($F12Result) != 0)
		{
			echo "Products from: $F12Supplier_Name <br>"; 
			echo "<table border='1'><tr>"; 
			echo "<td>TID</td>";
			for($F12j=0;$F12j<$F12Fields_num;$F12j++)
			{
				$F12Field = mysql_fetch_field($F12Result);
				echo "<td>{$F12Field->name}</td>";
			}	
			echo "</tr>\n";
			while($F12Row = mysql_fetch_row($F12Result))
			{
				echo "<tr>";
				foreach($F12Row as $F12Cell)
				{
						echo"<td>$F12Cell</td>";
				}
				echo"</tr>";
			}
			echo"</table>";
		}

		$F12Query = "SELECT SuppFood.FID
			FROM SuppFood
			WHERE SuppFood.SuppName = '$F12Supplier_Name'";
		$F12Result = mysql_query($F12Query) or die(mysql_error());
		if(mysql_num_rows($F12Result) != 0)
		{
			echo "Products from: $F12Supplier_Name <br>"; 
			echo "<table border='1'><tr>"; 
			echo "<td>FID</td>";
			for($F12j=0;$F12j<$F12Fields_num;$F12j++)
			{
				$F12Field = mysql_fetch_field($F12Result);
				echo "<td>{$F12Field->name}</td>";
			}	
			echo "</tr>\n";
			while($F12Row = mysql_fetch_row($F12Result))
			{
				echo "<tr>";
				foreach($F12Row as $F12Cell)
				{
						echo"<td>$F12Cell</td>";
				}
				echo"</tr>";
			}
			echo"</table>";
		}

	}
	if ($F12ID =="" && $F12Supplier_Name != "" ) 
	{
		?>
		<br>
		<div id="Function12Error" style ="color:red; font-style:italic;">
		<?php
		echo "$F12ID_error";
		?>
		</div>
		<form id="StockShelves2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		Enter the ID of the product and the amount you would like to add to stock <br> <input type="text" name="F12ID" id="F12ID" value = "">
		<input type="number" name = "F12Quantity" id="F12Quantity" value = "">
		<input type="hidden" name = "F12Supplier_Name_catch" id="F12Supplier_Name_catch" value ="<?php echo $F12Supplier_Name ?>">
		<input type="submit">
		</form>
		<?php
		
	}
	if($F12ID != "")
	{
		mysql_connect('localhost',$username,$password);
		@mysql_select_db($database) or die( "Unable to select database");

		$F12Query = "SELECT Toy.TID
			FROM Toy
			WHERE Toy.TID = '$F12ID'";
		$F12Result = mysql_query($F12Query) or die(mysql_error());
		if(mysql_num_rows($F12Result) == 0)
		{

			$F12Query = "SELECT Food.FID
			FROM Food
			WHERE Food.FID = '$F12ID'";

			$F12Result = mysql_query($F12Query) or die(mysql_error());
			if(mysql_num_rows($F12Result) == 0)
			{

			}
			else
			{
				$F12Query = "UPDATE Food 
					SET Quantity=Quantity+'$F12Quantity'
					WHERE FID = '$F12ID'";
				$F12Result = mysql_query($F12Query) or die(mysql_error());
				$F12Supplier_Name = "";
				$F12ID = "";
				$F12Quantity = "0";
				location.reload();
			}
		}
		else
		{
			$F12Query = "UPDATE Toy 
				SET Quantity=Quantity+'$F12Quantity' 
				WHERE TID = '$F12ID'";
			$F12Result = mysql_query($F12Query) or die(mysql_error());
			$F12Supplier_Name = "";
			$F12ID = "";
			$F12Quantity = "0";
			location.reload();
		}
	}
}	
?>
</div>

<!----End Function 12: StockShelves----->


<!--------------End Aaron's Functions------------->

</body>
</html>
