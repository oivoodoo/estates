<section>
	
	<?php parse_str($_SERVER['QUERY_STRING'], $query); ?>
	
	<div class="listing-filter" style="display:none;">
		<div>
			<ul>
				<li><a <?php if (array_key_exists('show', $query) && $query['show']=='local') echo 'class="current"'; ?> href="?p=projects&show=local">Local</a></li><li><a <?php if (isset($query['show']) && $query['show']=='featured') echo 'class="current"' ?> href="?p=projects&show=featured">Featured</a></li><li><a <?php if (isset($query['show']) && $query['show']=='trending') echo 'class="current"' ?> href="?p=projects&show=trending">Trending</a></li><li><a <?php if (!isset($query['show'])) echo 'class="current"' ?> href="?p=projects">All</a></li>
			</ul>
		</div>
	</div>

	<div id="projects" class="gridwrap">
		<?php
			$projects = array(
				array(
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
						'<b>12%</b> target return',
						'<b>Equity</b> purchase',
						'<b>24 month</b> holding period'
					)
				),
				array(
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
						'<b>12%</b> target return',
						'<b>Equity</b> purchase',
						'<b>24 month</b> holding period'
					)
				),
				array(
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
						'<b>12%</b> target return',
						'<b>Equity</b> purchase',
						'<b>24 month</b> holding period'
					)
				),
				array(
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
						'<b>12%</b> target return',
						'<b>Equity</b> purchase',
						'<b>24 month</b> holding period'
					)
				),
				array(
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
	
</section>