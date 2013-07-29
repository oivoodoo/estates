<?php

	$profile_name = 'Kadri Liis Rääk';
	$profile_type = 'Accredited Investor';
	$profile_type_class = 'investor accredited';
	
	$goal = format_money(32000000);
	
	$progress = 66; // percentage
	$target_return = 12; //percentage

?>



<section id="profile">
	<div class="head">
		<div class="core">
			<figure class="profile-badge">
				<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/kadri.png"><div class="focus"></div></a>
			</figure>
			<div id="profile-details">
				<h1><?php echo $profile_name; ?> <label class="type <?php echo $profile_type_class; ?>"><?php echo $profile_type; ?></label></h1>
				
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
					<li><a class="" href="#">Edit Profile</a></li>
					<li><a class="" href="#">Notification Settings</a></li>
					<li><a class="warning" href="#">Delete Account</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="body">
		<div class="main">
			
			<div class="tabspace"></div>
			<?php /*<div id="tabs" class="tabs">
				<ul>
					<li><a href="#" class="current">All Activity</a></li><li><a href="#">Projects</a></li><li><a href="#">Investors</a></li><li><a href="#">Developers</a></li><li><a href="#">Flock</a></li>
				</ul>
			</div>*/ ?>
			
			<div>
				<div id="tab-1">
					
					<ul class="feed">
						<li>
							<div class="profile-badge">
								<div>
									<a href="#" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="#">Kadri</a> and 2 other friends invested in <a href="#">Soma Grand</a></h5>
								<div class="entry-meta">
									<div class="profile-badge project">
										<div>
											<a href="#" title="Soma Grand"><img src="img/dummy-thumb-soma-grand.jpg"></a>
											<div class="focus"></div>
										</div>
									</div>
									<div class="profile-badge">
										<div>
											<a href="#" title="Mart Uibo"><img src="img/mart.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<div class="profile-badge">
										<div>
											<a href="#" title="Michael Walsh"><img src="img/michael.png"></a>
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
									<a href="#" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title" title="Kadri Liis Rääk"><a href="#">Kadri</a> joined Flock</h5>
								<div class="entry-meta">
									<div class="profile-badge">
										<div>
											<a href="#" title="Mart Uibo"><img src="img/mart.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<div class="profile-badge">
										<div>
											<a href="#" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
											<div class="focus"></div>
										</div>
									</div>
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
									<a href="#" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="#" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="#" title="Mart Uibo"><img src="img/mart.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="#" title="Michael Walsh"><img src="img/michael.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="#" title="Mart Uibo"><img src="img/mart.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="#" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
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