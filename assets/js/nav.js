var nav_base_url;

function nav_init(base_url){
    nav_base_url = base_url;
    window.addEventListener('popstate', function(event) {
        if(event && event.state)
            loadContent(event.state.path, event.state.htmlTarget, event.state.callback, event.state.callbackError);
    });
}
/**
 * 
 */
function anchor_intern(uri, target, callback, callbackError){
    if(uri.charAt(uri.length) != '/')
        uri += '/';
    navig_load(uri, target, callback);
}


function navig_load(uri, target, callback, callbackError){
    //set loading icon
    loadContent(uri, target, callback, callbackError);
    
    if (history && history.pushState) {
        var historyData = {
                'path'          : uri,
                'htmlTarget'    : target,
                'callback'      : callback,
                'callbackError' : callbackError
            };
        history.pushState(historyData, document.title, uri);
    }
    else
        window.location.replace(uri);
}

function loadContent(uri, target, callback, callbackError){
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
        jQuery(target).html(data);
    });
}