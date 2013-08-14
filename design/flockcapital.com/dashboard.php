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

	<div id="tabs" class="tabs major gridwrap-padded fix">
		<ul>
			<li><a href="?p=dashboard#reports" class="tab reports-tab current"><span>Reports</span></a></li>
			<li><a href="?p=dashboard#investments" class="tab investments-tab"><span><em>3</em> Investments</span></a></li>
			<li><a href="?p=dashboard#tracking" class="tab tracking-tab"><span><em>7</em> Tracking</span></a></li>
			<li><a href="?p=dashboard#following" class="tab following-tab"><span><em>27</em> Following</span></a></li>
			<li><a href="?p=dashboard#followers" class="tab followers-tab"><span><em>3</em> Followers</span></a></li>
			<li><a href="?p=dashboard#timeline" class="tab timeline-tab"><span>Timeline</span></a></li>
			<li><a href="?p=dashboard#map" class="tab map-tab"><span>Map</span></a></li>
		</ul>
	</div>
	
	<div id="reports-content" class="head tab-content keep">
		
		<?php /*<div id="main-numbers" class="financials">
			<div>
				<div>
					<div>
						<ul class="size-6"><li class="earnings"><div><b><?php echo format_money(9999); ?></b> <label>earnings in total</label></div></li></ul>
						<ul class="size-6"><li class="invested"><div><b><?php echo format_money(82000); ?></b> <label>invested in total</label></div></li></ul>
						<ul class="size-6"><li class="investments"><div><b>3</b> <label>investments</label></div></li></ul>
					</div>
				</div>
			</div>
		</div>*/ ?>
		
		<div id="charts">
		
			<div id="performance">
				<div class="big-number invested"><div><b><?php echo format_money(82000); ?></b> <label>invested in total</label></div></div>
				<div class="big-number earnings"><div><b><?php echo format_money(9999); ?></b> <label>earnings in total</label></div></div>
				
				<canvas class="graph-canvas" id="performance-canvas" height="100" width="400"></canvas>
				<script>
					window.graphs.performance = {
						type: 'line',
						data: {
							labels : ['', "March '13", "April '13", "May '13", "June '13", "July '13", "August '13"],
							datasets : [
								{
									fillColor : 'hsla(0, 0%, 97%, .10)',
									strokeColor : 'hsl(151, 63%, 43%)',
									pointStrokeColor : 'transparent',
									pointColor : 'transparent',
									data : [82, 82, 82, 82, 82, 82, 82]
								},{
									fillColor : 'hsla(151, 63%, 43%, .1)',
									strokeColor : 'hsl(151, 63%, 43%)',
									pointColor : 'white',
									data : [82, 83, 85.3, 85.9, 88.8, 90.13, 92.999]
								}
							]	
							
						},
						options: {
							scaleOverride : true,
							
							//** Required if scaleOverride is true **
							//Number - The number of steps in a hard coded scale
							scaleSteps: 4,
							//Number - The value jump in the hard coded scale
							scaleStepWidth: 4,
							//Number - The scale starting value
							scaleStartValue: 80,
						}
					}
				</script>
			</div>
				
			<div id="allocation">
				<div class="big-number investments"><div><b>3</b> <label>investments</label></div></div>
				
				<?php
					$asset_allocation = array(
						'debt' => array(
							'label'		=> 'Debt',
							'percentage'=> 30,
							'color'		=> 'hsl(151, 63%, 43%)'
						),
						'loan' => array(
							'label'		=> 'Loan',
							'percentage'=> 70,
							'color'		=> 'hsl(0, 0%, 97%)'
						)
					);
				?>
				
				<div class="chart-table">
					<div class="chart-cell">
						<canvas class="graph-canvas" id="allocation-canvas" height="100" width="100"></canvas>
						<script>
						window.graphs.allocation = {
							type: 'doughnut',
							data: [
								<?php
									foreach ($asset_allocation as $a) {
										$aa[] = '{
											value: '.$a['percentage'].',
											color: "'.$a['color'].'"
										}';
									}
									echo implode(',', $aa);
								?>
							]
						}
					</script>
					</div>
					<div class="legend-cell">
						<ul class="doughnut-legend">
							<?php
								foreach ($asset_allocation as $a) {
									echo '<li><b style="color:'.$a['color'].';">'.$a['percentage'].'<i>%</i></b> <label>'.$a['label'].'</label></li>';
								}
							?>
						</ul>
					</div>
				</div>
				
			</div>
		
		</div>
		
	</div>

	<div class="body">
		<div class="main">
			<div>
				
				<div class="switch-group">
					<div id="investments-content" class="tab-content main-switch">
						
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
					
					<div id="tracking-content" class="tab-content main-switch main-switch-current">
						
						<div class="tabs project-tabs">
							<ul>
								<li><a href="#investments"><em>3</em> Investments</a></li><li><a href="#tracking" class="current"><em>7</em> Tracking</a></li>
							</ul>
						</div>
						
						<div id="tracking-list">
							<?php
								for ($i=0; $i<7; $i++) {
									$rand_project = array_rand($projects);
									$project = $projects[$rand_project];
									$project['is_tracked'] = true;
									$project_badge_size = 'dash-tracking-list';
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
									<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=investor&i=<?php echo $h; ?>">Mart</a> and <a href="javascript:void(0)">1 other friend</a> invested in <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
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
											<a href="?p=investor&i=michael" title="Michael Walsh"><img src="img/michael.png"></a>
											<div class="focus"></div>
										</div>
									</div>
									<time>2 days, 7 hours ago</time>
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
									<time>3 days, 2 hours ago</time>
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
					for ($i=0; $i<10; $i++) {
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
									
								</div>
								<?php break;
							
							case 'investors': ?>
								<div class="tab-content">
										
										<ul class="connections-list  gridwrap">
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
													'type'		=> 'investor',
													'type_class'=> 'investor'
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
												)
											);
											foreach ($profiles as $profile_data) {
												require('connection-badge-list.php');
											} ?>
										</ul>
										
									</div>
								<?php break;
							
							case 's': ?>
								<div class="tab-content">
									
									<ul class="connections-list gridwrap">
										<?php
										$profiles = array(
											array(
												'name'		=> 'Trigon Capital',
												'handle'	=> 'trigon',
												'type'		=> ''
											),
											array(
												'name'		=> 'Broadgate Capital',
												'handle'	=> 'broadgate',
												'type'		=> ''
											),
											array(
												'name'		=> 'Broadgate',
												'handle'	=> 'broadgate',
												'type'		=> ''
											),
											array(
												'name'		=> 'Trigon Capital',
												'handle'	=> 'trigon',
												'type'		=> ''
											),
											array(
												'name'		=> 'Broadgate Capital',
												'handle'	=> 'broadgate',
												'type'		=> ''
											),
											array(
												'name'		=> 'Trigon Capital',
												'handle'	=> 'trigon',
												'type'		=> ''
											),
											array(
												'name'		=> 'Broadgate',
												'handle'	=> 'broadgate',
												'type'		=> ''
											)
										);
										foreach ($profiles as $profile_data) {
											require('connection-badge-list.php');
										} ?>
									</ul>
									
								</div>
								<?php break;*
							
							default: ?>
								<div class="tab-content gridwrap">
									
									<?php /*
									<div class="message quiet">
										<div>
											<span>Your profile is 33% complete</span> <a class="button theta thicker" href="?p=investor-edit&i=<?php echo $h; ?>">Complete your profile</a>
										</div>
									</div>* ?>
									
									<ul class="feed">
										<li>
											<div class="profile-badge">
												<div>
													<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
													<div class="focus"></div>
												</div>
											</div>
											<div class="entry">
												<h5 class="entry-title"><a href="?p=investor&i=kadri">Kadri</a> and 2 other friends invested in <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
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
													<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
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
								<?php break;
						}
					?>
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
	</div>*/ ?>

</section>