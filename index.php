<?php
session_start();
if (!isset($_SESSION['ID']) && !isset($_SESSION['NIVEL']) && !isset($_SESSION['ESTADO'])) {
	header('location: login.php');
} 
?>