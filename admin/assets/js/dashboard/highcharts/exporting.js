/*
 Highcharts JS v10.3.3 (2023-01-20)

 Exporting module

 (c) 2010-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(a) {
    "object" === typeof module && module.exports ? (a["default"] = a, module.exports = a) : "function" === typeof define && define.amd ? define("highcharts/modules/exporting", ["highcharts"], function(m) {
        a(m);
        a.Highcharts = m;
        return a
    }) : a("undefined" !== typeof Highcharts ? Highcharts : void 0)
})(function(a) {
    function m(a, l, J, x) {
        a.hasOwnProperty(l) || (a[l] = x.apply(null, J), "function" === typeof CustomEvent && window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded", {
            detail: {
                path: l,
                module: a[l]
            }
        })))
    }
    a = a ? a._modules : {};
    m(a,
        "Core/Chart/ChartNavigationComposition.js", [],
        function() {
            var a;
            (function(a) {
                a.compose = function(a) {
                    a.navigation || (a.navigation = new e(a));
                    return a
                };
                var e = function() {
                    function a(a) {
                        this.updates = [];
                        this.chart = a
                    }
                    a.prototype.addUpdate = function(a) {
                        this.chart.navigation.updates.push(a)
                    };
                    a.prototype.update = function(a, D) {
                        var e = this;
                        this.updates.forEach(function(b) {
                            b.call(e.chart, a, D)
                        })
                    };
                    return a
                }();
                a.Additions = e
            })(a || (a = {}));
            return a
        });
    m(a, "Extensions/Exporting/ExportingDefaults.js", [a["Core/Globals.js"]], function(a) {
        a =
            a.isTouchDevice;
        return {
            exporting: {
                allowTableSorting: !0,
                type: "image/png",
                url: "https://export.highcharts.com/",
                pdfFont: {
                    normal: void 0,
                    bold: void 0,
                    bolditalic: void 0,
                    italic: void 0
                },
                printMaxWidth: 780,
                scale: 2,
                buttons: {
                    contextButton: {
                        className: "highcharts-contextbutton",
                        menuClassName: "highcharts-contextmenu",
                        symbol: "menu",
                        titleKey: "contextButtonTitle",
                        menuItems: "viewFullscreen printChart separator downloadPNG downloadJPEG downloadPDF downloadSVG".split(" ")
                    }
                },
                menuItemDefinitions: {
                    viewFullscreen: {
                        textKey: "viewFullscreen",
                        onclick: function() {
                            this.fullscreen && this.fullscreen.toggle()
                        }
                    },
                    printChart: {
                        textKey: "printChart",
                        onclick: function() {
                            this.print()
                        }
                    },
                    separator: {
                        separator: !0
                    },
                    downloadPNG: {
                        textKey: "downloadPNG",
                        onclick: function() {
                            this.exportChart()
                        }
                    },
                    downloadJPEG: {
                        textKey: "downloadJPEG",
                        onclick: function() {
                            this.exportChart({
                                type: "image/jpeg"
                            })
                        }
                    },
                    downloadPDF: {
                        textKey: "downloadPDF",
                        onclick: function() {
                            this.exportChart({
                                type: "application/pdf"
                            })
                        }
                    },
                    downloadSVG: {
                        textKey: "downloadSVG",
                        onclick: function() {
                            this.exportChart({
                                type: "image/svg+xml"
                            })
                        }
                    }
                }
            },
            lang: {
                viewFullscreen: "View in full screen",
                exitFullscreen: "Exit from full screen",
                printChart: "Print chart",
                downloadPNG: "Download PNG image",
                downloadJPEG: "Download JPEG image",
                downloadPDF: "Download PDF document",
                downloadSVG: "Download SVG vector image",
                contextButtonTitle: "Chart context menu"
            },
            navigation: {
                buttonOptions: {
                    symbolSize: 14,
                    symbolX: 12.5,
                    symbolY: 10.5,
                    align: "right",
                    buttonSpacing: 3,
                    height: 22,
                    verticalAlign: "top",
                    width: 24,
                    symbolFill: "#666666",
                    symbolStroke: "#666666",
                    symbolStrokeWidth: 3,
                    theme: {
                        padding: 5
                    }
                },
                menuStyle: {
                    border: "1px solid ".concat("#999999"),
                    background: "#ffffff",
                    padding: "5px 0"
                },
                menuItemStyle: {
                    padding: "0.5em 1em",
                    color: "#333333",
                    background: "none",
                    fontSize: a ? "14px" : "11px",
                    transition: "background 250ms, color 250ms"
                },
                menuItemHoverStyle: {
                    background: "#335cad",
                    color: "#ffffff"
                }
            }
        }
    });
    m(a, "Extensions/Exporting/ExportingSymbols.js", [], function() {
        var a;
        (function(a) {
            function e(a, e, b, g) {
                return [
                    ["M", a, e + 2.5],
                    ["L", a + b, e + 2.5],
                    ["M", a, e + g / 2 + .5],
                    ["L", a + b, e + g / 2 + .5],
                    ["M", a, e + g - 1.5],
                    ["L", a + b, e + g - 1.5]
                ]
            }

            function l(a,
                e, b, g) {
                a = g / 3 - 2;
                g = [];
                return g = g.concat(this.circle(b - a, e, a, a), this.circle(b - a, e + a + 4, a, a), this.circle(b - a, e + 2 * (a + 4), a, a))
            }
            var q = [];
            a.compose = function(a) {
                -1 === q.indexOf(a) && (q.push(a), a = a.prototype.symbols, a.menu = e, a.menuball = l.bind(a))
            }
        })(a || (a = {}));
        return a
    });
    m(a, "Extensions/Exporting/Fullscreen.js", [a["Core/Renderer/HTML/AST.js"], a["Core/Utilities.js"]], function(a, l) {
        function e() {
            this.fullscreen = new A(this)
        }
        var x = l.addEvent,
            q = l.fireEvent,
            m = [],
            A = function() {
                function b(a) {
                    this.chart = a;
                    this.isOpen = !1;
                    a = a.renderTo;
                    this.browserProps || ("function" === typeof a.requestFullscreen ? this.browserProps = {
                            fullscreenChange: "fullscreenchange",
                            requestFullscreen: "requestFullscreen",
                            exitFullscreen: "exitFullscreen"
                        } : a.mozRequestFullScreen ? this.browserProps = {
                            fullscreenChange: "mozfullscreenchange",
                            requestFullscreen: "mozRequestFullScreen",
                            exitFullscreen: "mozCancelFullScreen"
                        } : a.webkitRequestFullScreen ? this.browserProps = {
                            fullscreenChange: "webkitfullscreenchange",
                            requestFullscreen: "webkitRequestFullScreen",
                            exitFullscreen: "webkitExitFullscreen"
                        } :
                        a.msRequestFullscreen && (this.browserProps = {
                            fullscreenChange: "MSFullscreenChange",
                            requestFullscreen: "msRequestFullscreen",
                            exitFullscreen: "msExitFullscreen"
                        }))
                }
                b.compose = function(a) {
                    -1 === m.indexOf(a) && (m.push(a), x(a, "beforeRender", e))
                };
                b.prototype.close = function() {
                    var a = this,
                        d = a.chart,
                        n = d.options.chart;
                    q(d, "fullscreenClose", null, function() {
                        if (a.isOpen && a.browserProps && d.container.ownerDocument instanceof Document) d.container.ownerDocument[a.browserProps.exitFullscreen]();
                        a.unbindFullscreenEvent && (a.unbindFullscreenEvent =
                            a.unbindFullscreenEvent());
                        d.setSize(a.origWidth, a.origHeight, !1);
                        a.origWidth = void 0;
                        a.origHeight = void 0;
                        n.width = a.origWidthOption;
                        n.height = a.origHeightOption;
                        a.origWidthOption = void 0;
                        a.origHeightOption = void 0;
                        a.isOpen = !1;
                        a.setButtonText()
                    })
                };
                b.prototype.open = function() {
                    var a = this,
                        d = a.chart,
                        n = d.options.chart;
                    q(d, "fullscreenOpen", null, function() {
                        n && (a.origWidthOption = n.width, a.origHeightOption = n.height);
                        a.origWidth = d.chartWidth;
                        a.origHeight = d.chartHeight;
                        if (a.browserProps) {
                            var g = x(d.container.ownerDocument,
                                    a.browserProps.fullscreenChange,
                                    function() {
                                        a.isOpen ? (a.isOpen = !1, a.close()) : (d.setSize(null, null, !1), a.isOpen = !0, a.setButtonText())
                                    }),
                                e = x(d, "destroy", g);
                            a.unbindFullscreenEvent = function() {
                                g();
                                e()
                            };
                            var b = d.renderTo[a.browserProps.requestFullscreen]();
                            if (b) b["catch"](function() {
                                alert("Full screen is not supported inside a frame.")
                            })
                        }
                    })
                };
                b.prototype.setButtonText = function() {
                    var g = this.chart,
                        d = g.exportDivElements,
                        n = g.options.exporting,
                        b = n && n.buttons && n.buttons.contextButton.menuItems;
                    g = g.options.lang;
                    n && n.menuItemDefinitions && g && g.exitFullscreen && g.viewFullscreen && b && d && (d = d[b.indexOf("viewFullscreen")]) && a.setElementHTML(d, this.isOpen ? g.exitFullscreen : n.menuItemDefinitions.viewFullscreen.text || g.viewFullscreen)
                };
                b.prototype.toggle = function() {
                    this.isOpen ? this.close() : this.open()
                };
                return b
            }();
        "";
        "";
        return A
    });
    m(a, "Core/HttpUtilities.js", [a["Core/Globals.js"], a["Core/Utilities.js"]], function(a, l) {
        var e = a.doc,
            m = l.createElement,
            q = l.discardElement,
            D = l.merge,
            A = l.objectEach,
            b = {
                ajax: function(a) {
                    var d = {
                            json: "application/json",
                            xml: "application/xml",
                            text: "text/plain",
                            octet: "application/octet-stream"
                        },
                        b = new XMLHttpRequest;
                    if (!a.url) return !1;
                    b.open((a.type || "get").toUpperCase(), a.url, !0);
                    a.headers && a.headers["Content-Type"] || b.setRequestHeader("Content-Type", d[a.dataType || "json"] || d.text);
                    A(a.headers, function(a, d) {
                        b.setRequestHeader(d, a)
                    });
                    a.responseType && (b.responseType = a.responseType);
                    b.onreadystatechange = function() {
                        if (4 === b.readyState) {
                            if (200 === b.status) {
                                if ("blob" !== a.responseType) {
                                    var d = b.responseText;
                                    if ("json" === a.dataType) try {
                                        d = JSON.parse(d)
                                    } catch (z) {
                                        if (z instanceof Error) {
                                            a.error && a.error(b, z);
                                            return
                                        }
                                    }
                                }
                                return a.success && a.success(d, b)
                            }
                            a.error && a.error(b, b.responseText)
                        }
                    };
                    a.data && "string" !== typeof a.data && (a.data = JSON.stringify(a.data));
                    b.send(a.data)
                },
                getJSON: function(a, d) {
                    b.ajax({
                        url: a,
                        success: d,
                        dataType: "json",
                        headers: {
                            "Content-Type": "text/plain"
                        }
                    })
                },
                post: function(a, b, n) {
                    var d = m("form", D({
                        method: "post",
                        action: a,
                        enctype: "multipart/form-data"
                    }, n), {
                        display: "none"
                    }, e.body);
                    A(b, function(a, b) {
                        m("input", {
                            type: "hidden",
                            name: b,
                            value: a
                        }, void 0, d)
                    });
                    d.submit();
                    q(d)
                }
            };
        "";
        return b
    });
    m(a, "Extensions/Exporting/Exporting.js", [a["Core/Renderer/HTML/AST.js"], a["Core/Chart/Chart.js"], a["Core/Chart/ChartNavigationComposition.js"], a["Core/Defaults.js"], a["Extensions/Exporting/ExportingDefaults.js"], a["Extensions/Exporting/ExportingSymbols.js"], a["Extensions/Exporting/Fullscreen.js"], a["Core/Globals.js"], a["Core/HttpUtilities.js"], a["Core/Utilities.js"]], function(a, l, m, x, q, D, A, b, g, d) {
        var e = x.defaultOptions,
            J = x.setOptions,
            z = b.doc,
            P = b.SVG_NS,
            C = b.win,
            B = d.addEvent,
            w = d.css,
            E = d.createElement,
            N = d.discardElement,
            F = d.extend,
            Q = d.find,
            G = d.fireEvent,
            R = d.isObject,
            r = d.merge,
            S = d.objectEach,
            y = d.pick,
            T = d.removeEvent,
            U = d.uniqueKey,
            H;
        (function(l) {
            function n(a) {
                var c = this,
                    v = c.renderer,
                    k = r(c.options.navigation.buttonOptions, a),
                    b = k.onclick,
                    d = k.menuItems,
                    e = k.symbolSize || 12;
                c.btnCount || (c.btnCount = 0);
                c.exportDivElements || (c.exportDivElements = [], c.exportSVGElements = []);
                if (!1 !== k.enabled && k.theme) {
                    var f = k.theme,
                        M;
                    c.styledMode || (f.fill = y(f.fill,
                        "#ffffff"), f.stroke = y(f.stroke, "none"));
                    b ? M = function(a) {
                        a && a.stopPropagation();
                        b.call(c, a)
                    } : d && (M = function(a) {
                        a && a.stopPropagation();
                        c.contextMenu(u.menuClassName, d, u.translateX, u.translateY, u.width, u.height, u);
                        u.setState(2)
                    });
                    k.text && k.symbol ? f.paddingLeft = y(f.paddingLeft, 30) : k.text || F(f, {
                        width: k.width,
                        height: k.height,
                        padding: 0
                    });
                    c.styledMode || (f["stroke-linecap"] = "round", f.fill = y(f.fill, "#ffffff"), f.stroke = y(f.stroke, "none"));
                    var u = v.button(k.text, 0, 0, M, f, void 0, void 0, void 0, void 0, k.useHTML).addClass(a.className).attr({
                        title: y(c.options.lang[k._titleKey ||
                            k.titleKey], "")
                    });
                    u.menuClassName = a.menuClassName || "highcharts-menu-" + c.btnCount++;
                    if (k.symbol) {
                        var g = v.symbol(k.symbol, k.symbolX - e / 2, k.symbolY - e / 2, e, e, {
                            width: e,
                            height: e
                        }).addClass("highcharts-button-symbol").attr({
                            zIndex: 1
                        }).add(u);
                        c.styledMode || g.attr({
                            stroke: k.symbolStroke,
                            fill: k.symbolFill,
                            "stroke-width": k.symbolStrokeWidth || 1
                        })
                    }
                    u.add(c.exportingGroup).align(F(k, {
                        width: u.width,
                        x: y(k.x, c.buttonOffset)
                    }), !0, "spacingBox");
                    c.buttonOffset += (u.width + k.buttonSpacing) * ("right" === k.align ? -1 : 1);
                    c.exportSVGElements.push(u,
                        g)
                }
            }

            function x() {
                if (this.printReverseInfo) {
                    var a = this.printReverseInfo,
                        h = a.childNodes,
                        b = a.origDisplay;
                    a = a.resetParams;
                    this.moveContainers(this.renderTo);
                    [].forEach.call(h, function(a, c) {
                        1 === a.nodeType && (a.style.display = b[c] || "")
                    });
                    this.isPrinting = !1;
                    a && this.setSize.apply(this, a);
                    delete this.printReverseInfo;
                    I = void 0;
                    G(this, "afterPrint")
                }
            }

            function H() {
                var a = z.body,
                    h = this.options.exporting.printMaxWidth,
                    b = {
                        childNodes: a.childNodes,
                        origDisplay: [],
                        resetParams: void 0
                    };
                this.isPrinting = !0;
                this.pointer.reset(null,
                    0);
                G(this, "beforePrint");
                h && this.chartWidth > h && (b.resetParams = [this.options.chart.width, void 0, !1], this.setSize(h, void 0, !1));
                [].forEach.call(b.childNodes, function(a, c) {
                    1 === a.nodeType && (b.origDisplay[c] = a.style.display, a.style.display = "none")
                });
                this.moveContainers(a);
                this.printReverseInfo = b
            }

            function V(a) {
                a.renderExporting();
                B(a, "redraw", a.renderExporting);
                B(a, "destroy", a.destroyExport)
            }

            function W(c, h, b, k, e, L, g) {
                var f = this,
                    v = f.options.navigation,
                    u = f.chartWidth,
                    l = f.chartHeight,
                    m = "cache-" + c,
                    n = Math.max(e,
                        L),
                    p = f[m];
                if (!p) {
                    f.exportContextMenu = f[m] = p = E("div", {
                        className: c
                    }, {
                        position: "absolute",
                        zIndex: 1E3,
                        padding: n + "px",
                        pointerEvents: "auto"
                    }, f.fixedDiv || f.container);
                    var t = E("ul", {
                        className: "highcharts-menu"
                    }, {
                        listStyle: "none",
                        margin: 0,
                        padding: 0
                    }, p);
                    f.styledMode || w(t, F({
                        MozBoxShadow: "3px 3px 10px #888",
                        WebkitBoxShadow: "3px 3px 10px #888",
                        boxShadow: "3px 3px 10px #888"
                    }, v.menuStyle));
                    p.hideMenu = function() {
                        w(p, {
                            display: "none"
                        });
                        g && g.setState(0);
                        f.openMenu = !1;
                        w(f.renderTo, {
                            overflow: "hidden"
                        });
                        w(f.container, {
                            overflow: "hidden"
                        });
                        d.clearTimeout(p.hideTimer);
                        G(f, "exportMenuHidden")
                    };
                    f.exportEvents.push(B(p, "mouseleave", function() {
                        p.hideTimer = C.setTimeout(p.hideMenu, 500)
                    }), B(p, "mouseenter", function() {
                        d.clearTimeout(p.hideTimer)
                    }), B(z, "mouseup", function(a) {
                        f.pointer.inClass(a.target, c) || p.hideMenu()
                    }), B(p, "click", function() {
                        f.openMenu && p.hideMenu()
                    }));
                    h.forEach(function(c) {
                        "string" === typeof c && (c = f.options.exporting.menuItemDefinitions[c]);
                        if (R(c, !0)) {
                            var h = void 0;
                            c.separator ? h = E("hr", void 0, void 0, t) : ("viewData" ===
                                c.textKey && f.isDataTableVisible && (c.textKey = "hideData"), h = E("li", {
                                    className: "highcharts-menu-item",
                                    onclick: function(a) {
                                        a && a.stopPropagation();
                                        p.hideMenu();
                                        c.onclick && c.onclick.apply(f, arguments)
                                    }
                                }, void 0, t), a.setElementHTML(h, c.text || f.options.lang[c.textKey]), f.styledMode || (h.onmouseover = function() {
                                    w(this, v.menuItemHoverStyle)
                                }, h.onmouseout = function() {
                                    w(this, v.menuItemStyle)
                                }, w(h, F({
                                    cursor: "pointer"
                                }, v.menuItemStyle || {}))));
                            f.exportDivElements.push(h)
                        }
                    });
                    f.exportDivElements.push(t, p);
                    f.exportMenuWidth =
                        p.offsetWidth;
                    f.exportMenuHeight = p.offsetHeight
                }
                h = {
                    display: "block"
                };
                b + f.exportMenuWidth > u ? h.right = u - b - e - n + "px" : h.left = b - n + "px";
                k + L + f.exportMenuHeight > l && "top" !== g.alignOptions.verticalAlign ? h.bottom = l - k - n + "px" : h.top = k + L - n + "px";
                w(p, h);
                w(f.renderTo, {
                    overflow: ""
                });
                w(f.container, {
                    overflow: ""
                });
                f.openMenu = !0;
                G(f, "exportMenuShown")
            }

            function X(a) {
                var c = a ? a.target : this,
                    b = c.exportSVGElements,
                    k = c.exportDivElements;
                a = c.exportEvents;
                var e;
                b && (b.forEach(function(a, h) {
                    a && (a.onclick = a.ontouchstart = null, e = "cache-" +
                        a.menuClassName, c[e] && delete c[e], b[h] = a.destroy())
                }), b.length = 0);
                c.exportingGroup && (c.exportingGroup.destroy(), delete c.exportingGroup);
                k && (k.forEach(function(a, c) {
                    a && (d.clearTimeout(a.hideTimer), T(a, "mouseleave"), k[c] = a.onmouseout = a.onmouseover = a.ontouchstart = a.onclick = null, N(a))
                }), k.length = 0);
                a && (a.forEach(function(a) {
                    a()
                }), a.length = 0)
            }

            function Y(a, h) {
                h = this.getSVGForExport(a, h);
                a = r(this.options.exporting, a);
                g.post(a.url, {
                    filename: a.filename ? a.filename.replace(/\//g, "-") : this.getFilename(),
                    type: a.type,
                    width: a.width || 0,
                    scale: a.scale,
                    svg: h
                }, a.formAttributes)
            }

            function Z() {
                this.styledMode && this.inlineStyles();
                return this.container.innerHTML
            }

            function aa() {
                var a = this.userOptions.title && this.userOptions.title.text,
                    h = this.options.exporting.filename;
                if (h) return h.replace(/\//g, "-");
                "string" === typeof a && (h = a.toLowerCase().replace(/<\/?[^>]+(>|$)/g, "").replace(/[\s_]+/g, "-").replace(/[^a-z0-9\-]/g, "").replace(/^[\-]+/g, "").replace(/[\-]+/g, "-").substr(0, 24).replace(/[\-]+$/g, ""));
                if (!h || 5 > h.length) h = "chart";
                return h
            }

            function ba(a) {
                var c, b = r(this.options, a);
                b.plotOptions = r(this.userOptions.plotOptions, a && a.plotOptions);
                b.time = r(this.userOptions.time, a && a.time);
                var d = E("div", null, {
                        position: "absolute",
                        top: "-9999em",
                        width: this.chartWidth + "px",
                        height: this.chartHeight + "px"
                    }, z.body),
                    e = this.renderTo.style.width;
                var g = this.renderTo.style.height;
                e = b.exporting.sourceWidth || b.chart.width || /px$/.test(e) && parseInt(e, 10) || (b.isGantt ? 800 : 600);
                g = b.exporting.sourceHeight || b.chart.height || /px$/.test(g) && parseInt(g, 10) ||
                    400;
                F(b.chart, {
                    animation: !1,
                    renderTo: d,
                    forExport: !0,
                    renderer: "SVGRenderer",
                    width: e,
                    height: g
                });
                b.exporting.enabled = !1;
                delete b.data;
                b.series = [];
                this.series.forEach(function(a) {
                    c = r(a.userOptions, {
                        animation: !1,
                        enableMouseTracking: !1,
                        showCheckbox: !1,
                        visible: a.visible
                    });
                    c.isInternal || b.series.push(c)
                });
                var l = {};
                this.axes.forEach(function(a) {
                    a.userOptions.internalKey || (a.userOptions.internalKey = U());
                    a.options.isInternal || (l[a.coll] || (l[a.coll] = !0, b[a.coll] = []), b[a.coll].push(r(a.userOptions, {
                        visible: a.visible
                    })))
                });
                var f = new this.constructor(b, this.callback);
                a && ["xAxis", "yAxis", "series"].forEach(function(c) {
                    var b = {};
                    a[c] && (b[c] = a[c], f.update(b))
                });
                this.axes.forEach(function(a) {
                    var c = Q(f.axes, function(c) {
                            return c.options.internalKey === a.userOptions.internalKey
                        }),
                        b = a.getExtremes(),
                        h = b.userMin;
                    b = b.userMax;
                    c && ("undefined" !== typeof h && h !== c.min || "undefined" !== typeof b && b !== c.max) && c.setExtremes(h, b, !0, !1)
                });
                g = f.getChartHTML();
                G(this, "getSVG", {
                    chartCopy: f
                });
                g = this.sanitizeSVG(g, b);
                b = null;
                f.destroy();
                N(d);
                return g
            }

            function ca(a, b) {
                var c = this.options.exporting;
                return this.getSVG(r({
                    chart: {
                        borderRadius: 0
                    }
                }, c.chartOptions, b, {
                    exporting: {
                        sourceWidth: a && a.sourceWidth || c.sourceWidth,
                        sourceHeight: a && a.sourceHeight || c.sourceHeight
                    }
                }))
            }

            function da(a) {
                return a.replace(/([A-Z])/g, function(a, c) {
                    return "-" + c.toLowerCase()
                })
            }

            function ea() {
                function a(c) {
                    var f = {};
                    if (m && 1 === c.nodeType && -1 === fa.indexOf(c.nodeName)) {
                        var k = C.getComputedStyle(c, null);
                        var n = "svg" === c.nodeName ? {} : C.getComputedStyle(c.parentNode, null);
                        if (!e[c.nodeName]) {
                            g =
                                m.getElementsByTagName("svg")[0];
                            var l = m.createElementNS(c.namespaceURI, c.nodeName);
                            g.appendChild(l);
                            var v = C.getComputedStyle(l, null);
                            var p = {};
                            for (var t in v) "string" !== typeof v[t] || /^[0-9]+$/.test(t) || (p[t] = v[t]);
                            e[c.nodeName] = p;
                            "text" === c.nodeName && delete e.text.fill;
                            g.removeChild(l)
                        }
                        for (var r in k)
                            if (b.isFirefox || b.isMS || b.isSafari || Object.hasOwnProperty.call(k, r)) {
                                t = k[r];
                                var q = r;
                                l = v = !1;
                                if (d.length) {
                                    for (p = d.length; p-- && !v;) v = d[p].test(q);
                                    l = !v
                                }
                                "transform" === q && "none" === t && (l = !0);
                                for (p = h.length; p-- &&
                                    !l;) l = h[p].test(q) || "function" === typeof t;
                                l || n[q] === t && "svg" !== c.nodeName || e[c.nodeName][q] === t || (O && -1 === O.indexOf(q) ? f[q] = t : t && c.setAttribute(da(q), t))
                            } w(c, f);
                        "svg" === c.nodeName && c.setAttribute("stroke-width", "1px");
                        "text" !== c.nodeName && [].forEach.call(c.children || c.childNodes, a)
                    }
                }
                var h = ha,
                    d = l.inlineAllowlist,
                    e = {},
                    g, n = z.createElement("iframe");
                w(n, {
                    width: "1px",
                    height: "1px",
                    visibility: "hidden"
                });
                z.body.appendChild(n);
                var m = n.contentWindow && n.contentWindow.document;
                m && m.body.appendChild(m.createElementNS(P,
                    "svg"));
                a(this.container.querySelector("svg"));
                g.parentNode.removeChild(g);
                n.parentNode.removeChild(n)
            }

            function ia(a) {
                (this.fixedDiv ? [this.fixedDiv, this.scrollingContainer] : [this.container]).forEach(function(c) {
                    a.appendChild(c)
                })
            }

            function ja() {
                var a = this;
                a.exporting = {
                    update: function(c, b) {
                        a.isDirtyExporting = !0;
                        r(!0, a.options.exporting, c);
                        y(b, !0) && a.redraw()
                    }
                };
                m.compose(a).navigation.addUpdate(function(c, b) {
                    a.isDirtyExporting = !0;
                    r(!0, a.options.navigation, c);
                    y(b, !0) && a.redraw()
                })
            }

            function ka() {
                var a =
                    this;
                a.isPrinting || (I = a, b.isSafari || a.beforePrint(), setTimeout(function() {
                    C.focus();
                    C.print();
                    b.isSafari || setTimeout(function() {
                        a.afterPrint()
                    }, 1E3)
                }, 1))
            }

            function la() {
                var a = this,
                    b = a.options.exporting,
                    e = b.buttons,
                    d = a.isDirtyExporting || !a.exportSVGElements;
                a.buttonOffset = 0;
                a.isDirtyExporting && a.destroyExport();
                d && !1 !== b.enabled && (a.exportEvents = [], a.exportingGroup = a.exportingGroup || a.renderer.g("exporting-group").attr({
                    zIndex: 3
                }).add(), S(e, function(c) {
                    a.addButton(c)
                }), a.isDirtyExporting = !1)
            }

            function ma(a,
                b) {
                var c = a.indexOf("</svg>") + 6,
                    e = a.substr(c);
                a = a.substr(0, c);
                b && b.exporting && b.exporting.allowHTML && e && (e = '<foreignObject x="0" y="0" width="' + b.chart.width + '" height="' + b.chart.height + '"><body xmlns="http://www.w3.org/1999/xhtml">' + e.replace(/(<(?:img|br).*?(?=>))>/g, "$1 />") + "</body></foreignObject>", a = a.replace("</svg>", e + "</svg>"));
                a = a.replace(/zIndex="[^"]+"/g, "").replace(/symbolName="[^"]+"/g, "").replace(/jQuery[0-9]+="[^"]+"/g, "").replace(/url\(("|&quot;)(.*?)("|&quot;);?\)/g, "url($2)").replace(/url\([^#]+#/g,
                    "url(#").replace(/<svg /, '<svg xmlns:xlink="http://www.w3.org/1999/xlink" ').replace(/ (|NS[0-9]+:)href=/g, " xlink:href=").replace(/\n/, " ").replace(/(fill|stroke)="rgba\(([ 0-9]+,[ 0-9]+,[ 0-9]+),([ 0-9\.]+)\)"/g, '$1="rgb($2)" $1-opacity="$3"').replace(/&nbsp;/g, "\u00a0").replace(/&shy;/g, "\u00ad");
                this.ieSanitizeSVG && (a = this.ieSanitizeSVG(a));
                return a
            }
            var K = [],
                ha = [/-/, /^(clipPath|cssText|d|height|width)$/, /^font$/, /[lL]ogical(Width|Height)$/, /^parentRule$/, /perspective/, /TapHighlightColor/, /^transition/,
                    /^length$/, /^[0-9]+$/
                ],
                O = "fill stroke strokeLinecap strokeLinejoin strokeWidth textAnchor x y".split(" ");
            l.inlineAllowlist = [];
            var fa = ["clipPath", "defs", "desc"],
                I;
            l.compose = function(a, d) {
                D.compose(d);
                A.compose(a); - 1 === K.indexOf(a) && (K.push(a), d = a.prototype, d.afterPrint = x, d.exportChart = Y, d.inlineStyles = ea, d.print = ka, d.sanitizeSVG = ma, d.getChartHTML = Z, d.getSVG = ba, d.getSVGForExport = ca, d.getFilename = aa, d.moveContainers = ia, d.beforePrint = H, d.contextMenu = W, d.addButton = n, d.destroyExport = X, d.renderExporting =
                    la, d.callbacks.push(V), B(a, "init", ja), b.isSafari && b.win.matchMedia("print").addListener(function(a) {
                        I && (a.matches ? I.beforePrint() : I.afterPrint())
                    })); - 1 === K.indexOf(J) && (K.push(J), e.exporting = r(q.exporting, e.exporting), e.lang = r(q.lang, e.lang), e.navigation = r(q.navigation, e.navigation))
            }
        })(H || (H = {}));
        "";
        "";
        return H
    });
    m(a, "masters/modules/exporting.src.js", [a["Core/Globals.js"], a["Extensions/Exporting/Exporting.js"], a["Core/HttpUtilities.js"]], function(a, l, m) {
        a.HttpUtilities = m;
        a.ajax = m.ajax;
        a.getJSON =
            m.getJSON;
        a.post = m.post;
        l.compose(a.Chart, a.Renderer)
    })
});
//# sourceMappingURL=exporting.js.map
