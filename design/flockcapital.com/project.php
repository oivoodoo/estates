<?php

	global $projects, $managers, $investors;

	$h = array_key_exists('project', $_GET) ? $_GET['project'] : null;
	
	if (!$h || !array_key_exists($h, $projects)) return;
	
	$project = $projects[$h];

	$p			= array_key_exists('handle',	$project)	? $project['handle']	: null;
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
					<img class="elevated" src="img/<?php echo $p; ?>.png">
				</div>
			</div>
		</div>
	
		<div class="financials">
			<div>
				<div>
					<div><?php
							//$fw = round(100/(count($financials)+2), 2);
							$fc = count($financials)+2;
							
							if ($financials) {
								if (array_key_exists('type', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="type"><div><b>'.ucfirst($financials['type'])."</b> <label>offering</label></div></li>\n";
									echo "</ul>";
								}
								if (array_key_exists('share', $financials) && array_key_exists('price', $financials['share'])) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="share"><div><b>'.format_money($financials['share']['price'], true, false)."</b> <label>/share</label></div></li>\n";
									echo "</ul>";
								}
								if (array_key_exists('yield', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="yield"><div><b>'.$financials['yield']['value'].'<u>'.$financials['yield']['unit']."</u></b> <label>yield</label></div></li>\n";
									echo "</ul>";
								}
								if (array_key_exists('term', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="term"><div><b>'.$financials['term']['value'].' <u class="short">'.$financials['term']['unit']['short'].'</u><u class="long">'.$financials['term']['unit']['long']."</u></b> <label>term</label></div></li>\n";
									echo "</ul>";
								}
							}
						?><div class="moneywrap size-<?php echo $fc/2; ?>">
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
						</div><div class="action">
							<button class="elevated">Purchase Shares</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="title fix elevate">
		
		<div class="contract">
			<figure class="profile-badge manager-badge">
				<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
			</figure>
			<h2 class="name">
				<?php
					if ($is_tracked)
						echo '<div class="trackwrap tracking"><button class="tracking labelled" title="Stop tracking this project">Tracking</button></div>';
					else
						echo '<div class="trackwrap track"><button class="track" title="Follow this project">Track</button></div>';
					
					echo $name;
				?>
			</h2>
		</div>
		
		<div id="tabs" class="tabs major gridwrap-padded">
			<ul>
				<li><a href="?p=project&project=<?php echo $p; ?>#overview" class="tab overview-tab current"><span>Overview</span></a></li
				><li><a href="?p=project&project=<?php echo $p; ?>#financials" class="tab financials-tab"><span>Financials</span></a></li
				><li><a href="?p=project&project=<?php echo $p; ?>#location" class="tab location-tab"><span>Location</span></a></li
				><li><a href="?p=project&project=<?php echo $p; ?>#property" class="tab property-tab"><span>Property</span></a></li
				><li><a href="?p=project&project=<?php echo $p; ?>#strengths" class="tab strengths-tab"><span>Strengths</span></a></li
				><li><a href="?p=project&project=<?php echo $p; ?>#risks" class="tab risks-tab"><span>Risks</span></a></li
				><li><a href="?p=project&project=<?php echo $p; ?>#manager" class="tab manager-tab"><span>Manager</span></a></li
				><li class="side-tab"><a href="?p=project&project=<?php echo $p; ?>#investors" class="tab investors-tab"><span><em>27</em> Investors</span></a></li
				><li class="side-tab"><a href="?p=project&project=<?php echo $p; ?>#trackers" class="tab trackers-tab"><span><em>189</em> Followers</span></a></li
				><li class="side-tab"><a href="?p=project&project=<?php echo $p; ?>#timeline" class="tab timeline-tab"><span>Timeline</span></a></li>
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
					<?php
					
						if ($location && array_key_exists('address', $location)  && array_key_exists('coordinates', $location)) { ?>
							
							<div class="map-canvas" id="project_map_canvas"></div>
							<script>
								window.gmaps.project = [
									{
										lat: <?php echo $location['coordinates']['lat'] ?>,
										lng: <?php echo $location['coordinates']['lng'] ?>,
										address: "<?php echo $location['address'] ?>",
										title: "<?php echo $name ?>",
										link: "<?php echo $link ?>"
									}
								];
							</script>
							
						<?php /*$e_address = urlencode($location['address']); ?>
							<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width:100%; height:24rem;"
								src="https://www.google.com/maps?q=<?php echo $e_address; ?>&amp;z=14&amp;output=embed"></iframe>
							
							<p style="text-align: right;"><a href="https://www.google.com/maps?q=<?php echo $e_address; ?>&amp;z=14&amp;source=embed" target="_blank">Google maps &rarr;</a></p>
							<?php*/
						}
					?>
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
	
	
    <div class="offer-disclaimer">
    	<hr>
    	<p>A special note regarding forward-looking statements:</p>
    	<p>This Offering material, including any sections entitled “Overview”, “Property”, “Neighborhood”, “Financials”, and “Developer” and within the Private Placement Memorandum the sections entitled “The Company,” “Risk Factors,” “Business and Properties,” “Offering Price Factors” and “Use of Proceeds”, contain forward-looking statements. In some cases you can identify these statements by forward-looking words such as “believe,” “may,” “will,” “estimate,” “continue,” “anticipate,” “intend,” “could,” “would,” “project,” “plan,” “expect” or the negative or plural of these words or similar expressions. These forward-looking statements include, but are not limited to, statements concerning the Company, property, risk factors, plans and projections.</p>
    	<p>You should not rely upon forward-looking statements as predictions of future events. These forward-looking statements are subject to a number of risks, uncertainties and assumptions, including those described in the “Risk Factors” within the Private Placement Memorandum. In light of these risks, uncertainties and assumptions, the forward-looking events and circumstances discussed in this Offering material may not occur and actual results could differ materially and adversely from those anticipated or implied in the forward-looking statements.</p>
    	<p>You should read this Offering material and the documents that we reference in this Offering material and the Private Placement Memorandum with the understanding that our actual future results, levels of activity, performance and events and circumstances may be materially different from what we expect.</p>
    	<p>Except as required by law, neither we nor any other person assumes responsibility for the accuracy and completeness of the forward-looking statements. We undertake no obligation to update publicly any forward-looking statements for any reason after the date of this Private Placement Memorandum to conform these statements to actual results or to changes in our expectations.</p>
    	<p>Disclaimer: Neither the SEC nor any state securities commission or regulatory authority approved, passed upon or endorsed the merits of this offering.</p>
    	<p>Flock's services do not constitute “crowd funding” as described in Title III of the Jumpstart Our Business Startups Act (“JOBS Act”).</p>
    </div>
    
	
</section>