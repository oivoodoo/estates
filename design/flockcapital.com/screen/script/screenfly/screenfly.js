$(document).ready(function () {
    //$("#viewport").hide();
    $("#screen-sizes > li ul a").click(function (e) {
        e.preventDefault();
        var sizes = $(this).attr("href").replace("#", "");
        var w = parseInt(sizes.split("x")[0]);
        var h = parseInt(sizes.split("x")[1]);
        var newUa = sizes.split("x")[2];
        $("#screen-sizes li").removeClass("selected");
        $(this).parent().addClass("selected");
        $(this).parent().parent().parent().addClass("selected");
        $("#screen-sizes > li ul").hide();
        if ($("#use-proxy").parent().hasClass("selected")) {
            qtScreenFrame({
                reload: true,
                ua: newUa
            })
        }
        qtAnimateFrame({
            width: w,
            height: h
        })
    });
    $("#size-custom").click(function (e) {
        if (!$(this).hasClass("disabled")) {
            if (!$(this).find("ul").is(":visible")) {
                $("#custom-width").val($("#frame").width());
                $("#custom-height").val($("#frame").height());
                $("#custom-width").focus()
            }
        }
    });
    $("#custom-width,#custom-height").keyup(function (e) {
        if (e.keyCode == 13) {
            $("#size-custom-save").click()
        } else {
            if (e.keyCode == 27) {
                $("#size-custom").click()
            }
        }
    });
    $("#size-custom-save").click(function (e) {
        e.preventDefault();
        var w = parseInt($("#custom-width").val());
        if (w < 150 || isNaN(w)) {
            w = 150
        }
        if (w > 20000) {
            w = 20000
        }
        var h = parseInt($("#custom-height").val());
        if (h < 150 || isNaN(h)) {
            h = 150
        }
        if (h > 20000) {
            h = 20000
        }
        qtAnimateFrame({
            width: w,
            height: h
        });
        $("#screen-sizes li").removeClass("selected");
        $("#screen-sizes li.custom").addClass("selected")
    });
    $("#rotate").click(function (e) {
        e.preventDefault();
        $("#frame,#viewport,#viewport-body").stop(true, true);
        var oWidth = $("#frame").width();
        var oHeight = $("#frame").height();
        qtAnimateFrame({
            width: oHeight,
            height: oWidth
        })
    });
    $("#allow-scrolling").click(function (e) {
        e.preventDefault();
        if (!$(this).parent().hasClass("selected")) {
            createCookie("screenfly-scrolling", "1", 365);
            $(this).parent().addClass("selected");
            if ($("#viewport").is(":visible")) {
                qtScreenFrame({
                    reload: true
                })
            }
        } else {
            createCookie("screenfly-scrolling", "0", 365);
            $(this).parent().removeClass("selected");
            if ($("#viewport").is(":visible")) {
                qtScreenFrame({
                    reload: true
                })
            }
        }
    });
    if (readCookie("screenfly-scrolling") != null && readCookie("screenfly-scrolling") == "1") {
        $("#frame-tools li.scrolling").addClass("selected")
    }
    $("#use-proxy").click(function (e) {
        e.preventDefault();
        if (!$(this).parent().hasClass("selected")) {
            createCookie("screenfly-proxy", "1", 365);
            $(this).parent().addClass("selected");
            if ($("#viewport").is(":visible")) {
                qtScreenFrame({
                    reload: true
                })
            }
        } else {
            createCookie("screenfly-proxy", "0", 365);
            $(this).parent().removeClass("selected");
            if ($("#viewport").is(":visible")) {
                qtScreenFrame({
                    reload: true
                })
            }
        }
    });
    if (readCookie("screenfly-proxy") != null && readCookie("screenfly-proxy") == "1") {
        $("#frame-tools li.proxy").addClass("selected")
    }
    $("#siteurl").keyup(function (e) {
        if (e.keyCode == 13 && $(this).val() != "") {
            $("#go").click()
        }
    });
    $("#go").click(function (e) {
        e.preventDefault();
        if ($("#siteurl").val().trim() != "") {
            createCookie("screenfly-auth", "1");
            $("#screenfly-form").hide();
            $("#viewport").show();
            $("body").addClass("screenfly-frame");
            $(".requires-visible-frame").removeClass("disabled");
            qtScreenFrame({
                width: 1024,
                height: 600
            });
            $("#screen-sizes li").removeClass("selected");
            $("#screen-sizes li:first,#screen-sizes li:first ul li:first").addClass("selected")
        }
    });
    $("#change-url").click(function (e) {
        e.preventDefault();
        $("#viewport").hide();
        $("body").removeClass("screenfly-frame");
        $(".requires-visible-frame").addClass("disabled");
        $("#screenfly-form").show();
        $("#siteurl").focus()
    });
    qtShortcut("d", function () {
        $("#size-desktop").click()
    });
    qtShortcut("t", function () {
        $("#size-tablet").click()
    });
    qtShortcut("m", function () {
        $("#size-mobile").click()
    });
    qtShortcut("v", function () {
        $("#size-television").click()
    });
    qtShortcut("c", function () {
        $("#size-custom").click()
    });
    qtShortcut("r", function () {
        $("#rotate").click()
    });
    qtShortcut("s", function () {
        $("#allow-scrolling").click()
    });
    qtShortcut("p", function () {
        $("#use-proxy").click()
    });
    qtScreenflyFixed();
    screenRulers()
});

function qtScreenFrame(settings) {
    if (settings.reload) {
        settings.width = $("#frame").width();
        settings.height = $("#frame").height()
    }
    var frameUrl = $("#siteurl").val().trim();
    $("#frame").remove();
    /*if (frameUrl.substring(0, 7) != "http://" && frameUrl.substring(0, 8) != "https://" && frameUrl.substring(0, 7) != "file://") {
        frameUrl = "http://" + frameUrl
    }
    if (frameUrl.substring(0, 31) == "http://quirktools.com/screenfly" || frameUrl.substring(0, 35) == "http://www.quirktools.com/screenfly") {
        frameUrl = "http://quirktools.com/screenfly/paradox/"
    }*/
    $("#viewport-url a").text(frameUrl).attr("title", frameUrl);
    $("#viewport-size").text(settings.width + " x " + settings.height);
    var frame = $('<iframe id="frame" />');
    if (!$("#allow-scrolling").parent().hasClass("selected")) {
        $(frame).attr("scrolling", "no")
    }
    if ($("#use-proxy").parent().hasClass("selected")) {
        if (frameUrl.substring(0, 8) == "https://") {
            $(".info-pop").remove();
            $("#page").prepend('<div class="info-pop" style="display: none;">Sorry! The proxy cannot be used with HTTPS. Switching to no-proxy mode&hellip;</div>');
            $(".info-pop").click(function () {
                $(this).slideUp(250, function () {
                    $(this).remove()
                })
            });
            $(".info-pop").slideDown(250);
            $("#use-proxy").parent().removeClass("selected");
            createCookie("screenfly-proxy", "0", 365)
        } else {
            frameUrl = "http://quirktools.com/screenfly/get/?url=" + escape(frameUrl)
        }
    }
    if ($("#use-proxy").parent().hasClass("selected") && settings.ua != null) {
        frameUrl = frameUrl + "&ua=" + settings.ua
    } else {
        if ($("#use-proxy").parent().hasClass("selected") && $("#screen-sizes > li.selected > ul > li.selected > a").size() > 0) {
            frameUrl = frameUrl + "&ua=" + $("#screen-sizes > li.selected > ul > li.selected > a").attr("href").replace("#", "").split("x")[2]
        }
    }
    $(frame).attr("src", frameUrl).width(settings.width).height(settings.height);
    $(frame).load(function () {
        $(this).css("background-image", "none")
    });
    $("#viewport-body").append(frame);
    $("#viewport").width(settings.width);
    $("#viewport-body").height(settings.height)
}
function qtAnimateFrame(settings) {
    if (settings.width != null && settings.height != null) {
        $("#frame,#viewport,#viewport-body").stop(true, true);
        $("#frame").animate({
            width: settings.width,
            height: settings.height
        }, 500);
        $("#viewport").animate({
            width: settings.width
        }, 500);
        $("#viewport-body").animate({
            height: settings.height
        }, 500);
        $("#viewport-size").text(settings.width + " x " + settings.height)
    }
}
$(window).resize(function () {
    qtScreenflyFixed();
    screenRulers()
});

function qtScreenflyFixed() {
    var qtFormMargin = ($(window).height() / 2).toFixed(0) - 200;
    if (qtFormMargin < 125) {
        qtFormMargin = 125
    }
    $("#screenfly-form").css("padding-top", qtFormMargin + "px")
}
function screenRulers() {
    $("#ruler .label").text($(window).width() + " x " + $(window).height())
};