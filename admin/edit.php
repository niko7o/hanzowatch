<?php
include_once("config.php");// including the database connection file

if(isset($_POST['update'])){	
	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	$hero = mysqli_real_escape_string($mysqli, $_POST['hero']);
	$counter = mysqli_real_escape_string($mysqli, $_POST['counter']);
	$description = mysqli_real_escape_string($mysqli, $_POST['description']);	
	
	if(empty($id) || empty($hero) || empty($counter) || empty($description)) {
		echo "<font color='red'>Some fields need to be completed.</font><br/>";
		echo "<br/><a href='javascript:self.history.back();'>Return</a>";		
	} else {	
		$result = mysqli_query($mysqli, "UPDATE counters SET id='$id',hero='$hero',counter='$counter',description='$description' WHERE id=$id");
		header("Location: index.php");
	}
}
?>
<?php

$id = $_GET['id'];//getting id from url
$result = mysqli_query($mysqli, "SELECT * FROM counters WHERE id=$id");//selecting data associated with this particular id

while($res = mysqli_fetch_array($result)){
	$id = $res['id'];
	$hero = $res['hero'];
	$counter = $res['counter'];
	$description = $res['description'];
}

?>

<html>
<head>	
	<title>Edit Counter</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>

<body>
	<a href="index.php"><button style="padding:10px 20px;">Home</button></a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>ID</td>
				<td><input type="text" name="id" value="<?php echo $id;?>"></td>
			</tr>
			<tr> 
				<td>Hero</td>
				<td><input type="text" name="hero" value="<?php echo $hero;?>"></td>
			</tr>
			<tr> 
				<td>Counter</td>
				<td><input type="text" name="counter" value="<?php echo $counter;?>"></td>
			</tr>
			<tr> 
				<td>Description</td>
				<td><input type="text" name="description" value="<?php echo $description;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
