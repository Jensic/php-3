<?php

/**************************************************
                DATABASCONNECTION
***************************************************/

/**
*
*defines constants with connection information for use in databas connection
*Stores the built in function new mysqli in variable $conn, to use when connect to database is needed.
*echoes a message if connection fails
*myscli_set_character sets default charachter set to utf8
*
**/

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "dynweb_inl3");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conn->connect_errno) {
	echo "Error! failed to connect to database";
    die();
}

mysqli_set_charset($conn,"utf8");