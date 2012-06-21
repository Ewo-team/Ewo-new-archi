
function check_dataBase(url){
    var database_data = {
        'host'  : jQuery('input[name="install.analyze.db.host"]').val(),
        'user'  : jQuery('input[name="install.analyze.db.username"]').val(),
        'pswd'  : jQuery('input[name="install.analyze.db.password"]').val(),
        'base'  : jQuery('input[name="install.analyze.db.base"]').val()
    }
    jQuery.post(url, database_data, function(){
        
    });
}