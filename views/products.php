<?php

// create variable for content HTML
    $content = "<h1>Products</h1>";
	$sql = "SELECT Product_ID, Category, Product_Name, Product_Description FROM Products ORDER BY Category, Product_Name DESC";
	$result = mysqli_query($link, $sql);
	if ($result === false)
	{
    echo( "No records found." );
	} 
	else
	{
    echo( "Some records were found!" );
   	}
    //check query returned a result;
if ($result === false) {
    echo mysqli_error($link);
} else {
    $content .= "<table border='1'><tbody>";
   // fetch associative array;
    while ($row = mysqli_fetch_assoc($result)) {
        $content .= "<td>".$row['Product_ID']."</td>";
        $content .= "<td>".$row['Category']."</td>";
        $content .= "<td>".$row['Product_Name']."</td>";
        $content .= "<td>".$row['Product_Description']."</td>";
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
