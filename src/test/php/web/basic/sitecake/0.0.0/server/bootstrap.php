<?php
ini_set('display_errors','On');
ini_set('display_warnings', 'On');
date_default_timezone_set('UTC');

$phpVersion = preg_split("/[:.]/", phpversion());
if ( ($phpVersion[0]*10 + $phpVersion[1]) < 53 ) {
	die("PHP version $phpVersion[0].$phpVersion[1] is found on your webhosting.
		PHP version 5.3 (or greater) is required.");
}

$GLOBALS['SC_ROOT'] = realpath(__DIR__ . '/../../../.');

$GLOBALS['DRAFT_CONTENT_DIR'] = $GLOBALS['SC_ROOT'] . '/sitecake-content';
$GLOBALS['DRAFT_CONTENT_URL'] = 'sitecake-content';
$GLOBALS['PUBLIC_IMAGES_DIR'] = $GLOBALS['SC_ROOT'] . '/images';
$GLOBALS['PUBLIC_FILES_DIR'] = $GLOBALS['SC_ROOT'] . '/files';
$GLOBALS['PUBLIC_IMAGES_URL'] = 'images';
$GLOBALS['PUBLIC_FILES_URL'] = 'files';
$GLOBALS['SITE_MAP_FILE'] = $GLOBALS['SC_ROOT'] . '/' . 'sitemap.xml';

$GLOBALS['SERVICE_URL.'] = 'sitecake/0.0.0/server/service.php';
$GLOBALS['SITECAKE_EDITOR_LOGIN_URL'] =
	'sitecake/0.0.0/client/publicmanager/publicmanager.nocache.js';
$GLOBALS['SITECAKE_EDITOR_EDIT_URL'] = 'sitecake/0.0.0/client/' .
	'contentmanager/contentmanager.nocache.js';
$GLOBALS['CONFIG_URL.'] = 'sitecake/editor.cfg';
$GLOBALS['CREDENTIALS_FILE'] = realpath(__DIR__ . '/../../credential.php');
$GLOBALS['TEMP'] = $GLOBALS['SC_ROOT'] . '/sitecake-content/tmp';

define('SERVER_DIR', realpath(__DIR__ . '/../../../../../../../src/main/php'));
set_include_path(
	SERVER_DIR . '/application' . PATH_SEPARATOR .
	SERVER_DIR . '/../lib'
);

spl_autoload_register(
	function($className) {
		require(str_replace('_', '/',
			str_replace('\\', '/', ltrim($className, '\\'))) . '.php');
		if(method_exists($className, '__static_init')) {
			$className::__static_init();
		}
	}
);
