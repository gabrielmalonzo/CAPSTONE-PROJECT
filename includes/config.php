<?php
session_start(); // Start the session
$conn = mysqli_connect("localhost", "root", "", "peso_database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

