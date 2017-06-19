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

class GoMage_Social_Model_Mysql4_Entity_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
	
	public function _construct() {
		$this->_init("gomage_social/entity");
	}

}
	 