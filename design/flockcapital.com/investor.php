<?php
	
	$investor_data = array(
		'kadri' => array(
			'name'		=> 'Kadri Liis Rääk',
			'type_label'=> 'Accredited Investor',
			'type_class'=> 'investor accredited'
		),
		'mart' => array(
			'name'		=> 'Mart Uibo'
		),
		'michael' => array(
			'name'		=> 'Michael Walsh',
			'type_label'=> 'Accredited Investor',
			'type_class'=> 'investor accredited'
		)
	);
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h) return;
	
	$investor_name = $investor_data[$h]['name'];
	$investor_short_name = strtok($investor_name, ' ');
	if (array_key_exists('type_class', $investor_data[$h])) $investor_type_class = $investor_data[$h]['type_class'];
	if (array_key_exists('type_label', $investor_data[$h])) $investor_type_label = $investor_data[$h]['type_label'];
?>



<section id="investor">
	<div class="head">
		<div class="core">
			<figure class="profile-badge">
				<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"><div class="focus"></div></a>
			</figure>
			<div id="investor-details">
				<h1><?php echo $investor_name; ?>
					<?php if (isset($investor_type_label) && isset($investor_type_class)) { ?>
						<label class="type <?php echo $investor_type_class; ?>"><?php echo $investor_type_label; ?></label>
					<?php } ?>
				</h1>
				
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
						</div>
						<div>
							<p class="tertiary">↑ Connect external accounts to follow your friends' activity on Flock.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="action">
				<ul>
					<li><a class="" href="?p=investor-edit&i=<?php echo $h; ?>">Edit Profile</a></li>
					<li><a class="" href="?p=investor-edit&i=<?php echo $h; ?>&tab=accreditation">Investor Accreditation</a></li>
					<li><a class="" href="?p=investor-edit&i=<?php echo $h; ?>&tab=notifications">Notification Settings</a></li>
					<li><a class="warning" href="#">Delete Account</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="body">
		<div class="main">
			
			<div class="tabspace"></div>
			
			<div>
				<div id="tab-1">
					
					<ul class="feed">
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=<?php echo $h; ?>" title="<?php echo $investor_name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=investor&i=kadri" title="<?php echo $investor_name; ?>"><?php echo $investor_short_name; ?></a> and 2 other friends invested in <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
								<div class="entry-content">
									<div class="profile-badge project">
										<div>
											<a href="?p=project&project=1800-van-ness" title="1800 Van Ness"><img src="img/1800-van-ness-thumb.png"></a>
											<div class="focus"></div>
										</div>
									</div>
								</div>
								<div class="entry-meta">
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=michael" title="Michael Walsh"><img src="img/michael.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<time>2 days, 7hours ago</time>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=<?php echo $h; ?>" title="<?php echo $investor_name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=investor&i=<?php echo $h; ?>" title="<?php echo $investor_name; ?>"><?php echo $investor_short_name; ?></a> joined Flock</h5>
								<div class="entry-meta">
									<time>2 days, 7hours ago</time>
								</div>
							</div>
						</li>
					</ul>
					
				</div>
			</div>
			
		</div>
		<div class="side">
			<div id="tabs" class="tabs">
				<ul>
					<li><a href="#" class="current">Following</a></li><li><a href="#">Followers</a></li><li><a href="#">Investments</a></li>
				</ul>
			</div>
			<div>
				<div class="connections-wrap">
					
					<ul class="connections">
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=michael" title="Michael Walsh"><img src="img/michael.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</section>