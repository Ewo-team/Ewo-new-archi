function installNav(data){
    var jsonData = jQuery.parseJSON(data);
    jQuery('#installProgress').css('width',jsonData.progress+"%");
    return jsonData.content;
}


