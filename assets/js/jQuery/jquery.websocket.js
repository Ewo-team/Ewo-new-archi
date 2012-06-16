var WSPlugin = $.inherit({
    __constructor : function(host, appli, onOpen, onMessage, onClose){
        this.host       = host;
        this.appli      = appli;
        this.socket     = null;
        this.ready      = true;
        
        this.init(onOpen, onMessage, onClose);
    },

    init: function(onOp, onMe, onCl){
        try {
            if('WebSocket' in window) {
                this.socket = new WebSocket(this.host+this.appli);
            } else if('MozWebSocket' in window) {
                this.socket = new MozWebSocket(this.host+this.appli);
            } else {
                this.error('WebSockets not support on this browser');
                return;
            }
        
            this.socket.readyState;
            this.socket.onopen       = function(msg){
                onOp(msg.data);
            };
            this.socket.onmessage    = function(msg){
                onMe(msg.data);
            };
            this.socket.onclose      = function(msg){
                onCl(msg.data);
            };
        } catch(ex) {
        }
    },
    send:function(msg){
        if(this.ready){
            try {
                this.socket.send(JSON.stringify(msg));
            } catch(ex) {
                alert(ex);
            }
        }
        else{
            alert('pas ready');
        }
    },
    quit:function(msg){
        socket.close();
        socket = null;
    }
});


(function($) {
    $.websocketsClient = function(params) {
            
        params = $.extend( {
            host        : '', 
            appli       : '', 
            onOpen      : function(){},
            onMessage   : function(){},
            onClose     : function(){}
        }, params);
        
        return new WSPlugin(params.host, params.appli, params.onOpen, params.onMessage, params.onClose);
    };
})(jQuery);