<?php
	
	global $investors, $countries;
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h || !array_key_exists($h, $investors)) return;
	
	$tab = $tab ? $tab : 'edit-profile';
	
	$full_name		= implode(' ', $investors[$h]['name']);
	$first_name		= $investors[$h]['name']['first'];
	$last_name		= $investors[$h]['name']['last'];
	
	$title			= array_key_exists('name', $investors[$h]) && array_key_exists('title', $investors[$h]['name']) ? $investors[$h]['name']['title'] : null;
	$middle_name	= array_key_exists('name', $investors[$h]) && array_key_exists('middle', $investors[$h]['name']) ? $investors[$h]['name']['middle'] : null;
	
	$email			= array_key_exists('email',		$investors[$h]) ? $investors[$h]['email']		: null;
	$password		= array_key_exists('password',	$investors[$h]) ? $investors[$h]['password']	: null;
	$phone			= array_key_exists('phone',		$investors[$h]) ? $investors[$h]['phone']		: null;
	
	$street			= array_key_exists('street',	$investors[$h]) ? $investors[$h]['street']	: null;
	$zip			= array_key_exists('zip',		$investors[$h]) ? $investors[$h]['zip']		: null;
	$city			= array_key_exists('city',		$investors[$h]) ? $investors[$h]['city']		: null;
	
	$country_code	= array_key_exists('country',	$investors[$h]) ? $investors[$h]['country']	: null;
	$country		= $country_code && array_key_exists($country_code, $countries) ? $countries[$country_code]	: null;
	
	$bio			= array_key_exists('bio',		$investors[$h]) ? $investors[$h]['bio']		: null;
?>



<section id="investor-edit" class="<?php echo $tab; ?>">
	
	
	
		
</section>