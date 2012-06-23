

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
    var errors = new Array();
    var valid = 0;
    var nb = 1;
    jQuery.each(tests, function(testName, testUrl){
        var params = eval(testName+'GetData()');
        jQuery('.'+testName+'-error').removeClass('icon-warning-sign');
        jQuery.ajax({
            url : testUrl,
            type : 'POST',
            data : params,
            async: false,
            success : function(){
                valid++;
            },
            error : function(xhr){
                var jsonData = jQuery.parseJSON(xhr.responseText);
                if(jsonData && jsonData.message){
                    errors[testName+'-error'] =jsonData.message;
                }
            },
            complete : function(){
                if(nb++ == nbTest){
                    analyzeComplete(errors, valid, delta);
                }
            }
        });
    });
}

function analyzeComplete(errors, valid, delta){
    jQuery("#check_progress").animate({
            value: valid*delta
        },
        {
        step: function() {
            jQuery('#check_progress').trigger('change');
        },
        duration : 'slow'
    });
    
    var errors_output = '';
    jQuery.each(errors, function(errorClass, errorMsg){
        errors_output += '<li>'+errorMsg+'</li>';
        jQuery('.'+errorClass).addClass('icon-warning-sign');
    });
    if(errors_output != ''){
        jQuery('.error').html('<ul>'+errors_output+'</ul>').addClass('alert alert-error').alert();
        jQuery('.error').alert();
    }
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