/**
 * Created by huytt on 7/13/2016.
 */

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $BOL = true,
    $FOOTER = $('footer');

var setContentHeight = function (height) {
    // reset height
    //$RIGHT_COL.css('min-height', $(window).height());
    // height = content's height + nav's height + footer's height + sum of (padding-top, padding-bottom)
    if(height == undefined) {
        height = $('#page-content').height() + 57 + 49 + 20;
    } else {
        height += 57 + 49 + 20;
    }

    if(height < $(window).height()){
        height = $(window).height()
    }

    $RIGHT_COL.css('min-height', height);

    var bodyHeight = $BODY.outerHeight(),
        footerHeight = $BODY.hasClass('footer_fixed') ? 0 : $FOOTER.height(),
        leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
        contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

    // normalize content
    contentHeight -= $NAV_MENU.height() + footerHeight;

    $RIGHT_COL.css('min-height', contentHeight);
};
BillingSystem = {}

UTIL = {

    fire : function(func,funcname, args){

        var namespace = BillingSystem;  // indicate your obj literal namespace here

        funcname = (funcname === undefined) ? 'init' : funcname;
        if (func !== '' && namespace[func] && typeof namespace[func][funcname] == 'function'){
            namespace[func][funcname](args);
        }

    },

    loadEvents : function(){

        var bodyId = document.body.id;
        var role = $RIGHT_COL.attr('role');

        //alert(UTIL.fire('common','iCheck'));

        $.getScript('/js/common.js',function( data, textStatus, jqxhr){
            // hit up common first.
            UTIL.fire('common');
            //load screen js inside load common.js callback to make sure both working
            $.getScript('/js/'+bodyId.toLowerCase()+'.js',function( data, textStatus, jqxhr){
                UTIL.fire(bodyId);
                UTIL.fire(bodyId, role);
            });
        });

        // do all the classes too.
        //$.each(document.body.className.split(/\s+/),function(i, role){
        //    //UTIL.fire(classnm);
        //    //UTIL.fire(classnm,bodyId);
        //    UTIL.fire(bodyId);
        //    UTIL.fire(bodyId, role);
        //});

        UTIL.fire('common','finalize');

    }

};

// kick it all off here
$(document).ready(UTIL.loadEvents);
if($('#env_debug').val() == 1){
  jQuery.extend({
    getScript: function(url, callback) {
      var body = document.getElementsByTagName("body")[0];
      var script = document.createElement("script");
      script.src = url;

      // Handle Script loading
      {
         var done = false;

         // Attach handlers for all browsers
         script.onload = script.onreadystatechange = function(){
            if ( !done && (!this.readyState ||
                  this.readyState == "loaded" || this.readyState == "complete") ) {
               done = true;
               if (callback)
                  callback();

               // Handle memory leak in IE
               script.onload = script.onreadystatechange = null;
            }
         };
      }

      body.appendChild(script);

      // We handle everything using the script element injection
      return undefined;
    }
  });
}
