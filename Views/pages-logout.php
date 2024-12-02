<?php
	require '../App/config.php';
	session_destroy();

	header('Location: login');
?>
