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
	$num_investors		= array_key_exists('num_investors',$project)		? $project['num_investors']	: null;
	$num_trackers		= array_key_exists('num_trackers',$project)			? $project['num_trackers']	: null;

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
								if (array_key_exists('return', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="return"><div><b>'.$financials['return']['value'].'<u>'.$financials['return']['unit']."</u></b> <label>".$financials['return']['yield_type']."</label></div></li>\n";
									echo "</ul>";
								}
								if (array_key_exists('period', $financials)) {
									echo "<ul class='size-".$fc."'>\n";
										echo '<li class="period"><div><b>'.$financials['period']['value'].' <u class="short">'.$financials['period']['unit']['short'].'</u><u class="long">'.$financials['period']['unit']['long']."</u></b> <label>period</label></div></li>\n";
									echo "</ul>";
								}
							}
						?><div class="moneywrap size-<?php echo $fc/2; ?>">
							<div>
								<?php
									if ($goal || $progress) {
										echo "<ul class='money ".( $progress==$goal ? 'full' : '' )."'>\n";
					
											if ($progress)
												echo '<li class="raised" style="width:'.$progress_percent.'%;"><div>'.format_money($progress)."</div></li>\n";
						
											if ($goal)
												echo '<li class="budget" style="width:'.(!$progress ? 100 : 100-$progress_percent).'%;"><div>'.( $progress==$goal ? 'goal reached' : format_money($goal) )."</div></li>\n";
											
										echo "</ul>\n";
									}
									if ($progress_percent) {
								?>
								<div class="goal">
									<div>
										<div class="goalmeter"><div class="progress <?php echo $progress_percent==100 ? 'full' : ''; ?>" style="width:<?php echo $progress_percent; ?>%"><div class="marker" style="left:<?php echo $progress_percent; ?>%;"><label><?php echo $progress_percent; ?>%</label></div></div></div>
									</div>
								</div>
								<?php
									}
									if ($num_investors && $progress_percent) {
										echo "<ul class='num-investors'>\n";
					
											if ($progress)
												echo '<li style="width:'.$progress_percent.'%;"></li><li><div>'.$num_investors."<i> investors</i></div></li>\n";
											
										echo "</ul>\n";
									}
								?>
							</div>
						</div><div class="action">
							<button class="elevated">Purchase Shares</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="title <?php /*fix elevate*/ ?>">
		
		<div class="contract">
			<figure class="profile-badge manager-badge">
				<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
			</figure>
			<h2 class="name">
				<?php echo $name; ?>
			</h2>
			<div class="secondary-action tracking">
				 <button name="ext-account" value="facebook" title="Share on Facebook" class="ext-account-button facebook"><b title="Share on Facebook"></b></button
				><button name="ext-account" value="twitter" title="Share on Twitter" class="ext-account-button twitter"><b title="Share on Twitter"></b></button
				><button name="ext-account" value="google-plus" title="Share on Google+" class="ext-account-button google-plus"><b title="Share on Google+"></b></button
				><button name="ext-account" value="linked-in" title="Share on LinkedIn" class="ext-account-button linked-in"><b title="Share on LinkedIn"></b></button
				><?php
					if ($is_tracked) {
						echo '<button class="tracking" title="Stop tracking this project"><b title="Stop tracking this project"></b></button>';
					} else {
						echo '<button class="track" title="Track this project"><b title="Track this project"></b></button>';
					}
				?>
			</div>
		</div>
		
		<div id="tabs" class="tabs gridwrap-padded">
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
					<p>Stonemount, as a debt advisor, plans to assist the current anchor tentant raise a combination of bank debt and private debt financing to acquire the property. The current tenant operates a successful café with a large summer terrace. The tenant wishes to acquire the property to make capital improvements and expand the business. Stonemount believes the property provides a good opportunity for a junior debt investment that will be secured against the property in second position behind the bank.</p>
					<p>Loan interest is currently tax free in Estonia and the current tenant is offering 10% per annum for a 3 year term.</p>
					<?php /*<div class="gallery">
						<div>
							<img src="img/sf-housing.jpg">
						</div>
					</div>*/ ?>
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
										link: "<?php echo $link ?>",
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
			   
			    <div class="offer-disclaimer paper">
			    	<hr>
			    	<p>A special note regarding forward-looking statements:</p>
			    	<p>This Offering material, including any sections entitled “Overview”, “Property”, “Neighborhood”, “Financials”, and “Developer” and within the Private Placement Memorandum the sections entitled “The Company,” “Risk Factors,” “Business and Properties,” “Offering Price Factors” and “Use of Proceeds”, contain forward-looking statements. In some cases you can identify these statements by forward-looking words such as “believe,” “may,” “will,” “estimate,” “continue,” “anticipate,” “intend,” “could,” “would,” “project,” “plan,” “expect” or the negative or plural of these words or similar expressions. These forward-looking statements include, but are not limited to, statements concerning the Company, property, risk factors, plans and projections.</p>
			    	<p>You should not rely upon forward-looking statements as predictions of future events. These forward-looking statements are subject to a number of risks, uncertainties and assumptions, including those described in the “Risk Factors” within the Private Placement Memorandum. In light of these risks, uncertainties and assumptions, the forward-looking events and circumstances discussed in this Offering material may not occur and actual results could differ materially and adversely from those anticipated or implied in the forward-looking statements.</p>
			    	<p>You should read this Offering material and the documents that we reference in this Offering material and the Private Placement Memorandum with the understanding that our actual future results, levels of activity, performance and events and circumstances may be materially different from what we expect.</p>
			    	<p>Except as required by law, neither we nor any other person assumes responsibility for the accuracy and completeness of the forward-looking statements. We undertake no obligation to update publicly any forward-looking statements for any reason after the date of this Private Placement Memorandum to conform these statements to actual results or to changes in our expectations.</p>
			    	<p>Disclaimer: Neither the SEC nor any state securities commission or regulatory authority approved, passed upon or endorsed the merits of this offering.</p>
			    	<p>Flock's services do not constitute “crowd funding” as described in Title III of the Jumpstart Our Business Startups Act (“JOBS Act”).</p>
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
								<h6 class="entry-title"><a href="?p=investor&i=kadri" title="Kadri Liis Rääk">Kadri</a> and two other friends invested in <a href="?p=project&project=1800-van-ness" title="<?php echo $name; ?>"><?php echo $name; ?></a></h6>
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
								<h6 class="entry-title"><a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><?php echo $manager['name']; ?></a> published a video to <a href="?p=project&project=1800-van-ness" title="<?php echo $name; ?>"><?php echo $name; ?></a></h6>
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
								<h6 class="entry-title"><a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><?php echo $manager['name']; ?></a> launched <a href="?p=project&project=<?php echo $h; ?>" title="<?php echo $name; ?>"><?php echo $name; ?></a></h6>
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