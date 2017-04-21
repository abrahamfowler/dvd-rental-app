<?php

// create variable for content HTML
    $content = "<h1>Customers</h1>";
	$sql = "SELECT c.Customer_ID,cd.Customer_EAN, c.First_Name, c.Last_Name, cd.City FROM Customers c INNER JOIN Customer_Card_Details cd ON c.Customer_ID=cd.Customer_ID ORDER BY cd.City, c.Customer_ID DESC";
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
        $content .= "<td>".$row['Customer_ID']."</td>";
     	$content .= "<td><a href='?page=customer_orders&Customer_ID=".$row['Customer_ID']."'>".$row['First_Name']." ".$row['Last_Name']."</a></td>";
        $content .= "<td>".$row['City']."</td>";
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