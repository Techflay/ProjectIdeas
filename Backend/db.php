<?php

$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = 'UPKFA<72-(';
$DB_NAME = 't_project_ideas';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

?>
