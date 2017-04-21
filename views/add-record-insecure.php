<?php

$content = "<h1>Add a record</h1>";


$action = $_SERVER["PHP_SELF"]."?page=add-record";


$sql = "SELECT id, first_name, last_name 
        FROM stars
	    ORDER BY last_name";

$result = mysqli_query($link, $sql);


if ($result === false) {
    echo mysqli_error($link);
} else {
    $options = "";
   
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='".$row['id']."'>";
        $options .= $row['first_name']." ".$row['last_name'];
        $options .= "</option>";
    }
}


$form_html = "<form action='".$action."' method='POST'>
		<fieldset>
		    <label for='ean'>EAN (required):</label>
		    <input type='text' name='ean'/>
		</fieldset>
                <fieldset>
                    <label for='title'>Title:</label>
                    <input type='text' name='title' />
                </fieldset>
                <fieldset>
                    <label for='artist_id'>Artist:</label>
                    <select name='artist_id'>

                        ".$options."
                        <option value='NULL'>Not listed</option>
                    </select>
                </fieldset>
                <fieldset>
                    <label for='genre'>Genre</label>
                    <input type='text' name='genre' />
                </fieldset>
                <fieldset>
                    <label for='year'>Year:</label>
                    <input type='text' name='year' size='5' placeholder='YYYY' />
                </fieldset>
                <fieldset>
                    <label for='price'>Price (&pound;):</label>
                    <input type='text' name='price' placeholder='00.00' 
color='#C36200' />
                </fieldset>
                <button type='submit'>Submit</button>
              </form>";


$content .= $form_html;




$title = $artist_id = $price = $year = $genre = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$ean = $_POST["ean"];
	$title =  $_POST["title"];
	$artist_id =  $_POST["artist_id"];
	$genre =  $_POST["genre"];
	$year =  $_POST["year"];
	$price =  $_POST["price"];

	
	$sql = "INSERT INTO movies (ean, title, artist_id, genre, year, price)
		VALUES ('$ean', '$title', '$artist_id', '$genre', '$year', '$price')";


	$result = mysqli_query($link, $sql);

	
	if ($result === false) {
		echo mysqli_error($link);
	} else {
		$content .= "Record successfully added to database.";
	}
}


echo($content);

?>
