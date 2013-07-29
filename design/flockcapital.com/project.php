<?php

	$projects = array(
		'1800-van-ness' => array(
			'link'		=> '?p=project&project=1800-van-ness',
			'handle'	=> '1800-van-ness',
			'name'		=> '1800 Van Ness',
			'type_label'=> 'Residential',
			'developer'	=> array(
				'handle'=> 'cbre',
				'name'	=> 'CBRE'
			),
			'goal'		=> format_money(32000000),
			'$progress'	=> 66, // percentage
			'terms'		=> array(
				'<span class="delta"><b>12%</b></span><br>target return',
				'<span class="delta"><b>Equity</b></span><br>purchase',
				'<span class="delta"><b>24 month</b></span><br>holding period'
			)
		)
	);

	$h = array_key_exists('project', $_GET) ? $_GET['project'] : null;
	
	if (!$h || !array_key_exists($h, $projects)) return;
	
	$project = $projects[$h];

	$handle		= array_key_exists('handle',	$project)	? $project['handle']	: null;
	$name		= array_key_exists('name',		$project)	? $project['name']		: null;
	
	if (strrpos($project['name'], ' ')!==false )
		$name =	substr($project['name'], 0, strrpos($project['name'], ' ')) . ' <span>' . strrchr($project['name'], ' ');
	
	$link		= array_key_exists('link',		$project)	? $project['link']		: null;
	$type		= array_key_exists('type_label',$project)	? $project['type_label']: null;
	$developer	= array_key_exists('developer', $project)	? $project['developer']	: null;
	$goal		= array_key_exists('goal',		$project)	? $project['goal']		: null;
	$progress	= array_key_exists('progress',	$project)	? $project['progress']	: null;	// percentage
	$terms		= array_key_exists('terms',		$project)	? $project['terms']		: null;	// percentage

?>



<section id="project">

	<div class="cover-wrap">
		<div class="cover">
			<img src="img/<?php echo $handle; ?>-cover.png">
		</div>
	</div>

	<div class="head">
		<div class="core">
			<hgroup>
				<h1>
					<div class="profile-badge">
						<div>
							<a href="?p=developer&d=<?php echo $developer['handle']; ?>" title="<?php echo $developer['name']; ?>"><img src="img/<?php echo $developer['handle']; ?>.png"></a>
							<div class="focus"></div>
						</div>
					</div>
				
					<?php echo $name; ?> <label class="type"><?php echo $type; ?></label></span>
				</h1>
			</hgroup>
			<div class="action">
				<button>Invest<?php /*<i></i>*/ ?></button>
			</div>
		</div>
	</div>
	
	<div class="financials">
		<div>
			<?php 
				foreach($terms as $term) {
					echo "<div>".$term."</div>\n";
				}
			?>
			<div class="goal">
				<div>
					<h3><?php echo $goal; ?></h3>
					<div class="goalmeter"><div class="progress" style="width:<?php echo $progress; ?>%"><div class="marker" style="left:<?php echo $progress; ?>%;"><label><?php echo $progress; ?>%</label></div></div></div>
					<div class="deadline"><b>22</b> Days to close</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="body">
		<div class="main">
		
			<div id="tabs" class="tabs">
				<ul>
					<li><a href="#" class="current">Overview</a></li><li><a href="#">Financials</a></li><li><a href="#">Location</a></li><li><a href="#">Property</a></li><li><a href="#">Strengths</a></li><li><a href="#">Risks</a></li>
				</ul>
			</div>
			<div>
				<div class="paper" id="tab-1">
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
			</div>
			
		</div>
		<div class="side">
			<div id="tabspace"></div><?php /*
			<div class="developer">
				<div>
					<div class="focus"></div>
					<img class="logo" src="img/developer-logo-1-s.png">
					<h4 class="developer-name">Trigon Capital ltd.</h4>
				</div>
			</div>
			<div>
				<div class="padding">
					<h5 style="color: lightGray">Project feed</h5>
					<p style="font-size:.7em; margin:1em 0 0; color: lightGray">updates, progress, ...</p>
				</div>
			</div>
			<div>
				<div class="padding">
					<h5 style="color: lightGray">Personal connections</h5>
					<p style="font-size:.7em; margin:1em 0 0; color: lightGray">Who has already joined investing in this project — user's Facebook friends, LinkedIn connections etc.</p>
				</div>
			</div>*/ ?>
			<div>
					
				<ul class="feed">
					<li>
						<div class="profile-badge">
							<div>
								<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png"></a>
								<div class="focus"></div>
							</div>
						</div>
						<div class="entry">
							<h5 class="entry-title"><a href="?p=investor&i=kadri" title="Kadri Liis Rääk">Kadri</a> and two other friends invested in <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
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
								<a href="?p=developer&d=cbre" title="CBRE"><img src="img/cbre.png"></a>
								<div class="focus"></div>
							</div>
						</div>
						<div class="entry">
							<h5 class="entry-title"><a href="?p=developer&d=cbre" title="CBRE">CBRE</a> published a video to <a href="?p=project&project=1800-van-ness" title="1800 Van Ness">1800 Van Ness</a></h5>
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
					</li>
					<li>
						<div class="profile-badge">
							<div>
								<a href="?p=developer&d=cbre" title="CBRE"><img src="img/cbre.png"></a>
								<div class="focus"></div>
							</div>
						</div>
						<div class="entry">
							<h5 class="entry-title"><a href="?p=developer&d=cbre" title="CBRE">CBRE</a> launched <a href="?p=project" title="1800 Van Ness">1800 Van Ness</a></h5>
							<div class="entry-meta">
								<time>2 days, 7hours ago</time>
							</div>
						</div>
					</li>
				</ul>
					
			</div>
			<div>
				
				<div id="connections-tabs" class="tabs">
					<ul>
						<li><a href="#" class="current">Investors</a></li><li><a href="#">Followers</a></li>
					</ul>
				</div>
				<div class="connections-wrap">
					<ul class="connections">
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=michael" title="Michael Walsh"><img src="img/michael.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=mart" title="Mart Uibo"><img src="img/mart.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
						<li>
							<div class="profile-badge">
								<div>
									<a href="?p=investor&i=kadri" title="Kadri Liis Rääk"><img src="img/kadri.png" width="256" height="256"></a>
									<div class="focus"></div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			
			</div>
		</div>
	</div>
</section>