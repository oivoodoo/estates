$(document).ready(function(){qtToolbars();qtSidebar();$(window).resize(function(){qtToolbarSize()});qtToolbarSize()});function qtToolbars(){$(".toolbar-group > li > a").click(function(e){e.preventDefault();if(!$(this).hasClass("disabled")){$(".toolbar-group > li > a").removeClass("menu-open");if($(this).siblings("ul:hidden").size()>0){$(this).addClass("menu-open");$(".toolbar-group > li > ul").hide();var childMenu=$(this).siblings("ul:hidden");$(childMenu).show()}else{if($(this).siblings("ul:visible").size()>0){$(this).removeClass("menu-open");$(".toolbar-group > li > ul").hide()}}}});qtUnclick(".toolbar *",function(){qtHideToolbarMenus()});$(".document-list > a").click(function(e){e.preventDefault();if($(this).next(":hidden").size()>0){$(".document-list > ul,.document-list > div").hide();$(this).next(":hidden").show()}else{$(".document-list > ul,.document-list > div").hide()}});qtUnclick(".document-list *",function(){$(".document-list > ul,.document-list > div").hide()})}function qtHideToolbarMenus(){$(".toolbar-group > li ul").hide();$(".toolbar-group > li > a").removeClass("menu-open")}function qtSidebar(){$("#sidebar-toggle").click(function(e){e.preventDefault();$("#sidebar,#sidebar-toggle").stop(true,true);if(parseInt($("#sidebar").css("right"))<0){createCookie("sidebar_open","1",365);$("#sidebar").show();$("#sidebar,#sidebar-toggle").animate({right:"+=300"},150);$("#workspace").css("padding-right","330px")}else{createCookie("sidebar_open","0",365);$("#sidebar,#sidebar-toggle").animate({right:"-=300"},150,function(){$("#sidebar").hide()});$("#workspace").css("padding-right","30px")}});if((readCookie("sidebar_open")!=null&&readCookie("sidebar_open")=="0")||$(window).width()<=600){createCookie("sidebar_open","0",365);$("#sidebar").css("right","-300px").hide();$("#sidebar-toggle").css("right","0px");$("#workspace").css("padding-right","30px")}}function qtToolbarSize(){$(".toolbar-group > li > ul, .document-list ul").css("max-height",((window.innerHeight?window.innerHeight:$(window).height())-100)+"px");if($("body").hasClass("fixed-toolbar")){$("#sidebar-container").css("height",((window.innerHeight?window.innerHeight:$(window).height())-100)+"px");$("#sidebar-container > div").css("height",((window.innerHeight?window.innerHeight:$(window).height())-146)+"px")}else{$("#sidebar-container").css("height",((window.innerHeight?window.innerHeight:$(window).height())-50)+"px");$("#sidebar-container > div").css("height",((window.innerHeight?window.innerHeight:$(window).height())-96)+"px")}};