<?php

setlocale(LC_MONETARY, 'en_US');
function format_money($sum) {
	$money_format = '%.0n';
	return money_format($money_format, $sum);
}

?>