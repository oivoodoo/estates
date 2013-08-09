<section id="intro">
	<div id="slideshow" class="grid-1-1 no-padding">
		<div>
			<div style="
			  background-image: url('img/intro-3-434391.jpg');
			  background-size: auto 100%;
			  background-repeat: no-repeat;
			  background-position: left bottom;">
				<h1 class="title">Build a real estate portfolio online</h1>
				<h4>Get access to exclusive investments and manage your portfolio using Flock.</h4>
				<div class="action">
					<button class="how-it-works faded">Watch how &nbsp;&nbsp;<span>1:45 min</span></button>
					<?php /*<button class="sign-up">Sign Up</button>*/ ?>
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