<?php


if (!isset($_GET['id'])) {

	
	$content = "<h1>I don't know which artist you're looking for...</h1>";

} else {  

	 
	$artist_id = $_GET['id'];

	
	$sql = "SELECT r.title, r.year, r.price, a.first_name, a.last_name
		FROM movies r
		INNER JOIN stars a
		ON r.artist_id=a.id
		WHERE a.id=".$artist_id."
		ORDER BY year ASC";

	$result = mysqli_query($link, $sql);

	
	if ($result === false) {
	    	echo mysqli_error($link);
	} else {
		
		
		$i = 0;

	    	
	    	while ($row = mysqli_fetch_assoc($result)) {

			
			if ($i == 0) {

	
				$content = "<h1>".$row['first_name']." ".$row['last_name']." Records</h1>";
				
				$content .= "<table border='1'><tbody>";

			}

			
			$content .= "<tr>";
			$content .= "<td>".$row['title']."</td>";
			$content .= "<td>".$row['year']."</td>";
			$content .= "<td>&pound;".$row['price']."</td>";
			$content .= "</tr>";

			
			$i++;

		}

		
		$content .= "</tbody></table>";

	
		mysqli_free_result($result);
	}
}


echo $content;

?>
