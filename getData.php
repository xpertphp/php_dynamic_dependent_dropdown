<?php
	include_once 'config.php'; 
	if(isset($_GET['country_id'])){
		$query = "SELECT * FROM states WHERE country_id = ".$_GET['country_id']." ORDER BY name ASC";
		$result = mysqli_query($conn,$query);
		$data = array();
		 while($row = mysqli_fetch_array($result)){ 
			$data[] = $row;
         }
		 echo json_encode($data);
	}else if(isset($_GET['state_id'])){
		$query = "SELECT * FROM cities WHERE state_id = ".$_GET['state_id']." ORDER BY name ASC";
		$result = mysqli_query($conn,$query);
		$data = array();
		 while($row = mysqli_fetch_array($result)){ 
			$data[] = $row;
         }
		 echo json_encode($data);
	}
?>