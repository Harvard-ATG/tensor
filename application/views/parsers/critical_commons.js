(function( $ ) {
	
    $.fn.parse = function(options) {
    	var model = new $.fn.spreadsheet_model(options);
    	model.parse = parse;
    	model.fetch('xml');
    };
    
	function parse(data, archive) {
        var results = {};
        $(data).find('item').each(function() {
        	var sourceLocation = this.attributes['rdf:about'].value;
        	var $this = $(this);
        	var uri = $this.find('link').text();
        	// TODO: URI is None/None
        	var date = $this.find('dcterms\\:created').text();
        	var creator = $this.find('dcterms\\:creator').text();
        	var publisher = $this.find('dcterms\\:publisher').text();
        	var title = $this.find('title').text();
        	var desc = $this.find('description').html();
        	var thumb = $this.find('art\\:thumbnail').attr('url');
        	results[uri] = {
        		'http://simile.mit.edu/2003/10/ontologies/artstor#thumbnail':[{type:'uri',value:thumb}],
        		'http://purl.org/dc/terms/title':[{type:'literal',value:title}],
        		'http://purl.org/dc/terms/description':[{type:'literal',value:desc}],
        		'http://purl.org/dc/terms/source':[{type:'literal',value:archive.title}],
        		'http://purl.org/dc/terms/date':[{type:'literal',value:date}],
        		'http://purl.org/dc/terms/creator':[{type:'literal',value:creator}],
        		'http://purl.org/dc/terms/publisher':[{type:'literal',value:publisher}],
        		'http://simile.mit.edu/2003/10/ontologies/artstor#sourceLocation':[{type:'uri',value:sourceLocation}],
        	};
        });
        console.log(results);
        this.opts.complete_callback(results, archive);
	};
    
}( jQuery ));