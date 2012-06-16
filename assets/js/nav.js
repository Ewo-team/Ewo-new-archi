var nav_base_url;

function nav_init(base_url){
    nav_base_url = base_url;
}

function anchor_intern(uri, target){
    if(uri.charAt(uri.length) != '/')
        uri += '/';
    navig_load(uri, target);
}

$(window).bind('popstate', function(event) {
    // if the event has our history data on it, load the page fragment with AJAX
    var state = event.originalEvent.state;
    if (state) {
         navig_load(state.path);
    }
});


function navig_load(uri, target){
    $.get(uri, function(data) {
        if(data == 'errorLog'){
            anchor_intern(nav_base_url+'/error/ajax');
            return;
        }
        
        if (history && history.pushState) {
          history.pushState({path:uri}, document.title, uri);
        }
        $(target).html(data);
    });
}