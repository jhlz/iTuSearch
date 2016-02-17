<?php
/*
*
*  iTunes search
*
*/

require_once('res/url_get_contents.php'); //for older versions
$at = ""; // affiliat-token

//json helper
if (!function_exists('json_decode')) {	
    function json_decode($content, $assoc=false) {		
        require_once 'res/JSON.php';		
        if ($assoc) {
            $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        }
        else {
            $json = new Services_JSON;        }
        return $json->decode($content);
    }
}	
function searchItunes($country,$artistName,$albumName) {
	
	if ($albumName == ""){		
		$query = $artistName;	
	}else{
		$query = $artistName." ".$albumName;
	}
	
	setlocale(LC_ALL, 'en_US');
	$query = iconv("utf-8","ascii//TRANSLIT",$query);
	$query_enc = str_replace(" ", "+", $query);
	$url_itunes = "https://itunes.apple.com/search?term=".$query_enc."&country=".$country."&media=music&entity=album&a&limit=1&at=".$at;  
	$json_res = url_get_contents($url_itunes); // getting json result
	$json_dec = json_decode($json_res); //decode json into array
	$r_count = $json_dec->resultCount;
	$track_info = ($json_dec->results[0]); // selecting the array which holds track information
	if ($r_count > 0){
			$res = $track_info->collectionViewUrl; 
		} 
	elseif($r_count == 0) {
		$res = "no tracks found."; 
		
	}else{$res = "error";}
	return $res;
}

?>
   
