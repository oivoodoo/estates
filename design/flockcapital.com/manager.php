<?php
	
	global $managers;
	
	$h = array_key_exists('m', $_GET) ? $_GET['m'] : null;
	
	if (!$h || !array_key_exists($h, $managers)) return;
	
	$name = $managers[$h]['name'];
	if (array_key_exists('type_class', $managers[$h])) $_type_class = $managers[$h]['type_class'];
	if (array_key_exists('type_label', $managers[$h])) $_type_label = $managers[$h]['type_label'];
?>



<section id="manager">
	<div class="head">
		<div>
			<figure class="profile-badge">
				<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"></a>
			</figure>
			<div id="manager-details">
				<h1><?php echo $name; ?></h1>
				
				<div id="mini-bio">
					<p>Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav<?php /*<br><a href="#" class="hellip">…</a>*/ ?></p>
				</div>
	
				<div class="ext-account-buttons">
					<div>
						<div class="btns">
							<div>
								<button name="ext-account" value="twitter" class="ext-account-button connected-ext-account-button twitter"></button>
								<button name="ext-account" value="google-plus" class="ext-account-button connected-ext-account-button google-plus"></button>
								<button name="ext-account" value="linked-in" class="ext-account-button connected-ext-account-button linked-in"></button>
							</div>
						</div>
					</div>
				</div>
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
									<a href="?p=&d=<?php echo $h; ?>" title="<?php echo $name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=&d=<?php echo $h; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a> launched <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
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
									<a href="?p=&d=<?php echo $h; ?>" title="<?php echo $name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=&d=<?php echo $h; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a> joined Flock</h5>
								<div class="entry-meta">
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
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
					<li><a href="#">Projects</a></li><li><a href="#">Followers</a></li>
				</ul>
			</div>
			<div>
				<div class="connections-wrap">
					
					<ul class="connections">
						<?php /*<li>
							<div class="profile-badge">
								<div>
									<a href="?p=&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>*/ ?>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</section>