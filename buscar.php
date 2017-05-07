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
        <li><a href="/forums">Forums</a></li>
    </ul>
</nav>
    
<div class="formulario">
    <div class="warning centrado">
        <h3>Use - instead of # when searching your BattleTag.</h3>
    </div>
    
	<form id="#form" action="buscar.php" method="get">
	    BattleTag: <input type="text" name="player" id="battletag"> 
        <select name="region">
            <option value="eu">Europe West</option>
            <option value="na">North America</option>
        </select>
        <input type="submit" id="lupa">
	</form>
</div>

<!-- Battletag search -->
<?php
	$player = $_GET['player'];
    $region = $_GET['region'];
    $url = 'owapi.net/api/v3/u/Nikoto-21675/blob';

    function geturl($url){
        (function_exists('curl_init')) ? '' : die('cURL Must be installed for geturl function to work. Ask your host to enable it or uncomment extension=php_curl.dll in php.ini');

        $cookie = tempnam ("/tmp", "CURLCOOKIE");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; CrawlBot/1.0.0)');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); # required for https urls
        curl_setopt($ch, CURLOPT_MAXREDIRS, 15);     

        $html = curl_exec($curl);
        $status = curl_getinfo($curl);
        curl_close($curl);

        if($status['http_code']!=200){
            if($status['http_code'] == 301 || $status['http_code'] == 302) {
                list($header) = explode("\r\n\r\n", $html, 2);
                $matches = array();
                preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
                $url = trim(str_replace($matches[1],"",$matches[0]));
                $url_parsed = parse_url($url);
                return (isset($url_parsed))? geturl($url):'';
            }
        }
    return $html;
    }

    geturl($url);
?>

<div class="preloader"></div>

</body>
</html>