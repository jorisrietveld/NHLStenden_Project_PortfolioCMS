<?php
$conn = mysqli_connect("85.144.187.81", "inf1b", "peer");
if ($conn === FALSE) {
    echo "<p>Unable to connect to the database server.</p>"
        . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()
        . "</p>";
} else {
    echo "<p>Verbonden met mysql server van Aron Soppe!</p>";
}

$DBname = "DigitalPortfolio";

if ($conn) {
    if (mysqli_select_db($conn, $DBname)) {
        echo "<p style='color:green'>Database '$DBname' is geselecteerd.</p>";
    } else {
        echo "<p style='color:red'><b>Kan database '$DBname' niet vinden!</b></p>" .
            "<p style='color:red'>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>";
    }
}

