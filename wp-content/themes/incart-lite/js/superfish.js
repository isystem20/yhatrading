/*
 * jQuery Superfish Menu Plugin - v1.7.4
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */
(function(e) {
    "use strict";
    var t = function() {
        var t = {
            bcClass: "sf-breadcrumb",
            menuClass: "sf-js-enabled",
            anchorClass: "sf-with-ul",
            menuArrowClass: "sf-arrows"
        }, n = function() {
                var t = /iPhone|iPad|iPod/i.test(navigator.userAgent);
                if (t) {
                    e(window).load(function() {
                        e("body").children().on("click", e.noop)
                    })
                }
                return t
            }(),
            r = function() {
                var e = document.documentElement.style;
                return "behavior" in e && "fill" in e && /iemobile/i.test(navigator.userAgent)
            }(),
            i = function(e, n) {
                var r = t.menuClass;
                if (n.cssArrows) {
                    r += " " + t.menuArrowClass
                }
                e.toggleClass(r)
            }, s = function(n, r) {
                return n.find("li." + r.pathClass).slice(0, r.pathLevels).addClass(r.hoverClass + " " + t.bcClass).filter(function() {
                    return e(this).children(r.popUpSelector).hide().show().length
                }).removeClass(r.pathClass)
            }, o = function(e) {
                e.children("a").toggleClass(t.anchorClass)
            }, u = function(e) {
                var t = e.css("ms-touch-action");
                t = t === "pan-y" ? "auto" : "pan-y";
                e.css("ms-touch-action", t)
            }, a = function(t, i) {
                var s = "li:has(" + i.popUpSelector + ")";
                if (e.fn.hoverIntent && !i.disableHI) {
                    t.hoverIntent(l, c, s)
                } else {
                    t.on("mouseenter.superfish", s, l).on("mouseleave.superfish", s, c)
                }
                var o = "MSPointerDown.superfish";
                if (!n) {
                    o += " touchend.superfish"
                }
                if (r) {
                    o += " mousedown.superfish"
                }
                t.on("focusin.superfish", "li", l).on("focusout.superfish", "li", c).on(o, "a", i, f)
            }, f = function(t) {
                var n = e(this),
                    r = n.siblings(t.data.popUpSelector);
                if (r.length > 0 && r.is(":hidden")) {
                    n.one("click.superfish", false);
                    if (t.type === "MSPointerDown") {
                        n.trigger("focus")
                    } else {
                        e.proxy(l, n.parent("li"))()
                    }
                }
            }, l = function() {
                var t = e(this),
                    n = d(t);
                clearTimeout(n.sfTimer);
                t.siblings().superfish("hide").end().superfish("show")
            }, c = function() {
                var t = e(this),
                    r = d(t);
                if (n) {
                    e.proxy(h, t, r)()
                } else {
                    clearTimeout(r.sfTimer);
                    r.sfTimer = setTimeout(e.proxy(h, t, r), r.delay)
                }
            }, h = function(t) {
                t.retainPath = e.inArray(this[0], t.$path) > -1;
                this.superfish("hide");
                if (!this.parents("." + t.hoverClass).length) {
                    t.onIdle.call(p(this));
                    if (t.$path.length) {
                        e.proxy(l, t.$path)()
                    }
                }
            }, p = function(e) {
                return e.closest("." + t.menuClass)
            }, d = function(e) {
                return p(e).data("sf-options")
            };
        return {
            hide: function(t) {
                if (this.length) {
                    var n = this,
                        r = d(n);
                    if (!r) {
                        return this
                    }
                    var i = r.retainPath === true ? r.$path : "",
                        s = n.find("li." + r.hoverClass).add(this).not(i).removeClass(r.hoverClass).children(r.popUpSelector),
                        o = r.speedOut;
                    if (t) {
                        s.show();
                        o = 0
                    }
                    r.retainPath = false;
                    r.onBeforeHide.call(s);
                    s.stop(true, true).animate(r.animationOut, o, function() {
                        var t = e(this);
                        r.onHide.call(t)
                    })
                }
                return this
            },
            show: function() {
                var e = d(this);
                if (!e) {
                    return this
                }
                var t = this.addClass(e.hoverClass),
                    n = t.children(e.popUpSelector);
                e.onBeforeShow.call(n);
                n.stop(true, true).animate(e.animation, e.speed, function() {
                    e.onShow.call(n)
                });
                return this
            },
            destroy: function() {
                return this.each(function() {
                    var n = e(this),
                        r = n.data("sf-options"),
                        s;
                    if (!r) {
                        return false
                    }
                    s = n.find(r.popUpSelector).parent("li");
                    clearTimeout(r.sfTimer);
                    i(n, r);
                    o(s);
                    u(n);
                    n.off(".superfish").off(".hoverIntent");
                    s.children(r.popUpSelector).attr("style", function(e, t) {
                        return t.replace(/display[^;]+;?/g, "")
                    });
                    r.$path.removeClass(r.hoverClass + " " + t.bcClass).addClass(r.pathClass);
                    n.find("." + r.hoverClass).removeClass(r.hoverClass);
                    r.onDestroy.call(n);
                    n.removeData("sf-options")
                })
            },
            init: function(n) {
                return this.each(function() {
                    var r = e(this);
                    if (r.data("sf-options")) {
                        return false
                    }
                    var f = e.extend({}, e.fn.superfish.defaults, n),
                        l = r.find(f.popUpSelector).parent("li");
                    f.$path = s(r, f);
                    r.data("sf-options", f);
                    i(r, f);
                    o(l);
                    u(r);
                    a(r, f);
                    l.not("." + t.bcClass).superfish("hide", true);
                    f.onInit.call(this)
                })
            }
        }
    }();
    e.fn.superfish = function(n, r) {
        if (t[n]) {
            return t[n].apply(this, Array.prototype.slice.call(arguments, 1))
        } else if (typeof n === "object" || !n) {
            return t.init.apply(this, arguments)
        } else {
            return e.error("Method " + n + " does not exist on jQuery.fn.superfish")
        }
    };
    e.fn.superfish.defaults = {
        popUpSelector: "ul,.sf-mega",
        hoverClass: "sfHover",
        pathClass: "overrideThisToUse",
        pathLevels: 1,
        delay: 800,
        animation: {
            opacity: "show"
        },
        animationOut: {
            opacity: "hide"
        },
        speed: "normal",
        speedOut: "fast",
        cssArrows: true,
        disableHI: false,
        onInit: e.noop,
        onBeforeShow: e.noop,
        onShow: e.noop,
        onBeforeHide: e.noop,
        onHide: e.noop,
        onIdle: e.noop,
        onDestroy: e.noop
    };
    e.fn.extend({
        hideSuperfishUl: t.hide,
        showSuperfishUl: t.show
    })
})(jQuery)
