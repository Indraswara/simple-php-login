<?php
$HOSTNAME= 'localhost';
$USERNAME= 'root';
$PASSWORD= '';
$DATABASE= 'signupforms'; 


$con = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE, 3306);

if(mysqli_connect_errno()){
    die("Connection failed: " . mysqli_connect_errno());
}


?>