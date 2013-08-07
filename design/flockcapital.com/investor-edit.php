<?php
	
	$profiles = array(
		'kadri' => array(
			'name'		=> array(
				'title'	=> 'Ms.',
				'first'	=> 'Kadri',
				'middle'=> 'Liis',
				'last'	=> 'Rääk'
			),
			'email'		=> 'kadri@example.com',
			'phone'		=> '+372 5555 5555',
			'street'	=> 'Nice House, Kadriorg',
			'zip'		=> '12345',
			'city'		=> 'Tallinn',
			'country'	=> 'EE'
		),
		'mart' => array(
			'name'		=> array(
				'title'	=> '',
				'first'	=> 'Mart',
				'middle'=> '',
				'last'	=> 'Uibo'
			),
			'email'		=> 'mart@example.com'
		),
		'michael' => array(
			'name'		=> array(
				'title'	=> 'Mr.',
				'first'	=> 'Michael',
				'middle'=> '',
				'last'	=> 'Walsh'
			),
			'email'		=> 'michael@example.com'
		)
	);
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h) return;
	
	$tab = $tab ? $tab : 'edit-profile';
	
	$full_name		= implode(' ', $profiles[$h]['name']);
	$first_name		= $profiles[$h]['name']['first'];
	$last_name		= $profiles[$h]['name']['last'];
	
	$title			= array_key_exists('name', $profiles[$h]) && array_key_exists('title', $profiles[$h]['name']) ? $profiles[$h]['name']['title'] : null;
	$middle_name	= array_key_exists('name', $profiles[$h]) && array_key_exists('middle', $profiles[$h]['name']) ? $profiles[$h]['name']['middle'] : null;
	
	$email			= array_key_exists('email',		$profiles[$h]) ? $profiles[$h]['email']		: null;
	$password		= array_key_exists('password',	$profiles[$h]) ? $profiles[$h]['password']	: null;
	$phone			= array_key_exists('phone',		$profiles[$h]) ? $profiles[$h]['phone']		: null;
	
	$street			= array_key_exists('street',	$profiles[$h]) ? $profiles[$h]['street']	: null;
	$zip			= array_key_exists('zip',		$profiles[$h]) ? $profiles[$h]['zip']		: null;
	$city			= array_key_exists('city',		$profiles[$h]) ? $profiles[$h]['city']		: null;
	
	$countries 		= array (
		'AX' => 'Åland Islands',
		'AF' => 'Afghanistan',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua and Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'PW' => 'Belau',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BQ' => 'Bonaire, Saint Eustatius and Saba',
		'BA' => 'Bosnia and Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory',
		'VG' => 'British Virgin Islands',
		'BN' => 'Brunei',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CG' => 'Congo (Brazzaville)',
		'CD' => 'Congo (Kinshasa)',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CW' => 'CuraÇao',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island and McDonald Islands',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran',
		'IQ' => 'Iraq',
		'IM' => 'Isle of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'CI' => 'Ivory Coast',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Laos',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao S.A.R., China',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'AN' => 'Netherlands Antilles',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'KP' => 'North Korea',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PS' => 'Palestinian Territory',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'QA' => 'Qatar',
		'IE' => 'Republic of Ireland',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russia',
		'RW' => 'Rwanda',
		'ST' => 'São Tomé and Príncipe',
		'BL' => 'Saint Barthélemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts and Nevis',
		'LC' => 'Saint Lucia',
		'SX' => 'Saint Martin (Dutch part)',
		'MF' => 'Saint Martin (French part)',
		'PM' => 'Saint Pierre and Miquelon',
		'VC' => 'Saint Vincent and the Grenadines',
		'SM' => 'San Marino',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia/Sandwich Islands',
		'KR' => 'South Korea',
		'SS' => 'South Sudan',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard and Jan Mayen',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'SY' => 'Syria',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad and Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks and Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VA' => 'Vatican',
		'VE' => 'Venezuela',
		'VN' => 'Vietnam',
		'WF' => 'Wallis and Futuna',
		'EH' => 'Western Sahara',
		'WS' => 'Western Samoa',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe'
	);
	$country_code	= array_key_exists('country',	$profiles[$h]) ? $profiles[$h]['country']	: null;
	$country		= $country_code && array_key_exists($country_code, $countries) ? $countries[$country_code]	: null;
	
	$bio			= array_key_exists('bio',		$profiles[$h]) ? $profiles[$h]['bio']		: null;
?>



<section id="investor-edit" class="<?php echo $tab; ?>">
	
	<div class="submenu">
		<div>
			<ul>
				<li><a class="dashboard" href="?p=dashboard">Dashboard</a></li>
				<li><a class="profile <?php echo !array_key_exists('tab', $_GET) || (array_key_exists('tab', $_GET) && $_GET['tab']=='profile') ? 'current' : ''; ?>" href="?p=investor-edit&i=<?php echo $h ?>">Profile</a></li>
				<?php /*<li><a class="accreditation <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='accreditation' ? 'current' : ''; ?>" href="?p=investor-edit&i=<?php echo $h ?>&tab=accreditation">Investor Accreditation</a></li>*/ ?>
				<li><a class="settings" href="?p=settings&i=<?php echo $h ?>">Settings</a></li>
			</ul>
		</div>
	</div>

	
	<?php if (array_key_exists('email', $_POST)) { ?>
		<div class="message">
			Profile updated. &nbsp;&nbsp;<a class="button theta thicker" href="?p=investor&i=<?php echo $h; ?>">View</a>
		</div>
	<?php } else { ?>
		<div class="message quiet">
			<a class="button iota thicker" href="?p=investor&i=<?php echo $h; ?>">View your public profile</a>
		</div>
	<?php } ?>
	
	
	<div class="head">
		<div>
			<figure class="profile-badge">
				<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"><div class="focus"></div></a>
			</figure>
			<div id="investor-details">
				<h3><?php echo $full_name;  ?></h3>
				
				<div id="mini-bio">
					<p>Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav<?php /*<br><a href="#" class="hellip">…</a>*/ ?></p>
				</div>
	
				<div class="ext-account-buttons">
					<div>
						<div class="btns">
							<div>
								<button name="ext-account" value="facebook" class="ext-account-button facebook connected-ext-account-button"></button>
								<button name="ext-account" value="twitter" class="ext-account-button twitter connected-ext-account-button"></button>
								<button name="ext-account" value="google-plus" class="ext-account-button google-plus"></button>
								<button name="ext-account" value="linked-in" class="ext-account-button linked-in"></button>
							</div>
						</div> &nbsp;&nbsp;
						<div>
							<p class="tertiary">Connect external accounts to follow your friends' activity on Flock.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="body">
		<div class="main">
		
			<div id="tabs" class="tabs profile">
				<ul>
					<li><a href="?p=investor-edit&i=<?php echo $h ?>" class="personal <?php echo !array_key_exists('tab', $_GET) || (array_key_exists('tab', $_GET) && $_GET['tab']=='personal') ? 'current' : ''; ?>"><em>1</em> Personal Details</a></li>
					<li><a href="?p=investor-edit&i=<?php echo $h ?>&tab=accreditation" class="accreditation <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='accreditation' ? 'current' : ''; ?>"><em>2</em> Accreditation</a></li>
					<li><a href="?p=investor-edit&i=<?php echo $h ?>&tab=experience" class="experience <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='experience' ? 'current' : ''; ?>"><em>3</em> Experience</a></li>
				</ul>
			</div>
			
			<?php
				switch($tab) {
					case 'accreditation': ?>
						<div class="tab-content gridwrap" id="accreditation">
							
							<form>
						
								<div class="intro">
									<p>
										Most investments are available to accredited investors only. Please answer the following questions to verify your qualification as an <a href="http://www.sec.gov/answers/accred.htm" target="_blank">Accredited Investor</a>.
									</p>
								</div>
								
								<fieldset class="separated-both">
									<h5>Identification Document</h5>
									<p>Please upload a scan of your Identification Document.</p>
									<div class="table">
										<div style="text-align:left;">
											<input id="doc-upload" type="file" name="doc-scan[]">
										</div>
										<div id="doc-upload-response"></div>
									</div>
									<div id="doc-upload-progress" class="goalmeter">
										<div class="progress" style="width:0%"></div>
									</div>
									<div id="doc-scan-preview">
										<img src="img/doc-scan.png">
									</div>
								</fieldset>
								
								<fieldset class="separated-bottom">
									<h5>Annual Individual Income</h5>
									<p>I have an individual income for each of the two most recent years equal to an income level indicated below and reasonably expect to reach at least the same level this year.</p>
									<label class="radio" for="level-1"><input id="level-1" type="radio" name="income-level"> &lt; $200'000</label>
									<label class="radio" for="level-2"><input id="level-2" type="radio" name="income-level"> $200'000 — $350'000</label>
									<label class="radio" for="level-3"><input id="level-3" type="radio" name="income-level"> $350'000 — $500'000</label>
									<label class="radio" for="level-4"><input id="level-4" type="radio" name="income-level"> $500'000 &lt;</label>
								</fieldset>
								
								<fieldset class="separated-bottom">
									<h5>Securities Firm</h5>
									<p>Are you associated with a Securities Firm?</p>
									<label class="radio" for="no-securities-firm"><input id="no-securities-firm" type="radio" name="securities-firm"> No</label>
									<label class="radio" for="yes-securities-firm"><input id="yes-securities-firm" type="radio" name="securities-firm"> Yes</label>
								</fieldset>
								
								<fieldset>
									<h5>Public Company Shareholder or Officer</h5>
									<p>?</p>
									<label class="radio" for="no-public-company"><input id="no-public-company" type="radio" name="public-company"> No</label>
									<label class="radio" for="yes-public-company"><input id="yes-public-company" type="radio" name="public-company"> Yes</label>
								</fieldset>
								
							</form>
							
						</div>
						<?php break;

					case 'experience': ?>
						<div class="tab-content"></div>
						<?php break;

					default: ?>
						<div class="tab-content gridwrap" id="profile">
					
							<form action="?p=investor-edit&i=<?php echo $h ?>" method="post">
								
								<label for="email">
									<?php /*<span>E-mail</span>*/ ?>
									<input id="email" name="email" type="email" placeholder="E-mail" size="1" value="<?php echo $email ?>">
								</label>
								
								<fieldset class="separated-bottom">
									<legend>To change your password, provide your old password and then type the new one:</legend>
									<div class="input-group">
										<label for="password-old" style="width:50%">
											<input id="password-old" type="text" placeholder="Old password" size="1" value="">
										</label>
										<label for="password-new" style="width:50%">
											<input id="password-new" type="text" placeholder="New password" size="1" value="">
										</label>
									</div>
								</fieldset>
								
								<fieldset class="input-group name">
									<label for="title" style="width:15%;">
										<?php /*<span>Full Name</span>*/ ?>
										<input id="title" type="text" placeholder="Title" size="1" value="<?php echo $title ?>">
									</label>
									<label for="first-name" style="width:28.33%">
										<?php /*<span>&nbsp;</span>*/ ?>
										<input id="first-name" type="text" placeholder="First Name" size="1" value="<?php echo $first_name ?>">
									</label>
									<label for="middle-names" style="width:28.33%">
										<?php /*<span>&nbsp;</span>*/ ?>
										<input id="middle-names" type="text" placeholder="Middle Name(s)" size="1" value="<?php echo $middle_name ?>">
									</label>
									<label for="last-name" style="width:28.33%">
										<?php /*<span>&nbsp;</span>*/ ?>
										<input id="last-name" type="text" placeholder="Last Name" size="1" value="<?php echo $last_name ?>">
									</label>
								</fieldset>
								
								<label for="phone">
									<?php /*<span>Phone</span>*/ ?>
									<input id="phone" type="text" placeholder="Phone" size="1" value="<?php echo $phone ?>">
								</label>
								
								<div class="tight">
									<label for="street">
										<?php /*<span>Street Address</span>*/ ?>
										<input id="street" type="text" placeholder="Street address" size="1" value="<?php echo $street ?>">
									</label>
									<label for="zip">
										<?php /*<span>Zip</span>*/ ?>
										<input id="zip" type="text" placeholder="Zip code" size="1" value="<?php echo $zip ?>">
									</label>
									
									<label for="city">
										<?php /*<span>City/Town/Locality</span>*/ ?>
										<input id="city" type="text" placeholder="City/Town/Locality" size="1" value="<?php echo $city ?>">
									</label>
									
									<label for="country">
										<?php /*<span>Country</span>*/ ?>
										<select id="country" class="combobox">
											<option value="">Select a country…</option>
											<?php
												foreach($countries as $cc => $c) {
													echo '<option value="'.$cc.'" '. ($cc==$country_code ? 'selected="selected"' : '') .'>'.$c.'</option>';
												}
											?>
										</select>
									</label>
								</div>
								
								<?php /*<label for="bio">
									<?php /*<span>Mini biography</span>* ?>
									<textarea id="bio" type="text" placeholder="Mini biography, max 160 characters" size="1"><?php echo $bio ?></textarea>
								</label>*/ ?>
								
								<div class="action">
									<div>
										<div>
											<?php /*<a href="?p=investor&i=<?php echo $h ?>" class="button zeta thickest gray">Cancel</a>*/ ?>
											<input type="submit" class="zeta thickest" value="Update">
										</div>
									</div>
								</div>
								
							</form>
									
						</div>
						<?php break;
				}
			?>
			
		</div>
	</div>

	<?php /*
		<figure class="profile-badge">
			<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"><div class="focus"></div></a>
		</figure>
		<div class="investor-name">
			<h3><?php echo $full_name; ?>
				<?php if (isset($investor_type_label) && isset($investor_type_class)) { ?>
					<label class="type <?php echo $investor_type_class; ?>"><?php echo $investor_type_label; ?></label>
				<?php } ?>
			</h3>
		</div>
		<div class="action">
		</div>*/ ?>
		
</section>