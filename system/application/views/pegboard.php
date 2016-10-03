<div id="loading"><div>Loading</div></div>

<div class="container-fluid">
	<div class="row col-max-height">
		<!-- Sidebar -->
		<div class="col-xs-3 col-max-height sidebar">
			<div class="collections">
				<div>
				  <form id="filter_collections_form">
				  	<div>
				  		<button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Add collection</button>
				  	</div>
				  	<div>
					    <div class="right-inner-addon">
					      <input name="search" class="form-control" placeholder="Collections" />
					      <a href="javascript:void(null);" class="glyphicon glyphicon-search"></a>
					    </div>
					</div>
				  </form>
				  <form id="collections_form">
					<div class="collection all">
						<div class="color" style="background-color:#ffffff;"><span class="num_items">0</span></div>
						<h5>All imported media</h5>
					    <div class="desc">All media imported from archives</div>
					</div>
				  </form>
				</div>
			</div>
		</div>
		<!-- List of archives -->
		<div id="archives" class="col-xs-9">
		  	<span style="float:right;">
		  		<a href="javascript:void(null);" class="btn btn-default btn-sm" data-toggle="modal" data-target="#set_profiles"><span class="glyphicon glyphicon-cog"></span> Set profiles</a>
		  		<a href="javascript:void(null);" class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_archive"><span class="glyphicon glyphicon-plus"></span> Add archive</a>
				<a href="javascript:void(null);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sync"><span class="glyphicon glyphicon-cloud"></span>&nbsp; Sync media</a>
			</span>
		  	<div class="btn-group btn-group-sm" role="group"></div>
		  	<form id="search_archives_form">
				<div class="right-inner-addon">
			    	<input name="search" class="form-control" placeholder="Archives" />
				  	<a href="javascript:void(null);" class="glyphicon glyphicon-search"></a>
				</div>
			</form>
			<div class="container-fluid"></div>
		</div>
		<!-- Search an archive -->
		<div id="search" class="col-xs-9">
			<span id="search_close_circle"></span>
			<a href="javascript:void(null);" id="search_close" class="glyphicon glyphicon-remove"></a>
			<form id="search_form">
				<div class="right-inner-addon">
					<input type="text" name="search" class="form-control" placeholder="Search archive" required />
					<a href="javascript:void(null);" class="glyphicon glyphicon-trash glyphicon-xs"></a>
					<a href="javascript:void(null);" class="glyphicon glyphicon-pencil glyphicon-xs two"></a>
					<a href="javascript:void(null);" class="glyphicon glyphicon-search glyphicon-xs three"></a>
				</div>
			</form>
			<div id="search_view" class="btn-group btn-group-sm" role="group">
				<button type="button" class="btn btn-primary" id="icon">Icon</button>
				<button type="button" class="btn btn-default" id="tile">Tile</button>
				<button type="button" class="btn btn-default" id="list">List</button>
				<button type="button" class="btn btn-default" id="detail">Detail</button>
			</div>
			<div id="import_to" class="btn-group btn-group-sm" role="group"></div>
			<div id="search_results"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="set_profiles">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Set my profiles</h4>
      </div>
      <div class="modal-body">
          <div id="profiles"></div>
          <div class="form-group no-profiles">
            <p class="help-block">Load the Tensor starter profile from <a href="https://github.com/craigdietrich/tensor-profiles" target="_blank">github.com/craigdietrich/tensor-profiles</a>.</p>
            <button class="btn btn-success" type="button" id="startProfiles">Load starter profile</button>
          </div>
          <form class="form-group">
            <p class="help-block">Create a new, empty profile to which you can add new archives.</p>
		    <div class="input-group">
		      <input type="text" class="form-control" placeholder="Profile name...">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit" id="createNewProfile">Create</button>
		      </span>
		    </div>
          </form>
          <form class="form-group">
            <p class="help-block">Add a Tensor profile based on a URL.</p>
		    <div class="input-group">
		      <input type="text" class="form-control" placeholder="http://">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button" id="profileFromURL">Add</button>
		      </span>
		    </div>
          </form>
	 	  <form class="form-group" enctype="multipart/form-data">
	        <p class="help-block">Upload a file containing a Tensor profile.</p>
		    <div class="input-group">
		      <span class="input-group-btn">
				<label class="btn btn-default" for="profile-file-selector">
				    <input id="profile-file-selector" type="file" style="display:none;" onchange="$('#profile-file-info').val($(this).val());">
				    Browse
				</label>
		      </span>
		      <input type="text" class="form-control" id="profile-file-info">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit" id="profileUpload">Upload</button>
		      </span>
		    </div>
	      </form>
          <div class="form-group has-profiles">
            <p class="help-block">Remove all existing profiles and load the starter profile from <a href="https://github.com/craigdietrich/tensor-profiles" target="_blank">GitHub</a>.</p>
            <button class="btn btn-default" type="button" id="resetProfiles">Reset</button>
          </div>
      </div>
      <div class="modal-footer has-profiles">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_archive">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add an archive</h4>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
		  <div class="form-group">
		  	<label for="profile" class="col-sm-3 control-label">Profile</label>
		  	<div class="col-sm-9">
			  	<select class="form-control" id="profile" name="profile" style="width:auto;float:left;margin-right:12px;"></select>
			  	<input type="text" class="form-control" id="new_profile" name="new_profile" style="width:auto;float:left;" placeholder="New profile name..." />
			</div>
		  </div>
		  <div class="form-group">
		  	<label for="parser" class="col-sm-3 control-label">Parser</label>
		  	<div class="col-sm-9">
			  	<select class="form-control" id="parser" name="parser" required>
			  		<option value=""></option>
			  	</select>
			</div>
		  </div>
		  <div class="form-group">
		    <label for="title" class="col-sm-3 control-label">Title</label>
		    <div class="col-sm-9">
		    	<input type="text" class="form-control" id="title" name="title" placeholder="My Archive" required>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="subtitle" class="col-sm-3 control-label">Description</label>
		    <div class="col-sm-9">
		    	<input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="An archive of digital assets" required>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="url" class="col-sm-3 control-label">Archive URL</label>
		    <div class="col-sm-9">
		    	<input type="text" class="form-control" id="url" name="url" placeholder="http://" required>
		    	<small>For example, the archive's home or start page</small>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="thumbnail" class="col-sm-3 control-label">Thumbnail URL</label>
		    <div class="col-sm-9">
		    	<input type="text" class="form-control" id="thumbnail" name="thumbnail" placeholder="http://">
		    	<small>Leave empty to use the parser's default thumbnail</small>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="categories" class="col-sm-3 control-label">Categories</label>
		    <div class="col-sm-9">
		   		<input type="text" class="form-control" id="categories" name="categories" placeholder="image, video, audio, ...">
		 	</div>
		  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add archive</button>
        </div>
      </form>
    </div>
  </div>
</div>

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

<div class="modal fade" id="sync">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sync Collections</h4>
      </div>
      <div class="modal-body">
        <h4>Select one or more source collection</h4>
      	<div id="sync_collections"></div>
      	<br clear="both" /><br />
        <h4>Select one or more destination Scalar book</h4>
      	<div id="sync_destinations"></div>
      	<br clear="both" />
      </div>
      <div class="modal-footer">
		<div class="progress">
			<div id="content_progress" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
				<span>Content 0 of 0</span>
			</div>
		</div>
		<div style="float:left;" class="sync_details"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Synchronize</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="edit_metadata">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="thumb"></div>
        <h4 class="modal-title">Edit Metadata</h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default pull-left">Add Additional Metadata</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save Metadata</button>
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
