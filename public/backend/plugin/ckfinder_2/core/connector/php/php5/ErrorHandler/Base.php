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
if (! defined('IN_CKFINDER')) {
    exit;
}

/**
 * @copyright CKSource - Frederico Knabben
 */

/**
 * Basic error handler
 *
 * @copyright CKSource - Frederico Knabben
 */
class CKFinder_Connector_ErrorHandler_Base
{
    /**
     * Try/catch emulation, if set to true, error handler will not throw any error
     *
     * @var bool
     */
    protected $_catchAllErrors = false;

    /**
     * Array with error numbers that should be ignored
     *
     * @var array[]int
     */
    protected $_skipErrorsArray = [];

    /**
     * Set whether all errors should be ignored
     *
     * @param  bool  $newValue
     */
    public function setCatchAllErros($newValue)
    {
        $this->_catchAllErrors = $newValue ? true : false;
    }

    /**
     * Set which errors should be ignored
     *
     * @param  array  $newArray
     */
    public function setSkipErrorsArray($newArray)
    {
        if (is_array($newArray)) {
            $this->_skipErrorsArray = $newArray;
        }
    }

    /**
     * Throw connector error, return true if error has been thrown, false if error has been catched
     *
     * @param  int  $number
     * @param  string  $text
     */
    public function throwError($number, $text = false)
    {
        if ($this->_catchAllErrors || in_array($number, $this->_skipErrorsArray)) {
            return false;
        }

        $_xml = &CKFinder_Connector_Core_Factory::getInstance('Core_Xml');
        $_xml->raiseError($number, $text);

        exit;
    }
}
