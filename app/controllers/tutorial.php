<?php
include 'app/models/trains/station.php';

class Tutorial extends Controller {
	
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * Define Index page title and load template files
	 */
	public function index() {
		$data ['title'] =  'Tutorials';
		if(VIEW::isMobile()) {
			View::rendertemplate ( 'header', $data );
			View::render ( 'trains/enquire' );
		}
		else {
			View::rendertemplate ( 'header', $data );
			View::render ( 'trains/enquire', $data );
			View::rendertemplate ( 'footer', $data );
		}
	}
	
	public function java() {
		$data ['title'] =  'Tutorials';
		View::rendertemplate ( 'tutorial-header', $data );
		View::render ( 'tutorials/java/google-guice', $data );
		View::rendertemplate ( 'tutorial-footer', $data );
	}
	
}
?>