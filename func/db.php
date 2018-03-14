<?php
/*
DEKSHORT 1
PHP VERSION 5
CODE BY DEKGUH
FACEBOOK.COM/ELSEIFTRUE
JUST SIMPLE URL SHORTNER
TEMPLATE BOOTSTRAP 3

FOR CHANGE USER LOGIN AND PASS EDIT IN USERNAME AND PASSWORDUSER
*/
session_start();
DEFINE("SERVERDB","localhost");
DEFINE("USERDB","root");
DEFINE("PASSDB","");
DEFINE("NAMEDB","dekshort");

// define web , no need make admin panel because simple
DEFINE("TITLEWEB","Dekshort URL - Simple");
DEFINE("COPYRIGHT", date("Y")." - dekguh");

//admin for vip panel
DEFINE("USERNAME","dekguh25");
DEFINE("PASSWORDUSER","123456");

$con = mysqli_connect(SERVERDB,USERDB,PASSDB,NAMEDB);

if(!$con){
	die("failed connect to server");
}
?>