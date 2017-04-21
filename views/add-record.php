<?php

$content = "<h1>Add a record</h1>";

// define a variable with path to the script which will process form
// ->	$_SERVER["PHP_SELF"] is a path to the current script (index.php)
// ->	htmlspecialchars() is used to replace special characters with HTML entities */
$action = htmlspecialchars($_SERVER["PHP_SELF"]."?page=add-record");

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
        $options .= "<option value='".$row['id']."'>";
        $options .= $row['first_name']." ".$row['last_name'];
        $options .= "</option>";
    }
}

// define the form HTML (would ideally be in a template)
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
                    <input type='text' name='price' placeholder='00.00' />
                </fieldset>
                <fieldset>
                    <label for='price'>Stock:</label>
                    <input type='text' name='stock' placeholder='0' />
                </fieldset>
                <button type='submit'>Submit</button>
              </form>";

// append form HTML to content string
$content .= $form_html;



// define a function to sanitise user input (this would ideally be in includes folder)
// helps protect against XSS
function clean_input($data) {
  $data = trim($data); // strips unnecessary characters from beginning/end
  $data = stripslashes($data); // remove backslashes
  $data = htmlspecialchars($data); // replace special characters with HTML entities
  return $data;
}

// define variables and set to empty values
$title = $artist_id = $price = $year = $genre = $stock = "";

// check if there was a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// validate the form data
	$ean = mysqli_real_escape_string($link, clean_input($_POST["ean"]));
	$title =  mysqli_real_escape_string($link, clean_input($_POST["title"]));
	$artist_id =  mysqli_real_escape_string($link, clean_input($_POST["artist_id"]));
	$genre =  mysqli_real_escape_string($link, clean_input($_POST["genre"]));
	$year =  mysqli_real_escape_string($link, clean_input($_POST["year"]));
	$price =  mysqli_real_escape_string($link, clean_input($_POST["price"]));
	$stock =  mysqli_real_escape_string($link, clean_input($_POST["stock"]));

	// turn autocommit off
	mysqli_autocommit($link, FALSE);

	// start a transaction
	mysqli_query($link, 'START TRANSACTION');

	// define the insertion query to add a new record in record table
	$query1 = sprintf("INSERT INTO record (ean, title, artist_id, genre, year, price)
		VALUES ('%s', '%s', %d, '%s', %d, %f)", $ean, $title, $artist_id, $genre, 
$year, $price);

	// define the insertion query to add a new record in inventory table
	$query2 = sprintf("INSERT INTO inventory (stock, record_ean)
		VALUES (%d, '%s')", $stock, $ean);

	// check if either of the queries failed (returned false)
	if (!mysqli_query($link, $query1) or !mysqli_query($link, $query2)) {
		echo mysqli_error($link);
		mysqli_rollback($link); // if so, rollback transaction
	} else {
		mysqli_commit($link); // else, commit transaction
		$content .= "Record successfully added to database.";
	}

    }

    // ------- END form processing code... -------

    // output the html
    echo($content);

?>
