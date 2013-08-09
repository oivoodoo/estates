jQuery(document).ready(function($) {


	var winW,
		winH,
		$body = $('body'),
		is_project = $body.hasClass('project'),
		is_investor = $body.hasClass('investor'),
		is_manager = $body.hasClass('manager'),
		is_profile = $body.hasAnyClass('investor', 'manager'),
		is_dashboard = $body.hasClass('dashboard'),
		layout = function() {
			winW = $(window).width();
			winH = $(window).height();
			baseFontSize = parseInt($body.css('font-size'), 10);
		}

	$(window)
		.on('resize', function(){
			layout();
		})
		.on('load', function(){
			layout();
		});



	/*	 Designer pointers
	———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
    var open_pointer = function(i) {
	        pointer = pointers[i];
	        options = $.extend(pointer, {});
	        $(pointer.target).pointer(options).pointer('open');
	    },
	    pointers = {
    		'dashboard': {
    			target: '.feed',
    			content: '<p><b>Dashboard:</b></p>\
    					  <ul>\
    					  	<li>Activity feed</li>\
    					  	<li>Line graph — earnings total</li>\
    					  	<li>Map — cities/locations of investments</li>\
    					  	<li>How complete is your profile<br>(add a little badge "33%" to "Profile" in submenu)</li>\
    					  	<li>What you follow</li>\
    					  	<li>Who you follow</li>\
    					  	<li>Who follow you</li>\
    					  	<li>…</li>\
    					  </ul>',
		        position: {
					edge: 'top',
					align: 'left'
				},
				pointerWidth: 240
    		},
    		'profile': {
    			target: '.main >div >div',
    			content: '<p><b>Tabs:</b></p>\
    					  <ul>\
    					  	<li>Activity feed</li>\
    					  	<li>Accreditation ?</li>\
    					  	<li>Experience</li>\
    					  	<li>(#) Investments (side/tab)</li>\
    					  	<li>(#) Follows (side/tab)</li>\
    					  	<li>(#) Followers (side/tab)</li>\
    					  </ul>',
		        position: {
					edge: 'top',
					align: 'left'
				},
				pointerWidth: 240
    		},
    		'manager': {
    			target: '.main >div >div',
    			content: '<p><b>Tabs:</b></p>\
    					  <ul>\
    					  	<li>Activity feed</li>\
    					  	<li>Track record ?</li>\
    					  	<li>(#) Projects (side/tab)</li>\
    					  	<li>(#) Followers (side/tab)</li>\
    					  </ul>',
		        position: {
					edge: 'top',
					align: 'left'
				},
				pointerWidth: 240
    		}
    	};
    
	if (is_investor) {
		open_pointer('profile');
	}
	if (is_manager) {
		open_pointer('manager');
	}
	if (is_dashboard) {
		open_pointer('dashboard');
	}
	if (is_profile) {
	}




	layout();
});



///stackoverflow.com/a/10559271
jQuery.fn.hasAnyClass = function() {
	for (var i = 0; i < arguments.length; i++) {
		if (this.hasClass(arguments[i])) {
			return true;
		}
	}
	return false;
}