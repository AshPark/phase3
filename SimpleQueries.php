
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	</head>

<h1>
	Welcome to Goats and Giggles
</h1>

<body>

<div class="text">
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


Find a caretaker
<form name="FindCare" action="tester1.php" method="post">
Enter the ID of the pet:  <input type="text" name="pid" id="pid" value="">
</form>

Find the food a pet likes
<form name="FindFood" action="tester1.php" method="post">
Enter the ID of the pet:  <input type="text" name="pid1" id="pid1" value="">
</form>
</div>
</body>
</html>