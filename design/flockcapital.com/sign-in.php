<?php

	session_start();



	$is_forgotten = array_key_exists('action', $_GET) && $_GET['action']=='forgotten';
	$is_signup = array_key_exists('action', $_GET) && $_GET['action']=='sign-up';
	$is_internal = array_key_exists('internal', $_GET) && $_GET['internal'];
	
	$alt =	$is_signup ? (
				$is_internal ? 'Already have an account? <a href="sign-in.php" class="sign-in log-in fancybox.ajax">Sign in</a>.'
						   : 'Sign up with an external account to follow your friends\' activity on Flock.<br><a href="sign-in.php?action=sign-up&internal=1" class="sign-in sign-up fancybox.ajax">Sign up without any external accounts</a>'
			) : '<a href="sign-in.php?action=forgotten" class="sign-in forgotten fancybox.ajax">Forgot password?</a>';
	
	$label = $is_signup ? 'Sign up' : 'Sign in';
	

	if ($is_forgotten) {} else {

?>


<div id="sign-in" class="<?php echo $is_signup?'signup':'signin';  echo $is_internal?' internal':' external'; ?>">
	<div class="modal-header">
		<div>
			<div class="logo">
				<svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="100%" height="100%" viewBox="0 -6.001 2036.664 384.71" enable-background="new 0 -6.001 2036.664 384.71"
					 xml:space="preserve">
					<path id="bird" fill="#00A0D1" d="M499.567,216.219c-8.389,0-18.046,6.968-30.274,15.787c-7.682,5.539-16.388,11.82-26.155,17.313 c-74,41.625-155.265,62.732-241.534,62.734c-62.207,0.004-126.541-11.266-191.407-33.514 c102.311-1.014,151.86-15.451,180.466-26.406l4.281-1.641l-4.114-2.021c-25.71-12.643-49.974-29.279-72.258-49.529 c0.343,0.146,0.687,0.285,1.033,0.423l18.271,6.889l7.731,2.906l65.546,21.957l-63.149-27.939l-8.511-4.141l-16.207-7.908 c-0.451-0.229-0.928-0.483-1.404-0.739L98.48,177.913c-0.819-0.438-1.612-0.896-2.394-1.352 c-14.904-16.227-28.854-34.405-41.544-54.127c0.494,0.314,0.989,0.627,1.487,0.94l12.601,7.79l12.625,7.494 c1.078,0.645,2.169,1.262,3.25,1.871c0.563,0.319,10.988,6.244,10.988,6.244l9.466,5.143c2.201,1.198,4.28,2.329,6.176,3.289 l52.761,27.329l-50.305-31.647c-1.768-1.089-3.716-2.371-5.779-3.728l-8.957-5.882c0,0-9.832-6.73-10.374-7.1 c-0.992-0.676-1.995-1.358-2.99-2.071l-11.87-8.456l-11.787-8.729c-1.971-1.482-3.916-2.98-5.828-4.453 c-1.072-0.824-2.133-1.642-3.184-2.445l-4.304-3.307l-4.046-3.207l-4.708-3.75C24.449,70.275,11.09,39.786,0,7.026 c117.483,112.355,228.721,169.32,330.707,169.326c0.005,0,0.01,0,0.016,0c11.815,0,23.657-0.78,35.198-2.319l0.29-0.039l0.268-0.121 c13.629-6.139,22.648-13.496,30.607-19.986c13.378-10.911,24.932-20.334,53.787-20.334c22.254,0,37.709,9.34,47.247,28.551 c6.968,14.038,10.61,33.084,11.094,58.104C506.423,217.532,503.232,216.219,499.567,216.219z M587.035,77.586l-0.729,1.042 l-2.657,3.644c-1.182,1.66-2.459,3.318-3.692,4.923c-0.629,0.817-1.26,1.638-1.883,2.462c-1.205,1.569-2.482,3.149-3.718,4.678 c-0.689,0.854-1.377,1.704-2.057,2.556c-1.222,1.486-2.476,2.962-3.709,4.413c-0.699,0.822-1.391,1.637-2.07,2.445 c-1.198,1.396-2.416,2.752-3.6,4.068c-0.672,0.748-1.334,1.484-1.977,2.211c-1.215,1.393-2.434,2.672-3.61,3.91 c-0.519,0.544-1.024,1.076-1.514,1.6c-0.573,0.596-1.145,1.203-1.692,1.788c-0.943,1.005-1.836,1.954-2.676,2.77l-33.572,33.407 l36.875-29.696c0.991-0.776,2.025-1.669,3.12-2.613c0.589-0.508,1.196-1.033,1.831-1.567c0.546-0.473,1.089-0.936,1.645-1.408 c1.353-1.15,2.75-2.34,4.175-3.662c0.688-0.631,1.409-1.279,2.141-1.939c1.359-1.227,2.762-2.49,4.164-3.814 c0.756-0.727,1.51-1.445,2.271-2.172c0.933-0.889,1.875-1.787,2.818-2.699c-13.814,31.562-32.615,59.971-55.999,84.6 c-8.42-28.841-23.183-47.653-43.948-56.012c44.692-28.716,77.428-66.412,97.187-93.293C588.318,19.961,597.98,3.396,603.088-6 C601.215,23.082,595.826,51.156,587.035,77.586z"/>
					<path id="flocktype" fill="#383838" d="M1683.488,296.485c-31.491,0-59.604-11.151-79.155-31.398c-18.917-19.589-28.366-45.738-27.322-75.62 c2.171-62.141,50.192-107.243,114.185-107.243c45.753,0,70.25,25.173,82.975,47.515l-33.848,16.367 c-10.15-18.317-29.647-29.986-50.535-29.986c-19.55,0-37.628,7.408-50.902,20.859c-13.207,13.383-20.869,31.944-21.578,52.267 c-0.736,21.033,6.055,40.067,19.12,53.597c12.298,12.736,29.513,19.75,48.468,19.75c21.061,0,41.367-11.692,52.568-30.028 l32.478,15.979C1749.32,280.359,1720.251,296.485,1683.488,296.485z M1377.659,296.485c-30.511,0-57.774-10.832-76.769-30.501 c-18.76-19.425-28.516-46.601-27.471-76.518c2.171-62.141,49.25-107.243,111.945-107.243c30.692,0,58.082,10.857,77.119,30.573 c18.739,19.404,28.484,46.554,27.44,76.446c-1.055,30.199-12.901,57.569-33.357,77.064 C1436.148,285.768,1408.125,296.485,1377.659,296.485z M1383.958,116.118c-39.854,0-68.739,30.069-70.242,73.125 c-0.763,21.821,5.962,41.239,18.936,54.674c11.797,12.217,27.847,18.674,46.416,18.674c19.914,0,37.289-7.317,50.25-21.161 c12.391-13.234,19.606-31.689,20.313-51.963c0.762-21.782-5.949-41.161-18.894-54.566 C1418.87,122.613,1402.693,116.118,1383.958,116.118z M1987.729,292.648l-63.018-87.325l-20.717,23.717l-2.222,63.608h-39.008 l7.225-206.906h39.008l-3.541,101.386l83.835-101.386h47.372l-85.294,96.753l84.214,110.153H1987.729z M1063.672,292.648 l7.225-206.906h39.007l-6.052,173.331h90.183l-1.172,33.576L1063.672,292.648L1063.672,292.648z M820.461,292.648l7.225-206.906 h144.542l-1.173,33.575H865.522l-1.799,51.49h103.295l-1.172,33.575H862.551l-3.083,88.266H820.461z"/>
				</svg>
			</div>
			<div class="close" onclick="$.fancybox.close()"></div>
		</div>
	</div>
	<div class="modal-content">
			
			<?php if ($is_signup) { ?>
	
				<?php if ($is_internal) { ?>
				
					<form method="post">
						<input type="hidden" name="auth" value="1">
						<?php /*<div class="tight">*/ ?>
							<label><input type="text" placeholder="Full Name" size="1" name="username"></label>
							<label><input type="email" placeholder="E-mail" size="1"></label>
							<label><input type="text" placeholder="••••••••" size="1"></label>
						<?php /*</div>*/ ?>
						<div class="action">
							<div>
								<div>
									<?php echo $alt; ?>
								</div>
								<div>
									<input type="submit" class="epsilon thickest" value="<?php echo $label; ?>">
								</div>
							</div>
						</div>
					</form>
			
				<?php } else { ?>
				
					<form method="post">
						<input type="hidden" name="auth" value="1">
						<div class="ext-account-buttons">
							<span>
								<button name="ext-account" value="facebook" class="ext-account-button facebook labelled"></button>
								<button name="ext-account" value="twitter" class="ext-account-button twitter labelled"></button>
								<button name="ext-account" value="google-plus" class="ext-account-button google-plus labelled"></button>
								<button name="ext-account" value="linked-in" class="ext-account-button linked-in labelled"></button>
							</span>
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
	
					<form method="post">
						<input type="hidden" name="auth" value="1">
						<div class="tight">
							<div class="input-group">
								<input style="width:50%;" type="text" placeholder="E-mail" size="1" name="username">
								<input style="width:50%;" type="password" placeholder="••••••••" size="1">
							</div>
						</div>
						<div class="action">
							<div>
								<div>
									<?php echo $alt; ?>
								</div>
								<div>
									<input type="submit" class="epsilon thickest" value="<?php echo $label; ?>">
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