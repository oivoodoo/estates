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

			if (is_project) $('#tabspace').height($('#tabs').height());

			/*if (winW>1000) $('#project .primary').insertAfter('#project .side');
			else $('#project .side').insertAfter('#project .primary');*/

			/*var minIntroH = parseInt($('#intro').css('min-height'), 10);
			console.log(minIntroH);
			if (winW/2 <= minIntroH) $('#intro img').addClass('crop').css('margin', '0 '+((winW-(minIntroH*2))/2)+'px');
			else  $('#intro img').removeClass('crop').css('margin', -(($('#intro img').height()-minIntroH)/2)+'px 0');*/

			sizeMenu();
		}

	$(window)
		.on('resize', function(e){
			//$('#screen-width span').text($(window).width());
			layout();
		})
		.on('scroll', function(e){
			sizeMenu();
			//autohideMenu(e);
			callNag();
		})
		.on('click.nag', function(e){
			callNag();
		});

	$(document)
		.on('load', function(){
			layout();
		});




	/*  Expand/contract the main menu when it doesn't fit
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
			console.log(baseFontSize, navH);

			return  mastHeadH;
		});
	});




	/*  Size the menu tall/short
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

