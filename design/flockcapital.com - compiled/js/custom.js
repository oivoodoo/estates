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
		$window = $(window),
		$body = $('body'),
		$masthead = $('#masthead'),
		$wrap = $('#wrap'),
		$footer = $wrap.find('>footer'),
		$nag = $('#nag'),
		is_home = $body.hasClass('home'),
		is_project = $body.hasClass('project'),
		is_investor = $body.hasClass('investor'),
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
			if (is_project) {
				var first_tab_href = $('.main .tabs a, .tabs.major a').eq(0).attr('href'),
					tab = window.location.hash || first_tab_href.substring(first_tab_href.indexOf("#")),
					$tab = $(tab+'-tab'),
					$other_tabs = $tab.closest('ul').find('a').not($tab),
					$tab_content = $(tab+'-content'),
					$other_tab_contents = $('.tab-content').not($tab_content),
					$other_main_tab_contents = $('.main .tab-content').not($tab_content);
				
				//if ($tab_content.length) {
					if (winW > 1000) {
						if (!$tab_content.hasClass('side-tab-content')) {
							$other_main_tab_contents.removeClass('current');
							$tab_content.addClass('current');
							$other_tabs.removeClass('current');
							$tab.addClass('current');
						}
					} else {
						$other_tab_contents.removeClass('current');
						$tab_content.addClass('current');
						connectionMasonry();
						$other_tabs.removeClass('current');
						$tab.addClass('current');
					}
				//}
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
			
			submenuHeights();
			
			sizeMenu();
		}

	$window
		.on('resize', function(e){
			layout();
			connectionMasonry();
		})
		.on('scroll', function(e){
			sizeMenu();
			//autohideMenu(e);
			callNag();
			fixPos();
		})
		.on('click.nag', function(e){
			callNag();
		})
		.on('load', function(){
			layout();
			connectionMasonry();
		})
		.on('hashchange', function(e){
			hashChange(e);
		});
		
	$('.fix')
		.each(function(i,el){
			var $el = $(el);
			$el.data('fixedclone', $el.clone().removeClass('fix').addClass('fixed'));
			$el.data('fixedclone').find('ul').cleanWhitespace();
		});
	
	$('.side-switch .tabs a')
		.on('click', function(e){
			var $el = $(this),
				switch_name = $el.attr('href').substring(1);
			
			if (!$el.hasClass('current')) {
				$('.side-switch').removeClass('side-current');
				$('#'+switch_name+'-content').addClass('side-current');
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
	
	$('.project-badge .profile-badge, .project-badge .action button.follow, .project-badge .action button.following, .project-badge .manager-location a')
		.on('mouseenter', function(e){
			$(this).closest('.project-badge').find('.project-thumb .focus, .action button.details').addClass('overridehide');
		})
		.on('mouseleave', function(e){
			$(this).closest('.project-badge').find('.project-thumb .focus, .action button.details').removeClass('overridehide');
		});
	
	$('button.following')
		.on('mouseenter', function(e){
			$(this).text('Stop following');
		})
		.on('mouseleave', function(e){
			$(this).text('Following');
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



	/*	 Expand/contract the main menu when it doesn't fit
	———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
	$('#expand')
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




	/*	 Size the menu tall/short
	———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
	var
	menuTimeout,
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
	}
	/*,
	autohideMenu = function(e) {
		var show = !$masthead.hasClass('mini') || ($masthead.hasClass('mini') && (e.clientY < menuShortH || e.type == 'scroll')) ? true : false;
		
		if (show) {
			clearTimeout(menuTimeout);
			$masthead.css({'pointer-events': 'auto', 'opacity': 1});
		} else {
			menuTimeout = setTimeout(function(){
				$masthead.css({'opacity': 0, 'pointer-events': 'none'});
			}, 1500);
		}
	}
	window.addEventListener('touchmove', sizeMenu, false);
	window.addEventListener('ongesturechange', sizeMenu, false);
	$masthead.on('mouseenter mousemove', function(){
		sizeMenu();
	});
	$(document).on('mousemove', function(e){
		//autohideMenu(e);
	});*/




	/*	 Annoy/destroy the sign in/sign up nag
		
		1) we need need the timeout since browsers auto-scroll the page when you navigate back/fwd and we want the nag to be invoked by manual scroll only
	———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
	var
	nag = false,
	callNag = function() {
		if (nag) {
			setTimeout(function() {
				$nag.css('visibility','visible').stop().animate({'opacity':1}, 700);
			}, 1000);
			$(window).off('click.nag');
			nag = false;
		}
	}
	
	setTimeout(function(){ // 1)
		nag = true; // true = nag ON / false = nag OFF
	}, 1000);
	
	$nag.find('.close').on('click', function(e){
		$nag.fadeOut(200, function(){
			$nag.remove();
		});
	});




	/*	 Sign-in modal
	———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
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



