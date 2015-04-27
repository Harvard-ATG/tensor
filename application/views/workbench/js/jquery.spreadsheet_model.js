(function( $ ) {
	
	var defaults = {
			store: null,
    		mapping: null,
    		source: null,
    		graph: null,
    		content_type: null,
    		proxy: true,
    		proxy_url: null,
    		error_callback: null,
    		complete_callback: null
	};  	
	
    $.fn.spreadsheet_model = function(options) {
    	
    	var self = this;
    	var opts = $.extend( {}, defaults, options );
    	this.opts = opts;
    	
    	this.parse = function() {alert('You need to override spreadsheet_model\'s parse() method!')}; 
    	
        this.fetch = function() {
        	if (!opts.proxy) {
        		alert('Non-proxy ajax requests not supported');
        		return;
        	};
        	$.getJSON(opts.proxy_url, proxy_data(), function( data ) {
        		parse_store_results(data);
        	}).fail(function(jqXHR) {
        		error_callback(jqXHR);
        	});
        };
        
        var proxy_data = function() {
        	return {
        		graph:(opts.graph)?opts.graph:'',
        		store:(opts.store)?opts.store:'',
        		mapping:(opts.mapping)?opts.mapping:'',
        		source:(opts.source)?opts.source:'',
        		content_type:(opts.content_type)?opts.content_type:'',
        		parser:(opts.parser)?opts.parser:''
        	};
        };
        
        var error_callback = function(jqXHR) {
        	opts.error_callback(jqXHR.status+' '+jqXHR.statusText, opts);  	
        };
        
        var parse_store_results = function(data) {
        	if ('undefined'!=typeof(data.error) && data.error.length) {
        		error_callback({status:'Proxy error:',statusText:data.error});
        		return;
        	};
        	self.parse(data, opts);
        }    	

    };
    
}( jQuery ));