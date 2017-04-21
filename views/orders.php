<?php


$content = "<h1>Orders</h1>";


$sql = "SELECT id, customer_id FROM transaction
	ORDER BY customer_id";
$result = mysqli_query($link, $sql);


if ($result === false) 
{
    echo mysqli_error($link);
} else {
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0)
	{
	    	$content .= "<table border='1'>";
	    	$content .= "<thead><tr><th>Order ID</th><th>Customer ID</th></tr></thead>";
	    	$content .= "<tbody>";
	    
	    	while ($row = mysqli_fetch_assoc($result)) {
			$content .= "<tr>";
			$content .= "<td><a href=\"?page=order&order_id=".$row['id']."\">".$row['id']."</a></td>";
			$content .= "<td>".$row['customer_id']."</td>";
			$content .= "</tr>";
		}
		$content .= "</tbody></table>";
	} else {
		$content .= "<p>There are no orders to display.</p>";
	}
	
	mysqli_free_result($result);
}

echo $content;

?>
