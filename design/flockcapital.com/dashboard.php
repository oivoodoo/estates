<?php

	$h = 'kadri';

?>


<section id="dashboard">

	<div id="tabs" class="submenu">
		<div>
			<ul>
				<li><a class="dashboard current" href="?p=dashboard">Dashboard</a></li>
				<li><a class="profile" href="?p=investor-edit&i=<?php echo $h ?>">Profile</a></li>
				<li><a class="settings" href="?p=settings&i=<?php echo $h ?>">Settings</a></li>
			</ul>
		</div>
	</div>

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
								<?php break;*/
							
							default: ?>
								<div class="tab-content gridwrap">
									
									<?php /*
									<div class="message quiet">
										<div>
											<span>Your profile is 33% complete</span> <a class="button theta thicker" href="?p=investor-edit&i=<?php echo $h; ?>">Complete your profile</a>
										</div>
									</div>*/ ?>
									
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
			
		</div><?php /*
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
		</div>*/ ?>
	</div>
</section>