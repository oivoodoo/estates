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
			<div class="logo"><img src="g/flockinvest-logo.svg"></div>
			<div class="close" onclick="$.fancybox.close()"></div>
		</div>
	</div>
	<div class="modal-content">
		<div>
			
			<div class="logo"><div><img src="g/flockinvest-logo.svg"></div></div>
			
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