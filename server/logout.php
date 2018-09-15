<?php

session_start();
$_SESSION = array();
session_unset();
session_destroy();

$response['msg'] = "OK";
echo json_encode($response);

 ?>
