<?php
	
	global $countries;
	
	$profiles = array(
		'kadri' => array(
			'name'		=> array(
				'title'	=> 'Ms.',
				'first'	=> 'Kadri',
				'middle'=> 'Liis',
				'last'	=> 'Rääk'
			),
			'email'		=> 'kadri@example.com',
			'phone'		=> '+372 5555 5555',
			'street'	=> 'Nice House, Kadriorg',
			'zip'		=> '12345',
			'city'		=> 'Tallinn',
			'country'	=> 'EE'
		),
		'mart' => array(
			'name'		=> array(
				'title'	=> '',
				'first'	=> 'Mart',
				'middle'=> '',
				'last'	=> 'Uibo'
			),
			'email'		=> 'mart@example.com'
		),
		'michael' => array(
			'name'		=> array(
				'title'	=> 'Mr.',
				'first'	=> 'Michael',
				'middle'=> '',
				'last'	=> 'Walsh'
			),
			'email'		=> 'michael@example.com'
		)
	);
	
	$h = array_key_exists('i', $_GET) ? $_GET['i'] : null;
	
	if (!$h) return;
	
	$tab = $tab ? $tab : 'edit-profile';
	
	$full_name		= implode(' ', $profiles[$h]['name']);
	$first_name		= $profiles[$h]['name']['first'];
	$last_name		= $profiles[$h]['name']['last'];
	
	$title			= array_key_exists('name', $profiles[$h]) && array_key_exists('title', $profiles[$h]['name']) ? $profiles[$h]['name']['title'] : null;
	$middle_name	= array_key_exists('name', $profiles[$h]) && array_key_exists('middle', $profiles[$h]['name']) ? $profiles[$h]['name']['middle'] : null;
	
	$email			= array_key_exists('email',		$profiles[$h]) ? $profiles[$h]['email']		: null;
	$password		= array_key_exists('password',	$profiles[$h]) ? $profiles[$h]['password']	: null;
	$phone			= array_key_exists('phone',		$profiles[$h]) ? $profiles[$h]['phone']		: null;
	
	$street			= array_key_exists('street',	$profiles[$h]) ? $profiles[$h]['street']	: null;
	$zip			= array_key_exists('zip',		$profiles[$h]) ? $profiles[$h]['zip']		: null;
	$city			= array_key_exists('city',		$profiles[$h]) ? $profiles[$h]['city']		: null;
	
	
	$country_code	= array_key_exists('country',	$profiles[$h]) ? $profiles[$h]['country']	: null;
	$country		= $country_code && array_key_exists($country_code, $countries) ? $countries[$country_code]	: null;
	
	$bio			= array_key_exists('bio',		$profiles[$h]) ? $profiles[$h]['bio']		: null;
?>



<section id="investor-edit" class="<?php echo $tab; ?>">
	
	<div class="submenu">
		<div>
			<ul>
				<li><a class="dashboard" href="?p=dashboard">Dashboard</a></li>
				<li><a class="profile current" href="?p=investor-edit&i=<?php echo $h ?>">Profile</a></li>
				<?php /*<li><a class="accreditation <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='accreditation' ? 'current' : ''; ?>" href="?p=investor-edit&i=<?php echo $h ?>&tab=accreditation">Investor Accreditation</a></li>*/ ?>
				<li><a class="settings" href="?p=settings&i=<?php echo $h ?>">Settings</a></li>
			</ul>
		</div>
	</div>

	
	<?php if (array_key_exists('email', $_POST)) { ?>
		<div class="message">
			<div>
				Profile updated. &nbsp;&nbsp;<a class="button" href="?p=investor&i=<?php echo $h; ?>">View</a>
			</div>
		</div>
	<?php } else { ?>
		<div class="message silent">
			<div>
				<a class="button" href="?p=investor&i=<?php echo $h; ?>">View your public profile</a>
			</div>
		</div>
	<?php } ?>
	
	
	<div class="head fix">
		<div class="contract">
			<figure class="profile-badge">
				<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"><div class="focus"></div></a>
			</figure>
			<div class="profile-details">
				<h3 class="name"><?php echo $full_name;  ?></h3>
				
				<div class="mini-bio">
					<p>Hours of plowing like this would leave any girl's hairy goblet looking like Pete Burns' lips, and I was no different! I can't wait to chow down on the baby grav<?php /*<br><a href="#" class="hellip">…</a>*/ ?></p>
				</div>
	
				<div class="ext-account-buttons">
					<div>
						<div class="btns">
							<div>
								<button name="ext-account" value="facebook" class="ext-account-button facebook connected-ext-account-button"></button>
								<button name="ext-account" value="twitter" class="ext-account-button twitter connected-ext-account-button"></button>
								<button name="ext-account" value="google-plus" class="ext-account-button google-plus"></button>
								<button name="ext-account" value="linked-in" class="ext-account-button linked-in"></button>
							</div>
						</div> &nbsp;&nbsp;
						<div>
							<p class="tertiary">Connect external accounts to follow your friends' activity on Flock.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="tabs" class="tabs profile">
			<ul>
				<li><a href="?p=investor-edit&i=<?php echo $h ?>" class="personal <?php echo !array_key_exists('tab', $_GET) || (array_key_exists('tab', $_GET) && $_GET['tab']=='personal') ? 'current' : ''; ?>"><em>1</em> Personal Details</a></li>
				<li><a href="?p=investor-edit&i=<?php echo $h ?>&tab=accreditation" class="accreditation <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='accreditation' ? 'current' : ''; ?>"><em>2</em> Accreditation</a></li>
				<li><a href="?p=investor-edit&i=<?php echo $h ?>&tab=experience" class="experience <?php echo array_key_exists('tab', $_GET) && $_GET['tab']=='experience' ? 'current' : ''; ?>"><em>3</em> Experience</a></li>
			</ul>
		</div>
	</div>
	
	<?php /*<div class="body">
		<div class="main">*/ ?>
			
			<?php
				switch($tab) {
					case 'accreditation': ?>
						<div class="tab-content gridwrap" id="accreditation">
							<div>
							
								<form>
							
									<div class="intro">
										<p>
											Most investments are available to accredited investors only. Please answer the following questions to verify your qualification as an <a href="http://www.sec.gov/answers/accred.htm" target="_blank">Accredited Investor</a>.
										</p>
									</div>
									
									<fieldset class="separated-both">
										<h5>Identification Document</h5>
										<p>Please upload a scan of your Identification Document.</p>
										<div class="table">
											<div style="text-align:left;">
												<input id="doc-upload" type="file" name="doc-scan[]">
											</div>
											<div id="doc-upload-response"></div>
										</div>
										<div id="doc-upload-progress" class="goalmeter">
											<div class="progress" style="width:0%"></div>
										</div>
										<div id="doc-scan-preview">
											<img src="img/doc-scan.png">
										</div>
									</fieldset>
									
									<fieldset class="separated-bottom">
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
									
									<fieldset>
										<h5>Public Company Shareholder or Officer</h5>
										<p>?</p>
										<label class="radio" for="no-public-company"><input id="no-public-company" type="radio" name="public-company"> No</label>
										<label class="radio" for="yes-public-company"><input id="yes-public-company" type="radio" name="public-company"> Yes</label>
									</fieldset>
									
								</form>
							
							</div>
						</div>
						<?php break;

					case 'experience': ?>
						<div class="tab-content"><div></div></div>
						<?php break;

					default: ?>
						<div class="tab-content gridwrap" id="profile">
							<div>
					
								<form action="?p=investor-edit&i=<?php echo $h ?>" method="post">
									
									<label for="email">
										<?php /*<span>E-mail</span>*/ ?>
										<input id="email" name="email" type="email" placeholder="E-mail" size="1" value="<?php echo $email ?>">
									</label>
									
									<fieldset class="separated-bottom">
										<legend>To change your password, provide your old password and then type the new one:</legend>
										<div class="input-group">
											<label for="password-old" style="width:50%">
												<input id="password-old" type="text" placeholder="Old password" size="1" value="">
											</label>
											<label for="password-new" style="width:50%">
												<input id="password-new" type="text" placeholder="New password" size="1" value="">
											</label>
										</div>
									</fieldset>
									
									<fieldset class="input-group name">
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
										
										<label for="city">
											<?php /*<span>City/Town/Locality</span>*/ ?>
											<input id="city" type="text" placeholder="City/Town/Locality" size="1" value="<?php echo $city ?>">
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
									
									<?php /*<label for="bio">
										<?php /*<span>Mini biography</span>* ?>
										<textarea id="bio" type="text" placeholder="Mini biography, max 160 characters" size="1"><?php echo $bio ?></textarea>
									</label>*/ ?>
									
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
						<?php break;
				}
			?>
			
		<?php /*</div>
	</div>*/ ?>

	<?php /*
		<figure class="profile-badge">
			<a href="profile-pic.php" class="profile-pic fancybox.ajax"><img src="img/<?php echo $h; ?>.png"><div class="focus"></div></a>
		</figure>
		<div class="investor-name">
			<h3><?php echo $full_name; ?>
				<?php if (isset($investor_type_label) && isset($investor_type_class)) { ?>
					<label class="type <?php echo $investor_type_class; ?>"><?php echo $investor_type_label; ?></label>
				<?php } ?>
			</h3>
		</div>
		<div class="action">
		</div>*/ ?>
		
</section>