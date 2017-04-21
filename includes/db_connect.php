<?php

/* Opens a new connection to the MySQL server */

/* connect to the database */
$link = mysqli_connect(
    'localhost',
    'afowl001',
    'oluwakemi27',
    'afowl001_dvdrentalapp'
);

/* checks connection succeeded */
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>