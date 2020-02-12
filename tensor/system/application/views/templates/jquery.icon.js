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
					'shoah':'http://tempuri.org/',
					'prov':'http://www.w3.org/ns/prov#',
					'exif':'http://ns.adobe.com/exif/1.0/',
					'iptc':'http://ns.exiftool.ca/IPTC/IPTC/1.0/',
					'bibo':'http://purl.org/ontology/bibo/',
					'id3':'http://id3.org/id3v2.4.0#',
					'dwc':'http://rs.tdwg.org/dwc/terms/',
					'vra':'http://purl.org/vra/',
					'cp':'http://scalar.cdla.oxycreates.org/commonplace/terms/',
					'tk':'http://localcontexts.org/tk/'  /* Temp */
			},
			rows: null,
			check: [],
			num_archives: 0,
			checkable: true,
			msg:''
	};  	
	var opts = {};
	var predicates = [];
	var $self = null;
	
    $.fn.spreadsheet_view = function(options) {
    	opts = $.extend( {}, defaults, options );
    	namespaces_reversed();
    	$self = this;
        do_create_icons();
        return $self;
    };
    
    $.fn.spreadsheet_view.remove = function() {}     
    
    function namespaces_reversed() {
    	opts.namespaces_reversed = {};
    	$.each(opts.namespaces, function(key, value) {
    		opts.namespaces_reversed[value] = key; 
    	});    	
    }
    
    function do_create_icons() {
    	$self.children(':not(.spreadsheet_panel)').remove();
    	$self.children('.spreadsheet_panel').hide();
    	var $wrapper = $('<div class="container-fluid icons"></div>').appendTo($self);
    	var num_rows = $.map(opts.rows, function(n, i) { return i; }).length;
    	if (!num_rows) $self.html(opts.msg);
    	if (opts.checkable) {
	    	$wrapper.on( "click", ".row", function() {
	    		var $this = $(this);
	    		var is_clicked = ($this.hasClass('clicked')) ? true : false;
	    		if (is_clicked) {
	    			$this.removeClass('clicked');
	    			$this.find('.clicked_layer').remove();
	    			$("body").trigger( "import_remove_node", [$this.data('uri'), $this.data('values'), $this] );
	    		} else {
	    			$this.addClass('clicked');
	    			$this.prepend('<div class="clicked_layer"></div>');
	    			$("body").trigger( "import_add_node", [$this.data('uri'), $this.data('values'), $this] );
	    		}   		
	    	});
    	} else {
    		$wrapper.on( "click", ".row", function() {
    			var $this = $(this);
    			$("body").trigger( "node_not_clickable", [$this.data('uri'), $this.data('values'), $this] );
    		});
    	};
    	for (var j in opts.rows) {
    		var row = opts.rows[j];
    		var thumb = '';
    		if (!row['http://simile.mit.edu/2003/10/ontologies/artstor#thumbnail'] || 
    			!row['http://simile.mit.edu/2003/10/ontologies/artstor#thumbnail'][0] || 
    			!row['http://simile.mit.edu/2003/10/ontologies/artstor#thumbnail'][0].value ||
    			!row['http://simile.mit.edu/2003/10/ontologies/artstor#thumbnail'][0].value.length) {
    			thumb = $('link#base_url').attr('href')+'system/application/views/images/missing_thumb.jpg';
    			if ('undefined'!=typeof(row['http://purl.org/dc/terms/type']) && -1!=row['http://purl.org/dc/terms/type'][0].value.indexOf('quote')) thumb = $('link#base_url').attr('href')+'system/application/views/images/quote_logo.png'; 
    			if ('undefined'!=typeof(row['http://purl.org/dc/terms/type']) && -1!=row['http://purl.org/dc/terms/type'][0].value.indexOf('assertion')) thumb = $('link#base_url').attr('href')+'system/application/views/images/assertion_logo.png';
    			if ('undefined'!=typeof(row['http://purl.org/dc/terms/type']) && -1!=row['http://purl.org/dc/terms/type'][0].value.indexOf('link')) thumb = $('link#base_url').attr('href')+'system/application/views/images/link_logo.png';
    			if ('undefined'!=typeof(row['http://purl.org/dc/terms/type']) && -1!=row['http://purl.org/dc/terms/type'][0].value.indexOf('document')) thumb = $('link#base_url').attr('href')+'system/application/views/images/document_logo.png';
    			if ('undefined'!=typeof(row['http://purl.org/dc/terms/type']) && -1!=row['http://purl.org/dc/terms/type'][0].value.indexOf('audio')) thumb = $('link#base_url').attr('href')+'system/application/views/images/audio_logo.png';
    			if ('undefined'!=typeof(row['http://purl.org/dc/terms/type']) && -1!=row['http://purl.org/dc/terms/type'][0].value.indexOf('video')) thumb = $('link#base_url').attr('href')+'system/application/views/images/video_logo.png';
    			if (-1!=j.toLowerCase().indexOf('pdf')) thumb = $('link#base_url').attr('href')+'system/application/views/images/pdf_logo.png';
    			if (-1!=j.toLowerCase().indexOf('mp3')) thumb = $('link#base_url').attr('href')+'system/application/views/images/mp3_logo.png';
    			if (-1!=j.toLowerCase().indexOf('mov')) thumb = $('link#base_url').attr('href')+'system/application/views/images/video_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.mov')) thumb = $('link#base_url').attr('href')+'system/application/views/images/video_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('youtube')) thumb = $('link#base_url').attr('href')+'system/application/views/images/video_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.mp4')) thumb = $('link#base_url').attr('href')+'system/application/views/images/video_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.ogg')) thumb = $('link#base_url').attr('href')+'system/application/views/images/video_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.oga')) thumb = $('link#base_url').attr('href')+'system/application/views/images/audio_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.mp3')) thumb = $('link#base_url').attr('href')+'system/application/views/images/mp3_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.wav')) thumb = $('link#base_url').attr('href')+'system/application/views/images/audio_logo.png';
    			if ('undefined'!=typeof(row['http://simile.mit.edu/2003/10/ontologies/artstor#url']) && -1!=row['http://simile.mit.edu/2003/10/ontologies/artstor#url'][0].value.toLowerCase().indexOf('.pdf')) thumb = $('link#base_url').attr('href')+'system/application/views/images/pdf_logo.png';
    		} else {
    			thumb = row['http://simile.mit.edu/2003/10/ontologies/artstor#thumbnail'][0].value;
    		}
    		var $row = $('<div class="row"></div>').appendTo($wrapper);
    		$row.data('uri', j);
    		$row.data('values', opts.rows[j]);
    		var $thumb = $('<div class="icon_cell"><img src="'+thumb+'" /></div>').appendTo($row);
    		var $url = $('<div class="url"></div>').appendTo($row);
    		var $title = $('<div class="title"></div>').appendTo($row);
    		var $source = $('<div class="source"></div>').appendTo($row);
    		var url = j;
    		var mo = '';
    		for (var p in row) {
    			var pp = pnode(p);
    			//console.log('test: '+row[p][0].value);
    			if ('art:sourceLocation'==pp && 'undefined'!=typeof(row[p][0])) {
    				url = row[p][0].value;
    			} else if ('dcterms:source'==pp && 'undefined'!=typeof(row[p][0])) {
    				$source.append(row[p][0].value);
    				//$source.show();
    			} else if ('dcterms:title'==pp) {
    				var value = ('undefined'==typeof(row[p][0]) || 'undefined'==typeof(row[p][0].value)) ? '[No title]' : row[p][0].value.linkify();
	                $title.append(value);
    			};
    			if ('undefined'!=typeof(row[p][0])) {
    				for (var q = 0; q < row[p].length; q++) {
    					mo += pp + ' ' +row[p][q].value + "\n";
    				};
    			};
    		} 		
    		$url.append('<a href="'+url+'" target="_blank">'+url+'</a>');
    		if ('undefined'!=typeof(opts.check[j])) $row.click();
    		$row.attr('title',mo);
    	}   
    	do_match_height(true);
    	$('body').on('sheet_layout_change', function() { do_match_height(); });    
        $wrapper.find('a').on('click', function(e) {
            e.stopPropagation();
        }); 	
    } 
    
    function do_match_height(bool) {
    	if (bool) {
    		$self.find('.row').matchHeight(true);
    	} else {
    		$.fn.matchHeight._update();
    	}
    }    
    
    function pnode(str) {
    	for (var j in opts.namespaces_reversed) {
    		if (-1==str.indexOf(j)) continue;
    		str = str.replace(j, opts.namespaces_reversed[j]+':');
    		return str;
    	}
    }
    
}( jQuery ));