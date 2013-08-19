<?php

	session_start();
	
	require_once('inc/content-data.php');
	require_once('inc/helper-functions.php');
	
	
	if (isset($_POST['auth'])) {
		if ($_POST['auth']) {
			$_SESSION['auth'] = true;
		} else {
			unset($_SESSION['auth']);
		}
		if ($_POST['auth']) {
			$_SESSION['user'] = isset($_POST['email']) && array_key_exists($_POST['email'], $investors) ? $_POST['email'] : array_rand($investors);
		}
	}
	if (!isset($_SESSION['auth']) && array_key_exists('p', $_GET) && in_array($_GET['p'], array('dashboard', 'investor-edit', 'settings'))) {
		header('location: ?');
	}



	require('header.php');



	$handle = array_key_exists('p', $_GET) && !empty($_GET['p']) ? $_GET['p'] : 'home';
	require($handle.'.php');



	require('footer.php');

?>