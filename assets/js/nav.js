var nav_base_url;
var first_load      = true;
var need_to_store   = false;

function nav_init(base_url, target){
    nav_base_url = base_url;
    window.addEventListener('popstate', function(event) {
        if(first_load){
            first_load      = false;
            need_to_store   = true;
            return;
        }
        if(event && event.state)
            loadContent(event.state.path, event.state.htmlTarget, event.state.callback, event.state.callbackError);
        else{
            var l = window.location.pathname;
            loadContent(l, target, null, null);
        }
    });
}
/**
 * 
 */
function anchor_intern(uri, target, callback, callbackError){
    if(uri.charAt(uri.length) != '/')
        uri += '/';
    if( need_to_store ){
        if (history && history.pushState && callback) {
            var historyData = {
                    'path'          : window.location.href,
                    'htmlTarget'    : target,
                    'callback'      : callback,
                    'callbackError' : callbackError
                };
                
            history.replaceState(historyData, document.title, window.location.href);
        }
        need_to_store = false;
    }
    navig_load(uri, target, callback, callbackError);
}


function navig_load(uri, target, callback, callbackError){
    //set loading icon
    loadContent(uri, target, callback, callbackError);
    addState(uri, target, callback, callbackError);
}

function addState(uri, target, callback, callbackError){
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
        var jsonData = jQuery.parseJSON(data);
        var content = jsonData.content;
        jQuery(target).css('text-align',textAlign);
        if(data == 'errorLog'){
            if(callbackError != undefined)
                eval(callbackError+'();');
            anchor_intern(nav_base_url+'/error/ajax');
            return;
        }
        
        if(callback != undefined){
            content = eval(callback+'(jsonData);');
        }
        
        jQuery(target).html(content);
        
        if(jsonData.onload){
            jQuery(target).append(jsonData.onload);
        }
    });
}