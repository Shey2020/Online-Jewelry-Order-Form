<?php

$dbConnection = mysqli_connect('localhost','root','','php_gem');

if(mysqli_connect_errno()){
	echo 'Failed to connect MySQL: '.mysqli_connect_error();
	exit();
}

// to print connection confirmation
//echo 'Connected';

//if include_once chinese
mysqli_set_charset($dbConnection,'utf8');