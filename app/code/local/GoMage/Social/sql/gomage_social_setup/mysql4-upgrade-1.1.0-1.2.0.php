<?php
/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013-2015 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.5.0
 * @since        Class available since Release 1.0.0
 */

$installer = $this;
$installer->startSetup();

$sql = <<<SQLTEXT
DELETE FROM `{$this->getTable('core_config_data')}` WHERE `path` = "gomage_social/information/text"
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 