<?php

	session_start();
	
	require_once('inc/content-data.php');
	require_once('inc/helper-functions.php');
	
	
	if (isset($_POST['auth'])) {
		if (isset($_POST['auth']) && $_POST['auth']) {
			$_SESSION['auth'] = true;
			$_SESSION['user'] = isset($_POST['username']) && array_key_exists($_POST['username'], $investors) ? $_POST['username'] : array_rand($investors);
		} else {
			unset($_SESSION['auth']);
			unset($_SESSION['user']);
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