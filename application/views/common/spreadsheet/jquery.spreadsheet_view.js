(function( $ ) {
	
	var defaults = {
			namespaces: {
					'rdf':'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
			    	'rdfs':'http://www.w3.org/2000/01/rdf-schema#',
					'dc':'http://purl.org/dc/elements/1.1/',
					'dcterms':'http://purl.org/dc/terms/',
					'ctag':'http://commontag.org/ns#',
					'art':'http://simile.mit.edu/2003/10/ontologies/artstor#',
					'sioc':'http://rdfs.org/sioc/ns#',
					'sioctypes':'http://rdfs.org/sioc/types#',
					'foaf':'http://xmlns.com/foaf/0.1/',
					'owl':'http://www.w3.org/2002/07/owl#',
					'ov':'http://open.vocab.org/terms/',
					'oac':'http://www.openannotation.org/ns/',
					'scalar':'http://scalar.usc.edu/2012/01/scalar-ns#',
					'shoah':'http://tempuri.org/'
			},
			rows: null,
			default_num_predicates: 4,
			do_create_table: false,
			do_create_header: false
	};  	
	var opts = {};
	var predicates = [];
	var $self = null;
	
	$.fn.spreadsheet_create = function(options) {
		opts = $.extend( {}, defaults, options );
		namespaces_reversed();
		$self = this;
		do_create_table();
		do_create_header();
	}
	
    $.fn.spreadsheet_view = function(options) {
    	opts = $.extend( {}, defaults, options );
    	namespaces_reversed();
    	$self = this;
        if (opts.do_create_table) do_create_table();
        if (opts.do_create_header) do_create_header();
        do_create_cells();
        return $self;
    };
    
    function namespaces_reversed() {
    	opts.namespaces_reversed = {};
    	$.each(opts.namespaces, function(key, value) {
    		opts.namespaces_reversed[value] = key; 
    	});    	
    }
    
    function do_create_table() {
    	$self.empty();
    	$('<table class="table table-hover table-condensed"></table>').appendTo($self);
    }
    
    function do_create_header() {
    	var $table = $self.find('table');
    	var $head = $('<thead><tr></tr></thead>').prependTo($table);
    	var $row = $head.find('tr');
    	var to_display = predicates_to_display();
    	$('<th><input type="checkbox" id="checkall" />rdf:resource</th>').appendTo($row);
    	for (var j in to_display) {
    		var $cell = $('<th>'+pnode(to_display[j])+'</th>').appendTo($row);
    	}
    	$('<th><big><a href="javascript:void(null)" data-toggle="modal" data-target="#column_select">+/-</a></big></th>').appendTo($row);
    }
    
    function do_create_cells() {
    	var $table = $self.find('table');
    	var $body = $('<tbody></tbody>').appendTo($table);
    	var to_display = predicates_to_display();
    	for (var j in opts.rows) {
    		var $row = $('<tr></tr>').appendTo($body);
    		$('<td><div><input type="checkbox" /><a target="_blank" href="'+j+'" title="'+j+'">'+basename(j)+'</a></div></td>').appendTo($row);
    		for (var k in to_display) {
    			var value = ('undefined'!=typeof(opts.rows[j][to_display[k]])) ? opts.rows[j][to_display[k]][0].value : '';
    			value = value.linkify();
    			$('<td><div>'+value+'</div></td>').appendTo($row);
    		}
    	}
    }
    
    function predicates_to_display(arr) {
    	return [
   		     'http://purl.org/dc/terms/title',
		     'http://purl.org/dc/terms/description',
		     'http://purl.org/dc/terms/contributor'
    	       ];
    }
    
    function _predicates_to_display(arr) {
    	var privileged_predicates = [
    	                		     'http://purl.org/dc/terms/title',
    	                		     'http://purl.org/dc/terms/description',
    	                		     'http://purl.org/dc/terms/contributor'
    	                		    ];    
    	predicates = [];
    	for (var j in opts.rows) {
    		for (var k in opts.rows[j]) {
    			if (-1==predicates.indexOf(k)) predicates.push(k);
    		}
    	}  
    	var arr = [];
    	for (var j in privileged_predicates) {
    		if (-1!=predicates.indexOf(privileged_predicates[j])) arr.push(privileged_predicates[j]);
    	}
    	arr = arr.slice(0,5);
    	var to_add = opts.default_num_predicates - arr.length;
    	if (to_add < 0) to_add = 0;
    	var diff = $(predicates).not(arr).get();
    	arr = arr.concat(diff.slice(0,to_add));
    	return arr;
    }
    
    function pnode(str) {
    	for (var j in opts.namespaces_reversed) {
    		if (-1==str.indexOf(j)) continue;
    		str = str.replace(j, opts.namespaces_reversed[j]+':');
    		return str;
    	}
    }
    
    // http://phpjs.org/functions/basename/
    function basename(path, suffix) {
    	var b = path;
    	var lastChar = b.charAt(b.length - 1);
    	if (lastChar === '/' || lastChar === '\\') {
    		b = b.slice(0, -1);
    	}
    	b = b.replace(/^.*[\/\\]/g, '');
    	if (typeof suffix === 'string' && b.substr(b.length - suffix.length) == suffix) {
    		b = b.substr(0, b.length - suffix.length);
    	}
    	return b;
    }
    
}( jQuery ));