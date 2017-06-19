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
 * @since        Class available since Release 1.0.0
 */

$installer = $this;
$installer->startSetup();

$sql = <<<SQLTEXT
CREATE TABLE `{$this->getTable('gomage_social_entity')}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(3) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL,
  `website_id` int(11) NOT NULL DEFAULT '0',
  `social_id` varchar(255) DEFAULT NULL,  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;	
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 