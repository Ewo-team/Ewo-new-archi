
/**
 * Change la langue pour l'instal
 */
function installSelectLanguageInstall(uri, id){
    var lang = jQuery('#'+id).val();
    if(lang != ''){
    uri = uri+'/'+lang;
        anchor_intern(uri, '#installContent', 'installNav');
        //alert(uri);
    }
}

/**
 * fait l'analyse générale
 */
function launchAnalyze(tests){  
    jQuery('#check_progress').val('0');
    var nbTest = 0;
    jQuery.each(tests, function(v1, v2){
        nbTest++;
    });
    var delta = 100 / nbTest;
    var errors = {};
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
                    //jQuery.extend(errors, {testName+'-error' : jsonData.message});
                    errors[testName+'-error'] = jsonData.message;
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

/**
 * call back lorsque que l'analyse est finie
 */
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
        jQuery('.error').html('<div class="alert alert-error fade in out"><ul>'+errors_output+'</ul></div>').alert();
    }
    else
        jQuery('.error > div').alert('close');
}

/**
 * données à envoyer pour l'environement
 */
function envGetData(){
    return {
        'env'  : jQuery('input[name="install.analyze.env"]').val()
    };
}

/**
 * données à envoyer pour la langue
 */
function langGetData(){
    return {
        'lang'  : jQuery('input[name="install.analyze.lang"]').val()
    };
}

/**
 * données à envoyer pour la bdd
 */
function dbGetData(){
    return {
        'host'  : jQuery('input[name="install.analyze.db.host"]').val(),
        'user'  : jQuery('input[name="install.analyze.db.username"]').val(),
        'pswd'  : jQuery('input[name="install.analyze.db.password"]').val(),
        'base'  : jQuery('input[name="install.analyze.db.base"]').val()
    };
}

/**
 * Lance la créations des tables
 */
function createTables(){
    jQuery('#installDb .label-important').each(function(id, element){
        alert(jQuery.trim(jQuery(this).text()));
    });
}