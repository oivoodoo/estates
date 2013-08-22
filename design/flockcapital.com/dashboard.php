<?php

	global $projects, $investors;
	$h = $_SESSION['user'];

	if (!$h || !array_key_exists($h, $investors)) return;

?>


<section id="dashboard">

	<div id="reports-content" class="head tab-content keep">
		<div id="charts">

			<div id="performance">
			</div>

			<div id="allocation">
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

						<div id="tracking-list">
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

	</div>

</section>
