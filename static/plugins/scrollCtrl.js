// 作者：檬一
// 链接：https://www.zhihu.com/question/21865401/answer/21893253
// 来源：知乎
;!function () {
    var keys = {37: 1, 38: 1, 39: 1, 40: 1};

    function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;
    }

    function preventDefaultForScrollKeys(e) {
        if (keys[e.keyCode]) {
            preventDefault(e);
            return false;
        }
    }

    var oldonwheel, oldonmousewheel1, oldonmousewheel2, oldontouchmove, oldonkeydown
        , isDisabled;

    function disableScroll() {
        if (window.addEventListener) // older FF
            window.addEventListener('DOMMouseScroll', preventDefault, false);
        oldonwheel = window.onwheel;
        window.onwheel = preventDefault; // modern standard

        oldonmousewheel1 = window.onmousewheel;
        window.onmousewheel = preventDefault; // older browsers, IE
        oldonmousewheel2 = document.onmousewheel;
        document.onmousewheel = preventDefault; // older browsers, IE

        oldontouchmove = window.ontouchmove;
        window.ontouchmove = preventDefault; // mobile

        oldonkeydown = document.onkeydown;
        document.onkeydown = preventDefaultForScrollKeys;
        isDisabled = true;
    }

    function enableScroll() {
        if (!isDisabled) return;
        if (window.removeEventListener)
            window.removeEventListener('DOMMouseScroll', preventDefault, false);

        window.onwheel = oldonwheel; // modern standard

        window.onmousewheel = oldonmousewheel1; // older browsers, IE
        document.onmousewheel = oldonmousewheel2; // older browsers, IE

        window.ontouchmove = oldontouchmove; // mobile

        document.onkeydown = oldonkeydown;
        isDisabled = false;
    }

    window.scrollHanlder = {
        disableScroll: disableScroll,
        enableScroll: enableScroll
    };
}();