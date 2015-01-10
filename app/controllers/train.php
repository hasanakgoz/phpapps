<?php
include 'app/models/trains/station.php';

class Train extends Controller {
	
	private $_station;
	
	public function __construct() {
		parent::__construct ();
		$this->_station = new Station();
	}
	
	/**
	 * Define Index page title and load template files
	 */
	public function index() {
		$data ['title'] =  'Train Enquiry';
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
	
	/**
	 * Define Subpage page title and load template files
	 */
	public function allStations() {
		$keyword = null;
		if(isset($_GET['q'])) {
			$keyword = $_GET['q'];
		}
		$data ['stations'] = $this->_station->getStations($keyword);
		//print_r($data ['stations']);
		header('Content-Type: application/json');
		echo json_encode($data ['stations']);
		exit;
	}
	
	public function search() {
		$from = $_GET['from'];
		$to = $_GET['to'];
		$data ['trains'] = $this->_station->getTrains($from, $to);
		$response["data"] = $data ['trains'];
		$response["recordsTotal"] = sizeof($response["data"]);
		//print_r($data ['stations']);
		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
?>