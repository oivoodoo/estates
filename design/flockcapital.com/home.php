<section id="intro">
	<div id="slideshow" class="grid-1-1 no-padding" <?php /*style="
		background-image: url('img/intro-3-bg.png');
		background-size: auto 100%;
		background-repeat: repeat-x;
	"*/ ?>>
		<div>
			<div style="
				background-image: url('img/intro-3-434391.jpg');
				background-size: auto 100%;
				background-repeat: no-repeat;
				background-position: left bottom;
			">
				<h1 class="title">Build a real estate portfolio online</h1>
				<h6>Get access to exclusive investments and manage your portfolio using Flock.</h6>
				<div>
					<button class="how-it-works">How It Works</button>
					<button class="sign-up">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="home-listing">
	<div class="listing-head"><h5 class="listing-heading"><label>Featured Investments</label><span><a href="?p=projects&show=local">View all</a></span></h5></div>
	<div class="gridwrap">
		<?php
			global $featured_projects;
			foreach($featured_projects as $project) {
				require('project-badge.php');
			}
		?>
	</div><?php /*
	<nav><div><div></div></div></nav>*/ ?>
</section>


<section class="home-listing">
	<div class="listing-head"><h5 class="listing-heading"><label>Featured Investments</label><span><a href="?p=projects&show=local">View all</a></span></h5></div>
	<div class="gridwrap">
		<?php
			global $featured_projects;
			foreach($featured_projects as $project) {
				require('project-badge.php');
			}
		?>
	</div><?php /*
	<nav><div><div></div></div></nav>*/ ?>
</section>


<section class="home-listing">
	<div class="listing-head"><h5 class="listing-heading"><label>Featured Investments</label><span><a href="?p=projects&show=local">View all</a></span></h5></div>
	<div class="gridwrap">
		<?php
			global $featured_projects;
			foreach($featured_projects as $project) {
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