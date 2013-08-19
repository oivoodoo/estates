<?php

	global $profile_data;

?>
<li>
	<div class="profile-badge">
		<div>
			<a href="<?php echo '?p='.$profile_data['type'].'&'.$profile_data['type'][0].'='.$profile_data['handle']; ?>" title="<?php echo implode(' ', $profile_data['name']); ?>">
				<img src="img/<?php echo $profile_data['handle']; ?>.png">
			</a>
		</div>
	</div>
</li>