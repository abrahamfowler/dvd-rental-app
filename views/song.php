<?php


$content = "<h1>DVDs</h1>";


$sql = "SELECT movietitle, releasedate, playingtime FROM movietitle";
$result = mysqli_query($link, $sql);


if ($result === false) {
    echo mysqli_error($link);
} else {
    $content .= "<table border='1'><tbody>";
  $content .= "<thead><tr><th>Movie Title</th><th>Release Date </th><th>PlayingTime(Mins)</th></tr></thead>";
    $content .= "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        $content .= "<tr>";
        $content .= "<td>".$row['movietitle']."</td>";
        $content .= "<td>".$row['releasedate']."</td>";
            $content .= "<td>".$row['playingtime']."</td>";
                
        $content .= "</tr>";
    }
    $content .= "</tbody></table>";

    mysqli_free_result($result);
}


echo $content;

?>