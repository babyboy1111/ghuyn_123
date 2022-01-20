
<?php
define('DBSERVER', 'localhost'); // Database server
define('DBUSERNAME', 'root'); // Database username
define('DBPASSWORD', ''); // Database password
define('DBNAME', 'login'); // Database name
 
/* connect to MySQL database */
$connect = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
 
// Check db connection
if($connect === false){
    die("Error: connection error. " . mysqli_connect_error());
}
?>