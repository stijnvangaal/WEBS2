<?php
include "/config.inc.php";
$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
or die ("Can't connect to MySQL Server!");
$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");

//get car functions
FUNCTION get_sale_car(){
	global $link;
	$query = "SELECT * FROM auto LIMIT 1";
	$result = mysqli_query($link, $query);
		
	return mysqli_fetch_array($result);
}

FUNCTION get_all_cars(){
	global $link;
	$query = "SELECT * FROM auto";
	return mysqli_query($link, $query);
}

?>