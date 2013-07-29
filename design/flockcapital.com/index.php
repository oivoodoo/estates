<?php require('header.php'); ?>



<?php
$handle = array_key_exists('p', $_GET) && !empty($_GET['p']) ? $_GET['p'] : 'home';
require($handle.'.php'); ?>




<?php require('footer.php'); ?>