<?php
// create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agendavi";

//check connection
    $dbc = mysqli_connect($servername,$username,$password,$dbname);
    if (!$dbc) {
        die("Connection failed" . mysqli_connect_error());
    }
?>