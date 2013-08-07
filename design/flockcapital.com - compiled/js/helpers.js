jQuery(document).ready(function($) {


	var winW,
		winH,
		$body = $('body'),
		is_project = $body.hasClass('project'),
		is_investor = $body.hasClass('investor'),
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
    		'my-profile': {
    			target: '.head h1',
    			content: '<h3>My Profile</h3>\
    					  <p>This is how you would see your own profile. Notice the buttons "Edit profile", "Investor Accreditation", …</p>',
		        position: {
					edge: 'top',
					align: 'left'
				},
				pointerWidth: 240
    		},
    		'public-profile': {
    			target: '.head h1',
    			content: '<h3>Public Profile</h3>\
    					  <p>This is how you would see someone elses profile. Notice missing "Edit profile", "Investor Accreditation", … buttons.</p>',
		        position: {
					edge: 'top',
					align: 'left'
				},
				pointerWidth: 240
    		},
    		'dashboard': {
    			target: '.feed',
    			content: '<h3>Dashboard</h3>\
    					  <p>A lotta more shit would be on the dashboard:</p>\
    					  <ul>\
    					  	<li>Infographics — Earnings etc.</li>\
    					  	<li>How complete is your profile</li>\
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
    		}
    	};
    
	if (is_investor) {
		if ($('#investor').hasClass('me')) {
			//open_pointer('my-profile');
		} else {
			//open_pointer('public-profile');
		}
	} else if (is_dashboard) {
		//open_pointer('dashboard');
	}




	layout();
});