<?php

	global $projects, $managers, $investors;

	$h = array_key_exists('project', $_GET) ? $_GET['project'] : null;
	
	if (!$h || !array_key_exists($h, $projects)) return;
	
	$project = $projects[$h];

	$handle		= array_key_exists('handle',	$project)	? $project['handle']	: null;
	$name		= array_key_exists('name',		$project)	? $project['name']		: null;
	
	$link				= array_key_exists('link',		$project)			? $project['link']			: null;
	$type				= array_key_exists('type_label',$project)			? $project['type_label']	: null;
	
	$manager			= array_key_exists('manager',	$project) &&
						  array_key_exists($project['manager'], $managers)	? $managers[$project['manager']] : null;
	
	$goal				= array_key_exists('goal',		$project)			? $project['goal']			: null;
	$progress			= array_key_exists('progress',	$project)			? $project['progress']		: null;
	$progress_percent	= ($goal && $progress)								? round($progress/$goal*100): null;	// percentage
	$financials			= array_key_exists('financials',$project)			? $project['financials']	: null;
	$location			= array_key_exists('location',	$project)			? $project['location']		: null;
	$is_tracked			= array_key_exists('is_tracked',$project)			? $project['is_tracked']	: null;

?>



<section id="project">

	<div class="head">
		<div class="cover">
			<div>
				<div>
					<img src="img/<?php echo $handle; ?>.png">
				</div>
			</div>
		</div>
	
		<div class="financials">
			<div>
				<div>
					<div>
						<?php
							//$fw = round(100/(count($financials)+2), 2);
							$fc = count($financials)+2;
							
							if ($financials) {
								if (array_key_exists('type', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="type"><div><b>'.ucfirst($financials['type'])."</b> <label>offering</label></div></li>\n";
									echo "</ul>\n";
								}
								if (array_key_exists('share', $financials) && array_key_exists('price', $financials['share'])) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="share"><div><b>'.format_money($financials['share']['price'], true, false)."</b> <label>/share</label></div></li>\n";
									echo "</ul>\n";
								}
								if (array_key_exists('yield', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="yield"><div><b>'.$financials['yield']['value'].'<u>'.$financials['yield']['unit']."</u></b> <label>yield</label></div></li>\n";
									echo "</ul>\n";
								}
								if (array_key_exists('term', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="term"><div><b>'.$financials['term']['value'].' <u class="short">'.$financials['term']['unit']['short'].'</u><u class="long">'.$financials['term']['unit']['long']."</u></b> <label>term</label></div></li>\n";
									echo "</ul>\n";
								}
							}
						?>
						<div class="moneywrap size-<?php echo $fc/2; ?>">
							<div>
								<?php
									if ($goal || $progress) {
										echo "<ul class='money'>\n";
					
											if ($progress)
												echo '<li class="raised" style="width:'.$progress_percent.'%;"><div><label>Raised</label>'.format_money($progress)."</div></li>\n";
						
											if ($goal)
												echo '<li class="budget" style="width:'.(!$progress ? 100 : 100-$progress_percent).'%;"><div><label>Budget</label>'.format_money($goal)."</div></li>\n";
											
										echo "</ul>\n";
									}
								?>
								<div class="goal">
									<div>
										<?php /*<h4><?php echo format_money($goal); ?></h4>*/ ?>
										<div class="goalmeter"><div class="progress <?php echo $progress_percent==100 ? 'full' : ''; ?>" style="width:<?php echo $progress_percent; ?>%"><div class="marker" style="left:<?php echo $progress_percent; ?>%;"><label><?php echo $progress_percent; ?>%</label></div></div></div>
										<?php /*<div class="deadline"><b>22</b> Days to close</div>*/ ?>
									</div>
								</div>
							</div>
						</div>
						<div class="action">
							<button>Purchase Shares</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="title fix">
		<hgroup>
			<h2>
				<?php
					if ($is_tracked) {
						echo '<div class="trackwrap tracking"><button class="tracking" title="Stop tracking this project">Tracking</button></div>';
					} else {
						echo '<div class="trackwrap track"><button class="track" title="Follow this project">Track</button></div>';
					}
				?>
				<div class="profile-badge manager-badge">
					<div>
						<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
						<div class="focus"></div>
					</div>
				</div>
				<?php echo $name; ?>
			</h2>
		</hgroup>
		<div id="tabs" class="tabs major gridwrap-padded">
			<ul>
				<li><a href="?p=project&project=<?php echo $handle; ?>#overview" class="tab overview-tab current"><span>Overview</span></a></li>
				<li><a href="?p=project&project=<?php echo $handle; ?>#financials" class="tab financials-tab"><span>Financials</span></a></li>
				<li><a href="?p=project&project=<?php echo $handle; ?>#location" class="tab location-tab"><span>Location</span></a></li>
				<li><a href="?p=project&project=<?php echo $handle; ?>#property" class="tab property-tab"><span>Property</span></a></li>
				<li><a href="?p=project&project=<?php echo $handle; ?>#strengths" class="tab strengths-tab"><span>Strengths</span></a></li>
				<li><a href="?p=project&project=<?php echo $handle; ?>#risks" class="tab risks-tab"><span>Risks</span></a></li>
				<li><a href="?p=project&project=<?php echo $handle; ?>#manager" class="tab manager-tab"><span>Manager</span></a></li>
				<li class="side-tab"><a href="?p=project&project=<?php echo $handle; ?>#investors" class="tab investors-tab"><span><em>27</em> Investors</span></a></li>
				<li class="side-tab"><a href="?p=project&project=<?php echo $handle; ?>#trackers" class="tab trackers-tab"><span><em>189</em> Followers</span></a></li>
				<li class="side-tab"><a href="?p=project&project=<?php echo $handle; ?>#timeline" class="tab timeline-tab"><span>Timeline</span></a></li>
			</ul>
		</div>
	</div>
	
	
	<div class="body">
		<div class="main">
			<div>
			
				<div id="overview-content" class="tab-content paper current">
					<p>
						Phasellus a tellus ac augue luctus fermentum. Phasellus blandit faucibus metus in scelerisque. Nunc ac purus hendrerit lorem sollicitudin egestas et quis felis. Sed ornare, sapien at laoreet lobortis, tellus arcu hendrerit nibh, at fermentum ante ante id odio. Quisque convallis euismod mi. Nunc tristique, arcu a commodo ornare, arcu lectus imperdiet lorem, non ornare felis arcu iaculis nulla. Praesent dolor sem, euismod ac pellentesque ac, volutpat et dui. Integer elementum odio eget metus adipiscing consequat. Suspendisse nunc sem, hendrerit vel imperdiet ac, faucibus sed velit. Phasellus et augue eget enim ultricies vestibulum.
					</p>
					<div class="gallery">
						<div>
							<img src="img/sf-housing.jpg">
						</div>
					</div>
					<p>	
						Sed faucibus, odio a adipiscing interdum, leo dolor ultricies metus, vitae cursus lacus lectus consectetur erat. Donec pellentesque egestas orci, et vehicula sem commodo ut. Suspendisse quam dolor, imperdiet quis placerat eget, tristique consequat erat. Cras congue consequat nisl ac gravida. Morbi consequat, leo sed blandit elementum, tortor ante blandit magna, ac facilisis risus tellus quis tortor. Pellentesque interdum porta.
						Vivamus ut justo lacus, suscipit pretium tellus. Proin tincidunt tellus et massa commodo eget mollis turpis malesuada. Donec commodo molestie elementum. Aliquam ultrices enim in est aliquam accumsan. Vestibulum fringilla lobortis cursus. Nulla non est venenatis diam fermentum tincidunt non non dolor. Quisque euismod sollicitudin dignissim.
					</p>
				</div>
				
				<div id="location-content" class="tab-content paper">
					<?php if ($location && array_key_exists('address', $location)) {
						$e_address = urlencode($location['address']); ?>
						<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; height:24rem;"
							src="https://www.google.com/maps?q=<?php echo $e_address; ?>&amp;z=14&amp;output=embed"></iframe>
						
						<p style="text-align: right;"><a href="https://www.google.com/maps?q=<?php echo $e_address; ?>&amp;z=14&amp;source=embed" target="_blank">Google maps &rarr;</a></p>
					<?php } ?>
				</div>
				
			</div>
		</div>
		<div class="side">
			<div>
			
				<div class="switch-group">
				
					<div id="investors-content" class="tab-content side-tab-content tab-content-connections side-switch side-switch-current">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#investors" class="current"><em>27</em> Investors</a></li><li><a href="#trackers"><em>189</em> Trackers</a></li>
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
						<a class="show-all-connections investors" href="javascript:void(0)">Show all</a>
				
					</div>
					
					<div id="trackers-content" class="tab-content side-tab-content tab-content-connections side-switch">
					
						<div class="tabs connection-tabs">
							<ul>
								<li><a href="#investors"><em>27</em> Investors</a></li><li><a href="#trackers" class="current"><em>189</em> Trackers</a></li>
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
						<a class="show-all-connections trackers" href="javascript:void(0)">Show all</a>
				
					</div>
					
				</div>
				
				<div id="timeline-content" class="tab-content side-tab-content">
					
					<ul class="feed">
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=investor&i=kadri" title="Kadri Liis Rääk">Kadri</a> and two other friends invested in <a href="?p=project&project=1800-van-ness" title="<?php echo $name; ?>"><?php echo $name; ?></a></h5>
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
						<?php /*<li>
							<div class="profile-badge manager-badge">
								<div>
									<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><?php echo $manager['name']; ?></a> published a video to <a href="?p=project&project=1800-van-ness" title="<?php echo $name; ?>"><?php echo $name; ?></a></h5>
								<div class="entry-content">
									<div class="profile-badge video">
										<div>
											<a href="http://www.youtube.com/embed/L9szn1QQfas?autoplay=1" title="1800 Van Ness intro" class="fancybox-video fancybox.iframe" data-height="480" data-width="854"><img src="img/dummy-thumb-soma-grand.jpg"></a>
											<div class="focus"></div>
										</div>
									</div>
								</div>
								<div class="entry-meta">
									<time>2 days, 7hours ago</time>
								</div>
							</div>
						</li>*/ ?>
						<li>
							<div class="profile-badge manager-badge">
								<div>
									<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
									<div class="focus"></div>
								</div>
							</div>
							<div class="entry">
								<h5 class="entry-title"><a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><?php echo $manager['name']; ?></a> launched <a href="?p=project&project=<?php echo $h; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a></h5>
								<div class="entry-meta">
									<time>2 days, 7hours ago</time>
								</div>
							</div>
						</li>
					</ul>
				
				</div>
				
			</div>
		</div>
	</div>
</section>