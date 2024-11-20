<?php
    $con = mysqli_connect('localhost', 'root', '','hospital');

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die("Failed to connect to database: " . mysqli_connect_error());
    }
    else{
       echo "<script>console.log('Connected to database successfully');</script>";
    }
?>