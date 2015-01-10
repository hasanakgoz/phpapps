<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/core/config.php ?></title>

	<!-- CSS -->
	<?php
		Assets::css(array(
			//'//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css',
			Url::template_path() . 'css/style.css',
			Url::template_path() . 'css/cupertino/jquery-ui-1.10.3.custom.min.css',
			Url::template_path() . 'css/jquery.dataTables_themeroller.css',
		));
		Assets::js(Url::template_path() . 'js/jquery.min.js');
		Assets::js(Url::template_path() . 'js/jquery-ui.js');
		Assets::js(Url::template_path() . 'js/jquery.dataTables.js');
	?>

</head>
<body>

<div class="container">
