<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hanzowatch</title>
	<link rel="stylesheet" href="css/estilos.css">
    <meta charset="UTF-8">
    <meta name="description" content="overwatch tracker">
    <meta name="keywords" content="HTML,CSS,PHP,JavaScript">
    <meta name="author" content="Nikolaas Verlee">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>
    
<body>
    <!-- particles.js container
    <div id="particles-js"></div>
    -->
    <nav>
        <img src="img/logo.png" id="logo" alt="Hanzowatch" />
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="/forums" target="_blank">Forums</a></li>
            <li><a href="sitenews.php">Site news</a></li>
            <li><a href="account.php">Account</a></li>
        </ul>
    </nav>
    
    <div class="centrado960" style="background-color:#e6e6e6;">
        <h3 style="color:gray">Use - instead of # when searching your BattleTag.</h3>
        <form id="battletag" action="index.php" method="get">
            BattleTag: <input type="text" name="player" id="battletagplayer" placeholder="User-2122">
        <input type="submit" id="lupa" value="Search">
        </form>
    </div>

    <div class="heroes">
        <img src="img/heroes.png" alt="Overwatch heroes"/>
    </div>

<!-- Battletag search -->
<?php
	$player = $_GET['player']; //recogemos el battletag dado
    $region = 'eu'; //solo trabajamos con region europa por ahora

    $response = get_web_page("http://owapi.net/api/v3/u/".$player."/blob"); //llamada cURL
    $response = json_decode($response); //descodificamos el objeto devuelto con nuestra llamada
    
	$data = $response; //asignamos el objeto a la variable $data

    //creo atajos para la incrustación de datos dinámicos en mi PHP
	$competitive_overall_stats = $data->$region->stats->competitive->overall_stats;
	$competitive_game_stats = $data->$region->stats->competitive->game_stats;
	$quickplay_overall_stats = $data->$region->stats->quickplay->overall_stats;
	$quickplay_game_stats = $data->$region->stats->quickplay->game_stats;

    if(isset($player)){ //comprobamos si ha hecho una petición
        if($data){ //ya sabemos que hay petición. ¿Nos devuelve algo?
?>
            <div id="playerResults">
                <div id="competitive">
                    <span class="title">Competitive</span>
                    <ul>
                        <li> Games: <b><?php echo $competitive_overall_stats->games ?></b> </li>
                        <li> Wins: <b><?php echo $competitive_overall_stats->wins ?></b> </li>
                        <li> Losses: <b><?php echo $competitive_overall_stats->losses ?></b> </li>
                        <li> ELO Ranking: <b><?php echo $competitive_overall_stats->comprank ?></b> </li>
                    </ul>
                </div>
                <div id="quickplay">
                    <span class="title">Quickplay</span>
                    <ul>
                        <li> Games: <b><?php echo $quickplay_overall_stats->games ?></b> </li>
                        <li> Wins: <b><?php echo $quickplay_overall_stats->wins ?></b> </li>
                        <li> Losses: <b><?php echo $quickplay_overall_stats->losses ?></b> </li>
                        <li> Winrate: <b><?php echo $quickplay_overall_stats->win_rate ?>%</b></li>
                    </ul>
                </div>
            </div>

            <div id="gameResults" style="display:none">
                <div id="avatar"></div>
                <div id="champion">
                    <h1>general game statistics</h1>
                </div>
                <div id="data"></div>
            </div>

            <?php
            //array + foreach para recorrer datos variables de campeones
            $campeones = array("reinhardt","tracer","zenyatta","junkrat","mccree","winston","orisa","hanzo","pharah","roadhog","zarya","torbjorn","mercy","mei","ana","widowmaker","genji","reaper","soldier76","bastion","symmetra","dva","sombra","lucio");

            //forEach anidado con cada foto de campeon
            $fotosCampeones = array();
            
            foreach ($campeones as $campeon) {
                echo "<div class='heroResults' id='".$campeon."'>";
                    echo "<div id='avatar'>";
                        //foreach anidado imágenes de cada campeon
                    echo "</div>";
                    echo "<div id='champion'><h1>" . $campeon . "</h1></div>"; //nombre de cada campeon
                    
                    echo "<div id='data'>";
                        echo "<p> Eliminations: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->eliminations."</p>";
                        echo "<p> Deaths: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->deaths."</p>";
                        echo "<p> Total damage: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->damage_done."</p>";
                        echo "<p style='color:green'> Win ratio: ". 100*$data->$region->heroes->stats->competitive->$campeon->general_stats->win_percentage."%</p>";

                        echo "<p> Games played: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->games_played."</p>";
                        echo "<p> Games won: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->games_won."</p>";
                        echo "<p style='color:orange'> K/D: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->eliminations_per_life."</p>";
                        echo "<p> Most damage: ". $data->$region->heroes->stats->competitive->$campeon->general_stats->damage_done_most_in_game."</p>";

                        echo "<p> Eliminations: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->eliminations."</p>";
                        echo "<p> Deaths: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->deaths."</p>";
                        echo "<p> Total damage: ".$data->$region->heroes->stats->competitive->$campeon->general_stats->damage_done."</p>";
                        echo "<p> Win ratio: ". 100*$data->$region->heroes->stats->competitive->$campeon->general_stats->win_percentage."%</p>";
                    echo "</div>";
                echo "</div>";//fin heroResults
                $campeon++;
            }
            ?>

        <?php
        }else { //ha probado una búsqueda pero no hemos recibido respuesta del cURL
            echo "<div class='centrado960' style='margin-top:2em !important'>The BattleTag entered is incorrect. Try again.</div>";
        }
    
    }else { //No nos ha hecho petición todavía.. Le informamos de ello.
        echo "<div class='centrado960' style='margin-top:2em !important'>Please enter a BattleTag to search for.</div>";
    }
    
	function get_web_page($url) { //funcion de cURL con sus opciones
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

<!-- scripts
<script src="../particles.js"></script>
<script src="js/app.js"></script>
-->

</body>
</html>