<?php
	
	global $investors, $countries;
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h || !array_key_exists($h, $investors)) return;
	
	$tab = $tab ? $tab : 'general';
	
	$full_name		= implode(' ', $investors[$h]['name']);
	$first_name		= $investors[$h]['name']['first'];
	$last_name		= $investors[$h]['name']['last'];
	
	$title			= array_key_exists('name', $investors[$h]) && array_key_exists('title', $investors[$h]['name']) ? $investors[$h]['name']['title'] : null;
	$middle_name	= array_key_exists('name', $investors[$h]) && array_key_exists('middle', $investors[$h]['name']) ? $investors[$h]['name']['middle'] : null;
	
	$email			= array_key_exists('email',		$investors[$h]) ? $investors[$h]['email']		: null;
	$password		= array_key_exists('password',	$investors[$h]) ? $investors[$h]['password']	: null;
	$phone			= array_key_exists('phone',		$investors[$h]) ? $investors[$h]['phone']		: null;
	
	$street			= array_key_exists('address',	$investors[$h]) && array_key_exists('street',	$investors[$h]['address']) ? $investors[$h]['address']['street']	: null;
	$zip			= array_key_exists('address',	$investors[$h]) && array_key_exists('zip',		$investors[$h]['address']) ? $investors[$h]['address']['zip']		: null;
	$locality		= array_key_exists('address',	$investors[$h]) && array_key_exists('locality',	$investors[$h]['address']) ? $investors[$h]['address']['locality']		: null;
	
	
	$country_code	= array_key_exists('address',	$investors[$h]) && array_key_exists('country',	$investors[$h]['address']) ? $investors[$h]['address']['country']	: null;
	$country		= $country_code && array_key_exists($country_code, $countries) ? $countries[$country_code]	: null;
	
	$bio			= array_key_exists('bio',		$investors[$h]) ? $investors[$h]['bio']		: null;
?>



<section id="settings" class="<?php echo $tab; ?>">
	
	
	<div class="head fix elevate">
		
		<div id="tabs" class="tabs submenu">
			<ul>
				<li><a href="?p=settings&i=<?php echo $h ?>" 						class="general	 		<?php echo !array_key_exists('tab', $_GET) || (array_key_exists('tab', $_GET) && $_GET['tab']=='general') ? 'current' : ''; ?>">General</a></li
				><li><a href="?p=settings&i=<?php echo $h ?>&tab=external-accounts" class="external-accounts <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='external-accounts' ? 'current' : ''; ?>">External Accounts</a></li
				><li><a href="?p=settings&i=<?php echo $h ?>&tab=accreditation"		class="accreditation 	<?php echo  array_key_exists('tab', $_GET) && $_GET['tab']=='accreditation' ? 'current' : ''; ?>">Investor Qualification</a></li
				><li><a href="?p=settings&i=<?php echo $h ?>&tab=notifications"		class="notifications 	<?php echo  array_key_exists('tab', $_GET) && $_GET['tab']=='notifications' ? 'current' : ''; ?>">Notifications</a></li
				><li><a href="?p=settings&i=<?php echo $h ?>&tab=delete-account"	class="delete-account 	<?php echo  array_key_exists('tab', $_GET) && $_GET['tab']=='delete-account' ? 'current' : ''; ?>">Delete Account</a></li>
			</ul>
		</div>
		
	</div>
			
	<?php
		switch($tab) {

			case 'external-accounts': ?>
				<div class="tab-content gridwrap current">
					<div>
						
						<div class="ext-account-buttons">
							<span>
								<button name="ext-account" value="facebook" title="Disconnect Facebook" class="ext-account-button facebook connected-ext-account-button labelled"></button>
								<button name="ext-account" value="twitter" title="Disconnect Twitter" class="ext-account-button twitter connected-ext-account-button labelled"></button>
								<button name="ext-account" value="google-plus" title="Connect Google+" class="ext-account-button disconnected-ext-account-button google-plus labelled"></button>
								<button name="ext-account" value="linked-in" title="Connect LinkedIn" class="ext-account-button disconnected-ext-account-button linked-in labelled"></button>
							</span>
							<p>
								Connect external accounts to follow your friends' activity on Flock.
							</p>
						</div>
						
					</div>
				</div>
				<?php break;
				
			case 'accreditation': ?>
				<div class="tab-content gridwrap current">
					<div>
						<div class="formwrap">
							
							<form>
						
								<div class="intro">
									<p>
										Most investments are available to accredited investors only. Please answer the following questions to verify your qualification as an <a href="http://www.sec.gov/answers/accred.htm" target="_blank">Accredited Investor</a>.
									</p>
								</div>
								
								
								<fieldset class="separated-both">
									<h5>Annual Individual Income</h5>
									<p>I have an individual income for each of the two most recent years equal to an income level indicated below and reasonably expect to reach at least the same level this year.</p>
									<label class="radio" for="level-1"><input id="level-1" type="radio" name="income-level"> &lt; $200'000</label>
									<label class="radio" for="level-2"><input id="level-2" type="radio" name="income-level"> $200'000 — $350'000</label>
									<label class="radio" for="level-3"><input id="level-3" type="radio" name="income-level"> $350'000 — $500'000</label>
									<label class="radio" for="level-4"><input id="level-4" type="radio" name="income-level"> $500'000 &lt;</label>
								</fieldset>
								
								
								<fieldset class="separated-bottom">
									<h5>Securities Firm</h5>
									<p>Are you associated with a Securities Firm?</p>
									<label class="radio" for="no-securities-firm"><input id="no-securities-firm" type="radio" name="securities-firm"> No</label>
									<label class="radio" for="yes-securities-firm"><input id="yes-securities-firm" type="radio" name="securities-firm"> Yes</label>
								</fieldset>
								
								
								<fieldset class="separated-bottom">
									<h5>Public Company Shareholder or Officer</h5>
									<p>?</p>
									<label class="radio" for="no-public-company"><input id="no-public-company" type="radio" name="public-company"> No</label>
									<label class="radio" for="yes-public-company"><input id="yes-public-company" type="radio" name="public-company"> Yes</label>
								</fieldset>
								
								
								<fieldset class="contact-details">
									<h5>Contact Details</h5>
									<div>
										<label for="phone">
											<?php /*<span>Phone</span>*/ ?>
											<input id="phone" type="text" placeholder="Phone" size="1" value="<?php echo $phone ?>">
										</label>
										<div class="tight">
											<label for="street">
												<?php /*<span>Street Address</span>*/ ?>
												<input id="street" type="text" placeholder="Street address" size="1" value="<?php echo $street ?>">
											</label>
											<label for="zip">
												<?php /*<span>Zip</span>*/ ?>
												<input id="zip" type="text" placeholder="Zip code" size="1" value="<?php echo $zip ?>">
											</label>
											
											<label for="locality">
												<?php /*<span>City/Town/Locality</span>*/ ?>
												<input id="locality" type="text" placeholder="City/Town/Locality" size="1" value="<?php echo $locality ?>">
											</label>
											
											<label for="country">
												<?php /*<span>Country</span>*/ ?>
												<select id="country" class="combobox">
													<option value="">Select a country…</option>
													<?php
														foreach($countries as $cc => $c) {
															echo '<option value="'.$cc.'" '. ($cc==$country_code ? 'selected="selected"' : '') .'>'.$c.'</option>';
														}
													?>
												</select>
											</label>
										</div>
									</div>
								</fieldset>
								
								
								<fieldset class="separated-top">
									<h5>Identification Document</h5>
									<p>Please upload a scan of your Identification Document.</p>
									<div class="table">
										<div style="text-align:left;">
											<input id="doc-upload" class="file-upload" type="file" name="doc-scan[]">
										</div>
										<div id="doc-upload-response" class="upload-response"></div>
									</div>
									<div id="doc-upload-progress" class="goalmeter">
										<div class="progress" style="width:0%"></div>
									</div>
									<div id="doc-scan-preview">
										<img src="img/doc-scan.png">
									</div>
								</fieldset>
						
					
								<div class="action">
									<div>
										<div>
											<input type="submit" class="zeta thickest" value="Submit">
										</div>
									</div>
								</div>
								
							</form>
						
						</div>
					</div>
				</div>
				<?php break;

			case 'notifications': ?>
				<div class="tab-content current">
					<div></div>
				</div>
				<?php break;

			case 'delete-account': ?>
				<div class="tab-content current">
					<div></div>
				</div>
				<?php break;

			default: ?>
				<div class="tab-content gridwrap current">
					<div>
						
						<div class="formwrap">
							
							<div class="manage-pic">
								<figure class="profile-badge">
									<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"><div class="focus"></div></a>
								</figure>
								<div>
									<div class="ext-account-pics">
										<span>
											<button name="ext-account" value="facebook" title="Use profile picture from Facebook" class="ext-account-button facebook">
												<img src="img/<?php echo $h; ?>.png">
											</button>
											<button name="ext-account" value="twitter" title="Use profile picture from Twitter" class="ext-account-button twitter used">
												<img src="img/<?php echo $h; ?>.png">
											</button>
											<button name="ext-account" value="google-plus" title="Use profile picture from Google+" class="ext-account-button google-plus">
												<img src="img/<?php echo $h; ?>.png">
											</button>
											<button name="ext-account" value="linked-in" title="Use profile picture from LinkedIn" class="ext-account-button linked-in">
												<img src="img/<?php echo $h; ?>.png">
											</button>
										</span>
									</div>
									<div class="upload-profile-pic">
										<form>
											<div class="table">
												<div style="text-align:left;">
													<input id="profile-pic-upload" class="file-upload" type="file" name="profile-pic[]">
												</div>
												<div id="profile-pic-upload-response" class="upload-response"></div>
											</div>
											<div id="profile-pic-upload-progress" class="goalmeter">
												<div class="progress" style="width:0%"></div>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<form action="?p=investor-edit&i=<?php echo $h ?>" method="post">
								
								<fieldset class="input-group name">
									<legend>Your name</legend>
									<label for="title" style="width:15%;">
										<?php /*<span>Full Name</span>*/ ?>
										<input id="title" type="text" placeholder="Title" size="1" value="<?php echo $title ?>">
									</label>
									<label for="first-name" style="width:28.33%">
										<?php /*<span>&nbsp;</span>*/ ?>
										<input id="first-name" type="text" placeholder="First Name" size="1" value="<?php echo $first_name ?>">
									</label>
									<label for="middle-names" style="width:28.33%">
										<?php /*<span>&nbsp;</span>*/ ?>
										<input id="middle-names" type="text" placeholder="Middle Name(s)" size="1" value="<?php echo $middle_name ?>">
									</label>
									<label for="last-name" style="width:28.33%">
										<?php /*<span>&nbsp;</span>*/ ?>
										<input id="last-name" type="text" placeholder="Last Name" size="1" value="<?php echo $last_name ?>">
									</label>
								</fieldset>
								
								<label for="bio">
									<span>Mini biography</span>
									<textarea id="bio" type="text" placeholder="Mini biography, max 160 characters" rows="5"><?php echo $bio ?></textarea>
								</label>
								
								
								<fieldset class="separated-top">
									<label for="email">
										<span>E-mail</span>
										<input id="email" name="email" type="email" placeholder="E-mail" size="1" value="<?php echo $email ?>">
									</label>
								</fieldset>
								<fieldset>
									<legend class="text">To change your password, provide your old password and then type the new one:</legend>
									<div class="input-group">
										<label for="password-old" style="width:50%">
											<input id="password-old" type="text" placeholder="Old password" size="1" value="">
										</label>
										<label for="password-new" style="width:50%">
											<input id="password-new" type="text" placeholder="New password" size="1" value="">
										</label>
									</div>
								</fieldset>
								
								<div class="action">
								<div>
									<div>
										<?php /*<a href="?p=investor&i=<?php echo $h ?>" class="button zeta thickest gray">Cancel</a>*/ ?>
										<input type="submit" class="zeta thickest" value="Update">
									</div>
								</div>
							</div>
								
							</form>
						</div>
					
					</div>	
				</div>
				<?php break;

		}
	?>
		
</section>