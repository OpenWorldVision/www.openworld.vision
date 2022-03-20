/**
 *
 * Color picker
 * Author: Stefan Petre www.eyecon.ro
 * 
 * Dual licensed under the MIT and GPL licenses
 * 
 */
(function ($) {
    var ColorPicker = function () {
        var
            ids = {},
            inAction,
            charMin = 65,
            visible,
            tpl = '<div class="colorpicker"><div class="colorpicker_color"><div><div></div></div></div><div class="colorpicker_hue"><div></div></div><div class="colorpicker_new_color"></div><div class="colorpicker_current_color"></div><div class="colorpicker_hex"><input type="text" maxlength="6" size="6" /></div><div class="colorpicker_rgb_r colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_g colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_rgb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_h colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_s colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_hsb_b colorpicker_field"><input type="text" maxlength="3" size="3" /><span></span></div><div class="colorpicker_submit"></div></div>',
            defaults = {
                eventName: 'click',
                onShow: function () {},
                onBeforeShow: function(){},
                onHide: function () {},
                onChange: function () {},
                onSubmit: function () {},
                color: 'ff0000',
                livePreview: true,
                flat: false
            },
            fillRGBFields = function  (hsb, cal) {
                var rgb = HSBToRGB(hsb);
                $(cal).data('colorpicker').fields
                    .eq(1).val(rgb.r).end()
                    .eq(2).val(rgb.g).end()
                    .eq(3).val(rgb.b).end();
            },
            fillHSBFields = function  (hsb, cal) {
                $(cal).data('colorpicker').fields
                    .eq(4).val(hsb.h).end()
                    .eq(5).val(hsb.s).end()
                    .eq(6).val(hsb.b).end();
            },
            fillHexFields = function (hsb, cal) {
                $(cal).data('colorpicker').fields
                    .eq(0).val(HSBToHex(hsb)).end();
            },
            setSelector = function (hsb, cal) {
                $(cal).data('colorpicker').selector.css('backgroundColor', '#' + HSBToHex({h: hsb.h, s: 100, b: 100}));
                $(cal).data('colorpicker').selectorIndic.css({
                    left: parseInt(150 * hsb.s/100, 10),
                    top: parseInt(150 * (100-hsb.b)/100, 10)
                });
            },
            setHue = function (hsb, cal) {
                $(cal).data('colorpicker').hue.css('top', parseInt(150 - 150 * hsb.h/360, 10));
            },
            setCurrentColor = function (hsb, cal) {
                $(cal).data('colorpicker').currentColor.css('backgroundColor', '#' + HSBToHex(hsb));
            },
            setNewColor = function (hsb, cal) {
                $(cal).data('colorpicker').newColor.css('backgroundColor', '#' + HSBToHex(hsb));
            },
            keyDown = function (ev) {
                var pressedKey = ev.charCode || ev.keyCode || -1;
                if ((pressedKey > charMin && pressedKey <= 90) || pressedKey == 32) {
                    return false;
                }
                var cal = $(this).parent().parent();
                if (cal.data('colorpicker').livePreview === true) {
                    change.apply(this);
                }
            },
            change = function (ev) {
                var cal = $(this).parent().parent(), col;
                if (this.parentNode.className.indexOf('_hex') > 0) {
                    cal.data('colorpicker').color = col = HexToHSB(fixHex(this.value));
                } else if (this.parentNode.className.indexOf('_hsb') > 0) {
                    cal.data('colorpicker').color = col = fixHSB({
                        h: parseInt(cal.data('colorpicker').fields.eq(4).val(), 10),
                        s: parseInt(cal.data('colorpicker').fields.eq(5).val(), 10),
                        b: parseInt(cal.data('colorpicker').fields.eq(6).val(), 10)
                    });
                } else {
                    cal.data('colorpicker').color = col = RGBToHSB(fixRGB({
                        r: parseInt(cal.data('colorpicker').fields.eq(1).val(), 10),
                        g: parseInt(cal.data('colorpicker').fields.eq(2).val(), 10),
                        b: parseInt(cal.data('colorpicker').fields.eq(3).val(), 10)
                    }));
                }
                if (ev) {
                    fillRGBFields(col, cal.get(0));
                    fillHexFields(col, cal.get(0));
                    fillHSBFields(col, cal.get(0));
                }
                setSelector(col, cal.get(0));
                setHue(col, cal.get(0));
                setNewColor(col, cal.get(0));
                cal.data('colorpicker').onChange.apply(cal, [col, HSBToHex(col), HSBToRGB(col)]);
            },
            blur = function (ev) {
                var cal = $(this).parent().parent();
                cal.data('colorpicker').fields.parent().removeClass('colorpicker_focus');
            },
            focus = function () {
                charMin = this.parentNode.className.indexOf('_hex') > 0 ? 70 : 65;
                $(this).parent().parent().data('colorpicker').fields.parent().removeClass('colorpicker_focus');
                $(this).parent().addClass('colorpicker_focus');
            },
            downIncrement = function (ev) {
                var field = $(this).parent().find('input').focus();
                var current = {
                    el: $(this).parent().addClass('colorpicker_slider'),
                    max: this.parentNode.className.indexOf('_hsb_h') > 0 ? 360 : (this.parentNode.className.indexOf('_hsb') > 0 ? 100 : 255),
                    y: ev.pageY,
                    field: field,
                    val: parseInt(field.val(), 10),
                    preview: $(this).parent().parent().data('colorpicker').livePreview                  
                };
                $(document).bind('mouseup', current, upIncrement);
                $(document).bind('mousemove', current, moveIncrement);
            },
            moveIncrement = function (ev) {
                ev.data.field.val(Math.max(0, Math.min(ev.data.max, parseInt(ev.data.val + ev.pageY - ev.data.y, 10))));
                if (ev.data.preview) {
                    change.apply(ev.data.field.get(0), [true]);
                }
                return false;
            },
            upIncrement = function (ev) {
                change.apply(ev.data.field.get(0), [true]);
                ev.data.el.removeClass('colorpicker_slider').find('input').focus();
                $(document).unbind('mouseup', upIncrement);
                $(document).unbind('mousemove', moveIncrement);
                return false;
            },
            downHue = function (ev) {
                var current = {
                    cal: $(this).parent(),
                    y: $(this).offset().top
                };
                current.preview = current.cal.data('colorpicker').livePreview;
                $(document).bind('mouseup', current, upHue);
                $(document).bind('mousemove', current, moveHue);
            },
            moveHue = function (ev) {
                change.apply(
                    ev.data.cal.data('colorpicker')
                        .fields
                        .eq(4)
                        .val(parseInt(360*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.y))))/150, 10))
                        .get(0),
                    [ev.data.preview]
                );
                return false;
            },
            upHue = function (ev) {
                fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                $(document).unbind('mouseup', upHue);
                $(document).unbind('mousemove', moveHue);
                return false;
            },
            downSelector = function (ev) {
                var current = {
                    cal: $(this).parent(),
                    pos: $(this).offset()
                };
                current.preview = current.cal.data('colorpicker').livePreview;
                $(document).bind('mouseup', current, upSelector);
                $(document).bind('mousemove', current, moveSelector);
            },
            moveSelector = function (ev) {
                change.apply(
                    ev.data.cal.data('colorpicker')
                        .fields
                        .eq(6)
                        .val(parseInt(100*(150 - Math.max(0,Math.min(150,(ev.pageY - ev.data.pos.top))))/150, 10))
                        .end()
                        .eq(5)
                        .val(parseInt(100*(Math.max(0,Math.min(150,(ev.pageX - ev.data.pos.left))))/150, 10))
                        .get(0),
                    [ev.data.preview]
                );
                return false;
            },
            upSelector = function (ev) {
                fillRGBFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                fillHexFields(ev.data.cal.data('colorpicker').color, ev.data.cal.get(0));
                $(document).unbind('mouseup', upSelector);
                $(document).unbind('mousemove', moveSelector);
                return false;
            },
            enterSubmit = function (ev) {
                $(this).addClass('colorpicker_focus');
            },
            leaveSubmit = function (ev) {
                $(this).removeClass('colorpicker_focus');
            },
            clickSubmit = function (ev) {
                var cal = $(this).parent();
                var col = cal.data('colorpicker').color;
                cal.data('colorpicker').origColor = col;
                setCurrentColor(col, cal.get(0));
                cal.data('colorpicker').onSubmit(col, HSBToHex(col), HSBToRGB(col), cal.data('colorpicker').el);
            },
            show = function (ev) {
                var cal = $('#' + $(this).data('colorpickerId'));
                cal.data('colorpicker').onBeforeShow.apply(this, [cal.get(0)]);
                var pos = $(this).offset();
                var viewPort = getViewport();
                var top = pos.top + this.offsetHeight;
                var left = pos.left;
                if (top + 176 > viewPort.t + viewPort.h) {
                    top -= this.offsetHeight + 176;
                }
                if (left + 356 > viewPort.l + viewPort.w) {
                    left -= 356;
                }
                cal.css({left: left + 'px', top: top + 'px'});
                if (cal.data('colorpicker').onShow.apply(this, [cal.get(0)]) != false) {
                    cal.show();
                }
                $(document).bind('mousedown', {cal: cal}, hide);
                return false;
            },
            hide = function (ev) {
                if (!isChildOf(ev.data.cal.get(0), ev.target, ev.data.cal.get(0))) {
                    if (ev.data.cal.data('colorpicker').onHide.apply(this, [ev.data.cal.get(0)]) != false) {
                        ev.data.cal.hide();
                    }
                    $(document).unbind('mousedown', hide);
                }
            },
            isChildOf = function(parentEl, el, container) {
                if (parentEl == el) {
                    return true;
                }
                if (parentEl.contains) {
                    return parentEl.contains(el);
                }
                if ( parentEl.compareDocumentPosition ) {
                    return !!(parentEl.compareDocumentPosition(el) & 16);
                }
                var prEl = el.parentNode;
                while(prEl && prEl != container) {
                    if (prEl == parentEl)
                        return true;
                    prEl = prEl.parentNode;
                }
                return false;
            },
            getViewport = function () {
                var m = document.compatMode == 'CSS1Compat';
                return {
                    l : window.pageXOffset || (m ? document.documentElement.scrollLeft : document.body.scrollLeft),
                    t : window.pageYOffset || (m ? document.documentElement.scrollTop : document.body.scrollTop),
                    w : window.innerWidth || (m ? document.documentElement.clientWidth : document.body.clientWidth),
                    h : window.innerHeight || (m ? document.documentElement.clientHeight : document.body.clientHeight)
                };
            },
            fixHSB = function (hsb) {
                return {
                    h: Math.min(360, Math.max(0, hsb.h)),
                    s: Math.min(100, Math.max(0, hsb.s)),
                    b: Math.min(100, Math.max(0, hsb.b))
                };
            }, 
            fixRGB = function (rgb) {
                return {
                    r: Math.min(255, Math.max(0, rgb.r)),
                    g: Math.min(255, Math.max(0, rgb.g)),
                    b: Math.min(255, Math.max(0, rgb.b))
                };
            },
            fixHex = function (hex) {
                var len = 6 - hex.length;
                if (len > 0) {
                    var o = [];
                    for (var i=0; i<len; i++) {
                        o.push('0');
                    }
                    o.push(hex);
                    hex = o.join('');
                }
                return hex;
            }, 
            HexToRGB = function (hex) {
                var hex = parseInt(((hex.indexOf('#') > -1) ? hex.substring(1) : hex), 16);
                return {r: hex >> 16, g: (hex & 0x00FF00) >> 8, b: (hex & 0x0000FF)};
            },
            HexToHSB = function (hex) {
                return RGBToHSB(HexToRGB(hex));
            },
            RGBToHSB = function (rgb) {
                var hsb = {
                    h: 0,
                    s: 0,
                    b: 0
                };
                var min = Math.min(rgb.r, rgb.g, rgb.b);
                var max = Math.max(rgb.r, rgb.g, rgb.b);
                var delta = max - min;
                hsb.b = max;
                if (max != 0) {
                    
                }
                hsb.s = max != 0 ? 255 * delta / max : 0;
                if (hsb.s != 0) {
                    if (rgb.r == max) {
                        hsb.h = (rgb.g - rgb.b) / delta;
                    } else if (rgb.g == max) {
                        hsb.h = 2 + (rgb.b - rgb.r) / delta;
                    } else {
                        hsb.h = 4 + (rgb.r - rgb.g) / delta;
                    }
                } else {
                    hsb.h = -1;
                }
                hsb.h *= 60;
                if (hsb.h < 0) {
                    hsb.h += 360;
                }
                hsb.s *= 100/255;
                hsb.b *= 100/255;
                return hsb;
            },
            HSBToRGB = function (hsb) {
                var rgb = {};
                var h = Math.round(hsb.h);
                var s = Math.round(hsb.s*255/100);
                var v = Math.round(hsb.b*255/100);
                if(s == 0) {
                    rgb.r = rgb.g = rgb.b = v;
                } else {
                    var t1 = v;
                    var t2 = (255-s)*v/255;
                    var t3 = (t1-t2)*(h%60)/60;
                    if(h==360) h = 0;
                    if(h<60) {rgb.r=t1; rgb.b=t2; rgb.g=t2+t3}
                    else if(h<120) {rgb.g=t1; rgb.b=t2; rgb.r=t1-t3}
                    else if(h<180) {rgb.g=t1; rgb.r=t2; rgb.b=t2+t3}
                    else if(h<240) {rgb.b=t1; rgb.r=t2; rgb.g=t1-t3}
                    else if(h<300) {rgb.b=t1; rgb.g=t2; rgb.r=t2+t3}
                    else if(h<360) {rgb.r=t1; rgb.g=t2; rgb.b=t1-t3}
                    else {rgb.r=0; rgb.g=0; rgb.b=0}
                }
                return {r:Math.round(rgb.r), g:Math.round(rgb.g), b:Math.round(rgb.b)};
            },
            RGBToHex = function (rgb) {
                var hex = [
                    rgb.r.toString(16),
                    rgb.g.toString(16),
                    rgb.b.toString(16)
                ];
                $.each(hex, function (nr, val) {
                    if (val.length == 1) {
                        hex[nr] = '0' + val;
                    }
                });
                return hex.join('');
            },
            HSBToHex = function (hsb) {
                return RGBToHex(HSBToRGB(hsb));
            },
            restoreOriginal = function () {
                var cal = $(this).parent();
                var col = cal.data('colorpicker').origColor;
                cal.data('colorpicker').color = col;
                fillRGBFields(col, cal.get(0));
                fillHexFields(col, cal.get(0));
                fillHSBFields(col, cal.get(0));
                setSelector(col, cal.get(0));
                setHue(col, cal.get(0));
                setNewColor(col, cal.get(0));
            };
        return {
            init: function (opt) {
                opt = $.extend({}, defaults, opt||{});
                if (typeof opt.color == 'string') {
                    opt.color = HexToHSB(opt.color);
                } else if (opt.color.r != undefined && opt.color.g != undefined && opt.color.b != undefined) {
                    opt.color = RGBToHSB(opt.color);
                } else if (opt.color.h != undefined && opt.color.s != undefined && opt.color.b != undefined) {
                    opt.color = fixHSB(opt.color);
                } else {
                    return this;
                }
                return this.each(function () {
                    if (!$(this).data('colorpickerId')) {
                        var options = $.extend({}, opt);
                        options.origColor = opt.color;
                        var id = 'collorpicker_' + parseInt(Math.random() * 1000);
                        $(this).data('colorpickerId', id);
                        var cal = $(tpl).attr('id', id);
                        if (options.flat) {
                            cal.appendTo(this).show();
                        } else {
                            cal.appendTo(document.body);
                        }
                        options.fields = cal
                                            .find('input')
                                                .bind('keyup', keyDown)
                                                .bind('change', change)
                                                .bind('blur', blur)
                                                .bind('focus', focus);
                        cal
                            .find('span').bind('mousedown', downIncrement).end()
                            .find('>div.colorpicker_current_color').bind('click', restoreOriginal);
                        options.selector = cal.find('div.colorpicker_color').bind('mousedown', downSelector);
                        options.selectorIndic = options.selector.find('div div');
                        options.el = this;
                        options.hue = cal.find('div.colorpicker_hue div');
                        cal.find('div.colorpicker_hue').bind('mousedown', downHue);
                        options.newColor = cal.find('div.colorpicker_new_color');
                        options.currentColor = cal.find('div.colorpicker_current_color');
                        cal.data('colorpicker', options);
                        cal.find('div.colorpicker_submit')
                            .bind('mouseenter', enterSubmit)
                            .bind('mouseleave', leaveSubmit)
                            .bind('click', clickSubmit);
                        fillRGBFields(options.color, cal.get(0));
                        fillHSBFields(options.color, cal.get(0));
                        fillHexFields(options.color, cal.get(0));
                        setHue(options.color, cal.get(0));
                        setSelector(options.color, cal.get(0));
                        setCurrentColor(options.color, cal.get(0));
                        setNewColor(options.color, cal.get(0));
                        if (options.flat) {
                            cal.css({
                                position: 'relative',
                                display: 'block'
                            });
                        } else {
                            $(this).bind(options.eventName, show);
                        }
                    }
                });
            },
            showPicker: function() {
                return this.each( function () {
                    if ($(this).data('colorpickerId')) {
                        show.apply(this);
                    }
                });
            },
            hidePicker: function() {
                return this.each( function () {
                    if ($(this).data('colorpickerId')) {
                        $('#' + $(this).data('colorpickerId')).hide();
                    }
                });
            },
            setColor: function(col) {
                if (typeof col == 'string') {
                    col = HexToHSB(col);
                } else if (col.r != undefined && col.g != undefined && col.b != undefined) {
                    col = RGBToHSB(col);
                } else if (col.h != undefined && col.s != undefined && col.b != undefined) {
                    col = fixHSB(col);
                } else {
                    return this;
                }
                return this.each(function(){
                    if ($(this).data('colorpickerId')) {
                        var cal = $('#' + $(this).data('colorpickerId'));
                        cal.data('colorpicker').color = col;
                        cal.data('colorpicker').origColor = col;
                        fillRGBFields(col, cal.get(0));
                        fillHSBFields(col, cal.get(0));
                        fillHexFields(col, cal.get(0));
                        setHue(col, cal.get(0));
                        setSelector(col, cal.get(0));
                        setCurrentColor(col, cal.get(0));
                        setNewColor(col, cal.get(0));
                    }
                });
            }
        };
    }();
    $.fn.extend({
        ColorPicker: ColorPicker.init,
        ColorPickerHide: ColorPicker.hidePicker,
        ColorPickerShow: ColorPicker.showPicker,
        ColorPickerSetColor: ColorPicker.setColor
    });
})(jQuery);

/*!
 * jQuery ClassyGradient
 * http://www.class.pm/projects/jquery/classygradient
 *
 * Copyright 2012 - 2013, Class.PM www.class.pm
 * Written by Marius Stanciu - Sergiu <marius@picozu.com>
 * Licensed under the GPL Version 3 license.
 * Version 1.0.0
 *
 */

 (function ($) {
    $.ClassyGradient = function(element, options) {
        var defaults = {
            gradient: '0% #02CDE8,100% #000000',
            width: 300,
            height: 18,
            point: 8,
            orientation: 'vertical',
            target: '',
            tooltip: '0% #feffff,100% #ededed',
            onChange: function () {},
            onInit: function () {}
        }, plugin = this, $element = $(element), element = element, _container, _canvas, $pointsContainer, $pointsInfos, $pointsInfosContent,
            $pointColor, $pointPosition, $spanPointPositionRes, $btnPointDelete, _context, _selPoint, _points = new Array(), tooltip
        plugin.settings = {};
        plugin.__constructor = function () {
            plugin.settings = $.extend({}, defaults, options);
            plugin.update();
            plugin.settings.onInit();
        };
        plugin.update = function () {
            setupPoints();
            setup();
            render();
        };
        plugin.getCSS = function () {
            var cssGradient = '', svgX = '0%', svgY = '100%', webkitDir = 'left bottom', defDir = 'top', ieDir = '0';
            if (plugin.settings.orientation == 'horizontal') {
                svgX = '100%';
                svgY = '0%';
                webkitDir = 'right top';
                defDir = 'left';
                ieDir = '1';
            }
            var svg = '<svg xmlns="http://www.w3.org/2000/svg">' + '<defs>' + '<linearGradient id="gradient" x1="0%" y1="0%" x2="' + svgX + '" y2="' + svgY + '">';
            var ieFilter = "progid:DXImageTransform.Microsoft.gradient( startColorstr='" + _points[0][1] + "', endColorstr='" + _points[_points.length - 1][1] + "',GradientType=" + ieDir + ")";
            var webkitCss = '-webkit-gradient(linear, left top, ' + webkitDir;
            var defCss = '';
            $.each(_points, function (i, el) {
                webkitCss += ', color-stop(' + el[0] + ', ' + el[1] + ')';
                defCss += ',' + el[1] + ' ' + el[0] + '';
                svg += '<stop offset="' + el[0] + '" style="stop-color:' + el[1] + ';" />';
            });
            webkitCss += ')';
            defCss = defCss.substr(1);
            svg += '</linearGradient>' + '</defs>' + '<rect fill="url(#gradient)" height="100%" width="100%" />' + '</svg>';
            svg = base64(svg);
            cssGradient += 'background: url(data:image/svg+xml;base64,' + svg + ');' + '\n';
            cssGradient += 'background: ' + webkitCss + ';\n';
            cssGradient += 'background: ' + '-moz-linear-gradient(' + defDir + ',' + defCss + ');' + '\n';
            cssGradient += 'background: ' + '-webkit-linear-gradient(' + defDir + ',' + defCss + ');' + '\n';
            cssGradient += 'background: ' + '-o-linear-gradient(' + defDir + ',' + defCss + ');' + '\n';
            cssGradient += 'background: ' + '-ms-linear-gradient(' + defDir + ',' + defCss + ');' + '\n';
            cssGradient += 'background: ' + 'linear-gradient(' + defDir + ',' + defCss + ');';
            return cssGradient;
        };
        plugin.getArray = function () {
            return _points;
        };
        plugin.getString = function () {
            var gradientString = '';
            $.each(_points, function (i, el) {
                gradientString += el[0] + ' ' + el[1] + ',';
            });
            gradientString = gradientString.substr(0, gradientString.length - 1);
            return gradientString;
        };
        plugin.setOrientation = function (orientation) {
            plugin.settings.orientation = orientation;
            renderToTarget();
        };
        var setupPoints = function () {
            _points = new Array();
            if ($.isArray(plugin.settings.gradient)) {
                _points = plugin.settings.gradient;
            }
            else {
                _points = getGradientFromString(plugin.settings.gradient);
            }
        };
        var setup = function () {
            $element.html('');
            _container = $('<div class="ClassyGradient"></div>');
            _canvas = $('<canvas class="canvas" width="' + plugin.settings.width + '" height="' + plugin.settings.height + '"></canvas>');
            _container.append(_canvas);
            _context = _canvas.get(0).getContext('2d');
            $pointsContainer = $('<div class="points"></div>');
            $pointsContainer.css('width', (plugin.settings.width) + Math.round(plugin.settings.point / 2 + 1) + 'px');
            _container.append($pointsContainer);
            $pointsInfos = $('<div class="info"></div>');
            $pointsInfos.append('<div class="arrow"></div>');
            _container.append($pointsInfos);
            $pointsInfosContent = $('<div class="content"></div>');
            $pointsInfos.append($pointsInfosContent);
            tooltip = getGradientFromString(plugin.settings.tooltip);
            renderToElement($pointsInfosContent, tooltip);
            $pointsInfosContent.css('color', plugin.settings.tooltipTextColor);
            $pointsInfos.find('.arrow').css('borderColor', 'transparent transparent ' + tooltip[0][1] + ' transparent');
            $element.hover(function () {
                $element.addClass('hover');
            }, function () {
                $element.removeClass('hover');
            });
            $pointColor = $('<div class="point-color"><div style="background-color: #00ff00"></div></div>');
            $pointPosition = $('<span class="point-position">%</span>');
            $btnPointDelete = $('<a href="javascript:" class="delete"></a>');
            $pointsInfosContent.append($pointColor, $pointPosition, $btnPointDelete);
            $element.append(_container);
            $pointColor.ColorPicker({
                color: '#00ff00',
                onSubmit: function (hsb, hex, rgb) {
                    $element.find('.point-color div').css('backgroundColor', '#' + hex);
                    _selPoint.css('backgroundColor', '#' + hex);
                    renderCanvas();
                    renderToTarget();
                },
                onChange: function (hsb, hex, rgb) {
                    $element.find('.point-color div').css('backgroundColor', '#' + hex);
                    _selPoint.css('backgroundColor', '#' + hex);
                    renderCanvas();
                    renderToTarget();
                }
            });
            $(document).bind('click', function () {
                if (!$element.is('.hover')) {
                    $pointsInfos.hide('fast');
                }
            });
            _canvas.unbind('click');
            _canvas.bind('click', function (e) {
                var offset = _canvas.offset(), clickPosition = e.pageX - offset.left;
                clickPosition = Math.round((clickPosition * 100) / plugin.settings.width);
                var defaultColor = '#000000', minDist = 999999999999;
                $.each(_points, function (i, el) {
                    if ((parseInt(el[0]) < clickPosition) && (clickPosition - parseInt(el[0]) < minDist)) {
                        minDist = clickPosition - parseInt(el[0]);
                        defaultColor = el[1];
                    }
                    else if ((parseInt(el[0]) > clickPosition) && (parseInt(el[0]) - clickPosition < minDist)) {
                        minDist = parseInt(el[0]) - clickPosition;
                        defaultColor = el[1];
                    }
                });
                _points.push([clickPosition + '%', defaultColor]);
                _points.sort(sortByPosition);
                render();
                $.each(_points, function (i, el) {
                    if (el[0] == clickPosition + '%') {
                        selectPoint($pointsContainer.find('.point:eq(' + i + ')'))
                    }
                })
            })
        };
        var render = function () {
            initGradientPoints();
            renderCanvas();
            renderToTarget()
        };
        var initGradientPoints = function () {
            $pointsContainer.html('');
            $.each(_points, function (i, el) {
                $pointsContainer.append('<div class="point" style="background-color: ' + el[1] + '; left:' + (parseInt(el[0]) * plugin.settings.width) / 100 + 'px; top:-' + (i * (plugin.settings.point + 2)) + 'px"><div class="arrow"></div></div>');
            });
            $pointsContainer.find('.point').css('width', plugin.settings.point + 'px');
            $pointsContainer.find('.point').css('height', plugin.settings.point + 'px');
            $pointsContainer.find('.point').mouseup(function () {
                selectPoint(this);
            });
            $pointsContainer.find('.point').draggable({
                axis: "x",
                containment: "parent",
                drag: function () {
                    selectPoint(this);
                    renderCanvas();
                    renderToTarget();
                }
            })
        };
        var selectPoint = function (el) {
            _selPoint = $(el);
            var color = $(el).css('backgroundColor'), position = parseInt($(el).css('left'));
            position = Math.round((position / plugin.settings.width) * 100);
            color = color.substr(4, color.length);
            color = color.substr(0, color.length - 1);
            $pointColor.ColorPickerSetColor(rgbToHex(color.split(',')));
            $pointColor.find('div').css('backgroundColor', rgbToHex(color.split(',')));
            $pointPosition.html('Position: ' + position + '%');
            $btnPointDelete.unbind('click');
            $btnPointDelete.bind('click', function () {
                if (_points.length > 1) {
                    _points.splice(_selPoint.index(), 1);
                    render();
                    $element.find('.info').hide('fast');
                }
            });
            var posLeft = parseInt($(el).css('left')) - 30;
            $element.find('.info').css('marginLeft', posLeft + 'px');
            $element.find('.info').show('fast');
        };
        var renderCanvas = function () {
            _points = new Array();
            $element.find('.point').each(function (i, el) {
                var position = Math.round((parseInt($(el).css('left')) / plugin.settings.width) * 100);
                var color = $(el).css('backgroundColor').substr(4, $(el).css('backgroundColor').length - 5);
                color = rgbToHex(color.split(','));
                _points.push([position + '%', color]);
            });
            _points.sort(sortByPosition);
            renderToCanvas();
            plugin.settings.onChange(plugin.getString(), plugin.getCSS(), plugin.getArray());
        };
        var renderToElement = function ($target, gradient) {
            var svgX = '0%', svgY = '100%', webkitDir = 'left bottom', defDir = 'top', ieDir = '0';
            if (($target == _canvas) || (plugin.settings.orientation == 'horizontal')) {
                svgX = '100%';
                svgY = '0%';
                webkitDir = 'right top';
                defDir = 'left';
                ieDir = '1';
            }
            var svg = '<svg xmlns="http://www.w3.org/2000/svg">' + '<defs>' + '<linearGradient id="gradient" x1="0%" y1="0%" x2="' + svgX + '" y2="' + svgY + '">';
            var ieFilter = "progid:DXImageTransform.Microsoft.gradient( startColorstr='" + gradient[0][1] + "', endColorstr='" + gradient[gradient.length - 1][1] + "',GradientType=" + ieDir + ")";
            var webkitCss = '-webkit-gradient(linear, left top, ' + webkitDir;
            var defCss = '';
            $.each(gradient, function (i, el) {
                webkitCss += ', color-stop(' + el[0] + ', ' + el[1] + ')';
                defCss += ',' + el[1] + ' ' + el[0] + '';
                svg += '<stop offset="' + el[0] + '" style="stop-color:' + el[1] + ';" />';
            });
            webkitCss += ')';
            defCss = defCss.substr(1);
            svg += '</linearGradient>' + '</defs>';
            if ($target == $pointsInfosContent) {
                var tooltipRadius = parseInt($pointsInfosContent.css('borderRadius'));
                svg += '<rect fill="url(#gradient)" height="100%" width="100%" rx="' + tooltipRadius + '" ry="' + tooltipRadius + '" />';
            }
            else {
                svg += '<rect fill="url(#gradient)" height="100%" width="100%" />';
            }
            svg += '</svg>';
            svg = base64(svg);
            $target.css('background', 'url(data:image/svg+xml;base64,' + svg + ')');
            $target.css('background', webkitCss);
            $target.css('background', '-moz-linear-gradient(' + defDir + ',' + defCss + ')');
            $target.css('background', '-webkit-linear-gradient(' + defDir + ',' + defCss + ')');
            $target.css('background', '-o-linear-gradient(' + defDir + ',' + defCss + ')');
            $target.css('background', '-ms-linear-gradient(' + defDir + ',' + defCss + ')');
            $target.css('background', 'linear-gradient(' + defDir + ',' + defCss + ')');
        };
        var renderToTarget = function () {
            if (plugin.settings.target != "") {
                var $target = $(plugin.settings.target);
                renderToElement($target, _points);
            }
        };
        var renderToCanvas = function () {
            var gradient = _context.createLinearGradient(0, 0, plugin.settings.width, 0);
            $.each(_points, function (i, el) {
                gradient.addColorStop(parseInt(el[0]) / 100, el[1]);
            });
            _context.clearRect(0, 0, plugin.settings.width, plugin.settings.height);
            _context.fillStyle = gradient;
            _context.fillRect(0, 0, plugin.settings.width, plugin.settings.height);
            plugin.settings.onChange(plugin.getString(), plugin.getCSS(), plugin.getArray())
        };
        var getGradientFromString = function (gradient) {
            var gradientArray = new Array(), _pointsTmp = gradient.split(',');
            $.each(_pointsTmp, function (i, el) {
                var position;
                if ((el.substr(el.indexOf('%') - 3, el.indexOf('%')) == '100') || (el.substr(el.indexOf('%') - 3, el.indexOf('%')) == '100%')) {
                    position = '100%';
                }
                else if (el.indexOf('%') > 1) {
                    position = parseInt(el.substr(el.indexOf('%') - 2, el.indexOf('%')));
                    position += '%';
                }
                else {
                    position = parseInt(el.substr(el.indexOf('%') - 1, el.indexOf('%')));
                    position += '%';
                }
                var color = el.substr(el.indexOf('#'), 7);
                gradientArray.push([position, color]);
            });
            return gradientArray;
        };
        var rgbToHex = function (rgb) {
            var R = rgb[0], G = rgb[1], B = rgb[2];
            function toHex(n) {
                n = parseInt(n, 10);
                if (isNaN(n)) return "00";
                n = Math.max(0, Math.min(n, 255));
                return "0123456789ABCDEF".charAt((n - n % 16) / 16) + "0123456789ABCDEF".charAt(n % 16);
            }
            function cutHex(h) {
                return (h.charAt(0) == "#") ? h.substring(1, 7) : h;
            }
            function hexToR(h) {
                return parseInt((cutHex(h)).substring(0, 2), 16);
            }
            function hexToG(h) {
                return parseInt((cutHex(h)).substring(2, 4), 16);
            }
            function hexToB(h) {
                return parseInt((cutHex(h)).substring(4, 6), 16);
            }
            return '#' + toHex(R) + toHex(G) + toHex(B);
        };
        var sortByPosition = function (data_A, data_B) {
            if (parseInt(data_A[0]) < parseInt(data_B[0])) {
                return -1;
            }
            if (parseInt(data_A[0]) > parseInt(data_B[0])) {
                return 1;
            }
            return 0;
        };
        var base64 = function (input) {
            var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", output = "", chr1, chr2, chr3, enc1, enc2, enc3, enc4, i = 0;
            while (i < input.length) {
                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);
                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;
                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                }
                else if (isNaN(chr3)) {
                    enc4 = 64;
                }
                output += keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
            }
            return output;
        };
        plugin.__constructor();
    };
    $.fn.ClassyGradient = function (options) {
        return this.each(function () {
            if (undefined == $(this).data('ClassyGradient')) {
                var plugin = new $.ClassyGradient(this, options);
                $(this).data('ClassyGradient', plugin);
            }
        })
    }
})(jQuery);