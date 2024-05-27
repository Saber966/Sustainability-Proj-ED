<?php 

# Connect as a 'localhost' to the 'sustainability_db' database.

$link = mysqli_connect('localhost','root','root','sustainability_db'); 

if (!$link) { 

# If a connection cannot be established, kill the process and report the error to the screen.

die('Could not connect to MySQL: ' . mysqli_error()); 

}  

?> 