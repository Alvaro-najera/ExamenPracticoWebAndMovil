<?php
session_start();
session_unset(); //libera las varianles
// destroy the session
session_destroy(); 

header("location: index.php");
?>