<section>
	
	<?php /*parse_str($_SERVER['QUERY_STRING'], $query); ?>
	
	<div class="submenu">
		<div>
			<ul>
				<li><a <?php if (array_key_exists('show', $query) && $query['show']=='local') echo 'class="current"'; ?> href="?p=projects&show=local">Local</a></li
				><li><a <?php if (isset($query['show']) && $query['show']=='featured') echo 'class="current"' ?> href="?p=projects&show=featured">Featured</a></li
				><li><a <?php if (isset($query['show']) && $query['show']=='trending') echo 'class="current"' ?> href="?p=projects&show=trending">Trending</a></li
				><li><a <?php if (!isset($query['show'])) echo 'class="current"' ?> href="?p=projects">All</a></li>
			</ul>
		</div>
	</div>*/ ?>
	
	<div class="head <?php echo array_key_exists('show', $_GET) && $_GET['show']!='all' ? 'fix elevate' : ''; ?>">
		
		<div id="tabs" class="tabs submenu">
			<ul>
				<li><a  href="?p=projects&show=local"	 class="local	 <?php echo  array_key_exists('show', $_GET) && $_GET['show']=='local'	 ? 'current' : ''; ?>">Local</a></li
				><li><a href="?p=projects&show=featured" class="featured <?php echo  array_key_exists('show', $_GET) && $_GET['show']=='featured' ? 'current' : ''; ?>">Featured</a></li
				><li><a href="?p=projects&show=trending" class="trending <?php echo  array_key_exists('show', $_GET) && $_GET['show']=='trending' ? 'current' : ''; ?>">Trending</a></li
				><li><a href="?p=projects&show=all"		 class="all		 <?php echo !array_key_exists('show', $_GET) || (array_key_exists('show', $_GET) && $_GET['show']=='all') ? 'current' : ''; ?>">All</a></li>
			</ul>
		</div>
		
	</div>

	<div id="projects" class="gridwrap">
		<?php
			global $projects;
			$i = 0;
			foreach($projects as $project) {
				require('project-badge.php');
				$i++;
			}
		?>
	</div>
	
</section>