<?php

setlocale(LC_MONETARY, 'en_US');
/*function format_money($sum) {
	$money_format = '%.0n';
	return money_format($money_format, $sum);
}*/

function format_money($sum, $short=true, $round=true) {
    if(!is_numeric($sum)) return false;
    
    $currency = '$';
	$money_format = '%.1n';
	
    if($sum>1000000000000)
    	return $currency . round(($sum/1000000000000), ($round?1:15) ) . ($short ? 't' : ' trillion');
    	
    else if ($sum>1000000000)
    	return $currency . round(($sum/1000000000), ($round?1:12)) . ($short ? 'b' : ' billion');
    
    else if ($sum>1000000)
    	return $currency . round(($sum/1000000), ($round?1:6)) . ($short ? 'm' : ' million');
    
    else if ($sum>1000)
    	return $currency . round(($sum/1000), ($round?1:3)) . ($short ? 'k' : 'k');
    
    return $currency.$sum;
	//return money_format($money_format, $sum);
    //return number_format($sum);
}

?>