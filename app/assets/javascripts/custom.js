jQuery(document).ready(function($) {


	var winW,
		winH,
		menuTallH,
		menuShortH,
		baseFontSize = parseInt($('body').css('font-size'), 10),
		menuFlex = /*$('body').hasAnyClass('home') ? true : */false, ///stackoverflow.com/a/10559271
		menuH,
		footerH,
		$body = $('body'),
		$masthead = $('#masthead'),
		$wrap = $('#wrap'),
		$footer = $wrap.find('>footer'),
		$nag = $('#nag'),
		is_project = $body.hasClass('project'),
		connectionMasonry = function(){
			connectionH = $('.connections li').eq(0).height();
			$('.connections li:gt(0)').each(function(i,el){
				var $li = $(el);
				$li.height(connectionH);
				$li.find('.plate').css('text-align', '');
			});
			$('.connections li').css('visibility','visible');
			
			/*
			var $connections = $('.connections'),
				colW = (winW<1500 && winW>=1000) ? 3 : ((winW<=1000) ? 6.66667 : 4 );
			$connections.isotope({
				layoutMode: 'masonry',
				resizable: false, // disable normal resizing
				masonry: {
					columnWidth: $connections.width() / colW
				}
			});*/
		},
		connectionH,
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
		}
		layout = function() {
			winW = $(window).width();
			winH = $(window).height();
			footerH = $footer.outerHeight(true);
			/*if (winW>=700 && winW<=1000) {
				menuTallH = 1.25*(8*baseFontSize);
				menuShortH = (3*baseFontSize);
			} else {
				menuTallH = (8*baseFontSize);
				menuShortH = (3*baseFontSize);
			}*/
			baseFontSize = parseInt($body.css('font-size'), 10);
			menuTallH = 8*baseFontSize;
			menuShortH = 3*baseFontSize;
			
			$wrap.css('padding-bottom', footerH);
			
			if (is_project) {
				$('#tabspace').height($('#tabs').height());
				$('.cover img').css('margin-left', (winW<700 ? Math.min(0, ($('.cover').width()-$('.cover img').width())/2 ) : 0));
			}
			
			submenuHeights();
			
			/*if (winW>1000) $('#project .primary').insertAfter('#project .side');
			else $('#project .side').insertAfter('#project .primary');*/
			
			/*var minIntroH = parseInt($('#intro').css('min-height'), 10);
			console.log(minIntroH);
			if (winW/2 <= minIntroH) $('#intro img').addClass('crop').css('margin', '0 '+((winW-(minIntroH*2))/2)+'px');
			else	 $('#intro img').removeClass('crop').css('margin', -(($('#intro img').height()-minIntroH)/2)+'px 0');*/
			
			//sizeMenu();
		}

	$(window)
		.on('resize', function(e){
			//$('#screen-width span').text($(window).width());
			layout();
			connectionMasonry();
		})
		.on('scroll', function(e){
			//sizeMenu();
			//autohideMenu(e);
			callNag();
		})
		.on('click.nag', function(e){
			callNag();
		})
		.on('load', function(){
			layout();
			connectionMasonry();
		});
	
	$(document).on('mouseenter', '#masthead li', function(e){
    submenuHeights();
    var $submenu = $(this).find('ul');
    if ($submenu.length) {
      $submenu.height( $submenu.data('height') );
    }
  });
	$(document).on('mouseleave', '#masthead li', function(e){
    submenuHeights();
    var $submenu = $(this).find('ul');
    if ($submenu.length) {
      $submenu.outerHeight( 0 );
    }
  });

	/*$('.connections .plate')
		.each(function(i,el){
			var $plate = $(el),
				height = 0;
			$plate.find('>div >*').each(function(i,el){
				height+= $(el).outerHeight(true);
			});
			height+= parseInt($plate.find('>div').css('padding-top'), 10);
			height+= parseInt($plate.find('>div').css('padding-bottom'), 10);
			$plate.data('height', height);
		});
	$('.connections li')
		.on('mouseenter', function(e){
			$('.connections li').not(this).addClass('faded');
			$plate = $(this).find('.plate')
			if ($plate.length) {
				$plate.height( $plate.data('height') );
			}
		})
		.on('mouseleave', function(e){
			$('.connections li').not(this).removeClass('faded');
			$plate = $(this).find('.plate')
			if ($plate.length) {
				$plate.height( 0 );
			}
		});*/
	
	/*$('#dashboard a.activity')
		.on('mouseenter', function(e) {	
			var $el = $(this),  
				$clone = $el.clone(true);
			$el.before($clone).remove();
		});*/
	
	/*$('.tabs-contents').height($(this).find('.tab-content').eq(0).outerHeight(true));
	$('.tabs li a')
		.on('click', function(){
			var $tab = $(this),
				$tabs = $tab.closest('.tabs'),
				index = $tabs.find('li a').index($tab);
				tabs_id = $tabs.attr('id'),
				$tabs_contents = $('#'+tabs_id+'-contents');
			
			if ($tabs_contents.length && index!=-1) {
				$tabs_contents.find('.tab-content').not(':eq('+index+')').stop().fadeOut(200, function(){
					setTimeout(function(){
						var $tab_content = $tabs_contents.find('.tab-content').eq(index);
						$('.tabs-contents').height($tab_content.outerHeight(true));
						$tab_content.fadeIn(200);
					}, 100);
				});
				$tabs.find('li a').not(this).removeClass('current');
				$tab.addClass('current');
			}
		});*/
		
	$('.project-badge .profile-badge')
		.on('mouseenter', function(e){
			$(this).closest('.project-badge').find('.project-thumb .focus').addClass('overridehide');
		})
		.on('mouseleave', function(e){
			$(this).closest('.project-badge').find('.project-thumb .focus').removeClass('overridehide');
		});
		
	$('.tabs ul')
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



	/*	 Expand/contract the main menu when it doesn't fit
	———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
	$('#expand').on('click', function(e){
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
				mini = scrollTop > menuTallH-menuShortH ? true : false,
				autohide = scrollTop > menuTallH ? true : false;
				
			menuH = mini ? menuShortH : scrollTop<=0 ? menuTallH : menuTallH-scrollTop;
			
			document.getElementById('masthead').style.height = menuH+'px';
			$masthead.toggleClass('mini', mini);
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
		nag = true;
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
			  closeBtn: false/*,
			stretchToView: true,
			modal: true,
			afterShow: function() {
				$wrap.css('visibility', 'hidden');
			},
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

$.fn.cleanWhitespace = function() {
	///stackoverflow.com/a/2587356
	textNodes = this.contents().filter(function() {
		return (this.nodeType == 3 && !/\S/.test(this.nodeValue));
	}).remove();
	return this;
}
