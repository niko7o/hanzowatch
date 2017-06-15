<html>
<head>	
	<title>Counters</title>
</head>
<body>
	<?php
		$databaseHost = 'sql-10.proxgroup.fr:3306';
		$databaseName = 'nikotooo_hanzo';
		$databaseUsername = 'nikot_admin';
		$databasePassword = 'niko6695';

		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName) or die('dead');
		$result = mysqli_query($mysqli, "SELECT * FROM counters ORDER BY hero ASC");
	?>

	<table width='100%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>Hero</td>
			<td>Counter</td>
			<td>Description</td>
		</tr>
		
		<?php 
			while($res = mysqli_fetch_array($result)) { 		
				echo "<tr>";
					echo "<td>".$res['hero']."</td>";
					echo "<td>".$res['counter']."</td>";
					echo "<td>".$res['description']."</td>";
				echo "</tr>";
			}
		?>
	</table>
</body>
</html>
