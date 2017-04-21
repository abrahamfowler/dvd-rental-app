<?php

// create variable for content HTML
    $content = "<h1>Orders</h1>";
	$sql = "SELECT Order_ID, Customer_ID, Order_Date, Quantity,Price,Description FROM Orders ORDER BY Customer_ID, Quantity DESC";
	$result = mysqli_query($link, $sql);
	if ($result === false)
	{
    echo( "No records found." );
	} 
	else
	{
    echo( "Some records were found!" );
   	}
    /*check query returned a result;*/ 
if ($result === false) {
    echo mysqli_error($link);
} else {
    $content .= "<table border='1'><tbody>";
   // fetch associative array;
    while ($row = mysqli_fetch_assoc($result)) {
            $content .= "<tr>";
        $content .= "<td>".$row['Order_ID']."</td>";
        $content .= "<td>".$row['Customer_ID']."</td>";
        $content .= "<td>".$row['Quantity']."</td>";
        $content .= "<td>".$row['Price']."</td>";
        $content .= "<td>".$row['Description']."</td>";
$content .= "</tr>";
    }
    $content .= "</tbody></table>";
    // free result set 
    mysqli_free_result($result);
	}
	mysqli_close($link);
    // output the content HTML
    echo $content;
?>