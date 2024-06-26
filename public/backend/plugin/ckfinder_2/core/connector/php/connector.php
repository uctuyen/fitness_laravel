<?php
/*
 * CKFinder
 * ========
 * http://cksource.com/ckfinder
 * Copyright (C) 2007-2015, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */

/**
 * Main heart of CKFinder - Connector
 *
 * @copyright CKSource - Frederico Knabben
 */

/**
 * Protect against sending warnings to the browser.
 * Comment out this line during debugging.
 */
// error_reporting(0);

/**
 * Protect against sending content before all HTTP headers are sent (#186).
 */
ob_start();

/**
 * define required constants
 */
require_once dirname(__FILE__).'/constants.php';

// @ob_end_clean();
// header("Content-Encoding: none");

/**
 * we need this class in each call
 */
require_once CKFINDER_CONNECTOR_LIB_DIR.'/CommandHandler/CommandHandlerBase.php';
/**
 * singleton factory
 */
require_once CKFINDER_CONNECTOR_LIB_DIR.'/Core/Factory.php';
/**
 * utils class
 */
require_once CKFINDER_CONNECTOR_LIB_DIR.'/Utils/Misc.php';
/**
 * hooks class
 */
require_once CKFINDER_CONNECTOR_LIB_DIR.'/Core/Hooks.php';

/**
 * Simple function required by config.php - discover the server side path
 * to the directory relative to the "$baseUrl" attribute
 *
 * @param  string  $baseUrl
 * @return string
 */
function resolveUrl($baseUrl)
{
    $fileSystem = &CKFinder_Connector_Core_Factory::getInstance('Utils_FileSystem');
    $baseUrl = preg_replace('|^http(s)?://[^/]+|i', '', $baseUrl);

    return $fileSystem->getDocumentRootPath().$baseUrl;
}

$utilsSecurity = &CKFinder_Connector_Core_Factory::getInstance('Utils_Security');
$utilsSecurity->getRidOfMagicQuotes();

/**
 * $config must be initialised
 */
$config = [];
$config['Hooks'] = [];
$config['Plugins'] = [];

/**
 * read config file
 */
require_once CKFINDER_CONNECTOR_CONFIG_FILE_PATH;

CKFinder_Connector_Core_Factory::initFactory();
$connector = &CKFinder_Connector_Core_Factory::getInstance('Core_Connector');

if (isset($_GET['command'])) {
    $connector->executeCommand($_GET['command']);
} else {
    $connector->handleInvalidCommand();
}
