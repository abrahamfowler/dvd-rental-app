<?php

echo 'test';

$content = "<h1>Add a Customer</h1>";
mysqli_autocommit($link, FALSE);
mysqli_query($link, 'START TRANSACTION');
// define a variable with path to the script which will process form
// ->	$_SERVER["PHP_SELF"] is a path to the current script (index.php)
// ->	htmlspecialchars() is used to replace special characters with HTML entities 
$action = htmlspecialchars($_SERVER["PHP_SELF"]."?page=Add-Customer");
// fetch the artists so that we have access to their names and IDs
/*$sql = "SELECT Customer_ID, First_Name, Last_Name 
        FROM Customers
        ORDER BY Last_Name";

$result = mysqli_query($link, $sql);

// check query returned a result
if ($result === false) {
    echo mysqli_error($link);
} else {
    $options = "";
    // create an option for each artist
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='".$row['Customer_ID']."'>";
        $options .= $row['First_name']." ".$row['Last_Name'];
        $options .= "</option>";
    }
}
*/
// define the form HTML (would ideally be in a template)
$form_html = "<form action='".$action."' method='POST'>
                    <fieldset>
                    <label for='Customer_EAN'>Customer_EAN</label>
                     <input type='text' name='Customer_EAN' />
                    </fieldset>
                    <fieldset>
                    <label for='Customer_ID'>Customer_ID</label>
                     <input type='text' name='Customer_ID' />
                    </fieldset>
                    <fieldset>
                    <label for='Title'>Title:</label>
                    <input type='text' name='Title' />
                    </fieldset>
                    <fieldset>
                    <label for='First_Name'>First_Name:</label>
                    <input type='text' name='First_Name' />
                    </fieldset>
                    <fieldset>
                    <label for='Last_Name'>Last_Name:</label>
                    <input type='text' name='Last_Name' />
                    </fieldset>
                    <fieldset>
                    <label for='Date_Of_Birth'>Date_Of_Birth</label>
                    <input type='text' name='Date_Of_Birth' />
                    </fieldset>
                    <fieldset>
                    <label for='Address_Line_1'>Address_Line_1:</label>
                    <input type='text' name='Address_Line_1'/>
                    </fieldset>
                    <fieldset>
                    <label for='Address_Line_2'>Address_Line_2:</label>
                    <input type='text' name='Address_Line_2'/>
                    </fieldset>
                    <fieldset>
                    <label for='City'>City:</label>
                    <input type='text' name='City'/>
                    </fieldset>
                    <fieldset>
                    <label for='PostCode'>PostCode:</label>
                    <input type='text' name='PostCode'/>
                    </fieldset>
                    <fieldset>
                    <label for='Card_Number'>Card_Number</label>
                     <input type='text' name='Card_Number' />
                    </fieldset>
                    <fieldset>
                    <label for='Card_Expiry_Date'>Card_Expiry_Date</label>
                     <input type='text' name='Card_Expiry_Date' />
                    </fieldset>
                     <fieldset>
                    <label for='Card_Security_No'>Card_Security_No</label>
                     <input type='text' name='Card_Security_No' />
                    </fieldset>
                    <button type='submit'>Submit</button>
                    </form> ";

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

// define variables and set to empty values
$customer_id = $first_name = $last_name = $title ="";
$customer_ean=$customer_id=$card_number=$card_expiry_date=$card_security_no=$date_of_birth = $address_line_1 = $address_line_2 = $city = $postcode ="";
// check if there was a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// validate the form data
	$first_name= mysqli_real_escape_string($link, clean_input($_POST["First_Name"]));
	$last_name=  mysqli_real_escape_string($link, clean_input($_POST["Last_Name"]));
	$title =  mysqli_real_escape_string($link, clean_input($_POST["Title"]));
    $date_Of_Birth =  mysqli_real_escape_string($link, clean_input($_POST["Date_Of_Birth"]));
    $address_line_1 =  mysqli_real_escape_string($link, clean_input($_POST["Address_Line_1"]));
    $address_line_2 =  mysqli_real_escape_string($link, clean_input($_POST["Address_Line_2"]));
    $city =  mysqli_real_escape_string($link, clean_input($_POST["City"]));
    $postcode =  mysqli_real_escape_string($link, clean_input($_POST["PostCode"]));
    $customer_id =  mysqli_real_escape_string($link, clean_input($_POST["Customer_ID"]));
    $customer_ean= mysqli_real_escape_string($link, clean_input($_POST["First_Name"]));
    $card_number=mysqli_real_escape_string($link, clean_input($_POST["Last_Name"]));
    $card_expiry_date =  mysqli_real_escape_string($link, clean_input($_POST["Title"]));
    $card_security_no =  mysqli_real_escape_string($link, clean_input($_POST["Date_Of_Birth"]));
	// define the insertion query
    // Remove Customer ID Field it might fix the problem
	$query1 = sprintf("INSERT INTO Customers (Customer_ID,Title, First_Name, Last_Name)
		VALUES (%d,'%s','%s','%s')", $customer_id,$title, $first_name, $last_name);
    $query2 = sprintf("INSERT INTO Customer_Card_Details(Customer_EAN,Customer_ID,Card_Number,Card_Expiry_Date,Card_Security_No,Date_Of_Birth,Address_Line_1,Address_Line_2,City, PostCode)
    VALUES ('%s', %d, %d, '%s', %d, '%s','%s','%s','%s','%s')", $customer_ean,$customer_id,$card_number,$card_expiry_date,$card_security_no,$date_of_birth,$address_line_1,$address_line_2,$city,$postcode);

	// run the query to insert the data
	$result = mysqli_query($link, $query1);
    // check if either of the queries failed (returned false)
    if (!mysqli_query($link, $query1) or !mysqli_query($link, $query2)) {
        echo mysqli_error($link);
        mysqli_rollback($link); // if so, rollback customer details
    } else {
        mysqli_commit($link); // else, commit customer details
        $content .= "Record successfully added to database.";
    }
}

// ------- END form processing code... -------
// output the html
echo($content);

?>