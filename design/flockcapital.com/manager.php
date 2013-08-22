<?php
	
	global $managers;
	
	$h = array_key_exists('m', $_GET) ? $_GET['m'] : null;
	
	if (!$h || !array_key_exists($h, $managers)) return;
	
	$manager_name = $managers[$h]['name'];
	if (array_key_exists('type_class', $managers[$h])) $_type_class = $managers[$h]['type_class'];
	if (array_key_exists('type_label', $managers[$h])) $_type_label = $managers[$h]['type_label'];
?>



<section id="manager">

	<div class="head <?php /*fix elevate*/ ?>">
	
		<div class="contract">
			<figure class="profile-badge">
				<img src="img/<?php echo $h; ?>.png">
			</figure>
			<div class="profile-details">
				<h3 class="name"><?php echo $manager_name; ?></h3>
				
				<div class="mini-bio">
					<p>Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav<?php /*<br><a href="#" class="hellip">…</a>*/ ?></p>
				</div>
	
				<div class="ext-account-buttons">
					<span>
						<button name="ext-account" value="twitter" class="ext-account-button twitter"></button>
						<button name="ext-account" value="google-plus" class="ext-account-button google-plus"></button>
						<button name="ext-account" value="linked-in" class="ext-account-button linked-in"></button>
					</span>
				</div>
			</div>
		</div>
		
	</div>
	
	
	<div class="body">
		<div class="main">
			<div>
				
				<div class="switch-group">
					<div id="investments-content" class="tab-content main-switch main-switch-current">
						
						<div class="tabs project-tabs">
							<ul>
								<li><a href="#investments"><em>3</em> Investments</a></li>
							</ul>
						</div>
						
						<div>
							<?php
								for ($i=0; $i<1; $i++) {
									$rand_project = array_rand($projects);
									$project = $projects[$rand_project];
									$project_badge_size = 'dash-invested';
									require('project-badge.php');
								}
							?>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		<div class="side">
			<div>
			
				<div class="switch-group">
					
					<div id="followers-content" class="tab-content side-tab-content tab-content-connections side-switch side-switch-current">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#followers"><em>189</em> Followers</a></li>
							</ul>
						</div>
						<ul class="connections">
							<?php
								for ($i=0; $i<10; $i++) {
									$rand_investor = array_rand($investors);
									$profile_data = $investors[$rand_investor];
									require('connection-badge.php');
								}
							?>
						</ul>
						<a class="show-all-connections followers" href="javascript:void(0)">Show all</a>
				
					</div>
					
				</div>
					
				<div id="timeline-content" class="tab-content side-tab-content">
					
					<ul class="feed">
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=&d=<?php echo $h; ?>" title="<?php echo $manager_name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=&d=<?php echo $h; ?>" title="<?php echo $manager_name; ?>"><?php echo $manager_name; ?></a> launched <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
								<div class="entry-content">
									<div class="profile-badge project">
										<div>
											<a href="?p=project&project=1800-van-ness" title="1800 Van Ness"><img src="img/1800-van-ness.png"></a>
											<div class="focus"></div>
										</div>
									</div>
								</div>
								<div class="entry-meta">
									<time>2 days, 7 hours ago</time>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=&d=<?php echo $h; ?>" title="<?php echo $manager_name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=&d=<?php echo $h; ?>" title="<?php echo $manager_name; ?>"><?php echo $manager_name; ?></a> joined Flock</h5>
								<div class="entry-meta">
									<time>2 days, 7 hours ago</time>
								</div>
							</div>
						</li>
					</ul>
				
				</div>
				
			</div>
		</div>
		
	</div>
		
	<div id="map-content" class="tab-content keep">
		
		<div id="dashboard_investments_map_canvas"></div>
		<script>
			window.gmaps.dashboard_investments = [
				<?php
					for ($i=0; $i<1; $i++) {
						$rand_project = array_rand($projects);
						$map_project = $projects[$rand_project];
						
						echo $i>0 ? ',' : '';
						echo "{\n";
							echo "lat: ".$map_project['location']['coordinates']['lat'].",\n";
							echo "lng: ".$map_project['location']['coordinates']['lng'].",\n";
							echo "address: '".$map_project['location']['address']."',\n";
							echo "title: '".$map_project['name']."',\n";
							echo "link: '".$map_project['link']."'\n";
						echo '}';
					}
				?>
			];
		</script>
		
	</div>
	
</section>