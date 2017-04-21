<?php


$content = "<h1>Producer</h1>";


$sql = "SELECT title, first_name, last_name,year FROM producer";
$result = mysqli_query($link, $sql);


if ($result === false) {
    echo mysqli_error($link);
} else {
    $content .= "<table border='1'><tbody>";
  $content .= "<thead><tr><th>Title</th><th>First Name</th><th>Last Name </th><th>Year he Produced</th></tr></thead>";
    $content .= "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        $content .= "<tr>";
        $content .= "<td>".$row['title']."</td>";
        $content .= "<td>".$row['first_name']."</td>";
            $content .= "<td>".$row['last_name']."</td>";
                $content .= "<td>".$row['year']."</td>";
        $content .= "</tr>";
    }
    $content .= "</tbody></table>";

    mysqli_free_result($result);
}


echo $content;

?>
