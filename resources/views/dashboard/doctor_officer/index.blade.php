<html lang="en">
<head>
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <meta charset="utf-8">
    <meta name="csrf-token" content="CPA9KBAJxC38pTQJfm4bMkjCus5avZHuZw3sathS">
    <meta name="viewport" content="width=device-width">
    <title>Bvon Online</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="/js/app.js?id=10c83bdc8ee28537fba7" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">


    <link href="/css/app.css?id=623603622cf4cf4ed17d" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript"></script>

    <style></style>
</head>
<body>

<div  id="app"  data-app >

    <main-app></main-app>


</div>

<script>
    (function($) {
        this.MobileNav = function() {
            this.curItem,
                this.curLevel = 0,
                this.transitionEnd = _getTransitionEndEventName();

            var defaults = {
                initElem: ".main-menu",
                menuTitle: "Menu"
            }


            if (arguments[0] && typeof arguments[0] === "object") {
                this.options = extendDefaults(defaults, arguments[0]);
            }


            function extendDefaults(source, extender) {
                for (option in extender) {
                    if (source.hasOwnProperty(option)) {
                        source[option] = extender[option];
                    }
                }
            }

            MobileNav.prototype.getCurrentItem = function() {
                return this.curItem;
            };

            MobileNav.prototype.setMenuTitle = function(title) {
                defaults.menuTitle = title;
                _updateMenuTitle(this);
                return title;
            };


            (function(MobileNav) {
                var initElem = ($(defaults.initElem).length) ? $(defaults.initElem) : false;

                if (initElem) {
                    defaults.initElem = initElem;
                    _clickHandlers(MobileNav);
                    _updateMenuTitle(MobileNav);
                } else {
                    console.log(defaults.initElem + " element doesn't exist, menu not initialized.");
                }
            }(this));

            function _getTransitionEndEventName() {
                var i,
                    undefined,
                    el = document.createElement('div'),
                    transitions = {
                        'transition': 'transitionend',
                        'OTransition': 'otransitionend',
                        'MozTransition': 'transitionend',
                        'WebkitTransition': 'webkitTransitionEnd'
                    };

                for (i in transitions) {
                    if (transitions.hasOwnProperty(i) && el.style[i] !== undefined) {
                        return transitions[i];
                    }
                }
            };

            function _clickHandlers(menu) {
                defaults.initElem.on('click', '.has-dropdown > a', function(e) {
                    e.preventDefault();
                    menu.curItem = $(this).parent();
                    _updateActiveMenu(menu);
                });

                defaults.initElem.on('click', '.nav-toggle', function() {
                    _updateActiveMenu(menu, 'back');
                });
            };


            function _updateActiveMenu(menu, direction) {
                _slideMenu(menu, direction);
                if (direction === "back") {


                    menu.curItem.removeClass('nav-dropdown-open nav-dropdown-active');
                    menu.curItem = menu.curItem.parent().closest('li');
                    menu.curItem.addClass('nav-dropdown-open nav-dropdown-active');
                    _updateMenuTitle(menu);
                } else {
                    menu.curItem.addClass('nav-dropdown-open nav-dropdown-active');
                    _updateMenuTitle(menu);
                }
            };


            function _updateMenuTitle(menu) {
                var title = defaults.menuTitle;
                if (menu.curLevel > 0) {
                    title = menu.curItem.children('a').text();
                    defaults.initElem.find('.nav-toggle').addClass('back-visible');
                } else {
                    defaults.initElem.find('.nav-toggle').removeClass('back-visible');
                }
                $('.nav-title').text(title);
            };


            function _slideMenu(menu, direction) {
                if (direction === "back") {
                    menu.curLevel = (menu.curLevel > 0) ? menu.curLevel - 1 : 0;
                } else {
                    menu.curLevel += 1;
                }
                defaults.initElem.children('ul').css({
                    "transform": "translateX(-" + (menu.curLevel * 100) + "%)"
                });
            };
        }
    }(jQuery));

    $(document).ready(function() {
        var MobileMenu = new MobileNav({
            initElem: "nav",
            menuTitle: "Category",
        });

        $('.js-nav-toggle').on('click', function(e) {
            e.preventDefault();

            $('.nav-wrapper').toggleClass('show-menu');
        });
    });

</script>


</body>


</html>
