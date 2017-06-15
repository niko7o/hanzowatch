<html>
<head>	
	<title>Counters</title>
	<link rel="stylesheet" href="../css/estilos.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/events.js"></script>
    <style>
    	table {margin-top:1em;width: auto !important;}
    	tr:nth-child(odd){background-color:#dadada;}
    	td {height:42px;text-align:center;}
    </style>
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

    <!-- Navigation -->
    <nav>
        <img src="../img/logo.png" id="logo" alt="Hanzowatch" />
        <div>
            <ul>
                <li><a href="https://www.codeniko.com/">Search</a></li>
                <li><a href="https://www.codeniko.com/forums" target="_blank">Forums</a></li>
                <li><a href="https://playoverwatch.com/en-us/game/patch-notes/pc/" target="_blank">Patchnotes</a></li>
                <li><a href="https://www.codeniko.com/counters/">Counters</a></li>
            </ul>
        </div>
    </nav>

    <!-- Player search form -->
    <div class="centrado960">
		<table width='100%' border=0>
			<tr bgcolor='#CCCCCC'>
				<td style="color: #e8c722;background-color:#301715;padding:1em;width:33%">Hero</td>
				<td style="color: #e8c722;background-color:#301715;padding:1em;width:33%">Counters</td>
				<td style="color: #e8c722;background-color:#301715;padding:1em;width:33%">Description</td>
			</tr>
			
			<?php 
				while($res = mysqli_fetch_array($result)) { 		
					echo "<tr style='width:100%'>";
						echo "<td style='width:33%'>".$res['hero']."</td>";
						echo "<td style='width:33%'>".$res['counter']."</td>";
						echo "<td style='width:33%'>".$res['description']."</td>";
					echo "</tr>";
				}
			?>
		</table>
    </div>

    <!-- Mobile -->
    <div class="scrollTop"><img src="../img/arrow.png"></div>
    <div class="open-nav"><img src="../img/nav.png"></div>
    <div class="close-nav"><img src="../img/close-nav.png"></div>

</body>
</html>
