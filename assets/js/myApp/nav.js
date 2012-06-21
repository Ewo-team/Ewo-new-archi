
function installNav(jsonData){
    jQuery('#installProgress').css('width',jsonData.progress+"%");
    var i = 0;
    jQuery('#installProgressLabels span').each(function(){
        jQuery(this).removeClass('label-success');
        jQuery(this).removeClass('label-info');
        if(jsonData.step > i)
            jQuery(this).addClass('label-success');
        else if(jsonData.step == i)
            jQuery(this).addClass('label-info');
        i++;
    });
    return jsonData.content;
}
