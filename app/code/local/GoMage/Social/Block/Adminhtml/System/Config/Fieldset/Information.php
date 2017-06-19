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

class GoMage_Social_Block_Adminhtml_System_Config_Fieldset_Information extends Mage_Adminhtml_Block_System_Config_Form_Fieldset {
	
	public function render(Varien_Data_Form_Element_Abstract $element) {
		
		$html = $this->_getHeaderHtml($element);
		
		$html .= Mage::getStoreConfig('gomage_social/information/text');
		
		$html .= $this->_getFooterHtml($element);
		
		return $html;
	}
}
