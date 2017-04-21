<?php


$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

function login()
{
session_start();   //this starts the session for the user profile page
if(!empty($_POST['user']))   //after that it checks the 'user' name which is from Sign-In.html if its empty or has some text
{
	$query = mysql_query("SELECT *  FROM UserName where userName = '$_POST[user]' AND pass = '$_POST[pass]'") or die(mysql_error());
	$row = mysql_fetch_array($query) or die(mysql_error());
	if(!empty($row['userName']) AND !empty($row['pass']))
	{
		$_SESSION['userName'] = $row['pass'];
		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";

	}
	else
	{
		echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
	}
}
}
if(isset($_POST['submit']))
{
	login();
}

?>

