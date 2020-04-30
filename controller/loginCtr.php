<?php
session_start();
require_once("../model/conexaoCls.php");
require_once("usuarioCtr.php");

$p = $_POST;

if ($p) {
	echo "post";	
} else {
	header('location:../index.php');	
}
?>