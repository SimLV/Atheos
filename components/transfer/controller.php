<?php

//////////////////////////////////////////////////////////////////////////////80
// Transfer Controller
//////////////////////////////////////////////////////////////////////////////80
// Copyright (c) Atheos & Liam Siira (Atheos.io), distributed as-is and without
// warranty under the MIT License. See [root]/LICENSE.md for more.
// This information must remain intact.
//////////////////////////////////////////////////////////////////////////////80
// Authors: Codiad Team, @Fluidbyte, Atheos Team, @hlsiira
//////////////////////////////////////////////////////////////////////////////80
require_once("class.transfer.php");

$type = POST("type");
$path = POST("path");

$path = Common::getWorkspacePath($path);

//////////////////////////////////////////////////////////////////////////////80
// Security Check
//////////////////////////////////////////////////////////////////////////////80
if (!Common::checkPath($path)) {
	Common::send("error", "User does not have access.");
}

//////////////////////////////////////////////////////////////////////////////80
// Handle Action
//////////////////////////////////////////////////////////////////////////////80
$Transfer = new Transfer();
$Transfer->root = WORKSPACE;

switch ($action) {
	//////////////////////////////////////////////////////////////////////////80
	// Download Files
	//////////////////////////////////////////////////////////////////////////80
	case 'download':
		$Transfer->download($path, $type);
		break;
	//////////////////////////////////////////////////////////////////////////80
	// Upload Files
	//////////////////////////////////////////////////////////////////////////80
	case 'upload':
		$Transfer->upload($path);
		break;
	//////////////////////////////////////////////////////////////////////////80
	// Default: Invalid Action
	//////////////////////////////////////////////////////////////////////////80
	default:
		Common::send("error", "Invalid action.");
		break;
}