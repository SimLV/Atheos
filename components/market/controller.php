<?php

/*
    *  Copyright (c) Codiad & daeks (codiad.com), distributed
    *  as-is and without warranty under the MIT License. See
    *  [root]/license.txt for more. This information must remain intact.
    */

require_once('../../common.php');
require_once('class.market.php');
//////////////////////////////////////////////////////////////////
// Verify Session or Key
//////////////////////////////////////////////////////////////////
checkSession();

//////////////////////////////////////////////////////////////////
// Get Action
//////////////////////////////////////////////////////////////////
$action = Common::data("action");
if (!$action) {
	Common::sendJSON("error", "Missing Action");
	die;
}

if (!checkAccess()) {
	Common::sendJSON("E430u");
	die;
}

$type = Common::data("type");
$name = Common::data("name");
$repo = Common::data("repo");

$Market = new Market();
//////////////////////////////////////////////////////////////////
// Handle Action
//////////////////////////////////////////////////////////////////
switch ($action) {
	//////////////////////////////////////////////////////////////////
	// Init
	//////////////////////////////////////////////////////////////////
	case 'init':
		$Market->init();
		break;
	//////////////////////////////////////////////////////////////////
	// Install
	//////////////////////////////////////////////////////////////////
	case 'install':
		$Market->install($type, $name, $repo);
		break;

	//////////////////////////////////////////////////////////////////
	// Remove
	//////////////////////////////////////////////////////////////////
	case 'remove':
		$Market->remove($type, $name);
		break;

	//////////////////////////////////////////////////////////////////
	// Update
	//////////////////////////////////////////////////////////////////
	case 'update':
		$Market->update($type, $name);
		break;

	//////////////////////////////////////////////////////////////////
	// Save Cache
	//////////////////////////////////////////////////////////////////
	case 'saveCache':
		$cache = Common::data("cache");
		$Market->saveCache($cache);
		break;

	default:
		Common::sendJSON("E401i");
		die;
		break;
}