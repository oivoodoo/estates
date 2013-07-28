<?php
	
	global $project;
		
	$handle		= array_key_exists('handle', 	$project)	? $project['handle']	: null;
	$name		= array_key_exists('name',		$project)	? $project['name']		: null;
	
	if (strrpos($project['name'], ' ')!==false )
		$name =	substr($project['name'], 0, strrpos($project['name'], ' ')) . ' <span>' . strrchr($project['name'], ' ');
	
	$link		= array_key_exists('link',		$project)	? $project['link']		: null;
	$type		= array_key_exists('type_label',$project)	? $project['type_label']: null;
	$developer	= array_key_exists('developer', $project)	? $project['developer']	: null;
	$goal		= array_key_exists('goal',		$project)	? $project['goal']		: null;
	$progress	= array_key_exists('progress',	$project)	? $project['progress']	: null;	// percentage
	$terms		= array_key_exists('terms',		$project)	? $project['terms']		: null;	// percentage
	
	global $badge_alt;

?>
<article class="project-badge new" onclick="location.href='<?php echo $link ?>'">
	<div>
		<header>
			<a class="project-thumb" href="<?php echo $link ?>"><img src="img/<?php echo $handle; ?>-thumb.png"><div class="focus"></div></a>
			<h4 class="project-name">
				<div class="profile-badge">
					<div>
						<a href="?p=developer&d=<?php echo $developer['handle']; ?>" title="<?php echo $developer['name']; ?>"><img src="img/<?php echo $developer['handle']; ?>.png"></a>
						<div class="focus"></div>
					</div>
				</div>
				
				<a class="project-link" href="<?php echo $link ?>"><?php echo $name; ?> <label class="type"><?php echo $type; ?></label></span></a>
			</h4>
		</header>
		
		<div class="meta table">
			<div>
				<ul>
					<?php
						foreach($terms as $term) {
							echo "<li>".$term."</li>\n";
						}
					?>
				</ul>
			</div>
		</div>
		
		<ul class="goal table">
			<li class="deadline"><b>22</b> Days to close</li>
			<li class="goalsum"><?php echo $goal; ?></li>
		</ul>
		
		<div class="goalmeter"><div class="progress" style="width:<?php echo $progress; ?>%"><?php /*<div class="marker" style="left:<?php echo $progress; ?>%;"><label><?php echo $progress; ?>%</label></div>*/ ?></div></div>
	</div>
</article>