<?php

	global $investors;
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h || !array_key_exists($h, $investors)) return;
	
	$investor_name = implode(' ', $investors[$h]['name']);
	$investor_short_name = $investors[$h]['name']['first'];

?>



<section id="investor" <?php if ($h=='kadri') { echo 'class="me"'; }?>>
	
	<?php /*if ($h=='kadri') { ?>
	<div id="tabs" class="submenu tabs">
		<div>
			<ul>
				<li><a class="dashboard" href="?p=dashboard">Dashboard</a></li>
				<li><a class="view current" href="?p=investor&i=<?php echo $h ?>">My Profile</a></li>
				<li><a class="accreditation" href="?p=investor-edit&i=<?php echo $h ?>&tab=accreditation">Investor Accreditation</a></li>
				<li><a class="settings" href="?p=investor-edit&i=<?php echo $h ?>&tab=settings">Settings</a></li>
			</ul>
		</div>
	</div>
	<?php }*/ ?>
	
	<?php if ($h=='kadri') { ?>
		<div class="message">
			<div>
				This is Your profile. &nbsp;&nbsp;<a class="button" href="?p=investor-edit&i=<?php echo $h; ?>">Edit</a>
			</div>
		</div>
	<?php } ?>
	
	<div class="head">
		<div>
			
			<figure class="profile-badge">
				<img src="img/<?php echo $h; ?>.png"><div class="focus"></div>
			</figure>
			<div class="profile-details">
				<h3 class="name"><?php echo $investor_name; /*?>
					<?php if (isset($investor_type_label) && isset($investor_type_class)) { ?>
						<label class="type <?php echo $investor_type_class; ?>"><?php echo $investor_type_label; ?></label>
					<?php }*/ ?></h3>
				
				<div class="mini-bio">
					<p>Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav<?php /*<br><a href="#" class="hellip">…</a>*/ ?></p>
				</div>
	
				<div class="ext-account-buttons">
					<div>
						<div class="btns">
							<div>
								<button name="ext-account" value="facebook" class="ext-account-button facebook connected-ext-account-button"></button>
								<button name="ext-account" value="twitter" class="ext-account-button twitter connected-ext-account-button"></button>
								<?php /*if ($h=='kadri') { ?>
								<button name="ext-account" value="google-plus" class="ext-account-button google-plus"></button>
								<button name="ext-account" value="linked-in" class="ext-account-button linked-in"></button>
								<?php }*/ ?>
							</div>
						</div>
						<?php /*if ($h=='kadri') { ?>
						<div>
							<p class="tertiary">Connect external accounts to follow your friends' activity on Flock.</p>
						</div>
						<?php }*/ ?>
					</div>
				</div>
			</div>
			<?php /*if ($h=='kadri') { ?>
			<div class="action">
				<ul>
					<li><a class="" href="?p=investor-edit&i=<?php echo $h; ?>">Edit Profile</a></li>
					<li><a class="" href="?p=investor-edit&i=<?php echo $h; ?>&tab=accreditation">Investor Accreditation</a></li>
					<li><a class="" href="?p=investor-edit&i=<?php echo $h; ?>&tab=notifications">Notification Settings</a></li>
					<li><a class="warning" href="#">Delete Account</a></li>
				</ul>
			</div>
			<?php }*/ ?>
		</div>
	</div>
	
	<div class="body">
		<div class="main">
			
			<div>
				<div id="tab-1" class="feed-wrapper">
					
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
											<a href="?p=project&project=1800-van-ness" title="1800 Van Ness"><img src="img/1800-van-ness.png"></a>
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
			
			<div>
				<div>
				
					<div class="tabs connection-tabs">
						<ul>
							<li><a href="#" class="current"><em>2</em> Investments</a></li>
							<li><a href="#"><em>8</em> Follows</a></li>
							<li><a href="#"><em>473</em> Followers</a></li>
						</ul>
					</div>
					<ul class="connections">
						<?php
								$profiles = array(
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Mart Uibo',
										'handle'	=> 'mart',
										'type'		=> 'investor'
									),
									array(
										'name'		=> 'Michael Walsh',
										'handle'	=> 'michael',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Mart Uibo',
										'handle'	=> 'mart',
										'type'		=> 'investor'
									),
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Michael Walsh',
										'handle'	=> 'michael',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Mart Uibo',
										'handle'	=> 'mart',
										'type'		=> 'investor'
									),
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Mart Uibo',
										'handle'	=> 'mart',
										'type'		=> 'investor'
									),
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Michael Walsh',
										'handle'	=> 'michael',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Kadri Liis Rääk',
										'handle'	=> 'kadri',
										'type'		=> 'investor',
										'type_label'=> 'Accredited Investor',
										'type_class'=> 'investor accredited'
									),
									array(
										'name'		=> 'Mart Uibo',
										'handle'	=> 'mart',
										'type'		=> 'investor'
									)
								);
								foreach ($profiles as $profile_data) {
									require('connection-badge.php');
								}
							?>
					</ul>

					
				</div>
			</div>
		</div>
	</div>
</section>