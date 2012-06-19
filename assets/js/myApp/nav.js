
function installNav(jsonData){
    jQuery('#installProgress').css('width',jsonData.progress+"%");
    var i = 0;
    jQuery('#installProgressLabels span').each(function(){
        jQuery(this).removeClass('label-success')
        if(jsonData.step > i++)
            jQuery(this).addClass('label-success');
    });
    return jsonData.content;
}


