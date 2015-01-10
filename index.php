<?php
error_reporting(E_ALL);
if(file_exists('vendor/autoload.php')){
	require 'vendor/autoload.php';
} else {
	echo "<h1>Please install via composer.json</h1>";
	echo "<p>Install Composer instructions: <a href='https://getcomposer.org/doc/00-intro.md#globally'>https://getcomposer.org/doc/00-intro.md#globally</a></p>";
	echo "<p>Once composer is installed navigate to the working directory in your terminal/command promt and enter 'composer install'</p>";
	exit;
}

if (!is_readable('app/core/config.php')) {
	die('No config.php found, configure and rename config.example.php to config.php in app/core.');
}

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'development');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but production will hide them.
 */

if (defined('ENVIRONMENT')){

	switch (ENVIRONMENT){
		case 'development':
			error_reporting(E_ALL);
		break;

		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}

}

//initiate config
require 'app/core/controller.php';
require 'app/core/view.php';
require 'app/core/model.php';
require 'app/core/config.php';
require 'app/core/router.php';
require 'app/core/logger.php';
require 'app/core/error.php';
require 'app/core/language.php';
require 'app/helpers/session.php';
require 'app/helpers/url.php';
require 'app/helpers/assets.php';
		
new Config();

//create alias for Router

//define routes
Router::anyone('', '\controllers\welcome@index');
Router::anyone('/subpage', '\controllers\welcome@subpage');

//tutorials
Router::anyone('tutorials/', '\controllers\tutorial@index');
Router::anyone('tutorials/spring', '\controllers\tutorial@spring');
Router::anyone('tutorials/java/:any', '\controllers\tutorial@java');

//trains - timetable
Router::anyone('rail', '\controllers\train@index');
Router::anyone('rail/stations', '\controllers\train@allStations');
Router::anyone('rail/search', '\controllers\train@search');

Router::anyone('rail/mobile', '\controllers\mobile\train@index');
Router::anyone('rail/stations/mobile', '\controllers\mobile\train@allStations');

Router::anyone('chess', '\controllers\chess@index');
Router::anyone('chess/:any', '\controllers\chess@index');



//if no route found
Router::error('\core\error@index');

//turn on old style routing
Router::$fallback = false;

//execute matched routes
Router::dispatch();
