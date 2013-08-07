<section>
	
	<?php parse_str($_SERVER['QUERY_STRING'], $query); ?>
	
	<div class="submenu" style="display:none;">
		<div>
			<ul>
				<li><a <?php if (array_key_exists('show', $query) && $query['show']=='local') echo 'class="current"'; ?> href="?p=projects&show=local">Local</a></li><li><a <?php if (isset($query['show']) && $query['show']=='featured') echo 'class="current"' ?> href="?p=projects&show=featured">Featured</a></li><li><a <?php if (isset($query['show']) && $query['show']=='trending') echo 'class="current"' ?> href="?p=projects&show=trending">Trending</a></li><li><a <?php if (!isset($query['show'])) echo 'class="current"' ?> href="?p=projects">All</a></li>
			</ul>
		</div>
	</div>

	<div id="projects" class="gridwrap">
		<?php
			global $projects;
			foreach($projects as $project) {
				require('project-badge.php');
			}
		?>
	</div>
	
</section>