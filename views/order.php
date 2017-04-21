<?php


if (isset($_GET['order_id']))
{
	$order_id = $_GET['order_id'];
} else { 
	$order_id = -1; 
}


$sql = "SELECT r.ean, r.title, ol.quantity, ol.transaction_id, r.price 
	FROM movies r
	INNER JOIN orderline ol 
		ON ol.record_ean=r.ean
	WHERE ol.transaction_id=".$order_id;
$result = mysqli_query($link, $sql);


if ($result === false) {
    	echo mysqli_error($link);
} else {

	
	$num_rows = mysqli_num_rows($result);

	
	if ($num_rows == 0) {
		$content = "<h1>Order not found</h1>";
	} else {
		
		$content = "<h1>Order ".$order_id."</h1>";
		$content .= "<table border=1 cellspacing=6 
cellpadding=4 bgcolor=#cccccc >";
               
		$content .= "<thead><tr>
				<th>EAN</th>
				<th>Title</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Total</th>
			     </tr></thead>";
		$content .= "<tbody>";
		
		$total = 0.00;
		
		while ($row = mysqli_fetch_assoc($result)) {
			$subtotal = $row['quantity'] * $row['price'];
			$total = $total + $subtotal;
			$content .= "<tr>";
			$content .= "<td>".$row['ean']."</td>";
			$content .= "<td>".$row['title']."</td>";
			$content .= "<td>".$row['quantity']."</td>";
			$content .= "<td>&pound;".$row['price']."</td>";
			$content .= "<td>&pound;".$subtotal."</td>";
			$content .= "</tr>";
	        }
		$content .= "<tr><td colspan=4><b>TOTAL</b><td><b>&pound;".$total."</b></td></tr>";
		$content .= "</tbody></table>";
		// free result set
		mysqli_free_result($result);
	
	}
}


echo $content;

?>
