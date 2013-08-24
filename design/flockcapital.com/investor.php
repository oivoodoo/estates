<?php

	global $investors;
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h || !array_key_exists($h, $investors)) return;
	
	$me = (isset($_SESSION['auth']) && $_SESSION['auth'] && $h==$_SESSION['user']);
	
	$investor_name = implode(' ', $investors[$h]['name']);
	$investor_short_name = $investors[$h]['name']['first'];

?>



<section id="investor" <?php if ($me) { echo 'class="me"'; }?>>
	
	<?php if ($me) { ?>
		<div class="message">
			<div>
				This is Your profile. &nbsp;&nbsp;<a class="button" href="?p=settings&i=<?php echo $h; ?>">Settings</a>
			</div>
		</div>
	<?php } ?>
	
	<div class="head <?php /*fix elevate*/ ?>">
	
		<div class="contract">
			
			<figure class="profile-badge">
				<img src="img/<?php echo $h; ?>.png"><div class="focus"></div>
			</figure>
			<div class="profile-details">
				<h3 class="name">
					<?php echo $investor_name; ?>
					<div class="ext-account-buttons">
						<span>
							<button name="ext-account" value="facebook" class="ext-account-button facebook"></button>
							<button name="ext-account" value="twitter" class="ext-account-button twitter"></button>
						</span>
					</div>
				</h3>
				<div class="mini-bio">
					<p>Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav<?php /*<br><a href="#" class="hellip">…</a>*/ ?></p>
				</div>
			</div>
		</div>
		
	</div>
	
	
	
	<div class="body">
		<div class="main">
			<div>
				
				<div class="switch-group">
					<div id="investments-content" class="tab-content main-switch main-switch-current">
					
						<?php
							for ($i=0; $i<3; $i++) {
								$rand_project = array_rand($projects);
								$investments[] = $projects[$rand_project];
							}
						?>
						
						<div class="tabs project-tabs">
							<ul>
								<li><a href="#investments" class="current"><em>3</em> Investments</a></li><li><a href="#tracking"><em>7</em> Tracking</a></li>
							</ul>
						</div>
		
						<div class="map-view tucked">
							
							<div class="map-toolbar-one">
								<button>Show map</button>
							</div>
							
							<div class="map-toolbar-two">
								<button></button>
							</div>
							
							<div class="map-viewport">
								
								<div id="dashboard_investments_map_canvas" class="map-canvas"></div>
								<script>
									window.gmaps.dashboard_investments = [
										<?php
											for ($i=0; $i<3; $i++) {
												$map_project = $investments[$i];
												
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
							
						</div>
						
						<div class="listing">
							<?php
								for ($i=0; $i<3; $i++) {
									$project = $investments[$i];
									$project_badge_size = 'invested';
									require('project-badge.php');
								}
							?>
						</div>
						
					</div>
					
					<div id="tracking-content" class="tab-content main-switch">
					
						<?php
							for ($i=0; $i<7; $i++) {
								$rand_project = array_rand($projects);
								$tracked[] = $projects[$rand_project];
							}
						?>
						
						<div class="tabs project-tabs">
							<ul>
								<li><a href="#investments"><em>3</em> Investments</a></li><li><a href="#tracking" class="current"><em>7</em> Tracking</a></li>
							</ul>
						</div>
		
						<div class="map-view tucked">
							
							<div class="map-toolbar-one">
								<button>Show map</button>
							</div>
							
							<div class="map-toolbar-two">
								<button></button>
							</div>
							
							<div class="map-viewport">
								
								<div id="dashboard_tracked_map_canvas" class="map-canvas"></div>
								<script>
									window.gmaps.dashboard_tracked = [
										<?php
											for ($i=0; $i<3; $i++) {
												$map_project = $tracked[$i];
												
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
							
						</div>
						
						<div class="listing">
							<?php
								for ($i=0; $i<7; $i++) {
									$project = $tracked[$i];
									$project['is_tracked'] = true;
									$project_badge_size = 'tracking';
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
					<div id="following-content" class="tab-content side-tab-content tab-content-connections side-switch side-switch-current">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#following" class="current"><em>27</em> Following</a></li><li><a href="#followers"><em>189</em> Followers</a></li>
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
						<a class="show-all-connections following" href="javascript:void(0)">Show all</a>
				
					</div>
					
					<div id="followers-content" class="tab-content side-tab-content tab-content-connections side-switch">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#following"><em>27</em> Following</a></li><li><a href="#followers" class="current"><em>189</em> Followers</a></li>
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
									<a href="?p=investor&i=<?php echo $h; ?>" title="<?php echo $investor_name; ?>"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h6 class="entry-title"><a href="?p=investor&i=<?php echo $h; ?>"><?php echo $investor_short_name; ?></a> and <a href="javascript:void(0)">1 other friend</a> invested in <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h6>
								<div class="entry-content">
									<div class="profile-badge project">
										<div>
											<a href="?p=project&project=1800-van-ness" title="1800 Van Ness"><img src="img/1800-van-ness.png"></a>
											<div class="focus"></div>
										</div>
									</div>
								</div>
								<div class="entry-meta">
									<?php
										$rand_investor = $h;
										while ($rand_investor == $h) $rand_investor = array_rand($investors);
										$co_investor = $investors[$rand_investor];
									?>
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=<?php echo $co_investor['handle'] ?>" title="<?php echo implode(' ', $co_investor['name']) ?>"><img src="img/<?php echo $co_investor['handle'] ?>.png"></a>
										</div>
									</div>
									<time>2 days, 7 hours ago</time>
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
								<h6 class="entry-title" title="<?php echo $investor_name; ?>"><a href="#"><?php echo $investor_short_name; ?></a> joined Flock</h6>
								<div class="entry-meta">
									<time>3 days, 2 hours ago</time>
								</div>
							</div>
						</li>
					</ul>
				
				</div>
				
			</div>
		</div>
		
	</div>
		
	<?php /*<div id="map-content" class="tab-content keep">
		
		<div id="dashboard_investments_map_canvas"></div>
		<script>
			window.gmaps.dashboard_investments = [
				<?php
					for ($i=0; $i<3; $i++) {
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
		
	</div>*/ ?>
	
	
</section>