<?php
/*



*/



    $content = "<h1>Edit record</h1>";

	// define $ean variable and assign value of id parameter
	$ean = $_GET['id'];

	// define query to fetch record details
	$sql = sprintf("SELECT title, artist_id, genre, year, price
			FROM movies
			WHERE ean=%d",$ean);

    $result = mysqli_query($link, $sql);	
	$title = $artist_id = $genre = $year = $price = "";

    if ($result === false) {
        echo mysqli_error($link);
    } else {
		$row = mysqli_fetch_assoc($result);

		$title = $row['title'];
		$artist_id = $row['artist_id'];
		$genre = $row['genre'];
		$year = $row['year'];
		$price = $row['price'];
		unset($result);
	}

    // define a variable with path to the script which will process form
    $action = htmlspecialchars($_SERVER["PHP_SELF"]."?page=edit-record");

    // fetch the artists so that we have access to their names and IDs
    $sql = "SELECT id, first_name, last_name
            FROM stars
            ORDER BY last_name";

    $result = mysqli_query($link, $sql);

    // check query returned a result
    if ($result === false) {
        echo mysqli_error($link);
    } else {
        $options = "";
        // create an option for each artist
        while ($row = mysqli_fetch_assoc($result)) {
			// if the id matches current artist_id, show option as selected
			if ($row['id'] == $artist_id) {
				$options .= "<option value='".$row['id']."' selected>";
			} else {
				$options .= "<option value='".$row['id']."'>";
			}
            $options .= $row['first_name']." ".$row['last_name'];
            $options .= "</option>";
        }
    	unset($result);
    }

    // define the form HTML (would ideally be in a template)
    $form_html = "<form action='".$action."' method='POST'>
            <fieldset>
                <label for='ean'>EAN (required):</label>
                <input type='text' name='ean' value='".$ean."'/>
            </fieldset>
                    <fieldset>
                        <label for='title'>Title:</label>
                        <input type='text' name='title' value='".$title."' />
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
                        <input type='text' name='genre' value='".$genre."' />
                    </fieldset>
                    <fieldset>
                        <label for='year'>Year:</label>
                        <input type='text' name='year' size='5' value='".$year."' />
                    </fieldset>
                    <fieldset>
                        
                    <button type='submit'>Submit</button>
                  </form>";

    // append form HTML to content string
    $content .= $form_html;

    // ------- START form processing code... -------

    // define a function to sanitise user input (this would ideally be in includes folder)
    // helps protect against XSS
    function clean_input($data) {
      $data = trim($data); // strips unnecessary characters from beginning/end
      $data = stripslashes($data); // remove backslashes
      $data = htmlspecialchars($data); // replace special characters with HTML entities
      return $data;
    }

    // check if there was a POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate the form data
        $ean = mysqli_real_escape_string($link, clean_input($_POST["ean"]));
        $title =  mysqli_real_escape_string($link, clean_input($_POST["title"]));
        $artist_id =  mysqli_real_escape_string($link, clean_input($_POST["artist_id"]));
        $genre =  mysqli_real_escape_string($link, clean_input($_POST["genre"]));
        $year =  mysqli_real_escape_string($link, clean_input($_POST["year"]));
        $price =  mysqli_real_escape_string($link, clean_input($_POST["price"]));


        // define the insertion query
        $sql = sprintf("UPDATE record
			SET ean=%d, title=%d, artist_id=%d, genre=%d, year=%d, price=%d
			WHERE ean=%d", $ean, $title, $artist_id, $genre, $year, $price, $ean);

        // run the query to update the data
        $result = mysqli_query($link, $sql);

        // check if the query went ok
        if ($result === false) {
            echo mysqli_error($link);
        } else {
            $content .= "Record updated successfully.";
        }
// ------- END form processing code... -------
}
// output the html
echo($content);

?>
