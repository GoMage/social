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
 * @since        Class available since Release 1.1.0
 */

$installer = $this;
$installer->startSetup();

$sql = <<<SQLTEXT
ALTER TABLE `{$this->getTable('gomage_social_entity')}` modify `customer_id` int(10) unsigned NOT NULL;

ALTER TABLE `{$this->getTable('gomage_social_entity')}`
ADD CONSTRAINT `FK_gomage_social_entity_customer_id_customer_entity_entity_id`
 FOREIGN KEY (`customer_id`)
 REFERENCES `{$this->getTable('customer_entity')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 