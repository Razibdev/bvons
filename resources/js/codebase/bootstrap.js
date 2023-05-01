 // Import all vital core JS files..
import jQuery from 'jquery';
import _ from 'lodash';
import axios from 'axios';
import SimpleBar from 'simplebar';
import Cookies from 'js-cookie';
import 'bootstrap';
import 'popper.js';
import 'jquery.appear';
import 'jquery-scroll-lock';
import 'jquery-countto';


function convertHTML (str) {
     let regex = /[&|<|>|"|']/g;
     let htmlString = str.replace(regex, function(match){
         if(match === "&"){
             return "&amp;";
         }else if(match === "<"){
             return "&lt;"
         }else if(match === ">"){
             return "&gt;";
         }else if(match === '"'){
             return "&quot;";
         }else{
             return "&apos;";
         }
     });
     return htmlString;
 }

// ..and assign to window the ones that need it
window.$ = window.jQuery    = jQuery;
window.SimpleBar            = SimpleBar;
window.Cookies              = Cookies;
window.axios                = axios;
window.convertHTML         = convertHTML;




window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


 /**
  * Echo exposes an expressive API for subscribing to channels and listening
  * for events that are broadcast by Laravel. Echo and event broadcasting
  * allows your team to easily build robust real-time web applications.
  */

 // import Echo from 'laravel-echo';

 // window.Pusher = require('pusher-js');

 // window.Echo = new Echo({
 //     broadcaster: 'pusher',
 //     key: process.env.MIX_PUSHER_APP_KEY,
 //     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
 //     encrypted: true
 // });

