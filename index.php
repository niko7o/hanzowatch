<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Overwatch Tracker</title>
	<link rel="stylesheet" href="css/estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>
    
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="buscar.php">Battletag</a></li>
        <li><a href="patch.php">Patch</a></li>
        <li><a href="http://www.nikoto.org/bootgenji/forums" target="_blank">Forums</a></li>
    </ul>
</nav>
    
<div class="formulario">
    <div class="warning centrado">
        <h3>Use - instead of # when searching your BattleTag.</h3>
    </div>
	<form id="battletag" action="index.php" method="get">
	    BattleTag: <input type="text" name="player" id="battletagplayer"> 
        <input type="submit" id="lupa" value="Search">
	</form>
</div>

<!-- Battletag search -->
<?php
	$player = $_GET['player'];
    $region = 'eu';

    $response = get_web_page("http://owapi.net/api/v3/u/".$player."/blob");
    $response = json_decode($response);
    
	$data = $response;

	$competitive_overall_stats = $data->$region->stats->competitive->overall_stats;
	$competitive_game_stats = $data->$region->stats->competitive->game_stats;
	
	$quickplay_overall_stats = $data->$region->stats->quickplay->overall_stats;
	$quickplay_game_stats = $data->$region->stats->quickplay->game_stats;


    if(isset($player)){
        if($data){
            echo '<div class="niko" style="margin:0 auto;text-align:center">';
	        	echo '<img src='.$competitive_overall_stats->avatar .' alt="avatar" /><br>';
	            echo 'ELO Ranking: ' . $competitive_overall_stats->comprank .'<br>';
	            echo 'Level: ' . $competitive_overall_stats->level .'<br>'; 

            	echo 'Wins: ' . $competitive_overall_stats->wins .'<br>';
                echo 'Losses: ' . $competitive_overall_stats->losses .'<br>';
                echo 'Games: ' . $competitive_overall_stats->games .' - Winrate: '. $competitive_overall_stats->win_rate .'%<br>';               

            	echo 'Wins: ' . $quickplay_overall_stats->wins .'<br>';
                echo 'Losses: ' . $quickplay_overall_stats->losses .'<br>';
                echo 'Games: ' . $quickplay_overall_stats->games .' - Winrate: '. $quickplay_overall_stats->win_rate .'%<br>';
            echo '</div>';

        } else{
            echo "<div style='color:red' class='niko'>The BattleTag entered is incorrect. Try again.</div>";
        }
    } else {
        echo "<div class='niko'>Por favor, elige un nombre de perfil..</div>";
    }
    
	function get_web_page($url) {
	    $options = array(
	        CURLOPT_RETURNTRANSFER => true,   // return web page
	        CURLOPT_HEADER         => false,  // don't return headers
	        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
	        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
	        CURLOPT_ENCODING       => "",     // handle compressed
	        CURLOPT_USERAGENT      => "CodeNiko Overwatch", // name of client
	        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
	        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
	        CURLOPT_TIMEOUT        => 120,    // time-out on response
	);

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    
    $content  = curl_exec($ch);
    curl_close($ch);

    return $content;
    }
?>

<div class="preloader"></div>

</body>
</html>