<?php

$conn = mysqli_connect("85.144.187.81", "inf1b", "peer", "DigitalPortfolio");

if (!$conn) {
    die("Couldn't connect to the database!");
}