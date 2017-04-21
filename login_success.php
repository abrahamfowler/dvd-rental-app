
<?php
session_start();
if(!session_is_registered(myusername)){
header("location//doc.gold.ac.uk/~afowl001/dnw/dvdrentalapp/?page=home");
}
?>

<html>
<body>
Login Successful
</body>
</html>