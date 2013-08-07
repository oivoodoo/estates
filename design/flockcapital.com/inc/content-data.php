<?php

include_once('helper-functions.php');


$projects = array(
	'1800-van-ness' => array(
		'link'		=> '?p=project&project=1800-van-ness',
		'handle'	=> '1800-van-ness',
		'name'		=> '1800 Van Ness',
		'type_label'=> 'Residential',
		'manager'	=> 'stonemount',
		'goal'		=> 32000000,
		'progress' => 32000000*.34,
		'financials'=> array(
			'yield'	=> array(
				'value'	=> 12,
				'unit'	=> '%'
			),
			'type'	=> 'equity', //Equity/Debt
			'term'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mos',
					'long' => 'months'
				)
			),
			'share' => array(
				'price' => 1400
			)
		),
		'terms'		=> array(
			'<b>12%</b> target return',
			'<b>Equity</b> purchase',
			'<b>24 mo</b> holding period'
		)
	),
	'vilnius-rimi' => array(
		'link'		=> '?p=project&project=vilnius-rimi',
		'handle'	=> 'vilnius-rimi',
		'name'		=> 'Rimi Supermaket',
		'location'	=> array(
			'country'	=> 'Lithuania',
			'Locality'	=> 'Vilnius',
			'address'	=> 'Tuskulėnų gatvė 2, Vilnius 09213, Lithuania'
		),
		'type_label'=> 'Retail',
		'manager'	=> 'trigon',
		'goal'		=> 32000000,
		'progress' => 21120000,
		'financials'=> array(
			'yield'	=> array(
				'value'	=> 12,
				'unit'	=> '%'
			),
			'type'	=> 'equity', //Equity/Debt
			'term'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mos',
					'long' => 'months'
				)
			),
			'share' => array(
				'price' => 1500
			)
		),
		'terms'		=> array(
			'<b>12%</b> target return',
			'<b>Equity</b> purchase',
			'<b>24 mo</b> holding period'
		)
	),
	'cafe-klaus' => array(
		'link'		=> '?p=project&project=cafe-klaus',
		'handle'	=> 'cafe-klaus',
		'name'		=> 'Café Klaus',
		'location'	=> array(
			'country'	=> 'Estonia',
			'Locality'	=> 'Tallinn',
			'address'	=> 'Kalasadama 8, 10415 Tallinn, Estonia'
		),
		'type_label'=> 'Retail',
		'manager'	=> 'gage-partners',
		'goal'		=> 32000000,
		'progress' => 21120000,
		'financials'=> array(
			'yield'	=> array(
				'value'	=> 12,
				'unit'	=> '%'
			),
			'type'	=> 'equity', //Equity/Debt
			'term'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mos',
					'long' => 'months'
				)
			),
			'share' => array(
				'price' => 1500
			)
		),
		'terms'		=> array(
			'<b>12%</b> target return',
			'<b>Equity</b> purchase',
			'<b>24 mo</b> holding period'
		)
	),
	'tallinn-rimi' => array(
		'link'		=> '?p=project&project=tallinn-rimi',
		'handle'	=> 'tallinn-rimi',
		'name'		=> 'Rimi Supermarket',
		'location'	=> array(
			'country'	=> 'Estonia',
			'Locality'	=> 'Tallinn',
			'address'	=> 'Paldiski mnt 56, 10617 Tallinn, Estonia'
		),
		'type_label'=> 'Retail',
		'manager'	=> 'broadgate',
		'goal'		=> 32000000,
		'progress' => 21120000,
		'financials'=> array(
			'yield'	=> array(
				'value'	=> 12,
				'unit'	=> '%'
			),
			'type'	=> 'equity', //Equity/Debt
			'term'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mos',
					'long' => 'months'
				)
			),
			'share' => array(
				'price' => 1500
			)
		),
		'terms'		=> array(
			'<b>12%</b> target return',
			'<b>Equity</b> purchase',
			'<b>24 mo</b> holding period'
		)
	),
	'spain-maxima' => array(
		'link'		=> '?p=project&project=spain-maxima',
		'handle'	=> 'spain-maxima',
		'name'		=> 'Maxima Supermarket',
		'location'	=> array(
			'country'	=> 'Spain',
			'Locality'	=> 'Palma de Mallorca',
			'address'	=> 'Carrer Biniamar, 14, Palma, Illes Balears, Spain'
		),
		'type_label'=> 'Retail',
		'manager'	=> 'cbre',
		'goal'		=> 32000000,
		'progress' => 21120000,
		'financials'=> array(
			'yield'	=> array(
				'value'	=> 12,
				'unit'	=> '%'
			),
			'type'	=> 'equity', //Equity/Debt
			'term'	=> array(
				'value'	=> 24,
				'unit'	=> array(
					'short' => 'mos',
					'long' => 'months'
				)
			),
			'share' => array(
				'price' => 1500
			)
		),
		'terms'		=> array(
			'<b>12%</b> target return',
			'<b>Equity</b> purchase',
			'<b>24 mo</b> holding period'
		)
	)
);
$featured_projects = array($projects['cafe-klaus'], $projects['tallinn-rimi']);



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




