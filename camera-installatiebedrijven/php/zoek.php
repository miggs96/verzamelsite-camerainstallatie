<?php
include 'connect.php';

	$q = $_GET ['q'];

	$sql ="SELECT id, naam FROM bedrijf WHERE naam LIKE '%".$q."%'";

	$result = mysqli_query($con, $sql);

	while ($row = $result->fetch_assoc()){
		echo'<option value="'. $row['id'].'">'.$row['naam'].'</option>'; 
	}
?>