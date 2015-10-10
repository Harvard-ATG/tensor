<div id="loading"><div>Loading</div></div>

<div class="container-fluid">
	<div class="row col-max-height">

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-max-height sidebar">
			<!-- Collections -->
			<div class="collections">
				<div>
				  <form id="filter_collections_form">
				    <div class="right-inner-addon">
				      <input name="search" class="form-control" placeholder="Filter Collections" />
				      <a href="javascript:void(null);" class="glyphicon glyphicon-search"></a>
				    </div>
				  </form>
				  <div class="advanced">Collections<a href="javascript:void(null);" id="advanced_collections_link"><span class="glyphicon glyphicon glyphicon-cog" aria-hidden="true"></span> Manage Collections</a></div>
				  <form id="collections_form">
				    <div class="notice"><a href="javascript:void(null);" data-toggle="modal" data-target="#create_collection"><span class="glyphicon glyphicon-plus"></span> Create a New Collection</a></div>
					<div class="collection all">
						<div class="color" style="background-color:#ffffff;"></div>
						<h5>All imported media</h5>
					    <div class="desc">All media imported from the archives</div>
					</div>
				  </form>
				</div>
			</div><!-- /collections -->
			<!-- Archives -->
			<div class="search">
				<div>
				  <form id="find_archives_form">
				    <div class="right-inner-addon">
				      <input name="search" class="form-control" placeholder="Filter Archives" />
				      <a href="javascript:void(null);" class="glyphicon glyphicon-search"></a>
				    </div>
				  </form>
				  <div class="advanced">Archives<a href="javascript:void(null);" id="advanced_find_archives_link"><span class="glyphicon glyphicon glyphicon-cog" aria-hidden="true"></span> Manage Archives</a></div>
				  <form id="findable_form">
<?
					  $index = 0;
					  foreach ($archives as $archive) {
					    echo '				<div ';
					    echo 'class="archive" ';
					    echo 'style="background-image:url('.base_url().APPPATH.$archive['thumbnail'].');" ';
					    echo 'title="'.$archive['title'].': '.$archive['subtitle'].'" ';
					    echo 'data-index="'.$index.'" ';
					    echo 'data-categories="'.implode(',',$archive['categories']).'" ';
					    echo 'data-request="'.htmlspecialchars(json_encode(array_merge($archive['request'],array('title'=>$archive['title']))), ENT_QUOTES, 'UTF-8' ).'"';
					    echo '>'."\n";
					    echo '<h5>'.$archive['title'].'</h5>'."\n";
					    echo '<div class="desc">'.$archive['subtitle']."</div>\n";
					    echo "</div>\n";
					    $index++;
					  }
?>
					</form>
				</div><!-- /div -->
			</div><!-- /search -->
		</div><!-- /sheet -->


		<div id="welcome_msg">
			  To begin <a href="javascript:void(null);"><span class="glyphicon glyphicon-plus"></span> Create a New Collection</a> in the sidebar<br />
			  Then, select an archive to search for content<br /><br />
			  After content has been imported, you can<br />
			  <a href="javascript:void(null);"><span class="glyphicon glyphicon-cloud"></span> Sync</a> them
			  to your Scalar books
		</div>

		<div id="collections_spreadsheet" class="spreadsheet col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div id="spreadsheet_gradient"></div>
			<div id="collection_bar" class="bar">
				<div class="l">
					<div class="btn-group" role="group" id="collection_view">
					  <button type="button" class="btn btn-primary btn-xs" value="view"><span class="glyphicon glyphicon-list"></span> Collection</button>
					  <button type="button" class="btn btn-default btn-xs" value="edit"><span class="glyphicon glyphicon-plus"></span> Add / remove</button>
					</div>
				</div>
				<div class="r">
					<button class="btn btn-xs" id="edit_collection_link" data-toggle="modal" data-target="#edit_collection">Edit</button>
					<button class="btn btn-xs" id="delete_collection_link">Delete</button>
				</div>
				<div class="m">
					<div class="btn-group view-buttons" role="group">
						<button type="button" class="btn btn-xs btn-primary" id="icon"><img src="<?php echo base_url().APPPATH ?>views/images/icon_icon.jpg" />Icon</button>
					  	<button type="button" class="btn btn-xs btn-default" id="tile"><img src="<?php echo base_url().APPPATH ?>views/images/tile_icon.jpg" />Tile</button>
					  	<button type="button" class="btn btn-xs btn-default" id="list"><img src="<?php echo base_url().APPPATH ?>views/images/list_icon.jpg" />List</button>
					  	<button type="button" class="btn btn-xs btn-default" id="detail"><img src="<?php echo base_url().APPPATH ?>views/images/detail_icon.jpg" />Detail</button>
				  	</div>
				</div>
			</div>
			<div id="collections_spreadsheet_content"></div>
		</div><!-- spreadsheet -->

		<div id="search_spreadsheet" class="spreadsheet col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div id="search_bar" class="bar">
				<div class="l">
					<form id="search_form">
					    <div class="right-inner-addon">
					      <input type="text" name="search" class="form-control text-xs" placeholder="Search archive" />
					      <a href="javascript:void(null);" class="glyphicon glyphicon-search glyphicon-xs"></a>
					    </div>
				    </form>
				</div>
				<div class="m">
					<div class="btn-group view-buttons" role="group">
						<a class="page prev-page"><span class="glyphicon glyphicon-chevron-left"></span> Page <span class="num"></span></a>
						<button type="button" class="btn btn-xs btn-primary" id="icon"><img src="<?php echo base_url().APPPATH ?>views/images/icon_icon.jpg" />Icon</button>
					  	<button type="button" class="btn btn-xs btn-default" id="tile"><img src="<?php echo base_url().APPPATH ?>views/images/tile_icon.jpg" />Tile</button>
					  	<button type="button" class="btn btn-xs btn-default" id="list"><img src="<?php echo base_url().APPPATH ?>views/images/list_icon.jpg" />List</button>
					  	<button type="button" class="btn btn-xs btn-default" id="detail"><img src="<?php echo base_url().APPPATH ?>views/images/detail_icon.jpg" />Detail</button>
					  	<a class="page next-page">Page <span class="num"></span> <span class="glyphicon glyphicon-chevron-right"></span></a>
					</div>
				</div>
			</div><!-- /search_bar -->
			<form id="search_spreadsheet_content"></form>
			<div id="advanced_search" class="spreadsheet_panel">
			  <a href="javascript:void(null);" class="close_btn"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
			  <form id="advanced_form">
			 	<div class="tr"><div class="field"><a href="javascript:void(null);" class="add glyphicon glyphicon-plus" aria-hidden="true"></a></div><div class="value"><button type="submit" class="btn btn-sm btn-primary">Search</button></div></div>
			  </form>
			</div><!-- /manage_archive -->
			<div id="manage_archives" class="spreadsheet_panel">
			  <a href="javascript:void(null);" class="close_btn"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
			  <div class="btn-group btn-group-sm" role="group">
				  <button type="button" value="" class="btn btn-primary">All</button>
				  <button type="button" value="affiliated" class="btn btn-default">Affiliated</button>
				  <button type="button" value="other" class="btn btn-default">Non-affiliated</button>
				  <button type="button" value="image" class="btn btn-default">Image</button>
				  <button type="button" value="audio" class="btn btn-default">Audio</button>
				  <button type="button" value="video" class="btn btn-default">Video</button>
				  <button type="button" value="contentdm" class="btn btn-default">CONTENTdm</button>
			  </div>
			</div><!-- /manage_archive -->
		</div><!-- spreadsheet -->

	</div><!-- /row -->
</div><!-- /container -->

<div class="modal fade" id="create_collection">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Create Collection</h4>
      </div>
      <div class="modal-body">
        <form id="create_collection_form">
		  <div class="form-group">
		    <label>Title</label>
		    <input type="text" class="form-control" name="title" placeholder="My new collection">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <input type="text" class="form-control" name="description" placeholder="A collection of imported media">
		  </div>
		  <div class="form-group">
		  	<label>Color</label><br />
		  	<input type="text" name="color">
		  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Create collection</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="edit_collection">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Collection</h4>
      </div>
      <div class="modal-body">
        <form id="create_collection_form">
		  <div class="form-group">
		    <label>Title</label>
		    <input type="text" class="form-control" name="title" placeholder="My new collection">
		  </div>
		  <div class="form-group">
		    <label>Description</label>
		    <input type="text" class="form-control" name="description" placeholder="A collection of imported media">
		  </div>
		  <div class="form-group">
		  	<label>Color</label><br />
		  	<input type="text" name="color">
		  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save collection</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="error">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Error</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
