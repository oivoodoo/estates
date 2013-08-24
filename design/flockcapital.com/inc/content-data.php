<?php

include_once('helper-functions.php');


$projects = array(
	'1800-van-ness' => array(
		'is_tracked' => true,
		'link'		=> '?p=project&project=1800-van-ness',
		'handle'	=> '1800-van-ness',
		'name'		=> '1800 Van Ness',
		'location'	=> array(
			'country'	=> 'United States',
			'locality'	=> 'San Francisco',
			'address'	=> '1800 Van Ness Ave, San Francisco, CA 94109',
			'coordinates'=> array (
				'lat' => 37.792549,
				'lng' => -122.422292
			)
		),
		'type_label'=> 'Residential',
		'manager'	=> 'stonemount',
		'goal'		=> 14000000,
		'progress' 	=> 14000000,
		'financials'=> array(
			'return'=> array(
				'value'		=> 12,
				'unit'		=> '%',
				'yield_type'=> 'APR'
			),
			'type'	=> 'equity', //Equity/Debt
			'period'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mo',
					'long' 	=> 'month'
				)
			),
			'share' => array(
				'price' => 1400
			)
		),
		'num_investors' => 27,
		'num_trackers'	=> 89,
		'amount_invested'	=> 28000,
		'projected_earnings'=> 3360
	),
	'vilnius-rimi' => array(
		'is_tracked' => false,
		'link'		=> '?p=project&project=vilnius-rimi',
		'handle'	=> 'vilnius-rimi',
		'name'		=> 'Rimi Supermaket',
		'location'	=> array(
			'country'	=> 'Lithuania',
			'locality'	=> 'Vilnius',
			'address'	=> 'Tuskulėnų gatvė 2, Vilnius 09213, Lithuania',
			'coordinates'=> array (
				'lat' => 54.696334,
				'lng' => 25.296894
			)
		),
		'type_label'=> 'Retail',
		'manager'	=> 'trigon',
		'goal'		=> 32000000,
		'progress'	=> 32000000*.62,
		'financials'=> array(
			'return'=> array(
				'value'		=> 12,
				'unit'		=> '%',
				'yield_type'=> 'APR'
			),
			'type'	=> 'equity', //Equity/Debt
			'period'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mo',
					'long' 	=> 'month'
				)
			),
			'share' => array(
				'price' => 1600
			)
		),
		'num_investors' => 27,
		'num_trackers'	=> 89,
		'amount_invested'	=> 32000,
		'projected_earnings'=> 3840
	),
	'cafe-klaus' => array(
		'is_tracked' => true,
		'link'		=> '?p=project&project=cafe-klaus',
		'handle'	=> 'cafe-klaus',
		'name'		=> 'Café Klaus',
		'location'	=> array(
			'country'	=> 'Estonia',
			'locality'	=> 'Tallinn',
			'address'	=> 'Kalasadama 8, 10415 Tallinn, Estonia',
			'coordinates'=> array (
				'lat' => 59.445785,
				'lng' => 24.749311
			)
		),
		'type_label'=> 'Retail',
		'manager'	=> 'gage-partners',
		'goal'		=> 400000,
		'progress' 	=> 400000*.21,
		'financials'=> array(
			'return'=> array(
				'value'		=> 30,
				'unit'		=> '%',
				'yield_type'=> 'YTM'
			),
			'type'	=> 'debt', //Equity/Debt
			'period'	=> array(
				'value'	=> 3,
				'unit'	=> array(
					'short' => 'yr',
					'long'	=> 'year'
				)
			),
			'share' => array(
				'price' => 400
			)
		),
		'num_investors' => 27,
		'num_trackers'	=> 89,
		'amount_invested'	=> 8000,
		'projected_earnings'=> 2400
	),
	'tallinn-rimi' => array(
		'is_tracked' => false,
		'link'		=> '?p=project&project=tallinn-rimi',
		'handle'	=> 'tallinn-rimi',
		'name'		=> 'Rimi Supermarket',
		'location'	=> array(
			'country'	=> 'Estonia',
			'locality'	=> 'Tallinn',
			'address'	=> 'Paldiski mnt 56, 10617 Tallinn, Estonia',
			'coordinates'=> array (
				'lat' => 59.430172,
				'lng' => 24.697773
			)
		),
		'type_label'=> 'Retail',
		'manager'	=> 'broadgate',
		'goal'		=> 32000000,
		'progress'	=> 32000000*.62,
		'financials'=> array(
			'return'=> array(
				'value'		=> 12,
				'unit'		=> '%',
				'yield_type'=> 'APR'
			),
			'type'	=> 'equity', //Equity/Debt
			'period'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short'	=> 'mo',
					'long'	=> 'month'
				)
			),
			'share' => array(
				'price' => 1600
			)
		),
		'num_investors' => 27,
		'num_trackers'	=> 89,
		'amount_invested'	=> 8000,
		'amount_invested'	=> 32000,
		'projected_earnings'=> 3840
	),
	'spain-maxima' => array(
		'is_tracked'=> false,
		'link'		=> '?p=project&project=spain-maxima',
		'handle'	=> 'spain-maxima',
		'name'		=> 'Maxima Supermarket',
		'location'	=> array(
			'country'	=> 'Spain',
			'locality'	=> 'Palma de Mallorca',
			'address'	=> 'Carrer Biniamar, 14, Palma, Illes Balears, Spain',
			'coordinates'=> array (
				'lat' => 39.581653,
				'lng' => 2.678959
			)
		),
		'type_label'=> 'Retail',
		'manager'	=> 'cbre',
		'goal'		=> 32000000,
		'progress'	=> 32000000*.62,
		'financials'=> array(
			'return'=> array(
				'value'		=> 12,
				'unit'		=> '%',
				'yield_type'=> 'APR'
			),
			'type'	=> 'equity', //Equity/Debt
			'period'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short'	=> 'mo',
					'long'	=> 'month'
				)
			),
			'share' => array(
				'price' => 1600
			)
		),
		'num_investors' => 27,
		'num_trackers'	=> 89,
		'amount_invested'	=> 32000,
		'projected_earnings'=> 3840
	)
);
$featured_projects = array($projects['cafe-klaus'], $projects['tallinn-rimi']);



$investors = array(
	'kadri' => array(
		'name'		=> array(
			'title'	=> 'Ms.',
			'first'	=> 'Kadri',
			'middle'=> 'Liis',
			'last'	=> 'Rääk'
		),
		'handle'	=> 'kadri',
		'email'		=> 'kadri@example.com',
		'phone'		=> '+372 5555 5555',
		'address'	=> array(
			'street'	=> 'Kadriorg 2-3',
			'zip'		=> '10123',
			'locality'	=> 'Tallinn',
			'country'	=> 'EE'
		),
		'bio' 		=> "Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav",
		'qualified'	=> true
	),
	'mart' => array(
		'name'		=> array(
			'first'	=> 'Mart',
			'last'	=> 'Uibo'
		),
		'handle'	=> 'mart',
		'email'		=> 'mart@example.com',
		'phone'		=> '+372 6666 6666',
		'address'	=> array(
			'street'	=> 'Street 44',
			'zip'		=> '22201',
			'locality'	=> 'Minsk',
			'country'	=> 'BY'
		),
		'bio' 		=> "Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav",
		'qualified'	=> false
	),
	'michael' => array(
		'name'		=> array(
			'first'	=> 'Michael',
			'last'	=> 'Walsh'
		),
		'handle'	=> 'michael',
		'email'		=> 'michael@example.com',
		'phone'		=> '+372 7777 7777',
		'address'	=> array(
			'street'	=> 'Cuenca 31',
			'zip'		=> '25730',
			'locality'	=> 'Guayaquil',
			'country'	=> 'EC'
		),
		'bio' 		=> "Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav",
		'qualified'	=> true
	)
);



$managers = array(
	'stonemount' => array(
		'name' => 'Stonemount'
	),
	'broadgate' => array(
		'name' => 'Broadgate'
	),
	'cbre' => array(
		'name' => 'CBRE'
	),
	'gage-partners' => array(
		'name' => 'Gage Partners'
	),
	'trigon' => array(
		'name' => 'Trigon Capital'
	),
	'colony-capital' => array(
		'name' => 'Colony Capital'
	)
);




$countries = array (
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