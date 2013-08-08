<?php
	
	global $project, $managers;
		
	$handle		= array_key_exists('handle', 	$project)	? $project['handle']	: null;
	$name		= array_key_exists('name',		$project)	? $project['name']		: null;
	
	/*if (strrpos($project['name'], ' ')!==false )
		$name =	substr($project['name'], 0, strrpos($project['name'], ' ')) . ' <span>' . strrchr($project['name'], ' ');*/
	
	$link				= array_key_exists('link',		$project)			? $project['link']				: null;
	$type				= array_key_exists('type_label',$project)			? $project['type_label']		: null;
	
	$manager			= array_key_exists('manager',	$project) &&
						  array_key_exists($project['manager'], $managers) 	? $managers[$project['manager']]: null;
						  
	$goal				= array_key_exists('goal',		$project)			? $project['goal']				: null;
	$progress			= array_key_exists('progress',	$project)			? $project['progress']			: null;
	$progress_percent	= ($goal && $progress)								? round($progress/$goal*100)	: null;	// percentage
	$financials			= array_key_exists('financials',$project)			? $project['financials']		: null;
	$location			= array_key_exists('location',	$project)			? $project['location']			: null;
	
	global $badge_alt;

?>
<article class="project-badge new">
	<div onclick="location.href='<?php echo $link ?>'">
	
		<a class="project-thumb" href="<?php echo $link ?>"><img src="img/<?php echo $handle; ?>.png"><div class="focus"></div></a>
		
		<header>
			<h4 class="project-name">
				<div class="profile-badge manager-badge">
					<div>
						<a href="?p=manager&m=<?php echo $project['manager']; ?>" title="<?php echo $manager['name']; ?>"><img src="img/<?php echo $project['manager']; ?>.png"></a>
						<div class="focus"></div>
					</div>
				</div>
				
				<div class="titlewrap">
					<a class="project-link" href="<?php echo $link ?>"><?php echo $name; /*?> <label class="type"><?php echo $type; ?></label></span>*/ ?></a>
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
			<p>Phasellus a tellus ac augue luctus fermentum. Phasellus blandit faucibus metus in scelerisque. Nunc ac purus hendrerit lorem sollicitudin egestas et quis felis. Sed ornare, sapien at laoreet lobortis, tellus arcu hendrerit nibh, at fermentum ante ante id odio.</p>
		</div>
		
		<div class="financials">
			<div>
				<div>
					<div>
						<?php
						
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
					</div>
				</div>
			</div>
		</div>
		
		<div class="action">
			<button class="follow" title="Follow this project">Follow</button><button class="details" title="<?php echo $name; ?>">Full Details</button>
		</div>
		
	</div>
</article>