<section id="intro">
	<div id="slideshow" class="grid-1-1 no-padding" style="background-image: url('img/sf-housing.jpg'); background-size: 100% auto; background-repeat:repeat-y"></div>
</section>


<section class="home-listing">
	<div class="listing-head"><h4 class="listing-heading"><label>Featured Investments</label> <span><a href="?p=projects&show=local">See all →</a></span></h4></div>
	<div class="gridwrap">
		<?php
			$projects = array(
				array(
					'link'		=> '?p=project',
					'name'		=> '1800 Van Ness',
					'handle'	=> '1800-van-ness',
					'type_label'=> 'Residential',
					'developer'	=> array(
						'handle'=> 'cbre',
						'name'	=> 'CBRE'
					),
					'goal'		=> format_money(32000000),
					'progress'	=> 66, // percentage
					'terms'		=> array(
						'<b>12%</b> target return',
						'<b>Equity</b> purchase',
						'<b>24 month</b> holding period'
					)
				),
				array(
					'link'		=> '?p=project',
					'name'		=> '1800 Van Ness',
					'handle'	=> '1800-van-ness',
					'type_label'=> 'Residential',
					'developer'	=> array(
						'handle'=> 'cbre',
						'name'	=> 'CBRE'
					),
					'goal'		=> format_money(32000000),
					'progress'	=> 66, // percentage
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
	</div><?php /*
	<nav><div><div></div></div></nav>*/ ?>
</section>



<?php /*
<section class="home-listing alt">
	<div class="listing-head"><h6 class="listing-heading"><label>Featured</label> <span><a href="?p=projects&show=featured">All Featured →</a></span></h6></div>
	<div class="gridwrap">
		<?php $badge_alt = 1; for($i=0; $i<4; $i++) require('project-badge.php'); ?>
	</div>
	<nav><div><div></div></div></nav>
</section>


<section class="home-listing">
	<div class="listing-head"><h6 class="listing-heading"><label>Trending</label> <span><a href="?p=projects&show=trending">All Trending →</a></span></h6></div>
	<div class="gridwrap">
		<?php $badge_alt = 0; for($i=0; $i<4; $i++) require('project-badge.php'); ?>
	</div>
	<nav><div><div></div></div></nav>
</section>*/ ?>




<?php /*


<div style="display:none;">
<section>
	<div class="gridwrap">
		<div class="grid-1-1">
			<img src="img/process.png" style="width:100%; height:auto;">
		</div>
	</div>
</section>


<section>
	<div class="gridwrap">
		<div class="grid-1-3"><div></div></div>
		<div class="grid-1-3"><div></div></div>
		<div class="grid-1-3"><div></div></div>
	</div>
</section>
<section>
	<div class="gridwrap">
		<div class="grid-1-3"><div></div></div>
		<div class="grid-2-3"><div></div></div>
	</div>
</section>
<section>
	<div class="gridwrap">
		<div class="grid-1-4"><div></div></div>
		<div class="grid-1-4"><div></div></div>
		<div class="grid-1-4"><div></div></div>
		<div class="grid-1-4"><div></div></div>
	</div>
</section>
<section>
	<div class="gridwrap">
		<div class="grid-1-4"><div></div></div>
		<div class="grid-3-4"><div></div></div>
	</div>
</section>
</div>
*/ ?>