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
 * Include base command handler
 */
require_once CKFINDER_CONNECTOR_LIB_DIR.'/CommandHandler/CommandHandlerBase.php';
/**
 * Include xml utils
 */
require_once CKFINDER_CONNECTOR_LIB_DIR.'/Core/Xml.php';

/**
 * Base XML commands handler
 *
 * @copyright CKSource - Frederico Knabben
 */
abstract class CKFinder_Connector_CommandHandler_XmlCommandHandlerBase extends CKFinder_Connector_CommandHandler_CommandHandlerBase
{
    /**
     * Connector node - Ckfinder_Connector_Utils_XmlNode object
     *
     * @var Ckfinder_Connector_Utils_XmlNode
     */
    protected $_connectorNode;

    /**
     * send response
     */
    public function sendResponse()
    {
        $xml = &CKFinder_Connector_Core_Factory::getInstance('Core_Xml');
        $this->_connectorNode = &$xml->getConnectorNode();

        $this->checkConnector();
        if ($this->mustCheckRequest()) {
            $this->checkRequest();
        }

        $resourceTypeName = $this->_currentFolder->getResourceTypeName();
        if (! empty($resourceTypeName)) {
            $this->_connectorNode->addAttribute('resourceType', $this->_currentFolder->getResourceTypeName());
        }

        if ($this->mustAddCurrentFolderNode()) {
            $_currentFolder = new Ckfinder_Connector_Utils_XmlNode('CurrentFolder');
            $this->_connectorNode->addChild($_currentFolder);
            $_currentFolder->addAttribute('path', CKFinder_Connector_Utils_FileSystem::convertToConnectorEncoding($this->_currentFolder->getClientPath()));

            $this->_errorHandler->setCatchAllErros(true);
            $_url = $this->_currentFolder->getUrl();
            $_currentFolder->addAttribute('url', is_null($_url) ? '' : CKFinder_Connector_Utils_FileSystem::convertToConnectorEncoding($_url));
            $this->_errorHandler->setCatchAllErros(false);

            $_currentFolder->addAttribute('acl', $this->_currentFolder->getAclMask());
        }

        $this->buildXml();

        $_oErrorNode = &$xml->getErrorNode();
        $_oErrorNode->addAttribute('number', '0');

        echo $this->_connectorNode->asXML();
        exit;
    }

    /**
     * Must check request?
     *
     * @return bool
     */
    protected function mustCheckRequest()
    {
        return true;
    }

    /**
     * Must add CurrentFolder node?
     *
     * @return bool
     */
    protected function mustAddCurrentFolderNode()
    {
        return true;
    }

    /**
     * @return void
     */
    abstract protected function buildXml();
}
