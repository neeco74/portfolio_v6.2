function CodeRain_Utils() {
    "use strict";
    var i = this;
    this.version = function () {
        return "1.0.0"
    }
        ,
        this.isset = function (t) {
            return !(void 0 === t)
        }
        ,
        this.getInt = function (t) {
            return parseInt(t, 10)
        }
        ,
        this.random = function (t, e) {
            return this.isset(e) ? Math.floor(Math.random() * (e - t + 1) + t) : Math.floor(Math.random() * t)
        }
        ,
        this.extend = function (t, e) {
            return e
        }
        ,
        this.log = function (t, e) {
            t = "CodeRain: " + t,
                window.console && ("error" === e ? console.error(t) : "warn" === e ? console.warn(t) : console.log(t))
        }
}

var CodeRainUtils = new CodeRain_Utils;

function CodeRain_Template(rain) {
    "use strict";
    var e, i, n;

    function s(rain) {
        void 0 === rain && (rain = !0),
            rain && (e && e.resize(),
                i && i.position())
    }
    this.destroy = function () {
        e && e.destroy(),
            i && i.destroy(),
            n && n.destroy(),
            window.removeEventListener("resize", s)
    }

    rain.rain && (e = new CodeRain_RainEffect(rain.rain))

    s(!1)
    window.addEventListener("resize", s)
}



function CodeRain_RainEffect(t, e) {
    "use strict";
    void 0 === e && (e = !0);
    var i, n, o, s, r,
       
        h = CodeRainUtils.extend({}, t),
        l = document.getElementById(h.elementId),

        d = l.children[0].getContext("2d"),
        f = l.children[1],
        u = f.getContext("2d"),
        g = null,
        p = null,
        w = [],
        m = !1;

    function main() {
        
        var t, e;
        for (d.fillStyle = h.overlayColor,
            d.fillRect(0, 0, l.children[0].width, l.children[0].height),
            d.fillStyle = h.textColor,
            d.font = h.fontSize + "px " + h.font,
            h.highlightFirstChar && (u.clearRect(0, 0, f.width, f.height),
                u.font = h.fontSize + "px " + h.font),
            t = 0; t < o; t++)
            e = i[CodeRainUtils.random(n)],
                d.fillText(e, h.columnWidth * t, h.rowHeight * w[t]),
                h.highlightFirstChar && (u.fillStyle = h.highlightFirstChar,
                    u.fillText(e, h.columnWidth * t, h.rowHeight * w[t])),
                w[t] > s && 0.975 < Math.random() && (w[t] = 0),
                w[t]++;

       



    }
    this.resize = function () {
        g === l.offsetWidth && p === l.offsetHeight || (g = l.offsetWidth,
            p = l.offsetHeight,
            l.children[0].width = l.offsetWidth,
            l.children[0].height = l.offsetHeight,
            h.highlightFirstChar && (f.width = l.offsetWidth,
                f.height = l.offsetHeight),
            o = l.children[0].width / h.columnWidth,
            s = l.children[0].height / h.rowHeight,
            function () {
                var t;
                switch (h.direction) {
                    case "top-bottom":
                        for (t = 0; t < o; t++)
                            void 0 === w[t] && (w[t] = s + 1)
                }
            }())
    }

    this.start = function () {
        h.showStart || function () {
            for (var t = 0; t < 150; t++)
                main()
            
        }(),
            r = setInterval(main, h.interval),
            m = !0
    }

    this.stop = function (t) {
        clearInterval(r),
            t && this.clear(),
            m = !1
    }

    this.clear = function () {
        d.clearRect(0, 0, l.children[0].width, l.children[0].height),
            h.highlightFirstChar && u.clearRect(0, 0, f.width, f.height)
    }

    this.isPlaying = function () {
        return m
    }

    this.destroy = function () {
        this.stop(!0),
            l.children[0].width = null,
            l.children[0].height = null,
            h.highlightFirstChar && (f.width = null,
                f.height = null)
    }

    i = h.characters.split(""),
        n = i.length,
        this.resize(),
        this.start()

    function background() {
        var canvas = document.getElementById("canvas1"),
            ctx = canvas.getContext("2d");

   


        var background = new Image();
        background.src = "fond.jpg";

        
            ctx.drawImage(background, 0, 0);
        
    }
}
new CodeRain_Template({
    rain: {
            elementId: "cr-rain",
            characters: "ABCDEFGHIJKLMNOPQRSTUVWXYZΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0123456789诶比西迪伊艾弗吉艾尺艾杰开艾勒艾马艾娜哦屁吉吾艾儿艾丝提伊吾维豆贝尔维艾克斯吾艾贼德あいうえおはひふへほかきくけこまみむめもさしすせそやゆよたちつてとらりるれろなにぬねのわゐんゑをアイウエオカキクケコガギグゲゴサシスセソザジズゼゾタチツテトダヂヅデドナニヌネノハヒフヘホバビブベボパピプペポマミムメモヤユヨラリルレロワヲン",
            font: "monospace, Arial, sans-serif",
            fontSize: 12,
            columnWidth: 18,
            rowHeight: 12,
            textColor: "#ACD7FF",
            overlayColor: "rgba(0, 0, 0, 0.04)",
            highlightFirstChar: "rgba(255, 255, 255, 0.9)",
            interval: 70,
            direction: "top-bottom",
            showStart: !1
    },
    /*rain_green a supprimer: {
        elementId: "cr-rain",
        characters: "诶比西迪伊艾弗吉艾尺艾杰开艾勒艾马艾娜哦屁吉吾艾儿艾丝提伊吾维豆贝尔维艾克斯吾艾贼德あいうえおはひふへほかきくけこまみむめもさしすせそやゆよたちつてとらりるれろなにぬねのわゐんゑをアイウエオカキクケコガギグゲゴサシスセソザジズゼゾタチツテトダヂヅデドナニヌネノハヒフヘホバビブベボパピプペポマミムメモヤユヨラリルレロワヲン",
        font: "Arial, sans-serif",
        fontSize: 8,
        columnWidth: 8,
        rowHeight: 8,
        textColor: "#52FF52",
        overlayColor: "rgba(0, 0, 0, 0.04)",
        highlightFirstChar: "rgba(255, 255, 255, 0.8)",
        interval: 50,
        direction: "top-bottom",
        showStart: !1
    },
    contextMessage: {
        elementId: "cr-context-message",
        textEffect: {
            message: "Code_Rain by CreativeTier",
            characters: "ABCDEFGHIJKLMNOPQRSTUVWXYZΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ0123456789",
            wrappers: ["[", "]"],
            pendingColor: "#5B9855",
            highlightChar: "#B1FFB1",
            effect: 1,
            interval: 50,
            pendingTicks: 20,
            characterTicks: 1,
            replay: !1,
            link: {
                url: "http://www.creativetier.com/codecanyon/code-rain-js-js",
                target: "_blank"
            }
        }
    }*/
});