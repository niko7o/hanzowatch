<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM counters ORDER BY id ASC"); // using mysqli_query instead
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="/admin/add.html">New Counter</a><br/><br/>
	<table width='100%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>ID</td>
			<td>Hero</td>
			<td>Counter</td>
			<td>Description</td>
			<td>Options</td>
		</tr>
		
		<?php 
		while($res = mysqli_fetch_array($result)) { 		
			echo "<tr>";
			echo "<td>".$res['id']."</td>";
			echo "<td>".$res['hero']."</td>";
			echo "<td>".$res['counter']."</td>";
			echo "<td>".$res['description']."</td>";
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		}
		?>
	</table>
</body>
</html>
