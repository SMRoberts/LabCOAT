<?php
require_once ('library.php');										//include the library of functions
$conn = connectdb();												//connect the database

if(empty($_GET["Sdata"])){											//if there is no search 
		$term = "0";	
}else{																//if something was searched for
		$term = $_GET["Sdata"];										//set the search term to term
}

//Query for selecting The building and room numbers the chemical is in *Note for later only shows one building at a time currently
$query = "SELECT Building, Room FROM room R, chemical_agent CA, chemical_location CL WHERE CL.RoomID = R.RoomID AND CA.CAS = CL.CAS AND CA.Name LIKE '%{$term}%'";

$b_results = mysqli_query($conn,$query) or die ("Error finding movie in database");	//sends query to the database

if(!isset($_GET['id'])|| !is_int((int)$_GET['id'])){	//check if the id is set
	$id = "null";
}else{
	$id =  $_GET['id'];									//collect the movie id
}

//Query for seelcting the chemical information from a slected lab
$query = "SELECT IUPAC, CL.CAS AS CAS, Name, date_added, Quantity, state, Building, Room FROM room R, chemical_agent CA, chemical_location CL WHERE CL.RoomID = R.RoomID AND CA.CAS = CL.CAS AND R.Room = '{$id}'  AND CA.Name LIKE '%{$term}%'";

$c_results = mysqli_query($conn,$query) or die ("Error finding movie in database");
$row = mysqli_fetch_array($b_results);					//stores information form the database concerning the chemical 

//Query for selecting the different names that the chemical is stored as 
$query = "SELECT Name FROM chemical_agent WHERE CAS = '{echo $row["CAS"]}'";
$n_results = mysqli_query($conn,$query) or die ("Error finding movie in database"); //stores the name infomation
?>

<div class="col-xs-2 col-md-2 panel panel-default">
  <ol class="breadcrumb">
	<li><a href="inventory.php">Home</a></li> 			<!-- link to the home page-->
    <li><a href="inventory.php""><?php echo $building_info["Building"] ?></a></li>	<!--link to the building-->
  </ol>
  <nav>
    <ul class="nav nav-pills nav-stacked">
	
	<?php
		while ($building_info = mysqli_fetch_array($b_results)){			//While there are different labs with the chemical serahced 
	?>
	  <li>
        <a href="inventory.php?id="<?php echo $building_info["room"] ?>><?php echo $building_info["room"] ?></a>	<!-- list the room number-1-->
      </li>
	<?php
		}
	?>
	
    </ul>
  </nav>

</div>
<div class="col-xs-10 col-md-10 panel panel-default">
  <ol class="breadcrumb">
    <li><a href="inventory.php">Home</a></li>										<!--Link to home-->
    <li><a href="inventory.php"><?php echo $row["Building"]?></a></li>				<!--Link to building-->
    <li class="active"><a href="inventory.php"><?php echo $row["Room"]?></li>		<!--Link to lab-->
  </ol>
  <div class="row">
    <div class="col-xs-5 col-md-5">
      <h4><span class="label label-success"><?php echo $row["Name"];?></span></h4>	<!--Chemical Name searched-->
    </div>
    
	<div class="col-xs-5 col-md-5">     
        <div class="input-group">													
			<?php
			/*<form action="inventory.php" method="get" enctype="multipart/form-data">  	<!--submit button link--> 
				<label for="Sdata">Search term:</label>     
				<input type="text" class="form-control" placeholder="Search for..." name="Sdata"/>
				<span class="input-group-btn">
					<Button class="btn btn-default" type="submit" name="Submit">Search</button>		<!--submit button-->    
				</span>
            </form>
			*/
			?>
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
        </div>       
    </div>
	
  </div>
  <div class="row">
    <div class="col-xs-5 col-md-5">

      <ul class="list-group">
        <li class="list-group-item">
          Building: <?php echo $row["Building"];?>				<!--Building-->
        </li>
        <li class="list-group-item">
          Lab: <?php echo $row["Room"];?>						<!--Room-->
        </li>
        <li class="list-group-item">
          IUPAC: <?php echo $row["IUPAC"];?>					<!--Standard name-->
        </li>
       
        <li class="list-group-item">
          Last Updated: <?php echo $row["date_added"];?>		<!--Date added-->
        </li>
      </ul>
       <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-default">Edit</button>
        <button type="button" class="btn btn-default">Delete</button>
      </div>
    </div>
    <div class="col-xs-5 col-md-5">

      <ul class="list-group">
        <li class="list-group-item">
          Quantity: <?php echo $row["Quantity"];?>				<!--Qauntitiy-->
        </li>
        <li class="list-group-item">
          Faculty: <?php echo $row["FirstName"];?>?>			<!--Faculty Name-->
        </li>
        <li class="list-group-item">
          CAS number: <?php echo $row["CAS"];?>					<!--CAS Number-->
        </li>
        <li class="list-group-item">
          State: <?php echo $row["state"];?>					<!--Chemical state-->
        </li>
      </ul>         
    </div>
  </div>
  <br/>
  <div class="row">
    
    <ul class="list-group">
		<li class="list-group-item">							<!--Different names of the chemical-->
			Names:			
			<?php
			while ($name_info = mysqli_fetch_array($n_results)){	//while there are different names
				echo $name_info["Name"] ", ";						//list the different names
			}
			?>
		</li>
    </ul>
    
  </div>
</div>
