<html>
<body>

<!-----Variable Declaration---------->
<?php
$F2Allergen="";
$F2Allergen_error="";
$F2Allergen_pets = array();
?>
<!-----End Variable Declaration------->



<!----------Whenever submitted by POST this will run to "clean" the data------>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Cleaner function for CompareByAllergen
    if(empty($_POST["allergen"]))
    {
		$F2Allergen_error = "You must enter an allergen";
	}
	else
	{
		$F2Allergen = test_input($_POST["allergen"]);
		if($F2Allergen != "Dander" && $F2Allergen != "Dandruff")
		{
			$F2Allergen_error = "The allergen must be dander or dandruff";
			$F2Allergen = "";
		}
	}
	//End Cleaner Function for CompareByAllergen
	
}

//Sub Function of Cleaner Function
//Converts all input to harmless lowercase output with first letter capitalized
function test_input($data) 
{
	$data = strtolower($data);
	$data = ucfirst($data);
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

<form action="AddPet.php">
	<button>Add a new pet</button>
</form>

<!---------------Aaron's Stuff-------------------->

<!----Function 2: Compare Pets By Allergen------>
<div id="Function2" style= "border: 2px solid black; display:table; padding: 10px;">

<!----Error message if input is empty---->
<div id="Function2Error" style ="color:red; font-style:italic;">
<?php
echo "$F2Allergen_error";
?>
</div>
<!---End Error Message------>

<form id="CompareByAllergen" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#CompareByAllergen" method="POST">
Enter the allergen you would like to avoid <br> <input type="text" name="allergen" id="allergen" value = ""><br>
<input type="submit">
</form>

<?php
if($F2Allergen_error == "" && $F2Allergen != "")
{
	//Connect to Database
	$username="root";$password="1234";$database="hw3";
	#mysql_connect('localhost');
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$query = "SELECT Pet.PID 
			  FROM Pet, Pet_Allergens 
			  WHERE Pet.PID = Pet_Allergens.PID AND Pet_Allergens.Allergen = '$F2Allergen'";

	$result = mysql_query($query) or die(mysql_error());
	echo "Pets without $F2Allergen<br>"; 

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

?>
</div>
<!----End Function 2: Compare Pets By Allergen----->

<!--------------End Aaron's Functions------------->

</body>
</html>
