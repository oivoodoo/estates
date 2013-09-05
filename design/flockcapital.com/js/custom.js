var Ips = Ips || {};
Ips.Flock = Ips.Flock || {};
Ips.Flock.gmaps = {};
Ips.Flock.charts = {};
Ips.Flock.graphs = {};


jQuery(document).ready(function($) {

	Ips.Flock.Init = function(element, options) {
		
		var gmap_styles = {
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
				],
				style_two: [
					{
						"stylers": [
							{ "saturation": -40 },
							{ "hue": "#ffaa00" }
						]
					},{
						"featureType": "road",
						"elementType": "geometry",
						"stylers": [
							{ "visibility": "simplified" },
							{ "lightness": 100 }
						]
					},{
						"featureType": "road",
						"elementType": "labels",
						"stylers": [
							{ "visibility": "on" },
							{ "weight": 0.3 },
							//{ "gamma": .1 },
							{ "saturation": -60 }
						]
					},{
						"featureType": "poi.park",
						"elementType": "geometry",
						"stylers": [
							{ "color": "#cadfaa" },
							{ "saturation": -40 },
							{ "lightness": 20 }
						]
					},{
						"featureType": "landscape.natural",
						"stylers": [
							{ "color": "#9cdfaa" },
							{ "saturation": -75 }
						]
					},{
						"featureType": "water",
						"elementType": "geometry",
						"stylers": [
							{ "color": "#a6cade" },
							{ "saturation": -60 },
							{ "lightness": -20 },
							{ "visibility": "simplified" }
						]
					},{
						"featureType": "transit.line",
						"stylers": [
							{ "saturation": -100 },
							{ "lightness": 20 }
						]
					},{
						"featureType": "water",
						"elementType": "labels",
						"stylers": [
							{ "saturation": -100 }
						]
					}
				]
			},
			_o = $.extend({}, {
				gmap_style: gmap_styles.style_two
			}, options);
	
		var $window = $(window),
			$body = $('body'),
			$masthead = $('#masthead'),
			$wrap = $('#wrap'),
			$footer = $wrap.find('>footer'),
			$nag = $('#nag'),
			winW = $window.width(),
			winH = $window.width(),
			is_narrow = winW<=1000 ? true : false,
			menuTallH,
			menuShortH,
			submenuH,
			baseFontSize = parseInt($('body').css('font-size'), 10),
			menuH,
			footerH,
			hash = '',
			iniLoad = true,
			hst = window.location.protocol +'//'+ window.location.host,
			is_home = $body.hasClass('home'),
			is_projects = $body.hasClass('projects'),
			is_project = $body.hasClass('project'),
			is_investor = $body.hasClass('investor'),
			is_manager = $body.hasClass('manager'),
			is_dashboard = $body.hasClass('dashboard'),
			is_settings = $body.hasClass('settings'),
			do_drawRaise = true, // (!is_dashboard && !is_investor && !is_manager),
			menuFlex = is_home,
			fancyboxOpts = {
				helpers:{
					overlay : {
						css : {
							'background' : 'rgba(23,23,23, .9)'
						}
					}
				},
				closeBtn: false
			},
			
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
			fix = function() {
				var scrollTop = $window.scrollTop();
				$('.fix').each(function(i,el){
					var $el = $(el),
						top = $el.data('top') || menuShortH,
						steal = -1; // px
					
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
			submenuHeights = function() {
				$('#masthead ul ul')
					.each(function(i,el){
						var $submenu = $(el),
							height = 0;
						$submenu.children().each(function(i,el){
							height+= $(el).outerHeight(true);
						});
						$submenu.data('height', height + (.5*baseFontSize) ); // + the speechbubble arrow
					});
			},
			juxtaposeProjects = function() {
				var numBadgesInRow = 1;
				if (winW >= 1800)
					numBadgesInRow = 4
				if (winW.between(1500, 1799))
					numBadgesInRow = 3
				if (winW.between(1200, 1499))
					numBadgesInRow = 3
				if (winW.between(1001, 1199))
					numBadgesInRow = 2
				if (winW.between( 760, 1000))
					numBadgesInRow = 2
				if (winW.between( 470,	759))
					numBadgesInRow = 1
				if (winW < 470)
					numBadgesInRow = 1;
				
				var badges = $('.project-badge'), summaryH;
				badges.find('.summary').css('min-height', '');
				if (numBadgesInRow > 1) {
					for (i=0; i<Math.ceil(badges.length/numBadgesInRow); i++) {
						summaryH = 0;
						badges
							.slice(i*numBadgesInRow, (i+1)*numBadgesInRow)
							.find('.summary')
							.each(function(i, el){
								summaryH = Math.max(summaryH, $(el).outerHeight());
							})
							.css('min-height', summaryH);
					}
				}
			},
			is_tabbed = is_dashboard || is_investor || is_manager || is_project,
			hashChange = function(e) {
				e.preventDefault();
				
				if (is_tabbed) {
					var first_tab_href = $('#tabs a').eq(0).attr('href'),
						tab = window.location.hash || first_tab_href.substring(first_tab_href.indexOf("#")),
						$tab_content = tab ? $(tab+'-content') : '';
					
					if (!$tab_content.length) {
						history.go(-1);
						return;
					}
					
					var $tab = $(tab.replace('#', '.')+'-tab'),
						$fix = $tab.closest('.fix, .fixed'),
						$cloned_tabs = $fix.length ? ($fix.data('original') || $fix.data('fixedclone')) : [],
						$other_tabs = $('a.tab').not($tab),
						$other_tab_contents = $('.tab-content').not($tab_content),
						$other_main_tab_contents = $('.main .tab-content').not($tab_content);
					
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
						if (is_project && $tab.parent().hasClass('side-tab')) {
							$('.offer-disclaimer').hide();
						} else {
							$('.offer-disclaimer').show();
						}
					}
					
					if (!iniLoad) {
						$('html, body').stop().animate({
							scrollTop: is_project ? $('.head').outerHeight() - menuShortH : 0
						}, 300);
					}
					
					if ($.inArray(tab, ['#investments', '#tracking', '#location'])!=-1 && !iniLoad)
						reLayoutMaps();
						
					if ($.inArray(tab, ['#reports'])!=-1 && !iniLoad)
						updateCharts();
					
					layoutSideFeed();
	
				}
				
				hash = window.location.hash;
				iniLoad = false;
			},
			is_sideFeed = is_project || is_dashboard || is_investor || is_manager,
			bodyBottom=mainH=sideSiblingsH=feedTop = 0,
			minFeedH = 360,
			layoutSideFeed = function() {
				if (is_sideFeed) {
					if (winW>1000) {
						mainH = $('.main >div').height();
						pageScrollPos = feedTop = $('html, body').scrollTop();
						bodyBottom = $('.body').height() + $('.body').offset().top + pageScrollPos;
						sideSiblingsH = 0;
						$('.side >div').children().each(function(){
							if ($(this).attr('id')!='timeline-content') {
								var thisH = $(this).outerHeight(true);
								feedTop = thisH + $(this).offset().top;
								sideSiblingsH+= thisH;
							} else
								return;
						});
						
						if (mainH-sideSiblingsH > (winH-menuH)) {
							$('#timeline-content').css('max-height', winH-menuH);
						} else {
							$('#timeline-content').css('max-height', Math.max(Math.min(mainH-sideSiblingsH, winH-menuH), minFeedH) );
						}
					} else {
						$('#timeline-content').removeClass('scroll fixxed bottom').css('max-height', '');
					}
					
					fixSideFeed();
				}
			},
			fixSideFeed = function(e) {
				if (is_sideFeed && winW>1000) {
					var scrollTop = $window.scrollTop();
					if (mainH-sideSiblingsH > (winH-menuH)) {
						if (scrollTop >= feedTop-menuH) {
							if (scrollTop > bodyBottom-winH)
								$('#timeline-content').removeClass('fixxed scroll').addClass('bottom');
							else
								$('#timeline-content').removeClass('bottom').addClass('fixxed scroll');
						} else {
							$('#timeline-content').removeClass('fixxed bottom scroll');
						}
					} else {
						var feedBottom = feedTop + $('#timeline-content').outerHeight();
						if (scrollTop >= feedBottom-winH && scrollTop < feedTop-menuH) {
							$('#timeline-content').addClass('scroll');
						} else {
							$('#timeline-content').removeClass('scroll');
						}
					}
				}
			},
			layout = function() {
				winW = $(window).width();
				winH = $(window).height();
				footerH = $footer.outerHeight(true);
				baseFontSize = parseInt($body.css('font-size'), 10);
				menuTallH = 8*baseFontSize;
				menuShortH = 4*baseFontSize;
				menuH = menuFlex ? menuTallH : menuShortH;
				submenuH = $('.submenu').outerHeight();
				
				// Stack fixed elements
				$('.fix').each(function(i,el){
					var $el = $(el),
						$prev = $('.fix').eq(Math.max(1,i)-1);
					$el.data('offsetTop', $el.offset().top);
					$el.data('top', i==0 ? menuShortH : menuShortH+$prev.outerHeight());
				});
				
				$wrap.css('padding-bottom', footerH);
				
				// When viewport (window) is resized over the 1000px breakpoint our layout changes drastically (tiled <—> tabbed)
				if ((winW<=1000 && !is_narrow) || (winW>1000 && is_narrow)) {
					if (is_project || is_dashboard || is_investor || is_manager) {
						reLayoutMaps(true);
						if (winW>1000 && is_narrow && $('.side .tab-content.current').length) {
							// we've just resized from narrow to wide and location hash is deep-linking to
							// something in the sidebar so we need to change that to point something in the main column
							location.href = $('#tabs a').length ? $('#tabs a').eq(0).attr('href') : '#';
						}
					}
				}
				
				if (is_home) {
					$('#slideshow').height(function(){
						return $(this).find('>div').outerHeight();
					});
				}
				
				// We want juxtaposed projects in listings to be the same height (so we adjust the heights of variable summaries)
				if (is_projects || is_home)
					juxtaposeProjects();
				
				// Assign known heights to dropdown submenus so their height could be animated from/to 0
				submenuHeights();
				
				sizeMenu();
				
				is_narrow = winW<=1000 ? true : false;
			}



		$window
			.on('resize', function(e){
				layout();
				connectionMasonry();
				drawCharts();
				layoutSideFeed();
				drawRise();
			})
			.on('scroll', function(e){
				sizeMenu();
				callNag();
				fix();
				fixSideFeed(e);
			})
			.on('click.nag', function(e){
				callNag();
			})
			.on('load', function(){
				layout();
				connectionMasonry();
				drawCharts();
				for (map_handle in Ips.Flock.gmaps) {
					// map_handle -> gmaps[map_handle]
					init_map(map_handle, Ips.Flock.gmaps);
				}
				layoutSideFeed();
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
				e.preventDefault();
				
				var $el = $(this),
					$switch_group = $el.closest('.switch-group'),
					switch_name = $el.attr('href'),
					$switchTo = $(switch_name+'-content');
				
				if ($switchTo.length && !$switchTo.hasClass('main-switch-current')) {
					$switch_group.find('.main-switch').removeClass('main-switch-current');
					$switchTo.addClass('main-switch-current');
					reLayoutMaps();
					layoutSideFeed();
				}
			});
		
		$('.side-switch .tabs a')
			.on('click', function(e){
				e.preventDefault();
				var $el = $(this),
					$switch_group = $el.closest('.switch-group'),
					switch_name = $el.attr('href'),
					$switchTo = $(switch_name+'-content');
				
				if ($switchTo.length && !$switchTo.hasClass('side-switch-current')) {
					$switch_group.find('.side-switch').removeClass('side-switch-current');
					$switchTo.addClass('side-switch-current');
					if ($switchTo.find('.connections').length) {
						connectionMasonry();
					}
					layoutSideFeed();
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
			
		$('#mini-bio')
			.css('overflow', 'hidden')
			.autoGrow();
		
		$('a.show-all-connections')
			.fancybox($.extend({}, fancyboxOpts, {
				stretchToView: true,
				maxWidth: 1000
			}));
		
		$(document)
			.on('click', '.fancybox-inner', function(e){
				if ($(this).find('#all-connections').length) {
					$.fancybox.close();
				}
			});

		$('#all-connections >div')
			.on('click', function(e){
				//if (!$(e.target).hasClass('fancybox-close')) {
					e.stopPropagation();
				//}
			});
	
	
	
	
		/*	 Timeline functionality
		—————————————————————————————————————————————————————————————————————————————————————— */
		Ips.Flock.Timeline = function(element, options) {
		
			var $this = $(element),
				_o = $.extend({}, {
					'start': 0,
					'size': 10,
					'type': null,
					'animDur': 10,
					'manager': null,
					'investor': null,
					'success': function(){}
				}, options);
			
			$this.data('start', _o.start);
			
			return {
			
				load: function(options) {
					__o = $.extend({}, {
						'start': _o.start,
						'size': _o.size,
						'type': _o.type,
						'success': _o.success
					}, options);
					
					var jqxhr = $
						.post('inc/timeline.php', {
							'start': __o.start,
							'size': __o.size,
							'type': __o.type,
							'manager': _o.manager,
							'investor': _o.investor
						}, function(response) {
						
							var i = 0,
								insertItem = function(data, index, end) {
									
									var item = data[i];
									
									$li = $('<li>')
										.attr('id', 'timeline-item-'+index)
										.html('\
											<div class="profile-badge '+item.author.type+'-badge">\
												<div>\
													<a href="?p='+item.author.type+'&amp;i='+item.author.handle+'" title="'+item.author.name+'"><img src="img/'+item.author.handle+'.png"></a>\
													<div class="focus"></div>\
												</div>\
											</div>\
											<div class="entry">\
												<h6 class="entry-title">'+item.title+'</h6>\
												<div class="entry-meta">'+
													(item.hasOwnProperty('connections') ? (function(connections){
														var connection_badges = '';
														for (j=0; j<connections.length; j++) {
															connection_badges += '<div class="profile-badge">\
																<div>\
																	<a href="?p='+connections[j].type+'&i='+connections[j].handle+'" title="'+connections[j].name+'"><img src="img/'+connections[j].handle+'.png"></a>\
																	<div class="focus"></div>\
																</div>\
															</div>';
														}
														return connection_badges;
													})(item.connections) : '')+
													'<time>2 days, 7hours ago</time>\
												</div>\
											</div>')
										.css('opacity', 0)
										.appendTo($this)
										.animate({
											'opacity': 1
										}, _o.animDur, function(){
											if (index<(end-1)) {
												insertItem(data, index+1, end);
											} else {
												__o.success();
											}
										});
									
									$this.data('start', index+1);
									i++;
								}
							
							insertItem(response.data, __o.start, (__o.start+response.data.length));
							
						}, 'json')
						.error(function(response) {
							console.log(response.responseText);
						});
					
				}
				
			}
			
		};
		$.fn.flocktimeline = function(options) {
			return $.fn.encapsulatedPlugin('flocktimeline', Ips.Flock.Timeline, this, options);
		}
		
		$('ul.feed')
			.flocktimeline({
				'type': (is_project ? 'project' : (is_investor||is_dashboard) ? 'investor' : 'manager'),
				'investor': window.investor || null,
				'manager': window.manager || null
			})
			.load();
		
		/*$('#timeline-content')
			.preventParentScroll();*/
		
		$('a.load-feed')
			.on('click', function(e){
				e.preventDefault();
				
				var $feed = $( $(this).data('feed') );
				
				if (!$feed.length) return;
				
				var start = $feed.data('start') || 0;
				$feed.flocktimeline().load({
					'start': start,
					'success': function() {
						if (winW>1000) {
							$feed.parent().animate({
								scrollTop: $('#timeline-item-'+start).offset().top + $feed.parent().scrollTop() - $feed.parent().offset().top - 12
							}, 300);
							$('html, body').animate({
								scrollTop: $feed.parent().offset().top + $('html, body').scrollTop() - menuShortH
							}, 300);
						} else {
							$('html, body').animate({
								scrollTop: (is_dashboard ? -$('#tabs').outerHeight() : 0) + $('#timeline-item-'+start).offset().top + $('html, body').scrollTop() - menuShortH - (1.5*17)
							}, 300);
						}
					}
				});
			});
		
	
	
	
	
		/*	 File upload UIs
		—————————————————————————————————————————————————————————————————————————————————————— */
		$('#doc-upload, #profile-pic-upload')
			.each(function(i, el) {
			var id = $(el).attr('id') || null;
			if (id) {
				$(el).fileupload({
					// data type for callback response
					   dataType: 'json',
					progressall: function (e, response) {
						var progress = parseInt(response.loaded / response.total * 100, 10);
						$('#'+id+'-progress .progress').width(progress+'%');
					},
					   done: function(e, response) {
						   $('#'+id+'-progress .progress').width('100%');
					   	$('#'+id+'-progress').removeClass('error');
						   $('#'+id+'-response').removeClass('error').text('Done!').show();
					   },
					   fail: function(e, response) {
					   	$('#'+id+'-progress').addClass('error');
						   $('#'+id+'-response').addClass('error').text('Failed!').show();
					   },
					   send: function(e, data) {
						$('#'+id+'-progress').removeClass('error').show();
						$('#'+id+'-response').hide();
					   }
				   });
			}
		 });
	
	
	
	
		/*	 Illustrative chart-line in the footer
		—————————————————————————————————————————————————————————————————————————————————————— */
		var riseCanvas = document.getElementById('riseCanvas'),
			drawRise = function() {
				
				if (!do_drawRaise) return;
				
				var w = winW,
					h = Math.round((winW<470 ? (7*.6) : winW<700 ? (7*.8) : 7) * baseFontSize),
					poly = [
						  -10,	  -10,
						  -10, .55*h,
						.05*w,	 .5*h,
					   .275*w, .66*h,
			 			.50*w, .33*h,
			 			.725*w, .28*h,
			 			 .95*w,	 .1*h,
						 w+10, .09*h,
						 w+10,	  -10
					],
					spacing = 0,
					dots = [
						[ .05*w,  .5*h+spacing],
						[.275*w, .66*h+spacing],
						[ .50*w, .33*h+spacing],
						[.725*w, .28*h+spacing],
						[ .95*w,  .1*h+spacing]
					],
					riseColor = (is_settings && $('#settings').hasClass('general')) ? 'hsl(0, 0%, 96%)' : 'white';
					strokeW = 0,
					strokeColor = 'hsl(200, 80%, 45%)',	 // #1791cf = @azureBlue
					drawDots = true,
					dotRadius = 2,
					dotStrokeW = 4,
					dotStrokeColor = 'hsla(200, 80%, 45%, .35)',
					eyeColor = riseColor
					drawShadow = true;
				
				
				//	resize our canvas to fit viewport width
				$(riseCanvas).attr({
					'width': w,
					'height': h
				});
				
				
				//	get canvas 2D context and clear it for re-drawing
				var ctx = riseCanvas.getContext('2d');
				ctx.clearRect( 0, 0, w, h );
				
				
				// drawing our first polygon — filled white
				ctx.beginPath();
				ctx.moveTo(poly[0], poly[1]);
				for(i=2; i<poly.length-1; i+=2)	ctx.lineTo(poly[i] , poly[i+1]);
				ctx.closePath();
				ctx.fillStyle = riseColor;
				ctx.fill();
				
				
				/*	Set the composition mode to 'destination-out' which subtracts the next shapes from the previous
					see more: https://developer.mozilla.org/samples/canvas-tutorial/6_1_canvas_composite.html */
				if (drawDots) {
					ctx.globalCompositeOperation = 'destination-out';
					
					// Draw the shapes you want to cut out
					ctx.fillStyle = '#f00'; // any color
					ctx.beginPath();
					for (i=0; i<dots.length; i++) {
						ctx.arc(
							dots[i][0],	// center X
							dots[i][1],	// center Y
							dotRadius+spacing-.5, // radius
							0,
							2*Math.PI
						);
					}
					ctx.closePath();
					ctx.fill();
				}
				
				
				if (drawShadow) {
					//	Set composition mode to 'destination-over' to draw underneath
					ctx.globalCompositeOperation = 'destination-over';
					
					//	Let's draw another black polygon shape with shadow to go below everything
					ctx.beginPath();
					ctx.moveTo(poly[0], poly[1]);
					for(i=2; i < poly.length-1 ; i+=2) ctx.lineTo(poly[i], poly[i+1]);
					ctx.closePath();
					ctx.fillStyle = 'hsla(0, 0%, 0%, .85)';
					ctx.shadowColor = 'hsla(0, 0%, 0%, .85)';
					ctx.shadowBlur = 40;
					ctx.fill();
				}
				
				
				// Set comp mode back to default
				ctx.globalCompositeOperation = 'source-over';
				ctx.shadowBlur = 0; // reset shadow
				
				
				// Shift our polygon down by {spacing}
				for(i=1; i<poly.length; i+=2) poly[i] = poly[i]+spacing;
				
				if (strokeW) {
					//	Draw the blue-stroked polygon
					ctx.beginPath();
					ctx.moveTo(poly[0], poly[1]);
					for(i=2; i < poly.length-1 ; i+=2)
						ctx.lineTo( poly[i] , poly[i+1] )
					ctx.closePath();
					ctx.strokeStyle = strokeColor;
					ctx.lineWidth = strokeW;
					ctx.stroke();
				}
				
				if (drawDots) {
					if (dotStrokeW) {
						//	Draw the wider dots (stroke color)
						ctx.fillStyle = dotStrokeColor;
						ctx.beginPath();
						for (i=0; i<dots.length; i++) {
							ctx.arc(
								dots[i][0],	// center X
								dots[i][1],	// center Y
								dotRadius+dotStrokeW, // radius
								0,
								2*Math.PI
							);
						}
						ctx.closePath();
						ctx.fill();
					}
					
					
					//	Draw white dots over blue ones
					ctx.fillStyle = eyeColor;
					ctx.shadowColor = 'hsla(0, 0%, 0%, .4)';
					ctx.shadowBlur = Math.max(dotStrokeW*2, 10);
					ctx.beginPath();
					for (i=0; i<dots.length; i++) {
						ctx.arc(
							dots[i][0],	// center X
							dots[i][1],	// center Y
							dotRadius,	// radius
							0,
							2*Math.PI
						);
					}
					ctx.closePath();
					ctx.fill();
				}
				
			};
		drawRise();
	
	
	
	
		/*	 Maps
		—————————————————————————————————————————————————————————————————————————————————————— */
		var initiated_gmaps = {},
			poiMarker = hst+'/g/map_icon_s.svg'; // hst+'/g/map_icon@x2.png';
			init_map = function(map_handle, maps) {
				
				if (typeof map_handle==='undefined' || typeof maps==='undefined' || !maps.hasOwnProperty(map_handle))
					return false;
			
				var map_canvas = document.getElementById(map_handle+'_map_canvas');
			
				if (!map_canvas)
					return false;
				
				var map_addresses = maps[map_handle],
					iniZoom = 12,
					iniCenter;
			
				// Create a new StyledMapType object, passing it the array of styles, as well as the name to be displayed on the map type control.
				var styledMap = new google.maps.StyledMapType(_o.gmap_style, {name: 'Map'}),
					styledMapID = 'flockStyledMap',
					mTCO = {
						mapTypeIds: [
							styledMapID,
							//google.maps.MapTypeId.ROADMAP,
							google.maps.MapTypeId.TERRAIN,
							google.maps.MapTypeId.SATELLITE,
							google.maps.MapTypeId.HYBRID
						],
						position: map_handle=='project' ? google.maps.ControlPosition.TOP_RIGHT : google.maps.ControlPosition.RIGHT_BOTTOM
					};
				
				// Create a map object, and include the MapTypeId to add to the map type control.
				var mapOptions = {
					zoom: iniZoom,
					minZoom: 2,
					scrollwheel: false,
					draggable: true,
					
					disableDefaultUI: map_handle=='project' ? false : true,
					mapTypeControlOptions: map_handle=='project' ? mTCO : false,
					
					backgroundColor: 'transparent'
				};
				
				// Create the map entity
				var this_map = new google.maps.Map(map_canvas, mapOptions);
			
				// Define marker-image for location pins
				var icon = {
					url: poiMarker,
					size: null,
					origin: null,
					anchor: new google.maps.Point(9, 26),
					scaledSize: new google.maps.Size(31, 26)
				};
				
				// Create an info-bubble which we're gonna re-use for each POI onClick
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
						scrollwheel: false,
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
					
					// in case of only one POI the map is naturally zoomed to the max, let's pull back to iniZoom
					zoomChangeBoundsListener = google.maps.event.addListenerOnce(this_map, 'bounds_changed', function(event) {
						if (this_map.getZoom()>iniZoom) {
							this_map.setZoom(iniZoom);
						}
						this_map.setCenter(iniCenter);
						initiated_gmaps[map_handle].iniZoom = this_map.getZoom();
					});
					
				} else {
					iniCenter = new google.maps.LatLng(map_addresses[0]['lat'], map_addresses[0]['lng']);
					this_map.setCenter(iniCenter);
				}
				
				// Associate the styled map with the MapTypeId.
				this_map.mapTypes.set(styledMapID, styledMap);
				this_map.setMapTypeId(styledMapID);
				
				initiated_gmaps[map_handle] = {
					iniCenter: iniCenter,
					iniZoom: this_map.getZoom(),
					map: this_map,
					map_canvas: map_canvas,
					mTCO: mTCO,
					open: false,
					reLayed: false
				};
			}
			reLayoutMaps = function(resizing) {
				resizing = typeof resizing=='undefined' ? false : true;
				for (map_handle in initiated_gmaps) {
					if (initiated_gmaps.hasOwnProperty(map_handle)) {
					
						if (	   !initiated_gmaps[map_handle].reLayed  &&   $(initiated_gmaps[map_handle].map_canvas).is(':visible')  ||
								    initiated_gmaps[map_handle].reLayed  &&   $(initiated_gmaps[map_handle].map_canvas).is(':visible')  &&  resizing) {
						
							// map_handle -> initiated_gmaps[map_handle]
							var map = initiated_gmaps[map_handle].map,
								center = initiated_gmaps[map_handle].iniCenter || map.getCenter(),
								zoom = initiated_gmaps[map_handle].iniZoom || map.getZoom();
							google.maps.event.trigger(map, 'resize');
							map.setZoom( zoom );
							map.setCenter( center );
							initiated_gmaps[map_handle].reLayed = true;
							
						} else if ( initiated_gmaps[map_handle].reLayed  &&  !$(initiated_gmaps[map_handle].map_canvas).is(':visible')  &&  resizing) {
							
							initiated_gmaps[map_handle].reLayed = false;
							reLayoutMaps();
							
						}
						
					}
				}
			};
		
		$('.map-toolbar-one, .map-toolbar-two button')
			.on('click', function(){
				var $map_view = $(this).closest('.map-view'),
					$map_canvas = $map_view.find('.map-canvas'),
					map_handle = $map_canvas.attr('id').replace('_map_canvas', ''),
					mTCO = initiated_gmaps[map_handle].mTCO,
					open = initiated_gmaps[map_handle].open;
				$map_view.toggleClass('tucked');
				if (typeof map_handle !== 'undefined' && map_handle && $.inArray(map_handle, initiated_gmaps)) {
					initiated_gmaps[map_handle].map
						.setOptions({
							disableDefaultUI: open,
							mapTypeControlOptions: (open ? false : mTCO)
						});
					initiated_gmaps[map_handle].open = !open;
				}
				setTimeout(function(){
					layoutSideFeed();
				}, 300);
			});
	
	
	
	
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
				$.each(Ips.Flock.graphs, function(g, options) {
					var $canvas = $('#'+g+'-canvas');
					if ($canvas.length && $canvas.is(':visible')) {
						var canvasW = $canvas.attr('width'),
							canvasH = $canvas.attr('height'),
							minH = minW = g=='performance' ? 200 : 100,
							maxH = g=='performance' ? 200 : 200,
							maxW = g=='performance' ? 1200 : 200;
						
						$('.graph-canvas').hide();
						var parentW = $canvas.parent().width();
						$('.graph-canvas').show();
						$canvas.prop({
							width: Math.min(maxW, Math.max(minW, parentW + (g=='performance' ? 30 : 0))),
							height: Math.min(maxH, Math.max(minH, parentW*canvasH/canvasW))
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
		/*  ÷———————————————————÷  N E W  ÷———————————————————÷  */
			Ips.Flock.Chart = function(element, options) {
			
				var $this = $(element),
					_o = $.extend({}, {
						'type': null,
						'selector': null,
						'xAxisFormat': ',f',
						'yAxisFormat': ',.1f',
						'animDur': 500,
						'data': exampleData()
					}, options),
					chart;
				
					
				function exampleData() {
					// see custom-helpers.js
					return stream_layers(2, 10+Math.random()*100, .1).map(function(data, i) {
						return {
							key: 'Stream ' + i,
							values: data
						};
					});
				}
				
				
				if (_o.type && $this.length) {
					
					nv.addGraph(function() {
						
						switch (_o.type) {
							case 'stacked-bar':
								chart = nv.models.multiBarChart();
								
								chart.margin({
									top: 0, right: 0, bottom:70, left: 40 // margins are indeed for axis units
								});
								chart.multibar.stacked(true); // reverse default state: we want stacked bars not grouped bars
								chart.showControls(false); // discard stacked/grouped toggle switch
								 
								//chart.xAxis.tickFormat(d3.format(_o.yAxisFormat));
								chart.xAxis.tickFormat(d3.time.format("%B '%y"));
							
								//chart.yAxis.tickFormat(d3.format(_o.yAxisFormat));
								chart.yAxis.tickFormat(function (d) {
									if (d==0) {
										return '';
									}
									if ((d / 1000) >= 1) {
										d = d / 1000 + "k";
									}
									return d;
								});
								
								
								chart.xAxis.tickPadding(17);
								chart.yAxis.highlightZero(false);
								chart.yAxis.showMaxMin(false);
								chart.reduceXTicks(false);
								chart.rotateLabels(-30);
								
								break;
							
							default:
								return;
								break;
						}
						
						var svg = $('<svg> </svg>')
							.appendTo($this)
							.attr({
								'xmlns': "http://www.w3.org/2000/svg",
								'width': "100%",
								'height': "100%",
								'preserveAspectRatio': "xMinYMin meet"
							});
							
						d3.select(_o.selector+' svg')
							.datum(_o.data)
							.transition().duration(_o.animDur).call(chart);
					
						nv.utils.windowResize(chart.update);
					
						return chart;
						
					});
					
				}
				
				return {
					update: function() {
						if (typeof chart == 'function')
							chart.update();
					}
				}
			
			}
			$.fn.flockchart = function(options) {
				return $.fn.encapsulatedPlugin('flockchart', Ips.Flock.Chart, this, options);
			}
		var updateCharts = function() {
				for (chart_handle in Ips.Flock.charts) {
					if (typeof Ips.Flock.charts[chart_handle] == 'object' && Ips.Flock.charts[chart_handle].hasOwnProperty('selector')) {
						$(Ips.Flock.charts[chart_handle].selector).flockchart().update();
					}
				}
				drawCharts(); // TODO deprecated
			}
			for (chart_handle in Ips.Flock.charts) {
				if (typeof Ips.Flock.charts[chart_handle] == 'object' && Ips.Flock.charts[chart_handle].hasOwnProperty('selector')) {
					$(Ips.Flock.charts[chart_handle].selector).flockchart(Ips.Flock.charts[chart_handle]);
				}
			}
			
	
	
	
		/*	 Fold the main menu when when viewport is too narrow
		—————————————————————————————————————————————————————————————————————————————————————— */
		$('#spread')
			.on('click', function(e){
				var spread = $masthead.hasClass('spreaded') ? false : true;
				if (!spread) {
					$masthead.scrollTop(0).addClass('animating');
					setTimeout(function(){$masthead.removeClass('animating')}, 300);
					$('body').css('overflow','auto');
				} else {
					$('body').css('overflow','hidden');
				}
				$masthead.toggleClass('spreaded').height(function(){
					var navH = $masthead.find('nav').outerHeight(true);
					
					mastHeadH = menuFlex ? (spread ? menuH+navH : menuH) : (spread ? ((3+(navH/baseFontSize))*1.1)+'rem' : '3rem'); //TODO: +2.6 ????
					
					return	mastHeadH;
				});
			});
	
	
	
		/*	 Shrink the main menu then scrolling down / bloat when scrolling to top
		—————————————————————————————————————————————————————————————————————————————————————— */
		var menuTimeout,
			sizeMenu = function() {
				if (menuFlex) {
					var scrollTop = $(window).scrollTop(),
						autohide = scrollTop > menuTallH ? true : false;
					
					if (   scrollTop <= Math.max(0, $('#intro').height()-menuTallH)	  ) {
						// don't contract the menu yet
						menuH = menuTallH;
						document.getElementById('masthead').style.height = '';
						document.getElementById('nav').style.marginTop = '';
						document.getElementById('spread').style.marginTop = '';
						$('#masthead').removeClass('mini');
						$('#intro').css('visibility', 'visible');
					
					} else if (	  scrollTop>=Math.max(Math.abs($('#intro').height()-menuShortH),0)	 ) {
						// don't contract the menu any further
						menuH = menuShortH;
						document.getElementById('masthead').style.height = '';
						document.getElementById('nav').style.marginTop = '';
						document.getElementById('spread').style.marginTop = '';
						$('#masthead').addClass('mini');
						$('#intro').css('visibility', 'hidden');
					
					} else {
						//menuH = menuTallH - (scrollTop - (Math.abs($('#intro').height()-menuTallH)));
						  menuH = menuTallH - scrollTop + Math.max(0, ($('#intro').height()-menuTallH));
						//menuH = $('#intro').height() - scrollTop;
						document.getElementById('masthead').style.height = menuH+'px';
						document.getElementById('nav').style.marginTop = ((menuH-menuShortH)/2)+'px';
						document.getElementById('spread').style.marginTop = ((menuH-menuShortH)/2)+'px';
						$('#masthead').removeClass('mini');
						$('#intro').css('visibility', 'visible');
					
					}
				}
			};
	
	
	
	
		/*	Annoy/destroy the sign in/sign up nag
			* we need need the timeout since browsers auto-scroll the page when you
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
				nag = !auth; // true = nag ON, false = nag OFF
			}, 1000);
			$nag.find('.close').on('click', function(e){
			$nag.fadeOut(200, function(){
				$nag.remove();
			});
		});
	
	
	
	
		/*	 Sign-in modal
		—————————————————————————————————————————————————————————————————————————————————————— */
		$('a.sign-in.sign-up, a.sign-in.forgotten')
			.fancybox($.extend({}, fancyboxOpts, {
				width: 700
			}));
	
		$('a.sign-in.log-in')
			.fancybox(fancyboxOpts);
		
		
		
		
		$('.fancybox-video')
			.fancybox($.extend({}, fancyboxOpts, {
			beforeLoad : function() {			
				this.width	= parseInt(this.element.data('width'));	
				this.height = parseInt(this.element.data('height'));
			}
		}));
	
	
	
		layout();
		
		$window.trigger( 'hashchange' );
		
	}
	
	$.fn.flock = function(options) {
		return $.fn.encapsulatedPlugin('flock', Ips.Flock.Init, this, options);
	}
	
	$(document).flock({
		gmap_style: [
			{
				"stylers": [
					{ "saturation": -40 },
					{ "hue": "#ffaa00" }
				]
			},{
				"featureType": "road",
				"elementType": "geometry",
				"stylers": [
					{ "visibility": "simplified" },
					{ "lightness": 100 }
				]
			},{
				"featureType": "road",
				"elementType": "labels",
				"stylers": [
					{ "visibility": "on" },
					{ "weight": 0.3 },
					//{ "gamma": .1 },
					{ "saturation": -60 }
				]
			},{
				"featureType": "poi.park",
				"elementType": "geometry",
				"stylers": [
					{ "color": "#cadfaa" },
					{ "saturation": -40 },
					{ "lightness": 20 }
				]
			},{
				"featureType": "landscape.natural",
				"stylers": [
					{ "color": "#9cdfaa" },
					{ "saturation": -75 }
				]
			},{
				"featureType": "water",
				"elementType": "geometry",
				"stylers": [
					{ "color": "#a6cade" },
					{ "saturation": -60 },
					{ "lightness": -20 },
					{ "visibility": "simplified" }
				]
			},{
				"featureType": "transit.line",
				"stylers": [
					{ "saturation": -100 },
					{ "lightness": 20 }
				]
			},{
				"featureType": "water",
				"elementType": "labels",
				"stylers": [
					{ "saturation": -100 }
				]
			}
		]
	});
	
});
