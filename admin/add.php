<html>
<head>
	<title>Add Counter</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$hero = mysqli_real_escape_string($mysqli, $_POST['hero']);
	$counter = mysqli_real_escape_string($mysqli, $_POST['counter']);
	$description = mysqli_real_escape_string($mysqli, $_POST['description']);
		
	// checking empty fields
	if(empty($hero) || empty($counter) || empty($description)) {
				
		if(empty($hero)) {
			echo "<font color='red'>hero field is empty.</font><br/>";
		}
		
		if(empty($counter)) {
			echo "<font color='red'>counter field is empty.</font><br/>";
		}
		
		if(empty($description)) {
			echo "<font color='red'>description field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO counters(id,hero,counter,description) VALUES('$id','$hero','$counter','$description')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
