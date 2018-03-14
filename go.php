<?php
require_once("func/func.short.php");

if(!empty($_GET["short"])){
	$short = htmlentities(trim($_GET["short"]));
	$ekse = infoshort($con,$short);
	header("location: ".$ekse["url"]);
}else{
	header("location: index.php");
}
?>