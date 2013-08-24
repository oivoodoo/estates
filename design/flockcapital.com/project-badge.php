<?php
	
	global $project, $managers;
	
	
	$size = isset($project_badge_size) ? $project_badge_size : 'full';
	
		
	$handle		= array_key_exists('handle', 	$project)	? $project['handle']	: null;
	$name		= array_key_exists('name',		$project)	? $project['name']		: null;
	
	$link				= array_key_exists('link',		$project)			? $project['link']				: null;
	$type				= array_key_exists('type_label',$project)			? $project['type_label']		: null;
	
	$manager			= array_key_exists('manager',	$project) &&
						  array_key_exists($project['manager'], $managers) 	? $managers[$project['manager']]: null;
						  
	$goal				= array_key_exists('goal',		$project)			? $project['goal']				: null;
	$progress			= array_key_exists('progress',	$project)			? $project['progress']			: null;
	$progress_percent	= ($goal && $progress)								? round($progress/$goal*100)	: null;	// percentage
	$financials			= array_key_exists('financials',$project)			? $project['financials']		: null;
	$location			= array_key_exists('location',	$project)			? $project['location']			: null;
	$is_tracked			= array_key_exists('is_tracked',$project)			? $project['is_tracked']		: null;
	$num_investors		= array_key_exists('num_investors',$project)		? $project['num_investors']		: null;
	$num_trackers		= array_key_exists('num_trackers',$project)			? $project['num_trackers']		: null;
	$amount_invested	= array_key_exists('amount_invested',$project)		? $project['amount_invested']	: null;
	$projected_earnings	= array_key_exists('projected_earnings',$project)	? $project['projected_earnings']: null;

?>
<article class="project-badge <?php echo $size.' '.(($i+1)%2==0 ? 'alt' : ''); ?>">
	<div onclick="location.href='<?php echo $link ?>'">
	
		<?php if ($size == 'dash-invested' && $amount_invested) { ?>
			<div class="project-share">
				<div>
					<b title="Amount invested"><?php echo format_money($amount_invested, true, false); ?></b>
					<label title="Amount invested"><?php echo $amount_invested/$financials['share']['price']; ?> shares</label>
				</div>
				<div>
					<b title="Projected<?php echo $financials['type']=='equity' ? ' annual' : '';?> earnings"><?php echo format_money($projected_earnings, true, false); ?></b>
					<label title="Projected<?php echo $financials['type']=='equity' ? ' annual' : '';?> earnings"><?php echo $financials['return']['value'].$financials['return']['unit'].' '.$financials['return']['yield_type']; ?></label>
				</div>
			</div>
		<?php } ?>
	
		<a class="project-thumb" href="<?php echo $link ?>">
			<img src="img/<?php echo $handle; ?>.png">
			<div class="focus"><span>Full details</span></div>
		</a>
		
		<div class="textual">
		
			<header>
			<h4 class="project-name">
				<div class="profile-badge manager-badge">
					<div>
						<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
					</div>
				</div>
				
				<div class="titlewrap">
					<a class="project-link" href="<?php echo $link ?>"><?php echo $name; ?></a>
					<div class="manager-location">
						<?php
							if ($manager) {
								echo '<span><a href="?p=manager&m='.$project['manager'].'" title="'.$manager['name'].'">'.$manager['name'].'</a></span> ';
							}
							if ($location && (array_key_exists('locality', $location) || array_key_exists('address', $location))) {
								echo '<address>';
								
								if (array_key_exists('address', $location))
									echo '<a href="'.$link.'#location" title="'.$location['address'].'">';
								
									echo array_key_exists('locality', $location) ? $location['locality'] : $location['address'];
								
								if (array_key_exists('address', $location))
									echo '</a>';
								
								echo '</address>';
							}
						?>
					</div>
				</div>
			</h4>
		</header>
			
			<div class="summary">
				<?php
					$summaries = array(
						'WestMill Capital Partners (WCP), as developer, plans to renovate the property and lease it to a restaurant or retail tenant. WCP believes that the property offers an opportunity for current cash flow over the mid-term while providing the potential of long-term appreciation, as a result of the surrounding growth of the H Street Neighborhood.',
						'Sed faucibus, odio a adipiscing interdum, leo dolor ultricies metus, vitae cursus lacus lectus consectetur erat. Donec pellentesque egestas orci, et vehicula sem commodo ut. Suspendisse quam dolor, imperdiet quis placerat eget, tristique consequat erat. Cras congue consequat nisl ac gravida. Morbi consequat, leo sed blandit elementum, tortor ante blandit magna, ac facilisis risus tellus quis tortor. Pellentesque interdum porta.',
						'Cras congue consequat nisl ac gravida. Morbi consequat, leo sed blandit elementum, tortor ante blandit magna, ac facilisis risus tellus quis tortor. Pellentesque interdum porta. Vivamus ut justo lacus, suscipit pretium tellus. Proin tincidunt tellus et massa commodo eget mollis turpis malesuada. Donec commodo molestie elementum. Aliquam ultrices enim in est aliquam accumsan. Vestibulum fringilla lobortis cursus.',
						'Pellentesque interdum porta. Vivamus ut justo lacus, suscipit pretium tellus. Proin tincidunt tellus et massa commodo eget mollis turpis malesuada. Donec commodo molestie elementum. Aliquam ultrices enim in est aliquam accumsan. Vestibulum fringilla lobortis cursus. Nulla non est venenatis diam fermentum tincidunt non non dolor. Quisque euismod sollicitudin dignissim. Sed faucibus, odio a adipiscing interdum, leo dolor ultricies metus.'
					);
					$rand_sumary = array_rand($summaries);
					$summary = $summaries[$rand_sumary];
					echo '<p>'.$summary.'</p>';
				?>
			</div>
			
			<div class="financials">
				<div>
					<div>
						<div>
							<div class="numbers">
								<?php
								
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
									
								?>
							</div>
							<div class="moneywrap size-<?php echo $fc/2; ?>">
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
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php /*<div class="action">
				<button <?php echo $is_tracked ? 'class="tracking '.($size!='dash-tracking-list' ? 'labelled' : '').'" title="Stop tracking this project">'.($size!='dash-tracking-list' ? 'Tracking' : '') : 'class="track '.($size!='dash-tracking-list' ? 'labelled' : '').'" title="Track this project">'.($size!='dash-tracking-list' ? 'Track' : ''); ?></button><button class="details" title="<?php echo $name; ?>">Full Details</button>
			</div>*/ ?>
			
		</div>
		
		
		
	</div>
</article>