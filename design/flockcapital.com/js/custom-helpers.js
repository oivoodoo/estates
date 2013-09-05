/*	stackoverflow.com/a/10559271
—————————————————————————————————————————————————————————————————————————————————————— */
jQuery.fn.hasAnyClass = function() {
	for (var i = 0; i < arguments.length; i++) {
		if (this.hasClass(arguments[i])) {
			return true;
		}
	}
	return false;
}



/*	stackoverflow.com/a/2587356
—————————————————————————————————————————————————————————————————————————————————————— */
jQuery.fn.cleanWhitespace = function() {
	textNodes = this.contents().filter(function() {
		return (this.nodeType == 3 && !/\S/.test(this.nodeValue));
	}).remove();
	return this;
}



/*	Auto-growing textareas; technique ripped from Facebook
	http://github.com/jaz303/jquery-grab-bag/tree/master/javascripts/jquery.autogrow-textarea.js
—————————————————————————————————————————————————————————————————————————————————————— */
jQuery.fn.autoGrow = function(options) {
	return this.filter('textarea').each(function() {
		var self		 = this;
		var $self		 = $(self);
		var minHeight	 = $self.height();
		var noFlickerPad = 0; //$self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;

		var shadow = $('<div></div>').css({
			position:	 'absolute',
			top:		 -10000,
			left:		 -10000,
			width:		 $self.width(),
			fontSize:	 $self.css('fontSize'),
			fontFamily:	 $self.css('fontFamily'),
			fontWeight:	 $self.css('fontWeight'),
			lineHeight:	 $self.css('lineHeight'),
			resize:		 'none',
			'word-wrap': 'break-word'
		}).appendTo(document.body);

		var update = function(event) {
			var times = function(string, number) {
				for (var i=0, r=''; i<number; i++) r += string;
				return r;
			};

			var val = self.value.replace(/</g, '&lt;')
								.replace(/>/g, '&gt;')
								.replace(/&/g, '&amp;')
								.replace(/\n$/, '<br/>&nbsp;')
								.replace(/\n/g, '<br/>')
								.replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });

			// Did enter get pressed?  Resize in this keydown event so that the flicker doesn't occur.
			if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
				val += '<br />';
			}

			shadow.css('width', $self.width());
			shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
			$self.height(Math.max(shadow.height() + noFlickerPad, minHeight));
		}

		$self.change(update).keyup(update).keydown({event:'keydown'},update);
		$(window).resize(update);

		update();
	});
};



/*	http://stackoverflow.com/a/16324762
	http://jsfiddle.net/TroyAlford/4wrxq/1
—————————————————————————————————————————————————————————————————————————————————————— */
jQuery.fn.preventParentScroll = function() {
	return this.each(function() {
		$(this)
			.addClass('start')
			.on('DOMMouseScroll mousewheel', function(ev) {
			    var $this = $(this),
			    	is_scrollable = $this.css('overflow')!='hidden';
			    
			    if (!is_scrollable)
			    	return;
			    
			    var scrollTop = this.scrollTop,
			        scrollHeight = this.scrollHeight,
			        height = $this.height(),
			        delta = ev.originalEvent.wheelDelta,
			        up = delta > 0;
			
			    var prevent = function() {
			        ev.stopPropagation();
			        ev.preventDefault();
			        ev.returnValue = false;
			        return false;
			    }
			    
			    if (!up && -delta > scrollHeight - height - scrollTop) {
			        // Scrolling down, but this will take us past the bottom.
			        $this.removeClass('start').scrollTop(scrollHeight);
			        return prevent();
			    } else if (up && delta > scrollTop) {
			        // Scrolling up, but this will take us past the top.
			        $this.addClass('start').scrollTop(0);
			        return prevent();
			    } else {
			        $this.removeClass('start');
			    }
		    });
    });
};



/*	stackoverflow.com/a/12806373
—————————————————————————————————————————————————————————————————————————————————————— */
Number.prototype.between = function (min, max) {
	return this >= min && this <= max;
};





/*	NVD3 test data generators
—————————————————————————————————————————————————————————————————————————————————————— */
/* Inspired by Lee Byron's test data generator. */
function stream_layers(n, m, o) {
  if (arguments.length < 3) o = 0;
  function bump(a) {
    var x = 1 / (.1 + Math.random()),
        y = 2 * Math.random() - .5,
        z = 10 / (.1 + Math.random());
    for (var i = 0; i < m; i++) {
      var w = (i / m - y) * z;
      a[i] += x * Math.exp(-w * w);
    }
  }
  return d3.range(n).map(function() {
      var a = [], i;
      for (i = 0; i < m; i++) a[i] = o + o * Math.random();
      for (i = 0; i < 5; i++) bump(a);
      return a.map(stream_index);
    });
}
/* Another layer generator using gamma distributions. */
function stream_waves(n, m) {
  return d3.range(n).map(function(i) {
    return d3.range(m).map(function(j) {
        var x = 20 * j / m - i / 3;
        return 2 * x * Math.exp(-.5 * x);
      }).map(stream_index);
    });
}
function stream_index(d, i) {
  return {x: i, y: Math.max(0, d)};
}