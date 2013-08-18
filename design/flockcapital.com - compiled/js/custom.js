window.graphs = {};
window.gmaps = {};

jQuery(document).ready(function($) {

	var winW,
		winH,
		menuTallH,
		menuShortH,
		submenuH,
		baseFontSize = parseInt($('body').css('font-size'), 10),
		menuH,
		footerH,
		iniLoad = true,
		hst = window.location.protocol +'//'+ window.location.host,
		$window = $(window),
		$body = $('body'),
		$masthead = $('#masthead'),
		$wrap = $('#wrap'),
		$footer = $wrap.find('>footer'),
		$nag = $('#nag'),
		is_home = $body.hasClass('home'),
		is_project = $body.hasClass('project'),
		is_investor = $body.hasClass('investor'),
		is_dashboard = $body.hasClass('dashboard'),
		menuFlex = $body.hasAnyClass('home') ? true : false,

		connectionMasonry = function(){
			$('.connections').each(function(i,el){
				var $el = $(el);
				var connectionH = $el.find('li').eq(0).height();
				$el.find('li:gt(0)').each(function(i,el){
					var $li = $(el);
					$li.height(connectionH);
					$li.find('.plate').css('text-align', '');
				});
				$el.find('li').css('visibility','visible');
			});
		},
		submenuHeights = function() {
			$('#masthead ul ul')
				.each(function(i,el){
					var $submenu = $(el),
						height = 0;
					$submenu.children().each(function(i,el){
						height+= $(el).outerHeight(true);
					});
					$submenu.data('height', height);
				});
		},
		fixPos = function() {
			var scrollTop = $window.scrollTop();
			$('.fix').each(function(i,el){
				var $el = $(el),
					top = $el.data('top') || menuShortH,
					steal = 0; // px

				if (scrollTop+top+steal > $el.data('offsetTop') && winW > 469) {
					if (!$el.data('fixed')) {
						$el.addClass('narrow');
						$el.data('fixedclone').insertBefore($el).css('top', top);
						$el.data('fixed', true);
						setTimeout(function(){
							$el.data('fixedclone').addClass('narrow');
						}, 1);
					}
				} else {
					$el.removeClass('narrow').data('fixedclone').removeClass('narrow').detach();
					$el.data('fixed', false);
				}
			});
		},
		hashChange = function(e) {
			e.preventDefault();
			if (is_project || is_dashboard) {
				var first_tab_href = $('.main .tabs a, .tabs.major a').eq(0).attr('href'),
					tab = window.location.hash || first_tab_href.substring(first_tab_href.indexOf("#")),
					$tab = $(tab.replace('#', '.')+'-tab'),
					$tabs = $tab.closest('.tabs'),
					$cloned_tabs = $tabs.data('original') || $tabs.data('fixedclone'),
					$other_tabs = $('a.tab').not($tab),
					$tab_content = $(tab+'-content'),
					$other_tab_contents = $('.tab-content').not($tab_content),
					$other_main_tab_contents = $('.main .tab-content').not($tab_content);

				if ($tab_content.length) {
					if (winW > 1000) {
						if (!$tab_content.hasClass('side-tab-content')) {
							$other_main_tab_contents.removeClass('current');
							$tab_content.addClass('current');
							$other_tabs.removeClass('current');
							$tab.addClass('current');
							if ($cloned_tabs.length) {
								var $cloned_tab = $cloned_tabs.find(tab.replace('#', '.')+'-tab').addClass('current'),
									$other_cloned_tabs = $cloned_tabs.find('a.tab').not($cloned_tab);
								$other_cloned_tabs.removeClass('current');
								$cloned_tab.addClass('current');
							}
						}
					} else {
						$other_tab_contents.removeClass('current');
						$tab_content.addClass('current');
						connectionMasonry();
						$other_tabs.removeClass('current');
						$tab.addClass('current');
						if ($cloned_tabs.length) {
							var $cloned_tab = $cloned_tabs.find(tab.replace('#', '.')+'-tab').addClass('current'),
								$other_cloned_tabs = $cloned_tabs.find('a.tab').not($cloned_tab);
							$other_cloned_tabs.removeClass('current');
							$cloned_tab.addClass('current');
						}
					}
				}
			}
			if (is_dashboard) {
				var tab = window.location.hash || first_tab_href.substring(first_tab_href.indexOf("#"));
				if (tab=='#reports')
					drawCharts();
				if (tab=='#map' && !iniLoad)
					reLayoutMaps();
			}
		},
		layout = function() {
			winW = $(window).width();
			winH = $(window).height();
			footerH = $footer.outerHeight(true);
			baseFontSize = parseInt($body.css('font-size'), 10);
			menuTallH = 8*baseFontSize;
			menuShortH = 4*baseFontSize;
			submenuH = $('.submenu').outerHeight();
			$('.fix').each(function(i,el){
				var $el = $(el),
					$prev = $('.fix').eq(Math.max(1,i)-1);
				$el.data('offsetTop', $el.offset().top);
				$el.data('top', i==0 ? menuShortH : menuShortH+$prev.outerHeight());
			});

			$wrap.css('padding-bottom', footerH);

			if (is_project) {
				if (winW > 1000 && $('.side .tab-content.current').length) {
					location.href = $('.main .tabs a, .tabs.major a').eq(0).attr('href');
				}
			}

			//$('#map-content').height(winH);

			submenuHeights();

			sizeMenu();
		}

	$window
		.on('resize', function(e){
			layout();
			connectionMasonry();
			drawCharts();
			reLayoutMaps();
		})
		.on('scroll', function(e){
			sizeMenu();
			callNag();
			fixPos();
		})
		.on('click.nag', function(e){
			callNag();
		})
		.on('load', function(){
			layout();
			connectionMasonry();
			drawCharts();
			for (map_handle in gmaps) {
				if (gmaps.hasOwnProperty(map_handle)) {
					// map_handle -> gmaps[map_handle]
					init_map(map_handle, gmaps);
				}
			}
		})
		.on('hashchange', function(e){
			hashChange(e);
		});

	$('.fix')
		.each(function(i,el){
			var $el = $(el);
			$el.data('fixedclone', $el.clone().removeClass('fix').addClass('fixed'));
			$el.data('fixedclone').data('original', $el);
			$el.data('fixedclone').find('ul').cleanWhitespace();
		});

	$('.main-switch .tabs a')
		.on('click', function(e){
			var $el = $(this),
				$switch_group = $el.closest('.switch-group'),
				switch_name = $el.attr('href');

			if (!$el.hasClass('main-switch-current')) {
				$switch_group.find('.main-switch').removeClass('main-switch-current');
				$(switch_name+'-content').addClass('main-switch-current');
			}
		});

	$('.side-switch .tabs a')
		.on('click', function(e){
			var $el = $(this),
				$switch_group = $el.closest('.switch-group'),
				switch_name = $el.attr('href');

			if (!$el.hasClass('side-switch-current')) {
				$switch_group.find('.side-switch').removeClass('side-switch-current');
				$(switch_name+'-content').addClass('side-switch-current');
				connectionMasonry();
			}
		});

	submenuHeights();
	$('#masthead li')
		.on('mouseenter', function(e){
			var $submenu = $(this).find('ul');
			if ($submenu.length) {
				$submenu.height( $submenu.data('height')-1 );
			}
		})
		.on('mouseleave', function(e){
			var $submenu = $(this).find('ul');
			if ($submenu.length) {
				$submenu.outerHeight( 0 );
			}
		});

	$('.project-badge .project-name .profile-badge')
		.on('mouseenter', function(e){
			$(this).parent().find('.manager-location span a').addClass('active');
		})
		.on('mouseleave', function(e){
			$(this).parent().find('.manager-location span a').removeClass('active');
		});

	$('.project-badge .profile-badge, .project-badge .action button.follow, .project-badge .action button.tracking, .project-badge .action button.track, .project-badge .manager-location a')
		.on('mouseenter', function(e){
			$(this).closest('.project-badge').find('.project-thumb .focus, .action button.details').addClass('overridehide');
			$(this).closest('.project-badge.dash-tracking-list').find('.project-link').addClass('overridehide');
		})
		.on('mouseleave', function(e){
			$(this).closest('.project-badge').find('.project-thumb .focus, .action button.details').removeClass('overridehide');
			$(this).closest('.project-badge.dash-tracking-list').find('.project-link').removeClass('overridehide');
		});

	$('button.tracking.labelled')
		.on('mouseenter', function(e){
			$(this).text('Stop tracking');
		})
		.on('mouseleave', function(e){
			$(this).text('Tracking');
		});

	$('#masthead nav ul, .tabs ul, .submenu ul, #intro .action, .financials >div >div >div, .ext-account-buttons')
		.cleanWhitespace();

	$('.combobox')
		.combobox();

	$('#password-old')
		.on('keydown', function(){
			$(this).prop('type', 'password');
		})
		.on('blur', function(){
			if ($(this).val()=='') $(this).prop('type', 'text');
		});

	$('label.radio')
		.on('click', function(){
			var $this = $(this),
				id = $this.attr('for');

			if (typeof id!=='undefined') {
				var name = $('#'+id).prop('name');
				if (typeof name!=='undefined') {
					var $siblings = $('input[name="'+name+'"]');
					$siblings
						.each(function(i,el){
							var id = $(el).attr('id');
							$('label[for='+id+']').removeClass('selected');
						});
				}
			}
			$this.addClass('selected');
		});

	$('#doc-upload')
		.fileupload({
			// data type for callback response
	        dataType: 'json',
		    progressall: function (e, response) {
		        var progress = parseInt(response.loaded / response.total * 100, 10);
		        $('#doc-upload-progress .progress').width(progress+'%');
		    },
	        done: function(e, response) {
	            $('#doc-upload-progress .progress').width('100%');
	        	$('#doc-upload-progress').removeClass('error');
	            $('#doc-upload-response').removeClass('error').text('Done!').show();
	        },
	        fail: function(e, response) {
	        	$('#doc-upload-progress').addClass('error');
	            $('#doc-upload-response').addClass('error').text('Failed!').show();
	        },
	        send: function(e, data) {
		        $('#doc-upload-progress').removeClass('error').show();
		        $('#doc-upload-response').hide();
	        }
	    });




	/*	 Maps
	—————————————————————————————————————————————————————————————————————————————————————— */
	var initiated_gmaps = {},
		gmap_styles = {
			style_one: [
				{
			    	stylers: [
			    		{ saturation: -100 },
			    		{ lightness: 35 }
			    	]
			    },{
					elementType: 'labels',
					stylers: [
						{ weight: .2 },
			    		{ lightness: -10 }
					]
				},{
					elementType: 'labels.text.stroke',
					stylers: [
						{ visibility: 'off' }
					]
				},{
					featureType: 'water',
					stylers: [
						{ color: '#b8b8b8' } // @magnesium = #b8b8b8
					]
				}
			]
		},
		init_map = function(map_handle, maps) {

			if (typeof map_handle==='undefined' || typeof maps==='undefined' || !maps.hasOwnProperty(map_handle))
				return false;

			var map_canvas = document.getElementById(map_handle+'_map_canvas');

			if (!map_canvas)
				return false;

			var map_addresses = maps[map_handle],
				iniZoom = 14,
				iniCenter,
				iconImg = hst+'/g/map_icon@x2.png';

			// Create a new StyledMapType object, passing it the array of styles, as well as the name to be displayed on the map type control.
			var styledMap = new google.maps.StyledMapType(gmap_styles.style_one, {name: 'Gray Map'}),
				styledMapID = 'flockStyledMap';

			// Create a map object, and include the MapTypeId to add to the map type control.
			var mapOptions = {
				zoom: iniZoom,
				minZoom: 2,
				scrollwheel: false,
				draggable: true,

				mapTypeControlOptions: {
					mapTypeIds: [
						styledMapID,
						google.maps.MapTypeId.ROADMAP,
						google.maps.MapTypeId.TERRAIN,
						google.maps.MapTypeId.SATELLITE,
						google.maps.MapTypeId.HYBRID
					]
        },
				//mapTypeControl: false, // or we can hide the map type switch entirely

				backgroundColor: 'transparent'
			};

			// Create the map entity
			var this_map = new google.maps.Map(map_canvas, mapOptions);

			// Define marker-image for location pins
			var icon = new google.maps.MarkerImage(iconImg, null, null, null, new google.maps.Size(18, 26)); // map_icon@x2.png is 36×52px

			this_map.infoBubble = new InfoBubble({
				maxWidth: 300,
				closeButtonClass: 'infobubble-close',
				map: this_map,
				content: '',
				position: new google.maps.LatLng(-35, 151),
				shadowStyle: false,
				padding: 0,
				backgroundColor: 'white',
				borderRadius: 0,
				arrowSize: 10,
				borderWidth: 0,
				backgroundClassName: 'infobubble',
				arrowStyle: 0,
				disableAnimation: true
			});

			// Make dem markers
			this_map.markers = [];
			var latlngbounds = new google.maps.LatLngBounds();
			for (i = 0; i < map_addresses.length; i++) {
				var position = new google.maps.LatLng(map_addresses[i]['lat'], map_addresses[i]['lng']);
				latlngbounds.extend(position); //Extend the initial view boundaries with this marker
				this_map.markers.push(
					new google.maps.Marker({
						map: this_map,
						position: position,
						icon: icon,
						zoomControl: false,
						scaleControl: false,
						scrollwheel: false
						//animation: google.maps.Animation.DROP
					})
				);
				google.maps.event.addListener(this_map.markers[i], 'click', (function(marker, i) {
					return function() {
						this_map.markers[i].setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
						this_map.infoBubble.setContent('<h5><a href="'+map_addresses[i]['link']+'">'+map_addresses[i]['title']+'</a></h5><address>'+map_addresses[i]['address']+'</address>');
						this_map.infoBubble.open(this_map, marker);
					};
				})(this_map.markers[i], i));
			}

			// Prevent panning off the world
			var lastValidCenter = this_map.getCenter(),
				checkBounds = function(zoom) {
					var bounds = this_map.getBounds();
					if (bounds) {
						if (bounds.getNorthEast().lat() < 85 && bounds.getSouthWest().lat() > -85) {
							lastValidCenter = this_map.getCenter();
						} else {
							if (zoom && (bounds.getNorthEast().lat() > 85 || bounds.getSouthWest().lat() < -85)) {
								var	ne = new google.maps.LatLng( 85,  99999999999999999),
									sw = new google.maps.LatLng(-85, -99999999999999999),
									limitBounds = new google.maps.LatLngBounds(ne, sw);
								this_map.fitBounds(limitBounds);
							} else {
								this_map.panTo(lastValidCenter);
							}
						}
					}
				};
			google.maps.event.addListener(this_map, 'center_changed', checkBounds);
			google.maps.event.addListener(this_map, 'bounds_changed', checkBounds);
			google.maps.event.addListener(this_map, 'zoom_changed', function(){ checkBounds(true) });



			if (map_addresses.length>1) {
				iniCenter = latlngbounds.getCenter();
				this_map.fitBounds(latlngbounds);
				this_map.setCenter(iniCenter);
			} else {
				iniCenter = new google.maps.LatLng(map_addresses[0]['lat'], map_addresses[0]['lng']);
				this_map.setCenter(iniCenter);
			}

			// Associate the styled map with the MapTypeId.
			this_map.mapTypes.set(styledMapID, styledMap);
			this_map.setMapTypeId(styledMapID);

			initiated_gmaps[map_handle] = {
				center: iniCenter,
				map: this_map
			};
		}
		reLayoutMaps = function() {
			for (map_handle in initiated_gmaps) {
				if (initiated_gmaps.hasOwnProperty(map_handle)) {
					// map_handle -> initiated_gmaps[map_handle]
					var map = initiated_gmaps[map_handle].map,
						center = initiated_gmaps[map_handle].center || map.getCenter();
					google.maps.event.trigger(map, 'resize');
					map.setZoom( map.getZoom() );
					map.setCenter( center );
				}
			}
		};




	/*	 Chart creation
	—————————————————————————————————————————————————————————————————————————————————————— */
	var	chartDefaults = {
			line: {
				bezierCurve: false,
				scaleFontFamily: 'neue-haas-grotesk-text',
				scaleSteps: 5,
				scaleFontColor: 'hsl(0, 0%, 97%)',
				datasetStrokeWidth : 1,
				pointDotRadius: 3,
				pointDotStrokeWidth: 1,
				scaleLineColor : 'hsla(0, 0%, 97%, .2)',
				scaleGridLineColor : 'hsla(0, 0%, 97%, .05)',

				animation : false,
				animationEasing : 'easeOutQuad',
				animationSteps : 50
			},
			doughnut: {
				segmentStrokeColor: 'transparent',

				animation : false,
				animationEasing : 'easeOutQuad',
				animationSteps : 50
			}
		},
		drawCharts = function() {
			$.each(window.graphs, function(g, options) {
				var $canvas = $('#'+g+'-canvas');
				if ($canvas.length && $canvas.is(':visible')) {
					var canvasW = $canvas.attr('width'),
						canvasH = $canvas.attr('height');

					$('.graph-canvas').hide();
					var parentW = $canvas.parent().width();
					$('.graph-canvas').show();
					$canvas.prop({
						width: parentW,
						height: parentW*canvasH/canvasW
					});

					var ctx = $canvas.get(0).getContext('2d'),
						graph_options = $.extend(chartDefaults[options.type], options['options'], {}),
						graph = options.type == 'line' ?
									new Chart(ctx).Line(options['data'], graph_options)
							  : options.type == 'doughnut' ?
									new Chart(ctx).Doughnut(options['data'], graph_options)
							  : null;
				}
			});
		}



	/*	 Fold the main menu when when viewport is too narrow
	—————————————————————————————————————————————————————————————————————————————————————— */
	$('#spread')
		.on('click', function(e){
			var expand = $masthead.hasClass('expanded') ? false : true;
			if (!expand) {
				$masthead.scrollTop(0).addClass('animating');
				setTimeout(function(){$masthead.removeClass('animating')}, 300);
				$('body').css('overflow','auto');
			} else {
				$('body').css('overflow','hidden');
			}
			$masthead.toggleClass('expanded').height(function(){
				var navH = $masthead.find('nav').outerHeight(true);

				mastHeadH = menuFlex ? (expand ? menuH+navH : menuH) : (expand ? ((3+(navH/baseFontSize))*1.1)+'rem' : '3rem'); //TODO: +2.6 ????
				//console.log(baseFontSize, navH);

				return  mastHeadH;
			});
		});



	/*	 Shrink the main menu then scrolling down / bloat when scrolling to top
	—————————————————————————————————————————————————————————————————————————————————————— */
	var menuTimeout,
		sizeMenu = function() {
		if (menuFlex) {
			var scrollTop = $(window).scrollTop(),
				//mini = scrollTop > menuTallH-menuShortH ? true : false,
				autohide = scrollTop > menuTallH ? true : false;

			/*if (mini)
				return;*/

			if (   scrollTop <= Math.max(0, $('#intro').height()-menuTallH)   ) {
				// don't contract the menu yet
				document.getElementById('masthead').style.height = '';
				document.getElementById('nav').style.marginTop = '';
				document.getElementById('expand').style.marginTop = '';
				$('#masthead').removeClass('mini');

			} else if (   scrollTop>=Math.max(Math.abs($('#intro').height()-menuShortH),0)   ) {
				// don't contract the menu any further
				document.getElementById('masthead').style.height = '';
				document.getElementById('nav').style.marginTop = '';
				document.getElementById('expand').style.marginTop = '';
				$('#masthead').addClass('mini');

			} else {
				//menuH = menuTallH - (scrollTop - (Math.abs($('#intro').height()-menuTallH)));
				  menuH = menuTallH - scrollTop + Math.max(0, ($('#intro').height()-menuTallH));
				//menuH = $('#intro').height() - scrollTop;
				console.log(menuH);
				document.getElementById('masthead').style.height = menuH+'px';
				document.getElementById('nav').style.marginTop = ((menuH-menuShortH)/2)+'px';
				document.getElementById('expand').style.marginTop = ((menuH-menuShortH)/2)+'px';
				$('#masthead').removeClass('mini');

			}



			//document.getElementById('masthead').style.height = menuH+'px';
			//$masthead.toggleClass('mini', mini);
		}
	};




	/*	Annoy/destroy the sign in/sign up nag
		*) we need need the timeout since browsers auto-scroll the page when you
		   navigate back/fwd and we want the nag to be invoked by manual scroll only
	—————————————————————————————————————————————————————————————————————————————————————— */
	var nag = false,
		callNag = function() {
			if (nag) {
				setTimeout(function() {
					$nag.css('visibility','visible').stop().animate({'opacity':1}, 700);
				}, 1000);
				$(window).off('click.nag');
				nag = false;
			}
		}
		setTimeout(function(){ // *
			nag = false; // true = nag ON, false = nag OFF
		}, 1000);
		$nag.find('.close').on('click', function(e){
			$nag.fadeOut(200, function(){
				$nag.remove();
			});
		});




	/*	 Sign-in modal
	—————————————————————————————————————————————————————————————————————————————————————— */
	$('.sign-in, .profile-pic')
		.fancybox({
			helpers:	 {
				  overlay : {
					   css : {
						  'background' : 'rgba(41,41,41, .9)'
					  }
				  }
			  },
			  closeBtn: false,/*,
			stretchToView: true,
			modal: true,*/
			afterShow: function() {
				$('.ext-account-buttons').cleanWhitespace();
			}/*,
			beforeClose: function() {
				$wrap.css('visibility', 'visible');
			}*/
		});



	$('.fancybox-video')
		.fancybox({
			helpers:	 {
				  overlay : {
					   css : {
						  'background' : 'rgba(41,41,41, .9)'
					  }
				  }
			  },
			  beforeLoad : function() {
				 this.width	 = parseInt(this.element.data('width'));
				 this.height = parseInt(this.element.data('height'));
			 }
		});



	layout();

	$window.trigger( 'hashchange' );
	iniLoad = false;


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

jQuery.fn.cleanWhitespace = function() {
	///stackoverflow.com/a/2587356
	textNodes = this.contents().filter(function() {
		return (this.nodeType == 3 && !/\S/.test(this.nodeValue));
	}).remove();
	return this;
}



