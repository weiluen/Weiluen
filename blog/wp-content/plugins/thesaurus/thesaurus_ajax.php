<?php

/*  Copyright 2008 Ben Merrill (email : ben@inceptioneng.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// read submitted information
$lookup = $_POST["lookup"];
$results_div_id = $_POST["results_div_id"];
parse_str($_POST['opts'],$opts);

if (function_exists("curl_init")) {

	// create a new cURL resource
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://words.bighugelabs.com/api/1/".urlencode(strtolower(trim($lookup)))."/php");
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);

} else { die( "document.getElementById('$results_div_id').innerHTML = 'CURL not enabled on host!'"); }

//parse result
$result = "";
if ($response != "") {
	foreach(unserialize($response) as $num => $res) {
		if ($opts['limit'] && ($opts['limit'] == $num)) { die( "document.getElementById('$results_div_id').innerHTML = '$result'"); }
		$result.= $res."<br />";
	}
} else {
	die( "document.getElementById('$results_div_id').innerHTML = 'No results found.'");
}

// Compose JavaScript for return
die( "document.getElementById('$results_div_id').innerHTML = '$result'");

?>
