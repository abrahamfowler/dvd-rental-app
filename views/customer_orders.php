<?php
echo("Test");
// check if id parameter was not set in query string
if (!isset($_GET['Customer_ID'])) {

	// define $content with suitable message
	$content = "<h1>I don't know which order you're looking for...</h1>";

} else { // id was set, so carry on... 

	// define $customer_id variable and assign value of id parameter 
	$Customer_ID['Customer_ID'];

	// define query
	$sql = "SELECT c.Customer_ID, o.Order_ID, c.First_Name, c.Last_Name, o.Price
		FROM Customers c
		INNER JOIN Orders o
				ON c.Customer_ID=o.Customer_ID
		WHERE o.Customer_ID=".$Customer_ID."
		ORDER BY o.Price ASC";

    $result = mysqli_query($link, $sql);

// check query returned a result
if ($result === false) {
    	echo mysqli_error($link);
} else {

	// Find the number of rows returned
	$num_rows = mysqli_num_rows($result);

	// Check it's not 0
	if ($num_rows == 0) {
		$content = "<h1>Orders not found</h1>";
	} else {
		// create variable for content HTML
		$content = "<h1>Order ".$Customer_ID."</h1>";
		$content .= "<table border='1'>";
		$content .= "<thead><tr>
				<th>Order_ID</th>
				<th>Price</th>
				<th>Total</th>
			     </tr></thead>";
		$content .= "<tbody>";
		// initialise total order price to 0
		$total = 0.00;
		// fetch associative array
		while ($row = mysqli_fetch_assoc($result)) {
			$subtotal = 0.00; // <-- CALCULATE SUBTOTAL!
			$total = 0.00; // <-- KEEP RUNNING ORDER TOTAL!
			$content .= "<tr>";
			$content .= "<td>".$row['Order_ID']."</td>";
		//	$content .= "<td>".$row['First_Name']."</td>";
		//	$content .= "<td>".$row['Last_Name']."</td>";
			$content .= "<td>&pound;".$row['Price']."</td>";
			$content .= "<td>&pound;".$subtotal."</td>";
			$content .= "</tr>";
	        }
		$content .= "<tr><td colspan=4><b>TOTAL</b><td><b>&pound;".$total."</b></td></tr>";
		$content .= "</tbody></table>";
		// free result set
		mysqli_free_result($result);
	
	}
}

// output the content HTML
echo $content;

?>