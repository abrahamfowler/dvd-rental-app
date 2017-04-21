<?php

// connect to the database
require('includes/db_connect.php');

// include the header HTML
include('templates/header.html');

// include the navigation HTML
include('templates/navigation.html');

// get the page id from the URL
// if no parameter detected...
if (!isset($_GET['page'])) {
	$id = 'home'; // display home page
} else {
	$id = $_GET['page']; // else requested page
}

// use switch to determine which view to serve based on $id
switch ($id) {
case 'home' :
	include 'views/home.php';
	break;
case 'record' :
	include 'views/record.php';
	break;
case 'artist' :
	include 'views/artist.php';
	break;
case 'orders' :
	include 'views/orders.php';
	break;
case 'order' :
	include 'views/order.php';
	break;
case 'add-record' :
	include 'views/add-record.php';
	break;
	case 'edit-record' :
	include 'views/edit-record.php';
	break;
	case 'producer' :
	include 'views/producer.php';
	break;
		case 'song' :
	include 'views/song.php';
	break;
		case 'customers' :
	include 'views/customers.php';
	break;
		case 'customer_orders' :
	include 'views/customer_orders.php';
	break;
		case 'orders1' :
	include 'views/orders1.php';
	break;
		case 'products' :
	include 'views/products.php';
	break;
		case 'Add-Customer' :
	include 'views/Add-Customer.php';
	break;
		case 'main_login' :
	include 'views/main_login.php';
	break;
default :
	include 'views/404.php';
}

// close the connection to the database
mysqli_close($link);

// include the footer HTML
include('templates/footer.html');

?>

