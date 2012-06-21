

function installSelectLanguageInstall(uri, id){
    var lang = jQuery('#'+id).val();
    if(lang != ''){
    uri = uri+'/'+lang;
        anchor_intern(uri, '#installContent', 'installNav');
        //alert(uri);
    }
}

function launchAnalyze(tests){ 
    jQuery('#check_progress').val('0');
    var nbTest = 0;
    jQuery.each(tests, function(v1, v2){
        nbTest++;
    });
    var delta = 100 / nbTest;
    
    jQuery.each(tests, function(testName, testUrl){
        var params = eval(testName+'GetData()');
        jQuery.ajax({
            url : testUrl,
            type : 'POST',
            data : params,
            async: false,
            success : function(data){
                jQuery("#check_progress").attr('data-readOnly','false');
                jQuery('#check_progress').val(parseFloat(jQuery('#check_progress').val()) + delta); 
                jQuery('#check_progress').trigger('change');
                jQuery("#check_progress").attr('data-readOnly','true');
            },
            error : function(xhr){
                var jsonData = jQuery.parseJSON(xhr.responseText);
                if(jsonData && jsonData.message){
                    jQuery('.error').html(jsonData.message).addClass('alert alert-error').alert();
                    jQuery('.error').alert();
                }
            }
        });
    });
}

function langGetData(){
    return {
        'lang'  : jQuery('input[name="install.analyze.lang"]').val()
    };
}

function dbGetData(){
    return {
        'host'  : jQuery('input[name="install.analyze.db.host"]').val(),
        'user'  : jQuery('input[name="install.analyze.db.username"]').val(),
        'pswd'  : jQuery('input[name="install.analyze.db.password"]').val(),
        'base'  : jQuery('input[name="install.analyze.db.base"]').val()
    };
}