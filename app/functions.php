<?php
$db = mysqli_connect("localhost", "root", "", "lab");
define('URL', 'http://localhost/labs');

if (!isset($_SESSION))
{
session_start();
}

?>