<?php
include ('library.php');	
					
$conn = connectdb();							//connect the database		

if(!isset($_GET['a'])){									
	$query = "SELECT * FROM `isotope`";		
	$row = array();
	$results = mysqli_query($conn,$query) or die("2. error");
	while($r = mysqli_fetch_assoc($results)) {
    	$rows[] = $r;
	}
print json_encode($rows);					
}
?>