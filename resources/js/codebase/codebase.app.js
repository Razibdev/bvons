/*
 *  Document   : app.js
 *  Author     : pixelcave
 *  Description: Main entry point
 *
 */

// Import global dependencies
import './bootstrap';

// Import required modules
import Tools from './modules/tools';
import Helpers from './modules/helpers';
import Template from './modules/template';


// App extends Template
class CodebaseApp extends Template {
    /*
     * Auto called when creating a new instance
     *
     */
    constructor() {
        super();
    }

    /*
     *  Here you can override or extend any function you want from Template class
     *  if you would like to change/extend/remove the default functionality.
     *
     *  This way it will be easier for you to update the module files if a new update
     *  is released since all your changes will be in here overriding the original ones.
     *
     *  Let's have a look at the _uiInit() function, the one that runs the first time
     *  we create an instance of Template class or App class which extends it. This function
     *  inits all vital functionality but you can change it to fit your own needs.
     *
     */

    /*
     * EXAMPLE #1 - Removing default functionality by making it empty
     *
     */

    //  _uiInit() {}


    /*
     * EXAMPLE #2 - Extending default functionality with additional code
     *
     */

    //  _uiInit() {
    //      // Call original function
    //      super._uiInit();
    //
    //      // Your extra JS code afterwards
    //  }

    /*
     * EXAMPLE #3 - Replacing default functionality by writing your own code
     *
     */

    //  _uiInit() {
    //      // Your own JS code without ever calling the original function's code
    //  }
}

// Once everything is loaded
window.Codebase = new CodebaseApp();


jQuery(function () {
    Codebase.helpers(['slimscroll', 'slick', 'select2']);

    $('.cu-popover').popover({
        container: 'body',
        trigger: 'hover'
    });
    $('body').on('mouseover', '.cu-popover', function(e){
        $('.cu-popover').popover({
            container: 'body',
            trigger: 'hover'
        });
    })
    $("#vue-el").on('focus', '#colorPicker', function(e){
        $(this).colorpicker({
            container: true,
            // autoInputFallback: false,
            fallbackColor: '#000000',
            format: 'hex',
            popover: {
                title: 'Adjust the color',
                placement: 'right',
            }
        }).on('colorpickerChange colorpickerCreate', function (e) {
            $($(this).siblings('.color-preview')).css('background', e.color);
        });

    });

});




