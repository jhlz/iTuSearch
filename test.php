<?php
/*** Test for iTuSearch**/require_once "iTuSearch.php";

if(isset($_POST['firstname-itu']) AND isset($_POST['lastname-itu']) )
{
	$res = searchItunes("DE",$_POST['firstname-itu']." ".$_POST['lastname-itu'],$_POST['album-itu']);		$found = strpos($res, "https");	if ($found !== false){
		echo "<a href='".$res."'>".$res."</a>";	}	else {echo $res;}
	} 
?>
<h2>iTunes Search Test</h2>
<form action='test.php' method='post'>
<p>firstname: <input type='text' name='firstname-itu' /></p>
<p>lastname: <input type='text' name='lastname-itu' /></p>
<p>album: <input type='text' name='album-itu' /></p>
<p><input type='submit' /></p></form>



