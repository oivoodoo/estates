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

window.load = function() {
  var winW,
  winH,
  menuTallH,
  menuShortH,
  baseFontSize = parseInt($('body').css('font-size'), 10),
  menuH,
  footerH,
  $window = $(window),
  $body = $('body');

  window.$masthead = $('#masthead');

  var $wrap = $('#wrap'),
  $footer = $wrap.find('>footer');

  window.$nag = $('#nag');

  var is_home = $body.hasClass('home'),
  is_project = $body.hasClass('project'),
  is_investor = $body.hasClass('investor'),
  menuFlex = $body.hasAnyClass('home') ? true : false;

  window.connectionMasonry = function(){
    connectionH = $('.connections li').eq(0).height();
    $('.connections li:gt(0)').each(function(i,el){
      var $li = $(el);
      $li.height(connectionH);
      $li.find('.plate').css('text-align', '');
    });
    $('.connections li').css('visibility','visible');
  };

  var connectionH,
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
  };

  window.fixPos = function() {
    var scrollTop = $window.scrollTop();
    $('.fix').each(function(i,el){
      var $el = $(el);

      if (scrollTop+menuShortH > $el.data('offsetTop')) {
        if (!$el.data('fixed')) {
          $el.addClass('narrow').data('fixedclone').insertBefore($el);
          $el.data('fixed', true);
          setTimeout(function(){
            $el.data('fixedclone').addClass('narrow');
            // AK changes
            $(document).trigger('fix:scroll', $el);
          }, 10);
        }
      } else {
        $el.removeClass('narrow').data('fixedclone').removeClass('narrow').detach();
        $el.data('fixed', false);
      }
    });
  };

  window.layout = function() {
    winW = $(window).width();
    winH = $(window).height();
    footerH = $footer.outerHeight(true);
    baseFontSize = parseInt($body.css('font-size'), 10);
    menuTallH = 8*baseFontSize;
    menuShortH = 4*baseFontSize;
    $('.fix').each(function(i,el){
      $(el).data('offsetTop', $(el).offset().top);
    });

    $wrap.css('padding-bottom', footerH);

    submenuHeights();

    sizeMenu();
  };

  $('.fix')
  .each(function(i,el){
    var $el = $(el);
    $el.data('fixedclone', $el.clone().removeClass('fix').addClass('fixed'));
    $el.data('fixedclone').find('ul').cleanWhitespace();
  });

  submenuHeights();

	$('#masthead nav ul, .tabs ul, .submenu ul, #intro .action, .financials >div >div >div, .ext-account-buttons')
		.cleanWhitespace();

  $('.combobox').combobox();

  var menuTimeout;
  window.sizeMenu = function() {
    if ($('body').hasAnyClass('home')) {
      var scrollTop = $(window).scrollTop(),

      autohide = scrollTop > menuTallH ? true : false;

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
    }
  };
};

window.load();
$(document).ready(window.load);


$(document).on('mouseenter', '#masthead li', function(e){
  var $submenu = $(this).find('ul');
  if ($submenu.length) {
    $submenu.height( $submenu.data('height')-1 );
  }
});
$(document).on('mouseleave', '#masthead li', function(e){
  var $submenu = $(this).find('ul');
  if ($submenu.length) {
    $submenu.outerHeight( 0 );
  }
});

$(document).on('mouseenter', '.project-badge .profile-badge', function(e){
  $(this).closest('.project-badge').find('.project-thumb .focus').addClass('overridehide');
});
$(document).on('mouseleave', '.project-badge .profile-badge', function(e){
  $(this).closest('.project-badge').find('.project-thumb .focus').removeClass('overridehide');
});

$(document).on('keydown', '#password-old', function(){
  $(this).prop('type', 'password');
});
$(document).on('blur', '#password-old', function(){
  if ($(this).val()=='') $(this).prop('type', 'text');
});

$(document).on('click', 'label.radio', function(){
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


/*	 Expand/contract the main menu when it doesn't fit
     ———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
$(document).on('click', '#expand', function(e) {
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

    return  mastHeadH;
  });
});

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

$(document).on('click', '#nag .close', function(e){
  $nag.fadeOut(200, function(){
    $nag.remove();
  });
});

$(document).on('mouseenter', 'button.following', function() {
  $(this).text('Stop following');
});

$(document).on('mouseleave', 'button.following', function() {
  $(this).text('Following');
});

/*	 Sign-in modal
     ———————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————————— */
$('.sign-in, .sign-up, .profile-pic')
.fancybox({
  helpers:	 {
    overlay : {
      css : {
        'background' : 'rgba(41,41,41, .9)'
      }
    }
  },
  closeBtn: false
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

