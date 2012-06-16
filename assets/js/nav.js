var nav_base_url;

function nav_init(base_url){
    nav_base_url = base_url;
}
/**
 * 
 */
function anchor_intern(uri, target, callback, callbackError){
    if(uri.charAt(uri.length) != '/')
        uri += '/';
    navig_load(uri, target, callback);
}

jQuery(window).bind('popstate', function(event) {
    // if the event has our history data on it, load the page fragment with AJAX
    var state = event.originalEvent.state;
    if (state) {
         navig_load(state.path);
    }
});


function navig_load(uri, target, callback, callbackError){
    //set loading icon
    var textAlign = jQuery(target).css('text-align');
    jQuery(target).css('text-align','center');
    jQuery(target).html('<img src="'+nav_base_url+'/assets/img/ajax-loader.gif" style="text-align:auto;" />');
    
    jQuery.get(uri, function(data) {
        //reset text-align
        jQuery(target).css('text-align',textAlign);
        if(data == 'errorLog'){
            if(callbackError != undefined)
                eval(callbackError+'();');
            anchor_intern(nav_base_url+'/error/ajax');
            return;
        }
        
        if(callback != undefined){
            data = eval(callback+'(data);');
        }
        if (history && history.pushState) {
          history.pushState({path:uri}, document.title, uri);
        }
        jQuery(target).html(data);
    });
}