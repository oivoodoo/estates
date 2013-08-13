<?php

	global $projects, $investors;
	$h = 'kadri';
	
	if (!$h || !array_key_exists($h, $investors)) return;
	
?>


<section id="dashboard">

	<?php /*<div id="tabs" class="submenu">
		<div>
			<ul>
				<li><a class="dashboard current" href="?p=dashboard">Dashboard</a></li>
				<li><a class="profile" href="?p=investor-edit&i=<?php echo $h ?>">Profile</a></li>
				<li><a class="settings" href="?p=settings&i=<?php echo $h ?>">Settings</a></li>
			</ul>
		</div>
	</div>*/ ?>
	
	<div class="main-numbers">
		<div class="gridwrap">
			<ul>
				<li><div><em><?php echo format_money(9999); ?></em><label>total earnings</label></div></li>
				<li><div><em><?php echo format_money(82000); ?></em> <label>total invested</label></div></li>
				<li><div><em>3</em> <label>projects invested in</label></div></li>
				<li><div><em>7</em> <label>projects tracked</label></div></li>
			</ul>
		</div>
	</div>

	<div id="tabs" class="tabs major gridwrap-padded fix">
		<ul>
			<li><a href="?p=dashboard#reports" id="reports-tab" class="current"><span>Reports</span></a></li>
			<li><a href="?p=dashboard#investments" id="investments-tab"><span><em>3</em> Investments</span></a></li>
			<li><a href="?p=dashboard#tracking" id="tracking-tab"><span><em>7</em> Tracking</span></a></li>
			<li><a href="?p=dashboard#following" id="following-tab"><span><em>27</em> Following</span></a></li>
			<li><a href="?p=dashboard#followers" id="followers-tab"><span><em>3</em> Followers</span></a></li>
			<li><a href="?p=dashboard#timeline" id="timeline-tab"><span>Timeline</span></a></li>
			<li><a href="?p=dashboard#map" id="map-tab"><span>Map</span></a></li>
		</ul>
	</div>
	

	<div class="body">
		<div class="main">
			<div>
			
				<div id="reports-content" class="tab-content keep">
					<h5 class="chart-title">Performance</h5>
					<div>
							
						<div id="allocation">
							<canvas class="graph-canvas" id="allocation-canvas" height="100" width="100"></canvas>
							<script>
								window.graphs.allocation = {
									type: 'doughnut',
									data: [
										{
											value: 30,
											color: 'hsl(151, 63%, 43%)'
										},
										{
											value : 70,
											color : 'hsl(151, 23%, 83%)'
										}
									]
								}
							</script>
						</div>
					
						<div id="performance">
							<canvas class="graph-canvas" id="performance-canvas" height="250" width="400"></canvas>
							<script>
								window.graphs.performance = {
									type: 'line',
									data: {
										labels : ['', "February '13", "March '13", "April '13", "May '13", "June '13", "August '13"],
										datasets : [
											{
												fillColor : 'hsla(151, 63%, 43%, .1)',
												strokeColor : 'hsl(151, 63%, 43%)',
												pointColor : 'white',
												data : [0, 330, 401, 480, 770, 800, 999]
											}
										]
										
									},
									options: {
										scaleOverride : true,
										
										//** Required if scaleOverride is true **
										//Number - The number of steps in a hard coded scale
										scaleSteps: 5,
										//Number - The value jump in the hard coded scale
										scaleStepWidth: 200,
										//Number - The scale starting value
										scaleStartValue: 0,
									}
								}
							</script>
						</div>
					
					</div>
				</div>
				
				<div class="switch-group">
					<div id="investments-content" class="tab-content main-switch main-switch-current">
						
						<div class="tabs project-tabs">
							<ul>
								<li><a href="#investments" class="current"><em>3</em> Investments</a></li><li><a href="#tracking"><em>7</em> Tracking</a></li>
							</ul>
						</div>
						
						<div>
							<?php
								for ($i=0; $i<3; $i++) {
									$rand_project = array_rand($projects);
									$project = $projects[$rand_project];
									$project_badge_size = 'dash-invested';
									require('project-badge.php');
								}
							?>
						</div>
						
					</div>
					
					<div id="tracking-content" class="tab-content main-switch">
						
						<div class="tabs project-tabs">
							<ul>
								<li><a href="#investments"><em>3</em> Investments</a></li><li><a href="#tracking" class="current"><em>7</em> Tracking</a></li>
							</ul>
						</div>
						
						<div>
							<?php
								for ($i=0; $i<7; $i++) {
									$rand_project = array_rand($projects);
									$project = $projects[$rand_project];
									$project['is_tracked'] = true;
									$project_badge_size = 'dash-tracking';
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
					<div id="following-content" class="tab-content side-switch side-switch-current">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#following" class="current"><em>27</em> Investors</a></li><li><a href="#followers"><em>189</em> Followers</a></li>
							</ul>
						</div>
						<ul class="connections">
							<?php
								for ($i=0; $i<15; $i++) {
									$rand_investor = array_rand($investors);
									$profile_data = $investors[$rand_investor];
									require('connection-badge.php');
								}
							?>
						</ul>
				
					</div>
					
					<div id="followers-content" class="tab-content side-switch">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#following"><em>27</em> Investors</a></li><li><a href="#followers" class="current"><em>189</em> Followers</a></li>
							</ul>
						</div>
						<ul class="connections">
							<?php
								for ($i=0; $i<15; $i++) {
									$rand_investor = array_rand($investors);
									$profile_data = $investors[$rand_investor];
									require('connection-badge.php');
								}
							?>
						</ul>
				
					</div>
				</div>
					
				<div id="timeline-content" class="tab-content">
					
					<ul class="feed">
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=<?php echo $h; ?>" title="Kadri Liis Rääk"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=investor&i=<?php echo $h; ?>">Kadri</a> and 2 other friends invested in <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
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
									<a href="?p=investor&i=<?php echo $h; ?>" title="Kadri Liis Rääk"><img src="img/<?php echo $h; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title" title="Kadri Liis Rääk"><a href="#">Kadri</a> joined Flock</h5>
								<div class="entry-meta">
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<div class="profile-badge">
										<div>
											<a href="?p=investor&i=<?php echo $h; ?>" title="Kadri Liis Rääk"><img src="img/<?php echo $h; ?>.png"></a>
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
		
		<div id="map-content" class="tab-content"></div>
		
	</div>

<?php /*
	<div class="body">
		<div class="main">
			
			
			
			<div id="tabs-contents" class="tabs-contents">
				<div>
					<?php
						switch($tab) {
							/*case 'investments': ?>
								<div class="tab-content">
									
									<div class="projects gridwrap">
										<?php
											$projects = array(
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												),
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												)
											);
											foreach($projects as $project) {
												require('project-badge.php');
											}
										?>
									</div>
									
								</div>
								<?php break;
							
							case 'projects': ?>
								<div class="tab-content">
									
									<div class="projects gridwrap">
										<?php
											$projects = array(
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												),
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												),
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												),
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												),
												array(
													'link'		=> '?p=project&project=1800-van-ness',
													'name'		=> '1800 Van Ness',
													'handle'	=> '1800-van-ness',
													'type_label'=> 'Residential',
													''	=> array(
														'handle'=> 'broadgate',
														'name'	=> 'Broadgate'
													),
													'goal'		=> format_money(32000000),
													'progress'	=> 66, // percentage
													'terms'		=> array(
														'<b>12%</b> target return',
														'<b>Equity</b> purchase',
														'<b>24 month</b> holding period'
													)
												)
											);
											foreach($projects as $project) {
												require('project-badge.php');
											}
										?>
									</div>
									
					