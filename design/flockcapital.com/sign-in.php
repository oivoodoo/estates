<?php

	$is_forgotten = array_key_exists('action', $_GET) && $_GET['action']=='forgotten';
	$is_signup = array_key_exists('action', $_GET) && $_GET['action']=='sign-up';
	$is_internal = array_key_exists('internal', $_GET) && $_GET['internal'];
	
	$alt =	$is_signup ? (
				$is_internal ? 'Already have an account? <a href="sign-in.php" class="sign-in fancybox.ajax">Sign in</a>.'
						   : 'Sign up with an external account to follow your friends\' activity on Flock.<br><a href="sign-in.php?action=sign-up&internal=1" class="sign-in fancybox.ajax">Sign up without any external accounts</a>.'
			) : '<a href="sign-in.php?action=forgotten" class="sign-in fancybox.ajax">Forgot password?</a>'/*'Don\'t have an account? <a href="sign-in.php?action=sign-up" class="sign-in fancybox.ajax">Sign up</a>!'*/;
	
	$label = $is_signup ? 'Sign up' : 'Sign in';
	

if ($is_forgotten) {} else {

?>


<div id="sign-in" class="<?php echo $is_signup?'signup':'signin';  echo $is_internal?' internal':' external'; ?>">
	<div class="modal-header">
		<div>
			<div class="logo">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewBox="0 -0.001 2617.475 362.739" enable-background="new 0 -0.001 2617.475 362.739" xml:space="preserve">
					<path id="bird" d="M413.46,179.479c-0.86,0.53-1.729,1.062-2.602,1.58c-0.17,0.101-0.33,0.21-0.5,0.311h-0.01
						C253.49,144.829,0,0,0,0c0,40.818,7.39,79.898,20.92,116c0,0,136.88,51.199,264.97,90.068
						c-113.47-12.369-242.579-45.42-244.59-45.93c18.06,32.6,41.47,61.811,69.05,86.47c0,0,95.062,12.812,153.881,16.04
						c-49.121,0.91-128.521,4.5-128.521,4.5c16.689,12.2,34.56,22.88,53.42,31.83c-66.05,30.35-107.69,45.25-107.69,45.25
						c34.211,11.97,70.99,18.51,109.291,18.51c126.021,0,240.389-38.06,324.84-100.09c0.41-0.309,0.879-0.66,1.4-1.029
						c11.647-8.329,48.6-29.641,48.6-6.351c3.51-14.62,4.209-27.37,2.65-38.38c-9.33-65.65-99.191-69.49-153.701-38.04
						c55.43-32.39,143.09-33.04,170.801,19.15c48.17-56.909,76.14-124.909,76.14-198C579.34,70.979,493.49,130.63,413.779,179.279
						C413.67,179.35,413.57,179.409,413.46,179.479z"/>
					<path id="flocktype" fill="#383838" d="M1092.603,56.467H1281.4l-1.746,50h-131.998l-1.971,56.397h129.199l-1.746,50H1143.94l-3.855,110.397h-56.8
						L1092.603,56.467z M1453.602,56.467h-56.8l-9.317,266.796h169.598l1.746-49.999H1446.03L1453.602,56.467z M1928.77,190.064
						c-2.807,80.399-63.617,137.998-144.416,137.998c-80.398,0-137.188-57.599-134.379-137.998
						c2.807-80.397,63.618-137.997,144.017-137.997C1874.789,52.067,1931.577,109.666,1928.77,190.064z M1792.231,102.467
						c-49.199,0-82.112,37.6-83.858,87.598c-1.73,49.601,28.541,87.601,77.74,87.601s82.525-38,84.258-87.601
						C1872.116,140.066,1841.431,102.467,1792.231,102.467z M2174.75,102.467c27.601,0,51,17.199,61.444,38.799l49.638-24
						c-17.641-33.199-50.522-65.198-109.321-65.198c-79.999,0-143.953,55.999-146.817,137.997c-2.863,82,57.182,137.998,137.18,137.998
						c58.8,0,93.529-32.397,113.891-65.598l-47.977-23.602c-11.968,22-36.555,38.801-64.154,38.801
						c-48.398,0-82.299-37.199-80.539-87.601C2089.854,139.666,2126.352,102.467,2174.75,102.467z M2547.476,56.467l-98.562,119.198
						l4.162-119.198h-56.799l-9.316,266.796h56.799l2.864-81.999l21.666-24.799l77.067,106.798h70l-108.254-141.597l110.371-125.199
						H2547.476z"/>
				</svg>
			</div>
			<div class="close" onclick="$.fancybox.close()"></div>
		</div>
	</div>
	<div class="modal-content">
			
			<?php if ($is_signup) { ?>
	
				<?php if ($is_internal) { ?>
				
					<form action="signup">
						<input type="text" placeholder="Full Name" size="1">
						<input type="email" placeholder="E-mail" size="1">
						<input type="text" placeholder="••••••••" size="1">
						<div class="action">
							<div>
								<div>
									<?php echo $alt; ?>
								</div>
								<div>
									<input type="submit" class="delta thicker" value="<?php echo $label; ?>">
								</div>
							</div>
						</div>
					</form>
			
				<?php } else { ?>
				
					<form action="signup">
						<div class="ext-account-buttons">
							<button name="ext-account" value="facebook" class="ext-account-button facebook"></button>
							<button name="ext-account" value="twitter" class="ext-account-button twitter"></button>
							<button name="ext-account" value="google-plus" class="ext-account-button google-plus"></button>
							<button name="ext-account" value="linked-in" class="ext-account-button linked-in"></button>
						</div>
						<div class="action">
							<div>
								<div>
									<?php echo $alt; ?>
								</div>
							</div>
						</div>
					</form>
				
				<?php } ?>
			
			<?php } else { ?>
	
					<form action="signin">
						<div class="tight">
							<div class="input-group">
								<input style="width:50%;" type="email" placeholder="E-mail" size="1">
								<input style="width:50%;" type="password" placeholder="••••••••" size="1">
							</div>
						</div>
						<div class="action">
							<div>
								<div>
									<?php echo $alt; ?>
								</div>
								<div>
									<input type="submit" class="delta thicker" value="<?php echo $label; ?>">
								</div>
							</div>
						</div>
						<br><br>
						<div class="ext-account-buttons">
							<button name="ext-account" value="facebook" class="ext-account-button facebook"></button>
							<button name="ext-account" value="twitter" class="ext-account-button twitter"></button>
							<button name="ext-account" value="google-plus" class="ext-account-button google-plus"></button>
							<button name="ext-account" value="linked-in" class="ext-account-button linked-in"></button>
						</div>
						<p class="tertiary">You may alternatively sign in with one of your external accounts</p>
					</form>
				
			<?php } ?>
			
		</div>
	</div>
</div>

<?php } ?>