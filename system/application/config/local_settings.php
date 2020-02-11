<?php
/**
 * @projectDescription	Application config for Tensor installations
*/



// Starter profile (what gets called when clicking the green "Load starter profile" button)
$config['starter_profiles'] = array();
$config['starter_profiles'][] = array(
	'url' => 'https://gist.githubusercontent.com/dodget/600a9cabac1729f5a59ee0561f5f3e51/raw/042f9c9a92e95893ce957b9b2a400caba1e8d34d/starter.profile.js',
	'location' => 'https://github.com/craigdietrich/tensor-profiles',
	'button_text' => 'Load starter profile'
);

// Youtube api key for parser.
$config['youtube_data_key'] = (getenv('SCALAR_YOUTUBE_DATA_KEY') ? getenv('SCALAR_YOUTUBE_DATA_KEY') : '');

// Flickr api key for parser
$config['flickr_key'] = (getenv('FLICKR_KEY') ? getenv('FLICKR_KEY') : '');
$config['flickr_secret'] = (getenv('FLICKR_SECRET') ? getenv('FLICKR_SECRETY') : '');

// Vimeo api key for parser
$config['vimeo_client_id'] = (getenv('VIMEO_CLIENT_ID') ? getenv('VIMEO_CLIENT_ID') : '');
$config['vimeo_client_secret'] = (getenv('VIMEO_CLIENT_SECRET') ? getenv('VIMEO_CLIENT_SECRET') : '');

?>
