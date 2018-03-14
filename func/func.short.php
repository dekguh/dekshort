<?php
require_once("db.php");

function acak($no){
	$character = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ";
	$text = "";
	for($i=1;$i<=$no;$i++){
		$rand = rand(0,strlen($character)-1);
		$text .= $character{$rand};
	}

	return $text;
}

function checkurl($url){
	if(preg_match("#^http://#", $url) == true OR preg_match("#^https://#", $url) == true){
		return 1;
	}else{
		return 0;
	}
}

function makeshort($con,$url,$short){
	$idshort = mysqli_query($con,"SELECT MAX(id) AS idnum FROM short");
	$idshort = mysqli_fetch_array($idshort);
	$idshort = $idshort["idnum"] + 1;
	$tgl = time();

	$insert = mysqli_prepare($con,"INSERT INTO short (id, tanggal, url, short) VALUES (?,?,?,?)");
	mysqli_stmt_bind_param($insert,"ssss",$idshort,$tgl,$url,$short);
	mysqli_stmt_execute($insert);

	return $short;
}

function infoshort($con,$short){
	$info = mysqli_prepare($con,"SELECT * FROM short WHERE short = ?");
	mysqli_stmt_bind_param($info,"s",$short);
	mysqli_stmt_execute($info);
	$info = mysqli_stmt_get_result($info);
	$num = mysqli_num_rows($info);

	if($num == 1){
		$result = mysqli_fetch_array($info);
	}else{
		$result = 0;
	}
	return $result;
}

function checkshort($con,$short){
	$info = mysqli_prepare($con,"SELECT * FROM short WHERE short = ?");
	mysqli_stmt_bind_param($info,"s",$short);
	mysqli_stmt_execute($info);
	$info = mysqli_stmt_get_result($info);
	$num = mysqli_num_rows($info);

	if($num == 0){
		return 0;
	}else{
		return 1;
	}
}
?>