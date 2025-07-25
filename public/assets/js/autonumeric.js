/**
 * AutoNumeric.js v4.8.1
 * © 2016-2023 Alexandre Bonneau <alexandre.bonneau@linuxfr.eu>
 * © 2009-2016 Bob Knothe <bob@decorplanit.com>
 * Released under the MIT License.
 * See https://docs.autonumeric.org
 */
var e, t;
(e = this),
    (t = () =>
        (() => {
            var e = {
                    d: (t, i) => {
                        for (var n in i)
                            e.o(i, n) &&
                                !e.o(t, n) &&
                                Object.defineProperty(t, n, {
                                    enumerable: !0,
                                    get: i[n],
                                });
                    },
                    o: (e, t) => Object.prototype.hasOwnProperty.call(e, t),
                },
                t = {};
            e.d(t, { default: () => ue });
            var i = {
                allowedTagList: [
                    "b",
                    "caption",
                    "cite",
                    "code",
                    "const",
                    "dd",
                    "del",
                    "div",
                    "dfn",
                    "dt",
                    "em",
                    "h1",
                    "h2",
                    "h3",
                    "h4",
                    "h5",
                    "h6",
                    "input",
                    "ins",
                    "kdb",
                    "label",
                    "li",
                    "option",
                    "output",
                    "p",
                    "q",
                    "s",
                    "sample",
                    "span",
                    "strong",
                    "td",
                    "th",
                    "u",
                ],
            };
            Object.freeze(i.allowedTagList),
                Object.defineProperty(i, "allowedTagList", {
                    configurable: !1,
                    writable: !1,
                }),
                (i.keyCode = {
                    Backspace: 8,
                    Tab: 9,
                    Enter: 13,
                    Shift: 16,
                    Ctrl: 17,
                    Alt: 18,
                    Pause: 19,
                    CapsLock: 20,
                    Esc: 27,
                    Space: 32,
                    PageUp: 33,
                    PageDown: 34,
                    End: 35,
                    Home: 36,
                    LeftArrow: 37,
                    UpArrow: 38,
                    RightArrow: 39,
                    DownArrow: 40,
                    Insert: 45,
                    Delete: 46,
                    num0: 48,
                    num1: 49,
                    num2: 50,
                    num3: 51,
                    num4: 52,
                    num5: 53,
                    num6: 54,
                    num7: 55,
                    num8: 56,
                    num9: 57,
                    a: 65,
                    b: 66,
                    c: 67,
                    d: 68,
                    e: 69,
                    f: 70,
                    g: 71,
                    h: 72,
                    i: 73,
                    j: 74,
                    k: 75,
                    l: 76,
                    m: 77,
                    n: 78,
                    o: 79,
                    p: 80,
                    q: 81,
                    r: 82,
                    s: 83,
                    t: 84,
                    u: 85,
                    v: 86,
                    w: 87,
                    x: 88,
                    y: 89,
                    z: 90,
                    OSLeft: 91,
                    OSRight: 92,
                    ContextMenu: 93,
                    numpad0: 96,
                    numpad1: 97,
                    numpad2: 98,
                    numpad3: 99,
                    numpad4: 100,
                    numpad5: 101,
                    numpad6: 102,
                    numpad7: 103,
                    numpad8: 104,
                    numpad9: 105,
                    MultiplyNumpad: 106,
                    PlusNumpad: 107,
                    MinusNumpad: 109,
                    DotNumpad: 110,
                    SlashNumpad: 111,
                    F1: 112,
                    F2: 113,
                    F3: 114,
                    F4: 115,
                    F5: 116,
                    F6: 117,
                    F7: 118,
                    F8: 119,
                    F9: 120,
                    F10: 121,
                    F11: 122,
                    F12: 123,
                    NumLock: 144,
                    ScrollLock: 145,
                    HyphenFirefox: 173,
                    MyComputer: 182,
                    MyCalculator: 183,
                    Semicolon: 186,
                    Equal: 187,
                    Comma: 188,
                    Hyphen: 189,
                    Dot: 190,
                    Slash: 191,
                    Backquote: 192,
                    LeftBracket: 219,
                    Backslash: 220,
                    RightBracket: 221,
                    Quote: 222,
                    Command: 224,
                    AltGraph: 225,
                    AndroidDefault: 229,
                }),
                Object.freeze(i.keyCode),
                Object.defineProperty(i, "keyCode", {
                    configurable: !1,
                    writable: !1,
                }),
                (i.fromCharCodeKeyCode = {
                    0: "LaunchCalculator",
                    8: "Backspace",
                    9: "Tab",
                    13: "Enter",
                    16: "Shift",
                    17: "Ctrl",
                    18: "Alt",
                    19: "Pause",
                    20: "CapsLock",
                    27: "Escape",
                    32: " ",
                    33: "PageUp",
                    34: "PageDown",
                    35: "End",
                    36: "Home",
                    37: "ArrowLeft",
                    38: "ArrowUp",
                    39: "ArrowRight",
                    40: "ArrowDown",
                    45: "Insert",
                    46: "Delete",
                    48: "0",
                    49: "1",
                    50: "2",
                    51: "3",
                    52: "4",
                    53: "5",
                    54: "6",
                    55: "7",
                    56: "8",
                    57: "9",
                    91: "OS",
                    92: "OSRight",
                    93: "ContextMenu",
                    96: "0",
                    97: "1",
                    98: "2",
                    99: "3",
                    100: "4",
                    101: "5",
                    102: "6",
                    103: "7",
                    104: "8",
                    105: "9",
                    106: "*",
                    107: "+",
                    109: "-",
                    110: ".",
                    111: "/",
                    112: "F1",
                    113: "F2",
                    114: "F3",
                    115: "F4",
                    116: "F5",
                    117: "F6",
                    118: "F7",
                    119: "F8",
                    120: "F9",
                    121: "F10",
                    122: "F11",
                    123: "F12",
                    144: "NumLock",
                    145: "ScrollLock",
                    173: "-",
                    182: "MyComputer",
                    183: "MyCalculator",
                    186: ";",
                    187: "=",
                    188: ",",
                    189: "-",
                    190: ".",
                    191: "/",
                    192: "`",
                    219: "[",
                    220: "\\",
                    221: "]",
                    222: "'",
                    224: "Meta",
                    225: "AltGraph",
                }),
                Object.freeze(i.fromCharCodeKeyCode),
                Object.defineProperty(i, "fromCharCodeKeyCode", {
                    configurable: !1,
                    writable: !1,
                }),
                (i.keyName = {
                    Unidentified: "Unidentified",
                    AndroidDefault: "AndroidDefault",
                    Alt: "Alt",
                    AltGr: "AltGraph",
                    CapsLock: "CapsLock",
                    Ctrl: "Control",
                    Fn: "Fn",
                    FnLock: "FnLock",
                    Hyper: "Hyper",
                    Meta: "Meta",
                    OSLeft: "OS",
                    OSRight: "OS",
                    Command: "OS",
                    NumLock: "NumLock",
                    ScrollLock: "ScrollLock",
                    Shift: "Shift",
                    Super: "Super",
                    Symbol: "Symbol",
                    SymbolLock: "SymbolLock",
                    Enter: "Enter",
                    Tab: "Tab",
                    Space: " ",
                    LeftArrow: "ArrowLeft",
                    UpArrow: "ArrowUp",
                    RightArrow: "ArrowRight",
                    DownArrow: "ArrowDown",
                    End: "End",
                    Home: "Home",
                    PageUp: "PageUp",
                    PageDown: "PageDown",
                    Backspace: "Backspace",
                    Clear: "Clear",
                    Copy: "Copy",
                    CrSel: "CrSel",
                    Cut: "Cut",
                    Delete: "Delete",
                    EraseEof: "EraseEof",
                    ExSel: "ExSel",
                    Insert: "Insert",
                    Paste: "Paste",
                    Redo: "Redo",
                    Undo: "Undo",
                    Accept: "Accept",
                    Again: "Again",
                    Attn: "Attn",
                    Cancel: "Cancel",
                    ContextMenu: "ContextMenu",
                    Esc: "Escape",
                    Execute: "Execute",
                    Find: "Find",
                    Finish: "Finish",
                    Help: "Help",
                    Pause: "Pause",
                    Play: "Play",
                    Props: "Props",
                    Select: "Select",
                    ZoomIn: "ZoomIn",
                    ZoomOut: "ZoomOut",
                    BrightnessDown: "BrightnessDown",
                    BrightnessUp: "BrightnessUp",
                    Eject: "Eject",
                    LogOff: "LogOff",
                    Power: "Power",
                    PowerOff: "PowerOff",
                    PrintScreen: "PrintScreen",
                    Hibernate: "Hibernate",
                    Standby: "Standby",
                    WakeUp: "WakeUp",
                    Compose: "Compose",
                    Dead: "Dead",
                    F1: "F1",
                    F2: "F2",
                    F3: "F3",
                    F4: "F4",
                    F5: "F5",
                    F6: "F6",
                    F7: "F7",
                    F8: "F8",
                    F9: "F9",
                    F10: "F10",
                    F11: "F11",
                    F12: "F12",
                    Print: "Print",
                    num0: "0",
                    num1: "1",
                    num2: "2",
                    num3: "3",
                    num4: "4",
                    num5: "5",
                    num6: "6",
                    num7: "7",
                    num8: "8",
                    num9: "9",
                    a: "a",
                    b: "b",
                    c: "c",
                    d: "d",
                    e: "e",
                    f: "f",
                    g: "g",
                    h: "h",
                    i: "i",
                    j: "j",
                    k: "k",
                    l: "l",
                    m: "m",
                    n: "n",
                    o: "o",
                    p: "p",
                    q: "q",
                    r: "r",
                    s: "s",
                    t: "t",
                    u: "u",
                    v: "v",
                    w: "w",
                    x: "x",
                    y: "y",
                    z: "z",
                    A: "A",
                    B: "B",
                    C: "C",
                    D: "D",
                    E: "E",
                    F: "F",
                    G: "G",
                    H: "H",
                    I: "I",
                    J: "J",
                    K: "K",
                    L: "L",
                    M: "M",
                    N: "N",
                    O: "O",
                    P: "P",
                    Q: "Q",
                    R: "R",
                    S: "S",
                    T: "T",
                    U: "U",
                    V: "V",
                    W: "W",
                    X: "X",
                    Y: "Y",
                    Z: "Z",
                    Semicolon: ";",
                    Equal: "=",
                    Comma: ",",
                    Hyphen: "-",
                    Minus: "-",
                    Plus: "+",
                    Dot: ".",
                    Slash: "/",
                    Backquote: "`",
                    LeftParenthesis: "(",
                    RightParenthesis: ")",
                    LeftBracket: "[",
                    RightBracket: "]",
                    Backslash: "\\",
                    Quote: "'",
                    numpad0: "0",
                    numpad1: "1",
                    numpad2: "2",
                    numpad3: "3",
                    numpad4: "4",
                    numpad5: "5",
                    numpad6: "6",
                    numpad7: "7",
                    numpad8: "8",
                    numpad9: "9",
                    NumpadDot: ".",
                    NumpadDotAlt: ",",
                    NumpadMultiply: "*",
                    NumpadPlus: "+",
                    NumpadMinus: "-",
                    NumpadSubtract: "-",
                    NumpadSlash: "/",
                    NumpadDotObsoleteBrowsers: "Decimal",
                    NumpadMultiplyObsoleteBrowsers: "Multiply",
                    NumpadPlusObsoleteBrowsers: "Add",
                    NumpadMinusObsoleteBrowsers: "Subtract",
                    NumpadSlashObsoleteBrowsers: "Divide",
                    _allFnKeys: [
                        "F1",
                        "F2",
                        "F3",
                        "F4",
                        "F5",
                        "F6",
                        "F7",
                        "F8",
                        "F9",
                        "F10",
                        "F11",
                        "F12",
                    ],
                    _someNonPrintableKeys: [
                        "Tab",
                        "Enter",
                        "Shift",
                        "ShiftLeft",
                        "ShiftRight",
                        "Control",
                        "ControlLeft",
                        "ControlRight",
                        "Alt",
                        "AltLeft",
                        "AltRight",
                        "Pause",
                        "CapsLock",
                        "Escape",
                    ],
                    _directionKeys: [
                        "PageUp",
                        "PageDown",
                        "End",
                        "Home",
                        "ArrowDown",
                        "ArrowLeft",
                        "ArrowRight",
                        "ArrowUp",
                    ],
                }),
                Object.freeze(i.keyName._allFnKeys),
                Object.freeze(i.keyName._someNonPrintableKeys),
                Object.freeze(i.keyName._directionKeys),
                Object.freeze(i.keyName),
                Object.defineProperty(i, "keyName", {
                    configurable: !1,
                    writable: !1,
                }),
                Object.freeze(i);
            const n = i;
            function a(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return l(e);
                    })(e) ||
                    (function (e) {
                        if (
                            ("undefined" != typeof Symbol &&
                                null != e[Symbol.iterator]) ||
                            null != e["@@iterator"]
                        )
                            return Array.from(e);
                    })(e) ||
                    s(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function r() {
                return (
                    (r = Object.assign
                        ? Object.assign.bind()
                        : function (e) {
                              for (var t = 1; t < arguments.length; t++) {
                                  var i = arguments[t];
                                  for (var n in i)
                                      Object.prototype.hasOwnProperty.call(
                                          i,
                                          n
                                      ) && (e[n] = i[n]);
                              }
                              return e;
                          }),
                    r.apply(this, arguments)
                );
            }
            function o(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        var i =
                            null == e
                                ? null
                                : ("undefined" != typeof Symbol &&
                                      e[Symbol.iterator]) ||
                                  e["@@iterator"];
                        if (null != i) {
                            var n,
                                a,
                                r,
                                o,
                                s = [],
                                l = !0,
                                u = !1;
                            try {
                                if (((r = (i = i.call(e)).next), 0 === t)) {
                                    if (Object(i) !== i) return;
                                    l = !1;
                                } else
                                    for (
                                        ;
                                        !(l = (n = r.call(i)).done) &&
                                        (s.push(n.value), s.length !== t);
                                        l = !0
                                    );
                            } catch (c) {
                                (u = !0), (a = c);
                            } finally {
                                try {
                                    if (
                                        !l &&
                                        null != i.return &&
                                        ((o = i.return()), Object(o) !== o)
                                    )
                                        return;
                                } finally {
                                    if (u) throw a;
                                }
                            }
                            return s;
                        }
                    })(e, t) ||
                    s(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function s(e, t) {
                if (e) {
                    if ("string" == typeof e) return l(e, t);
                    var i = Object.prototype.toString.call(e).slice(8, -1);
                    return (
                        "Object" === i &&
                            e.constructor &&
                            (i = e.constructor.name),
                        "Map" === i || "Set" === i
                            ? Array.from(e)
                            : "Arguments" === i ||
                              /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i)
                            ? l(e, t)
                            : void 0
                    );
                }
            }
            function l(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var i = 0, n = new Array(t); i < t; i++) n[i] = e[i];
                return n;
            }
            function u(e) {
                return (
                    (u =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    u(e)
                );
            }
            function c(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(
                            e,
                            ((a = n.key),
                            (r = void 0),
                            (r = (function (e, t) {
                                if ("object" !== u(e) || null === e) return e;
                                var i = e[Symbol.toPrimitive];
                                if (void 0 !== i) {
                                    var n = i.call(e, t || "default");
                                    if ("object" !== u(n)) return n;
                                    throw new TypeError(
                                        "@@toPrimitive must return a primitive value."
                                    );
                                }
                                return ("string" === t ? String : Number)(e);
                            })(a, "string")),
                            "symbol" === u(r) ? r : String(r)),
                            n
                        );
                }
                var a, r;
            }
            var h = (function () {
                function e() {
                    !(function (e, t) {
                        if (!(e instanceof t))
                            throw new TypeError(
                                "Cannot call a class as a function"
                            );
                    })(this, e);
                }
                var t, i, s;
                return (
                    (t = e),
                    (s = [
                        {
                            key: "isNull",
                            value: function (e) {
                                return null === e;
                            },
                        },
                        {
                            key: "isUndefined",
                            value: function (e) {
                                return void 0 === e;
                            },
                        },
                        {
                            key: "isUndefinedOrNullOrEmpty",
                            value: function (e) {
                                return null == e || "" === e;
                            },
                        },
                        {
                            key: "isString",
                            value: function (e) {
                                return (
                                    "string" == typeof e || e instanceof String
                                );
                            },
                        },
                        {
                            key: "isEmptyString",
                            value: function (e) {
                                return "" === e;
                            },
                        },
                        {
                            key: "isBoolean",
                            value: function (e) {
                                return "boolean" == typeof e;
                            },
                        },
                        {
                            key: "isTrueOrFalseString",
                            value: function (e) {
                                var t = String(e).toLowerCase();
                                return "true" === t || "false" === t;
                            },
                        },
                        {
                            key: "isObject",
                            value: function (e) {
                                return (
                                    "object" === u(e) &&
                                    null !== e &&
                                    !Array.isArray(e)
                                );
                            },
                        },
                        {
                            key: "isEmptyObj",
                            value: function (e) {
                                for (var t in e)
                                    if (
                                        Object.prototype.hasOwnProperty.call(
                                            e,
                                            t
                                        )
                                    )
                                        return !1;
                                return !0;
                            },
                        },
                        {
                            key: "isNumberStrict",
                            value: function (e) {
                                return "number" == typeof e;
                            },
                        },
                        {
                            key: "isNumber",
                            value: function (e) {
                                return (
                                    !this.isArray(e) &&
                                    !isNaN(parseFloat(e)) &&
                                    isFinite(e)
                                );
                            },
                        },
                        {
                            key: "isDigit",
                            value: function (e) {
                                return /\d/.test(e);
                            },
                        },
                        {
                            key: "isNumberOrArabic",
                            value: function (e) {
                                var t = this.arabicToLatinNumbers(
                                    e,
                                    !1,
                                    !0,
                                    !0
                                );
                                return this.isNumber(t);
                            },
                        },
                        {
                            key: "isInt",
                            value: function (e) {
                                return (
                                    "number" == typeof e &&
                                    parseFloat(e) === parseInt(e, 10) &&
                                    !isNaN(e)
                                );
                            },
                        },
                        {
                            key: "isFunction",
                            value: function (e) {
                                return "function" == typeof e;
                            },
                        },
                        {
                            key: "isIE11",
                            value: function () {
                                return (
                                    "undefined" != typeof window &&
                                    !!window.MSInputMethodContext &&
                                    !!document.documentMode
                                );
                            },
                        },
                        {
                            key: "contains",
                            value: function (e, t) {
                                return (
                                    !(
                                        !this.isString(e) ||
                                        !this.isString(t) ||
                                        "" === e ||
                                        "" === t
                                    ) && -1 !== e.indexOf(t)
                                );
                            },
                        },
                        {
                            key: "isInArray",
                            value: function (e, t) {
                                return (
                                    !(
                                        !this.isArray(t) ||
                                        t === [] ||
                                        this.isUndefined(e)
                                    ) && -1 !== t.indexOf(e)
                                );
                            },
                        },
                        {
                            key: "isArray",
                            value: function (e) {
                                if (
                                    "[object Array]" ===
                                    Object.prototype.toString.call([])
                                )
                                    return (
                                        Array.isArray(e) ||
                                        ("object" === u(e) &&
                                            "[object Array]" ===
                                                Object.prototype.toString.call(
                                                    e
                                                ))
                                    );
                                throw new Error(
                                    "toString message changed for Object Array"
                                );
                            },
                        },
                        {
                            key: "isElement",
                            value: function (e) {
                                return (
                                    "undefined" != typeof Element &&
                                    e instanceof Element
                                );
                            },
                        },
                        {
                            key: "isInputElement",
                            value: function (e) {
                                return (
                                    this.isElement(e) &&
                                    "input" === e.tagName.toLowerCase()
                                );
                            },
                        },
                        {
                            key: "decimalPlaces",
                            value: function (e) {
                                var t = o(e.split("."), 2)[1];
                                return this.isUndefined(t) ? 0 : t.length;
                            },
                        },
                        {
                            key: "indexFirstNonZeroDecimalPlace",
                            value: function (e) {
                                var t = o(String(Math.abs(e)).split("."), 2)[1];
                                if (this.isUndefined(t)) return 0;
                                var i = t.lastIndexOf("0");
                                return -1 === i ? (i = 0) : (i += 2), i;
                            },
                        },
                        {
                            key: "keyCodeNumber",
                            value: function (e) {
                                return void 0 === e.which ? e.keyCode : e.which;
                            },
                        },
                        {
                            key: "character",
                            value: function (t) {
                                var i;
                                if (
                                    "Unidentified" === t.key ||
                                    void 0 === t.key ||
                                    this.isSeleniumBot()
                                ) {
                                    var a = this.keyCodeNumber(t);
                                    if (a === n.keyCode.AndroidDefault)
                                        return n.keyName.AndroidDefault;
                                    var r = n.fromCharCodeKeyCode[a];
                                    i = e.isUndefinedOrNullOrEmpty(r)
                                        ? String.fromCharCode(a)
                                        : r;
                                } else {
                                    var o;
                                    switch (t.key) {
                                        case "Add":
                                            i = n.keyName.NumpadPlus;
                                            break;
                                        case "Apps":
                                            i = n.keyName.ContextMenu;
                                            break;
                                        case "Crsel":
                                            i = n.keyName.CrSel;
                                            break;
                                        case "Decimal":
                                            i = t.char
                                                ? t.char
                                                : n.keyName.NumpadDot;
                                            break;
                                        case "Del":
                                            i =
                                                ("firefox" ===
                                                    (o = this.browser()).name &&
                                                    o.version <= 36) ||
                                                ("ie" === o.name &&
                                                    o.version <= 9)
                                                    ? n.keyName.Dot
                                                    : n.keyName.Delete;
                                            break;
                                        case "Divide":
                                            i = n.keyName.NumpadSlash;
                                            break;
                                        case "Down":
                                            i = n.keyName.DownArrow;
                                            break;
                                        case "Esc":
                                            i = n.keyName.Esc;
                                            break;
                                        case "Exsel":
                                            i = n.keyName.ExSel;
                                            break;
                                        case "Left":
                                            i = n.keyName.LeftArrow;
                                            break;
                                        case "Meta":
                                        case "Super":
                                            i = n.keyName.OSLeft;
                                            break;
                                        case "Multiply":
                                            i = n.keyName.NumpadMultiply;
                                            break;
                                        case "Right":
                                            i = n.keyName.RightArrow;
                                            break;
                                        case "Spacebar":
                                            i = n.keyName.Space;
                                            break;
                                        case "Subtract":
                                            i = n.keyName.NumpadMinus;
                                            break;
                                        case "Up":
                                            i = n.keyName.UpArrow;
                                            break;
                                        default:
                                            i = t.key;
                                    }
                                }
                                return i;
                            },
                        },
                        {
                            key: "browser",
                            value: function () {
                                var e,
                                    t = navigator.userAgent,
                                    i =
                                        t.match(
                                            /(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i
                                        ) || [];
                                return /trident/i.test(i[1])
                                    ? {
                                          name: "ie",
                                          version:
                                              (e =
                                                  /\brv[ :]+(\d+)/g.exec(t) ||
                                                  [])[1] || "",
                                      }
                                    : "Chrome" === i[1] &&
                                      null !==
                                          (e = t.match(/\b(OPR|Edge)\/(\d+)/))
                                    ? {
                                          name: e[1].replace("OPR", "opera"),
                                          version: e[2],
                                      }
                                    : ((i = i[2]
                                          ? [i[1], i[2]]
                                          : [
                                                navigator.appName,
                                                navigator.appVersion,
                                                "-?",
                                            ]),
                                      null !==
                                          (e = t.match(/version\/(\d+)/i)) &&
                                          i.splice(1, 1, e[1]),
                                      {
                                          name: i[0].toLowerCase(),
                                          version: i[1],
                                      });
                            },
                        },
                        {
                            key: "isSeleniumBot",
                            value: function () {
                                return !0 === window.navigator.webdriver;
                            },
                        },
                        {
                            key: "isNegative",
                            value: function (t) {
                                var i =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : "-",
                                    n =
                                        !(
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                        ) || arguments[2];
                                return (
                                    t === i ||
                                    ("" !== t &&
                                        (e.isNumber(t)
                                            ? t < 0
                                            : n
                                            ? this.contains(t, i)
                                            : this.isNegativeStrict(t, i)))
                                );
                            },
                        },
                        {
                            key: "isNegativeStrict",
                            value: function (e) {
                                var t =
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1]
                                        ? arguments[1]
                                        : "-";
                                return e.charAt(0) === t;
                            },
                        },
                        {
                            key: "isNegativeWithBrackets",
                            value: function (e, t, i) {
                                return e.charAt(0) === t && this.contains(e, i);
                            },
                        },
                        {
                            key: "isZeroOrHasNoValue",
                            value: function (e) {
                                return !/[1-9]/g.test(e);
                            },
                        },
                        {
                            key: "setRawNegativeSign",
                            value: function (e) {
                                return this.isNegativeStrict(e, "-")
                                    ? e
                                    : "-".concat(e);
                            },
                        },
                        {
                            key: "replaceCharAt",
                            value: function (e, t, i) {
                                return ""
                                    .concat(e.substr(0, t))
                                    .concat(i)
                                    .concat(e.substr(t + i.length));
                            },
                        },
                        {
                            key: "clampToRangeLimits",
                            value: function (e, t) {
                                return Math.max(
                                    t.minimumValue,
                                    Math.min(t.maximumValue, e)
                                );
                            },
                        },
                        {
                            key: "countNumberCharactersOnTheCaretLeftSide",
                            value: function (e, t, i) {
                                for (
                                    var n = new RegExp("[0-9".concat(i, "-]")),
                                        a = 0,
                                        r = 0;
                                    r < t;
                                    r++
                                )
                                    n.test(e[r]) && a++;
                                return a;
                            },
                        },
                        {
                            key: "findCaretPositionInFormattedNumber",
                            value: function (e, t, i, n) {
                                var a,
                                    r = i.length,
                                    o = e.length,
                                    s = 0;
                                for (a = 0; a < r && s < o && s < t; a++)
                                    (e[s] === i[a] ||
                                        ("." === e[s] && i[a] === n)) &&
                                        s++;
                                return a;
                            },
                        },
                        {
                            key: "countCharInText",
                            value: function (e, t) {
                                for (var i = 0, n = 0; n < t.length; n++)
                                    t[n] === e && i++;
                                return i;
                            },
                        },
                        {
                            key: "convertCharacterCountToIndexPosition",
                            value: function (e) {
                                return Math.max(e, e - 1);
                            },
                        },
                        {
                            key: "getElementSelection",
                            value: function (e) {
                                var t,
                                    i = {};
                                try {
                                    t = this.isUndefined(e.selectionStart);
                                } catch (a) {
                                    t = !1;
                                }
                                try {
                                    if (t) {
                                        var n = window
                                            .getSelection()
                                            .getRangeAt(0);
                                        (i.start = n.startOffset),
                                            (i.end = n.endOffset),
                                            (i.length = i.end - i.start);
                                    } else
                                        (i.start = e.selectionStart),
                                            (i.end = e.selectionEnd),
                                            (i.length = i.end - i.start);
                                } catch (a) {
                                    (i.start = 0), (i.end = 0), (i.length = 0);
                                }
                                return i;
                            },
                        },
                        {
                            key: "setElementSelection",
                            value: function (t, i) {
                                var n =
                                    arguments.length > 2 &&
                                    void 0 !== arguments[2]
                                        ? arguments[2]
                                        : null;
                                if (
                                    (this.isUndefinedOrNullOrEmpty(n) &&
                                        (n = i),
                                    this.isInputElement(t))
                                )
                                    t.setSelectionRange(i, n);
                                else if (!e.isNull(t.firstChild)) {
                                    var a = document.createRange();
                                    a.setStart(t.firstChild, i),
                                        a.setEnd(t.firstChild, n);
                                    var r = window.getSelection();
                                    r.removeAllRanges(), r.addRange(a);
                                }
                            },
                        },
                        {
                            key: "throwError",
                            value: function (e) {
                                throw new Error(e);
                            },
                        },
                        {
                            key: "warning",
                            value: function (e) {
                                (!(
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1]
                                ) ||
                                    arguments[1]) &&
                                    console.warn("Warning: ".concat(e));
                            },
                        },
                        {
                            key: "isWheelEvent",
                            value: function (e) {
                                return e instanceof WheelEvent;
                            },
                        },
                        {
                            key: "isWheelUpEvent",
                            value: function (e) {
                                return (
                                    (this.isWheelEvent(e) &&
                                        !this.isUndefinedOrNullOrEmpty(
                                            e.deltaY
                                        )) ||
                                        this.throwError(
                                            "The event passed as a parameter is not a valid wheel event, '".concat(
                                                e.type,
                                                "' given."
                                            )
                                        ),
                                    e.deltaY < 0
                                );
                            },
                        },
                        {
                            key: "isWheelDownEvent",
                            value: function (e) {
                                return (
                                    (this.isWheelEvent(e) &&
                                        !this.isUndefinedOrNullOrEmpty(
                                            e.deltaY
                                        )) ||
                                        this.throwError(
                                            "The event passed as a parameter is not a valid wheel event, '".concat(
                                                e.type,
                                                "' given."
                                            )
                                        ),
                                    e.deltaY > 0
                                );
                            },
                        },
                        {
                            key: "forceDecimalPlaces",
                            value: function (e, t) {
                                var i = o(String(e).split("."), 2),
                                    n = i[0],
                                    a = i[1];
                                return a
                                    ? "".concat(n, ".").concat(a.substr(0, t))
                                    : e;
                            },
                        },
                        {
                            key: "roundToNearest",
                            value: function (e) {
                                var t =
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1]
                                        ? arguments[1]
                                        : 1e3;
                                return 0 === e
                                    ? 0
                                    : (0 === t &&
                                          this.throwError(
                                              "The `stepPlace` used to round is equal to `0`. This value must not be equal to zero."
                                          ),
                                      Math.round(e / t) * t);
                            },
                        },
                        {
                            key: "modifyAndRoundToNearestAuto",
                            value: function (e, t, i) {
                                e = Number(this.forceDecimalPlaces(e, i));
                                var n = Math.abs(e);
                                if (n >= 0 && n < 1) {
                                    var a,
                                        r = Math.pow(10, -i);
                                    if (0 === e) return t ? r : -r;
                                    var o,
                                        s = i,
                                        l =
                                            this.indexFirstNonZeroDecimalPlace(
                                                e
                                            );
                                    return (
                                        (a =
                                            l >= s - 1
                                                ? r
                                                : Math.pow(10, -(l + 1))),
                                        (o = t ? e + a : e - a),
                                        this.roundToNearest(o, a)
                                    );
                                }
                                e = parseInt(e, 10);
                                var u,
                                    c = Math.abs(e).toString().length;
                                switch (c) {
                                    case 1:
                                        u = 0;
                                        break;
                                    case 2:
                                    case 3:
                                        u = 1;
                                        break;
                                    case 4:
                                    case 5:
                                        u = 2;
                                        break;
                                    default:
                                        u = c - 3;
                                }
                                var h,
                                    m = Math.pow(10, u);
                                return (h = t ? e + m : e - m) <= 10 && h >= -10
                                    ? h
                                    : this.roundToNearest(h, m);
                            },
                        },
                        {
                            key: "addAndRoundToNearestAuto",
                            value: function (e, t) {
                                return this.modifyAndRoundToNearestAuto(
                                    e,
                                    !0,
                                    t
                                );
                            },
                        },
                        {
                            key: "subtractAndRoundToNearestAuto",
                            value: function (e, t) {
                                return this.modifyAndRoundToNearestAuto(
                                    e,
                                    !1,
                                    t
                                );
                            },
                        },
                        {
                            key: "arabicToLatinNumbers",
                            value: function (e) {
                                var t =
                                        !(
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                        ) || arguments[1],
                                    i =
                                        arguments.length > 2 &&
                                        void 0 !== arguments[2] &&
                                        arguments[2],
                                    n =
                                        arguments.length > 3 &&
                                        void 0 !== arguments[3] &&
                                        arguments[3];
                                if (this.isNull(e)) return e;
                                var a = e.toString();
                                if ("" === a) return e;
                                if (null === a.match(/[٠١٢٣٤٥٦٧٨٩۴۵۶]/g))
                                    return t && (a = Number(a)), a;
                                i && (a = a.replace(/٫/, ".")),
                                    n && (a = a.replace(/٬/g, "")),
                                    (a = a
                                        .replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (e) {
                                            return e.charCodeAt(0) - 1632;
                                        })
                                        .replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (e) {
                                            return e.charCodeAt(0) - 1776;
                                        }));
                                var r = Number(a);
                                return isNaN(r) ? r : (t && (a = r), a);
                            },
                        },
                        {
                            key: "triggerEvent",
                            value: function (e) {
                                var t,
                                    i =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : document,
                                    n =
                                        arguments.length > 2 &&
                                        void 0 !== arguments[2]
                                            ? arguments[2]
                                            : null,
                                    a =
                                        !(
                                            arguments.length > 3 &&
                                            void 0 !== arguments[3]
                                        ) || arguments[3],
                                    r =
                                        !(
                                            arguments.length > 4 &&
                                            void 0 !== arguments[4]
                                        ) || arguments[4];
                                window.CustomEvent
                                    ? (t = new CustomEvent(e, {
                                          detail: n,
                                          bubbles: a,
                                          cancelable: r,
                                      }))
                                    : (t =
                                          document.createEvent(
                                              "CustomEvent"
                                          )).initCustomEvent(e, a, r, {
                                          detail: n,
                                      }),
                                    i.dispatchEvent(t);
                            },
                        },
                        {
                            key: "parseStr",
                            value: function (e) {
                                var t,
                                    i,
                                    n,
                                    a,
                                    r = {};
                                if (
                                    (0 === e && 1 / e < 0 && (e = "-0"),
                                    (e = e.toString()),
                                    this.isNegativeStrict(e, "-")
                                        ? ((e = e.slice(1)), (r.s = -1))
                                        : (r.s = 1),
                                    (t = e.indexOf(".")) > -1 &&
                                        (e = e.replace(".", "")),
                                    t < 0 && (t = e.length),
                                    (i =
                                        -1 === e.search(/[1-9]/i)
                                            ? e.length
                                            : e.search(/[1-9]/i)) ===
                                        (n = e.length))
                                )
                                    (r.e = 0), (r.c = [0]);
                                else {
                                    for (a = n - 1; "0" === e.charAt(a); a -= 1)
                                        n -= 1;
                                    for (
                                        n -= 1,
                                            r.e = t - i - 1,
                                            r.c = [],
                                            t = 0;
                                        i <= n;
                                        i += 1
                                    )
                                        (r.c[t] = +e.charAt(i)), (t += 1);
                                }
                                return r;
                            },
                        },
                        {
                            key: "testMinMax",
                            value: function (e, t) {
                                var i = t.c,
                                    n = e.c,
                                    a = t.s,
                                    r = e.s,
                                    o = t.e,
                                    s = e.e;
                                if (!i[0] || !n[0])
                                    return i[0] ? a : n[0] ? -r : 0;
                                if (a !== r) return a;
                                var l = a < 0;
                                if (o !== s) return (o > s) ^ l ? 1 : -1;
                                for (
                                    a = -1,
                                        r =
                                            (o = i.length) < (s = n.length)
                                                ? o
                                                : s,
                                        a += 1;
                                    a < r;
                                    a += 1
                                )
                                    if (i[a] !== n[a])
                                        return (i[a] > n[a]) ^ l ? 1 : -1;
                                return o === s ? 0 : (o > s) ^ l ? 1 : -1;
                            },
                        },
                        {
                            key: "randomString",
                            value: function () {
                                var e =
                                    arguments.length > 0 &&
                                    void 0 !== arguments[0]
                                        ? arguments[0]
                                        : 5;
                                return Math.random().toString(36).substr(2, e);
                            },
                        },
                        {
                            key: "domElement",
                            value: function (t) {
                                var i;
                                return (
                                    (i = e.isString(t)
                                        ? document.querySelector(t)
                                        : t),
                                    i
                                );
                            },
                        },
                        {
                            key: "getElementValue",
                            value: function (e) {
                                return "input" === e.tagName.toLowerCase()
                                    ? e.value
                                    : this.text(e);
                            },
                        },
                        {
                            key: "setElementValue",
                            value: function (e) {
                                var t =
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1]
                                        ? arguments[1]
                                        : null;
                                "input" === e.tagName.toLowerCase()
                                    ? (e.value = t)
                                    : (e.textContent = t);
                            },
                        },
                        {
                            key: "setInvalidState",
                            value: function (e) {
                                var t =
                                    arguments.length > 1 &&
                                    void 0 !== arguments[1]
                                        ? arguments[1]
                                        : "Invalid";
                                ("" === t || this.isNull(t)) &&
                                    this.throwError(
                                        "Cannot set the invalid state with an empty message."
                                    ),
                                    e.setCustomValidity(t);
                            },
                        },
                        {
                            key: "setValidState",
                            value: function (e) {
                                e.setCustomValidity("");
                            },
                        },
                        {
                            key: "cloneObject",
                            value: function (e) {
                                return r({}, e);
                            },
                        },
                        {
                            key: "camelize",
                            value: function (e) {
                                var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : "-",
                                    i =
                                        !(
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                        ) || arguments[2],
                                    n =
                                        !(
                                            arguments.length > 3 &&
                                            void 0 !== arguments[3]
                                        ) || arguments[3];
                                if (this.isNull(e)) return null;
                                i && (e = e.replace(/^data-/, ""));
                                var a = e.split(t).map(function (e) {
                                    return ""
                                        .concat(e.charAt(0).toUpperCase())
                                        .concat(e.slice(1));
                                });
                                return (
                                    (a = a.join("")),
                                    n &&
                                        (a = ""
                                            .concat(a.charAt(0).toLowerCase())
                                            .concat(a.slice(1))),
                                    a
                                );
                            },
                        },
                        {
                            key: "text",
                            value: function (e) {
                                var t = e.nodeType;
                                return t === Node.ELEMENT_NODE ||
                                    t === Node.DOCUMENT_NODE ||
                                    t === Node.DOCUMENT_FRAGMENT_NODE
                                    ? e.textContent
                                    : t === Node.TEXT_NODE
                                    ? e.nodeValue
                                    : "";
                            },
                        },
                        {
                            key: "setText",
                            value: function (e, t) {
                                var i = e.nodeType;
                                (i !== Node.ELEMENT_NODE &&
                                    i !== Node.DOCUMENT_NODE &&
                                    i !== Node.DOCUMENT_FRAGMENT_NODE) ||
                                    (e.textContent = t);
                            },
                        },
                        {
                            key: "filterOut",
                            value: function (e, t) {
                                var i = this;
                                return e.filter(function (e) {
                                    return !i.isInArray(e, t);
                                });
                            },
                        },
                        {
                            key: "trimPaddedZerosFromDecimalPlaces",
                            value: function (e) {
                                if ("" === (e = String(e))) return "";
                                var t = o(e.split("."), 2),
                                    i = t[0],
                                    n = t[1];
                                if (this.isUndefinedOrNullOrEmpty(n)) return i;
                                var a = n.replace(/0+$/g, "");
                                return "" === a
                                    ? i
                                    : "".concat(i, ".").concat(a);
                            },
                        },
                        {
                            key: "getHoveredElement",
                            value: function () {
                                var e = a(document.querySelectorAll(":hover"));
                                return e[e.length - 1];
                            },
                        },
                        {
                            key: "arrayTrim",
                            value: function (e, t) {
                                var i = e.length;
                                return 0 === i || t > i
                                    ? e
                                    : t < 0
                                    ? []
                                    : ((e.length = parseInt(t, 10)), e);
                            },
                        },
                        {
                            key: "arrayUnique",
                            value: function () {
                                var e;
                                return a(
                                    new Set((e = []).concat.apply(e, arguments))
                                );
                            },
                        },
                        {
                            key: "mergeMaps",
                            value: function () {
                                for (
                                    var e = arguments.length,
                                        t = new Array(e),
                                        i = 0;
                                    i < e;
                                    i++
                                )
                                    t[i] = arguments[i];
                                return new Map(
                                    t.reduce(function (e, t) {
                                        return e.concat(a(t));
                                    }, [])
                                );
                            },
                        },
                        {
                            key: "objectKeyLookup",
                            value: function (e, t) {
                                var i = Object.entries(e).find(function (e) {
                                        return e[1] === t;
                                    }),
                                    n = null;
                                return void 0 !== i && (n = i[0]), n;
                            },
                        },
                        {
                            key: "insertAt",
                            value: function (e, t, i) {
                                if (i > (e = String(e)).length)
                                    throw new Error(
                                        "The given index is out of the string range."
                                    );
                                if (1 !== t.length)
                                    throw new Error(
                                        "The given string `char` should be only one character long."
                                    );
                                return "" === e && 0 === i
                                    ? t
                                    : ""
                                          .concat(e.slice(0, i))
                                          .concat(t)
                                          .concat(e.slice(i));
                            },
                        },
                        {
                            key: "scientificToDecimal",
                            value: function (e) {
                                var t = Number(e);
                                if (isNaN(t)) return NaN;
                                if (
                                    ((e = String(e)),
                                    !this.contains(e, "e") &&
                                        !this.contains(e, "E"))
                                )
                                    return e;
                                var i = o(e.split(/e/i), 2),
                                    n = i[0],
                                    a = i[1],
                                    r = n < 0;
                                r && (n = n.replace("-", ""));
                                var s = +a < 0;
                                s && (a = a.replace("-", ""));
                                var l,
                                    u = o(n.split(/\./), 2),
                                    c = u[0],
                                    h = u[1];
                                return (
                                    s
                                        ? ((l =
                                              c.length > a
                                                  ? this.insertAt(
                                                        c,
                                                        ".",
                                                        c.length - a
                                                    )
                                                  : "0."
                                                        .concat(
                                                            "0".repeat(
                                                                a - c.length
                                                            )
                                                        )
                                                        .concat(c)),
                                          (l = "".concat(l).concat(h || "")))
                                        : h
                                        ? ((n = "".concat(c).concat(h)),
                                          (l =
                                              a < h.length
                                                  ? this.insertAt(
                                                        n,
                                                        ".",
                                                        +a + c.length
                                                    )
                                                  : ""
                                                        .concat(n)
                                                        .concat(
                                                            "0".repeat(
                                                                a - h.length
                                                            )
                                                        )))
                                        : ((n = n.replace(".", "")),
                                          (l = ""
                                              .concat(n)
                                              .concat("0".repeat(Number(a))))),
                                    r && (l = "-".concat(l)),
                                    l
                                );
                            },
                        },
                    ]),
                    (i = null) && c(t.prototype, i),
                    s && c(t, s),
                    Object.defineProperty(t, "prototype", { writable: !1 }),
                    e
                );
            })();
            function m(e) {
                return (
                    (m =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    m(e)
                );
            }
            function g(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(
                            e,
                            ((a = n.key),
                            (r = void 0),
                            (r = (function (e, t) {
                                if ("object" !== m(e) || null === e) return e;
                                var i = e[Symbol.toPrimitive];
                                if (void 0 !== i) {
                                    var n = i.call(e, t || "default");
                                    if ("object" !== m(n)) return n;
                                    throw new TypeError(
                                        "@@toPrimitive must return a primitive value."
                                    );
                                }
                                return ("string" === t ? String : Number)(e);
                            })(a, "string")),
                            "symbol" === m(r) ? r : String(r)),
                            n
                        );
                }
                var a, r;
            }
            var d = (function () {
                function e(t) {
                    if (
                        ((function (e, t) {
                            if (!(e instanceof t))
                                throw new TypeError(
                                    "Cannot call a class as a function"
                                );
                        })(this, e),
                        null === t)
                    )
                        throw new Error("Invalid AST");
                }
                var t, i, n;
                return (
                    (t = e),
                    (i = [
                        {
                            key: "evaluate",
                            value: function (e) {
                                if (null == e)
                                    throw new Error("Invalid AST sub-tree");
                                if ("number" === e.type) return e.value;
                                if ("unaryMinus" === e.type)
                                    return -this.evaluate(e.left);
                                var t = this.evaluate(e.left),
                                    i = this.evaluate(e.right);
                                switch (e.type) {
                                    case "op_+":
                                        return Number(t) + Number(i);
                                    case "op_-":
                                        return t - i;
                                    case "op_*":
                                        return t * i;
                                    case "op_/":
                                        return t / i;
                                    default:
                                        throw new Error(
                                            "Invalid operator '".concat(
                                                e.type,
                                                "'"
                                            )
                                        );
                                }
                            },
                        },
                    ]) && g(t.prototype, i),
                    n && g(t, n),
                    Object.defineProperty(t, "prototype", { writable: !1 }),
                    e
                );
            })();
            function v(e) {
                return (
                    (v =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    v(e)
                );
            }
            function p(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(
                            e,
                            ((a = n.key),
                            (r = void 0),
                            (r = (function (e, t) {
                                if ("object" !== v(e) || null === e) return e;
                                var i = e[Symbol.toPrimitive];
                                if (void 0 !== i) {
                                    var n = i.call(e, t || "default");
                                    if ("object" !== v(n)) return n;
                                    throw new TypeError(
                                        "@@toPrimitive must return a primitive value."
                                    );
                                }
                                return ("string" === t ? String : Number)(e);
                            })(a, "string")),
                            "symbol" === v(r) ? r : String(r)),
                            n
                        );
                }
                var a, r;
            }
            var f = (function () {
                function e() {
                    !(function (e, t) {
                        if (!(e instanceof t))
                            throw new TypeError(
                                "Cannot call a class as a function"
                            );
                    })(this, e);
                }
                var t, i, n;
                return (
                    (t = e),
                    (n = [
                        {
                            key: "createNode",
                            value: function (t, i, n) {
                                var a = new e();
                                return (
                                    (a.type = t), (a.left = i), (a.right = n), a
                                );
                            },
                        },
                        {
                            key: "createUnaryNode",
                            value: function (t) {
                                var i = new e();
                                return (
                                    (i.type = "unaryMinus"),
                                    (i.left = t),
                                    (i.right = null),
                                    i
                                );
                            },
                        },
                        {
                            key: "createLeaf",
                            value: function (t) {
                                var i = new e();
                                return (i.type = "number"), (i.value = t), i;
                            },
                        },
                    ]),
                    (i = null) && p(t.prototype, i),
                    n && p(t, n),
                    Object.defineProperty(t, "prototype", { writable: !1 }),
                    e
                );
            })();
            function y(e) {
                return (
                    (y =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    y(e)
                );
            }
            function S(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(
                            e,
                            ((a = n.key),
                            (r = void 0),
                            (r = (function (e, t) {
                                if ("object" !== y(e) || null === e) return e;
                                var i = e[Symbol.toPrimitive];
                                if (void 0 !== i) {
                                    var n = i.call(e, t || "default");
                                    if ("object" !== y(n)) return n;
                                    throw new TypeError(
                                        "@@toPrimitive must return a primitive value."
                                    );
                                }
                                return ("string" === t ? String : Number)(e);
                            })(a, "string")),
                            "symbol" === y(r) ? r : String(r)),
                            n
                        );
                }
                var a, r;
            }
            function b(e, t, i) {
                return (
                    t && S(e.prototype, t),
                    i && S(e, i),
                    Object.defineProperty(e, "prototype", { writable: !1 }),
                    e
                );
            }
            var w = b(function e(t, i, n) {
                !(function (e, t) {
                    if (!(e instanceof t))
                        throw new TypeError(
                            "Cannot call a class as a function"
                        );
                })(this, e),
                    (this.type = t),
                    (this.value = i),
                    (this.symbol = n);
            });
            function P(e) {
                return (
                    (P =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    P(e)
                );
            }
            function O(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(
                            e,
                            ((a = n.key),
                            (r = void 0),
                            (r = (function (e, t) {
                                if ("object" !== P(e) || null === e) return e;
                                var i = e[Symbol.toPrimitive];
                                if (void 0 !== i) {
                                    var n = i.call(e, t || "default");
                                    if ("object" !== P(n)) return n;
                                    throw new TypeError(
                                        "@@toPrimitive must return a primitive value."
                                    );
                                }
                                return ("string" === t ? String : Number)(e);
                            })(a, "string")),
                            "symbol" === P(r) ? r : String(r)),
                            n
                        );
                }
                var a, r;
            }
            var k = (function () {
                function e(t) {
                    !(function (e, t) {
                        if (!(e instanceof t))
                            throw new TypeError(
                                "Cannot call a class as a function"
                            );
                    })(this, e),
                        (this.text = t),
                        (this.textLength = t.length),
                        (this.index = 0),
                        (this.token = new w("Error", 0, 0));
                }
                var t, i, n;
                return (
                    (t = e),
                    (i = [
                        {
                            key: "_skipSpaces",
                            value: function () {
                                for (
                                    ;
                                    " " === this.text[this.index] &&
                                    this.index <= this.textLength;

                                )
                                    this.index++;
                            },
                        },
                        {
                            key: "getIndex",
                            value: function () {
                                return this.index;
                            },
                        },
                        {
                            key: "getNextToken",
                            value: function () {
                                var e =
                                    arguments.length > 0 &&
                                    void 0 !== arguments[0]
                                        ? arguments[0]
                                        : ".";
                                if (
                                    (this._skipSpaces(),
                                    this.textLength === this.index)
                                )
                                    return (
                                        (this.token.type = "EOT"), this.token
                                    );
                                if (h.isDigit(this.text[this.index]))
                                    return (
                                        (this.token.type = "num"),
                                        (this.token.value = this._getNumber(e)),
                                        this.token
                                    );
                                switch (
                                    ((this.token.type = "Error"),
                                    this.text[this.index])
                                ) {
                                    case "+":
                                        this.token.type = "+";
                                        break;
                                    case "-":
                                        this.token.type = "-";
                                        break;
                                    case "*":
                                        this.token.type = "*";
                                        break;
                                    case "/":
                                        this.token.type = "/";
                                        break;
                                    case "(":
                                        this.token.type = "(";
                                        break;
                                    case ")":
                                        this.token.type = ")";
                                }
                                if ("Error" === this.token.type)
                                    throw new Error(
                                        "Unexpected token '"
                                            .concat(
                                                this.token.symbol,
                                                "' at position '"
                                            )
                                            .concat(
                                                this.token.index,
                                                "' in the token function"
                                            )
                                    );
                                return (
                                    (this.token.symbol = this.text[this.index]),
                                    this.index++,
                                    this.token
                                );
                            },
                        },
                        {
                            key: "_getNumber",
                            value: function (e) {
                                this._skipSpaces();
                                for (
                                    var t = this.index;
                                    this.index <= this.textLength &&
                                    h.isDigit(this.text[this.index]);

                                )
                                    this.index++;
                                for (
                                    this.text[this.index] === e && this.index++;
                                    this.index <= this.textLength &&
                                    h.isDigit(this.text[this.index]);

                                )
                                    this.index++;
                                if (this.index === t)
                                    throw new Error(
                                        "No number has been found while it was expected"
                                    );
                                return this.text
                                    .substring(t, this.index)
                                    .replace(e, ".");
                            },
                        },
                    ]),
                    i && O(t.prototype, i),
                    n && O(t, n),
                    Object.defineProperty(t, "prototype", { writable: !1 }),
                    e
                );
            })();
            function N(e) {
                return (
                    (N =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    N(e)
                );
            }
            function E(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(
                            e,
                            ((a = n.key),
                            (r = void 0),
                            (r = (function (e, t) {
                                if ("object" !== N(e) || null === e) return e;
                                var i = e[Symbol.toPrimitive];
                                if (void 0 !== i) {
                                    var n = i.call(e, t || "default");
                                    if ("object" !== N(n)) return n;
                                    throw new TypeError(
                                        "@@toPrimitive must return a primitive value."
                                    );
                                }
                                return ("string" === t ? String : Number)(e);
                            })(a, "string")),
                            "symbol" === N(r) ? r : String(r)),
                            n
                        );
                }
                var a, r;
            }
            var _ = (function () {
                function e(t) {
                    var i =
                        arguments.length > 1 && void 0 !== arguments[1]
                            ? arguments[1]
                            : ".";
                    return (
                        (function (e, t) {
                            if (!(e instanceof t))
                                throw new TypeError(
                                    "Cannot call a class as a function"
                                );
                        })(this, e),
                        (this.text = t),
                        (this.decimalCharacter = i),
                        (this.lexer = new k(t)),
                        (this.token = this.lexer.getNextToken(
                            this.decimalCharacter
                        )),
                        this._exp()
                    );
                }
                var t, i, n;
                return (
                    (t = e),
                    (i = [
                        {
                            key: "_exp",
                            value: function () {
                                var e = this._term(),
                                    t = this._moreExp();
                                return f.createNode("op_+", e, t);
                            },
                        },
                        {
                            key: "_moreExp",
                            value: function () {
                                var e, t;
                                switch (this.token.type) {
                                    case "+":
                                        return (
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            (e = this._term()),
                                            (t = this._moreExp()),
                                            f.createNode("op_+", t, e)
                                        );
                                    case "-":
                                        return (
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            (e = this._term()),
                                            (t = this._moreExp()),
                                            f.createNode("op_-", t, e)
                                        );
                                }
                                return f.createLeaf(0);
                            },
                        },
                        {
                            key: "_term",
                            value: function () {
                                var e = this._factor(),
                                    t = this._moreTerms();
                                return f.createNode("op_*", e, t);
                            },
                        },
                        {
                            key: "_moreTerms",
                            value: function () {
                                var e, t;
                                switch (this.token.type) {
                                    case "*":
                                        return (
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            (e = this._factor()),
                                            (t = this._moreTerms()),
                                            f.createNode("op_*", t, e)
                                        );
                                    case "/":
                                        return (
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            (e = this._factor()),
                                            (t = this._moreTerms()),
                                            f.createNode("op_/", t, e)
                                        );
                                }
                                return f.createLeaf(1);
                            },
                        },
                        {
                            key: "_factor",
                            value: function () {
                                var e, t, i;
                                switch (this.token.type) {
                                    case "num":
                                        return (
                                            (i = this.token.value),
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            f.createLeaf(i)
                                        );
                                    case "-":
                                        return (
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            (t = this._factor()),
                                            f.createUnaryNode(t)
                                        );
                                    case "(":
                                        return (
                                            (this.token =
                                                this.lexer.getNextToken(
                                                    this.decimalCharacter
                                                )),
                                            (e = this._exp()),
                                            this._match(")"),
                                            e
                                        );
                                    default:
                                        throw new Error(
                                            "Unexpected token '"
                                                .concat(
                                                    this.token.symbol,
                                                    "' with type '"
                                                )
                                                .concat(
                                                    this.token.type,
                                                    "' at position '"
                                                )
                                                .concat(
                                                    this.token.index,
                                                    "' in the factor function"
                                                )
                                        );
                                }
                            },
                        },
                        {
                            key: "_match",
                            value: function (e) {
                                var t = this.lexer.getIndex() - 1;
                                if (this.text[t] !== e)
                                    throw new Error(
                                        "Unexpected token '"
                                            .concat(
                                                this.token.symbol,
                                                "' at position '"
                                            )
                                            .concat(
                                                t,
                                                "' in the match function"
                                            )
                                    );
                                this.token = this.lexer.getNextToken(
                                    this.decimalCharacter
                                );
                            },
                        },
                    ]) && E(t.prototype, i),
                    n && E(t, n),
                    Object.defineProperty(t, "prototype", { writable: !1 }),
                    e
                );
            })();
            function C(e) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return x(e);
                    })(e) ||
                    (function (e) {
                        if (
                            ("undefined" != typeof Symbol &&
                                null != e[Symbol.iterator]) ||
                            null != e["@@iterator"]
                        )
                            return Array.from(e);
                    })(e) ||
                    V(e) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function F(e, t) {
                return (
                    (function (e) {
                        if (Array.isArray(e)) return e;
                    })(e) ||
                    (function (e, t) {
                        var i =
                            null == e
                                ? null
                                : ("undefined" != typeof Symbol &&
                                      e[Symbol.iterator]) ||
                                  e["@@iterator"];
                        if (null != i) {
                            var n,
                                a,
                                r,
                                o,
                                s = [],
                                l = !0,
                                u = !1;
                            try {
                                if (((r = (i = i.call(e)).next), 0 === t)) {
                                    if (Object(i) !== i) return;
                                    l = !1;
                                } else
                                    for (
                                        ;
                                        !(l = (n = r.call(i)).done) &&
                                        (s.push(n.value), s.length !== t);
                                        l = !0
                                    );
                            } catch (c) {
                                (u = !0), (a = c);
                            } finally {
                                try {
                                    if (
                                        !l &&
                                        null != i.return &&
                                        ((o = i.return()), Object(o) !== o)
                                    )
                                        return;
                                } finally {
                                    if (u) throw a;
                                }
                            }
                            return s;
                        }
                    })(e, t) ||
                    V(e, t) ||
                    (function () {
                        throw new TypeError(
                            "Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
                        );
                    })()
                );
            }
            function V(e, t) {
                if (e) {
                    if ("string" == typeof e) return x(e, t);
                    var i = Object.prototype.toString.call(e).slice(8, -1);
                    return (
                        "Object" === i &&
                            e.constructor &&
                            (i = e.constructor.name),
                        "Map" === i || "Set" === i
                            ? Array.from(e)
                            : "Arguments" === i ||
                              /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(i)
                            ? x(e, t)
                            : void 0
                    );
                }
            }
            function x(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var i = 0, n = new Array(t); i < t; i++) n[i] = e[i];
                return n;
            }
            function T() {
                return (
                    (T = Object.assign
                        ? Object.assign.bind()
                        : function (e) {
                              for (var t = 1; t < arguments.length; t++) {
                                  var i = arguments[t];
                                  for (var n in i)
                                      Object.prototype.hasOwnProperty.call(
                                          i,
                                          n
                                      ) && (e[n] = i[n]);
                              }
                              return e;
                          }),
                    T.apply(this, arguments)
                );
            }
            function A(e) {
                return (
                    (A =
                        "function" == typeof Symbol &&
                        "symbol" == typeof Symbol.iterator
                            ? function (e) {
                                  return typeof e;
                              }
                            : function (e) {
                                  return e &&
                                      "function" == typeof Symbol &&
                                      e.constructor === Symbol &&
                                      e !== Symbol.prototype
                                      ? "symbol"
                                      : typeof e;
                              }),
                    A(e)
                );
            }
            function L(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var n = t[i];
                    (n.enumerable = n.enumerable || !1),
                        (n.configurable = !0),
                        "value" in n && (n.writable = !0),
                        Object.defineProperty(e, B(n.key), n);
                }
            }
            function D(e, t, i) {
                return (
                    (t = B(t)) in e
                        ? Object.defineProperty(e, t, {
                              value: i,
                              enumerable: !0,
                              configurable: !0,
                              writable: !0,
                          })
                        : (e[t] = i),
                    e
                );
            }
            function B(e) {
                var t = (function (e, t) {
                    if ("object" !== A(e) || null === e) return e;
                    var i = e[Symbol.toPrimitive];
                    if (void 0 !== i) {
                        var n = i.call(e, t || "default");
                        if ("object" !== A(n)) return n;
                        throw new TypeError(
                            "@@toPrimitive must return a primitive value."
                        );
                    }
                    return ("string" === t ? String : Number)(e);
                })(e, "string");
                return "symbol" === A(t) ? t : String(t);
            }
            var I,
                M = (function () {
                    function e() {
                        var t = this,
                            i =
                                arguments.length > 0 && void 0 !== arguments[0]
                                    ? arguments[0]
                                    : null,
                            n =
                                arguments.length > 1 && void 0 !== arguments[1]
                                    ? arguments[1]
                                    : null,
                            a =
                                arguments.length > 2 && void 0 !== arguments[2]
                                    ? arguments[2]
                                    : null;
                        !(function (e, t) {
                            if (!(e instanceof t))
                                throw new TypeError(
                                    "Cannot call a class as a function"
                                );
                        })(this, e);
                        var r = e._setArgumentsValues(i, n, a),
                            o = r.domElement,
                            s = r.initialValue,
                            l = r.userOptions;
                        if (
                            ((this.domElement = o),
                            (this.defaultRawValue = ""),
                            this._setSettings(l, !1),
                            this._checkElement(),
                            (this.savedCancellableValue = null),
                            (this.historyTable = []),
                            (this.historyTableIndex = -1),
                            (this.onGoingRedo = !1),
                            (this.parentForm = this._getParentForm()),
                            !this.runOnce && this.settings.formatOnPageLoad)
                        )
                            this._formatDefaultValueOnPageLoad(s);
                        else {
                            var u;
                            if (h.isNull(s))
                                switch (this.settings.emptyInputBehavior) {
                                    case e.options.emptyInputBehavior.min:
                                        u = this.settings.minimumValue;
                                        break;
                                    case e.options.emptyInputBehavior.max:
                                        u = this.settings.maximumValue;
                                        break;
                                    case e.options.emptyInputBehavior.zero:
                                        u = "0";
                                        break;
                                    case e.options.emptyInputBehavior.focus:
                                    case e.options.emptyInputBehavior.press:
                                    case e.options.emptyInputBehavior.always:
                                    case e.options.emptyInputBehavior.null:
                                        u = "";
                                        break;
                                    default:
                                        u = this.settings.emptyInputBehavior;
                                }
                            else u = s;
                            this._setElementAndRawValue(u);
                        }
                        (this.runOnce = !0),
                            (this.hasEventListeners = !1),
                            (this.isInputElement || this.isContentEditable) &&
                                (this.settings.noEventListeners ||
                                    this._createEventListeners(),
                                this._setWritePermissions(!0)),
                            this._saveInitialValues(s),
                            (this.sessionStorageAvailable =
                                this.constructor._storageTest()),
                            (this.storageNamePrefix = "AUTO_"),
                            this._setPersistentStorageName(),
                            (this.validState = !0),
                            (this.isFocused = !1),
                            (this.isWheelEvent = !1),
                            (this.isDropEvent = !1),
                            (this.isEditing = !1),
                            (this.rawValueOnFocus = void 0),
                            (this.internalModification = !1),
                            (this.attributeToWatch =
                                this._getAttributeToWatch()),
                            (this.getterSetter =
                                Object.getOwnPropertyDescriptor(
                                    this.domElement.__proto__,
                                    this.attributeToWatch
                                )),
                            this._addWatcher(),
                            this.settings.createLocalList &&
                                this._createLocalList(),
                            this.constructor._addToGlobalList(this),
                            (this.global = {
                                set: function (e) {
                                    var i =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    t.autoNumericLocalList.forEach(function (
                                        t
                                    ) {
                                        t.set(e, i);
                                    });
                                },
                                setUnformatted: function (e) {
                                    var i =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    t.autoNumericLocalList.forEach(function (
                                        t
                                    ) {
                                        t.setUnformatted(e, i);
                                    });
                                },
                                get: function () {
                                    var e =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        i = [];
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (e) {
                                                i.push(e.get());
                                            }
                                        ),
                                        t._executeCallback(i, e),
                                        i
                                    );
                                },
                                getNumericString: function () {
                                    var e =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        i = [];
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (e) {
                                                i.push(e.getNumericString());
                                            }
                                        ),
                                        t._executeCallback(i, e),
                                        i
                                    );
                                },
                                getFormatted: function () {
                                    var e =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        i = [];
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (e) {
                                                i.push(e.getFormatted());
                                            }
                                        ),
                                        t._executeCallback(i, e),
                                        i
                                    );
                                },
                                getNumber: function () {
                                    var e =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        i = [];
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (e) {
                                                i.push(e.getNumber());
                                            }
                                        ),
                                        t._executeCallback(i, e),
                                        i
                                    );
                                },
                                getLocalized: function () {
                                    var e =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        i = [];
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (e) {
                                                i.push(e.getLocalized());
                                            }
                                        ),
                                        t._executeCallback(i, e),
                                        i
                                    );
                                },
                                reformat: function () {
                                    t.autoNumericLocalList.forEach(function (
                                        e
                                    ) {
                                        e.reformat();
                                    });
                                },
                                unformat: function () {
                                    t.autoNumericLocalList.forEach(function (
                                        e
                                    ) {
                                        e.unformat();
                                    });
                                },
                                unformatLocalized: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    t.autoNumericLocalList.forEach(function (
                                        t
                                    ) {
                                        t.unformatLocalized(e);
                                    });
                                },
                                update: function () {
                                    for (
                                        var e = arguments.length,
                                            i = new Array(e),
                                            n = 0;
                                        n < e;
                                        n++
                                    )
                                        i[n] = arguments[n];
                                    t.autoNumericLocalList.forEach(function (
                                        e
                                    ) {
                                        e.update.apply(e, i);
                                    });
                                },
                                isPristine: function () {
                                    var e =
                                            !(
                                                arguments.length > 0 &&
                                                void 0 !== arguments[0]
                                            ) || arguments[0],
                                        i = !0;
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (t) {
                                                i &&
                                                    !t.isPristine(e) &&
                                                    (i = !1);
                                            }
                                        ),
                                        i
                                    );
                                },
                                clear: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0] &&
                                        arguments[0];
                                    t.autoNumericLocalList.forEach(function (
                                        t
                                    ) {
                                        t.clear(e);
                                    });
                                },
                                remove: function () {
                                    t.autoNumericLocalList.forEach(function (
                                        e
                                    ) {
                                        e.remove();
                                    });
                                },
                                wipe: function () {
                                    t.autoNumericLocalList.forEach(function (
                                        e
                                    ) {
                                        e.wipe();
                                    });
                                },
                                nuke: function () {
                                    t.autoNumericLocalList.forEach(function (
                                        e
                                    ) {
                                        e.nuke();
                                    });
                                },
                                has: function (i) {
                                    return i instanceof e
                                        ? t.autoNumericLocalList.has(i.node())
                                        : t.autoNumericLocalList.has(i);
                                },
                                addObject: function (i) {
                                    var n, a;
                                    i instanceof e
                                        ? ((n = i.node()), (a = i))
                                        : ((n = i),
                                          (a = e.getAutoNumericElement(n))),
                                        t._hasLocalList() ||
                                            t._createLocalList();
                                    var r,
                                        o = a._getLocalList();
                                    0 === o.size &&
                                        (a._createLocalList(),
                                        (o = a._getLocalList())),
                                        o instanceof Map
                                            ? (r = h.mergeMaps(
                                                  t._getLocalList(),
                                                  o
                                              ))
                                            : (t._addToLocalList(n, a),
                                              (r = t._getLocalList())),
                                        r.forEach(function (e) {
                                            e._setLocalList(r);
                                        });
                                },
                                removeObject: function (i) {
                                    var n,
                                        a,
                                        r =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1] &&
                                            arguments[1];
                                    i instanceof e
                                        ? ((n = i.node()), (a = i))
                                        : ((n = i),
                                          (a = e.getAutoNumericElement(n)));
                                    var o = t.autoNumericLocalList;
                                    t.autoNumericLocalList.delete(n),
                                        o.forEach(function (e) {
                                            e._setLocalList(
                                                t.autoNumericLocalList
                                            );
                                        }),
                                        r || n !== t.node()
                                            ? a._createLocalList()
                                            : a._setLocalList(new Map());
                                },
                                empty: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0] &&
                                        arguments[0];
                                    t.autoNumericLocalList.forEach(function (
                                        t
                                    ) {
                                        e
                                            ? t._createLocalList()
                                            : t._setLocalList(new Map());
                                    });
                                },
                                elements: function () {
                                    var e = [];
                                    return (
                                        t.autoNumericLocalList.forEach(
                                            function (t) {
                                                e.push(t.node());
                                            }
                                        ),
                                        e
                                    );
                                },
                                getList: function () {
                                    return t.autoNumericLocalList;
                                },
                                size: function () {
                                    return t.autoNumericLocalList.size;
                                },
                            }),
                            (this.options = {
                                reset: function () {
                                    return (
                                        (t.settings = {
                                            rawValue: t.defaultRawValue,
                                        }),
                                        t.update(e.defaultSettings),
                                        t
                                    );
                                },
                                allowDecimalPadding: function (e) {
                                    return (
                                        t.update({ allowDecimalPadding: e }), t
                                    );
                                },
                                alwaysAllowDecimalCharacter: function (e) {
                                    return (
                                        t.update({
                                            alwaysAllowDecimalCharacter: e,
                                        }),
                                        t
                                    );
                                },
                                caretPositionOnFocus: function (e) {
                                    return (
                                        (t.settings.caretPositionOnFocus = e), t
                                    );
                                },
                                createLocalList: function (e) {
                                    return (
                                        (t.settings.createLocalList = e),
                                        t.settings.createLocalList
                                            ? t._hasLocalList() ||
                                              t._createLocalList()
                                            : t._deleteLocalList(),
                                        t
                                    );
                                },
                                currencySymbol: function (e) {
                                    return t.update({ currencySymbol: e }), t;
                                },
                                currencySymbolPlacement: function (e) {
                                    return (
                                        t.update({
                                            currencySymbolPlacement: e,
                                        }),
                                        t
                                    );
                                },
                                decimalCharacter: function (e) {
                                    return t.update({ decimalCharacter: e }), t;
                                },
                                decimalCharacterAlternative: function (e) {
                                    return (
                                        (t.settings.decimalCharacterAlternative =
                                            e),
                                        t
                                    );
                                },
                                decimalPlaces: function (e) {
                                    return (
                                        h.warning(
                                            "Using `options.decimalPlaces()` instead of calling the specific `options.decimalPlacesRawValue()`, `options.decimalPlacesShownOnFocus()` and `options.decimalPlacesShownOnBlur()` methods will reset those options.\nPlease call the specific methods if you do not want to reset those.",
                                            t.settings.showWarnings
                                        ),
                                        t.update({ decimalPlaces: e }),
                                        t
                                    );
                                },
                                decimalPlacesRawValue: function (e) {
                                    return (
                                        t.update({ decimalPlacesRawValue: e }),
                                        t
                                    );
                                },
                                decimalPlacesShownOnBlur: function (e) {
                                    return (
                                        t.update({
                                            decimalPlacesShownOnBlur: e,
                                        }),
                                        t
                                    );
                                },
                                decimalPlacesShownOnFocus: function (e) {
                                    return (
                                        t.update({
                                            decimalPlacesShownOnFocus: e,
                                        }),
                                        t
                                    );
                                },
                                defaultValueOverride: function (e) {
                                    return (
                                        t.update({ defaultValueOverride: e }), t
                                    );
                                },
                                digitalGroupSpacing: function (e) {
                                    return (
                                        t.update({ digitalGroupSpacing: e }), t
                                    );
                                },
                                digitGroupSeparator: function (e) {
                                    return (
                                        t.update({ digitGroupSeparator: e }), t
                                    );
                                },
                                divisorWhenUnfocused: function (e) {
                                    return (
                                        t.update({ divisorWhenUnfocused: e }), t
                                    );
                                },
                                emptyInputBehavior: function (i) {
                                    return (
                                        null === t.rawValue &&
                                            i !==
                                                e.options.emptyInputBehavior
                                                    .null &&
                                            (h.warning(
                                                "You are trying to modify the `emptyInputBehavior` option to something different than `'null'` (".concat(
                                                    i,
                                                    "), but the element raw value is currently set to `null`. This would result in an invalid `rawValue`. In order to fix that, the element value has been changed to the empty string `''`."
                                                ),
                                                t.settings.showWarnings
                                            ),
                                            (t.rawValue = "")),
                                        t.update({ emptyInputBehavior: i }),
                                        t
                                    );
                                },
                                eventBubbles: function (e) {
                                    return (t.settings.eventBubbles = e), t;
                                },
                                eventIsCancelable: function (e) {
                                    return (
                                        (t.settings.eventIsCancelable = e), t
                                    );
                                },
                                failOnUnknownOption: function (e) {
                                    return (
                                        (t.settings.failOnUnknownOption = e), t
                                    );
                                },
                                formatOnPageLoad: function (e) {
                                    return (t.settings.formatOnPageLoad = e), t;
                                },
                                formulaMode: function (e) {
                                    return (t.settings.formulaMode = e), t;
                                },
                                historySize: function (e) {
                                    return (t.settings.historySize = e), t;
                                },
                                invalidClass: function (e) {
                                    return (t.settings.invalidClass = e), t;
                                },
                                isCancellable: function (e) {
                                    return (t.settings.isCancellable = e), t;
                                },
                                leadingZero: function (e) {
                                    return t.update({ leadingZero: e }), t;
                                },
                                maximumValue: function (e) {
                                    return t.update({ maximumValue: e }), t;
                                },
                                minimumValue: function (e) {
                                    return t.update({ minimumValue: e }), t;
                                },
                                modifyValueOnUpDownArrow: function (e) {
                                    return (
                                        (t.settings.modifyValueOnUpDownArrow =
                                            e),
                                        t
                                    );
                                },
                                modifyValueOnWheel: function (e) {
                                    return (
                                        (t.settings.modifyValueOnWheel = e), t
                                    );
                                },
                                negativeBracketsTypeOnBlur: function (e) {
                                    return (
                                        t.update({
                                            negativeBracketsTypeOnBlur: e,
                                        }),
                                        t
                                    );
                                },
                                negativePositiveSignPlacement: function (e) {
                                    return (
                                        t.update({
                                            negativePositiveSignPlacement: e,
                                        }),
                                        t
                                    );
                                },
                                negativeSignCharacter: function (e) {
                                    return (
                                        t.update({ negativeSignCharacter: e }),
                                        t
                                    );
                                },
                                negativePositiveSignBehavior: function (e) {
                                    return (
                                        (t.settings.negativePositiveSignBehavior =
                                            e),
                                        t
                                    );
                                },
                                noEventListeners: function (i) {
                                    return (
                                        i ===
                                            e.options.noEventListeners
                                                .noEvents &&
                                            t.settings.noEventListeners ===
                                                e.options.noEventListeners
                                                    .addEvents &&
                                            t._removeEventListeners(),
                                        t.update({ noEventListeners: i }),
                                        t
                                    );
                                },
                                onInvalidPaste: function (e) {
                                    return (t.settings.onInvalidPaste = e), t;
                                },
                                outputFormat: function (e) {
                                    return (t.settings.outputFormat = e), t;
                                },
                                overrideMinMaxLimits: function (e) {
                                    return (
                                        t.update({ overrideMinMaxLimits: e }), t
                                    );
                                },
                                positiveSignCharacter: function (e) {
                                    return (
                                        t.update({ positiveSignCharacter: e }),
                                        t
                                    );
                                },
                                rawValueDivisor: function (e) {
                                    return t.update({ rawValueDivisor: e }), t;
                                },
                                readOnly: function (e) {
                                    return (
                                        (t.settings.readOnly = e),
                                        t._setWritePermissions(),
                                        t
                                    );
                                },
                                roundingMethod: function (e) {
                                    return t.update({ roundingMethod: e }), t;
                                },
                                saveValueToSessionStorage: function (e) {
                                    return (
                                        t.update({
                                            saveValueToSessionStorage: e,
                                        }),
                                        t
                                    );
                                },
                                symbolWhenUnfocused: function (e) {
                                    return (
                                        t.update({ symbolWhenUnfocused: e }), t
                                    );
                                },
                                selectNumberOnly: function (e) {
                                    return (t.settings.selectNumberOnly = e), t;
                                },
                                selectOnFocus: function (e) {
                                    return (t.settings.selectOnFocus = e), t;
                                },
                                serializeSpaces: function (e) {
                                    return (t.settings.serializeSpaces = e), t;
                                },
                                showOnlyNumbersOnFocus: function (e) {
                                    return (
                                        t.update({ showOnlyNumbersOnFocus: e }),
                                        t
                                    );
                                },
                                showPositiveSign: function (e) {
                                    return t.update({ showPositiveSign: e }), t;
                                },
                                showWarnings: function (e) {
                                    return (t.settings.showWarnings = e), t;
                                },
                                styleRules: function (e) {
                                    return t.update({ styleRules: e }), t;
                                },
                                suffixText: function (e) {
                                    return t.update({ suffixText: e }), t;
                                },
                                unformatOnHover: function (e) {
                                    return (t.settings.unformatOnHover = e), t;
                                },
                                unformatOnSubmit: function (e) {
                                    return (t.settings.unformatOnSubmit = e), t;
                                },
                                upDownStep: function (e) {
                                    return (t.settings.upDownStep = e), t;
                                },
                                valuesToStrings: function (e) {
                                    return t.update({ valuesToStrings: e }), t;
                                },
                                watchExternalChanges: function (e) {
                                    return (
                                        t.update({ watchExternalChanges: e }), t
                                    );
                                },
                                wheelOn: function (e) {
                                    return (t.settings.wheelOn = e), t;
                                },
                                wheelStep: function (e) {
                                    return (t.settings.wheelStep = e), t;
                                },
                            }),
                            this._triggerEvent(
                                e.events.initialized,
                                this.domElement,
                                {
                                    newValue: h.getElementValue(
                                        this.domElement
                                    ),
                                    newRawValue: this.rawValue,
                                    error: null,
                                    aNElement: this,
                                }
                            );
                    }
                    var t, i, a;
                    return (
                        (t = e),
                        (i = [
                            {
                                key: "_saveInitialValues",
                                value: function (e) {
                                    (this.initialValueHtmlAttribute =
                                        h.scientificToDecimal(
                                            this.domElement.getAttribute(
                                                "value"
                                            )
                                        )),
                                        h.isNull(
                                            this.initialValueHtmlAttribute
                                        ) &&
                                            (this.initialValueHtmlAttribute =
                                                ""),
                                        (this.initialValue = e),
                                        h.isNull(this.initialValue) &&
                                            (this.initialValue = "");
                                },
                            },
                            {
                                key: "_createEventListeners",
                                value: function () {
                                    var t = this;
                                    (this.formulaMode = !1),
                                        (this._onFocusInFunc = function (e) {
                                            t._onFocusIn(e);
                                        }),
                                        (this._onFocusInAndMouseEnterFunc =
                                            function (e) {
                                                t._onFocusInAndMouseEnter(e);
                                            }),
                                        (this._onFocusFunc = function () {
                                            t._onFocus();
                                        }),
                                        (this._onKeydownFunc = function (e) {
                                            t._onKeydown(e);
                                        }),
                                        (this._onKeypressFunc = function (e) {
                                            t._onKeypress(e);
                                        }),
                                        (this._onKeyupFunc = function (e) {
                                            t._onKeyup(e);
                                        }),
                                        (this._onFocusOutAndMouseLeaveFunc =
                                            function (e) {
                                                t._onFocusOutAndMouseLeave(e);
                                            }),
                                        (this._onPasteFunc = function (e) {
                                            t._onPaste(e);
                                        }),
                                        (this._onWheelFunc = function (e) {
                                            t._onWheel(e);
                                        }),
                                        (this._onDropFunc = function (e) {
                                            t._onDrop(e);
                                        }),
                                        (this._onKeydownGlobalFunc = function (
                                            e
                                        ) {
                                            t._onKeydownGlobal(e);
                                        }),
                                        (this._onKeyupGlobalFunc = function (
                                            e
                                        ) {
                                            t._onKeyupGlobal(e);
                                        }),
                                        this.domElement.addEventListener(
                                            "focusin",
                                            this._onFocusInFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "focus",
                                            this._onFocusInAndMouseEnterFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "focus",
                                            this._onFocusFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "mouseenter",
                                            this._onFocusInAndMouseEnterFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "keydown",
                                            this._onKeydownFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "keypress",
                                            this._onKeypressFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "keyup",
                                            this._onKeyupFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "blur",
                                            this._onFocusOutAndMouseLeaveFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "mouseleave",
                                            this._onFocusOutAndMouseLeaveFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "paste",
                                            this._onPasteFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "wheel",
                                            this._onWheelFunc,
                                            !1
                                        ),
                                        this.domElement.addEventListener(
                                            "drop",
                                            this._onDropFunc,
                                            !1
                                        ),
                                        this._setupFormListener(),
                                        (this.hasEventListeners = !0),
                                        e._doesGlobalListExists() ||
                                            (document.addEventListener(
                                                "keydown",
                                                this._onKeydownGlobalFunc,
                                                !1
                                            ),
                                            document.addEventListener(
                                                "keyup",
                                                this._onKeyupGlobalFunc,
                                                !1
                                            ));
                                },
                            },
                            {
                                key: "_removeEventListeners",
                                value: function () {
                                    this.domElement.removeEventListener(
                                        "focusin",
                                        this._onFocusInFunc,
                                        !1
                                    ),
                                        this.domElement.removeEventListener(
                                            "focus",
                                            this._onFocusInAndMouseEnterFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "focus",
                                            this._onFocusFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "mouseenter",
                                            this._onFocusInAndMouseEnterFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "blur",
                                            this._onFocusOutAndMouseLeaveFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "mouseleave",
                                            this._onFocusOutAndMouseLeaveFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "keydown",
                                            this._onKeydownFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "keypress",
                                            this._onKeypressFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "keyup",
                                            this._onKeyupFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "paste",
                                            this._onPasteFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "wheel",
                                            this._onWheelFunc,
                                            !1
                                        ),
                                        this.domElement.removeEventListener(
                                            "drop",
                                            this._onDropFunc,
                                            !1
                                        ),
                                        this._removeFormListener(),
                                        (this.hasEventListeners = !1),
                                        document.removeEventListener(
                                            "keydown",
                                            this._onKeydownGlobalFunc,
                                            !1
                                        ),
                                        document.removeEventListener(
                                            "keyup",
                                            this._onKeyupGlobalFunc,
                                            !1
                                        );
                                },
                            },
                            {
                                key: "_updateEventListeners",
                                value: function () {
                                    this.settings.noEventListeners ||
                                        this.hasEventListeners ||
                                        this._createEventListeners(),
                                        this.settings.noEventListeners &&
                                            this.hasEventListeners &&
                                            this._removeEventListeners();
                                },
                            },
                            {
                                key: "_setupFormListener",
                                value: function () {
                                    var e = this;
                                    h.isNull(this.parentForm) ||
                                        ((this._onFormSubmitFunc = function () {
                                            e._onFormSubmit();
                                        }),
                                        (this._onFormResetFunc = function () {
                                            e._onFormReset();
                                        }),
                                        this._hasParentFormCounter()
                                            ? this._incrementParentFormCounter()
                                            : (this._initializeFormCounterToOne(),
                                              this.parentForm.addEventListener(
                                                  "submit",
                                                  this._onFormSubmitFunc,
                                                  !1
                                              ),
                                              this.parentForm.addEventListener(
                                                  "reset",
                                                  this._onFormResetFunc,
                                                  !1
                                              ),
                                              this._storeFormHandlerFunction()));
                                },
                            },
                            {
                                key: "_removeFormListener",
                                value: function () {
                                    if (!h.isNull(this.parentForm)) {
                                        var e = this._getParentFormCounter();
                                        1 === e
                                            ? (this.parentForm.removeEventListener(
                                                  "submit",
                                                  this._getFormHandlerFunction()
                                                      .submitFn,
                                                  !1
                                              ),
                                              this.parentForm.removeEventListener(
                                                  "reset",
                                                  this._getFormHandlerFunction()
                                                      .resetFn,
                                                  !1
                                              ),
                                              this._removeFormDataSetInfo())
                                            : e > 1
                                            ? this._decrementParentFormCounter()
                                            : h.throwError(
                                                  "The AutoNumeric object count on the form is incoherent."
                                              );
                                    }
                                },
                            },
                            {
                                key: "_hasParentFormCounter",
                                value: function () {
                                    return "anCount" in this.parentForm.dataset;
                                },
                            },
                            {
                                key: "_getParentFormCounter",
                                value: function () {
                                    return Number(
                                        this.parentForm.dataset.anCount
                                    );
                                },
                            },
                            {
                                key: "_initializeFormCounterToOne",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    this._getFormElement(e).dataset.anCount = 1;
                                },
                            },
                            {
                                key: "_incrementParentFormCounter",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    this._getFormElement(e).dataset.anCount++;
                                },
                            },
                            {
                                key: "_decrementParentFormCounter",
                                value: function () {
                                    this.parentForm.dataset.anCount--;
                                },
                            },
                            {
                                key: "_hasFormHandlerFunction",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        "anFormHandler" in
                                        this._getFormElement(e).dataset
                                    );
                                },
                            },
                            {
                                key: "_getFormElement",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return h.isNull(e) ? this.parentForm : e;
                                },
                            },
                            {
                                key: "_storeFormHandlerFunction",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    this.constructor._doesFormHandlerListExists() ||
                                        this.constructor._createFormHandlerList();
                                    var t = h.randomString();
                                    (this._getFormElement(
                                        e
                                    ).dataset.anFormHandler = t),
                                        window.aNFormHandlerMap.set(t, {
                                            submitFn: this._onFormSubmitFunc,
                                            resetFn: this._onFormResetFunc,
                                        });
                                },
                            },
                            {
                                key: "_getFormHandlerKey",
                                value: function () {
                                    this._hasFormHandlerFunction() ||
                                        h.throwError(
                                            "Unable to retrieve the form handler name"
                                        );
                                    var e =
                                        this.parentForm.dataset.anFormHandler;
                                    return (
                                        "" === e &&
                                            h.throwError(
                                                "The form handler name is invalid"
                                            ),
                                        e
                                    );
                                },
                            },
                            {
                                key: "_getFormHandlerFunction",
                                value: function () {
                                    var e = this._getFormHandlerKey();
                                    return window.aNFormHandlerMap.get(e);
                                },
                            },
                            {
                                key: "_removeFormDataSetInfo",
                                value: function () {
                                    this._decrementParentFormCounter(),
                                        window.aNFormHandlerMap.delete(
                                            this._getFormHandlerKey()
                                        ),
                                        this.parentForm.removeAttribute(
                                            "data-an-count"
                                        ),
                                        this.parentForm.removeAttribute(
                                            "data-an-form-handler"
                                        );
                                },
                            },
                            {
                                key: "_setWritePermissions",
                                value: function () {
                                    (arguments.length > 0 &&
                                        void 0 !== arguments[0] &&
                                        arguments[0] &&
                                        this.domElement.readOnly) ||
                                    this.settings.readOnly
                                        ? this._setReadOnly()
                                        : this._setReadWrite();
                                },
                            },
                            {
                                key: "_setReadOnly",
                                value: function () {
                                    this.isInputElement
                                        ? (this.domElement.readOnly = !0)
                                        : this.domElement.setAttribute(
                                              "contenteditable",
                                              !1
                                          );
                                },
                            },
                            {
                                key: "_setReadWrite",
                                value: function () {
                                    this.isInputElement
                                        ? (this.domElement.readOnly = !1)
                                        : this.domElement.setAttribute(
                                              "contenteditable",
                                              !0
                                          );
                                },
                            },
                            {
                                key: "_addWatcher",
                                value: function () {
                                    var e = this;
                                    if (!h.isUndefined(this.getterSetter)) {
                                        var t = this.getterSetter,
                                            i = t.set,
                                            n = t.get;
                                        Object.defineProperty(
                                            this.domElement,
                                            this.attributeToWatch,
                                            {
                                                configurable: !0,
                                                get: function () {
                                                    return n.call(e.domElement);
                                                },
                                                set: function (t) {
                                                    i.call(e.domElement, t),
                                                        e.settings
                                                            .watchExternalChanges &&
                                                            !e.internalModification &&
                                                            e.set(t);
                                                },
                                            }
                                        );
                                    }
                                },
                            },
                            {
                                key: "_removeWatcher",
                                value: function () {
                                    var e = this;
                                    if (!h.isUndefined(this.getterSetter)) {
                                        var t = this.getterSetter,
                                            i = t.set,
                                            n = t.get;
                                        Object.defineProperty(
                                            this.domElement,
                                            this.attributeToWatch,
                                            {
                                                configurable: !0,
                                                get: function () {
                                                    return n.call(e.domElement);
                                                },
                                                set: function (t) {
                                                    i.call(e.domElement, t);
                                                },
                                            }
                                        );
                                    }
                                },
                            },
                            {
                                key: "_getAttributeToWatch",
                                value: function () {
                                    var e;
                                    if (this.isInputElement) e = "value";
                                    else {
                                        var t = this.domElement.nodeType;
                                        t === Node.ELEMENT_NODE ||
                                        t === Node.DOCUMENT_NODE ||
                                        t === Node.DOCUMENT_FRAGMENT_NODE
                                            ? (e = "textContent")
                                            : t === Node.TEXT_NODE &&
                                              (e = "nodeValue");
                                    }
                                    return e;
                                },
                            },
                            {
                                key: "_historyTableAdd",
                                value: function () {
                                    var e = 0 === this.historyTable.length;
                                    if (
                                        e ||
                                        this.rawValue !==
                                            this._historyTableCurrentValueUsed()
                                    ) {
                                        var t = !0;
                                        if (!e) {
                                            var i = this.historyTableIndex + 1;
                                            i < this.historyTable.length &&
                                            this.rawValue ===
                                                this.historyTable[i].value
                                                ? (t = !1)
                                                : h.arrayTrim(
                                                      this.historyTable,
                                                      this.historyTableIndex + 1
                                                  );
                                        }
                                        if ((this.historyTableIndex++, t)) {
                                            var n = h.getElementSelection(
                                                this.domElement
                                            );
                                            (this.selectionStart = n.start),
                                                (this.selectionEnd = n.end),
                                                this.historyTable.push({
                                                    value: this.rawValue,
                                                    start:
                                                        this.selectionStart + 1,
                                                    end: this.selectionEnd + 1,
                                                }),
                                                this.historyTable.length > 1 &&
                                                    ((this.historyTable[
                                                        this.historyTableIndex -
                                                            1
                                                    ].start =
                                                        this.selectionStart),
                                                    (this.historyTable[
                                                        this.historyTableIndex -
                                                            1
                                                    ].end = this.selectionEnd));
                                        }
                                        this.historyTable.length >
                                            this.settings.historySize &&
                                            this._historyTableForget();
                                    }
                                },
                            },
                            {
                                key: "_historyTableUndoOrRedo",
                                value: function () {
                                    var e;
                                    if (
                                        (arguments.length > 0 &&
                                        void 0 !== arguments[0] &&
                                        !arguments[0]
                                            ? (e =
                                                  this.historyTableIndex + 1 <
                                                  this.historyTable.length) &&
                                              this.historyTableIndex++
                                            : (e =
                                                  this.historyTableIndex > 0) &&
                                              this.historyTableIndex--,
                                        e)
                                    ) {
                                        var t =
                                            this.historyTable[
                                                this.historyTableIndex
                                            ];
                                        this.set(t.value, null, !1),
                                            h.setElementSelection(
                                                this.domElement,
                                                t.start,
                                                t.end
                                            );
                                    }
                                },
                            },
                            {
                                key: "_historyTableUndo",
                                value: function () {
                                    this._historyTableUndoOrRedo(!0);
                                },
                            },
                            {
                                key: "_historyTableRedo",
                                value: function () {
                                    this._historyTableUndoOrRedo(!1);
                                },
                            },
                            {
                                key: "_historyTableForget",
                                value: function () {
                                    for (
                                        var e =
                                                arguments.length > 0 &&
                                                void 0 !== arguments[0]
                                                    ? arguments[0]
                                                    : 1,
                                            t = [],
                                            i = 0;
                                        i < e;
                                        i++
                                    )
                                        t.push(this.historyTable.shift()),
                                            this.historyTableIndex--,
                                            this.historyTableIndex < 0 &&
                                                (this.historyTableIndex = 0);
                                    return 1 === t.length ? t[0] : t;
                                },
                            },
                            {
                                key: "_historyTableCurrentValueUsed",
                                value: function () {
                                    var e = this.historyTableIndex;
                                    return (
                                        e < 0 && (e = 0),
                                        h.isUndefinedOrNullOrEmpty(
                                            this.historyTable[e]
                                        )
                                            ? ""
                                            : this.historyTable[e].value
                                    );
                                },
                            },
                            {
                                key: "_parseStyleRules",
                                value: function () {
                                    var e = this;
                                    h.isUndefinedOrNullOrEmpty(
                                        this.settings.styleRules
                                    ) ||
                                        "" === this.rawValue ||
                                        (h.isUndefinedOrNullOrEmpty(
                                            this.settings.styleRules.positive
                                        ) ||
                                            (this.rawValue >= 0
                                                ? this._addCSSClass(
                                                      this.settings.styleRules
                                                          .positive
                                                  )
                                                : this._removeCSSClass(
                                                      this.settings.styleRules
                                                          .positive
                                                  )),
                                        h.isUndefinedOrNullOrEmpty(
                                            this.settings.styleRules.negative
                                        ) ||
                                            (this.rawValue < 0
                                                ? this._addCSSClass(
                                                      this.settings.styleRules
                                                          .negative
                                                  )
                                                : this._removeCSSClass(
                                                      this.settings.styleRules
                                                          .negative
                                                  )),
                                        h.isUndefinedOrNullOrEmpty(
                                            this.settings.styleRules.ranges
                                        ) ||
                                            0 ===
                                                this.settings.styleRules.ranges
                                                    .length ||
                                            this.settings.styleRules.ranges.forEach(
                                                function (t) {
                                                    e.rawValue >= t.min &&
                                                    e.rawValue < t.max
                                                        ? e._addCSSClass(
                                                              t.class
                                                          )
                                                        : e._removeCSSClass(
                                                              t.class
                                                          );
                                                }
                                            ),
                                        h.isUndefinedOrNullOrEmpty(
                                            this.settings.styleRules.userDefined
                                        ) ||
                                            0 ===
                                                this.settings.styleRules
                                                    .userDefined.length ||
                                            this.settings.styleRules.userDefined.forEach(
                                                function (t) {
                                                    if (
                                                        h.isFunction(t.callback)
                                                    )
                                                        if (
                                                            h.isString(
                                                                t.classes
                                                            )
                                                        )
                                                            t.callback(
                                                                e.rawValue
                                                            )
                                                                ? e._addCSSClass(
                                                                      t.classes
                                                                  )
                                                                : e._removeCSSClass(
                                                                      t.classes
                                                                  );
                                                        else if (
                                                            h.isArray(t.classes)
                                                        )
                                                            if (
                                                                2 ===
                                                                t.classes.length
                                                            )
                                                                t.callback(
                                                                    e.rawValue
                                                                )
                                                                    ? (e._addCSSClass(
                                                                          t
                                                                              .classes[0]
                                                                      ),
                                                                      e._removeCSSClass(
                                                                          t
                                                                              .classes[1]
                                                                      ))
                                                                    : (e._removeCSSClass(
                                                                          t
                                                                              .classes[0]
                                                                      ),
                                                                      e._addCSSClass(
                                                                          t
                                                                              .classes[1]
                                                                      ));
                                                            else if (
                                                                t.classes
                                                                    .length > 2
                                                            ) {
                                                                var i =
                                                                    t.callback(
                                                                        e.rawValue
                                                                    );
                                                                h.isArray(i)
                                                                    ? t.classes.forEach(
                                                                          function (
                                                                              t,
                                                                              n
                                                                          ) {
                                                                              h.isInArray(
                                                                                  n,
                                                                                  i
                                                                              )
                                                                                  ? e._addCSSClass(
                                                                                        t
                                                                                    )
                                                                                  : e._removeCSSClass(
                                                                                        t
                                                                                    );
                                                                          }
                                                                      )
                                                                    : h.isInt(i)
                                                                    ? t.classes.forEach(
                                                                          function (
                                                                              t,
                                                                              n
                                                                          ) {
                                                                              n ===
                                                                              i
                                                                                  ? e._addCSSClass(
                                                                                        t
                                                                                    )
                                                                                  : e._removeCSSClass(
                                                                                        t
                                                                                    );
                                                                          }
                                                                      )
                                                                    : h.isNull(
                                                                          i
                                                                      )
                                                                    ? t.classes.forEach(
                                                                          function (
                                                                              t
                                                                          ) {
                                                                              e._removeCSSClass(
                                                                                  t
                                                                              );
                                                                          }
                                                                      )
                                                                    : h.throwError(
                                                                          "The callback result is not an array nor a valid array index, ".concat(
                                                                              A(
                                                                                  i
                                                                              ),
                                                                              " given."
                                                                          )
                                                                      );
                                                            } else
                                                                h.throwError(
                                                                    "The classes attribute is not valid for the `styleRules` option."
                                                                );
                                                        else
                                                            h.isUndefinedOrNullOrEmpty(
                                                                t.classes
                                                            )
                                                                ? t.callback(e)
                                                                : h.throwError(
                                                                      "The callback/classes structure is not valid for the `styleRules` option."
                                                                  );
                                                    else
                                                        h.warning(
                                                            "The given `styleRules` callback is not a function, ".concat(
                                                                A(t.callback),
                                                                " given."
                                                            ),
                                                            e.settings
                                                                .showWarnings
                                                        );
                                                }
                                            ));
                                },
                            },
                            {
                                key: "_addCSSClass",
                                value: function (e) {
                                    this.domElement.classList.add(e);
                                },
                            },
                            {
                                key: "_removeCSSClass",
                                value: function (e) {
                                    this.domElement.classList.remove(e);
                                },
                            },
                            {
                                key: "update",
                                value: function () {
                                    for (
                                        var e = this,
                                            t = arguments.length,
                                            i = new Array(t),
                                            n = 0;
                                        n < t;
                                        n++
                                    )
                                        i[n] = arguments[n];
                                    Array.isArray(i) &&
                                        Array.isArray(i[0]) &&
                                        (i = i[0]);
                                    var a = h.cloneObject(this.settings),
                                        r = this.rawValue,
                                        o = {};
                                    h.isUndefinedOrNullOrEmpty(i) ||
                                    0 === i.length
                                        ? (o = null)
                                        : i.length >= 1 &&
                                          i.forEach(function (t) {
                                              e.constructor._isPreDefinedOptionValid(
                                                  t
                                              ) &&
                                                  (t =
                                                      e.constructor._getOptionObject(
                                                          t
                                                      )),
                                                  T(o, t);
                                          });
                                    try {
                                        this._setSettings(o, !0),
                                            this._setWritePermissions(),
                                            this._updateEventListeners(),
                                            this.set(r);
                                    } catch (s) {
                                        return (
                                            this._setSettings(a, !0),
                                            h.throwError(
                                                "Unable to update the settings, those are invalid: [".concat(
                                                    s,
                                                    "]"
                                                )
                                            ),
                                            this
                                        );
                                    }
                                    return this;
                                },
                            },
                            {
                                key: "getSettings",
                                value: function () {
                                    return this.settings;
                                },
                            },
                            {
                                key: "set",
                                value: function (t) {
                                    var i,
                                        n,
                                        a =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null,
                                        r =
                                            !(
                                                arguments.length > 2 &&
                                                void 0 !== arguments[2]
                                            ) || arguments[2];
                                    if (h.isUndefined(t))
                                        return (
                                            h.warning(
                                                "You are trying to set an 'undefined' value ; an error could have occurred.",
                                                this.settings.showWarnings
                                            ),
                                            this
                                        );
                                    if (
                                        (h.isNull(a) ||
                                            this._setSettings(a, !0),
                                        null === t &&
                                            this.settings.emptyInputBehavior !==
                                                e.options.emptyInputBehavior
                                                    .null)
                                    )
                                        return (
                                            h.warning(
                                                "You are trying to set the `null` value while the `emptyInputBehavior` option is set to ".concat(
                                                    this.settings
                                                        .emptyInputBehavior,
                                                    ". If you want to be able to set the `null` value, you need to change the 'emptyInputBehavior' option to `'null'`."
                                                ),
                                                this.settings.showWarnings
                                            ),
                                            this
                                        );
                                    if (null === t)
                                        return (
                                            this._setElementAndRawValue(
                                                null,
                                                null,
                                                r
                                            ),
                                            this._saveValueToPersistentStorage(),
                                            this
                                        );
                                    if (
                                        ((i = this.constructor._toNumericValue(
                                            t,
                                            this.settings
                                        )),
                                        isNaN(Number(i)))
                                    )
                                        return (
                                            h.warning(
                                                "The value you are trying to set results in `NaN`. The element value is set to the empty string instead.",
                                                this.settings.showWarnings
                                            ),
                                            this.setValue("", r),
                                            this
                                        );
                                    if ("" === i)
                                        switch (
                                            this.settings.emptyInputBehavior
                                        ) {
                                            case e.options.emptyInputBehavior
                                                .zero:
                                                i = 0;
                                                break;
                                            case e.options.emptyInputBehavior
                                                .min:
                                                i = this.settings.minimumValue;
                                                break;
                                            case e.options.emptyInputBehavior
                                                .max:
                                                i = this.settings.maximumValue;
                                                break;
                                            default:
                                                h.isNumber(
                                                    this.settings
                                                        .emptyInputBehavior
                                                ) &&
                                                    (i = Number(
                                                        this.settings
                                                            .emptyInputBehavior
                                                    ));
                                        }
                                    if ("" !== i) {
                                        var o = F(
                                                this.constructor._checkIfInRangeWithOverrideOption(
                                                    i,
                                                    this.settings
                                                ),
                                                2
                                            ),
                                            s = o[0],
                                            l = o[1];
                                        if (
                                            s &&
                                            l &&
                                            this.settings.valuesToStrings &&
                                            this._checkValuesToStrings(i)
                                        )
                                            return (
                                                this._setElementAndRawValue(
                                                    this.settings
                                                        .valuesToStrings[i],
                                                    i,
                                                    r
                                                ),
                                                this._saveValueToPersistentStorage(),
                                                this
                                            );
                                        if (
                                            (h.isZeroOrHasNoValue(i) &&
                                                (i = "0"),
                                            s && l)
                                        ) {
                                            var u =
                                                this.constructor._roundRawValue(
                                                    i,
                                                    this.settings
                                                );
                                            return (
                                                (u =
                                                    this._trimLeadingAndTrailingZeros(
                                                        u.replace(
                                                            this.settings
                                                                .decimalCharacter,
                                                            "."
                                                        )
                                                    )),
                                                (i =
                                                    this._getRawValueToFormat(
                                                        i
                                                    )),
                                                this.isFocused
                                                    ? (i =
                                                          this.constructor._roundFormattedValueShownOnFocus(
                                                              i,
                                                              this.settings
                                                          ))
                                                    : (this.settings
                                                          .divisorWhenUnfocused &&
                                                          (i = (i /=
                                                              this.settings
                                                                  .divisorWhenUnfocused).toString()),
                                                      (i =
                                                          this.constructor._roundFormattedValueShownOnBlur(
                                                              i,
                                                              this.settings
                                                          ))),
                                                (i =
                                                    this.constructor._modifyNegativeSignAndDecimalCharacterForFormattedValue(
                                                        i,
                                                        this.settings
                                                    )),
                                                (i =
                                                    this.constructor._addGroupSeparators(
                                                        i,
                                                        this.settings,
                                                        this.isFocused,
                                                        this.rawValue,
                                                        u
                                                    )),
                                                !this.isFocused &&
                                                    this.settings
                                                        .symbolWhenUnfocused &&
                                                    (i = ""
                                                        .concat(i)
                                                        .concat(
                                                            this.settings
                                                                .symbolWhenUnfocused
                                                        )),
                                                (this.settings
                                                    .decimalPlacesShownOnFocus ||
                                                    this.settings
                                                        .divisorWhenUnfocused) &&
                                                    this._saveValueToPersistentStorage(),
                                                this._setElementAndRawValue(
                                                    i,
                                                    u,
                                                    r
                                                ),
                                                this._setValidOrInvalidState(u),
                                                this
                                            );
                                        }
                                        return (
                                            this._triggerRangeEvents(s, l),
                                            h.throwError(
                                                "The value ["
                                                    .concat(
                                                        i,
                                                        "] being set falls outside of the minimumValue ["
                                                    )
                                                    .concat(
                                                        this.settings
                                                            .minimumValue,
                                                        "] and maximumValue ["
                                                    )
                                                    .concat(
                                                        this.settings
                                                            .maximumValue,
                                                        "] range set for this element"
                                                    )
                                            ),
                                            this._removeValueFromPersistentStorage(),
                                            this.setValue("", r),
                                            this
                                        );
                                    }
                                    return (
                                        (n =
                                            this.settings.emptyInputBehavior ===
                                            e.options.emptyInputBehavior.always
                                                ? this.settings.currencySymbol
                                                : ""),
                                        this._setElementAndRawValue(n, "", r),
                                        this
                                    );
                                },
                            },
                            {
                                key: "setUnformatted",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    if (null === e || h.isUndefined(e))
                                        return this;
                                    h.isNull(t) || this._setSettings(t, !0);
                                    var i = this.constructor._removeBrackets(
                                            e,
                                            this.settings
                                        ),
                                        n =
                                            this.constructor._stripAllNonNumberCharacters(
                                                i,
                                                this.settings,
                                                !0,
                                                this.isFocused
                                            );
                                    return (
                                        h.isNumber(n) ||
                                            h.throwError(
                                                "The value is not a valid one, it's not a numeric string nor a recognized currency."
                                            ),
                                        this.constructor._isWithinRangeWithOverrideOption(
                                            n,
                                            this.settings
                                        )
                                            ? this.setValue(e)
                                            : h.throwError(
                                                  "The value is out of the range limits ["
                                                      .concat(
                                                          this.settings
                                                              .minimumValue,
                                                          ", "
                                                      )
                                                      .concat(
                                                          this.settings
                                                              .maximumValue,
                                                          "]."
                                                      )
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "setValue",
                                value: function (e) {
                                    var t =
                                        !(
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                        ) || arguments[1];
                                    return (
                                        this._setElementAndRawValue(e, t), this
                                    );
                                },
                            },
                            {
                                key: "_setRawValue",
                                value: function (t) {
                                    var i =
                                        !(
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                        ) || arguments[1];
                                    if (this.rawValue !== t) {
                                        var n = this.rawValue;
                                        (this.rawValue = t),
                                            !h.isNull(
                                                this.settings.rawValueDivisor
                                            ) &&
                                                0 !==
                                                    this.settings
                                                        .rawValueDivisor &&
                                                "" !== t &&
                                                null !== t &&
                                                this._isUserManuallyEditingTheValue() &&
                                                (this.rawValue /=
                                                    this.settings.rawValueDivisor),
                                            this._triggerEvent(
                                                e.events.rawValueModified,
                                                this.domElement,
                                                {
                                                    oldRawValue: n,
                                                    newRawValue: this.rawValue,
                                                    isPristine: this.isPristine(
                                                        !0
                                                    ),
                                                    error: null,
                                                    aNElement: this,
                                                }
                                            ),
                                            this._parseStyleRules(),
                                            i && this._historyTableAdd();
                                    }
                                },
                            },
                            {
                                key: "_setElementValue",
                                value: function (t) {
                                    var i =
                                            !(
                                                arguments.length > 1 &&
                                                void 0 !== arguments[1]
                                            ) || arguments[1],
                                        n = h.getElementValue(this.domElement);
                                    return (
                                        t !== n &&
                                            ((this.internalModification = !0),
                                            h.setElementValue(
                                                this.domElement,
                                                t
                                            ),
                                            (this.internalModification = !1),
                                            i &&
                                                this._triggerEvent(
                                                    e.events.formatted,
                                                    this.domElement,
                                                    {
                                                        oldValue: n,
                                                        newValue: t,
                                                        oldRawValue:
                                                            this.rawValue,
                                                        newRawValue:
                                                            this.rawValue,
                                                        isPristine:
                                                            this.isPristine(!1),
                                                        error: null,
                                                        aNElement: this,
                                                    }
                                                )),
                                        this
                                    );
                                },
                            },
                            {
                                key: "_setElementAndRawValue",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null,
                                        i =
                                            !(
                                                arguments.length > 2 &&
                                                void 0 !== arguments[2]
                                            ) || arguments[2];
                                    return (
                                        h.isNull(t)
                                            ? (t = e)
                                            : h.isBoolean(t) &&
                                              ((i = t), (t = e)),
                                        this._setElementValue(e),
                                        this._setRawValue(t, i),
                                        this
                                    );
                                },
                            },
                            {
                                key: "_getRawValueToFormat",
                                value: function (e) {
                                    return h.isNull(
                                        this.settings.rawValueDivisor
                                    ) ||
                                        0 === this.settings.rawValueDivisor ||
                                        "" === e ||
                                        null === e
                                        ? e
                                        : e * this.settings.rawValueDivisor;
                                },
                            },
                            {
                                key: "_checkValuesToStrings",
                                value: function (e) {
                                    return this.constructor._checkValuesToStringsArray(
                                        e,
                                        this.valuesToStringsKeys
                                    );
                                },
                            },
                            {
                                key: "_isUserManuallyEditingTheValue",
                                value: function () {
                                    return (
                                        (this.isFocused && this.isEditing) ||
                                        this.isDropEvent
                                    );
                                },
                            },
                            {
                                key: "_executeCallback",
                                value: function (e, t) {
                                    !h.isNull(t) &&
                                        h.isFunction(t) &&
                                        t(e, this);
                                },
                            },
                            {
                                key: "_triggerEvent",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : document,
                                        i =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null;
                                    h.triggerEvent(
                                        e,
                                        t,
                                        i,
                                        this.settings.eventBubbles,
                                        this.settings.eventIsCancelable
                                    );
                                },
                            },
                            {
                                key: "get",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return this.getNumericString(e);
                                },
                            },
                            {
                                key: "getNumericString",
                                value: function () {
                                    var e,
                                        t =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null;
                                    return (
                                        (e = h.isNull(this.rawValue)
                                            ? null
                                            : h.trimPaddedZerosFromDecimalPlaces(
                                                  this.rawValue
                                              )),
                                        this._executeCallback(e, t),
                                        e
                                    );
                                },
                            },
                            {
                                key: "getFormatted",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    "value" in this.domElement ||
                                        "textContent" in this.domElement ||
                                        h.throwError(
                                            "Unable to get the formatted string from the element."
                                        );
                                    var t = h.getElementValue(this.domElement);
                                    return this._executeCallback(t, e), t;
                                },
                            },
                            {
                                key: "getNumber",
                                value: function () {
                                    var e,
                                        t =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null;
                                    return (
                                        (e =
                                            null === this.rawValue
                                                ? null
                                                : this.constructor._toLocale(
                                                      this.getNumericString(),
                                                      "number",
                                                      this.settings
                                                  )),
                                        this._executeCallback(e, t),
                                        e
                                    );
                                },
                            },
                            {
                                key: "getLocalized",
                                value: function () {
                                    var t,
                                        i,
                                        n =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        a =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null;
                                    h.isFunction(n) &&
                                        h.isNull(a) &&
                                        ((a = n), (n = null)),
                                        "" !=
                                            (t = h.isEmptyString(this.rawValue)
                                                ? ""
                                                : "" + Number(this.rawValue)) &&
                                            0 === Number(t) &&
                                            this.settings.leadingZero !==
                                                e.options.leadingZero.keep &&
                                            (t = "0"),
                                        (i = h.isNull(n)
                                            ? this.settings.outputFormat
                                            : n);
                                    var r = this.constructor._toLocale(
                                        t,
                                        i,
                                        this.settings
                                    );
                                    return this._executeCallback(r, a), r;
                                },
                            },
                            {
                                key: "reformat",
                                value: function () {
                                    return this.set(this.rawValue), this;
                                },
                            },
                            {
                                key: "unformat",
                                value: function () {
                                    return (
                                        this._setElementValue(
                                            this.getNumericString()
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "unformatLocalized",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._setElementValue(
                                            this.getLocalized(e)
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "isPristine",
                                value: function () {
                                    return arguments.length > 0 &&
                                        void 0 !== arguments[0] &&
                                        !arguments[0]
                                        ? this.initialValueHtmlAttribute ===
                                              this.getFormatted()
                                        : this.initialValue ===
                                              this.getNumericString();
                                },
                            },
                            {
                                key: "select",
                                value: function () {
                                    return (
                                        this.settings.selectNumberOnly
                                            ? this.selectNumber()
                                            : this._defaultSelectAll(),
                                        this
                                    );
                                },
                            },
                            {
                                key: "_defaultSelectAll",
                                value: function () {
                                    h.setElementSelection(
                                        this.domElement,
                                        0,
                                        h.getElementValue(this.domElement)
                                            .length
                                    );
                                },
                            },
                            {
                                key: "selectNumber",
                                value: function () {
                                    var t,
                                        i,
                                        n = h.getElementValue(this.domElement),
                                        a = n.length,
                                        r = this.settings.currencySymbol.length,
                                        o =
                                            this.settings
                                                .currencySymbolPlacement,
                                        s = h.isNegative(
                                            n,
                                            this.settings.negativeSignCharacter
                                        )
                                            ? 1
                                            : 0,
                                        l = this.settings.suffixText.length;
                                    if (
                                        ((t =
                                            o ===
                                            e.options.currencySymbolPlacement
                                                .suffix
                                                ? 0
                                                : this.settings
                                                      .negativePositiveSignPlacement ===
                                                      e.options
                                                          .negativePositiveSignPlacement
                                                          .left &&
                                                  1 === s &&
                                                  r > 0
                                                ? r + 1
                                                : r),
                                        o ===
                                            e.options.currencySymbolPlacement
                                                .prefix)
                                    )
                                        i = a - l;
                                    else
                                        switch (
                                            this.settings
                                                .negativePositiveSignPlacement
                                        ) {
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .left:
                                                i = a - (l + r);
                                                break;
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .right:
                                                i =
                                                    r > 0
                                                        ? a - (r + s + l)
                                                        : a - (r + l);
                                                break;
                                            default:
                                                i = a - (r + l);
                                        }
                                    return (
                                        h.setElementSelection(
                                            this.domElement,
                                            t,
                                            i
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "selectInteger",
                                value: function () {
                                    var t = 0,
                                        i = this.rawValue >= 0;
                                    (this.settings.currencySymbolPlacement !==
                                        e.options.currencySymbolPlacement
                                            .prefix &&
                                        (this.settings
                                            .currencySymbolPlacement !==
                                            e.options.currencySymbolPlacement
                                                .suffix ||
                                            (this.settings
                                                .negativePositiveSignPlacement !==
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .prefix &&
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none))) ||
                                        (((this.settings.showPositiveSign &&
                                            i) ||
                                            (!i &&
                                                this.settings
                                                    .currencySymbolPlacement ===
                                                    e.options
                                                        .currencySymbolPlacement
                                                        .prefix &&
                                                this.settings
                                                    .negativePositiveSignPlacement ===
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .left)) &&
                                            (t += 1)),
                                        this.settings
                                            .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .prefix &&
                                            (t +=
                                                this.settings.currencySymbol
                                                    .length);
                                    var n = h.getElementValue(this.domElement),
                                        a = n.indexOf(
                                            this.settings.decimalCharacter
                                        );
                                    return (
                                        -1 === a &&
                                            ((a =
                                                this.settings
                                                    .currencySymbolPlacement ===
                                                e.options
                                                    .currencySymbolPlacement
                                                    .suffix
                                                    ? n.length -
                                                      this.settings
                                                          .currencySymbol.length
                                                    : n.length),
                                            i ||
                                                (this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix &&
                                                    this.settings
                                                        .currencySymbolPlacement !==
                                                        e.options
                                                            .currencySymbolPlacement
                                                            .suffix) ||
                                                (a -= 1),
                                            (a -=
                                                this.settings.suffixText
                                                    .length)),
                                        h.setElementSelection(
                                            this.domElement,
                                            t,
                                            a
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "selectDecimal",
                                value: function () {
                                    var e,
                                        t,
                                        i = h
                                            .getElementValue(this.domElement)
                                            .indexOf(
                                                this.settings.decimalCharacter
                                            );
                                    return (
                                        -1 === i
                                            ? ((i = 0), (e = 0))
                                            : ((i += 1),
                                              (t = this.isFocused
                                                  ? this.settings
                                                        .decimalPlacesShownOnFocus
                                                  : this.settings
                                                        .decimalPlacesShownOnBlur),
                                              (e = i + Number(t))),
                                        h.setElementSelection(
                                            this.domElement,
                                            i,
                                            e
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "node",
                                value: function () {
                                    return this.domElement;
                                },
                            },
                            {
                                key: "parent",
                                value: function () {
                                    return this.domElement.parentNode;
                                },
                            },
                            {
                                key: "detach",
                                value: function () {
                                    var e,
                                        t =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null;
                                    return (
                                        (e = h.isNull(t)
                                            ? this.domElement
                                            : t.node()),
                                        this._removeFromLocalList(e),
                                        this
                                    );
                                },
                            },
                            {
                                key: "attach",
                                value: function (e) {
                                    var t =
                                        !(
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                        ) || arguments[1];
                                    return (
                                        this._addToLocalList(e.node()),
                                        t && e.update(this.settings),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formatOther",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return this._formatOrUnformatOther(
                                        !0,
                                        e,
                                        t
                                    );
                                },
                            },
                            {
                                key: "unformatOther",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return this._formatOrUnformatOther(
                                        !1,
                                        e,
                                        t
                                    );
                                },
                            },
                            {
                                key: "_formatOrUnformatOther",
                                value: function (t, i) {
                                    var n,
                                        a,
                                        r =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null;
                                    if (
                                        ((n = h.isNull(r)
                                            ? this.settings
                                            : this._cloneAndMergeSettings(r)),
                                        h.isElement(i))
                                    ) {
                                        var o = h.getElementValue(i);
                                        return (
                                            (a = t
                                                ? e.format(o, n)
                                                : e.unformat(o, n)),
                                            h.setElementValue(i, a),
                                            null
                                        );
                                    }
                                    return (a = t
                                        ? e.format(i, n)
                                        : e.unformat(i, n));
                                },
                            },
                            {
                                key: "init",
                                value: function (t) {
                                    var i = this,
                                        n =
                                            !(
                                                arguments.length > 1 &&
                                                void 0 !== arguments[1]
                                            ) || arguments[1],
                                        a = !1,
                                        r = [];
                                    if (
                                        (h.isString(t)
                                            ? (r = C(
                                                  document.querySelectorAll(t)
                                              ))
                                            : h.isElement(t)
                                            ? (r.push(t), (a = !0))
                                            : h.isArray(t)
                                            ? (r = t)
                                            : h.throwError(
                                                  "The given parameters to the 'init' function are invalid."
                                              ),
                                        0 === r.length)
                                    )
                                        return (
                                            h.warning(
                                                "No valid DOM elements were given hence no AutoNumeric object were instantiated.",
                                                !0
                                            ),
                                            []
                                        );
                                    var o = this._getLocalList(),
                                        s = [];
                                    return (
                                        r.forEach(function (t) {
                                            var a = i.settings.createLocalList;
                                            n &&
                                                (i.settings.createLocalList =
                                                    !1);
                                            var r = new e(
                                                t,
                                                h.getElementValue(t),
                                                i.settings
                                            );
                                            n &&
                                                (r._setLocalList(o),
                                                i._addToLocalList(t, r),
                                                (i.settings.createLocalList =
                                                    a)),
                                                s.push(r);
                                        }),
                                        a ? s[0] : s
                                    );
                                },
                            },
                            {
                                key: "clear",
                                value: function () {
                                    if (
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0] &&
                                        arguments[0]
                                    ) {
                                        var t = {
                                            emptyInputBehavior:
                                                e.options.emptyInputBehavior
                                                    .focus,
                                        };
                                        this.set("", t);
                                    } else this.set("");
                                    return this;
                                },
                            },
                            {
                                key: "remove",
                                value: function () {
                                    this._removeValueFromPersistentStorage(),
                                        this._removeEventListeners(),
                                        this._removeWatcher(),
                                        this._removeFromLocalList(
                                            this.domElement
                                        ),
                                        this.constructor._removeFromGlobalList(
                                            this
                                        );
                                },
                            },
                            {
                                key: "wipe",
                                value: function () {
                                    this._setElementValue("", !1),
                                        this.remove();
                                },
                            },
                            {
                                key: "nuke",
                                value: function () {
                                    this.remove(),
                                        this.domElement.parentNode.removeChild(
                                            this.domElement
                                        );
                                },
                            },
                            {
                                key: "form",
                                value: function () {
                                    if (
                                        (arguments.length > 0 &&
                                            void 0 !== arguments[0] &&
                                            arguments[0]) ||
                                        h.isUndefinedOrNullOrEmpty(
                                            this.parentForm
                                        )
                                    ) {
                                        var e = this._getParentForm();
                                        if (
                                            !h.isNull(e) &&
                                            e !== this.parentForm
                                        ) {
                                            var t =
                                                this._getFormAutoNumericChildren(
                                                    this.parentForm
                                                );
                                            (this.parentForm.dataset.anCount =
                                                t.length),
                                                this._hasFormHandlerFunction(e)
                                                    ? this._incrementParentFormCounter(
                                                          e
                                                      )
                                                    : (this._storeFormHandlerFunction(
                                                          e
                                                      ),
                                                      this._initializeFormCounterToOne(
                                                          e
                                                      ));
                                        }
                                        this.parentForm = e;
                                    }
                                    return this.parentForm;
                                },
                            },
                            {
                                key: "_getFormAutoNumericChildren",
                                value: function (e) {
                                    var t = this;
                                    return C(
                                        e.querySelectorAll("input")
                                    ).filter(function (e) {
                                        return t.constructor.isManagedByAutoNumeric(
                                            e
                                        );
                                    });
                                },
                            },
                            {
                                key: "_getParentForm",
                                value: function () {
                                    if (
                                        "body" ===
                                        this.domElement.tagName.toLowerCase()
                                    )
                                        return null;
                                    var e,
                                        t = this.domElement;
                                    do {
                                        if (((t = t.parentNode), h.isNull(t)))
                                            return null;
                                        if (
                                            "body" ===
                                            (e = t.tagName
                                                ? t.tagName.toLowerCase()
                                                : "")
                                        )
                                            break;
                                    } while ("form" !== e);
                                    return "form" === e ? t : null;
                                },
                            },
                            {
                                key: "formNumericString",
                                value: function () {
                                    return this.constructor._serializeNumericString(
                                        this.form(),
                                        this.settings.serializeSpaces
                                    );
                                },
                            },
                            {
                                key: "formFormatted",
                                value: function () {
                                    return this.constructor._serializeFormatted(
                                        this.form(),
                                        this.settings.serializeSpaces
                                    );
                                },
                            },
                            {
                                key: "formLocalized",
                                value: function () {
                                    var e,
                                        t =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null;
                                    return (
                                        (e = h.isNull(t)
                                            ? this.settings.outputFormat
                                            : t),
                                        this.constructor._serializeLocalized(
                                            this.form(),
                                            this.settings.serializeSpaces,
                                            e
                                        )
                                    );
                                },
                            },
                            {
                                key: "formArrayNumericString",
                                value: function () {
                                    return this.constructor._serializeNumericStringArray(
                                        this.form(),
                                        this.settings.serializeSpaces
                                    );
                                },
                            },
                            {
                                key: "formArrayFormatted",
                                value: function () {
                                    return this.constructor._serializeFormattedArray(
                                        this.form(),
                                        this.settings.serializeSpaces
                                    );
                                },
                            },
                            {
                                key: "formArrayLocalized",
                                value: function () {
                                    var e,
                                        t =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null;
                                    return (
                                        (e = h.isNull(t)
                                            ? this.settings.outputFormat
                                            : t),
                                        this.constructor._serializeLocalizedArray(
                                            this.form(),
                                            this.settings.serializeSpaces,
                                            e
                                        )
                                    );
                                },
                            },
                            {
                                key: "formJsonNumericString",
                                value: function () {
                                    return JSON.stringify(
                                        this.formArrayNumericString()
                                    );
                                },
                            },
                            {
                                key: "formJsonFormatted",
                                value: function () {
                                    return JSON.stringify(
                                        this.formArrayFormatted()
                                    );
                                },
                            },
                            {
                                key: "formJsonLocalized",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return JSON.stringify(
                                        this.formArrayLocalized(e)
                                    );
                                },
                            },
                            {
                                key: "formUnformat",
                                value: function () {
                                    return (
                                        this.constructor
                                            ._getChildANInputElement(
                                                this.form()
                                            )
                                            .forEach(function (t) {
                                                e.getAutoNumericElement(
                                                    t
                                                ).unformat();
                                            }),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formUnformatLocalized",
                                value: function () {
                                    return (
                                        this.constructor
                                            ._getChildANInputElement(
                                                this.form()
                                            )
                                            .forEach(function (t) {
                                                e.getAutoNumericElement(
                                                    t
                                                ).unformatLocalized();
                                            }),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formReformat",
                                value: function () {
                                    return (
                                        this.constructor
                                            ._getChildANInputElement(
                                                this.form()
                                            )
                                            .forEach(function (t) {
                                                e.getAutoNumericElement(
                                                    t
                                                ).reformat();
                                            }),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitNumericString",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        h.isNull(e)
                                            ? (this.formUnformat(),
                                              this.form().submit(),
                                              this.formReformat())
                                            : h.isFunction(e)
                                            ? e(this.formNumericString())
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitFormatted",
                                value: function () {
                                    var e =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        h.isNull(e)
                                            ? this.form().submit()
                                            : h.isFunction(e)
                                            ? e(this.formFormatted())
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitLocalized",
                                value: function () {
                                    var e =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null;
                                    return (
                                        h.isNull(t)
                                            ? (this.formUnformatLocalized(),
                                              this.form().submit(),
                                              this.formReformat())
                                            : h.isFunction(t)
                                            ? t(this.formLocalized(e))
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitArrayNumericString",
                                value: function (e) {
                                    return (
                                        h.isFunction(e)
                                            ? e(this.formArrayNumericString())
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitArrayFormatted",
                                value: function (e) {
                                    return (
                                        h.isFunction(e)
                                            ? e(this.formArrayFormatted())
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitArrayLocalized",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return (
                                        h.isFunction(e)
                                            ? e(this.formArrayLocalized(t))
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitJsonNumericString",
                                value: function (e) {
                                    return (
                                        h.isFunction(e)
                                            ? e(this.formJsonNumericString())
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitJsonFormatted",
                                value: function (e) {
                                    return (
                                        h.isFunction(e)
                                            ? e(this.formJsonFormatted())
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "formSubmitJsonLocalized",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return (
                                        h.isFunction(e)
                                            ? e(this.formJsonLocalized(t))
                                            : h.throwError(
                                                  "The given callback is not a function."
                                              ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "_createLocalList",
                                value: function () {
                                    (this.autoNumericLocalList = new Map()),
                                        this._addToLocalList(this.domElement);
                                },
                            },
                            {
                                key: "_deleteLocalList",
                                value: function () {
                                    delete this.autoNumericLocalList;
                                },
                            },
                            {
                                key: "_setLocalList",
                                value: function (e) {
                                    this.autoNumericLocalList = e;
                                },
                            },
                            {
                                key: "_getLocalList",
                                value: function () {
                                    return this.autoNumericLocalList;
                                },
                            },
                            {
                                key: "_hasLocalList",
                                value: function () {
                                    return (
                                        this.autoNumericLocalList instanceof
                                            Map &&
                                        0 !== this.autoNumericLocalList.size
                                    );
                                },
                            },
                            {
                                key: "_addToLocalList",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    h.isNull(t) && (t = this),
                                        h.isUndefined(this.autoNumericLocalList)
                                            ? h.throwError(
                                                  "The local list provided does not exists when trying to add an element. [".concat(
                                                      this.autoNumericLocalList,
                                                      "] given."
                                                  )
                                              )
                                            : this.autoNumericLocalList.set(
                                                  e,
                                                  t
                                              );
                                },
                            },
                            {
                                key: "_removeFromLocalList",
                                value: function (e) {
                                    h.isUndefined(this.autoNumericLocalList)
                                        ? this.settings.createLocalList &&
                                          h.throwError(
                                              "The local list provided does not exists when trying to remove an element. [".concat(
                                                  this.autoNumericLocalList,
                                                  "] given."
                                              )
                                          )
                                        : this.autoNumericLocalList.delete(e);
                                },
                            },
                            {
                                key: "_mergeSettings",
                                value: function () {
                                    for (
                                        var e = arguments.length,
                                            t = new Array(e),
                                            i = 0;
                                        i < e;
                                        i++
                                    )
                                        t[i] = arguments[i];
                                    T.apply(void 0, [this.settings].concat(t));
                                },
                            },
                            {
                                key: "_cloneAndMergeSettings",
                                value: function () {
                                    for (
                                        var e = {},
                                            t = arguments.length,
                                            i = new Array(t),
                                            n = 0;
                                        n < t;
                                        n++
                                    )
                                        i[n] = arguments[n];
                                    return (
                                        T.apply(
                                            void 0,
                                            [e, this.settings].concat(i)
                                        ),
                                        e
                                    );
                                },
                            },
                            {
                                key: "_updatePredefinedOptions",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return (
                                        h.isNull(t)
                                            ? this.update(e)
                                            : (this._mergeSettings(e, t),
                                              this.update(this.settings)),
                                        this
                                    );
                                },
                            },
                            {
                                key: "french",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().French,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "northAmerican",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions()
                                                .NorthAmerican,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "british",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().British,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "swiss",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().Swiss,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "japanese",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().Japanese,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "spanish",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().Spanish,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "chinese",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().Chinese,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "brazilian",
                                value: function () {
                                    var t =
                                        arguments.length > 0 &&
                                        void 0 !== arguments[0]
                                            ? arguments[0]
                                            : null;
                                    return (
                                        this._updatePredefinedOptions(
                                            e.getPredefinedOptions().Brazilian,
                                            t
                                        ),
                                        this
                                    );
                                },
                            },
                            {
                                key: "_runCallbacksFoundInTheSettingsObject",
                                value: function () {
                                    for (var e in this.settings)
                                        if (
                                            Object.prototype.hasOwnProperty.call(
                                                this.settings,
                                                e
                                            )
                                        ) {
                                            var t = this.settings[e];
                                            if ("function" == typeof t)
                                                this.settings[e] = t(this, e);
                                            else {
                                                var i =
                                                    this.domElement.getAttribute(
                                                        e
                                                    );
                                                (i = h.camelize(i)),
                                                    "function" ==
                                                        typeof this.settings[
                                                            i
                                                        ] &&
                                                        (this.settings[e] = i(
                                                            this,
                                                            e
                                                        ));
                                            }
                                        }
                                },
                            },
                            {
                                key: "_setTrailingNegativeSignInfo",
                                value: function () {
                                    this.isTrailingNegative =
                                        (this.settings
                                            .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .prefix &&
                                            this.settings
                                                .negativePositiveSignPlacement ===
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .suffix) ||
                                        (this.settings
                                            .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .suffix &&
                                            (this.settings
                                                .negativePositiveSignPlacement ===
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .left ||
                                                this.settings
                                                    .negativePositiveSignPlacement ===
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .right));
                                },
                            },
                            {
                                key: "_modifyNegativeSignAndDecimalCharacterForRawValue",
                                value: function (e) {
                                    return (
                                        "." !==
                                            this.settings.decimalCharacter &&
                                            (e = e.replace(
                                                this.settings.decimalCharacter,
                                                "."
                                            )),
                                        "-" !==
                                            this.settings
                                                .negativeSignCharacter &&
                                            this.settings
                                                .isNegativeSignAllowed &&
                                            (e = e.replace(
                                                this.settings
                                                    .negativeSignCharacter,
                                                "-"
                                            )),
                                        e.match(/\d/) || (e += "0"),
                                        e
                                    );
                                },
                            },
                            {
                                key: "_initialCaretPosition",
                                value: function (t) {
                                    h.isNull(
                                        this.settings.caretPositionOnFocus
                                    ) &&
                                        this.settings.selectOnFocus ===
                                            e.options.selectOnFocus
                                                .doNotSelect &&
                                        h.throwError(
                                            "`_initialCaretPosition()` should never be called when the `caretPositionOnFocus` option is `null`."
                                        );
                                    var i = this.rawValue < 0,
                                        n = h.isZeroOrHasNoValue(t),
                                        a = t.length,
                                        r = 0,
                                        o = 0,
                                        s = !1,
                                        l = 0;
                                    this.settings.caretPositionOnFocus !==
                                        e.options.caretPositionOnFocus.start &&
                                        ((r = (t = (t = (t = t.replace(
                                            this.settings.negativeSignCharacter,
                                            ""
                                        )).replace(
                                            this.settings.positiveSignCharacter,
                                            ""
                                        )).replace(
                                            this.settings.currencySymbol,
                                            ""
                                        )).length),
                                        (s = h.contains(
                                            t,
                                            this.settings.decimalCharacter
                                        )),
                                        (this.settings.caretPositionOnFocus !==
                                            e.options.caretPositionOnFocus
                                                .decimalLeft &&
                                            this.settings
                                                .caretPositionOnFocus !==
                                                e.options.caretPositionOnFocus
                                                    .decimalRight) ||
                                            (s
                                                ? ((o = t.indexOf(
                                                      this.settings
                                                          .decimalCharacter
                                                  )),
                                                  (l =
                                                      this.settings
                                                          .decimalCharacter
                                                          .length))
                                                : ((o = r), (l = 0))));
                                    var u = "";
                                    i
                                        ? (u =
                                              this.settings
                                                  .negativeSignCharacter)
                                        : this.settings.showPositiveSign &&
                                          !n &&
                                          (u =
                                              this.settings
                                                  .positiveSignCharacter);
                                    var c,
                                        m = u.length,
                                        g = this.settings.currencySymbol.length;
                                    if (
                                        this.settings
                                            .currencySymbolPlacement ===
                                        e.options.currencySymbolPlacement.prefix
                                    ) {
                                        if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus.start
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                        c = m + g;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                        c = g;
                                                }
                                            else c = g;
                                        else if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus.end
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                        c = a;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                        c = g + r;
                                                }
                                            else c = a;
                                        else if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus
                                                .decimalLeft
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                        c = m + g + o;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                        c = g + o;
                                                }
                                            else c = g + o;
                                        else if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus
                                                .decimalRight
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                        c = m + g + o + l;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                        c = g + o + l;
                                                }
                                            else c = g + o + l;
                                    } else if (
                                        this.settings
                                            .currencySymbolPlacement ===
                                        e.options.currencySymbolPlacement.suffix
                                    )
                                        if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus.start
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                        c = 0;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                        c = m;
                                                }
                                            else c = 0;
                                        else if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus.end
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                        c = r;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                        c = m + r;
                                                }
                                            else c = r;
                                        else if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus
                                                .decimalLeft
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                        c = o;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                        c = m + o;
                                                }
                                            else c = o;
                                        else if (
                                            this.settings
                                                .caretPositionOnFocus ===
                                            e.options.caretPositionOnFocus
                                                .decimalRight
                                        )
                                            if (
                                                this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .none &&
                                                (i ||
                                                    (!i &&
                                                        this.settings
                                                            .showPositiveSign &&
                                                        !n))
                                            )
                                                switch (
                                                    this.settings
                                                        .negativePositiveSignPlacement
                                                ) {
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .suffix:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .right:
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .left:
                                                        c = o + l;
                                                        break;
                                                    case e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix:
                                                        c = m + o + l;
                                                }
                                            else c = o + l;
                                    return c;
                                },
                            },
                            {
                                key: "_triggerRangeEvents",
                                value: function (t, i) {
                                    t ||
                                        this._triggerEvent(
                                            e.events.minRangeExceeded,
                                            this.domElement
                                        ),
                                        i ||
                                            this._triggerEvent(
                                                e.events.maxRangeExceeded,
                                                this.domElement
                                            );
                                },
                            },
                            {
                                key: "_setInvalidState",
                                value: function () {
                                    this.isInputElement
                                        ? h.setInvalidState(this.domElement)
                                        : this._addCSSClass(
                                              this.settings.invalidClass
                                          ),
                                        this._triggerEvent(
                                            e.events.invalidValue,
                                            this.domElement
                                        ),
                                        (this.validState = !1);
                                },
                            },
                            {
                                key: "_setValidState",
                                value: function () {
                                    this.isInputElement
                                        ? h.setValidState(this.domElement)
                                        : this._removeCSSClass(
                                              this.settings.invalidClass
                                          ),
                                        this.validState ||
                                            this._triggerEvent(
                                                e.events.correctedValue,
                                                this.domElement
                                            ),
                                        (this.validState = !0);
                                },
                            },
                            {
                                key: "_setValidOrInvalidState",
                                value: function (t) {
                                    if (
                                        this.settings.overrideMinMaxLimits ===
                                        e.options.overrideMinMaxLimits.invalid
                                    ) {
                                        var i =
                                                this.constructor._isMinimumRangeRespected(
                                                    t,
                                                    this.settings
                                                ),
                                            n =
                                                this.constructor._isMaximumRangeRespected(
                                                    t,
                                                    this.settings
                                                );
                                        i && n
                                            ? this._setValidState()
                                            : this._setInvalidState(),
                                            this._triggerRangeEvents(i, n);
                                    }
                                },
                            },
                            {
                                key: "_keepAnOriginalSettingsCopy",
                                value: function () {
                                    (this.originalDigitGroupSeparator =
                                        this.settings.digitGroupSeparator),
                                        (this.originalCurrencySymbol =
                                            this.settings.currencySymbol),
                                        (this.originalSuffixText =
                                            this.settings.suffixText);
                                },
                            },
                            {
                                key: "_trimLeadingAndTrailingZeros",
                                value: function (t) {
                                    if ("" === t || null === t) return t;
                                    if (
                                        this.settings.leadingZero !==
                                        e.options.leadingZero.keep
                                    ) {
                                        if (0 === Number(t)) return "0";
                                        t = t.replace(/^(-)?0+(?=\d)/g, "$1");
                                    }
                                    return (
                                        h.contains(t, ".") &&
                                            (t = t.replace(
                                                /(\.[0-9]*?)0+$/,
                                                "$1"
                                            )),
                                        (t = t.replace(/\.$/, ""))
                                    );
                                },
                            },
                            {
                                key: "_setPersistentStorageName",
                                value: function () {
                                    this.settings.saveValueToSessionStorage &&
                                        ("" === this.domElement.name ||
                                        h.isUndefined(this.domElement.name)
                                            ? (this.rawValueStorageName = ""
                                                  .concat(
                                                      this.storageNamePrefix
                                                  )
                                                  .concat(this.domElement.id))
                                            : (this.rawValueStorageName = ""
                                                  .concat(
                                                      this.storageNamePrefix
                                                  )
                                                  .concat(
                                                      decodeURIComponent(
                                                          this.domElement.name
                                                      )
                                                  )));
                                },
                            },
                            {
                                key: "_saveValueToPersistentStorage",
                                value: function () {
                                    this.settings.saveValueToSessionStorage &&
                                        (this.sessionStorageAvailable
                                            ? sessionStorage.setItem(
                                                  this.rawValueStorageName,
                                                  this.rawValue
                                              )
                                            : (document.cookie = ""
                                                  .concat(
                                                      this.rawValueStorageName,
                                                      "="
                                                  )
                                                  .concat(
                                                      this.rawValue,
                                                      "; expires= ; path=/"
                                                  )));
                                },
                            },
                            {
                                key: "_getValueFromPersistentStorage",
                                value: function () {
                                    return this.settings
                                        .saveValueToSessionStorage
                                        ? this.sessionStorageAvailable
                                            ? sessionStorage.getItem(
                                                  this.rawValueStorageName
                                              )
                                            : this.constructor._readCookie(
                                                  this.rawValueStorageName
                                              )
                                        : (h.warning(
                                              "`_getValueFromPersistentStorage()` is called but `settings.saveValueToSessionStorage` is false. There must be an error that needs fixing.",
                                              this.settings.showWarnings
                                          ),
                                          null);
                                },
                            },
                            {
                                key: "_removeValueFromPersistentStorage",
                                value: function () {
                                    if (this.settings.saveValueToSessionStorage)
                                        if (this.sessionStorageAvailable)
                                            sessionStorage.removeItem(
                                                this.rawValueStorageName
                                            );
                                        else {
                                            var e = new Date();
                                            e.setTime(e.getTime() - 864e5);
                                            var t = "; expires=".concat(
                                                e.toUTCString()
                                            );
                                            document.cookie = ""
                                                .concat(
                                                    this.rawValueStorageName,
                                                    "='' ;"
                                                )
                                                .concat(t, "; path=/");
                                        }
                                },
                            },
                            {
                                key: "_getDefaultValue",
                                value: function (e) {
                                    var t = e.getAttribute("value");
                                    return h.isNull(t) ? "" : t;
                                },
                            },
                            {
                                key: "_onFocusInAndMouseEnter",
                                value: function (t) {
                                    if (
                                        ((this.isEditing = !1),
                                        !this.formulaMode &&
                                            this.settings.unformatOnHover &&
                                            "mouseenter" === t.type &&
                                            t.altKey)
                                    )
                                        this.constructor._unformatAltHovered(
                                            this
                                        );
                                    else if (
                                        ("focus" === t.type &&
                                            ((this.isFocused = !0),
                                            (this.rawValueOnFocus =
                                                this.rawValue)),
                                        "focus" === t.type &&
                                            this.settings.unformatOnHover &&
                                            this.hoveredWithAlt &&
                                            this.constructor._reformatAltHovered(
                                                this
                                            ),
                                        "focus" === t.type ||
                                            ("mouseenter" === t.type &&
                                                !this.isFocused))
                                    ) {
                                        var i = null;
                                        this.settings.emptyInputBehavior ===
                                            e.options.emptyInputBehavior
                                                .focus &&
                                            this.rawValue < 0 &&
                                            null !==
                                                this.settings
                                                    .negativeBracketsTypeOnBlur &&
                                            this.settings
                                                .isNegativeSignAllowed &&
                                            (i =
                                                this.constructor._removeBrackets(
                                                    h.getElementValue(
                                                        this.domElement
                                                    ),
                                                    this.settings
                                                ));
                                        var n = this._getRawValueToFormat(
                                            this.rawValue
                                        );
                                        if ("" !== n) {
                                            var a =
                                                this.constructor._roundFormattedValueShownOnFocusOrBlur(
                                                    n,
                                                    this.settings,
                                                    this.isFocused
                                                );
                                            this.settings
                                                .showOnlyNumbersOnFocus ===
                                            e.options.showOnlyNumbersOnFocus
                                                .onlyNumbers
                                                ? ((this.settings.digitGroupSeparator =
                                                      ""),
                                                  (this.settings.currencySymbol =
                                                      ""),
                                                  (this.settings.suffixText =
                                                      ""),
                                                  (i = a.replace(
                                                      ".",
                                                      this.settings
                                                          .decimalCharacter
                                                  )))
                                                : (i = h.isNull(a)
                                                      ? ""
                                                      : this.constructor._addGroupSeparators(
                                                            a.replace(
                                                                ".",
                                                                this.settings
                                                                    .decimalCharacter
                                                            ),
                                                            this.settings,
                                                            this.isFocused,
                                                            n
                                                        ));
                                        }
                                        h.isNull(i)
                                            ? (this.valueOnFocus = "")
                                            : (this.valueOnFocus = i),
                                            (this.lastVal = this.valueOnFocus);
                                        var r =
                                                this.constructor._isElementValueEmptyOrOnlyTheNegativeSign(
                                                    this.valueOnFocus,
                                                    this.settings
                                                ),
                                            o =
                                                this.constructor._orderValueCurrencySymbolAndSuffixText(
                                                    this.valueOnFocus,
                                                    this.settings,
                                                    !0
                                                ),
                                            s =
                                                r &&
                                                "" !== o &&
                                                this.settings
                                                    .emptyInputBehavior ===
                                                    e.options.emptyInputBehavior
                                                        .focus;
                                        s && (i = o),
                                            h.isNull(i) ||
                                                this._setElementValue(i),
                                            s &&
                                                o ===
                                                    this.settings
                                                        .currencySymbol &&
                                                this.settings
                                                    .currencySymbolPlacement ===
                                                    e.options
                                                        .currencySymbolPlacement
                                                        .suffix &&
                                                h.setElementSelection(
                                                    t.target,
                                                    0
                                                );
                                    }
                                },
                            },
                            {
                                key: "_onFocus",
                                value: function () {
                                    this.settings.isCancellable &&
                                        this._saveCancellableValue();
                                },
                            },
                            {
                                key: "_onFocusIn",
                                value: function (e) {
                                    this.settings.selectOnFocus
                                        ? this.select()
                                        : h.isNull(
                                              this.settings.caretPositionOnFocus
                                          ) ||
                                          h.setElementSelection(
                                              e.target,
                                              this._initialCaretPosition(
                                                  h.getElementValue(
                                                      this.domElement
                                                  )
                                              )
                                          );
                                },
                            },
                            {
                                key: "_enterFormulaMode",
                                value: function () {
                                    this.settings.formulaMode &&
                                        ((this.formulaMode = !0),
                                        h.setElementValue(this.domElement, "="),
                                        h.setElementSelection(
                                            this.domElement,
                                            1
                                        ));
                                },
                            },
                            {
                                key: "_exitFormulaMode",
                                value: function () {
                                    var t,
                                        i = h.getElementValue(this.domElement);
                                    i = i.replace(/^\s*=/, "");
                                    try {
                                        var n = new _(
                                            i,
                                            this.settings.decimalCharacter
                                        );
                                        t = new d().evaluate(n);
                                    } catch (a) {
                                        return (
                                            this._triggerEvent(
                                                e.events.invalidFormula,
                                                this.domElement,
                                                { formula: i, aNElement: this }
                                            ),
                                            this.reformat(),
                                            void (this.formulaMode = !1)
                                        );
                                    }
                                    this._triggerEvent(
                                        e.events.validFormula,
                                        this.domElement,
                                        {
                                            formula: i,
                                            result: t,
                                            aNElement: this,
                                        }
                                    ),
                                        this.set(t),
                                        (this.formulaMode = !1);
                                },
                            },
                            {
                                key: "_acceptNonPrintableKeysInFormulaMode",
                                value: function () {
                                    return (
                                        this.eventKey === n.keyName.Backspace ||
                                        this.eventKey === n.keyName.Delete ||
                                        this.eventKey === n.keyName.LeftArrow ||
                                        this.eventKey ===
                                            n.keyName.RightArrow ||
                                        this.eventKey === n.keyName.Home ||
                                        this.eventKey === n.keyName.End
                                    );
                                },
                            },
                            {
                                key: "_onKeydown",
                                value: function (t) {
                                    if (
                                        ((this.formatted = !1),
                                        (this.isEditing = !0),
                                        this.formulaMode ||
                                            this.isFocused ||
                                            !this.settings.unformatOnHover ||
                                            !t.altKey ||
                                            this.domElement !==
                                                h.getHoveredElement())
                                    ) {
                                        if (
                                            (this._updateEventKeyInfo(t),
                                            (this.keydownEventCounter += 1),
                                            1 === this.keydownEventCounter &&
                                                ((this.initialValueOnFirstKeydown =
                                                    h.getElementValue(
                                                        t.target
                                                    )),
                                                (this.initialRawValueOnFirstKeydown =
                                                    this.rawValue)),
                                            this.formulaMode)
                                        ) {
                                            if (this.eventKey === n.keyName.Esc)
                                                return (
                                                    (this.formulaMode = !1),
                                                    void this.reformat()
                                                );
                                            if (
                                                this.eventKey ===
                                                n.keyName.Enter
                                            )
                                                return void this._exitFormulaMode();
                                            if (
                                                this._acceptNonPrintableKeysInFormulaMode()
                                            )
                                                return;
                                        } else {
                                            if (
                                                this.eventKey ===
                                                n.keyName.Equal
                                            )
                                                return void this._enterFormulaMode();
                                            if (
                                                this.settings
                                                    .modifyValueOnUpDownArrow &&
                                                (this.eventKey ===
                                                    n.keyName.UpArrow ||
                                                    this.eventKey ===
                                                        n.keyName.DownArrow)
                                            )
                                                return void this.upDownArrowAction(
                                                    t
                                                );
                                        }
                                        if (
                                            this.domElement.readOnly ||
                                            this.settings.readOnly ||
                                            this.domElement.disabled
                                        )
                                            this.processed = !0;
                                        else {
                                            this.eventKey === n.keyName.Esc &&
                                                (t.preventDefault(),
                                                this.settings.isCancellable &&
                                                    this.rawValue !==
                                                        this
                                                            .savedCancellableValue &&
                                                    (this.set(
                                                        this
                                                            .savedCancellableValue
                                                    ),
                                                    this._triggerEvent(
                                                        e.events.native.input,
                                                        t.target
                                                    )),
                                                this.select());
                                            var i = h.getElementValue(t.target);
                                            if (
                                                (this.eventKey ===
                                                    n.keyName.Enter &&
                                                    this.rawValue !==
                                                        this.rawValueOnFocus &&
                                                    (this._triggerEvent(
                                                        e.events.native.change,
                                                        t.target
                                                    ),
                                                    (this.valueOnFocus = i),
                                                    (this.rawValueOnFocus =
                                                        this.rawValue),
                                                    this.settings
                                                        .isCancellable &&
                                                        this._saveCancellableValue()),
                                                this._updateInternalProperties(
                                                    t
                                                ),
                                                this._processNonPrintableKeysAndShortcuts(
                                                    t
                                                ))
                                            )
                                                this.processed = !0;
                                            else if (
                                                this.eventKey ===
                                                    n.keyName.Backspace ||
                                                this.eventKey ===
                                                    n.keyName.Delete
                                            ) {
                                                var a =
                                                    this._processCharacterDeletion(
                                                        t
                                                    );
                                                if (((this.processed = !0), !a))
                                                    return void t.preventDefault();
                                                this._formatValue(t),
                                                    (i = h.getElementValue(
                                                        t.target
                                                    )) !== this.lastVal &&
                                                        this.throwInput &&
                                                        (this._triggerEvent(
                                                            e.events.native
                                                                .input,
                                                            t.target
                                                        ),
                                                        t.preventDefault()),
                                                    (this.lastVal = i),
                                                    (this.throwInput = !0);
                                            }
                                        }
                                    } else
                                        this.constructor._unformatAltHovered(
                                            this
                                        );
                                },
                            },
                            {
                                key: "_onKeypress",
                                value: function (t) {
                                    if (this.formulaMode) {
                                        if (
                                            this._acceptNonPrintableKeysInFormulaMode()
                                        )
                                            return;
                                        if (
                                            this.settings.formulaChars.test(
                                                this.eventKey
                                            )
                                        )
                                            return;
                                        t.preventDefault();
                                    } else if (
                                        this.eventKey !== n.keyName.Insert
                                    ) {
                                        var i = this.processed;
                                        if (
                                            (this._updateInternalProperties(t),
                                            !this._processNonPrintableKeysAndShortcuts(
                                                t
                                            ))
                                        )
                                            if (i) t.preventDefault();
                                            else {
                                                if (
                                                    this._processCharacterInsertion()
                                                ) {
                                                    this._formatValue(t);
                                                    var a = h.getElementValue(
                                                        t.target
                                                    );
                                                    if (
                                                        a !== this.lastVal &&
                                                        this.throwInput
                                                    )
                                                        this._triggerEvent(
                                                            e.events.native
                                                                .input,
                                                            t.target
                                                        ),
                                                            t.preventDefault();
                                                    else {
                                                        if (
                                                            (this.eventKey ===
                                                                this.settings
                                                                    .decimalCharacter ||
                                                                this
                                                                    .eventKey ===
                                                                    this
                                                                        .settings
                                                                        .decimalCharacterAlternative) &&
                                                            h.getElementSelection(
                                                                t.target
                                                            ).start ===
                                                                h.getElementSelection(
                                                                    t.target
                                                                ).end &&
                                                            h.getElementSelection(
                                                                t.target
                                                            ).start ===
                                                                a.indexOf(
                                                                    this
                                                                        .settings
                                                                        .decimalCharacter
                                                                )
                                                        ) {
                                                            var r =
                                                                h.getElementSelection(
                                                                    t.target
                                                                ).start + 1;
                                                            h.setElementSelection(
                                                                t.target,
                                                                r
                                                            );
                                                        }
                                                        t.preventDefault();
                                                    }
                                                    return (
                                                        (this.lastVal =
                                                            h.getElementValue(
                                                                t.target
                                                            )),
                                                        (this.throwInput = !0),
                                                        void this._setValidOrInvalidState(
                                                            this.rawValue
                                                        )
                                                    );
                                                }
                                                t.preventDefault();
                                            }
                                    }
                                },
                            },
                            {
                                key: "_onKeyup",
                                value: function (t) {
                                    if (
                                        ((this.isEditing = !1),
                                        (this.keydownEventCounter = 0),
                                        !this.formulaMode)
                                    )
                                        if (
                                            this.settings.isCancellable &&
                                            this.eventKey === n.keyName.Esc
                                        )
                                            t.preventDefault();
                                        else {
                                            if (
                                                (this._updateEventKeyInfo(t),
                                                this.eventKey === n.keyName.Z ||
                                                    this.eventKey ===
                                                        n.keyName.z)
                                            ) {
                                                if (t.ctrlKey && t.shiftKey)
                                                    return (
                                                        t.preventDefault(),
                                                        this._historyTableRedo(),
                                                        this._triggerEvent(
                                                            e.events.native
                                                                .input,
                                                            t.target
                                                        ),
                                                        void (this.onGoingRedo =
                                                            !0)
                                                    );
                                                if (t.ctrlKey && !t.shiftKey) {
                                                    if (!this.onGoingRedo)
                                                        return (
                                                            t.preventDefault(),
                                                            this._historyTableUndo(),
                                                            void this._triggerEvent(
                                                                e.events.native
                                                                    .input,
                                                                t.target
                                                            )
                                                        );
                                                    this.onGoingRedo = !1;
                                                }
                                            } else if (
                                                (this.eventKey ===
                                                    n.keyName.Y ||
                                                    this.eventKey ===
                                                        n.keyName.y) &&
                                                t.ctrlKey
                                            )
                                                return (
                                                    t.preventDefault(),
                                                    this._historyTableRedo(),
                                                    this._triggerEvent(
                                                        e.events.native.input,
                                                        t.target
                                                    ),
                                                    void (this.onGoingRedo = !0)
                                                );
                                            if (
                                                (this.onGoingRedo &&
                                                    (t.ctrlKey || t.shiftKey) &&
                                                    (this.onGoingRedo = !1),
                                                (t.ctrlKey || t.metaKey) &&
                                                    this.eventKey ===
                                                        n.keyName.x)
                                            ) {
                                                var i = h.getElementSelection(
                                                        this.domElement
                                                    ).start,
                                                    a =
                                                        this.constructor._toNumericValue(
                                                            h.getElementValue(
                                                                t.target
                                                            ),
                                                            this.settings
                                                        );
                                                this.set(a),
                                                    this._setCaretPosition(i);
                                            }
                                            if (
                                                this.eventKey ===
                                                    n.keyName.Alt &&
                                                this.settings.unformatOnHover &&
                                                this.hoveredWithAlt
                                            )
                                                this.constructor._reformatAltHovered(
                                                    this
                                                );
                                            else if (
                                                (!t.ctrlKey && !t.metaKey) ||
                                                (this.eventKey !==
                                                    n.keyName.Backspace &&
                                                    this.eventKey !==
                                                        n.keyName.Delete)
                                            ) {
                                                this._updateInternalProperties(
                                                    t
                                                );
                                                var r =
                                                    this._processNonPrintableKeysAndShortcuts(
                                                        t
                                                    );
                                                delete this
                                                    .valuePartsBeforePaste;
                                                var o = h.getElementValue(
                                                    t.target
                                                );
                                                if (
                                                    !(
                                                        r ||
                                                        ("" === o &&
                                                            "" ===
                                                                this
                                                                    .initialValueOnFirstKeydown)
                                                    ) &&
                                                    (o ===
                                                    this.settings.currencySymbol
                                                        ? this.settings
                                                              .currencySymbolPlacement ===
                                                          e.options
                                                              .currencySymbolPlacement
                                                              .suffix
                                                            ? h.setElementSelection(
                                                                  t.target,
                                                                  0
                                                              )
                                                            : h.setElementSelection(
                                                                  t.target,
                                                                  this.settings
                                                                      .currencySymbol
                                                                      .length
                                                              )
                                                        : this.eventKey ===
                                                              n.keyName.Tab &&
                                                          h.setElementSelection(
                                                              t.target,
                                                              0,
                                                              o.length
                                                          ),
                                                    (o ===
                                                        this.settings
                                                            .suffixText ||
                                                        ("" === this.rawValue &&
                                                            "" !==
                                                                this.settings
                                                                    .currencySymbol &&
                                                            "" !==
                                                                this.settings
                                                                    .suffixText)) &&
                                                        h.setElementSelection(
                                                            t.target,
                                                            0
                                                        ),
                                                    null !==
                                                        this.settings
                                                            .decimalPlacesShownOnFocus &&
                                                        this._saveValueToPersistentStorage(),
                                                    this.formatted ||
                                                        this._formatValue(t),
                                                    this._setValidOrInvalidState(
                                                        this.rawValue
                                                    ),
                                                    this._saveRawValueForAndroid(),
                                                    o !==
                                                        this
                                                            .initialValueOnFirstKeydown &&
                                                        this._triggerEvent(
                                                            e.events.formatted,
                                                            t.target,
                                                            {
                                                                oldValue:
                                                                    this
                                                                        .initialValueOnFirstKeydown,
                                                                newValue: o,
                                                                oldRawValue:
                                                                    this
                                                                        .initialRawValueOnFirstKeydown,
                                                                newRawValue:
                                                                    this
                                                                        .rawValue,
                                                                isPristine:
                                                                    this.isPristine(
                                                                        !1
                                                                    ),
                                                                error: null,
                                                                aNElement: this,
                                                            }
                                                        ),
                                                    this.historyTable.length >
                                                        1)
                                                ) {
                                                    var s =
                                                        h.getElementSelection(
                                                            this.domElement
                                                        );
                                                    (this.selectionStart =
                                                        s.start),
                                                        (this.selectionEnd =
                                                            s.end),
                                                        (this.historyTable[
                                                            this.historyTableIndex
                                                        ].start =
                                                            this.selectionStart),
                                                        (this.historyTable[
                                                            this.historyTableIndex
                                                        ].end =
                                                            this.selectionEnd);
                                                }
                                            } else {
                                                var l = h.getElementValue(
                                                    t.target
                                                );
                                                this._setRawValue(
                                                    this._formatOrUnformatOther(
                                                        !1,
                                                        l
                                                    )
                                                );
                                            }
                                        }
                                },
                            },
                            {
                                key: "_saveRawValueForAndroid",
                                value: function () {
                                    if (
                                        this.eventKey ===
                                        n.keyName.AndroidDefault
                                    ) {
                                        var e =
                                            this.constructor._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                this.getFormatted(),
                                                this.settings,
                                                !0,
                                                this.isFocused
                                            );
                                        (e =
                                            this.constructor._convertToNumericString(
                                                e,
                                                this.settings
                                            )),
                                            this._setRawValue(e);
                                    }
                                },
                            },
                            {
                                key: "_onFocusOutAndMouseLeave",
                                value: function (t) {
                                    if (
                                        ((this.isEditing = !1),
                                        "mouseleave" !== t.type ||
                                            !this.formulaMode)
                                    )
                                        if (
                                            this.settings.unformatOnHover &&
                                            "mouseleave" === t.type &&
                                            this.hoveredWithAlt
                                        )
                                            this.constructor._reformatAltHovered(
                                                this
                                            );
                                        else if (
                                            ("mouseleave" === t.type &&
                                                !this.isFocused) ||
                                            "blur" === t.type
                                        ) {
                                            "blur" === t.type &&
                                                this.formulaMode &&
                                                this._exitFormulaMode(),
                                                this._saveValueToPersistentStorage(),
                                                this.settings
                                                    .showOnlyNumbersOnFocus ===
                                                    e.options
                                                        .showOnlyNumbersOnFocus
                                                        .onlyNumbers &&
                                                    ((this.settings.digitGroupSeparator =
                                                        this.originalDigitGroupSeparator),
                                                    (this.settings.currencySymbol =
                                                        this.originalCurrencySymbol),
                                                    (this.settings.suffixText =
                                                        this.originalSuffixText));
                                            var i = this._getRawValueToFormat(
                                                    this.rawValue
                                                ),
                                                n = h.isNull(i),
                                                a = F(
                                                    this.constructor._checkIfInRangeWithOverrideOption(
                                                        i,
                                                        this.settings
                                                    ),
                                                    2
                                                ),
                                                r = a[0],
                                                o = a[1],
                                                s = !1;
                                            if (
                                                ("" === i ||
                                                    n ||
                                                    (this._triggerRangeEvents(
                                                        r,
                                                        o
                                                    ),
                                                    this.settings
                                                        .valuesToStrings &&
                                                        this._checkValuesToStrings(
                                                            i
                                                        ) &&
                                                        (this._setElementValue(
                                                            this.settings
                                                                .valuesToStrings[
                                                                i
                                                            ]
                                                        ),
                                                        (s = !0))),
                                                !s)
                                            ) {
                                                var l;
                                                if (
                                                    ((l =
                                                        n || "" === i
                                                            ? i
                                                            : String(i)),
                                                    "" === i || n)
                                                ) {
                                                    if ("" === i)
                                                        switch (
                                                            this.settings
                                                                .emptyInputBehavior
                                                        ) {
                                                            case e.options
                                                                .emptyInputBehavior
                                                                .zero:
                                                                this._setRawValue(
                                                                    "0"
                                                                ),
                                                                    (l =
                                                                        this.constructor._roundValue(
                                                                            "0",
                                                                            this
                                                                                .settings,
                                                                            0
                                                                        ));
                                                                break;
                                                            case e.options
                                                                .emptyInputBehavior
                                                                .min:
                                                                this._setRawValue(
                                                                    this
                                                                        .settings
                                                                        .minimumValue
                                                                ),
                                                                    (l =
                                                                        this.constructor._roundFormattedValueShownOnFocusOrBlur(
                                                                            this
                                                                                .settings
                                                                                .minimumValue,
                                                                            this
                                                                                .settings,
                                                                            this
                                                                                .isFocused
                                                                        ));
                                                                break;
                                                            case e.options
                                                                .emptyInputBehavior
                                                                .max:
                                                                this._setRawValue(
                                                                    this
                                                                        .settings
                                                                        .maximumValue
                                                                ),
                                                                    (l =
                                                                        this.constructor._roundFormattedValueShownOnFocusOrBlur(
                                                                            this
                                                                                .settings
                                                                                .maximumValue,
                                                                            this
                                                                                .settings,
                                                                            this
                                                                                .isFocused
                                                                        ));
                                                                break;
                                                            default:
                                                                h.isNumber(
                                                                    this
                                                                        .settings
                                                                        .emptyInputBehavior
                                                                ) &&
                                                                    (this._setRawValue(
                                                                        this
                                                                            .settings
                                                                            .emptyInputBehavior
                                                                    ),
                                                                    (l =
                                                                        this.constructor._roundFormattedValueShownOnFocusOrBlur(
                                                                            this
                                                                                .settings
                                                                                .emptyInputBehavior,
                                                                            this
                                                                                .settings,
                                                                            this
                                                                                .isFocused
                                                                        )));
                                                        }
                                                } else
                                                    r &&
                                                    o &&
                                                    !this.constructor._isElementValueEmptyOrOnlyTheNegativeSign(
                                                        i,
                                                        this.settings
                                                    )
                                                        ? ((l =
                                                              this._modifyNegativeSignAndDecimalCharacterForRawValue(
                                                                  l
                                                              )),
                                                          this.settings
                                                              .divisorWhenUnfocused &&
                                                              !h.isNull(l) &&
                                                              (l = (l /=
                                                                  this.settings
                                                                      .divisorWhenUnfocused).toString()),
                                                          (l =
                                                              this.constructor._roundFormattedValueShownOnBlur(
                                                                  l,
                                                                  this.settings
                                                              )),
                                                          (l =
                                                              this.constructor._modifyNegativeSignAndDecimalCharacterForFormattedValue(
                                                                  l,
                                                                  this.settings
                                                              )))
                                                        : this._triggerRangeEvents(
                                                              r,
                                                              o
                                                          );
                                                var u =
                                                    this.constructor._orderValueCurrencySymbolAndSuffixText(
                                                        l,
                                                        this.settings,
                                                        !1
                                                    );
                                                this.constructor._isElementValueEmptyOrOnlyTheNegativeSign(
                                                    l,
                                                    this.settings
                                                ) ||
                                                    (n &&
                                                        this.settings
                                                            .emptyInputBehavior ===
                                                            e.options
                                                                .emptyInputBehavior
                                                                .null) ||
                                                    (u =
                                                        this.constructor._addGroupSeparators(
                                                            l,
                                                            this.settings,
                                                            !1,
                                                            i
                                                        )),
                                                    (u === i &&
                                                        "" !== i &&
                                                        this.settings
                                                            .allowDecimalPadding !==
                                                            e.options
                                                                .allowDecimalPadding
                                                                .never &&
                                                        this.settings
                                                            .allowDecimalPadding !==
                                                            e.options
                                                                .allowDecimalPadding
                                                                .floats) ||
                                                        (this.settings
                                                            .symbolWhenUnfocused &&
                                                            "" !== i &&
                                                            null !== i &&
                                                            (u = ""
                                                                .concat(u)
                                                                .concat(
                                                                    this
                                                                        .settings
                                                                        .symbolWhenUnfocused
                                                                )),
                                                        this._setElementValue(
                                                            u
                                                        ));
                                            }
                                            this._setValidOrInvalidState(
                                                this.rawValue
                                            ),
                                                "blur" === t.type &&
                                                    this._onBlur(t);
                                        }
                                },
                            },
                            {
                                key: "_onPaste",
                                value: function (t) {
                                    if (
                                        (t.preventDefault(),
                                        !(
                                            this.settings.readOnly ||
                                            this.domElement.readOnly ||
                                            this.domElement.disabled
                                        ))
                                    ) {
                                        var i, n;
                                        window.clipboardData &&
                                        window.clipboardData.getData
                                            ? (i =
                                                  window.clipboardData.getData(
                                                      "Text"
                                                  ))
                                            : t.clipboardData &&
                                              t.clipboardData.getData
                                            ? (i =
                                                  t.clipboardData.getData(
                                                      "text/plain"
                                                  ))
                                            : h.throwError(
                                                  "Unable to retrieve the pasted value. Please use a modern browser (i.e. Firefox or Chromium)."
                                              ),
                                            (n = t.target.tagName
                                                ? t.target
                                                : t.explicitOriginalTarget);
                                        var a = h.getElementValue(n),
                                            r = n.selectionStart || 0,
                                            o = n.selectionEnd || 0,
                                            s = o - r;
                                        if (s === a.length) {
                                            var l = this._preparePastedText(i),
                                                u = h.arabicToLatinNumbers(
                                                    l,
                                                    !1,
                                                    !1,
                                                    !1
                                                );
                                            return "." === u ||
                                                "" === u ||
                                                ("." !== u && !h.isNumber(u))
                                                ? ((this.formatted = !0),
                                                  void (
                                                      this.settings
                                                          .onInvalidPaste ===
                                                          e.options
                                                              .onInvalidPaste
                                                              .error &&
                                                      h.throwError(
                                                          "The pasted value '".concat(
                                                              i,
                                                              "' is not a valid paste content."
                                                          )
                                                      )
                                                  ))
                                                : (this.set(u),
                                                  (this.formatted = !0),
                                                  void this._triggerEvent(
                                                      e.events.native.input,
                                                      n
                                                  ));
                                        }
                                        var c = h.isNegativeStrict(
                                            i,
                                            this.settings.negativeSignCharacter
                                        );
                                        c && (i = i.slice(1, i.length));
                                        var m,
                                            g,
                                            d = this._preparePastedText(i);
                                        if (
                                            "." !==
                                                (m =
                                                    "." === d
                                                        ? "."
                                                        : h.arabicToLatinNumbers(
                                                              d,
                                                              !1,
                                                              !1,
                                                              !1
                                                          )) &&
                                            (!h.isNumber(m) || "" === m)
                                        )
                                            return (
                                                (this.formatted = !0),
                                                void (
                                                    this.settings
                                                        .onInvalidPaste ===
                                                        e.options.onInvalidPaste
                                                            .error &&
                                                    h.throwError(
                                                        "The pasted value '".concat(
                                                            i,
                                                            "' is not a valid paste content."
                                                        )
                                                    )
                                                )
                                            );
                                        var v,
                                            p,
                                            f = h.isNegativeStrict(
                                                this.getNumericString(),
                                                this.settings
                                                    .negativeSignCharacter
                                            );
                                        c && !f
                                            ? ((f = !0), (v = !0))
                                            : (v = !1);
                                        var y = a.slice(0, r),
                                            S = a.slice(o, a.length);
                                        (p =
                                            r !== o
                                                ? this._preparePastedText(y + S)
                                                : this._preparePastedText(a)),
                                            f && (p = h.setRawNegativeSign(p)),
                                            (g =
                                                h.convertCharacterCountToIndexPosition(
                                                    h.countNumberCharactersOnTheCaretLeftSide(
                                                        a,
                                                        r,
                                                        this.settings
                                                            .decimalCharacter
                                                    )
                                                )),
                                            v && g++;
                                        var b = p.slice(0, g),
                                            w = p.slice(g, p.length),
                                            P = !1;
                                        "." === m &&
                                            (h.contains(b, ".") &&
                                                ((P = !0),
                                                (b = b.replace(".", ""))),
                                            (w = w.replace(".", "")));
                                        var O = !1;
                                        switch (
                                            ("" === b &&
                                                "-" === w &&
                                                ((b = "-"), (w = ""), (O = !0)),
                                            this.settings.onInvalidPaste)
                                        ) {
                                            case e.options.onInvalidPaste
                                                .truncate:
                                            case e.options.onInvalidPaste
                                                .replace:
                                                for (
                                                    var k = h.parseStr(
                                                            this.settings
                                                                .minimumValue
                                                        ),
                                                        N = h.parseStr(
                                                            this.settings
                                                                .maximumValue
                                                        ),
                                                        E = p,
                                                        _ = 0,
                                                        C = b;
                                                    _ < m.length &&
                                                    ((p = (C += m[_]) + w),
                                                    this.constructor._checkIfInRange(
                                                        p,
                                                        k,
                                                        N
                                                    ));

                                                )
                                                    (E = p), _++;
                                                if (
                                                    ((g += _),
                                                    O && g++,
                                                    this.settings
                                                        .onInvalidPaste ===
                                                        e.options.onInvalidPaste
                                                            .truncate)
                                                ) {
                                                    (p = E), P && g--;
                                                    break;
                                                }
                                                for (
                                                    var F = g, V = E.length;
                                                    _ < m.length && F < V;

                                                )
                                                    if ("." !== E[F]) {
                                                        if (
                                                            ((p =
                                                                h.replaceCharAt(
                                                                    E,
                                                                    F,
                                                                    m[_]
                                                                )),
                                                            !this.constructor._checkIfInRange(
                                                                p,
                                                                k,
                                                                N
                                                            ))
                                                        )
                                                            break;
                                                        (E = p), _++, F++;
                                                    } else F++;
                                                (g = F), P && g--, (p = E);
                                                break;
                                            case e.options.onInvalidPaste.error:
                                            case e.options.onInvalidPaste
                                                .ignore:
                                            case e.options.onInvalidPaste.clamp:
                                            default:
                                                if (
                                                    ((p = ""
                                                        .concat(b)
                                                        .concat(m)
                                                        .concat(w)),
                                                    r === o)
                                                )
                                                    g =
                                                        h.convertCharacterCountToIndexPosition(
                                                            h.countNumberCharactersOnTheCaretLeftSide(
                                                                a,
                                                                r,
                                                                this.settings
                                                                    .decimalCharacter
                                                            )
                                                        ) + m.length;
                                                else if ("" === w)
                                                    (g =
                                                        h.convertCharacterCountToIndexPosition(
                                                            h.countNumberCharactersOnTheCaretLeftSide(
                                                                a,
                                                                r,
                                                                this.settings
                                                                    .decimalCharacter
                                                            )
                                                        ) + m.length),
                                                        O && g++;
                                                else {
                                                    var x =
                                                            h.convertCharacterCountToIndexPosition(
                                                                h.countNumberCharactersOnTheCaretLeftSide(
                                                                    a,
                                                                    o,
                                                                    this
                                                                        .settings
                                                                        .decimalCharacter
                                                                )
                                                            ),
                                                        T = h
                                                            .getElementValue(n)
                                                            .slice(r, o);
                                                    g =
                                                        x -
                                                        s +
                                                        h.countCharInText(
                                                            this.settings
                                                                .digitGroupSeparator,
                                                            T
                                                        ) +
                                                        m.length;
                                                }
                                                v && g++, P && g--;
                                        }
                                        if (h.isNumber(p) && "" !== p) {
                                            var A = !1,
                                                L = !1;
                                            try {
                                                this.set(p), (A = !0);
                                            } catch (M) {
                                                var D;
                                                switch (
                                                    this.settings.onInvalidPaste
                                                ) {
                                                    case e.options
                                                        .onInvalidPaste.clamp:
                                                        D =
                                                            h.clampToRangeLimits(
                                                                p,
                                                                this.settings
                                                            );
                                                        try {
                                                            this.set(D);
                                                        } catch (M) {
                                                            h.throwError(
                                                                "Fatal error: Unable to set the clamped value '".concat(
                                                                    D,
                                                                    "'."
                                                                )
                                                            );
                                                        }
                                                        (L = !0),
                                                            (A = !0),
                                                            (p = D);
                                                        break;
                                                    case e.options
                                                        .onInvalidPaste.error:
                                                    case e.options
                                                        .onInvalidPaste
                                                        .truncate:
                                                    case e.options
                                                        .onInvalidPaste.replace:
                                                        h.throwError(
                                                            "The pasted value '"
                                                                .concat(
                                                                    i,
                                                                    "' results in a value '"
                                                                )
                                                                .concat(
                                                                    p,
                                                                    "' that is outside of the minimum ["
                                                                )
                                                                .concat(
                                                                    this
                                                                        .settings
                                                                        .minimumValue,
                                                                    "] and maximum ["
                                                                )
                                                                .concat(
                                                                    this
                                                                        .settings
                                                                        .maximumValue,
                                                                    "] value range."
                                                                )
                                                        );
                                                    case e.options
                                                        .onInvalidPaste.ignore:
                                                    default:
                                                        return;
                                                }
                                            }
                                            var B,
                                                I = h.getElementValue(n);
                                            if (A)
                                                switch (
                                                    this.settings.onInvalidPaste
                                                ) {
                                                    case e.options
                                                        .onInvalidPaste.clamp:
                                                        if (L) {
                                                            this.settings
                                                                .currencySymbolPlacement ===
                                                            e.options
                                                                .currencySymbolPlacement
                                                                .suffix
                                                                ? h.setElementSelection(
                                                                      n,
                                                                      I.length -
                                                                          this
                                                                              .settings
                                                                              .currencySymbol
                                                                              .length
                                                                  )
                                                                : h.setElementSelection(
                                                                      n,
                                                                      I.length
                                                                  );
                                                            break;
                                                        }
                                                    case e.options
                                                        .onInvalidPaste.error:
                                                    case e.options
                                                        .onInvalidPaste.ignore:
                                                    case e.options
                                                        .onInvalidPaste
                                                        .truncate:
                                                    case e.options
                                                        .onInvalidPaste.replace:
                                                    default:
                                                        (B =
                                                            h.findCaretPositionInFormattedNumber(
                                                                p,
                                                                g,
                                                                I,
                                                                this.settings
                                                                    .decimalCharacter
                                                            )),
                                                            h.setElementSelection(
                                                                n,
                                                                B
                                                            );
                                                }
                                            A &&
                                                a !== I &&
                                                this._triggerEvent(
                                                    e.events.native.input,
                                                    n
                                                );
                                        } else
                                            this.settings.onInvalidPaste ===
                                                e.options.onInvalidPaste
                                                    .error &&
                                                h.throwError(
                                                    "The pasted value '"
                                                        .concat(
                                                            i,
                                                            "' would result into an invalid content '"
                                                        )
                                                        .concat(p, "'.")
                                                );
                                    }
                                },
                            },
                            {
                                key: "_onBlur",
                                value: function (t) {
                                    (this.isFocused = !1),
                                        (this.isEditing = !1),
                                        h.trimPaddedZerosFromDecimalPlaces(
                                            this.rawValue
                                        ) !==
                                            h.trimPaddedZerosFromDecimalPlaces(
                                                this.rawValueOnFocus
                                            ) &&
                                            this._triggerEvent(
                                                e.events.native.change,
                                                t.target
                                            ),
                                        (this.rawValueOnFocus = void 0);
                                },
                            },
                            {
                                key: "_wheelAndUpDownActions",
                                value: function (t, i, n, a) {
                                    var r,
                                        o = t.target.selectionStart || 0,
                                        s = t.target.selectionEnd || 0,
                                        l = this.rawValue;
                                    if (
                                        ((r = +(r = h.isUndefinedOrNullOrEmpty(
                                            l
                                        )
                                            ? this.settings.minimumValue > 0 ||
                                              this.settings.maximumValue < 0
                                                ? i
                                                    ? this.settings.minimumValue
                                                    : this.settings.maximumValue
                                                : 0
                                            : l)),
                                        h.isNumber(a))
                                    ) {
                                        var u = +a;
                                        i ? (r += u) : n && (r -= u);
                                    } else
                                        i
                                            ? (r = h.addAndRoundToNearestAuto(
                                                  r,
                                                  this.settings
                                                      .decimalPlacesRawValue
                                              ))
                                            : n &&
                                              (r =
                                                  h.subtractAndRoundToNearestAuto(
                                                      r,
                                                      this.settings
                                                          .decimalPlacesRawValue
                                                  ));
                                    (r = h.clampToRangeLimits(
                                        r,
                                        this.settings
                                    )) !== +l &&
                                        (this.set(r),
                                        this._triggerEvent(
                                            e.events.native.input,
                                            t.target
                                        )),
                                        t.preventDefault(),
                                        this._setSelection(o, s);
                                },
                            },
                            {
                                key: "upDownArrowAction",
                                value: function (e) {
                                    if (
                                        !(
                                            this.formulaMode ||
                                            this.settings.readOnly ||
                                            this.domElement.readOnly ||
                                            this.domElement.disabled
                                        )
                                    ) {
                                        var t = !1,
                                            i = !1;
                                        this.eventKey === n.keyName.UpArrow
                                            ? (t = !0)
                                            : this.eventKey ===
                                              n.keyName.DownArrow
                                            ? (i = !0)
                                            : h.throwError(
                                                  "Something has gone wrong since neither an Up or Down arrow key is detected, but the function was still called!"
                                              ),
                                            this._wheelAndUpDownActions(
                                                e,
                                                t,
                                                i,
                                                this.settings.upDownStep
                                            );
                                    }
                                },
                            },
                            {
                                key: "_onWheel",
                                value: function (t) {
                                    this.formulaMode ||
                                        this.settings.readOnly ||
                                        this.domElement.readOnly ||
                                        this.domElement.disabled ||
                                        (this.settings.modifyValueOnWheel &&
                                            (this.settings.wheelOn ===
                                            e.options.wheelOn.focus
                                                ? this.isFocused
                                                    ? t.shiftKey ||
                                                      this.wheelAction(t)
                                                    : t.shiftKey &&
                                                      this.wheelAction(t)
                                                : this.settings.wheelOn ===
                                                  e.options.wheelOn.hover
                                                ? t.shiftKey
                                                    ? (t.preventDefault(),
                                                      window.scrollBy(
                                                          0,
                                                          h.isNegativeStrict(
                                                              String(t.deltaY)
                                                          )
                                                              ? -50
                                                              : 50
                                                      ))
                                                    : this.wheelAction(t)
                                                : h.throwError(
                                                      "Unknown `wheelOn` option."
                                                  )));
                                },
                            },
                            {
                                key: "wheelAction",
                                value: function (e) {
                                    this.isWheelEvent = !0;
                                    var t = !1,
                                        i = !1;
                                    h.isWheelUpEvent(e)
                                        ? (t = !0)
                                        : h.isWheelDownEvent(e)
                                        ? (i = !0)
                                        : h.throwError(
                                              "The event is not a 'wheel' event."
                                          ),
                                        this._wheelAndUpDownActions(
                                            e,
                                            t,
                                            i,
                                            this.settings.wheelStep
                                        ),
                                        (this.isWheelEvent = !1);
                                },
                            },
                            {
                                key: "_onDrop",
                                value: function (e) {
                                    if (!this.formulaMode) {
                                        var t;
                                        (this.isDropEvent = !0),
                                            e.preventDefault(),
                                            (t = h.isIE11()
                                                ? "text"
                                                : "text/plain");
                                        var i = e.dataTransfer.getData(t),
                                            n = this.unformatOther(i);
                                        this.set(n), (this.isDropEvent = !1);
                                    }
                                },
                            },
                            {
                                key: "_onFormSubmit",
                                value: function () {
                                    var e = this;
                                    return (
                                        this._getFormAutoNumericChildren(
                                            this.parentForm
                                        )
                                            .map(function (t) {
                                                return e.constructor.getAutoNumericElement(
                                                    t
                                                );
                                            })
                                            .forEach(function (e) {
                                                return e._unformatOnSubmit();
                                            }),
                                        !0
                                    );
                                },
                            },
                            {
                                key: "_onFormReset",
                                value: function () {
                                    var e = this;
                                    this._getFormAutoNumericChildren(
                                        this.parentForm
                                    )
                                        .map(function (t) {
                                            return e.constructor.getAutoNumericElement(
                                                t
                                            );
                                        })
                                        .forEach(function (t) {
                                            var i = e._getDefaultValue(
                                                t.node()
                                            );
                                            setTimeout(function () {
                                                return t.set(i);
                                            }, 0);
                                        });
                                },
                            },
                            {
                                key: "_unformatOnSubmit",
                                value: function () {
                                    this.settings.unformatOnSubmit &&
                                        this._setElementValue(this.rawValue);
                                },
                            },
                            {
                                key: "_onKeydownGlobal",
                                value: function (t) {
                                    if (h.character(t) === n.keyName.Alt) {
                                        var i = h.getHoveredElement();
                                        if (e.isManagedByAutoNumeric(i)) {
                                            var a = e.getAutoNumericElement(i);
                                            !a.formulaMode &&
                                                a.settings.unformatOnHover &&
                                                this.constructor._unformatAltHovered(
                                                    a
                                                );
                                        }
                                    }
                                },
                            },
                            {
                                key: "_onKeyupGlobal",
                                value: function (t) {
                                    if (h.character(t) === n.keyName.Alt) {
                                        var i = h.getHoveredElement();
                                        if (e.isManagedByAutoNumeric(i)) {
                                            var a = e.getAutoNumericElement(i);
                                            if (
                                                a.formulaMode ||
                                                !a.settings.unformatOnHover
                                            )
                                                return;
                                            this.constructor._reformatAltHovered(
                                                a
                                            );
                                        }
                                    }
                                },
                            },
                            {
                                key: "_isElementTagSupported",
                                value: function () {
                                    return (
                                        h.isElement(this.domElement) ||
                                            h.throwError(
                                                "The DOM element is not valid, ".concat(
                                                    this.domElement,
                                                    " given."
                                                )
                                            ),
                                        h.isInArray(
                                            this.domElement.tagName.toLowerCase(),
                                            this.allowedTagList
                                        )
                                    );
                                },
                            },
                            {
                                key: "_isInputElement",
                                value: function () {
                                    return (
                                        "input" ===
                                        this.domElement.tagName.toLowerCase()
                                    );
                                },
                            },
                            {
                                key: "_isInputTypeSupported",
                                value: function () {
                                    return (
                                        "text" === this.domElement.type ||
                                        "hidden" === this.domElement.type ||
                                        "tel" === this.domElement.type ||
                                        h.isUndefinedOrNullOrEmpty(
                                            this.domElement.type
                                        )
                                    );
                                },
                            },
                            {
                                key: "_checkElement",
                                value: function () {
                                    var e =
                                        this.domElement.tagName.toLowerCase();
                                    this._isElementTagSupported() ||
                                        h.throwError(
                                            "The <".concat(
                                                e,
                                                "> tag is not supported by autoNumeric"
                                            )
                                        ),
                                        this._isInputElement()
                                            ? (this._isInputTypeSupported() ||
                                                  h.throwError(
                                                      'The input type "'.concat(
                                                          this.domElement.type,
                                                          '" is not supported by autoNumeric'
                                                      )
                                                  ),
                                              (this.isInputElement = !0))
                                            : ((this.isInputElement = !1),
                                              (this.isContentEditable =
                                                  this.domElement.hasAttribute(
                                                      "contenteditable"
                                                  ) &&
                                                  "true" ===
                                                      this.domElement.getAttribute(
                                                          "contenteditable"
                                                      )));
                                },
                            },
                            {
                                key: "_formatDefaultValueOnPageLoad",
                                value: function () {
                                    var t,
                                        i =
                                            arguments.length > 0 &&
                                            void 0 !== arguments[0]
                                                ? arguments[0]
                                                : null,
                                        n = !0;
                                    if (
                                        (h.isNull(i)
                                            ? ((t = h
                                                  .getElementValue(
                                                      this.domElement
                                                  )
                                                  .trim()),
                                              this.domElement.setAttribute(
                                                  "value",
                                                  t
                                              ))
                                            : (t = i),
                                        this.isInputElement ||
                                            this.isContentEditable)
                                    ) {
                                        var a =
                                            this.constructor._toNumericValue(
                                                t,
                                                this.settings
                                            );
                                        if (
                                            this.domElement.hasAttribute(
                                                "value"
                                            ) &&
                                            "" !==
                                                this.domElement.getAttribute(
                                                    "value"
                                                )
                                        ) {
                                            if (
                                                (null !==
                                                    this.settings
                                                        .defaultValueOverride &&
                                                    this.settings.defaultValueOverride.toString() !==
                                                        t) ||
                                                (null ===
                                                    this.settings
                                                        .defaultValueOverride &&
                                                    "" !== t &&
                                                    t !==
                                                        this.domElement.getAttribute(
                                                            "value"
                                                        )) ||
                                                ("" !== t &&
                                                    "hidden" ===
                                                        this.domElement.getAttribute(
                                                            "type"
                                                        ) &&
                                                    !h.isNumber(a))
                                            ) {
                                                if (
                                                    (this.settings
                                                        .saveValueToSessionStorage &&
                                                        (null !==
                                                            this.settings
                                                                .decimalPlacesShownOnFocus ||
                                                            this.settings
                                                                .divisorWhenUnfocused) &&
                                                        this._setRawValue(
                                                            this._getValueFromPersistentStorage()
                                                        ),
                                                    !this.settings
                                                        .saveValueToSessionStorage)
                                                ) {
                                                    var r =
                                                        this.constructor._removeBrackets(
                                                            t,
                                                            this.settings
                                                        );
                                                    (this.settings
                                                        .negativePositiveSignPlacement ===
                                                        e.options
                                                            .negativePositiveSignPlacement
                                                            .suffix ||
                                                        (this.settings
                                                            .negativePositiveSignPlacement !==
                                                            e.options
                                                                .negativePositiveSignPlacement
                                                                .prefix &&
                                                            this.settings
                                                                .currencySymbolPlacement ===
                                                                e.options
                                                                    .currencySymbolPlacement
                                                                    .suffix)) &&
                                                    "" !==
                                                        this.settings
                                                            .negativeSignCharacter &&
                                                    h.isNegative(
                                                        t,
                                                        this.settings
                                                            .negativeSignCharacter
                                                    )
                                                        ? this._setRawValue(
                                                              "-".concat(
                                                                  this.constructor._stripAllNonNumberCharacters(
                                                                      r,
                                                                      this
                                                                          .settings,
                                                                      !0,
                                                                      this
                                                                          .isFocused
                                                                  )
                                                              )
                                                          )
                                                        : this._setRawValue(
                                                              this.constructor._stripAllNonNumberCharacters(
                                                                  r,
                                                                  this.settings,
                                                                  !0,
                                                                  this.isFocused
                                                              )
                                                          );
                                                }
                                                n = !1;
                                            }
                                        } else
                                            isNaN(Number(a)) || Infinity === a
                                                ? h.throwError(
                                                      "The value [".concat(
                                                          t,
                                                          "] used in the input is not a valid value autoNumeric can work with."
                                                      )
                                                  )
                                                : (this.set(a), (n = !1));
                                        if ("" === t)
                                            switch (
                                                this.settings.emptyInputBehavior
                                            ) {
                                                case e.options
                                                    .emptyInputBehavior.focus:
                                                case e.options
                                                    .emptyInputBehavior.null:
                                                case e.options
                                                    .emptyInputBehavior.press:
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.always:
                                                    this._setElementValue(
                                                        this.settings
                                                            .currencySymbol
                                                    );
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.min:
                                                    this.set(
                                                        this.settings
                                                            .minimumValue
                                                    );
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.max:
                                                    this.set(
                                                        this.settings
                                                            .maximumValue
                                                    );
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.zero:
                                                    this.set("0");
                                                    break;
                                                default:
                                                    this.set(
                                                        this.settings
                                                            .emptyInputBehavior
                                                    );
                                            }
                                        else
                                            n &&
                                                t ===
                                                    this.domElement.getAttribute(
                                                        "value"
                                                    ) &&
                                                this.set(t);
                                    } else
                                        (null !==
                                            this.settings
                                                .defaultValueOverride &&
                                            this.settings
                                                .defaultValueOverride !== t) ||
                                            this.set(t);
                                },
                            },
                            {
                                key: "_calculateVMinAndVMaxIntegerSizes",
                                value: function () {
                                    var e = F(
                                            this.settings.maximumValue
                                                .toString()
                                                .split("."),
                                            1
                                        )[0],
                                        t = F(
                                            this.settings.minimumValue ||
                                                0 === this.settings.minimumValue
                                                ? this.settings.minimumValue
                                                      .toString()
                                                      .split(".")
                                                : [],
                                            1
                                        )[0];
                                    (e = e.replace(
                                        this.settings.negativeSignCharacter,
                                        ""
                                    )),
                                        (t = t.replace(
                                            this.settings.negativeSignCharacter,
                                            ""
                                        )),
                                        (this.settings.mIntPos = Math.max(
                                            e.length,
                                            1
                                        )),
                                        (this.settings.mIntNeg = Math.max(
                                            t.length,
                                            1
                                        ));
                                },
                            },
                            {
                                key: "_calculateValuesToStringsKeys",
                                value: function () {
                                    this.settings.valuesToStrings
                                        ? (this.valuesToStringsKeys =
                                              Object.keys(
                                                  this.settings.valuesToStrings
                                              ))
                                        : (this.valuesToStringsKeys = []);
                                },
                            },
                            {
                                key: "_transformOptionsValuesToDefaultTypes",
                                value: function () {
                                    for (var e in this.settings)
                                        if (
                                            Object.prototype.hasOwnProperty.call(
                                                this.settings,
                                                e
                                            )
                                        ) {
                                            var t = this.settings[e];
                                            ("true" !== t && "false" !== t) ||
                                                (this.settings[e] =
                                                    "true" === t),
                                                "number" == typeof t &&
                                                    (this.settings[e] =
                                                        t.toString());
                                        }
                                },
                            },
                            {
                                key: "_setSettings",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1] &&
                                        arguments[1];
                                    (!t && h.isNull(e)) ||
                                        this.constructor._convertOldOptionsToNewOnes(
                                            e
                                        ),
                                        t
                                            ? ("decimalPlacesRawValue" in e &&
                                                  (this.settings.originalDecimalPlacesRawValue =
                                                      e.decimalPlacesRawValue),
                                              "decimalPlaces" in e &&
                                                  (this.settings.originalDecimalPlaces =
                                                      e.decimalPlaces),
                                              this.constructor._calculateDecimalPlacesOnUpdate(
                                                  e,
                                                  this.settings
                                              ),
                                              this._mergeSettings(e))
                                            : ((this.settings = {}),
                                              this._mergeSettings(
                                                  this.constructor.getDefaultConfig(),
                                                  this.domElement.dataset,
                                                  e,
                                                  {
                                                      rawValue:
                                                          this.defaultRawValue,
                                                  }
                                              ),
                                              (this.caretFix = !1),
                                              (this.throwInput = !0),
                                              (this.allowedTagList =
                                                  n.allowedTagList),
                                              (this.runOnce = !1),
                                              (this.hoveredWithAlt = !1)),
                                        this._transformOptionsValuesToDefaultTypes(),
                                        this._runCallbacksFoundInTheSettingsObject(),
                                        this.constructor._correctNegativePositiveSignPlacementOption(
                                            this.settings
                                        ),
                                        this.constructor._correctCaretPositionOnFocusAndSelectOnFocusOptions(
                                            this.settings
                                        ),
                                        this.constructor._setNegativePositiveSignPermissions(
                                            this.settings
                                        ),
                                        t ||
                                            (h.isNull(e) || !e.decimalPlaces
                                                ? (this.settings.originalDecimalPlaces =
                                                      null)
                                                : (this.settings.originalDecimalPlaces =
                                                      e.decimalPlaces),
                                            (this.settings.originalDecimalPlacesRawValue =
                                                this.settings.decimalPlacesRawValue),
                                            this.constructor._calculateDecimalPlacesOnInit(
                                                this.settings
                                            )),
                                        this._calculateVMinAndVMaxIntegerSizes(),
                                        this._setTrailingNegativeSignInfo(),
                                        (this.regex = {}),
                                        this.constructor._cachesUsualRegularExpressions(
                                            this.settings,
                                            this.regex
                                        ),
                                        this.constructor._setBrackets(
                                            this.settings
                                        ),
                                        this._calculateValuesToStringsKeys(),
                                        h.isEmptyObj(this.settings) &&
                                            h.throwError(
                                                "Unable to set the settings, those are invalid ; an empty object was given."
                                            ),
                                        this.constructor.validate(
                                            this.settings,
                                            !1,
                                            e
                                        ),
                                        this._keepAnOriginalSettingsCopy();
                                },
                            },
                            {
                                key: "_preparePastedText",
                                value: function (e) {
                                    return this.constructor._stripAllNonNumberCharacters(
                                        e,
                                        this.settings,
                                        !0,
                                        this.isFocused
                                    );
                                },
                            },
                            {
                                key: "_updateInternalProperties",
                                value: function () {
                                    (this.selection = h.getElementSelection(
                                        this.domElement
                                    )),
                                        (this.processed = !1);
                                },
                            },
                            {
                                key: "_updateEventKeyInfo",
                                value: function (e) {
                                    this.eventKey = h.character(e);
                                },
                            },
                            {
                                key: "_saveCancellableValue",
                                value: function () {
                                    this.savedCancellableValue = this.rawValue;
                                },
                            },
                            {
                                key: "_setSelection",
                                value: function (e, t) {
                                    (e = Math.max(e, 0)),
                                        (t = Math.min(
                                            t,
                                            h.getElementValue(this.domElement)
                                                .length
                                        )),
                                        (this.selection = {
                                            start: e,
                                            end: t,
                                            length: t - e,
                                        }),
                                        h.setElementSelection(
                                            this.domElement,
                                            e,
                                            t
                                        );
                                },
                            },
                            {
                                key: "_setCaretPosition",
                                value: function (e) {
                                    this._setSelection(e, e);
                                },
                            },
                            {
                                key: "_getLeftAndRightPartAroundTheSelection",
                                value: function () {
                                    var e = h.getElementValue(this.domElement);
                                    return [
                                        e.substring(0, this.selection.start),
                                        e.substring(
                                            this.selection.end,
                                            e.length
                                        ),
                                    ];
                                },
                            },
                            {
                                key: "_getUnformattedLeftAndRightPartAroundTheSelection",
                                value: function () {
                                    var t = F(
                                            this._getLeftAndRightPartAroundTheSelection(),
                                            2
                                        ),
                                        i = t[0],
                                        a = t[1];
                                    if ("" === i && "" === a) return ["", ""];
                                    var r = !0;
                                    return (
                                        (this.eventKey !== n.keyName.Hyphen &&
                                            this.eventKey !==
                                                n.keyName.Minus) ||
                                            0 !== Number(i) ||
                                            (r = !1),
                                        this.isTrailingNegative &&
                                            ((h.isNegative(
                                                a,
                                                this.settings
                                                    .negativeSignCharacter
                                            ) &&
                                                !h.isNegative(
                                                    i,
                                                    this.settings
                                                        .negativeSignCharacter
                                                )) ||
                                                ("" === a &&
                                                    h.isNegative(
                                                        i,
                                                        this.settings
                                                            .negativeSignCharacter,
                                                        !0
                                                    ))) &&
                                            ((i = i.replace(
                                                this.settings
                                                    .negativeSignCharacter,
                                                ""
                                            )),
                                            (a = a.replace(
                                                this.settings
                                                    .negativeSignCharacter,
                                                ""
                                            )),
                                            (i = i.replace("-", "")),
                                            (a = a.replace("-", "")),
                                            (i = "-".concat(i))),
                                        [
                                            (i =
                                                e._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                    i,
                                                    this.settings,
                                                    r,
                                                    this.isFocused
                                                )),
                                            (a =
                                                e._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                    a,
                                                    this.settings,
                                                    !1,
                                                    this.isFocused
                                                )),
                                        ]
                                    );
                                },
                            },
                            {
                                key: "_normalizeParts",
                                value: function (t, i) {
                                    var a = !0;
                                    (this.eventKey !== n.keyName.Hyphen &&
                                        this.eventKey !== n.keyName.Minus) ||
                                        0 !== Number(t) ||
                                        (a = !1),
                                        this.isTrailingNegative &&
                                            h.isNegative(
                                                i,
                                                this.settings
                                                    .negativeSignCharacter
                                            ) &&
                                            !h.isNegative(
                                                t,
                                                this.settings
                                                    .negativeSignCharacter
                                            ) &&
                                            ((t = "-".concat(t)),
                                            (i = i.replace(
                                                this.settings
                                                    .negativeSignCharacter,
                                                ""
                                            ))),
                                        (t =
                                            e._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                t,
                                                this.settings,
                                                a,
                                                this.isFocused
                                            )),
                                        (i =
                                            e._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                i,
                                                this.settings,
                                                !1,
                                                this.isFocused
                                            )),
                                        this.settings.leadingZero !==
                                            e.options.leadingZero.deny ||
                                            (this.eventKey !== n.keyName.num0 &&
                                                this.eventKey !==
                                                    n.keyName.numpad0) ||
                                            0 !== Number(t) ||
                                            h.contains(
                                                t,
                                                this.settings.decimalCharacter
                                            ) ||
                                            "" === i ||
                                            (t = t.substring(0, t.length - 1));
                                    var r = t + i;
                                    if (this.settings.decimalCharacter) {
                                        var o = r.match(
                                            new RegExp(
                                                "^"
                                                    .concat(
                                                        this.regex
                                                            .aNegRegAutoStrip,
                                                        "\\"
                                                    )
                                                    .concat(
                                                        this.settings
                                                            .decimalCharacter
                                                    )
                                            )
                                        );
                                        o &&
                                            (r =
                                                (t = t.replace(
                                                    o[1],
                                                    o[1] + "0"
                                                )) + i);
                                    }
                                    return [t, i, r];
                                },
                            },
                            {
                                key: "_setValueParts",
                                value: function (t, i) {
                                    var n =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2] &&
                                            arguments[2],
                                        a = F(this._normalizeParts(t, i), 3),
                                        r = a[0],
                                        o = a[1],
                                        s = a[2],
                                        l = F(
                                            e._checkIfInRangeWithOverrideOption(
                                                s,
                                                this.settings
                                            ),
                                            2
                                        ),
                                        u = l[0],
                                        c = l[1];
                                    if (u && c) {
                                        var h = e
                                            ._truncateDecimalPlaces(
                                                s,
                                                this.settings,
                                                n,
                                                this.settings
                                                    .decimalPlacesRawValue
                                            )
                                            .replace(
                                                this.settings.decimalCharacter,
                                                "."
                                            );
                                        if (
                                            "" === h ||
                                            h ===
                                                this.settings
                                                    .negativeSignCharacter
                                        ) {
                                            var m;
                                            switch (
                                                this.settings.emptyInputBehavior
                                            ) {
                                                case e.options
                                                    .emptyInputBehavior.focus:
                                                case e.options
                                                    .emptyInputBehavior.press:
                                                case e.options
                                                    .emptyInputBehavior.always:
                                                    m = "";
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.min:
                                                    m =
                                                        this.settings
                                                            .minimumValue;
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.max:
                                                    m =
                                                        this.settings
                                                            .maximumValue;
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.zero:
                                                    m = "0";
                                                    break;
                                                case e.options
                                                    .emptyInputBehavior.null:
                                                    m = null;
                                                    break;
                                                default:
                                                    m =
                                                        this.settings
                                                            .emptyInputBehavior;
                                            }
                                            this._setRawValue(m);
                                        } else
                                            this._setRawValue(
                                                this._trimLeadingAndTrailingZeros(
                                                    h
                                                )
                                            );
                                        var g = e._truncateDecimalPlaces(
                                                s,
                                                this.settings,
                                                n,
                                                this.settings
                                                    .decimalPlacesShownOnFocus
                                            ),
                                            d = r.length;
                                        return (
                                            d > g.length && (d = g.length),
                                            1 === d &&
                                                "0" === r &&
                                                this.settings.leadingZero ===
                                                    e.options.leadingZero
                                                        .deny &&
                                                (d =
                                                    "" === o ||
                                                    ("0" === r && "" !== o)
                                                        ? 1
                                                        : 0),
                                            this._setElementValue(g, !1),
                                            this._setCaretPosition(d),
                                            !0
                                        );
                                    }
                                    return this._triggerRangeEvents(u, c), !1;
                                },
                            },
                            {
                                key: "_getSignPosition",
                                value: function () {
                                    var t;
                                    if (this.settings.currencySymbol) {
                                        var i =
                                                this.settings.currencySymbol
                                                    .length,
                                            n = h.getElementValue(
                                                this.domElement
                                            );
                                        if (
                                            this.settings
                                                .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .prefix
                                        )
                                            t =
                                                this.settings
                                                    .negativeSignCharacter &&
                                                n &&
                                                n.charAt(0) ===
                                                    this.settings
                                                        .negativeSignCharacter
                                                    ? [1, i + 1]
                                                    : [0, i];
                                        else {
                                            var a = n.length;
                                            t = [a - i, a];
                                        }
                                    } else t = [1e3, -1];
                                    return t;
                                },
                            },
                            {
                                key: "_expandSelectionOnSign",
                                value: function () {
                                    var e = F(this._getSignPosition(), 2),
                                        t = e[0],
                                        i = e[1],
                                        n = this.selection;
                                    n.start < i &&
                                        n.end > t &&
                                        ((n.start < t || n.end > i) &&
                                        h
                                            .getElementValue(this.domElement)
                                            .substring(
                                                Math.max(n.start, t),
                                                Math.min(n.end, i)
                                            )
                                            .match(/^\s*$/)
                                            ? n.start < t
                                                ? this._setSelection(n.start, t)
                                                : this._setSelection(i, n.end)
                                            : this._setSelection(
                                                  Math.min(n.start, t),
                                                  Math.max(n.end, i)
                                              ));
                                },
                            },
                            {
                                key: "_checkPaste",
                                value: function () {
                                    if (
                                        !this.formatted &&
                                        !h.isUndefined(
                                            this.valuePartsBeforePaste
                                        )
                                    ) {
                                        var t = this.valuePartsBeforePaste,
                                            i = F(
                                                this._getLeftAndRightPartAroundTheSelection(),
                                                2
                                            ),
                                            n = i[0],
                                            a = i[1];
                                        delete this.valuePartsBeforePaste;
                                        var r =
                                            n.substr(0, t[0].length) +
                                            e._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                n.substr(t[0].length),
                                                this.settings,
                                                !0,
                                                this.isFocused
                                            );
                                        this._setValueParts(r, a, !0) ||
                                            (this._setElementValue(
                                                t.join(""),
                                                !1
                                            ),
                                            this._setCaretPosition(
                                                t[0].length
                                            ));
                                    }
                                },
                            },
                            {
                                key: "_processNonPrintableKeysAndShortcuts",
                                value: function (e) {
                                    if (
                                        ((e.ctrlKey || e.metaKey) &&
                                            "keyup" === e.type &&
                                            !h.isUndefined(
                                                this.valuePartsBeforePaste
                                            )) ||
                                        (e.shiftKey &&
                                            this.eventKey === n.keyName.Insert)
                                    )
                                        return this._checkPaste(), !1;
                                    if (
                                        this.constructor._shouldSkipEventKey(
                                            this.eventKey
                                        )
                                    )
                                        return !0;
                                    if (
                                        (e.ctrlKey || e.metaKey) &&
                                        this.eventKey === n.keyName.a
                                    )
                                        return (
                                            this.settings.selectNumberOnly &&
                                                (e.preventDefault(),
                                                this.selectNumber()),
                                            !0
                                        );
                                    if (
                                        (e.ctrlKey || e.metaKey) &&
                                        (this.eventKey === n.keyName.c ||
                                            this.eventKey === n.keyName.v ||
                                            this.eventKey === n.keyName.x)
                                    )
                                        return (
                                            "keydown" === e.type &&
                                                this._expandSelectionOnSign(),
                                            (this.eventKey !== n.keyName.v &&
                                                this.eventKey !==
                                                    n.keyName.Insert) ||
                                                ("keydown" === e.type ||
                                                "keypress" === e.type
                                                    ? h.isUndefined(
                                                          this
                                                              .valuePartsBeforePaste
                                                      ) &&
                                                      (this.valuePartsBeforePaste =
                                                          this._getLeftAndRightPartAroundTheSelection())
                                                    : this._checkPaste()),
                                            "keydown" === e.type ||
                                                "keypress" === e.type ||
                                                this.eventKey === n.keyName.c
                                        );
                                    if (e.ctrlKey || e.metaKey)
                                        return !(
                                            this.eventKey === n.keyName.Z ||
                                            this.eventKey === n.keyName.z
                                        );
                                    if (
                                        this.eventKey === n.keyName.LeftArrow ||
                                        this.eventKey === n.keyName.RightArrow
                                    ) {
                                        if (
                                            "keydown" === e.type &&
                                            !e.shiftKey
                                        ) {
                                            var t = h.getElementValue(
                                                this.domElement
                                            );
                                            this.eventKey !==
                                                n.keyName.LeftArrow ||
                                            (t.charAt(
                                                this.selection.start - 2
                                            ) !==
                                                this.settings
                                                    .digitGroupSeparator &&
                                                t.charAt(
                                                    this.selection.start - 2
                                                ) !==
                                                    this.settings
                                                        .decimalCharacter)
                                                ? this.eventKey !==
                                                      n.keyName.RightArrow ||
                                                  (t.charAt(
                                                      this.selection.start + 1
                                                  ) !==
                                                      this.settings
                                                          .digitGroupSeparator &&
                                                      t.charAt(
                                                          this.selection.start +
                                                              1
                                                      ) !==
                                                          this.settings
                                                              .decimalCharacter) ||
                                                  this._setCaretPosition(
                                                      this.selection.start + 1
                                                  )
                                                : this._setCaretPosition(
                                                      this.selection.start - 1
                                                  );
                                        }
                                        return !0;
                                    }
                                    return h.isInArray(
                                        this.eventKey,
                                        n.keyName._directionKeys
                                    );
                                },
                            },
                            {
                                key: "_processCharacterDeletionIfTrailingNegativeSign",
                                value: function (t) {
                                    var i = F(t, 2),
                                        a = i[0],
                                        r = i[1],
                                        o = h.getElementValue(this.domElement),
                                        s = h.isNegative(
                                            o,
                                            this.settings.negativeSignCharacter
                                        );
                                    if (
                                        (this.settings
                                            .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .prefix &&
                                            this.settings
                                                .negativePositiveSignPlacement ===
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .suffix &&
                                            (this.eventKey ===
                                            n.keyName.Backspace
                                                ? ((this.caretFix =
                                                      this.selection.start >=
                                                          o.indexOf(
                                                              this.settings
                                                                  .suffixText
                                                          ) &&
                                                      "" !==
                                                          this.settings
                                                              .suffixText),
                                                  "-" ===
                                                  o.charAt(
                                                      this.selection.start - 1
                                                  )
                                                      ? (a = a.substring(1))
                                                      : this.selection.start <=
                                                            o.length -
                                                                this.settings
                                                                    .suffixText
                                                                    .length &&
                                                        (a = a.substring(
                                                            0,
                                                            a.length - 1
                                                        )))
                                                : ((this.caretFix =
                                                      this.selection.start >=
                                                          o.indexOf(
                                                              this.settings
                                                                  .suffixText
                                                          ) &&
                                                      "" !==
                                                          this.settings
                                                              .suffixText),
                                                  this.selection.start >=
                                                      o.indexOf(
                                                          this.settings
                                                              .currencySymbol
                                                      ) +
                                                          this.settings
                                                              .currencySymbol
                                                              .length &&
                                                      (r = r.substring(
                                                          1,
                                                          r.length
                                                      )),
                                                  h.isNegative(
                                                      a,
                                                      this.settings
                                                          .negativeSignCharacter
                                                  ) &&
                                                      "-" ===
                                                          o.charAt(
                                                              this.selection
                                                                  .start
                                                          ) &&
                                                      (a = a.substring(1)))),
                                        this.settings
                                            .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .suffix)
                                    )
                                        switch (
                                            this.settings
                                                .negativePositiveSignPlacement
                                        ) {
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .left:
                                                (this.caretFix =
                                                    this.selection.start >=
                                                    o.indexOf(
                                                        this.settings
                                                            .negativeSignCharacter
                                                    ) +
                                                        this.settings
                                                            .negativeSignCharacter
                                                            .length),
                                                    this.eventKey ===
                                                    n.keyName.Backspace
                                                        ? this.selection
                                                              .start ===
                                                              o.indexOf(
                                                                  this.settings
                                                                      .negativeSignCharacter
                                                              ) +
                                                                  this.settings
                                                                      .negativeSignCharacter
                                                                      .length &&
                                                          s
                                                            ? (a =
                                                                  a.substring(
                                                                      1
                                                                  ))
                                                            : "-" !== a &&
                                                              (this.selection
                                                                  .start <=
                                                                  o.indexOf(
                                                                      this
                                                                          .settings
                                                                          .negativeSignCharacter
                                                                  ) ||
                                                                  !s) &&
                                                              (a = a.substring(
                                                                  0,
                                                                  a.length - 1
                                                              ))
                                                        : ("-" === a[0] &&
                                                              (r =
                                                                  r.substring(
                                                                      1
                                                                  )),
                                                          this.selection
                                                              .start ===
                                                              o.indexOf(
                                                                  this.settings
                                                                      .negativeSignCharacter
                                                              ) &&
                                                              s &&
                                                              (a =
                                                                  a.substring(
                                                                      1
                                                                  )));
                                                break;
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .right:
                                                (this.caretFix =
                                                    this.selection.start >=
                                                    o.indexOf(
                                                        this.settings
                                                            .negativeSignCharacter
                                                    ) +
                                                        this.settings
                                                            .negativeSignCharacter
                                                            .length),
                                                    this.eventKey ===
                                                    n.keyName.Backspace
                                                        ? this.selection
                                                              .start ===
                                                          o.indexOf(
                                                              this.settings
                                                                  .negativeSignCharacter
                                                          ) +
                                                              this.settings
                                                                  .negativeSignCharacter
                                                                  .length
                                                            ? (a =
                                                                  a.substring(
                                                                      1
                                                                  ))
                                                            : "-" !== a &&
                                                              this.selection
                                                                  .start <=
                                                                  o.indexOf(
                                                                      this
                                                                          .settings
                                                                          .negativeSignCharacter
                                                                  ) -
                                                                      this
                                                                          .settings
                                                                          .currencySymbol
                                                                          .length
                                                            ? (a = a.substring(
                                                                  0,
                                                                  a.length - 1
                                                              ))
                                                            : "" === a ||
                                                              s ||
                                                              (a = a.substring(
                                                                  0,
                                                                  a.length - 1
                                                              ))
                                                        : ((this.caretFix =
                                                              this.selection
                                                                  .start >=
                                                                  o.indexOf(
                                                                      this
                                                                          .settings
                                                                          .currencySymbol
                                                                  ) &&
                                                              "" !==
                                                                  this.settings
                                                                      .currencySymbol),
                                                          this.selection
                                                              .start ===
                                                              o.indexOf(
                                                                  this.settings
                                                                      .negativeSignCharacter
                                                              ) &&
                                                              (a =
                                                                  a.substring(
                                                                      1
                                                                  )),
                                                          (r = r.substring(1)));
                                        }
                                    return [a, r];
                                },
                            },
                            {
                                key: "_processCharacterDeletion",
                                value: function (e) {
                                    var t, i;
                                    if (this.selection.length) {
                                        this._expandSelectionOnSign();
                                        var a = F(
                                            this._getUnformattedLeftAndRightPartAroundTheSelection(),
                                            2
                                        );
                                        (t = a[0]), (i = a[1]);
                                    } else {
                                        var r = F(
                                            this._getUnformattedLeftAndRightPartAroundTheSelection(),
                                            2
                                        );
                                        if (
                                            ((t = r[0]),
                                            (i = r[1]),
                                            "" === t &&
                                                "" === i &&
                                                (this.throwInput = !1),
                                            this.isTrailingNegative &&
                                                h.isNegative(
                                                    h.getElementValue(
                                                        this.domElement
                                                    ),
                                                    this.settings
                                                        .negativeSignCharacter
                                                ))
                                        ) {
                                            var o = F(
                                                this._processCharacterDeletionIfTrailingNegativeSign(
                                                    [t, i]
                                                ),
                                                2
                                            );
                                            (t = o[0]), (i = o[1]);
                                        } else
                                            this.eventKey ===
                                            n.keyName.Backspace
                                                ? (t = t.substring(
                                                      0,
                                                      t.length - 1
                                                  ))
                                                : (i = i.substring(
                                                      1,
                                                      i.length
                                                  ));
                                    }
                                    return (
                                        !!this.constructor._isWithinRangeWithOverrideOption(
                                            "".concat(t).concat(i),
                                            this.settings
                                        ) &&
                                        h.getElementValue(e.target) !==
                                            this.settings.currencySymbol &&
                                        (this._setValueParts(t, i), !0)
                                    );
                                },
                            },
                            {
                                key: "_isDecimalCharacterInsertionAllowed",
                                value: function () {
                                    return (
                                        String(
                                            this.settings
                                                .decimalPlacesShownOnFocus
                                        ) !==
                                            String(
                                                e.options
                                                    .decimalPlacesShownOnFocus
                                                    .none
                                            ) &&
                                        String(this.settings.decimalPlaces) !==
                                            String(e.options.decimalPlaces.none)
                                    );
                                },
                            },
                            {
                                key: "_processCharacterInsertion",
                                value: function () {
                                    var e = F(
                                            this._getUnformattedLeftAndRightPartAroundTheSelection(),
                                            2
                                        ),
                                        t = e[0],
                                        i = e[1];
                                    if (
                                        (this.eventKey !==
                                            n.keyName.AndroidDefault &&
                                            (this.throwInput = !0),
                                        this.eventKey ===
                                            this.settings.decimalCharacter ||
                                            (this.settings
                                                .decimalCharacterAlternative &&
                                                this.eventKey ===
                                                    this.settings
                                                        .decimalCharacterAlternative))
                                    ) {
                                        if (
                                            !this._isDecimalCharacterInsertionAllowed() ||
                                            !this.settings.decimalCharacter
                                        )
                                            return !1;
                                        if (
                                            this.settings
                                                .alwaysAllowDecimalCharacter
                                        )
                                            (t = t.replace(
                                                this.settings.decimalCharacter,
                                                ""
                                            )),
                                                (i = i.replace(
                                                    this.settings
                                                        .decimalCharacter,
                                                    ""
                                                ));
                                        else {
                                            if (
                                                h.contains(
                                                    t,
                                                    this.settings
                                                        .decimalCharacter
                                                )
                                            )
                                                return !0;
                                            if (
                                                i.indexOf(
                                                    this.settings
                                                        .decimalCharacter
                                                ) > 0
                                            )
                                                return !0;
                                            0 ===
                                                i.indexOf(
                                                    this.settings
                                                        .decimalCharacter
                                                ) && (i = i.substr(1));
                                        }
                                        return (
                                            this.settings
                                                .negativeSignCharacter &&
                                                h.contains(
                                                    i,
                                                    this.settings
                                                        .negativeSignCharacter
                                                ) &&
                                                ((t = ""
                                                    .concat(
                                                        this.settings
                                                            .negativeSignCharacter
                                                    )
                                                    .concat(t)),
                                                (i = i.replace(
                                                    this.settings
                                                        .negativeSignCharacter,
                                                    ""
                                                ))),
                                            this._setValueParts(
                                                t +
                                                    this.settings
                                                        .decimalCharacter,
                                                i
                                            ),
                                            !0
                                        );
                                    }
                                    if (
                                        ("-" === this.eventKey ||
                                            "+" === this.eventKey) &&
                                        this.settings.isNegativeSignAllowed
                                    )
                                        return (
                                            "" === t && h.contains(i, "-")
                                                ? (this.settings
                                                      .negativePositiveSignBehavior ||
                                                      (!this.settings
                                                          .negativePositiveSignBehavior &&
                                                          "+" ===
                                                              this.eventKey)) &&
                                                  (i = i.replace("-", ""))
                                                : h.isNegativeStrict(t, "-")
                                                ? (this.settings
                                                      .negativePositiveSignBehavior ||
                                                      (!this.settings
                                                          .negativePositiveSignBehavior &&
                                                          "+" ===
                                                              this.eventKey)) &&
                                                  (t = t.replace("-", ""))
                                                : (this.settings
                                                      .negativePositiveSignBehavior ||
                                                      (!this.settings
                                                          .negativePositiveSignBehavior &&
                                                          "-" ===
                                                              this.eventKey)) &&
                                                  (t = ""
                                                      .concat(
                                                          this.settings
                                                              .negativeSignCharacter
                                                      )
                                                      .concat(t)),
                                            this._setValueParts(t, i),
                                            !0
                                        );
                                    var a = Number(this.eventKey);
                                    return a >= 0 && a <= 9
                                        ? (this.settings
                                              .isNegativeSignAllowed &&
                                              "" === t &&
                                              h.contains(i, "-") &&
                                              ((t = "-"),
                                              (i = i.substring(1, i.length))),
                                          this.settings.maximumValue <= 0 &&
                                              this.settings.minimumValue <
                                                  this.settings.maximumValue &&
                                              !h.contains(
                                                  h.getElementValue(
                                                      this.domElement
                                                  ),
                                                  this.settings
                                                      .negativeSignCharacter
                                              ) &&
                                              "0" !== this.eventKey &&
                                              (t = "-".concat(t)),
                                          this._setValueParts(
                                              ""
                                                  .concat(t)
                                                  .concat(this.eventKey),
                                              i
                                          ),
                                          !0)
                                        : ((this.throwInput = !1), !1);
                                },
                            },
                            {
                                key: "_formatValue",
                                value: function (t) {
                                    var i = h.getElementValue(this.domElement),
                                        a = F(
                                            this._getUnformattedLeftAndRightPartAroundTheSelection(),
                                            1
                                        )[0];
                                    if (
                                        ("" ===
                                            this.settings.digitGroupSeparator ||
                                            ("" !==
                                                this.settings
                                                    .digitGroupSeparator &&
                                                !h.contains(
                                                    i,
                                                    this.settings
                                                        .digitGroupSeparator
                                                ))) &&
                                        ("" === this.settings.currencySymbol ||
                                            ("" !==
                                                this.settings.currencySymbol &&
                                                !h.contains(
                                                    i,
                                                    this.settings.currencySymbol
                                                )))
                                    ) {
                                        var r = F(
                                                i.split(
                                                    this.settings
                                                        .decimalCharacter
                                                ),
                                                1
                                            )[0],
                                            o = "";
                                        h.isNegative(
                                            r,
                                            this.settings.negativeSignCharacter
                                        ) &&
                                            ((o =
                                                this.settings
                                                    .negativeSignCharacter),
                                            (r = r.replace(
                                                this.settings
                                                    .negativeSignCharacter,
                                                ""
                                            )),
                                            (a = a.replace("-", ""))),
                                            "" === o &&
                                                r.length >
                                                    this.settings.mIntPos &&
                                                "0" === a.charAt(0) &&
                                                (a = a.slice(1)),
                                            o ===
                                                this.settings
                                                    .negativeSignCharacter &&
                                                r.length >
                                                    this.settings.mIntNeg &&
                                                "0" === a.charAt(0) &&
                                                (a = a.slice(1)),
                                            this.isTrailingNegative ||
                                                (a = "".concat(o).concat(a));
                                    }
                                    var s =
                                            this.constructor._addGroupSeparators(
                                                i,
                                                this.settings,
                                                this.isFocused,
                                                this.rawValue
                                            ),
                                        l = s.length;
                                    if (s) {
                                        var u,
                                            c = a.split("");
                                        if (
                                            (this.settings
                                                .negativePositiveSignPlacement ===
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .suffix ||
                                                (this.settings
                                                    .negativePositiveSignPlacement !==
                                                    e.options
                                                        .negativePositiveSignPlacement
                                                        .prefix &&
                                                    this.settings
                                                        .currencySymbolPlacement ===
                                                        e.options
                                                            .currencySymbolPlacement
                                                            .suffix)) &&
                                            c[0] ===
                                                this.settings
                                                    .negativeSignCharacter &&
                                            !this.settings
                                                .isNegativeSignAllowed &&
                                            (c.shift(),
                                            (this.eventKey ===
                                                n.keyName.Backspace ||
                                                this.eventKey ===
                                                    n.keyName.Delete) &&
                                                this.caretFix &&
                                                (((this.settings
                                                    .currencySymbolPlacement ===
                                                    e.options
                                                        .currencySymbolPlacement
                                                        .suffix &&
                                                    this.settings
                                                        .negativePositiveSignPlacement ===
                                                        e.options
                                                            .negativePositiveSignPlacement
                                                            .left) ||
                                                    (this.settings
                                                        .currencySymbolPlacement ===
                                                        e.options
                                                            .currencySymbolPlacement
                                                            .prefix &&
                                                        this.settings
                                                            .negativePositiveSignPlacement ===
                                                            e.options
                                                                .negativePositiveSignPlacement
                                                                .suffix)) &&
                                                    (c.push(
                                                        this.settings
                                                            .negativeSignCharacter
                                                    ),
                                                    (this.caretFix =
                                                        "keydown" === t.type)),
                                                this.settings
                                                    .currencySymbolPlacement ===
                                                    e.options
                                                        .currencySymbolPlacement
                                                        .suffix &&
                                                    this.settings
                                                        .negativePositiveSignPlacement ===
                                                        e.options
                                                            .negativePositiveSignPlacement
                                                            .right))
                                        ) {
                                            var m =
                                                    this.settings.currencySymbol.split(
                                                        ""
                                                    ),
                                                g = [
                                                    "\\",
                                                    "^",
                                                    "$",
                                                    ".",
                                                    "|",
                                                    "?",
                                                    "*",
                                                    "+",
                                                    "(",
                                                    ")",
                                                    "[",
                                                ],
                                                d = [];
                                            m.forEach(function (e, t) {
                                                (t = m[e]),
                                                    h.isInArray(t, g)
                                                        ? d.push("\\" + t)
                                                        : d.push(t);
                                            }),
                                                this.eventKey ===
                                                    n.keyName.Backspace &&
                                                    "-" ===
                                                        this.settings
                                                            .negativeSignCharacter &&
                                                    d.push("-"),
                                                c.push(d.join("")),
                                                (this.caretFix =
                                                    "keydown" === t.type);
                                        }
                                        for (var v = 0; v < c.length; v++)
                                            c[v].match("\\d") ||
                                                (c[v] = "\\" + c[v]);
                                        u =
                                            this.settings
                                                .currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .suffix
                                                ? new RegExp(
                                                      "^.*?".concat(
                                                          c.join(".*?")
                                                      )
                                                  )
                                                : new RegExp(
                                                      "^.*?["
                                                          .concat(
                                                              this.settings
                                                                  .currencySymbol,
                                                              "]*"
                                                          )
                                                          .concat(c.join(".*?"))
                                                  );
                                        var p = s.match(u);
                                        p
                                            ? ((l = p[0].length),
                                              this.settings.showPositiveSign &&
                                                  (0 === l &&
                                                      p.input.charAt(0) ===
                                                          this.settings
                                                              .positiveSignCharacter &&
                                                      (l =
                                                          1 ===
                                                          p.input.indexOf(
                                                              this.settings
                                                                  .currencySymbol
                                                          )
                                                              ? this.settings
                                                                    .currencySymbol
                                                                    .length + 1
                                                              : 1),
                                                  0 === l &&
                                                      p.input.charAt(
                                                          this.settings
                                                              .currencySymbol
                                                              .length
                                                      ) ===
                                                          this.settings
                                                              .positiveSignCharacter &&
                                                      (l =
                                                          this.settings
                                                              .currencySymbol
                                                              .length + 1)),
                                              ((0 === l &&
                                                  s.charAt(0) !==
                                                      this.settings
                                                          .negativeSignCharacter) ||
                                                  (1 === l &&
                                                      s.charAt(0) ===
                                                          this.settings
                                                              .negativeSignCharacter)) &&
                                                  this.settings
                                                      .currencySymbol &&
                                                  this.settings
                                                      .currencySymbolPlacement ===
                                                      e.options
                                                          .currencySymbolPlacement
                                                          .prefix &&
                                                  (l =
                                                      this.settings
                                                          .currencySymbol
                                                          .length +
                                                      (h.isNegativeStrict(
                                                          s,
                                                          this.settings
                                                              .negativeSignCharacter
                                                      )
                                                          ? 1
                                                          : 0)))
                                            : (this.settings.currencySymbol &&
                                                  this.settings
                                                      .currencySymbolPlacement ===
                                                      e.options
                                                          .currencySymbolPlacement
                                                          .suffix &&
                                                  (l -=
                                                      this.settings
                                                          .currencySymbol
                                                          .length),
                                              this.settings.suffixText &&
                                                  (l -=
                                                      this.settings.suffixText
                                                          .length));
                                    }
                                    s !== i &&
                                        (this._setElementValue(s, !1),
                                        this._setCaretPosition(l)),
                                        (this.formatted = !0);
                                },
                            },
                        ]),
                        (a = [
                            {
                                key: "version",
                                value: function () {
                                    return "4.8.1";
                                },
                            },
                            {
                                key: "_setArgumentsValues",
                                value: function (e, t, i) {
                                    h.isNull(e) &&
                                        h.throwError(
                                            "At least one valid parameter is needed in order to initialize an AutoNumeric object"
                                        );
                                    var n,
                                        a,
                                        r,
                                        o = h.isElement(e),
                                        s = h.isString(e),
                                        l = h.isObject(t),
                                        u = Array.isArray(t) && t.length > 0,
                                        c = h.isNumberOrArabic(t) || "" === t,
                                        m = this._isPreDefinedOptionValid(t),
                                        g = h.isNull(t),
                                        d = h.isEmptyString(t),
                                        v = h.isObject(i),
                                        p = Array.isArray(i) && i.length > 0,
                                        f = h.isNull(i),
                                        y = this._isPreDefinedOptionValid(i);
                                    return (
                                        o && g && f
                                            ? ((n = e), (r = null), (a = null))
                                            : o && c && f
                                            ? ((n = e), (r = t), (a = null))
                                            : o && l && f
                                            ? ((n = e), (r = null), (a = t))
                                            : o && m && f
                                            ? ((n = e),
                                              (r = null),
                                              (a = this._getOptionObject(t)))
                                            : o && u && f
                                            ? ((n = e),
                                              (r = null),
                                              (a = this.mergeOptions(t)))
                                            : o && (g || d) && v
                                            ? ((n = e), (r = null), (a = i))
                                            : o && (g || d) && p
                                            ? ((n = e),
                                              (r = null),
                                              (a = this.mergeOptions(i)))
                                            : s && g && f
                                            ? ((n = document.querySelector(e)),
                                              (r = null),
                                              (a = null))
                                            : s && l && f
                                            ? ((n = document.querySelector(e)),
                                              (r = null),
                                              (a = t))
                                            : s && m && f
                                            ? ((n = document.querySelector(e)),
                                              (r = null),
                                              (a = this._getOptionObject(t)))
                                            : s && u && f
                                            ? ((n = document.querySelector(e)),
                                              (r = null),
                                              (a = this.mergeOptions(t)))
                                            : s && (g || d) && v
                                            ? ((n = document.querySelector(e)),
                                              (r = null),
                                              (a = i))
                                            : s && (g || d) && p
                                            ? ((n = document.querySelector(e)),
                                              (r = null),
                                              (a = this.mergeOptions(i)))
                                            : s && c && f
                                            ? ((n = document.querySelector(e)),
                                              (r = t),
                                              (a = null))
                                            : s && c && v
                                            ? ((n = document.querySelector(e)),
                                              (r = t),
                                              (a = i))
                                            : s && c && y
                                            ? ((n = document.querySelector(e)),
                                              (r = t),
                                              (a = this._getOptionObject(i)))
                                            : s && c && p
                                            ? ((n = document.querySelector(e)),
                                              (r = t),
                                              (a = this.mergeOptions(i)))
                                            : o && c && v
                                            ? ((n = e), (r = t), (a = i))
                                            : o && c && y
                                            ? ((n = e),
                                              (r = t),
                                              (a = this._getOptionObject(i)))
                                            : o && c && p
                                            ? ((n = e),
                                              (r = t),
                                              (a = this.mergeOptions(i)))
                                            : h.throwError(
                                                  "The parameters given to the AutoNumeric object are not valid, '"
                                                      .concat(e, "', '")
                                                      .concat(t, "' and '")
                                                      .concat(i, "' given.")
                                              ),
                                        h.isNull(n) &&
                                            h.throwError(
                                                "The selector '".concat(
                                                    e,
                                                    "' did not select any valid DOM element. Please check on which element you called AutoNumeric."
                                                )
                                            ),
                                        {
                                            domElement: n,
                                            initialValue: r,
                                            userOptions: a,
                                        }
                                    );
                                },
                            },
                            {
                                key: "mergeOptions",
                                value: function (e) {
                                    var t = this,
                                        i = {};
                                    return (
                                        e.forEach(function (e) {
                                            T(i, t._getOptionObject(e));
                                        }),
                                        i
                                    );
                                },
                            },
                            {
                                key: "_isPreDefinedOptionValid",
                                value: function (t) {
                                    return Object.prototype.hasOwnProperty.call(
                                        e.predefinedOptions,
                                        t
                                    );
                                },
                            },
                            {
                                key: "_getOptionObject",
                                value: function (t) {
                                    var i;
                                    return (
                                        h.isString(t)
                                            ? null ==
                                                  (i =
                                                      e.getPredefinedOptions()[
                                                          t
                                                      ]) &&
                                              h.warning(
                                                  "The given pre-defined option [".concat(
                                                      t,
                                                      "] is not recognized by autoNumeric. Please check that pre-defined option name."
                                                  ),
                                                  !0
                                              )
                                            : (i = t),
                                        i
                                    );
                                },
                            },
                            {
                                key: "_doesFormHandlerListExists",
                                value: function () {
                                    var e = A(window.aNFormHandlerMap);
                                    return "undefined" !== e && "object" === e;
                                },
                            },
                            {
                                key: "_createFormHandlerList",
                                value: function () {
                                    window.aNFormHandlerMap = new Map();
                                },
                            },
                            {
                                key: "_checkValuesToStringsArray",
                                value: function (e, t) {
                                    return h.isInArray(String(e), t);
                                },
                            },
                            {
                                key: "_checkValuesToStringsSettings",
                                value: function (e, t) {
                                    return this._checkValuesToStringsArray(
                                        e,
                                        Object.keys(t.valuesToStrings)
                                    );
                                },
                            },
                            {
                                key: "_checkStringsToValuesSettings",
                                value: function (e, t) {
                                    return this._checkValuesToStringsArray(
                                        e,
                                        Object.values(t.valuesToStrings)
                                    );
                                },
                            },
                            {
                                key: "_unformatAltHovered",
                                value: function (e) {
                                    (e.hoveredWithAlt = !0), e.unformat();
                                },
                            },
                            {
                                key: "_reformatAltHovered",
                                value: function (e) {
                                    (e.hoveredWithAlt = !1), e.reformat();
                                },
                            },
                            {
                                key: "_getChildANInputElement",
                                value: function (e) {
                                    var t = this,
                                        i = e.getElementsByTagName("input"),
                                        n = [];
                                    return (
                                        Array.prototype.slice
                                            .call(i, 0)
                                            .forEach(function (e) {
                                                t.test(e) && n.push(e);
                                            }),
                                        n
                                    );
                                },
                            },
                            {
                                key: "test",
                                value: function (e) {
                                    return this._isInGlobalList(
                                        h.domElement(e)
                                    );
                                },
                            },
                            {
                                key: "_createWeakMap",
                                value: function (e) {
                                    window[e] = new WeakMap();
                                },
                            },
                            {
                                key: "_createGlobalList",
                                value: function () {
                                    (this.autoNumericGlobalListName =
                                        "autoNumericGlobalList"),
                                        this._createWeakMap(
                                            this.autoNumericGlobalListName
                                        );
                                },
                            },
                            {
                                key: "_doesGlobalListExists",
                                value: function () {
                                    var e = A(
                                        window[this.autoNumericGlobalListName]
                                    );
                                    return "undefined" !== e && "object" === e;
                                },
                            },
                            {
                                key: "_addToGlobalList",
                                value: function (e) {
                                    this._doesGlobalListExists() ||
                                        this._createGlobalList();
                                    var t = e.node();
                                    if (this._isInGlobalList(t)) {
                                        if (this._getFromGlobalList(t) === this)
                                            return;
                                        h.warning(
                                            "A reference to the DOM element you just initialized already exists in the global AutoNumeric element list. Please make sure to not initialize the same DOM element multiple times.",
                                            e.getSettings().showWarnings
                                        );
                                    }
                                    window[this.autoNumericGlobalListName].set(
                                        t,
                                        e
                                    );
                                },
                            },
                            {
                                key: "_removeFromGlobalList",
                                value: function (e) {
                                    this._doesGlobalListExists() &&
                                        window[
                                            this.autoNumericGlobalListName
                                        ].delete(e.node());
                                },
                            },
                            {
                                key: "_getFromGlobalList",
                                value: function (e) {
                                    return this._doesGlobalListExists()
                                        ? window[
                                              this.autoNumericGlobalListName
                                          ].get(e)
                                        : null;
                                },
                            },
                            {
                                key: "_isInGlobalList",
                                value: function (e) {
                                    return (
                                        !!this._doesGlobalListExists() &&
                                        window[
                                            this.autoNumericGlobalListName
                                        ].has(e)
                                    );
                                },
                            },
                            {
                                key: "validate",
                                value: function (t) {
                                    var i =
                                            !(
                                                arguments.length > 1 &&
                                                void 0 !== arguments[1]
                                            ) || arguments[1],
                                        n =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null;
                                    (!h.isUndefinedOrNullOrEmpty(t) &&
                                        h.isObject(t)) ||
                                        h.throwError(
                                            "The userOptions are invalid ; it should be a valid object, [".concat(
                                                t,
                                                "] given."
                                            )
                                        );
                                    var a,
                                        r = h.isObject(n);
                                    r ||
                                        h.isNull(n) ||
                                        h.throwError(
                                            "The 'originalOptions' parameter is invalid ; it should either be a valid option object or `null`, [".concat(
                                                t,
                                                "] given."
                                            )
                                        ),
                                        h.isNull(t) ||
                                            this._convertOldOptionsToNewOnes(t),
                                        (a = i
                                            ? T({}, this.getDefaultConfig(), t)
                                            : t),
                                        h.isTrueOrFalseString(a.showWarnings) ||
                                            h.isBoolean(a.showWarnings) ||
                                            h.throwError(
                                                "The debug option 'showWarnings' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.showWarnings,
                                                    "] given."
                                                )
                                            );
                                    var o,
                                        s = /^[0-9]+$/,
                                        l = /[0-9]+/,
                                        u = /^-?[0-9]+(\.?[0-9]+)?$/,
                                        c = /^[0-9]+(\.?[0-9]+)?$/;
                                    h.isTrueOrFalseString(
                                        a.allowDecimalPadding
                                    ) ||
                                        h.isBoolean(a.allowDecimalPadding) ||
                                        a.allowDecimalPadding ===
                                            e.options.allowDecimalPadding
                                                .floats ||
                                        (h.isNumber(a.allowDecimalPadding) &&
                                            a.allowDecimalPadding > 0) ||
                                        h.throwError(
                                            "The decimal padding option 'allowDecimalPadding' is invalid ; it should either be `false`, `true`, `'floats'` or a positive integer superior to 0, [".concat(
                                                a.allowDecimalPadding,
                                                "] given."
                                            )
                                        ),
                                        h.isNumber(a.allowDecimalPadding) &&
                                            a.allowDecimalPadding >
                                                a.decimalPlaces &&
                                            h.warning(
                                                "Setting 'allowDecimalPadding' to a number ["
                                                    .concat(
                                                        a.allowDecimalPadding,
                                                        "] superior to the current 'decimalPlaces' settings ["
                                                    )
                                                    .concat(
                                                        a.decimalPlaces,
                                                        "] is useless, since the padding will not be shown."
                                                    ),
                                                a.showWarnings
                                            ),
                                        (a.allowDecimalPadding !==
                                            e.options.allowDecimalPadding
                                                .never &&
                                            "false" !==
                                                a.allowDecimalPadding) ||
                                            (a.decimalPlaces ===
                                                e.options.decimalPlaces.none &&
                                                a.decimalPlacesShownOnBlur ===
                                                    e.options
                                                        .decimalPlacesShownOnBlur
                                                        .none &&
                                                a.decimalPlacesShownOnFocus ===
                                                    e.options
                                                        .decimalPlacesShownOnFocus
                                                        .none) ||
                                            h.warning(
                                                "Setting 'allowDecimalPadding' to ["
                                                    .concat(
                                                        a.allowDecimalPadding,
                                                        "] will override the current 'decimalPlaces*' settings ["
                                                    )
                                                    .concat(
                                                        a.decimalPlaces,
                                                        ", "
                                                    )
                                                    .concat(
                                                        a.decimalPlacesShownOnBlur,
                                                        " and "
                                                    )
                                                    .concat(
                                                        a.decimalPlacesShownOnFocus,
                                                        "]."
                                                    ),
                                                a.showWarnings
                                            ),
                                        h.isTrueOrFalseString(
                                            a.alwaysAllowDecimalCharacter
                                        ) ||
                                            h.isBoolean(
                                                a.alwaysAllowDecimalCharacter
                                            ) ||
                                            h.throwError(
                                                "The option 'alwaysAllowDecimalCharacter' is invalid ; it should either be `true` or `false`, [".concat(
                                                    a.alwaysAllowDecimalCharacter,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.caretPositionOnFocus) ||
                                            h.isInArray(
                                                a.caretPositionOnFocus,
                                                [
                                                    e.options
                                                        .caretPositionOnFocus
                                                        .start,
                                                    e.options
                                                        .caretPositionOnFocus
                                                        .end,
                                                    e.options
                                                        .caretPositionOnFocus
                                                        .decimalLeft,
                                                    e.options
                                                        .caretPositionOnFocus
                                                        .decimalRight,
                                                ]
                                            ) ||
                                            h.throwError(
                                                "The display on empty string option 'caretPositionOnFocus' is invalid ; it should either be `null`, 'focus', 'press', 'always' or 'zero', [".concat(
                                                    a.caretPositionOnFocus,
                                                    "] given."
                                                )
                                            ),
                                        (o = r
                                            ? n
                                            : this._correctCaretPositionOnFocusAndSelectOnFocusOptions(
                                                  t
                                              )),
                                        h.isNull(o) ||
                                            o.caretPositionOnFocus ===
                                                e.options.caretPositionOnFocus
                                                    .doNoForceCaretPosition ||
                                            o.selectOnFocus !==
                                                e.options.selectOnFocus
                                                    .select ||
                                            h.warning(
                                                "The 'selectOnFocus' option is set to 'select', which is in conflict with the 'caretPositionOnFocus' which is set to '".concat(
                                                    o.caretPositionOnFocus,
                                                    "'. As a result, if this has been called when instantiating an AutoNumeric object, the 'selectOnFocus' option is forced to 'doNotSelect'."
                                                ),
                                                a.showWarnings
                                            ),
                                        h.isInArray(a.digitGroupSeparator, [
                                            e.options.digitGroupSeparator.comma,
                                            e.options.digitGroupSeparator.dot,
                                            e.options.digitGroupSeparator
                                                .normalSpace,
                                            e.options.digitGroupSeparator
                                                .thinSpace,
                                            e.options.digitGroupSeparator
                                                .narrowNoBreakSpace,
                                            e.options.digitGroupSeparator
                                                .noBreakSpace,
                                            e.options.digitGroupSeparator
                                                .noSeparator,
                                            e.options.digitGroupSeparator
                                                .apostrophe,
                                            e.options.digitGroupSeparator
                                                .arabicThousandsSeparator,
                                            e.options.digitGroupSeparator
                                                .dotAbove,
                                            e.options.digitGroupSeparator
                                                .privateUseTwo,
                                        ]) ||
                                            h.throwError(
                                                "The thousand separator character option 'digitGroupSeparator' is invalid ; it should be ',', '.', '٬', '˙', \"'\", '', ' ', ' ', ' ', ' ' or empty (''), [".concat(
                                                    a.digitGroupSeparator,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.showOnlyNumbersOnFocus
                                        ) ||
                                            h.isBoolean(
                                                a.showOnlyNumbersOnFocus
                                            ) ||
                                            h.throwError(
                                                "The 'showOnlyNumbersOnFocus' option is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.showOnlyNumbersOnFocus,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.digitalGroupSpacing, [
                                            e.options.digitalGroupSpacing.two,
                                            e.options.digitalGroupSpacing
                                                .twoScaled,
                                            e.options.digitalGroupSpacing.three,
                                            e.options.digitalGroupSpacing.four,
                                        ]) ||
                                            (a.digitalGroupSpacing >= 2 &&
                                                a.digitalGroupSpacing <= 4) ||
                                            h.throwError(
                                                "The grouping separator option for thousands 'digitalGroupSpacing' is invalid ; it should be '2', '2s', '3', or '4', [".concat(
                                                    a.digitalGroupSpacing,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.decimalCharacter, [
                                            e.options.decimalCharacter.comma,
                                            e.options.decimalCharacter.dot,
                                            e.options.decimalCharacter
                                                .middleDot,
                                            e.options.decimalCharacter
                                                .arabicDecimalSeparator,
                                            e.options.decimalCharacter
                                                .decimalSeparatorKeySymbol,
                                        ]) ||
                                            h.throwError(
                                                "The decimal separator character option 'decimalCharacter' is invalid ; it should be '.', ',', '·', '⎖' or '٫', [".concat(
                                                    a.decimalCharacter,
                                                    "] given."
                                                )
                                            ),
                                        a.decimalCharacter ===
                                            a.digitGroupSeparator &&
                                            h.throwError(
                                                "autoNumeric will not function properly when the decimal character 'decimalCharacter' ["
                                                    .concat(
                                                        a.decimalCharacter,
                                                        "] and the thousand separator 'digitGroupSeparator' ["
                                                    )
                                                    .concat(
                                                        a.digitGroupSeparator,
                                                        "] are the same character."
                                                    )
                                            ),
                                        h.isNull(
                                            a.decimalCharacterAlternative
                                        ) ||
                                            h.isString(
                                                a.decimalCharacterAlternative
                                            ) ||
                                            h.throwError(
                                                "The alternate decimal separator character option 'decimalCharacterAlternative' is invalid ; it should be a string, [".concat(
                                                    a.decimalCharacterAlternative,
                                                    "] given."
                                                )
                                            ),
                                        "" === a.currencySymbol ||
                                            h.isString(a.currencySymbol) ||
                                            h.throwError(
                                                "The currency symbol option 'currencySymbol' is invalid ; it should be a string, [".concat(
                                                    a.currencySymbol,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.currencySymbolPlacement, [
                                            e.options.currencySymbolPlacement
                                                .prefix,
                                            e.options.currencySymbolPlacement
                                                .suffix,
                                        ]) ||
                                            h.throwError(
                                                "The placement of the currency sign option 'currencySymbolPlacement' is invalid ; it should either be 'p' (prefix) or 's' (suffix), [".concat(
                                                    a.currencySymbolPlacement,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(
                                            a.negativePositiveSignPlacement,
                                            [
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .prefix,
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .suffix,
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .left,
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .right,
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .none,
                                            ]
                                        ) ||
                                            h.throwError(
                                                "The placement of the negative sign option 'negativePositiveSignPlacement' is invalid ; it should either be 'p' (prefix), 's' (suffix), 'l' (left), 'r' (right) or 'null', [".concat(
                                                    a.negativePositiveSignPlacement,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.showPositiveSign
                                        ) ||
                                            h.isBoolean(a.showPositiveSign) ||
                                            h.throwError(
                                                "The show positive sign option 'showPositiveSign' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.showPositiveSign,
                                                    "] given."
                                                )
                                            ),
                                        (!h.isString(a.suffixText) ||
                                            ("" !== a.suffixText &&
                                                (h.isNegative(
                                                    a.suffixText,
                                                    a.negativeSignCharacter
                                                ) ||
                                                    l.test(a.suffixText)))) &&
                                            h.throwError(
                                                "The additional suffix option 'suffixText' is invalid ; it should not contains the negative sign '"
                                                    .concat(
                                                        a.negativeSignCharacter,
                                                        "' nor any numerical characters, ["
                                                    )
                                                    .concat(
                                                        a.suffixText,
                                                        "] given."
                                                    )
                                            ),
                                        (!h.isString(a.negativeSignCharacter) ||
                                            1 !==
                                                a.negativeSignCharacter
                                                    .length ||
                                            h.isUndefinedOrNullOrEmpty(
                                                a.negativeSignCharacter
                                            ) ||
                                            l.test(a.negativeSignCharacter)) &&
                                            h.throwError(
                                                "The negative sign character option 'negativeSignCharacter' is invalid ; it should be a single character, and cannot be any numerical characters, [".concat(
                                                    a.negativeSignCharacter,
                                                    "] given."
                                                )
                                            ),
                                        (!h.isString(a.positiveSignCharacter) ||
                                            1 !==
                                                a.positiveSignCharacter
                                                    .length ||
                                            h.isUndefinedOrNullOrEmpty(
                                                a.positiveSignCharacter
                                            ) ||
                                            l.test(a.positiveSignCharacter)) &&
                                            h.throwError(
                                                "The positive sign character option 'positiveSignCharacter' is invalid ; it should be a single character, and cannot be any numerical characters, [".concat(
                                                    a.positiveSignCharacter,
                                                    "] given.\nIf you want to show the positive sign character, you need to set the `showPositiveSign` option to `true`."
                                                )
                                            ),
                                        a.negativeSignCharacter ===
                                            a.positiveSignCharacter &&
                                            h.throwError(
                                                "The positive 'positiveSignCharacter' and negative 'negativeSignCharacter' sign characters cannot be identical ; [".concat(
                                                    a.negativeSignCharacter,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.negativePositiveSignBehavior
                                        ) ||
                                            h.isBoolean(
                                                a.negativePositiveSignBehavior
                                            ) ||
                                            h.throwError(
                                                "The option 'negativePositiveSignBehavior' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.negativePositiveSignBehavior,
                                                    "] given."
                                                )
                                            );
                                    var m = F(
                                            h.isNull(
                                                a.negativeBracketsTypeOnBlur
                                            )
                                                ? ["", ""]
                                                : a.negativeBracketsTypeOnBlur.split(
                                                      ","
                                                  ),
                                            2
                                        ),
                                        g = m[0],
                                        d = m[1];
                                    (h.contains(
                                        a.digitGroupSeparator,
                                        a.negativeSignCharacter
                                    ) ||
                                        h.contains(
                                            a.decimalCharacter,
                                            a.negativeSignCharacter
                                        ) ||
                                        h.contains(
                                            a.decimalCharacterAlternative,
                                            a.negativeSignCharacter
                                        ) ||
                                        h.contains(
                                            g,
                                            a.negativeSignCharacter
                                        ) ||
                                        h.contains(
                                            d,
                                            a.negativeSignCharacter
                                        ) ||
                                        h.contains(
                                            a.suffixText,
                                            a.negativeSignCharacter
                                        )) &&
                                        h.throwError(
                                            "The negative sign character option 'negativeSignCharacter' is invalid ; it should not be equal or a part of the digit separator, the decimal character, the decimal character alternative, the negative brackets or the suffix text, [".concat(
                                                a.negativeSignCharacter,
                                                "] given."
                                            )
                                        ),
                                        (h.contains(
                                            a.digitGroupSeparator,
                                            a.positiveSignCharacter
                                        ) ||
                                            h.contains(
                                                a.decimalCharacter,
                                                a.positiveSignCharacter
                                            ) ||
                                            h.contains(
                                                a.decimalCharacterAlternative,
                                                a.positiveSignCharacter
                                            ) ||
                                            h.contains(
                                                g,
                                                a.positiveSignCharacter
                                            ) ||
                                            h.contains(
                                                d,
                                                a.positiveSignCharacter
                                            ) ||
                                            h.contains(
                                                a.suffixText,
                                                a.positiveSignCharacter
                                            )) &&
                                            h.throwError(
                                                "The positive sign character option 'positiveSignCharacter' is invalid ; it should not be equal or a part of the digit separator, the decimal character, the decimal character alternative, the negative brackets or the suffix text, [".concat(
                                                    a.positiveSignCharacter,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.overrideMinMaxLimits) ||
                                            h.isInArray(
                                                a.overrideMinMaxLimits,
                                                [
                                                    e.options
                                                        .overrideMinMaxLimits
                                                        .ceiling,
                                                    e.options
                                                        .overrideMinMaxLimits
                                                        .floor,
                                                    e.options
                                                        .overrideMinMaxLimits
                                                        .ignore,
                                                    e.options
                                                        .overrideMinMaxLimits
                                                        .invalid,
                                                ]
                                            ) ||
                                            h.throwError(
                                                "The override min & max limits option 'overrideMinMaxLimits' is invalid ; it should either be 'ceiling', 'floor', 'ignore' or 'invalid', [".concat(
                                                    a.overrideMinMaxLimits,
                                                    "] given."
                                                )
                                            ),
                                        a.overrideMinMaxLimits !==
                                            e.options.overrideMinMaxLimits
                                                .invalid &&
                                            a.overrideMinMaxLimits !==
                                                e.options.overrideMinMaxLimits
                                                    .ignore &&
                                            (a.minimumValue > 0 ||
                                                a.maximumValue < 0) &&
                                            h.warning(
                                                "You've set a `minimumValue` or a `maximumValue` excluding the value `0`. AutoNumeric will force the users to always have a valid value in the input, hence preventing them to clear the field. If you want to allow for temporary invalid values (i.e. out-of-range), you should use the 'invalid' option for the 'overrideMinMaxLimits' setting."
                                            ),
                                        (h.isString(a.maximumValue) &&
                                            u.test(a.maximumValue)) ||
                                            h.throwError(
                                                "The maximum possible value option 'maximumValue' is invalid ; it should be a string that represents a positive or negative number, [".concat(
                                                    a.maximumValue,
                                                    "] given."
                                                )
                                            ),
                                        (h.isString(a.minimumValue) &&
                                            u.test(a.minimumValue)) ||
                                            h.throwError(
                                                "The minimum possible value option 'minimumValue' is invalid ; it should be a string that represents a positive or negative number, [".concat(
                                                    a.minimumValue,
                                                    "] given."
                                                )
                                            ),
                                        parseFloat(a.minimumValue) >
                                            parseFloat(a.maximumValue) &&
                                            h.throwError(
                                                "The minimum possible value option is greater than the maximum possible value option ; 'minimumValue' ["
                                                    .concat(
                                                        a.minimumValue,
                                                        "] should be smaller than 'maximumValue' ["
                                                    )
                                                    .concat(
                                                        a.maximumValue,
                                                        "]."
                                                    )
                                            ),
                                        (h.isInt(a.decimalPlaces) &&
                                            a.decimalPlaces >= 0) ||
                                            (h.isString(a.decimalPlaces) &&
                                                s.test(a.decimalPlaces)) ||
                                            h.throwError(
                                                "The number of decimal places option 'decimalPlaces' is invalid ; it should be a positive integer, [".concat(
                                                    a.decimalPlaces,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.decimalPlacesRawValue) ||
                                            (h.isInt(a.decimalPlacesRawValue) &&
                                                a.decimalPlacesRawValue >= 0) ||
                                            (h.isString(
                                                a.decimalPlacesRawValue
                                            ) &&
                                                s.test(
                                                    a.decimalPlacesRawValue
                                                )) ||
                                            h.throwError(
                                                "The number of decimal places for the raw value option 'decimalPlacesRawValue' is invalid ; it should be a positive integer or `null`, [".concat(
                                                    a.decimalPlacesRawValue,
                                                    "] given."
                                                )
                                            ),
                                        this._validateDecimalPlacesRawValue(a),
                                        h.isNull(a.decimalPlacesShownOnFocus) ||
                                            s.test(
                                                String(
                                                    a.decimalPlacesShownOnFocus
                                                )
                                            ) ||
                                            h.throwError(
                                                "The number of expanded decimal places option 'decimalPlacesShownOnFocus' is invalid ; it should be a positive integer or `null`, [".concat(
                                                    a.decimalPlacesShownOnFocus,
                                                    "] given."
                                                )
                                            ),
                                        !h.isNull(
                                            a.decimalPlacesShownOnFocus
                                        ) &&
                                            Number(a.decimalPlaces) >
                                                Number(
                                                    a.decimalPlacesShownOnFocus
                                                ) &&
                                            h.warning(
                                                "The extended decimal places 'decimalPlacesShownOnFocus' ["
                                                    .concat(
                                                        a.decimalPlacesShownOnFocus,
                                                        "] should be greater than the 'decimalPlaces' ["
                                                    )
                                                    .concat(
                                                        a.decimalPlaces,
                                                        "] value. Currently, this will limit the ability of your user to manually change some of the decimal places. Do you really want to do that?"
                                                    ),
                                                a.showWarnings
                                            ),
                                        ((h.isNull(a.divisorWhenUnfocused) ||
                                            c.test(a.divisorWhenUnfocused)) &&
                                            0 !== a.divisorWhenUnfocused &&
                                            "0" !== a.divisorWhenUnfocused &&
                                            1 !== a.divisorWhenUnfocused &&
                                            "1" !== a.divisorWhenUnfocused) ||
                                            h.throwError(
                                                "The divisor option 'divisorWhenUnfocused' is invalid ; it should be a positive number higher than one, preferably an integer, [".concat(
                                                    a.divisorWhenUnfocused,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.decimalPlacesShownOnBlur) ||
                                            s.test(
                                                a.decimalPlacesShownOnBlur
                                            ) ||
                                            h.throwError(
                                                "The number of decimals shown when unfocused option 'decimalPlacesShownOnBlur' is invalid ; it should be a positive integer or `null`, [".concat(
                                                    a.decimalPlacesShownOnBlur,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.symbolWhenUnfocused) ||
                                            h.isString(a.symbolWhenUnfocused) ||
                                            h.throwError(
                                                "The symbol to show when unfocused option 'symbolWhenUnfocused' is invalid ; it should be a string, [".concat(
                                                    a.symbolWhenUnfocused,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.saveValueToSessionStorage
                                        ) ||
                                            h.isBoolean(
                                                a.saveValueToSessionStorage
                                            ) ||
                                            h.throwError(
                                                "The save to session storage option 'saveValueToSessionStorage' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.saveValueToSessionStorage,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.onInvalidPaste, [
                                            e.options.onInvalidPaste.error,
                                            e.options.onInvalidPaste.ignore,
                                            e.options.onInvalidPaste.clamp,
                                            e.options.onInvalidPaste.truncate,
                                            e.options.onInvalidPaste.replace,
                                        ]) ||
                                            h.throwError(
                                                "The paste behavior option 'onInvalidPaste' is invalid ; it should either be 'error', 'ignore', 'clamp', 'truncate' or 'replace' (cf. documentation), [".concat(
                                                    a.onInvalidPaste,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.roundingMethod, [
                                            e.options.roundingMethod
                                                .halfUpSymmetric,
                                            e.options.roundingMethod
                                                .halfUpAsymmetric,
                                            e.options.roundingMethod
                                                .halfDownSymmetric,
                                            e.options.roundingMethod
                                                .halfDownAsymmetric,
                                            e.options.roundingMethod
                                                .halfEvenBankersRounding,
                                            e.options.roundingMethod
                                                .upRoundAwayFromZero,
                                            e.options.roundingMethod
                                                .downRoundTowardZero,
                                            e.options.roundingMethod
                                                .toCeilingTowardPositiveInfinity,
                                            e.options.roundingMethod
                                                .toFloorTowardNegativeInfinity,
                                            e.options.roundingMethod
                                                .toNearest05,
                                            e.options.roundingMethod
                                                .toNearest05Alt,
                                            e.options.roundingMethod.upToNext05,
                                            e.options.roundingMethod
                                                .downToNext05,
                                        ]) ||
                                            h.throwError(
                                                "The rounding method option 'roundingMethod' is invalid ; it should either be 'S', 'A', 's', 'a', 'B', 'U', 'D', 'C', 'F', 'N05', 'CHF', 'U05' or 'D05' (cf. documentation), [".concat(
                                                    a.roundingMethod,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(
                                            a.negativeBracketsTypeOnBlur
                                        ) ||
                                            h.isInArray(
                                                a.negativeBracketsTypeOnBlur,
                                                [
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .parentheses,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .brackets,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .chevrons,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .curlyBraces,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .angleBrackets,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .japaneseQuotationMarks,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .halfBrackets,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .whiteSquareBrackets,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .quotationMarks,
                                                    e.options
                                                        .negativeBracketsTypeOnBlur
                                                        .guillemets,
                                                ]
                                            ) ||
                                            h.throwError(
                                                "The brackets for negative values option 'negativeBracketsTypeOnBlur' is invalid ; it should either be '(,)', '[,]', '<,>', '{,}', '〈,〉', '｢,｣', '⸤,⸥', '⟦,⟧', '‹,›' or '«,»', [".concat(
                                                    a.negativeBracketsTypeOnBlur,
                                                    "] given."
                                                )
                                            ),
                                        ((h.isString(a.emptyInputBehavior) ||
                                            h.isNumber(a.emptyInputBehavior)) &&
                                            (h.isInArray(a.emptyInputBehavior, [
                                                e.options.emptyInputBehavior
                                                    .focus,
                                                e.options.emptyInputBehavior
                                                    .press,
                                                e.options.emptyInputBehavior
                                                    .always,
                                                e.options.emptyInputBehavior
                                                    .min,
                                                e.options.emptyInputBehavior
                                                    .max,
                                                e.options.emptyInputBehavior
                                                    .zero,
                                                e.options.emptyInputBehavior
                                                    .null,
                                            ]) ||
                                                u.test(
                                                    a.emptyInputBehavior
                                                ))) ||
                                            h.throwError(
                                                "The display on empty string option 'emptyInputBehavior' is invalid ; it should either be 'focus', 'press', 'always', 'min', 'max', 'zero', 'null', a number, or a string that represents a number, [".concat(
                                                    a.emptyInputBehavior,
                                                    "] given."
                                                )
                                            ),
                                        a.emptyInputBehavior ===
                                            e.options.emptyInputBehavior.zero &&
                                            (a.minimumValue > 0 ||
                                                a.maximumValue < 0) &&
                                            h.throwError(
                                                "The 'emptyInputBehavior' option is set to 'zero', but this value is outside of the range defined by 'minimumValue' and 'maximumValue' ["
                                                    .concat(
                                                        a.minimumValue,
                                                        ", "
                                                    )
                                                    .concat(
                                                        a.maximumValue,
                                                        "]."
                                                    )
                                            ),
                                        u.test(String(a.emptyInputBehavior)) &&
                                            (this._isWithinRangeWithOverrideOption(
                                                a.emptyInputBehavior,
                                                a
                                            ) ||
                                                h.throwError(
                                                    "The 'emptyInputBehavior' option is set to a number or a string that represents a number, but its value ["
                                                        .concat(
                                                            a.emptyInputBehavior,
                                                            "] is outside of the range defined by the 'minimumValue' and 'maximumValue' options ["
                                                        )
                                                        .concat(
                                                            a.minimumValue,
                                                            ", "
                                                        )
                                                        .concat(
                                                            a.maximumValue,
                                                            "]."
                                                        )
                                                )),
                                        h.isTrueOrFalseString(a.eventBubbles) ||
                                            h.isBoolean(a.eventBubbles) ||
                                            h.throwError(
                                                "The event bubbles option 'eventBubbles' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.eventBubbles,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.eventIsCancelable
                                        ) ||
                                            h.isBoolean(a.eventIsCancelable) ||
                                            h.throwError(
                                                "The event is cancelable option 'eventIsCancelable' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.eventIsCancelable,
                                                    "] given."
                                                )
                                            ),
                                        (!h.isBoolean(a.invalidClass) &&
                                            /^-?[_a-zA-Z]+[_a-zA-Z0-9-]*$/.test(
                                                a.invalidClass
                                            )) ||
                                            h.throwError(
                                                "The name of the 'invalidClass' option is not a valid CSS class name ; it should not be empty, and should follow the '^-?[_a-zA-Z]+[_a-zA-Z0-9-]*$' regex, [".concat(
                                                    a.invalidClass,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.leadingZero, [
                                            e.options.leadingZero.allow,
                                            e.options.leadingZero.deny,
                                            e.options.leadingZero.keep,
                                        ]) ||
                                            h.throwError(
                                                "The leading zero behavior option 'leadingZero' is invalid ; it should either be 'allow', 'deny' or 'keep', [".concat(
                                                    a.leadingZero,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.formatOnPageLoad
                                        ) ||
                                            h.isBoolean(a.formatOnPageLoad) ||
                                            h.throwError(
                                                "The format on initialization option 'formatOnPageLoad' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.formatOnPageLoad,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(a.formulaMode) ||
                                            h.isBoolean(a.formulaMode) ||
                                            h.throwError(
                                                "The formula mode option 'formulaMode' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.formulaMode,
                                                    "] given."
                                                )
                                            ),
                                        (s.test(a.historySize) &&
                                            0 !== a.historySize) ||
                                            h.throwError(
                                                "The history size option 'historySize' is invalid ; it should be a positive integer, [".concat(
                                                    a.historySize,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.selectNumberOnly
                                        ) ||
                                            h.isBoolean(a.selectNumberOnly) ||
                                            h.throwError(
                                                "The select number only option 'selectNumberOnly' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.selectNumberOnly,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.selectOnFocus
                                        ) ||
                                            h.isBoolean(a.selectOnFocus) ||
                                            h.throwError(
                                                "The select on focus option 'selectOnFocus' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.selectOnFocus,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.defaultValueOverride) ||
                                            "" === a.defaultValueOverride ||
                                            u.test(a.defaultValueOverride) ||
                                            h.throwError(
                                                "The unformatted default value option 'defaultValueOverride' is invalid ; it should be a string that represents a positive or negative number, [".concat(
                                                    a.defaultValueOverride,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.unformatOnSubmit
                                        ) ||
                                            h.isBoolean(a.unformatOnSubmit) ||
                                            h.throwError(
                                                "The remove formatting on submit option 'unformatOnSubmit' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.unformatOnSubmit,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.valuesToStrings) ||
                                            h.isObject(a.valuesToStrings) ||
                                            h.throwError(
                                                "The option 'valuesToStrings' is invalid ; it should be an object, ideally with 'key -> value' entries, [".concat(
                                                    a.valuesToStrings,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.outputFormat) ||
                                            h.isInArray(a.outputFormat, [
                                                e.options.outputFormat.string,
                                                e.options.outputFormat.number,
                                                e.options.outputFormat.dot,
                                                e.options.outputFormat
                                                    .negativeDot,
                                                e.options.outputFormat.comma,
                                                e.options.outputFormat
                                                    .negativeComma,
                                                e.options.outputFormat
                                                    .dotNegative,
                                                e.options.outputFormat
                                                    .commaNegative,
                                            ]) ||
                                            h.throwError(
                                                "The custom locale format option 'outputFormat' is invalid ; it should either be null, 'string', 'number', '.', '-.', ',', '-,', '.-' or ',-', [".concat(
                                                    a.outputFormat,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.isCancellable
                                        ) ||
                                            h.isBoolean(a.isCancellable) ||
                                            h.throwError(
                                                "The cancellable behavior option 'isCancellable' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.isCancellable,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.modifyValueOnUpDownArrow
                                        ) ||
                                            h.isBoolean(
                                                a.modifyValueOnUpDownArrow
                                            ) ||
                                            h.throwError(
                                                "The increment/decrement on up and down arrow keys 'modifyValueOnUpDownArrow' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.modifyValueOnUpDownArrow,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.modifyValueOnWheel
                                        ) ||
                                            h.isBoolean(a.modifyValueOnWheel) ||
                                            h.throwError(
                                                "The increment/decrement on mouse wheel option 'modifyValueOnWheel' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.modifyValueOnWheel,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.watchExternalChanges
                                        ) ||
                                            h.isBoolean(
                                                a.watchExternalChanges
                                            ) ||
                                            h.throwError(
                                                "The option 'watchExternalChanges' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.watchExternalChanges,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.wheelOn, [
                                            e.options.wheelOn.focus,
                                            e.options.wheelOn.hover,
                                        ]) ||
                                            h.throwError(
                                                "The wheel behavior option 'wheelOn' is invalid ; it should either be 'focus' or 'hover', [".concat(
                                                    a.wheelOn,
                                                    "] given."
                                                )
                                            ),
                                        ((!h.isString(a.upDownStep) &&
                                            !h.isNumber(a.upDownStep)) ||
                                            ("progressive" !== a.upDownStep &&
                                                !c.test(a.upDownStep)) ||
                                            0 === Number(a.upDownStep)) &&
                                            h.throwError(
                                                "The up/down arrow step value option 'upDownStep' is invalid ; it should either be the string 'progressive', or a number or a string that represents a positive number (excluding zero), [".concat(
                                                    a.upDownStep,
                                                    "] given."
                                                )
                                            ),
                                        ((!h.isString(a.wheelStep) &&
                                            !h.isNumber(a.wheelStep)) ||
                                            ("progressive" !== a.wheelStep &&
                                                !c.test(a.wheelStep)) ||
                                            0 === Number(a.wheelStep)) &&
                                            h.throwError(
                                                "The wheel step value option 'wheelStep' is invalid ; it should either be the string 'progressive', or a number or a string that represents a positive number (excluding zero), [".concat(
                                                    a.wheelStep,
                                                    "] given."
                                                )
                                            ),
                                        h.isInArray(a.serializeSpaces, [
                                            e.options.serializeSpaces.plus,
                                            e.options.serializeSpaces.percent,
                                        ]) ||
                                            h.throwError(
                                                "The space replacement character option 'serializeSpaces' is invalid ; it should either be '+' or '%20', [".concat(
                                                    a.serializeSpaces,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.noEventListeners
                                        ) ||
                                            h.isBoolean(a.noEventListeners) ||
                                            h.throwError(
                                                "The option 'noEventListeners' that prevent the creation of event listeners is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.noEventListeners,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.styleRules) ||
                                            (h.isObject(a.styleRules) &&
                                                (Object.prototype.hasOwnProperty.call(
                                                    a.styleRules,
                                                    "positive"
                                                ) ||
                                                    Object.prototype.hasOwnProperty.call(
                                                        a.styleRules,
                                                        "negative"
                                                    ) ||
                                                    Object.prototype.hasOwnProperty.call(
                                                        a.styleRules,
                                                        "ranges"
                                                    ) ||
                                                    Object.prototype.hasOwnProperty.call(
                                                        a.styleRules,
                                                        "userDefined"
                                                    ))) ||
                                            h.throwError(
                                                "The option 'styleRules' is invalid ; it should be a correctly structured object, with one or more 'positive', 'negative', 'ranges' or 'userDefined' attributes, [".concat(
                                                    a.styleRules,
                                                    "] given."
                                                )
                                            ),
                                        h.isNull(a.styleRules) ||
                                            !Object.prototype.hasOwnProperty.call(
                                                a.styleRules,
                                                "userDefined"
                                            ) ||
                                            h.isNull(
                                                a.styleRules.userDefined
                                            ) ||
                                            a.styleRules.userDefined.forEach(
                                                function (e) {
                                                    Object.prototype.hasOwnProperty.call(
                                                        e,
                                                        "callback"
                                                    ) &&
                                                        !h.isFunction(
                                                            e.callback
                                                        ) &&
                                                        h.throwError(
                                                            "The callback defined in the `userDefined` attribute is not a function, ".concat(
                                                                A(e.callback),
                                                                " given."
                                                            )
                                                        );
                                                }
                                            ),
                                        ((h.isNull(a.rawValueDivisor) ||
                                            c.test(a.rawValueDivisor)) &&
                                            0 !== a.rawValueDivisor &&
                                            "0" !== a.rawValueDivisor &&
                                            1 !== a.rawValueDivisor &&
                                            "1" !== a.rawValueDivisor) ||
                                            h.throwError(
                                                "The raw value divisor option 'rawValueDivisor' is invalid ; it should be a positive number higher than one, preferably an integer, [".concat(
                                                    a.rawValueDivisor,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(a.readOnly) ||
                                            h.isBoolean(a.readOnly) ||
                                            h.throwError(
                                                "The option 'readOnly' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.readOnly,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.unformatOnHover
                                        ) ||
                                            h.isBoolean(a.unformatOnHover) ||
                                            h.throwError(
                                                "The option 'unformatOnHover' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.unformatOnHover,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.failOnUnknownOption
                                        ) ||
                                            h.isBoolean(
                                                a.failOnUnknownOption
                                            ) ||
                                            h.throwError(
                                                "The debug option 'failOnUnknownOption' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.failOnUnknownOption,
                                                    "] given."
                                                )
                                            ),
                                        h.isTrueOrFalseString(
                                            a.createLocalList
                                        ) ||
                                            h.isBoolean(a.createLocalList) ||
                                            h.throwError(
                                                "The debug option 'createLocalList' is invalid ; it should be either 'true' or 'false', [".concat(
                                                    a.createLocalList,
                                                    "] given."
                                                )
                                            );
                                },
                            },
                            {
                                key: "_validateDecimalPlacesRawValue",
                                value: function (e) {
                                    h.isNull(e.decimalPlacesRawValue) ||
                                        (e.decimalPlacesRawValue <
                                            e.decimalPlaces &&
                                            h.warning(
                                                "The number of decimal places to store in the raw value ["
                                                    .concat(
                                                        e.decimalPlacesRawValue,
                                                        "] is lower than the ones to display ["
                                                    )
                                                    .concat(
                                                        e.decimalPlaces,
                                                        "]. This will likely confuse your users.\nTo solve that, you'd need to either set `decimalPlacesRawValue` to `null`, or set a number of decimal places for the raw value equal of bigger than `decimalPlaces`."
                                                    ),
                                                e.showWarnings
                                            ),
                                        e.decimalPlacesRawValue <
                                            e.decimalPlacesShownOnFocus &&
                                            h.warning(
                                                "The number of decimal places to store in the raw value ["
                                                    .concat(
                                                        e.decimalPlacesRawValue,
                                                        "] is lower than the ones shown on focus ["
                                                    )
                                                    .concat(
                                                        e.decimalPlacesShownOnFocus,
                                                        "]. This will likely confuse your users.\nTo solve that, you'd need to either set `decimalPlacesRawValue` to `null`, or set a number of decimal places for the raw value equal of bigger than `decimalPlacesShownOnFocus`."
                                                    ),
                                                e.showWarnings
                                            ),
                                        e.decimalPlacesRawValue <
                                            e.decimalPlacesShownOnBlur &&
                                            h.warning(
                                                "The number of decimal places to store in the raw value ["
                                                    .concat(
                                                        e.decimalPlacesRawValue,
                                                        "] is lower than the ones shown when unfocused ["
                                                    )
                                                    .concat(
                                                        e.decimalPlacesShownOnBlur,
                                                        "]. This will likely confuse your users.\nTo solve that, you'd need to either set `decimalPlacesRawValue` to `null`, or set a number of decimal places for the raw value equal of bigger than `decimalPlacesShownOnBlur`."
                                                    ),
                                                e.showWarnings
                                            ));
                                },
                            },
                            {
                                key: "areSettingsValid",
                                value: function (e) {
                                    var t = !0;
                                    try {
                                        this.validate(e, !0);
                                    } catch (i) {
                                        t = !1;
                                    }
                                    return t;
                                },
                            },
                            {
                                key: "getDefaultConfig",
                                value: function () {
                                    return e.defaultSettings;
                                },
                            },
                            {
                                key: "getPredefinedOptions",
                                value: function () {
                                    return e.predefinedOptions;
                                },
                            },
                            {
                                key: "_generateOptionsObjectFromOptionsArray",
                                value: function (e) {
                                    var t,
                                        i = this;
                                    return (
                                        h.isUndefinedOrNullOrEmpty(e) ||
                                        0 === e.length
                                            ? (t = null)
                                            : ((t = {}),
                                              1 === e.length &&
                                              Array.isArray(e[0])
                                                  ? e[0].forEach(function (e) {
                                                        T(
                                                            t,
                                                            i._getOptionObject(
                                                                e
                                                            )
                                                        );
                                                    })
                                                  : e.length >= 1 &&
                                                    e.forEach(function (e) {
                                                        T(
                                                            t,
                                                            i._getOptionObject(
                                                                e
                                                            )
                                                        );
                                                    })),
                                        t
                                    );
                                },
                            },
                            {
                                key: "format",
                                value: function (t) {
                                    if (h.isUndefined(t) || null === t)
                                        return null;
                                    var i;
                                    (i = h.isElement(t)
                                        ? h.getElementValue(t)
                                        : t),
                                        h.isString(i) ||
                                            h.isNumber(i) ||
                                            h.throwError(
                                                'The value "'.concat(
                                                    i,
                                                    '" being "set" is not numeric and therefore cannot be used appropriately.'
                                                )
                                            );
                                    for (
                                        var n = arguments.length,
                                            a = new Array(n > 1 ? n - 1 : 0),
                                            r = 1;
                                        r < n;
                                        r++
                                    )
                                        a[r - 1] = arguments[r];
                                    var o =
                                            this._generateOptionsObjectFromOptionsArray(
                                                a
                                            ),
                                        s = T({}, this.getDefaultConfig(), o);
                                    (s.isNegativeSignAllowed = i < 0),
                                        (s.isPositiveSignAllowed = i >= 0),
                                        this._setBrackets(s),
                                        this._cachesUsualRegularExpressions(
                                            s,
                                            {}
                                        );
                                    var l = this._toNumericValue(i, s);
                                    return (
                                        isNaN(Number(l)) &&
                                            h.throwError(
                                                "The value [".concat(
                                                    l,
                                                    "] that you are trying to format is not a recognized number."
                                                )
                                            ),
                                        this._isWithinRangeWithOverrideOption(
                                            l,
                                            s
                                        ) ||
                                            (h.triggerEvent(
                                                e.events.formatted,
                                                document,
                                                {
                                                    oldValue: null,
                                                    newValue: null,
                                                    oldRawValue: null,
                                                    newRawValue: null,
                                                    isPristine: null,
                                                    error: "Range test failed",
                                                    aNElement: null,
                                                },
                                                !0,
                                                !0
                                            ),
                                            h.throwError(
                                                "The value ["
                                                    .concat(
                                                        l,
                                                        "] being set falls outside of the minimumValue ["
                                                    )
                                                    .concat(
                                                        s.minimumValue,
                                                        "] and maximumValue ["
                                                    )
                                                    .concat(
                                                        s.maximumValue,
                                                        "] range set for this element"
                                                    )
                                            )),
                                        s.valuesToStrings &&
                                        this._checkValuesToStringsSettings(i, s)
                                            ? s.valuesToStrings[i]
                                            : (this._correctNegativePositiveSignPlacementOption(
                                                  s
                                              ),
                                              this._calculateDecimalPlacesOnInit(
                                                  s
                                              ),
                                              h.isUndefinedOrNullOrEmpty(
                                                  s.rawValueDivisor
                                              ) ||
                                                  0 === s.rawValueDivisor ||
                                                  "" === l ||
                                                  null === l ||
                                                  (l *= s.rawValueDivisor),
                                              (l =
                                                  this._roundFormattedValueShownOnFocus(
                                                      l,
                                                      s
                                                  )),
                                              (l =
                                                  this._modifyNegativeSignAndDecimalCharacterForFormattedValue(
                                                      l,
                                                      s
                                                  )),
                                              (l = this._addGroupSeparators(
                                                  l,
                                                  s,
                                                  !1,
                                                  l
                                              )))
                                    );
                                },
                            },
                            {
                                key: "formatAndSet",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null,
                                        i = this.format(e, t);
                                    return h.setElementValue(e, i), i;
                                },
                            },
                            {
                                key: "unformat",
                                value: function (e) {
                                    if (h.isNumberStrict(e)) return e;
                                    var t;
                                    if (
                                        "" ===
                                        (t = h.isElement(e)
                                            ? h.getElementValue(e)
                                            : e)
                                    )
                                        return "";
                                    if (h.isUndefined(t) || null === t)
                                        return null;
                                    (h.isArray(t) || h.isObject(t)) &&
                                        h.throwError(
                                            "A number or a string representing a number is needed to be able to unformat it, [".concat(
                                                t,
                                                "] given."
                                            )
                                        );
                                    for (
                                        var i = arguments.length,
                                            n = new Array(i > 1 ? i - 1 : 0),
                                            a = 1;
                                        a < i;
                                        a++
                                    )
                                        n[a - 1] = arguments[a];
                                    var r =
                                            this._generateOptionsObjectFromOptionsArray(
                                                n
                                            ),
                                        o = T({}, this.getDefaultConfig(), r);
                                    if (
                                        ((o.isNegativeSignAllowed = !1),
                                        (o.isPositiveSignAllowed = !0),
                                        (t = t.toString()),
                                        o.valuesToStrings &&
                                            this._checkStringsToValuesSettings(
                                                t,
                                                o
                                            ))
                                    )
                                        return h.objectKeyLookup(
                                            o.valuesToStrings,
                                            t
                                        );
                                    if (
                                        h.isNegative(t, o.negativeSignCharacter)
                                    )
                                        (o.isNegativeSignAllowed = !0),
                                            (o.isPositiveSignAllowed = !1);
                                    else if (
                                        !h.isNull(o.negativeBracketsTypeOnBlur)
                                    ) {
                                        var s = F(
                                            o.negativeBracketsTypeOnBlur.split(
                                                ","
                                            ),
                                            2
                                        );
                                        (o.firstBracket = s[0]),
                                            (o.lastBracket = s[1]),
                                            t.charAt(0) === o.firstBracket &&
                                                t.charAt(t.length - 1) ===
                                                    o.lastBracket &&
                                                ((o.isNegativeSignAllowed = !0),
                                                (o.isPositiveSignAllowed = !1),
                                                (t = this._removeBrackets(
                                                    t,
                                                    o,
                                                    !1
                                                )));
                                    }
                                    return (
                                        (t = this._convertToNumericString(
                                            t,
                                            o
                                        )),
                                        h.isNumber(Number(t)) &&
                                            (t = h.scientificToDecimal(t)),
                                        new RegExp(
                                            "[^+-0123456789.]",
                                            "gi"
                                        ).test(t)
                                            ? NaN
                                            : (this._correctNegativePositiveSignPlacementOption(
                                                  o
                                              ),
                                              o.decimalPlacesRawValue
                                                  ? (o.originalDecimalPlacesRawValue =
                                                        o.decimalPlacesRawValue)
                                                  : (o.originalDecimalPlacesRawValue =
                                                        o.decimalPlaces),
                                              this._calculateDecimalPlacesOnInit(
                                                  o
                                              ),
                                              h.isUndefinedOrNullOrEmpty(
                                                  o.rawValueDivisor
                                              ) ||
                                                  0 === o.rawValueDivisor ||
                                                  "" === t ||
                                                  null === t ||
                                                  (t /= o.rawValueDivisor),
                                              (t = (t = this._roundRawValue(
                                                  t,
                                                  o
                                              )).replace(
                                                  o.decimalCharacter,
                                                  "."
                                              )),
                                              (t = this._toLocale(
                                                  t,
                                                  o.outputFormat,
                                                  o
                                              )))
                                    );
                                },
                            },
                            {
                                key: "unformatAndSet",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null,
                                        i = this.unformat(e, t);
                                    return h.setElementValue(e, i), i;
                                },
                            },
                            {
                                key: "localize",
                                value: function (t) {
                                    var i,
                                        n,
                                        a =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null;
                                    return "" ===
                                        (i = h.isElement(t)
                                            ? h.getElementValue(t)
                                            : t)
                                        ? ""
                                        : (h.isNull(a) &&
                                              (a = e.defaultSettings),
                                          (i = this.unformat(i, a)),
                                          0 === Number(i) &&
                                              a.leadingZero !==
                                                  e.options.leadingZero.keep &&
                                              (i = "0"),
                                          (n = h.isNull(a)
                                              ? a.outputFormat
                                              : e.defaultSettings.outputFormat),
                                          this._toLocale(i, n, a));
                                },
                            },
                            {
                                key: "localizeAndSet",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null,
                                        i = this.localize(e, t);
                                    return h.setElementValue(e, i), i;
                                },
                            },
                            {
                                key: "isManagedByAutoNumeric",
                                value: function (e) {
                                    return this._isInGlobalList(
                                        h.domElement(e)
                                    );
                                },
                            },
                            {
                                key: "getAutoNumericElement",
                                value: function (e) {
                                    var t = h.domElement(e);
                                    return this.isManagedByAutoNumeric(t)
                                        ? this._getFromGlobalList(t)
                                        : null;
                                },
                            },
                            {
                                key: "set",
                                value: function (e, t) {
                                    var i,
                                        n =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null,
                                        a =
                                            !(
                                                arguments.length > 3 &&
                                                void 0 !== arguments[3]
                                            ) || arguments[3],
                                        r = h.domElement(e);
                                    return this.isManagedByAutoNumeric(r)
                                        ? this.getAutoNumericElement(r).set(
                                              t,
                                              n,
                                              a
                                          )
                                        : ((i =
                                              !(
                                                  !h.isNull(n) &&
                                                  Object.prototype.hasOwnProperty.call(
                                                      n,
                                                      "showWarnings"
                                                  )
                                              ) || n.showWarnings),
                                          h.warning(
                                              "Impossible to find an AutoNumeric object for the given DOM element or selector.",
                                              i
                                          ),
                                          null);
                                },
                            },
                            {
                                key: "getNumericString",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return this._get(e, "getNumericString", t);
                                },
                            },
                            {
                                key: "getFormatted",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return this._get(e, "getFormatted", t);
                                },
                            },
                            {
                                key: "getNumber",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    return this._get(e, "getNumber", t);
                                },
                            },
                            {
                                key: "_get",
                                value: function (e, t) {
                                    var i =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null,
                                        n = h.domElement(e);
                                    return (
                                        this.isManagedByAutoNumeric(n) ||
                                            h.throwError(
                                                "Impossible to find an AutoNumeric object for the given DOM element or selector."
                                            ),
                                        this.getAutoNumericElement(n)[t](i)
                                    );
                                },
                            },
                            {
                                key: "getLocalized",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : null,
                                        i =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null,
                                        n = h.domElement(e);
                                    return (
                                        this.isManagedByAutoNumeric(n) ||
                                            h.throwError(
                                                "Impossible to find an AutoNumeric object for the given DOM element or selector."
                                            ),
                                        this.getAutoNumericElement(
                                            n
                                        ).getLocalized(t, i)
                                    );
                                },
                            },
                            {
                                key: "_stripAllNonNumberCharacters",
                                value: function (e, t, i, n) {
                                    return this._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                        e,
                                        t,
                                        i,
                                        n
                                    ).replace(t.decimalCharacter, ".");
                                },
                            },
                            {
                                key: "_stripAllNonNumberCharactersExceptCustomDecimalChar",
                                value: function (t, i, n, a) {
                                    var r = (t = (t =
                                        this._normalizeCurrencySuffixAndNegativeSignCharacters(
                                            t,
                                            i
                                        )).replace(
                                        i.allowedAutoStrip,
                                        ""
                                    )).match(i.numRegAutoStrip);
                                    if (
                                        ((t = r
                                            ? [r[1], r[2], r[3]].join("")
                                            : ""),
                                        i.leadingZero ===
                                            e.options.leadingZero.allow ||
                                            i.leadingZero ===
                                                e.options.leadingZero.keep)
                                    ) {
                                        var o = "",
                                            s = F(
                                                t.split(i.decimalCharacter),
                                                2
                                            ),
                                            l = s[0],
                                            u = s[1],
                                            c = l;
                                        h.contains(
                                            c,
                                            i.negativeSignCharacter
                                        ) &&
                                            ((o = i.negativeSignCharacter),
                                            (c = c.replace(
                                                i.negativeSignCharacter,
                                                ""
                                            ))),
                                            "" === o &&
                                                c.length > i.mIntPos &&
                                                "0" === c.charAt(0) &&
                                                (c = c.slice(1)),
                                            "" !== o &&
                                                c.length > i.mIntNeg &&
                                                "0" === c.charAt(0) &&
                                                (c = c.slice(1)),
                                            (t = ""
                                                .concat(o)
                                                .concat(c)
                                                .concat(
                                                    h.isUndefined(u)
                                                        ? ""
                                                        : i.decimalCharacter + u
                                                ));
                                    }
                                    return (
                                        ((n &&
                                            i.leadingZero ===
                                                e.options.leadingZero.deny) ||
                                            (!a &&
                                                i.leadingZero ===
                                                    e.options.leadingZero
                                                        .allow)) &&
                                            (t = t.replace(i.stripReg, "$1$2")),
                                        t
                                    );
                                },
                            },
                            {
                                key: "_toggleNegativeBracket",
                                value: function (e, t, i) {
                                    return i
                                        ? this._removeBrackets(e, t)
                                        : this._addBrackets(e, t);
                                },
                            },
                            {
                                key: "_addBrackets",
                                value: function (e, t) {
                                    return h.isNull(
                                        t.negativeBracketsTypeOnBlur
                                    )
                                        ? e
                                        : ""
                                              .concat(t.firstBracket)
                                              .concat(
                                                  e.replace(
                                                      t.negativeSignCharacter,
                                                      ""
                                                  )
                                              )
                                              .concat(t.lastBracket);
                                },
                            },
                            {
                                key: "_removeBrackets",
                                value: function (e, t) {
                                    var i,
                                        n =
                                            !(
                                                arguments.length > 2 &&
                                                void 0 !== arguments[2]
                                            ) || arguments[2];
                                    return (
                                        h.isNull(
                                            t.negativeBracketsTypeOnBlur
                                        ) || e.charAt(0) !== t.firstBracket
                                            ? (i = e)
                                            : ((i = (i = e.replace(
                                                  t.firstBracket,
                                                  ""
                                              )).replace(t.lastBracket, "")),
                                              n
                                                  ? ((i = i.replace(
                                                        t.currencySymbol,
                                                        ""
                                                    )),
                                                    (i =
                                                        this._mergeCurrencySignNegativePositiveSignAndValue(
                                                            i,
                                                            t,
                                                            !0,
                                                            !1
                                                        )))
                                                  : (i = ""
                                                        .concat(
                                                            t.negativeSignCharacter
                                                        )
                                                        .concat(i))),
                                        i
                                    );
                                },
                            },
                            {
                                key: "_setBrackets",
                                value: function (e) {
                                    if (h.isNull(e.negativeBracketsTypeOnBlur))
                                        (e.firstBracket = ""),
                                            (e.lastBracket = "");
                                    else {
                                        var t = F(
                                                e.negativeBracketsTypeOnBlur.split(
                                                    ","
                                                ),
                                                2
                                            ),
                                            i = t[0],
                                            n = t[1];
                                        (e.firstBracket = i),
                                            (e.lastBracket = n);
                                    }
                                },
                            },
                            {
                                key: "_convertToNumericString",
                                value: function (t, i) {
                                    (t = this._removeBrackets(t, i, !1)),
                                        (t = (t =
                                            this._normalizeCurrencySuffixAndNegativeSignCharacters(
                                                t,
                                                i
                                            )).replace(
                                            new RegExp(
                                                "[".concat(
                                                    i.digitGroupSeparator,
                                                    "]"
                                                ),
                                                "g"
                                            ),
                                            ""
                                        )),
                                        "." !== i.decimalCharacter &&
                                            (t = t.replace(
                                                i.decimalCharacter,
                                                "."
                                            )),
                                        h.isNegative(t) &&
                                            t.lastIndexOf("-") ===
                                                t.length - 1 &&
                                            ((t = t.replace("-", "")),
                                            (t = "-".concat(t))),
                                        i.showPositiveSign &&
                                            (t = t.replace(
                                                i.positiveSignCharacter,
                                                ""
                                            ));
                                    var n =
                                            i.leadingZero !==
                                            e.options.leadingZero.keep,
                                        a = h.arabicToLatinNumbers(
                                            t,
                                            n,
                                            !1,
                                            !1
                                        );
                                    return isNaN(a) || (t = a.toString()), t;
                                },
                            },
                            {
                                key: "_normalizeCurrencySuffixAndNegativeSignCharacters",
                                value: function (t, i) {
                                    return (
                                        (t = String(t)),
                                        i.currencySymbol !==
                                            e.options.currencySymbol.none &&
                                            (t = t.replace(
                                                i.currencySymbol,
                                                ""
                                            )),
                                        i.suffixText !==
                                            e.options.suffixText.none &&
                                            (t = t.replace(i.suffixText, "")),
                                        i.negativeSignCharacter !==
                                            e.options.negativeSignCharacter
                                                .hyphen &&
                                            (t = t.replace(
                                                i.negativeSignCharacter,
                                                "-"
                                            )),
                                        t
                                    );
                                },
                            },
                            {
                                key: "_toLocale",
                                value: function (t, i, n) {
                                    if (
                                        h.isNull(i) ||
                                        i === e.options.outputFormat.string
                                    )
                                        return t;
                                    var a;
                                    switch (i) {
                                        case e.options.outputFormat.number:
                                            a = Number(t);
                                            break;
                                        case e.options.outputFormat.dotNegative:
                                            a = h.isNegative(t)
                                                ? t.replace("-", "") + "-"
                                                : t;
                                            break;
                                        case e.options.outputFormat.comma:
                                        case e.options.outputFormat
                                            .negativeComma:
                                            a = t.replace(".", ",");
                                            break;
                                        case e.options.outputFormat
                                            .commaNegative:
                                            (a = t.replace(".", ",")),
                                                (a = h.isNegative(a)
                                                    ? a.replace("-", "") + "-"
                                                    : a);
                                            break;
                                        case e.options.outputFormat.dot:
                                        case e.options.outputFormat.negativeDot:
                                            a = t;
                                            break;
                                        default:
                                            h.throwError(
                                                "The given outputFormat [".concat(
                                                    i,
                                                    "] option is not recognized."
                                                )
                                            );
                                    }
                                    return (
                                        i !== e.options.outputFormat.number &&
                                            "-" !== n.negativeSignCharacter &&
                                            (a = a.replace(
                                                "-",
                                                n.negativeSignCharacter
                                            )),
                                        a
                                    );
                                },
                            },
                            {
                                key: "_modifyNegativeSignAndDecimalCharacterForFormattedValue",
                                value: function (e, t) {
                                    return (
                                        "-" !== t.negativeSignCharacter &&
                                            (e = e.replace(
                                                "-",
                                                t.negativeSignCharacter
                                            )),
                                        "." !== t.decimalCharacter &&
                                            (e = e.replace(
                                                ".",
                                                t.decimalCharacter
                                            )),
                                        e
                                    );
                                },
                            },
                            {
                                key: "_isElementValueEmptyOrOnlyTheNegativeSign",
                                value: function (e, t) {
                                    return (
                                        "" === e ||
                                        e === t.negativeSignCharacter
                                    );
                                },
                            },
                            {
                                key: "_orderValueCurrencySymbolAndSuffixText",
                                value: function (t, i, n) {
                                    var a;
                                    if (
                                        i.emptyInputBehavior ===
                                            e.options.emptyInputBehavior
                                                .always ||
                                        n
                                    )
                                        switch (
                                            i.negativePositiveSignPlacement
                                        ) {
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .left:
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .prefix:
                                            case e.options
                                                .negativePositiveSignPlacement
                                                .none:
                                                a =
                                                    t +
                                                    i.currencySymbol +
                                                    i.suffixText;
                                                break;
                                            default:
                                                a =
                                                    i.currencySymbol +
                                                    t +
                                                    i.suffixText;
                                        }
                                    else a = t;
                                    return a;
                                },
                            },
                            {
                                key: "_addGroupSeparators",
                                value: function (t, i, n, a) {
                                    var r,
                                        o =
                                            arguments.length > 4 &&
                                            void 0 !== arguments[4]
                                                ? arguments[4]
                                                : null;
                                    if (
                                        ((r = h.isNull(o)
                                            ? h.isNegative(
                                                  t,
                                                  i.negativeSignCharacter
                                              ) ||
                                              h.isNegativeWithBrackets(
                                                  t,
                                                  i.firstBracket,
                                                  i.lastBracket
                                              )
                                            : o < 0),
                                        (t =
                                            this._stripAllNonNumberCharactersExceptCustomDecimalChar(
                                                t,
                                                i,
                                                !1,
                                                n
                                            )),
                                        this._isElementValueEmptyOrOnlyTheNegativeSign(
                                            t,
                                            i
                                        ))
                                    )
                                        return this._orderValueCurrencySymbolAndSuffixText(
                                            t,
                                            i,
                                            !0
                                        );
                                    var s,
                                        l = h.isZeroOrHasNoValue(t);
                                    switch (
                                        (r && (t = t.replace("-", "")),
                                        (i.digitalGroupSpacing =
                                            i.digitalGroupSpacing.toString()),
                                        i.digitalGroupSpacing)
                                    ) {
                                        case e.options.digitalGroupSpacing.two:
                                            s = /(\d)((\d)(\d{2}?)+)$/;
                                            break;
                                        case e.options.digitalGroupSpacing
                                            .twoScaled:
                                            s =
                                                /(\d)((?:\d{2}){0,2}\d{3}(?:(?:\d{2}){2}\d{3})*?)$/;
                                            break;
                                        case e.options.digitalGroupSpacing.four:
                                            s = /(\d)((\d{4}?)+)$/;
                                            break;
                                        case e.options.digitalGroupSpacing
                                            .three:
                                        default:
                                            s = /(\d)((\d{3}?)+)$/;
                                    }
                                    var u,
                                        c = F(t.split(i.decimalCharacter), 2),
                                        m = c[0],
                                        g = c[1];
                                    if (
                                        i.decimalCharacterAlternative &&
                                        h.isUndefined(g)
                                    ) {
                                        var d = F(
                                            t.split(
                                                i.decimalCharacterAlternative
                                            ),
                                            2
                                        );
                                        (m = d[0]), (g = d[1]);
                                    }
                                    if ("" !== i.digitGroupSeparator)
                                        for (; s.test(m); )
                                            m = m.replace(
                                                s,
                                                "$1".concat(
                                                    i.digitGroupSeparator,
                                                    "$2"
                                                )
                                            );
                                    return (
                                        0 ===
                                            (u = n
                                                ? i.decimalPlacesShownOnFocus
                                                : i.decimalPlacesShownOnBlur) ||
                                        h.isUndefined(g)
                                            ? (t = m)
                                            : (g.length > u &&
                                                  (g = g.substring(0, u)),
                                              (t = ""
                                                  .concat(m)
                                                  .concat(i.decimalCharacter)
                                                  .concat(g))),
                                        (t =
                                            e._mergeCurrencySignNegativePositiveSignAndValue(
                                                t,
                                                i,
                                                r,
                                                l
                                            )),
                                        h.isNull(o) && (o = a),
                                        null !== i.negativeBracketsTypeOnBlur &&
                                            (o < 0 ||
                                                h.isNegativeStrict(
                                                    t,
                                                    i.negativeSignCharacter
                                                )) &&
                                            (t = this._toggleNegativeBracket(
                                                t,
                                                i,
                                                n
                                            )),
                                        i.suffixText
                                            ? "".concat(t).concat(i.suffixText)
                                            : t
                                    );
                                },
                            },
                            {
                                key: "_mergeCurrencySignNegativePositiveSignAndValue",
                                value: function (t, i, n, a) {
                                    var r,
                                        o = "";
                                    if (
                                        (n
                                            ? (o = i.negativeSignCharacter)
                                            : i.showPositiveSign &&
                                              !a &&
                                              (o = i.positiveSignCharacter),
                                        i.currencySymbolPlacement ===
                                            e.options.currencySymbolPlacement
                                                .prefix)
                                    )
                                        if (
                                            i.negativePositiveSignPlacement !==
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .none &&
                                            (n ||
                                                (!n &&
                                                    i.showPositiveSign &&
                                                    !a))
                                        )
                                            switch (
                                                i.negativePositiveSignPlacement
                                            ) {
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .prefix:
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .left:
                                                    r = ""
                                                        .concat(o)
                                                        .concat(
                                                            i.currencySymbol
                                                        )
                                                        .concat(t);
                                                    break;
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .right:
                                                    r = ""
                                                        .concat(
                                                            i.currencySymbol
                                                        )
                                                        .concat(o)
                                                        .concat(t);
                                                    break;
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .suffix:
                                                    r = ""
                                                        .concat(
                                                            i.currencySymbol
                                                        )
                                                        .concat(t)
                                                        .concat(o);
                                            }
                                        else r = i.currencySymbol + t;
                                    else if (
                                        i.currencySymbolPlacement ===
                                        e.options.currencySymbolPlacement.suffix
                                    )
                                        if (
                                            i.negativePositiveSignPlacement !==
                                                e.options
                                                    .negativePositiveSignPlacement
                                                    .none &&
                                            (n ||
                                                (!n &&
                                                    i.showPositiveSign &&
                                                    !a))
                                        )
                                            switch (
                                                i.negativePositiveSignPlacement
                                            ) {
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .suffix:
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .right:
                                                    r = ""
                                                        .concat(t)
                                                        .concat(
                                                            i.currencySymbol
                                                        )
                                                        .concat(o);
                                                    break;
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .left:
                                                    r = ""
                                                        .concat(t)
                                                        .concat(o)
                                                        .concat(
                                                            i.currencySymbol
                                                        );
                                                    break;
                                                case e.options
                                                    .negativePositiveSignPlacement
                                                    .prefix:
                                                    r = ""
                                                        .concat(o)
                                                        .concat(t)
                                                        .concat(
                                                            i.currencySymbol
                                                        );
                                            }
                                        else r = t + i.currencySymbol;
                                    return r;
                                },
                            },
                            {
                                key: "_truncateZeros",
                                value: function (e, t) {
                                    var i;
                                    switch (t) {
                                        case 0:
                                            i = /(\.(?:\d*[1-9])?)0*$/;
                                            break;
                                        case 1:
                                            i = /(\.\d(?:\d*[1-9])?)0*$/;
                                            break;
                                        default:
                                            i = new RegExp(
                                                "(\\.\\d{".concat(
                                                    t,
                                                    "}(?:\\d*[1-9])?)0*"
                                                )
                                            );
                                    }
                                    return (
                                        (e = e.replace(i, "$1")),
                                        0 === t && (e = e.replace(/\.$/, "")),
                                        e
                                    );
                                },
                            },
                            {
                                key: "_roundRawValue",
                                value: function (e, t) {
                                    return this._roundValue(
                                        e,
                                        t,
                                        t.decimalPlacesRawValue
                                    );
                                },
                            },
                            {
                                key: "_roundFormattedValueShownOnFocus",
                                value: function (e, t) {
                                    return this._roundValue(
                                        e,
                                        t,
                                        Number(t.decimalPlacesShownOnFocus)
                                    );
                                },
                            },
                            {
                                key: "_roundFormattedValueShownOnBlur",
                                value: function (e, t) {
                                    return this._roundValue(
                                        e,
                                        t,
                                        Number(t.decimalPlacesShownOnBlur)
                                    );
                                },
                            },
                            {
                                key: "_roundFormattedValueShownOnFocusOrBlur",
                                value: function (e, t, i) {
                                    return i
                                        ? this._roundFormattedValueShownOnFocus(
                                              e,
                                              t
                                          )
                                        : this._roundFormattedValueShownOnBlur(
                                              e,
                                              t
                                          );
                                },
                            },
                            {
                                key: "_roundValue",
                                value: function (t, i, n) {
                                    if (h.isNull(t)) return t;
                                    if (
                                        ((t = "" === t ? "0" : t.toString()),
                                        i.roundingMethod ===
                                            e.options.roundingMethod
                                                .toNearest05 ||
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .toNearest05Alt ||
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .upToNext05 ||
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .downToNext05)
                                    )
                                        return this._roundCloseTo05(t, i);
                                    var a,
                                        r = F(
                                            e._prepareValueForRounding(t, i),
                                            2
                                        ),
                                        o = r[0],
                                        s = (t = r[1]).lastIndexOf("."),
                                        l = -1 === s,
                                        u = F(t.split("."), 2),
                                        c = u[0];
                                    if (
                                        !(
                                            u[1] > 0 ||
                                            (i.allowDecimalPadding !==
                                                e.options.allowDecimalPadding
                                                    .never &&
                                                i.allowDecimalPadding !==
                                                    e.options
                                                        .allowDecimalPadding
                                                        .floats)
                                        )
                                    )
                                        return 0 === Number(t)
                                            ? c
                                            : "".concat(o).concat(c);
                                    a =
                                        i.allowDecimalPadding ===
                                            e.options.allowDecimalPadding
                                                .always ||
                                        i.allowDecimalPadding ===
                                            e.options.allowDecimalPadding.floats
                                            ? n
                                            : i.allowDecimalPadding > 0
                                            ? i.allowDecimalPadding
                                            : 0;
                                    var m,
                                        g = l ? t.length - 1 : s,
                                        d = t.length - 1 - g,
                                        v = "";
                                    if (d <= n) {
                                        if (((v = t), d < a)) {
                                            l &&
                                                (v = ""
                                                    .concat(v)
                                                    .concat(
                                                        i.decimalCharacter
                                                    ));
                                            for (var p = "000000"; d < a; )
                                                (v += p =
                                                    p.substring(0, a - d)),
                                                    (d += p.length);
                                        } else
                                            d > a
                                                ? (v = this._truncateZeros(
                                                      v,
                                                      a
                                                  ))
                                                : 0 === d &&
                                                  0 === a &&
                                                  (v = v.replace(/\.$/, ""));
                                        return 0 === Number(v)
                                            ? v
                                            : "".concat(o).concat(v);
                                    }
                                    m = l ? n - 1 : Number(n) + Number(s);
                                    var f,
                                        y = Number(t.charAt(m + 1)),
                                        S = t.substring(0, m + 1).split("");
                                    if (
                                        ((f =
                                            "." === t.charAt(m)
                                                ? t.charAt(m - 1) % 2
                                                : t.charAt(m) % 2),
                                        this._shouldRoundUp(y, i, o, f))
                                    )
                                        for (
                                            var b = S.length - 1;
                                            b >= 0;
                                            b -= 1
                                        )
                                            if ("." !== S[b]) {
                                                if (
                                                    ((S[b] = +S[b] + 1),
                                                    S[b] < 10)
                                                )
                                                    break;
                                                b > 0 && (S[b] = "0");
                                            }
                                    return (
                                        (S = S.slice(0, m + 1)),
                                        (v = this._truncateZeros(
                                            S.join(""),
                                            a
                                        )),
                                        0 === Number(v)
                                            ? v
                                            : "".concat(o).concat(v)
                                    );
                                },
                            },
                            {
                                key: "_roundCloseTo05",
                                value: function (t, i) {
                                    switch (i.roundingMethod) {
                                        case e.options.roundingMethod
                                            .toNearest05:
                                        case e.options.roundingMethod
                                            .toNearest05Alt:
                                            t = (
                                                Math.round(20 * t) / 20
                                            ).toString();
                                            break;
                                        case e.options.roundingMethod
                                            .upToNext05:
                                            t = (
                                                Math.ceil(20 * t) / 20
                                            ).toString();
                                            break;
                                        default:
                                            t = (
                                                Math.floor(20 * t) / 20
                                            ).toString();
                                    }
                                    return h.contains(t, ".")
                                        ? t.length - t.indexOf(".") < 3
                                            ? t + "0"
                                            : t
                                        : t + ".00";
                                },
                            },
                            {
                                key: "_prepareValueForRounding",
                                value: function (t, i) {
                                    var n = "";
                                    return (
                                        h.isNegativeStrict(t, "-") &&
                                            ((n = "-"),
                                            (t = t.replace("-", ""))),
                                        t.match(/^\d/) || (t = "0".concat(t)),
                                        0 === Number(t) && (n = ""),
                                        ((Number(t) > 0 &&
                                            i.leadingZero !==
                                                e.options.leadingZero.keep) ||
                                            (t.length > 0 &&
                                                i.leadingZero ===
                                                    e.options.leadingZero
                                                        .allow)) &&
                                            (t = t.replace(/^0*(\d)/, "$1")),
                                        [n, t]
                                    );
                                },
                            },
                            {
                                key: "_shouldRoundUp",
                                value: function (t, i, n, a) {
                                    return (
                                        (t > 4 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfUpSymmetric) ||
                                        (t > 4 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfUpAsymmetric &&
                                            "" === n) ||
                                        (t > 5 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfUpAsymmetric &&
                                            "-" === n) ||
                                        (t > 5 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfDownSymmetric) ||
                                        (t > 5 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfDownAsymmetric &&
                                            "" === n) ||
                                        (t > 4 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfDownAsymmetric &&
                                            "-" === n) ||
                                        (t > 5 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfEvenBankersRounding) ||
                                        (5 === t &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .halfEvenBankersRounding &&
                                            1 === a) ||
                                        (t > 0 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .toCeilingTowardPositiveInfinity &&
                                            "" === n) ||
                                        (t > 0 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .toFloorTowardNegativeInfinity &&
                                            "-" === n) ||
                                        (t > 0 &&
                                            i.roundingMethod ===
                                                e.options.roundingMethod
                                                    .upRoundAwayFromZero)
                                    );
                                },
                            },
                            {
                                key: "_truncateDecimalPlaces",
                                value: function (e, t, i, n) {
                                    i &&
                                        (e =
                                            this._roundFormattedValueShownOnFocus(
                                                e,
                                                t
                                            ));
                                    var a = F(e.split(t.decimalCharacter), 2),
                                        r = a[0],
                                        o = a[1];
                                    if (o && o.length > n)
                                        if (n > 0) {
                                            var s = o.substring(0, n);
                                            e = ""
                                                .concat(r)
                                                .concat(t.decimalCharacter)
                                                .concat(s);
                                        } else e = r;
                                    return e;
                                },
                            },
                            {
                                key: "_checkIfInRangeWithOverrideOption",
                                value: function (t, i) {
                                    if (
                                        (h.isNull(t) &&
                                            i.emptyInputBehavior ===
                                                e.options.emptyInputBehavior
                                                    .null) ||
                                        i.overrideMinMaxLimits ===
                                            e.options.overrideMinMaxLimits
                                                .ignore ||
                                        i.overrideMinMaxLimits ===
                                            e.options.overrideMinMaxLimits
                                                .invalid
                                    )
                                        return [!0, !0];
                                    t = (t = t.toString()).replace(",", ".");
                                    var n,
                                        a = h.parseStr(i.minimumValue),
                                        r = h.parseStr(i.maximumValue),
                                        o = h.parseStr(t);
                                    switch (i.overrideMinMaxLimits) {
                                        case e.options.overrideMinMaxLimits
                                            .floor:
                                            n = [h.testMinMax(a, o) > -1, !0];
                                            break;
                                        case e.options.overrideMinMaxLimits
                                            .ceiling:
                                            n = [!0, h.testMinMax(r, o) < 1];
                                            break;
                                        default:
                                            n = [
                                                h.testMinMax(a, o) > -1,
                                                h.testMinMax(r, o) < 1,
                                            ];
                                    }
                                    return n;
                                },
                            },
                            {
                                key: "_isWithinRangeWithOverrideOption",
                                value: function (e, t) {
                                    var i = F(
                                            this._checkIfInRangeWithOverrideOption(
                                                e,
                                                t
                                            ),
                                            2
                                        ),
                                        n = i[0],
                                        a = i[1];
                                    return n && a;
                                },
                            },
                            {
                                key: "_cleanValueForRangeParse",
                                value: function (e) {
                                    return (
                                        (e = e.toString().replace(",", ".")),
                                        h.parseStr(e)
                                    );
                                },
                            },
                            {
                                key: "_isMinimumRangeRespected",
                                value: function (e, t) {
                                    return (
                                        h.testMinMax(
                                            h.parseStr(t.minimumValue),
                                            this._cleanValueForRangeParse(e)
                                        ) > -1
                                    );
                                },
                            },
                            {
                                key: "_isMaximumRangeRespected",
                                value: function (e, t) {
                                    return (
                                        h.testMinMax(
                                            h.parseStr(t.maximumValue),
                                            this._cleanValueForRangeParse(e)
                                        ) < 1
                                    );
                                },
                            },
                            {
                                key: "_readCookie",
                                value: function (e) {
                                    for (
                                        var t = e + "=",
                                            i = document.cookie.split(";"),
                                            n = "",
                                            a = 0;
                                        a < i.length;
                                        a += 1
                                    ) {
                                        for (n = i[a]; " " === n.charAt(0); )
                                            n = n.substring(1, n.length);
                                        if (0 === n.indexOf(t))
                                            return n.substring(
                                                t.length,
                                                n.length
                                            );
                                    }
                                    return null;
                                },
                            },
                            {
                                key: "_storageTest",
                                value: function () {
                                    var e = "modernizr";
                                    try {
                                        return (
                                            sessionStorage.setItem(e, e),
                                            sessionStorage.removeItem(e),
                                            !0
                                        );
                                    } catch (t) {
                                        return !1;
                                    }
                                },
                            },
                            {
                                key: "_correctNegativePositiveSignPlacementOption",
                                value: function (t) {
                                    if (
                                        h.isNull(
                                            t.negativePositiveSignPlacement
                                        )
                                    )
                                        if (
                                            h.isUndefined(t) ||
                                            !h.isUndefinedOrNullOrEmpty(
                                                t.negativePositiveSignPlacement
                                            ) ||
                                            h.isUndefinedOrNullOrEmpty(
                                                t.currencySymbol
                                            )
                                        )
                                            t.negativePositiveSignPlacement =
                                                e.options.negativePositiveSignPlacement.left;
                                        else
                                            switch (t.currencySymbolPlacement) {
                                                case e.options
                                                    .currencySymbolPlacement
                                                    .suffix:
                                                    t.negativePositiveSignPlacement =
                                                        e.options.negativePositiveSignPlacement.prefix;
                                                    break;
                                                case e.options
                                                    .currencySymbolPlacement
                                                    .prefix:
                                                    t.negativePositiveSignPlacement =
                                                        e.options.negativePositiveSignPlacement.left;
                                            }
                                },
                            },
                            {
                                key: "_correctCaretPositionOnFocusAndSelectOnFocusOptions",
                                value: function (t) {
                                    return h.isNull(t)
                                        ? null
                                        : (!h.isUndefinedOrNullOrEmpty(
                                              t.caretPositionOnFocus
                                          ) &&
                                              h.isUndefinedOrNullOrEmpty(
                                                  t.selectOnFocus
                                              ) &&
                                              (t.selectOnFocus =
                                                  e.options.selectOnFocus.doNotSelect),
                                          h.isUndefinedOrNullOrEmpty(
                                              t.caretPositionOnFocus
                                          ) &&
                                              !h.isUndefinedOrNullOrEmpty(
                                                  t.selectOnFocus
                                              ) &&
                                              t.selectOnFocus ===
                                                  e.options.selectOnFocus
                                                      .select &&
                                              (t.caretPositionOnFocus =
                                                  e.options.caretPositionOnFocus.doNoForceCaretPosition),
                                          t);
                                },
                            },
                            {
                                key: "_calculateDecimalPlacesOnInit",
                                value: function (t) {
                                    this._validateDecimalPlacesRawValue(t),
                                        t.decimalPlacesShownOnFocus ===
                                            e.options.decimalPlacesShownOnFocus
                                                .useDefault &&
                                            (t.decimalPlacesShownOnFocus =
                                                t.decimalPlaces),
                                        t.decimalPlacesShownOnBlur ===
                                            e.options.decimalPlacesShownOnBlur
                                                .useDefault &&
                                            (t.decimalPlacesShownOnBlur =
                                                t.decimalPlaces),
                                        t.decimalPlacesRawValue ===
                                            e.options.decimalPlacesRawValue
                                                .useDefault &&
                                            (t.decimalPlacesRawValue =
                                                t.decimalPlaces);
                                    var i = 0;
                                    t.rawValueDivisor &&
                                        t.rawValueDivisor !==
                                            e.options.rawValueDivisor.none &&
                                        (i =
                                            String(t.rawValueDivisor).length -
                                            1) < 0 &&
                                        (i = 0),
                                        (t.decimalPlacesRawValue = Math.max(
                                            Math.max(
                                                t.decimalPlacesShownOnBlur,
                                                t.decimalPlacesShownOnFocus
                                            ) + i,
                                            Number(
                                                t.originalDecimalPlacesRawValue
                                            ) + i
                                        ));
                                },
                            },
                            {
                                key: "_calculateDecimalPlacesOnUpdate",
                                value: function (t) {
                                    var i =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : null;
                                    this._validateDecimalPlacesRawValue(t),
                                        h.isNull(i) &&
                                            h.throwError(
                                                "When updating the settings, the previous ones should be passed as an argument."
                                            );
                                    var n = "decimalPlaces" in t;
                                    if (
                                        n ||
                                        "decimalPlacesRawValue" in t ||
                                        "decimalPlacesShownOnFocus" in t ||
                                        "decimalPlacesShownOnBlur" in t ||
                                        "rawValueDivisor" in t
                                    ) {
                                        n
                                            ? (("decimalPlacesShownOnFocus" in
                                                  t &&
                                                  t.decimalPlacesShownOnFocus !==
                                                      e.options
                                                          .decimalPlacesShownOnFocus
                                                          .useDefault) ||
                                                  (t.decimalPlacesShownOnFocus =
                                                      t.decimalPlaces),
                                              ("decimalPlacesShownOnBlur" in
                                                  t &&
                                                  t.decimalPlacesShownOnBlur !==
                                                      e.options
                                                          .decimalPlacesShownOnBlur
                                                          .useDefault) ||
                                                  (t.decimalPlacesShownOnBlur =
                                                      t.decimalPlaces),
                                              ("decimalPlacesRawValue" in t &&
                                                  t.decimalPlacesRawValue !==
                                                      e.options
                                                          .decimalPlacesRawValue
                                                          .useDefault) ||
                                                  (t.decimalPlacesRawValue =
                                                      t.decimalPlaces))
                                            : (h.isUndefined(
                                                  t.decimalPlacesShownOnFocus
                                              ) &&
                                                  (t.decimalPlacesShownOnFocus =
                                                      i.decimalPlacesShownOnFocus),
                                              h.isUndefined(
                                                  t.decimalPlacesShownOnBlur
                                              ) &&
                                                  (t.decimalPlacesShownOnBlur =
                                                      i.decimalPlacesShownOnBlur));
                                        var a = 0;
                                        t.rawValueDivisor &&
                                            t.rawValueDivisor !==
                                                e.options.rawValueDivisor
                                                    .none &&
                                            (a =
                                                String(t.rawValueDivisor)
                                                    .length - 1) < 0 &&
                                            (a = 0),
                                            t.decimalPlaces ||
                                            t.decimalPlacesRawValue
                                                ? (t.decimalPlacesRawValue =
                                                      Math.max(
                                                          Math.max(
                                                              t.decimalPlacesShownOnBlur,
                                                              t.decimalPlacesShownOnFocus
                                                          ) + a,
                                                          Number(
                                                              t.decimalPlacesRawValue
                                                          ) + a
                                                      ))
                                                : (t.decimalPlacesRawValue =
                                                      Math.max(
                                                          Math.max(
                                                              t.decimalPlacesShownOnBlur,
                                                              t.decimalPlacesShownOnFocus
                                                          ) + a,
                                                          Number(
                                                              i.originalDecimalPlacesRawValue
                                                          ) + a
                                                      ));
                                    }
                                },
                            },
                            {
                                key: "_cachesUsualRegularExpressions",
                                value: function (t, i) {
                                    var n;
                                    (n =
                                        t.negativeSignCharacter !==
                                        e.options.negativeSignCharacter.hyphen
                                            ? "([-\\".concat(
                                                  t.negativeSignCharacter,
                                                  "]?)"
                                              )
                                            : "(-?)"),
                                        (i.aNegRegAutoStrip = n),
                                        (t.allowedAutoStrip = new RegExp(
                                            "[^-0123456789\\".concat(
                                                t.decimalCharacter,
                                                "]"
                                            ),
                                            "g"
                                        )),
                                        (t.numRegAutoStrip = new RegExp(
                                            ""
                                                .concat(n, "(?:\\")
                                                .concat(
                                                    t.decimalCharacter,
                                                    "?([0-9]+\\"
                                                )
                                                .concat(
                                                    t.decimalCharacter,
                                                    "[0-9]+)|([0-9]*(?:\\"
                                                )
                                                .concat(
                                                    t.decimalCharacter,
                                                    "[0-9]*)?))"
                                                )
                                        )),
                                        (t.stripReg = new RegExp(
                                            "^".concat(
                                                i.aNegRegAutoStrip,
                                                "0*([0-9])"
                                            )
                                        )),
                                        (t.formulaChars = new RegExp(
                                            "[0-9".concat(
                                                t.decimalCharacter,
                                                "+\\-*/() ]"
                                            )
                                        ));
                                },
                            },
                            {
                                key: "_convertOldOptionsToNewOnes",
                                value: function (e) {
                                    var t = {
                                        aSep: "digitGroupSeparator",
                                        nSep: "showOnlyNumbersOnFocus",
                                        dGroup: "digitalGroupSpacing",
                                        aDec: "decimalCharacter",
                                        altDec: "decimalCharacterAlternative",
                                        aSign: "currencySymbol",
                                        pSign: "currencySymbolPlacement",
                                        pNeg: "negativePositiveSignPlacement",
                                        aSuffix: "suffixText",
                                        oLimits: "overrideMinMaxLimits",
                                        vMax: "maximumValue",
                                        vMin: "minimumValue",
                                        mDec: "decimalPlacesOverride",
                                        eDec: "decimalPlacesShownOnFocus",
                                        scaleDecimal:
                                            "decimalPlacesShownOnBlur",
                                        aStor: "saveValueToSessionStorage",
                                        mRound: "roundingMethod",
                                        aPad: "allowDecimalPadding",
                                        nBracket: "negativeBracketsTypeOnBlur",
                                        wEmpty: "emptyInputBehavior",
                                        lZero: "leadingZero",
                                        aForm: "formatOnPageLoad",
                                        sNumber: "selectNumberOnly",
                                        anDefault: "defaultValueOverride",
                                        unSetOnSubmit: "unformatOnSubmit",
                                        outputType: "outputFormat",
                                        debug: "showWarnings",
                                        allowDecimalPadding: !0,
                                        alwaysAllowDecimalCharacter: !0,
                                        caretPositionOnFocus: !0,
                                        createLocalList: !0,
                                        currencySymbol: !0,
                                        currencySymbolPlacement: !0,
                                        decimalCharacter: !0,
                                        decimalCharacterAlternative: !0,
                                        decimalPlaces: !0,
                                        decimalPlacesRawValue: !0,
                                        decimalPlacesShownOnBlur: !0,
                                        decimalPlacesShownOnFocus: !0,
                                        defaultValueOverride: !0,
                                        digitalGroupSpacing: !0,
                                        digitGroupSeparator: !0,
                                        divisorWhenUnfocused: !0,
                                        emptyInputBehavior: !0,
                                        eventBubbles: !0,
                                        eventIsCancelable: !0,
                                        failOnUnknownOption: !0,
                                        formatOnPageLoad: !0,
                                        formulaMode: !0,
                                        historySize: !0,
                                        isCancellable: !0,
                                        leadingZero: !0,
                                        maximumValue: !0,
                                        minimumValue: !0,
                                        modifyValueOnUpDownArrow: !0,
                                        modifyValueOnWheel: !0,
                                        negativeBracketsTypeOnBlur: !0,
                                        negativePositiveSignPlacement: !0,
                                        negativeSignCharacter: !0,
                                        negativePositiveSignBehavior: !0,
                                        noEventListeners: !0,
                                        onInvalidPaste: !0,
                                        outputFormat: !0,
                                        overrideMinMaxLimits: !0,
                                        positiveSignCharacter: !0,
                                        rawValueDivisor: !0,
                                        readOnly: !0,
                                        roundingMethod: !0,
                                        saveValueToSessionStorage: !0,
                                        selectNumberOnly: !0,
                                        selectOnFocus: !0,
                                        serializeSpaces: !0,
                                        showOnlyNumbersOnFocus: !0,
                                        showPositiveSign: !0,
                                        showWarnings: !0,
                                        styleRules: !0,
                                        suffixText: !0,
                                        symbolWhenUnfocused: !0,
                                        upDownStep: !0,
                                        unformatOnHover: !0,
                                        unformatOnSubmit: !0,
                                        valuesToStrings: !0,
                                        watchExternalChanges: !0,
                                        wheelOn: !0,
                                        wheelStep: !0,
                                        allowedAutoStrip: !0,
                                        formulaChars: !0,
                                        isNegativeSignAllowed: !0,
                                        isPositiveSignAllowed: !0,
                                        mIntNeg: !0,
                                        mIntPos: !0,
                                        numRegAutoStrip: !0,
                                        originalDecimalPlaces: !0,
                                        originalDecimalPlacesRawValue: !0,
                                        stripReg: !0,
                                    };
                                    for (var i in e)
                                        if (
                                            Object.prototype.hasOwnProperty.call(
                                                e,
                                                i
                                            )
                                        ) {
                                            if (!0 === t[i]) continue;
                                            Object.prototype.hasOwnProperty.call(
                                                t,
                                                i
                                            )
                                                ? (h.warning(
                                                      "You are using the deprecated option name '"
                                                          .concat(
                                                              i,
                                                              "'. Please use '"
                                                          )
                                                          .concat(
                                                              t[i],
                                                              "' instead from now on. The old option name will be dropped very soon™."
                                                          ),
                                                      !0
                                                  ),
                                                  (e[t[i]] = e[i]),
                                                  delete e[i])
                                                : e.failOnUnknownOption &&
                                                  h.throwError(
                                                      "Option name '".concat(
                                                          i,
                                                          "' is unknown. Please fix the options passed to autoNumeric"
                                                      )
                                                  );
                                        }
                                    "mDec" in e &&
                                        h.warning(
                                            "The old `mDec` option has been deprecated in favor of more accurate options ; `decimalPlaces`, `decimalPlacesRawValue`, `decimalPlacesShownOnFocus` and `decimalPlacesShownOnBlur`.",
                                            !0
                                        );
                                },
                            },
                            {
                                key: "_setNegativePositiveSignPermissions",
                                value: function (e) {
                                    (e.isNegativeSignAllowed =
                                        e.minimumValue < 0),
                                        (e.isPositiveSignAllowed =
                                            e.maximumValue >= 0);
                                },
                            },
                            {
                                key: "_toNumericValue",
                                value: function (e, t) {
                                    var i;
                                    return (
                                        h.isNumber(Number(e))
                                            ? (h.isNumberStrict(e) ||
                                                  (e = String(e).trim()),
                                              (i = h.scientificToDecimal(e)))
                                            : ((i =
                                                  this._convertToNumericString(
                                                      e.toString(),
                                                      t
                                                  )),
                                              h.isNumber(Number(i)) ||
                                                  (h.warning(
                                                      'The given value "'.concat(
                                                          e,
                                                          '" cannot be converted to a numeric one and therefore cannot be used appropriately.'
                                                      ),
                                                      t.showWarnings
                                                  ),
                                                  (i = NaN))),
                                        i
                                    );
                                },
                            },
                            {
                                key: "_checkIfInRange",
                                value: function (e, t, i) {
                                    var n = h.parseStr(e);
                                    return (
                                        h.testMinMax(t, n) > -1 &&
                                        h.testMinMax(i, n) < 1
                                    );
                                },
                            },
                            {
                                key: "_shouldSkipEventKey",
                                value: function (e) {
                                    var t = h.isInArray(
                                            e,
                                            n.keyName._allFnKeys
                                        ),
                                        i =
                                            e === n.keyName.OSLeft ||
                                            e === n.keyName.OSRight,
                                        a = e === n.keyName.ContextMenu,
                                        r = h.isInArray(
                                            e,
                                            n.keyName._someNonPrintableKeys
                                        ),
                                        o =
                                            e === n.keyName.NumLock ||
                                            e === n.keyName.ScrollLock ||
                                            e === n.keyName.Insert ||
                                            e === n.keyName.Command,
                                        s = e === n.keyName.Unidentified;
                                    return t || i || a || r || s || o;
                                },
                            },
                            {
                                key: "_serialize",
                                value: function (e) {
                                    var t,
                                        i = this,
                                        n =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1] &&
                                            arguments[1],
                                        a =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : "unformatted",
                                        r =
                                            arguments.length > 3 &&
                                            void 0 !== arguments[3]
                                                ? arguments[3]
                                                : "+",
                                        o =
                                            arguments.length > 4 &&
                                            void 0 !== arguments[4]
                                                ? arguments[4]
                                                : null,
                                        s = [];
                                    return (
                                        "object" === A(e) &&
                                            "form" ===
                                                e.nodeName.toLowerCase() &&
                                            Array.prototype.slice
                                                .call(e.elements)
                                                .forEach(function (e) {
                                                    if (
                                                        e.name &&
                                                        !e.disabled &&
                                                        -1 ===
                                                            [
                                                                "file",
                                                                "reset",
                                                                "submit",
                                                                "button",
                                                            ].indexOf(e.type)
                                                    )
                                                        if (
                                                            "select-multiple" ===
                                                            e.type
                                                        )
                                                            Array.prototype.slice
                                                                .call(e.options)
                                                                .forEach(
                                                                    function (
                                                                        t
                                                                    ) {
                                                                        t.selected &&
                                                                            (n
                                                                                ? s.push(
                                                                                      {
                                                                                          name: e.name,
                                                                                          value: t.value,
                                                                                      }
                                                                                  )
                                                                                : s.push(
                                                                                      ""
                                                                                          .concat(
                                                                                              encodeURIComponent(
                                                                                                  e.name
                                                                                              ),
                                                                                              "="
                                                                                          )
                                                                                          .concat(
                                                                                              encodeURIComponent(
                                                                                                  t.value
                                                                                              )
                                                                                          )
                                                                                  ));
                                                                    }
                                                                );
                                                        else if (
                                                            -1 ===
                                                                [
                                                                    "checkbox",
                                                                    "radio",
                                                                ].indexOf(
                                                                    e.type
                                                                ) ||
                                                            e.checked
                                                        ) {
                                                            var t, r;
                                                            if (
                                                                i.isManagedByAutoNumeric(
                                                                    e
                                                                )
                                                            )
                                                                switch (a) {
                                                                    case "unformatted":
                                                                        (r =
                                                                            i.getAutoNumericElement(
                                                                                e
                                                                            )),
                                                                            h.isNull(
                                                                                r
                                                                            ) ||
                                                                                (t =
                                                                                    i.unformat(
                                                                                        e,
                                                                                        r.getSettings()
                                                                                    ));
                                                                        break;
                                                                    case "localized":
                                                                        if (
                                                                            ((r =
                                                                                i.getAutoNumericElement(
                                                                                    e
                                                                                )),
                                                                            !h.isNull(
                                                                                r
                                                                            ))
                                                                        ) {
                                                                            var l =
                                                                                h.cloneObject(
                                                                                    r.getSettings()
                                                                                );
                                                                            h.isNull(
                                                                                o
                                                                            ) ||
                                                                                (l.outputFormat =
                                                                                    o),
                                                                                (t =
                                                                                    i.localize(
                                                                                        e,
                                                                                        l
                                                                                    ));
                                                                        }
                                                                        break;
                                                                    default:
                                                                        t =
                                                                            e.value;
                                                                }
                                                            else t = e.value;
                                                            h.isUndefined(t) &&
                                                                h.throwError(
                                                                    "This error should never be hit. If it has, something really wrong happened!"
                                                                ),
                                                                n
                                                                    ? s.push({
                                                                          name: e.name,
                                                                          value: t,
                                                                      })
                                                                    : s.push(
                                                                          ""
                                                                              .concat(
                                                                                  encodeURIComponent(
                                                                                      e.name
                                                                                  ),
                                                                                  "="
                                                                              )
                                                                              .concat(
                                                                                  encodeURIComponent(
                                                                                      t
                                                                                  )
                                                                              )
                                                                      );
                                                        }
                                                }),
                                        n
                                            ? (t = s)
                                            : ((t = s.join("&")),
                                              "+" === r &&
                                                  (t = t.replace(/%20/g, "+"))),
                                        t
                                    );
                                },
                            },
                            {
                                key: "_serializeNumericString",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : "+";
                                    return this._serialize(
                                        e,
                                        !1,
                                        "unformatted",
                                        t
                                    );
                                },
                            },
                            {
                                key: "_serializeFormatted",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : "+";
                                    return this._serialize(
                                        e,
                                        !1,
                                        "formatted",
                                        t
                                    );
                                },
                            },
                            {
                                key: "_serializeLocalized",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : "+",
                                        i =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null;
                                    return this._serialize(
                                        e,
                                        !1,
                                        "localized",
                                        t,
                                        i
                                    );
                                },
                            },
                            {
                                key: "_serializeNumericStringArray",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : "+";
                                    return this._serialize(
                                        e,
                                        !0,
                                        "unformatted",
                                        t
                                    );
                                },
                            },
                            {
                                key: "_serializeFormattedArray",
                                value: function (e) {
                                    var t =
                                        arguments.length > 1 &&
                                        void 0 !== arguments[1]
                                            ? arguments[1]
                                            : "+";
                                    return this._serialize(
                                        e,
                                        !0,
                                        "formatted",
                                        t
                                    );
                                },
                            },
                            {
                                key: "_serializeLocalizedArray",
                                value: function (e) {
                                    var t =
                                            arguments.length > 1 &&
                                            void 0 !== arguments[1]
                                                ? arguments[1]
                                                : "+",
                                        i =
                                            arguments.length > 2 &&
                                            void 0 !== arguments[2]
                                                ? arguments[2]
                                                : null;
                                    return this._serialize(
                                        e,
                                        !0,
                                        "localized",
                                        t,
                                        i
                                    );
                                },
                            },
                        ]),
                        i && L(t.prototype, i),
                        a && L(t, a),
                        Object.defineProperty(t, "prototype", { writable: !1 }),
                        e
                    );
                })();
            D(M, "options", void 0),
                D(M, "events", void 0),
                D(M, "defaultSettings", void 0),
                D(M, "predefinedOptions", void 0),
                (M.multiple = function (e) {
                    var t =
                            arguments.length > 1 && void 0 !== arguments[1]
                                ? arguments[1]
                                : null,
                        i =
                            arguments.length > 2 && void 0 !== arguments[2]
                                ? arguments[2]
                                : null,
                        n = [];
                    if ((h.isObject(t) && ((i = t), (t = null)), h.isString(e)))
                        e = C(document.querySelectorAll(e));
                    else if (h.isObject(e)) {
                        Object.prototype.hasOwnProperty.call(
                            e,
                            "rootElement"
                        ) ||
                            h.throwError(
                                "The object passed to the 'multiple' function is invalid ; no 'rootElement' attribute found."
                            );
                        var a = C(e.rootElement.querySelectorAll("input"));
                        Object.prototype.hasOwnProperty.call(e, "exclude")
                            ? (Array.isArray(e.exclude) ||
                                  h.throwError(
                                      "The 'exclude' array passed to the 'multiple' function is invalid."
                                  ),
                              (e = h.filterOut(a, e.exclude)))
                            : (e = a);
                    } else
                        h.isArray(e) ||
                            h.throwError(
                                "The given parameters to the 'multiple' function are invalid."
                            );
                    if (0 === e.length) {
                        var r = !0;
                        return (
                            !h.isNull(i) &&
                                h.isBoolean(i.showWarnings) &&
                                (r = i.showWarnings),
                            h.warning(
                                "No valid DOM elements were given hence no AutoNumeric objects were instantiated.",
                                r
                            ),
                            []
                        );
                    }
                    var o = h.isArray(t) && t.length >= 1,
                        s = !1,
                        l = !1;
                    if (o) {
                        var u = A(Number(t[0]));
                        (s = "number" === u && !isNaN(Number(t[0]))) ||
                            (("string" === u || isNaN(u) || "object" === u) &&
                                (l = !0));
                    }
                    var c,
                        m = !1;
                    if (h.isArray(i) && i.length >= 1) {
                        var g = A(i[0]);
                        ("string" !== g && "object" !== g) || (m = !0);
                    }
                    c = l ? M.mergeOptions(t) : m ? M.mergeOptions(i) : i;
                    var d,
                        v = h.isNumber(t);
                    return (
                        s && (d = t.length),
                        e.forEach(function (e, i) {
                            v
                                ? n.push(new M(e, t, c))
                                : s && i <= d
                                ? n.push(new M(e, t[i], c))
                                : n.push(new M(e, null, c));
                        }),
                        n
                    );
                }),
                (function () {
                    if (
                        (Array.from ||
                            (Array.from = function (e) {
                                return [].slice.call(e);
                            }),
                        "undefined" == typeof window ||
                            "function" == typeof window.CustomEvent)
                    )
                        return !1;
                    function e(e, t) {
                        t = t || {
                            bubbles: !1,
                            cancelable: !1,
                            detail: void 0,
                        };
                        var i = document.createEvent("CustomEvent");
                        return (
                            i.initCustomEvent(
                                e,
                                t.bubbles,
                                t.cancelable,
                                t.detail
                            ),
                            i
                        );
                    }
                    (e.prototype = window.Event.prototype),
                        (window.CustomEvent = e);
                })(),
                (M.events = {
                    correctedValue: "autoNumeric:correctedValue",
                    initialized: "autoNumeric:initialized",
                    invalidFormula: "autoNumeric:invalidFormula",
                    invalidValue: "autoNumeric:invalidValue",
                    formatted: "autoNumeric:formatted",
                    rawValueModified: "autoNumeric:rawValueModified",
                    minRangeExceeded: "autoNumeric:minExceeded",
                    maxRangeExceeded: "autoNumeric:maxExceeded",
                    native: { input: "input", change: "change" },
                    validFormula: "autoNumeric:validFormula",
                }),
                Object.freeze(M.events.native),
                Object.freeze(M.events),
                Object.defineProperty(M, "events", {
                    configurable: !1,
                    writable: !1,
                }),
                (M.options = {
                    allowDecimalPadding: {
                        always: !0,
                        never: !1,
                        floats: "floats",
                    },
                    alwaysAllowDecimalCharacter: {
                        alwaysAllow: !0,
                        doNotAllow: !1,
                    },
                    caretPositionOnFocus: {
                        start: "start",
                        end: "end",
                        decimalLeft: "decimalLeft",
                        decimalRight: "decimalRight",
                        doNoForceCaretPosition: null,
                    },
                    createLocalList: { createList: !0, doNotCreateList: !1 },
                    currencySymbol: {
                        none: "",
                        currencySign: "¤",
                        austral: "₳",
                        australCentavo: "¢",
                        baht: "฿",
                        cedi: "₵",
                        cent: "¢",
                        colon: "₡",
                        cruzeiro: "₢",
                        dollar: "$",
                        dong: "₫",
                        drachma: "₯",
                        dram: "​֏",
                        european: "₠",
                        euro: "€",
                        florin: "ƒ",
                        franc: "₣",
                        guarani: "₲",
                        hryvnia: "₴",
                        kip: "₭",
                        att: "ອັດ",
                        lepton: "Λ.",
                        lira: "₺",
                        liraOld: "₤",
                        lari: "₾",
                        mark: "ℳ",
                        mill: "₥",
                        naira: "₦",
                        peseta: "₧",
                        peso: "₱",
                        pfennig: "₰",
                        pound: "£",
                        real: "R$ ",
                        riel: "៛",
                        ruble: "₽",
                        rupee: "₹",
                        rupeeOld: "₨",
                        shekel: "₪",
                        shekelAlt: "ש״ח‎‎",
                        taka: "৳",
                        tenge: "₸",
                        togrog: "₮",
                        won: "₩",
                        yen: "¥",
                    },
                    currencySymbolPlacement: { prefix: "p", suffix: "s" },
                    decimalCharacter: {
                        comma: ",",
                        dot: ".",
                        middleDot: "·",
                        arabicDecimalSeparator: "٫",
                        decimalSeparatorKeySymbol: "⎖",
                    },
                    decimalCharacterAlternative: {
                        none: null,
                        comma: ",",
                        dot: ".",
                    },
                    decimalPlaces: {
                        none: 0,
                        one: 1,
                        two: 2,
                        three: 3,
                        four: 4,
                        five: 5,
                        six: 6,
                    },
                    decimalPlacesRawValue: {
                        useDefault: null,
                        none: 0,
                        one: 1,
                        two: 2,
                        three: 3,
                        four: 4,
                        five: 5,
                        six: 6,
                    },
                    decimalPlacesShownOnBlur: {
                        useDefault: null,
                        none: 0,
                        one: 1,
                        two: 2,
                        three: 3,
                        four: 4,
                        five: 5,
                        six: 6,
                    },
                    decimalPlacesShownOnFocus: {
                        useDefault: null,
                        none: 0,
                        one: 1,
                        two: 2,
                        three: 3,
                        four: 4,
                        five: 5,
                        six: 6,
                    },
                    defaultValueOverride: { doNotOverride: null },
                    digitalGroupSpacing: {
                        two: "2",
                        twoScaled: "2s",
                        three: "3",
                        four: "4",
                    },
                    digitGroupSeparator: {
                        comma: ",",
                        dot: ".",
                        normalSpace: " ",
                        thinSpace: " ",
                        narrowNoBreakSpace: " ",
                        noBreakSpace: " ",
                        noSeparator: "",
                        apostrophe: "'",
                        arabicThousandsSeparator: "٬",
                        dotAbove: "˙",
                        privateUseTwo: "’",
                    },
                    divisorWhenUnfocused: {
                        none: null,
                        percentage: 100,
                        permille: 1e3,
                        basisPoint: 1e4,
                    },
                    emptyInputBehavior: {
                        focus: "focus",
                        press: "press",
                        always: "always",
                        zero: "zero",
                        min: "min",
                        max: "max",
                        null: "null",
                    },
                    eventBubbles: { bubbles: !0, doesNotBubble: !1 },
                    eventIsCancelable: {
                        isCancelable: !0,
                        isNotCancelable: !1,
                    },
                    failOnUnknownOption: { fail: !0, ignore: !1 },
                    formatOnPageLoad: { format: !0, doNotFormat: !1 },
                    formulaMode: { enabled: !0, disabled: !1 },
                    historySize: {
                        verySmall: 5,
                        small: 10,
                        medium: 20,
                        large: 50,
                        veryLarge: 100,
                        insane: Number.MAX_SAFE_INTEGER,
                    },
                    invalidClass: "an-invalid",
                    isCancellable: { cancellable: !0, notCancellable: !1 },
                    leadingZero: { allow: "allow", deny: "deny", keep: "keep" },
                    maximumValue: {
                        tenTrillions: "10000000000000",
                        oneBillion: "1000000000",
                        zero: "0",
                    },
                    minimumValue: {
                        tenTrillions: "-10000000000000",
                        oneBillion: "-1000000000",
                        zero: "0",
                    },
                    modifyValueOnUpDownArrow: {
                        modifyValue: !0,
                        doNothing: !1,
                    },
                    modifyValueOnWheel: { modifyValue: !0, doNothing: !1 },
                    negativeBracketsTypeOnBlur: {
                        parentheses: "(,)",
                        brackets: "[,]",
                        chevrons: "<,>",
                        curlyBraces: "{,}",
                        angleBrackets: "〈,〉",
                        japaneseQuotationMarks: "｢,｣",
                        halfBrackets: "⸤,⸥",
                        whiteSquareBrackets: "⟦,⟧",
                        quotationMarks: "‹,›",
                        guillemets: "«,»",
                        none: null,
                    },
                    negativePositiveSignPlacement: {
                        prefix: "p",
                        suffix: "s",
                        left: "l",
                        right: "r",
                        none: null,
                    },
                    negativeSignCharacter: {
                        hyphen: "-",
                        minus: "−",
                        heavyMinus: "➖",
                        fullWidthHyphen: "－",
                        circledMinus: "⊖",
                        squaredMinus: "⊟",
                        triangleMinus: "⨺",
                        plusMinus: "±",
                        minusPlus: "∓",
                        dotMinus: "∸",
                        minusTilde: "≂",
                        not: "¬",
                    },
                    negativePositiveSignBehavior: {
                        toggle: !0,
                        doNotToggle: !1,
                    },
                    noEventListeners: { noEvents: !0, addEvents: !1 },
                    onInvalidPaste: {
                        error: "error",
                        ignore: "ignore",
                        clamp: "clamp",
                        truncate: "truncate",
                        replace: "replace",
                    },
                    outputFormat: {
                        string: "string",
                        number: "number",
                        dot: ".",
                        negativeDot: "-.",
                        comma: ",",
                        negativeComma: "-,",
                        dotNegative: ".-",
                        commaNegative: ",-",
                        none: null,
                    },
                    overrideMinMaxLimits: {
                        ceiling: "ceiling",
                        floor: "floor",
                        ignore: "ignore",
                        invalid: "invalid",
                        doNotOverride: null,
                    },
                    positiveSignCharacter: {
                        plus: "+",
                        fullWidthPlus: "＋",
                        heavyPlus: "➕",
                        doublePlus: "⧺",
                        triplePlus: "⧻",
                        circledPlus: "⊕",
                        squaredPlus: "⊞",
                        trianglePlus: "⨹",
                        plusMinus: "±",
                        minusPlus: "∓",
                        dotPlus: "∔",
                        altHebrewPlus: "﬩",
                        normalSpace: " ",
                        thinSpace: " ",
                        narrowNoBreakSpace: " ",
                        noBreakSpace: " ",
                    },
                    rawValueDivisor: {
                        none: null,
                        percentage: 100,
                        permille: 1e3,
                        basisPoint: 1e4,
                    },
                    readOnly: { readOnly: !0, readWrite: !1 },
                    roundingMethod: {
                        halfUpSymmetric: "S",
                        halfUpAsymmetric: "A",
                        halfDownSymmetric: "s",
                        halfDownAsymmetric: "a",
                        halfEvenBankersRounding: "B",
                        upRoundAwayFromZero: "U",
                        downRoundTowardZero: "D",
                        toCeilingTowardPositiveInfinity: "C",
                        toFloorTowardNegativeInfinity: "F",
                        toNearest05: "N05",
                        toNearest05Alt: "CHF",
                        upToNext05: "U05",
                        downToNext05: "D05",
                    },
                    saveValueToSessionStorage: { save: !0, doNotSave: !1 },
                    selectNumberOnly: { selectNumbersOnly: !0, selectAll: !1 },
                    selectOnFocus: { select: !0, doNotSelect: !1 },
                    serializeSpaces: { plus: "+", percent: "%20" },
                    showOnlyNumbersOnFocus: { onlyNumbers: !0, showAll: !1 },
                    showPositiveSign: { show: !0, hide: !1 },
                    showWarnings: { show: !0, hide: !1 },
                    styleRules: {
                        none: null,
                        positiveNegative: {
                            positive: "autoNumeric-positive",
                            negative: "autoNumeric-negative",
                        },
                        range0To100With4Steps: {
                            ranges: [
                                { min: 0, max: 25, class: "autoNumeric-red" },
                                {
                                    min: 25,
                                    max: 50,
                                    class: "autoNumeric-orange",
                                },
                                {
                                    min: 50,
                                    max: 75,
                                    class: "autoNumeric-yellow",
                                },
                                {
                                    min: 75,
                                    max: 100,
                                    class: "autoNumeric-green",
                                },
                            ],
                        },
                        evenOdd: {
                            userDefined: [
                                {
                                    callback: function (e) {
                                        return e % 2 == 0;
                                    },
                                    classes: [
                                        "autoNumeric-even",
                                        "autoNumeric-odd",
                                    ],
                                },
                            ],
                        },
                        rangeSmallAndZero: {
                            userDefined: [
                                {
                                    callback: function (e) {
                                        return e >= -1 && e < 0
                                            ? 0
                                            : 0 === Number(e)
                                            ? 1
                                            : e > 0 && e <= 1
                                            ? 2
                                            : null;
                                    },
                                    classes: [
                                        "autoNumeric-small-negative",
                                        "autoNumeric-zero",
                                        "autoNumeric-small-positive",
                                    ],
                                },
                            ],
                        },
                    },
                    suffixText: {
                        none: "",
                        percentage: "%",
                        permille: "‰",
                        basisPoint: "‱",
                    },
                    symbolWhenUnfocused: {
                        none: null,
                        percentage: "%",
                        permille: "‰",
                        basisPoint: "‱",
                    },
                    unformatOnHover: { unformat: !0, doNotUnformat: !1 },
                    unformatOnSubmit: { unformat: !0, keepCurrentValue: !1 },
                    upDownStep: { progressive: "progressive" },
                    valuesToStrings: {
                        none: null,
                        zeroDash: { 0: "-" },
                        oneAroundZero: { "-1": "Min", 1: "Max" },
                    },
                    watchExternalChanges: { watch: !0, doNotWatch: !1 },
                    wheelOn: { focus: "focus", hover: "hover" },
                    wheelStep: { progressive: "progressive" },
                }),
                (I = M.options),
                Object.getOwnPropertyNames(I).forEach(function (e) {
                    "valuesToStrings" === e
                        ? Object.getOwnPropertyNames(I.valuesToStrings).forEach(
                              function (e) {
                                  h.isIE11() ||
                                      null === I.valuesToStrings[e] ||
                                      Object.freeze(I.valuesToStrings[e]);
                              }
                          )
                        : "styleRules" !== e &&
                          (h.isIE11() || null === I[e] || Object.freeze(I[e]));
                }),
                Object.freeze(I),
                Object.defineProperty(M, "options", {
                    configurable: !1,
                    writable: !1,
                }),
                (M.defaultSettings = {
                    allowDecimalPadding: M.options.allowDecimalPadding.always,
                    alwaysAllowDecimalCharacter:
                        M.options.alwaysAllowDecimalCharacter.doNotAllow,
                    caretPositionOnFocus:
                        M.options.caretPositionOnFocus.doNoForceCaretPosition,
                    createLocalList: M.options.createLocalList.createList,
                    currencySymbol: M.options.currencySymbol.none,
                    currencySymbolPlacement:
                        M.options.currencySymbolPlacement.prefix,
                    decimalCharacter: M.options.decimalCharacter.dot,
                    decimalCharacterAlternative:
                        M.options.decimalCharacterAlternative.none,
                    decimalPlaces: M.options.decimalPlaces.two,
                    decimalPlacesRawValue:
                        M.options.decimalPlacesRawValue.useDefault,
                    decimalPlacesShownOnBlur:
                        M.options.decimalPlacesShownOnBlur.useDefault,
                    decimalPlacesShownOnFocus:
                        M.options.decimalPlacesShownOnFocus.useDefault,
                    defaultValueOverride:
                        M.options.defaultValueOverride.doNotOverride,
                    digitalGroupSpacing: M.options.digitalGroupSpacing.three,
                    digitGroupSeparator: M.options.digitGroupSeparator.comma,
                    divisorWhenUnfocused: M.options.divisorWhenUnfocused.none,
                    emptyInputBehavior: M.options.emptyInputBehavior.focus,
                    eventBubbles: M.options.eventBubbles.bubbles,
                    eventIsCancelable: M.options.eventIsCancelable.isCancelable,
                    failOnUnknownOption: M.options.failOnUnknownOption.ignore,
                    formatOnPageLoad: M.options.formatOnPageLoad.format,
                    formulaMode: M.options.formulaMode.disabled,
                    historySize: M.options.historySize.medium,
                    invalidClass: M.options.invalidClass,
                    isCancellable: M.options.isCancellable.cancellable,
                    leadingZero: M.options.leadingZero.deny,
                    maximumValue: M.options.maximumValue.tenTrillions,
                    minimumValue: M.options.minimumValue.tenTrillions,
                    modifyValueOnUpDownArrow:
                        M.options.modifyValueOnUpDownArrow.modifyValue,
                    modifyValueOnWheel:
                        M.options.modifyValueOnWheel.modifyValue,
                    negativeBracketsTypeOnBlur:
                        M.options.negativeBracketsTypeOnBlur.none,
                    negativePositiveSignPlacement:
                        M.options.negativePositiveSignPlacement.none,
                    negativeSignCharacter:
                        M.options.negativeSignCharacter.hyphen,
                    negativePositiveSignBehavior:
                        M.options.negativePositiveSignBehavior.doNotToggle,
                    noEventListeners: M.options.noEventListeners.addEvents,
                    onInvalidPaste: M.options.onInvalidPaste.error,
                    outputFormat: M.options.outputFormat.none,
                    overrideMinMaxLimits:
                        M.options.overrideMinMaxLimits.doNotOverride,
                    positiveSignCharacter: M.options.positiveSignCharacter.plus,
                    rawValueDivisor: M.options.rawValueDivisor.none,
                    readOnly: M.options.readOnly.readWrite,
                    roundingMethod: M.options.roundingMethod.halfUpSymmetric,
                    saveValueToSessionStorage:
                        M.options.saveValueToSessionStorage.doNotSave,
                    selectNumberOnly:
                        M.options.selectNumberOnly.selectNumbersOnly,
                    selectOnFocus: M.options.selectOnFocus.select,
                    serializeSpaces: M.options.serializeSpaces.plus,
                    showOnlyNumbersOnFocus:
                        M.options.showOnlyNumbersOnFocus.showAll,
                    showPositiveSign: M.options.showPositiveSign.hide,
                    showWarnings: M.options.showWarnings.show,
                    styleRules: M.options.styleRules.none,
                    suffixText: M.options.suffixText.none,
                    symbolWhenUnfocused: M.options.symbolWhenUnfocused.none,
                    unformatOnHover: M.options.unformatOnHover.unformat,
                    unformatOnSubmit:
                        M.options.unformatOnSubmit.keepCurrentValue,
                    upDownStep: "1",
                    valuesToStrings: M.options.valuesToStrings.none,
                    watchExternalChanges:
                        M.options.watchExternalChanges.doNotWatch,
                    wheelOn: M.options.wheelOn.focus,
                    wheelStep: M.options.wheelStep.progressive,
                }),
                Object.freeze(M.defaultSettings),
                Object.defineProperty(M, "defaultSettings", {
                    configurable: !1,
                    writable: !1,
                });
            var R = {
                    digitGroupSeparator: M.options.digitGroupSeparator.dot,
                    decimalCharacter: M.options.decimalCharacter.comma,
                    decimalCharacterAlternative:
                        M.options.decimalCharacterAlternative.dot,
                    currencySymbol: " €",
                    currencySymbolPlacement:
                        M.options.currencySymbolPlacement.suffix,
                    negativePositiveSignPlacement:
                        M.options.negativePositiveSignPlacement.prefix,
                },
                U = {
                    digitGroupSeparator: M.options.digitGroupSeparator.comma,
                    decimalCharacter: M.options.decimalCharacter.dot,
                    currencySymbol: M.options.currencySymbol.dollar,
                    currencySymbolPlacement:
                        M.options.currencySymbolPlacement.prefix,
                    negativePositiveSignPlacement:
                        M.options.negativePositiveSignPlacement.right,
                },
                j = {
                    digitGroupSeparator: M.options.digitGroupSeparator.comma,
                    decimalCharacter: M.options.decimalCharacter.dot,
                    currencySymbol: M.options.currencySymbol.yen,
                    currencySymbolPlacement:
                        M.options.currencySymbolPlacement.prefix,
                    negativePositiveSignPlacement:
                        M.options.negativePositiveSignPlacement.right,
                };
            h.cloneObject(R).formulaMode = M.options.formulaMode.enabled;
            var K = h.cloneObject(R);
            K.minimumValue = 0;
            var z = h.cloneObject(R);
            (z.maximumValue = 0),
                (z.negativePositiveSignPlacement =
                    M.options.negativePositiveSignPlacement.prefix);
            var G = h.cloneObject(R);
            G.digitGroupSeparator = M.options.digitGroupSeparator.normalSpace;
            var W = h.cloneObject(G);
            W.minimumValue = 0;
            var H = h.cloneObject(G);
            (H.maximumValue = 0),
                (H.negativePositiveSignPlacement =
                    M.options.negativePositiveSignPlacement.prefix);
            var Z = h.cloneObject(R);
            (Z.currencySymbol = M.options.currencySymbol.none),
                (Z.suffixText = " ".concat(M.options.suffixText.percentage)),
                (Z.wheelStep = 1e-4),
                (Z.rawValueDivisor = M.options.rawValueDivisor.percentage);
            var q = h.cloneObject(Z);
            q.minimumValue = 0;
            var $ = h.cloneObject(Z);
            ($.maximumValue = 0),
                ($.negativePositiveSignPlacement =
                    M.options.negativePositiveSignPlacement.prefix);
            var J = h.cloneObject(Z);
            J.decimalPlaces = 3;
            var Y = h.cloneObject(q);
            Y.decimalPlaces = 3;
            var Q = h.cloneObject($);
            (Q.decimalPlaces = 3),
                (h.cloneObject(U).formulaMode = M.options.formulaMode.enabled);
            var X = h.cloneObject(U);
            X.minimumValue = 0;
            var ee = h.cloneObject(U);
            (ee.maximumValue = 0),
                (ee.negativePositiveSignPlacement =
                    M.options.negativePositiveSignPlacement.prefix);
            var te = h.cloneObject(ee);
            te.negativeBracketsTypeOnBlur =
                M.options.negativeBracketsTypeOnBlur.parentheses;
            var ie = h.cloneObject(U);
            (ie.currencySymbol = M.options.currencySymbol.none),
                (ie.suffixText = M.options.suffixText.percentage),
                (ie.wheelStep = 1e-4),
                (ie.rawValueDivisor = M.options.rawValueDivisor.percentage);
            var ne = h.cloneObject(ie);
            ne.minimumValue = 0;
            var ae = h.cloneObject(ie);
            (ae.maximumValue = 0),
                (ae.negativePositiveSignPlacement =
                    M.options.negativePositiveSignPlacement.prefix);
            var re = h.cloneObject(ie);
            re.decimalPlaces = 3;
            var oe = h.cloneObject(ne);
            oe.decimalPlaces = 3;
            var se = h.cloneObject(ae);
            se.decimalPlaces = 3;
            var le = h.cloneObject(R);
            (le.currencySymbol = M.options.currencySymbol.lira),
                (M.predefinedOptions = {
                    euro: R,
                    euroPos: K,
                    euroNeg: z,
                    euroSpace: G,
                    euroSpacePos: W,
                    euroSpaceNeg: H,
                    percentageEU2dec: Z,
                    percentageEU2decPos: q,
                    percentageEU2decNeg: $,
                    percentageEU3dec: J,
                    percentageEU3decPos: Y,
                    percentageEU3decNeg: Q,
                    dollar: U,
                    dollarPos: X,
                    dollarNeg: ee,
                    dollarNegBrackets: te,
                    percentageUS2dec: ie,
                    percentageUS2decPos: ne,
                    percentageUS2decNeg: ae,
                    percentageUS3dec: re,
                    percentageUS3decPos: oe,
                    percentageUS3decNeg: se,
                    French: R,
                    Spanish: R,
                    NorthAmerican: U,
                    British: {
                        digitGroupSeparator:
                            M.options.digitGroupSeparator.comma,
                        decimalCharacter: M.options.decimalCharacter.dot,
                        currencySymbol: M.options.currencySymbol.pound,
                        currencySymbolPlacement:
                            M.options.currencySymbolPlacement.prefix,
                        negativePositiveSignPlacement:
                            M.options.negativePositiveSignPlacement.right,
                    },
                    Swiss: {
                        digitGroupSeparator:
                            M.options.digitGroupSeparator.apostrophe,
                        decimalCharacter: M.options.decimalCharacter.dot,
                        currencySymbol: " CHF",
                        currencySymbolPlacement:
                            M.options.currencySymbolPlacement.suffix,
                        negativePositiveSignPlacement:
                            M.options.negativePositiveSignPlacement.prefix,
                    },
                    Japanese: j,
                    Chinese: j,
                    Brazilian: {
                        digitGroupSeparator: M.options.digitGroupSeparator.dot,
                        decimalCharacter: M.options.decimalCharacter.comma,
                        currencySymbol: M.options.currencySymbol.real,
                        currencySymbolPlacement:
                            M.options.currencySymbolPlacement.prefix,
                        negativePositiveSignPlacement:
                            M.options.negativePositiveSignPlacement.right,
                    },
                    Turkish: le,
                    dotDecimalCharCommaSeparator: {
                        digitGroupSeparator:
                            M.options.digitGroupSeparator.comma,
                        decimalCharacter: M.options.decimalCharacter.dot,
                    },
                    commaDecimalCharDotSeparator: {
                        digitGroupSeparator: M.options.digitGroupSeparator.dot,
                        decimalCharacter: M.options.decimalCharacter.comma,
                        decimalCharacterAlternative:
                            M.options.decimalCharacterAlternative.dot,
                    },
                    integer: { decimalPlaces: 0 },
                    integerPos: {
                        minimumValue: M.options.minimumValue.zero,
                        decimalPlaces: 0,
                    },
                    integerNeg: {
                        maximumValue: M.options.maximumValue.zero,
                        decimalPlaces: 0,
                    },
                    float: {
                        allowDecimalPadding:
                            M.options.allowDecimalPadding.never,
                    },
                    floatPos: {
                        allowDecimalPadding:
                            M.options.allowDecimalPadding.never,
                        minimumValue: M.options.minimumValue.zero,
                        maximumValue: M.options.maximumValue.tenTrillions,
                    },
                    floatNeg: {
                        allowDecimalPadding:
                            M.options.allowDecimalPadding.never,
                        minimumValue: M.options.minimumValue.tenTrillions,
                        maximumValue: M.options.maximumValue.zero,
                    },
                    numeric: {
                        digitGroupSeparator:
                            M.options.digitGroupSeparator.noSeparator,
                        decimalCharacter: M.options.decimalCharacter.dot,
                        currencySymbol: M.options.currencySymbol.none,
                    },
                    numericPos: {
                        digitGroupSeparator:
                            M.options.digitGroupSeparator.noSeparator,
                        decimalCharacter: M.options.decimalCharacter.dot,
                        currencySymbol: M.options.currencySymbol.none,
                        minimumValue: M.options.minimumValue.zero,
                        maximumValue: M.options.maximumValue.tenTrillions,
                    },
                    numericNeg: {
                        digitGroupSeparator:
                            M.options.digitGroupSeparator.noSeparator,
                        decimalCharacter: M.options.decimalCharacter.dot,
                        currencySymbol: M.options.currencySymbol.none,
                        minimumValue: M.options.minimumValue.tenTrillions,
                        maximumValue: M.options.maximumValue.zero,
                    },
                }),
                Object.getOwnPropertyNames(M.predefinedOptions).forEach(
                    function (e) {
                        Object.freeze(M.predefinedOptions[e]);
                    }
                ),
                Object.freeze(M.predefinedOptions),
                Object.defineProperty(M, "predefinedOptions", {
                    configurable: !1,
                    writable: !1,
                });
            const ue = M;
            return (t = t.default);
        })()),
    "object" == typeof exports && "object" == typeof module
        ? (module.exports = t())
        : "function" == typeof define && define.amd
        ? define([], t)
        : "object" == typeof exports
        ? (exports.AutoNumeric = t())
        : (e.AutoNumeric = t());
//# sourceMappingURL=autoNumeric.min.js.map
