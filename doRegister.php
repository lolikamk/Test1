<!DOCTYPE html>
<html>
<head>
	<title>Processing</title>
</head>
<body>
	<?php 
		$name = $_POST["txtName"];
		$course = $_POST["cbCourse"];	
		$birthday = $_POST["dob"];
		$gender = $_POST["gender"];
		$fav_book =$_POST["book"];
		$fav_car = $_POST["car"];
		$fav = $fav_book . "," . $fav_car;
		echo $name;
		
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
	   $data = [
		    'name' => $name,
		    'course' => $course,
		    'dob' => $birthday,
		    'gender' => $gender,
		    'fav' => $fav
		];
		$stmt =  $pdo->prepare("INSERT INTO registercourse(studentname, course, dob,gender,fav) VALUES (:name,:course,:dob,:gender,:fav)");	
		$stmt->execute($data);

	 ?>
	 <h2>Thank you <?php echo $name?>  for registering 
	 		<?php echo $course?>
	 </h2>
	 <ul>
	 	<li><?php echo $birthday?></li>
	 	<li><?php echo $gender?></li>
	 	<li><?php echo $fav_book?></li>
	 	<li><?php echo $fav_car?></li>
	 </ul>
	 <a href="index.php">Index</a>
</body>
</html>