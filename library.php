<?php
function connectdb(){			//connects the database
	$domain = 'frigg.trentu.ca';
	$username = 'TeamCodex';
	$password = 'ChawvOk8';
	$db_name = 'TeamCodex';
	
	
	$conn = mysqli_connect($domain,$username,$password, $db_name) or die ("1.Error Cannot connect to database");
	return $conn;
}

function rawParam($x){		//strips the input for security purposes
	return ini_get('magic_qoutes_gpc')? stripslashes($x): x;
}

function dbParam($x){		//strips the input for securoty purposes
	$conn = connectdb();
	return ini_get('magic_qoutes_gpc')?mysqli_real_escape_string($conn, stripslashes($x)):mysqli_real_escape_string($conn, $x);
}

function formatDateDb($x){  //formats the dates for the database
	return $x == ""? $x: date('y-m-d', strtotime($x));
}
function formatDateDisplay($x){ //formats the dates for displaying purposes
	return $x == ""? $x: date('m/d/y', strtotime($x));
}
?>