window.graphs = {};

var winW,
  menuShortH,
  submenuH,
  menuH,
  footerH,
  baseFontSize = parseInt($('body').css('font-size'), 10),
  hst = window.location.protocol +'//'+ window.location.host;

  window.$window = $(window);

window.load = function() {
  window.$body = $('body');
  window.$masthead = $('#masthead');
  window.$wrap = $('#wrap');
  window.$footer = $wrap.find('>footer');
  is_home = $body.hasClass('home');
  is_project = $body.hasClass('project');
  is_dashboard = $body.hasClass('dashboard');

	$('.fix')
		.each(function(i,el){
			var $el = $(el);
			$el.data('fixedclone', $el.clone().removeClass('fix').addClass('fixed'));
			$el.data('fixedclone').data('original', $el);
			$el.data('fixedclone').find('ul').cleanWhitespace();
		});

	submenuHeights();

	$('.combobox')
		.combobox();

	layout();
};

$(document).ready(window.load);

$window.on('load', function(){
  layout();
  connectionMasonry();
});

$window.on('resize', function(e){
  layout();
  connectionMasonry();
}).on('scroll', function(e){
  sizeMenu();
  callNag();
  fixPos();
});


$('.sign-in, .profile-pic')
.fancybox({
  helpers:	 {
    overlay : {
      css : {
        'background' : 'rgba(41,41,41, .9)'
      }
    }
  },
  closeBtn: false,
  afterShow: function() {
    $('.ext-account-buttons').cleanWhitespace();
  }
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

window.layout = function() {
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

  if ($body.hasClass('project')) {
    if (winW > 1000 && $('.side .tab-content.current').length) {
      location.href = $('.main .tabs a, .tabs.major a').eq(0).attr('href');
    }
  }

  if ($body.hasClass('home')) {
    $('#slideshow').height(function(){
      return $(this).find('>div').outerHeight();
    });
  }

  submenuHeights();
  sizeMenu();
};

window.fixPos = function() {
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
          // AK changes
          $(document).trigger('fix:scroll', $el);
        }, 1);
      }
    } else {
      $el.removeClass('narrow').data('fixedclone').removeClass('narrow').detach();
      $el.data('fixed', false);
    }
  });
};


window.submenuHeights = function() {
  $('#masthead ul ul')
    .each(function(i,el){
      var $submenu = $(el),
        height = 0;
      $submenu.children().each(function(i,el){
        height+= $(el).outerHeight(true);
      });
      $submenu.data('height', height + (.5*baseFontSize));
    });
};

window.connectionMasonry = function(){
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
};

window.sizeMenu = function() {
  if ($('body').hasClass('home')) {
    var scrollTop = $(window).scrollTop(),
      autohide = scrollTop > menuTallH ? true : false;

    if (scrollTop <= Math.max(0, $('#intro').height()-menuTallH)   ) {
      // don't contract the menu yet
      document.getElementById('masthead').style.height = '';
      document.getElementById('nav').style.marginTop = '';
      document.getElementById('spread').style.marginTop = '';
      $('#masthead').removeClass('mini');
    } else if (   scrollTop>=Math.max(Math.abs($('#intro').height()-menuShortH),0)   ) {
      // don't contract the menu any further
      document.getElementById('masthead').style.height = '';
      document.getElementById('nav').style.marginTop = '';
      document.getElementById('spread').style.marginTop = '';
      $('#masthead').addClass('mini');
    } else {
      menuH = menuTallH - scrollTop + Math.max(0, ($('#intro').height()-menuTallH));
      document.getElementById('masthead').style.height = menuH+'px';
      document.getElementById('nav').style.marginTop = ((menuH-menuShortH)/2)+'px';
      document.getElementById('spread').style.marginTop = ((menuH-menuShortH)/2)+'px';
      $('#masthead').removeClass('mini');
    }
  }
};

window.nag = false;
window.callNag = function() {
  if (nag) {
    setTimeout(function() {
      $('#nag').css('visibility','visible').stop().animate({'opacity':1}, 700);
    }, 1000);
    $(window).off('click.nag');
    window.nag = false;
  }
};

setTimeout(function(){ // *
  window.nag = Settings.user.signed_in || false; // true = nag ON, false = nag OFF
}, 1000);

$(document).on('click', '#nag .close', function(e){
  $('#nag').fadeOut(200, function(){
    $('#nag').remove();
  });
});

$('.project-badge .project-name .profile-badge')
  .on('mouseenter', function(e){
    $(this).parent().find('.manager-location span a').addClass('active');
  })
  .on('mouseleave', function(e){
    $(this).parent().find('.manager-location span a').removeClass('active');
  });

$(document).on('mouseenter', '.project-badge .profile-badge, .project-badge .action button.follow, .project-badge .action button.tracking, .project-badge .action button.track, .project-badge .manager-location a', function() {
  $(this).closest('.project-badge').find('.project-thumb .focus, .action button.details').addClass('overridehide');
  $(this).closest('.project-badge.dash-tracking-list').find('.project-link').addClass('overridehide');
});

$(document).on('mouseleave', '.project-badge .profile-badge, .project-badge .action button.follow, .project-badge .action button.tracking, .project-badge .action button.track, .project-badge .manager-location a', function() {
  $(this).closest('.project-badge').find('.project-thumb .focus, .action button.details').removeClass('overridehide');
  $(this).closest('.project-badge.dash-tracking-list').find('.project-link').removeClass('overridehide');
});

$(document).on('click', '.nag', function(e){
  callNag();
})

$(document).on('click', '#spread', function() {
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

    return  mastHeadH;
  });
});

$(document).on('mouseenter', '#masthead li', function() {
  var $submenu = $(this).find('ul');
  if ($submenu.length) {
    $submenu.height( $submenu.data('height')-1 );
  }
});

$(document).on('mouseleave', '#masthead li', function() {
  var $submenu = $(this).find('ul');
  if ($submenu.length) {
    $submenu.outerHeight( 0 );
  }
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
    }
  );
};

