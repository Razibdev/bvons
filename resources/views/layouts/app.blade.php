<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Scripts -->
    <link rel="stylesheet" href="https://unpkg.com/balloon-css/balloon.min.css">


    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('media/favicons/android-icon-192x192.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

</head>
<body>

    <div  id="app"  data-app >
        @yield('content')

    </div>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

    <script src="{{ mix('js/app.js') }}" defer></script>

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

                // Check if MobileNav was initialized with some options and assign them to the "defaults"
                if (arguments[0] && typeof arguments[0] === "object") {
                    this.options = extendDefaults(defaults, arguments[0]);
                }

                // Add to the "defaults" ONLY if the key is already in the "defaults"
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

                // Init is an anonymous IIFE
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
                            'OTransition': 'otransitionend', // oTransitionEnd in very old Opera
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

                // TODO: Make this DRY (deal with waiting for transitionend event)
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

                // Update main menu title to be the text of the clicked menu item
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

                // Slide the main menu based on current menu depth
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

{{--<script src="{{ asset('/sw.js') }}"></script>--}}

