<html lang="en">
<head>
	<title>Hanzowatch</title>
	<link rel="stylesheet" href="css/estilos.css">
    <meta charset="UTF-8">
    <meta name="description" content="opensource overwatch tracker">
    <meta name="keywords" content="HTML,CSS,PHP,JavaScript">
    <meta name="author" content="Nikolaas Verlee">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/events.js"></script>
</head>
    
<body>

    <!-- Navigation -->
    <nav>
        <img src="img/logo.png" id="logo" alt="Hanzowatch" />
        <div>
            <ul>
                <li><a href="index.php">Search</a></li>
                <li><a href="/forums" target="_blank">Forums</a></li>
                <li><a href="patchnotes.php">Patchnotes</a></li>
                <li><a href="counters.php">Counters</a></li>
            </ul>
        </div>
    </nav>
    
    <!-- Player search form -->
    <div class="centrado960">
        <?php
            $player = $_GET['player'];
            $region = 'eu'; // we only work with Europe until webapp playerbase extends
        ?>
        <h3 id="variableText">
            <?php
            if(!isset($player)){ // control flow if they come from an already-existing query or first query ever
                echo "<span>Replace # with - on your BattleTag.</span>";
            }
            ?>
        </h3>
        <form id="battletag" action="index.php" method="get">
            BattleTag:
            <input type="text" name="player" id="battletagplayer" placeholder="User-2122">
            <input type="submit" id="lupa" value="Search">
        </form>
    </div>
    
    <!-- Image below form-->
    <div class="heroes">
        <img src="img/heroes.png" alt="Overwatch heroes">
    </div>

<?php
    $response = requestAPI("http://owapi.net/api/v3/u/".$player."/blob"); // cURL call to the owAPI
    $response = json_decode($response); // decode the json object received from requestAPI
    
	$data = $response; // assign the object to our $data variable

    // shorten the variables with route shortcuts
	$competitive_overall_stats = $data->$region->stats->competitive->overall_stats;
	$competitive_game_stats = $data->$region->stats->competitive->game_stats;
	$quickplay_overall_stats = $data->$region->stats->quickplay->overall_stats;
	$quickplay_game_stats = $data->$region->stats->quickplay->game_stats;

    if(isset($player)){ // do we have a battletag to search for?
        if(count($data->$region->stats)==0){ // if he hasn't played a single game he won't have stats -> ERROR
            echo "<script>$('.centrado960').css('display','block !important');</script>";
            echo "<script>$('#variableText').text('No player found with that name.');</script>";
            echo "<script>$('#variableText').css('color','red');</script>";
        } 
        else {
            echo "<script>$('.centrado960').hide();</script>"; //if they come from a url with a player set -> don't display search input form
            echo "<div id='information'>";
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

        <div id="filter">
            <input type="text" id="hero-filter" onkeyup="searchHero()" placeholder="Search for a specific hero..">
        </div>

        <?php
            //we store all the champions manually in an array and find the player's performance with each one
            $champions = array("reinhardt","tracer","zenyatta","junkrat","mccree","winston","orisa","hanzo","pharah","roadhog","zarya","torbjorn","mercy","mei","ana","widowmaker","genji","reaper","soldier76","bastion","symmetra","dva","sombra","lucio");

            echo "<ul id='hero-stats'>";
            foreach ($champions as $champion) {
                if(count($data->$region->heroes->stats->competitive->$champion)==1 && count($data->$region->heroes->stats->quickplay->$champion)==1){ // check if the user PLAYED the champion
                    echo "<li class='hero' id=".$champion.">";
                        echo "<div>";
                            echo "<div id='avatar'></div>";
                            echo "<div id='champion'><h1>" .$champion. "</h1></div>";
                     
                            echo "<div id='data'>";
                                echo "<p> Eliminations: ".$data->$region->heroes->stats->competitive->$champion->general_stats->eliminations."</p>";
                                echo "<p> Deaths: ".$data->$region->heroes->stats->competitive->$champion->general_stats->deaths."</p>";
                                echo "<p> Total damage: ".$data->$region->heroes->stats->competitive->$champion->general_stats->damage_done."</p>";
                                echo "<p style='color:green'> Win ratio: ". 100*$data->$region->heroes->stats->competitive->$champion->general_stats->win_percentage."%</p>";

                                echo "<p> Games played: ".$data->$region->heroes->stats->competitive->$champion->general_stats->games_played."</p>";
                                echo "<p> Games won: ".$data->$region->heroes->stats->competitive->$champion->general_stats->games_won."</p>";
                                echo "<p style='color:orange'> K/D: ".$data->$region->heroes->stats->competitive->$champion->general_stats->eliminations_per_life."</p>";
                                echo "<p> Most damage: ". $data->$region->heroes->stats->competitive->$champion->general_stats->damage_done_most_in_game."</p>";

                                echo "<p> Eliminations: ".$data->$region->heroes->stats->competitive->$champion->general_stats->eliminations."</p>";
                                echo "<p> Deaths: ".$data->$region->heroes->stats->competitive->$champion->general_stats->deaths."</p>";
                                echo "<p> Total damage: ".$data->$region->heroes->stats->competitive->$champion->general_stats->damage_done."</p>";
                                echo "<p> Win ratio: ". 100*$data->$region->heroes->stats->competitive->$champion->general_stats->win_percentage."%</p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</li>";
                    $champion++; //we have printed all the info for that actual champìon, let's go to the next one
                } else { 
                    //the hero has no data so we don't show the div
                    echo "";
                }
            }
            echo "</ul>";
        echo "</div>"; //information
        }
    }

    	function requestAPI($url) { //funcion de cURL con sus opciones
    	    $options = array(
    	        CURLOPT_RETURNTRANSFER => true,   // return web page
    	        CURLOPT_HEADER         => false,  // don't return headers
    	        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
    	        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
    	        CURLOPT_ENCODING       => "",     // handle compressed
    	        CURLOPT_USERAGENT      => "Hanzowatch", // name of client
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

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Mobile -->
    <div class="scrollTop"><img src="img/arrow.png"></div>
    <div class="open-nav"><img src="img/nav.png"></div>
    <div class="close-nav"><img src="img/close-nav.png"></div>

</body>
</html>