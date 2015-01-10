<?php

/*
 * View - load template pages
 *
 * @author David Carr - dave@daveismyname.com - http://www.daveismyname.com
 * @version 2.1
 * @date June 27, 2014
 */
class View {
	
	/**
	 * @var array Array of HTTP headers
	 */
	private static $headers = array();
	/**
	 * include template file
	 * @param  string  $path  path to file from views folder
	 * @param  array $data  array of data
	 * @param  array $error array of errors
	 */
	public static function render($path,$data = false, $error = false){
		if (!headers_sent()) {
			foreach (self::$headers as $header) {
				header($header, true);
			}
		}
		
		$file = "app/views/$path.php";
		require $file;
		exit;
	}

	/**
	 * return absolute path to selected template directory
	 * @param  string  $path  path to file from views folder
	 * @param  array $data  array of data
	 */
	public static function rendertemplate($path,$data = false){
		if (!headers_sent()) {
			foreach (self::$headers as $header) {
				header($header, true);
			}
		}
		if(require "app/templates/default" ."/$path.php"){}
	}
	
	/**
	 * add HTTP header to headers array 
	 * @param  string  $header HTTP header text
	 */
	public function addheader($header) {
		self::$headers[] = $header;
	}

    	/**
     	* Add an array with headers to the view.
     	* @param array $headers
     	*/
    	public function addheaders($headers = array()) {
        	foreach($headers as $header) {
            		$this->addheader($header);
        	}
    	}
    	
    	public static function isMobile() {
    		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    		
    		if ($iphone || $android || $palmpre || $ipod || $berry == true)
    		{
    			//header('Location: http://mobile.site.com/');
    			//OR
    			//echo "<script>window.location='http://mobile.site.com'</script>";
    			return true;
    		}
    	}
}
