<!DOCTYPE html>
<html>
<body>

<h1> Toy Company ABC</h1>

<?php
	echo "Show all information of company product";
	
	//Refere to database 
	$db = parse_url(getenv("DATABASE_URL"));
	$pdo = new PDO("pgsql:" . sprintf(
	    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
	    $db["host"],
	    $db["port"],
	    $db["user"],
	    $db["pass"],
	    ltrim($db["path"], "/")
	));
	//you sql query
	$sql = "SELECT ID, Name, Price, Total FROM Product";

	$stmt = $pdo->prepare($sql);
	//execute the query on the server and return the result set
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();
	$resultSet = $stmt->fetchAll();
	//display the data 
?>
<ul>
	<?php
		foreach ($resultSet as $row) {
			echo "<li>" .
				$row["ID"] . '--'. $row["Name"] . '--'. $row["Price"] . '--'. $row["Total"]
			. "</li>";
		}
	?>
</ul>

</body>
</html>