<?php


class Station extends Model {
	function __construct() {
		parent::__construct();
	}
	
	public function getStations($keyword = false) {
		$query = 'SELECT ID,CODE,NAME FROM '.PREFIX.'STATION';
		if(isset($keyword) && !empty($keyword)) {
			$query = $query." where NAME LIKE '".$keyword."%';";		
		}
		return $this->_db->select($query);
	}
	
	public function getTrains($from, $to) {
		$query = "select a.TRAIN_ID,c.NAME, d.NAME,a.DEP,b.ARR,(b.DIST-a.DIST) as DIST, TRUNCATE(b.ARR-a.DEP, 2) as TIME, e.RUNDAYS 
				from a7054067_apps.TRAIN_STOP a,a7054067_apps.TRAIN_STOP b, a7054067_apps.STATION c, a7054067_apps.STATION d, a7054067_apps.TRAIN e
		 where a.TRAIN_ID=b.TRAIN_ID and c.ID=a.STATION_ID and d.ID=b.STATION_ID and e.ID=a.TRAIN_ID and 
				a.STATION_ID=".$from." and b.STATION_ID=".$to." and a.SEQ<b.SEQ;";
		return $this->_db->select($query);
	}
}
?>