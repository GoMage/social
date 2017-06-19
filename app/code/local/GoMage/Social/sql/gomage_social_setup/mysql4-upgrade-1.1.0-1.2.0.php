<?php
/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013-2017 GoMage (https://www.gomage.com)
 * @author       GoMage
 * @license      https://www.gomage.com/license-agreement/  Single domain license
 * @terms of use https://www.gomage.com/terms-of-use
 * @version      Release: 1.5.0
 * @since        Class available since Release 1.2.0
 */

$installer = $this;
$installer->startSetup();

$sql = <<<SQLTEXT
DELETE FROM `{$this->getTable('core_config_data')}` WHERE `path` = "gomage_social/information/text"
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 