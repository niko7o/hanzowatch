<?php
include_once("config.php"); //including the database connection file
$result = mysqli_query($mysqli, "SELECT * FROM counters ORDER BY id ASC"); //our overwatch counters query
?>

<html>
<head>	
	<title>AdminCP</title>
	<style>
		body{font-family:'Arial';}
		tr{width:100%;padding:1em;}
		tr:nth-child(odd){background-color:#dadada;}
		td,th{height:42px;width:20%;text-align:center;}
	</style>
</head>

<body>
<a href="/admin/add.html"><button style="padding:10px 20px;">New Counter</button></a><br/><br/>
	<table width='100%' border=0>
		<tr bgcolor='#CCCCCC'>
			<th>ID</th>
			<th>Hero</th>
			<th>Counter</th>
			<th>Description</th>
			<th>Options</th>
		</tr>
		
		<?php 
		while($res = mysqli_fetch_array($result)) { 		
			echo "<tr>";
			echo "<td>".$res['id']."</td>"; //res is the same as row but stands for result
			echo "<td>".$res['hero']."</td>";
			echo "<td>".$res['counter']."</td>";
			echo "<td>".$res['description']."</td>";
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>"; //we pick up the id via a GET url and return a confirmation dialog on delete
		}
		?>
	</table>
</body>
</html>
