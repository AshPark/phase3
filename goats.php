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
	//End Cleaner Function for FindPrice
	
		}
	}
}

//Sub Function of text cleaner function
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
<?php if (isset($option) && $option=="price") echo "checked";?>
value="price">Look up price <br>
<input type="radio" name="option"
<?php if (isset($option) && $option=="priceFix") echo "checked";?>
value="priceFix">Change price <br>
<input type="radio" name="option"
<?php if (isset($option) && $option=="sell") echo "checked";?>
value="sell">Sell <br>
<input type="radio" name="option"
<?php if (isset($option) && $option=="quantity") echo "checked";?>
value="quantity">Change Quantity<br>
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
<?php if (isset($option1) && $option1=="price") echo "checked";?>
value="price">Look up price <br>
<input type="radio" name="option1"
<?php if (isset($option1) && $option1=="priceFix") echo "checked";?>
value="priceFix">Change price <br>
<input type="radio" name="option1"
<?php if (isset($option1) && $option1=="sell") echo "checked";?>
value="sell">Sell<br>
<input type="radio" name="option1"
<?php if (isset($option1) && $option1=="quantity") echo "checked";?>
value="quantity">Change quantity <br>
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
<?php if (isset($option2) && $option2=="price") echo "checked";?>
value="price">Look up price <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="food") echo "checked";?>
value="food">Find favorite food <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="toy") echo "checked";?>
value="toy">Find favorite toy <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="care") echo "checked";?>
value="care">Find caretaker <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="supplier") echo "checked";?>
value="supplier">Find supplier <br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="priceFix") echo "checked";?>
value="priceFix">Change price<br>
<input type="radio" name="option2"
<?php if (isset($option2) && $option2=="sell") echo "checked";?>
value="sell">Sell<br>
<input type="submit">
</form>

<form action="goats1.php" method="get">
Find pets without these allergens:<br><input type="text" name="alg" id="alg" value=""><br>
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

<form action="AddPet.php">
	<button>Add a new pet</button>
</form>

<form action="CountPets.php">
	<button>Count Pets</button>
</form>

<!---------------Aaron's Stuff-------------------->

<!----Function 2: Compare Pets By Allergen------>
<div id="Function2" style= "border-top: 2px solid black; display:table; padding: 10px;">

<!----Error message if input is empty---->
<div id="Function2Error" style ="color:red; font-style:italic;">
<?php
echo "$F2Allergen_error";
?>
</div>
<!---End Error Message------>

<form id="CompareByAllergen" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#CompareByAllergen" method="POST">
Enter the allergen you would like to avoid <br> <input type="text" name="F2allergen" id="F2allergen" value = ""><br>
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

<!----Error message if input is empty---->
<div id="Function4Error" style ="color:red; font-style:italic;">
<?php
echo "$F4PID_error";
?>
</div>
<!---End Error Message------>

<form id="FindFavoriteToy" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#FindFavoriteToy" method="POST">
Enter the Pet's ID Number to see his favorite toys <br> <input type="text" name="F4PID" id="F4PID" value = ""><br>
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
	for($F4j=0;$j<$F4Fields_num;$F4j++)
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
<!----End Function 4: Compare Pets By Allergen----->

<!----Function 8: Find Price------>
<div id="Function8" style= "border-top: 2px solid black; display:table; padding: 10px;">

<!----Error message if input is empty---->
<div id="Function8Error" style ="color:red; font-style:italic;">
<?php
echo "$F8ID_error";
?>
</div>
<!---End Error Message------>

<form id="FindPrice" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#FindPrice" method="POST">
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

<!--------------End Aaron's Functions------------->

</body>
</html>
