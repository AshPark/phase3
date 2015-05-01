<html>
<body>





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

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
Enter the allergen you would like to avoid: <br> <input type="text" name="allergen" id="allergen" value = ""><br>
<input type="submit">
</form>

</body>
</html>
