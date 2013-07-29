<?php

	global $profile_data;

?>
<li>
	<div class="profile-badge">
		<div>
			<a href="<?php echo '?p='.$profile_data['type'].'&'.$profile_data['type'][0].'='.$profile_data['handle']; ?>" title="<?php echo $profile_data['name']; ?>"><img src="img/<?php echo $profile_data['handle']; ?>.png"></a>
			<div class="focus"></div>
		</div>
	</div>
	<div class="profile-title">
		<h3><a href="<?php echo '?p='.$profile_data['type'].'&'.$profile_data['type'][0].'='.$profile_data['handle']; ?>"><?php echo $profile_data['name']; ?></a>
			<?php if (array_key_exists('type_label', $profile_data) && array_key_exists('type_class', $profile_data)) { ?>
				<label class="type <?php echo $profile_data['type_class']; ?>"><?php echo $profile_data['type_label']; ?></label>
			<?php } ?>
		</h3>
	</div>
</li>