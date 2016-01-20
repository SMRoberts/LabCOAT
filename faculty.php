<?php
include ('library.php');	
					
$conn = connectdb();							//connect the database
if(!isset($_GET['id'])){
		$query = "SELECT * FROM `faculty`";	

	}else{
		$id = intval($_GET['id']);
		$query = "SELECT * FROM `faculty` WHERE PeopleID = $id";
	}								
		
	$row = array();
	$results = mysqli_query($conn,$query) or die("2. error");
	while($r = mysqli_fetch_assoc($results)) {
    	$rows[] = $r;
	}

print json_encode($rows);
?>