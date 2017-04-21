<?php

// creates the variable for content HTML
$content = "<h1>Records</h1>";
$content .= "<p>You are now viewing all records in the database.</p>";

// fetches records as a result set
$sql = "SELECT r.title, r.ean, a.first_name, a.last_name, r.genre, r.price,i.stock, a.id
	FROM movies r
	INNER JOIN stars a
		ON r.artist_id=a.id
INNER JOIN inventory i
		ON r.ean=i.record_ean
	ORDER BY r.title, r.price DESC";
$result = mysqli_query($link, $sql);

// checks query returned a result
if ($result === false) {
    echo mysqli_error($link);
} else {
    $content .= "<table border='1'>";
    $content .= "<thead><tr><th>Title</th><th>Artist</th><th>Genre</th><th>Price</th><th>Stock</th></tr></thead>";
    $content .= "<tbody>";
    // fetchs associative array
    while ($row = mysqli_fetch_assoc($result)) {
        $content .= "<tr>";
        $content .= "<td>".$row['title']."</td>";
        $content .= "<td><a href='?page=artist&id=".$row['id']."'>".$row['first_name']." ".$row['last_name']."</a></td>";
        $content .= "<td>".$row['genre']."</td>";
        $content .= "<td>".$row['price']."</td>";
        $content .= "<td>".$row['stock']."</td>";
        $content .= "</tr>";
    }
    $content .= "</tbody></table>";
    // free result set
    mysqli_free_result($result);
}

// output the content HTML
echo $content;

?>
