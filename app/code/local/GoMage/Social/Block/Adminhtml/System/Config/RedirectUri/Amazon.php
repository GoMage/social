<?php
/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.2.0
 * @since        Class available since Release 1.2.0
 */ 
 
class GoMage_Social_Block_Adminhtml_System_Config_RedirectUri_Amazon extends Mage_Adminhtml_Block_System_Config_Form_Field {
	protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) {
		$redirect_params	= array('_secure' => true);
		$redirect_uri		= Mage::getUrl('gomage_social/amazon/callback', $redirect_params);
		$redirect_uri		= (strpos($redirect_uri, 'https') === 0) ? $redirect_uri : str_replace('http', 'https', $redirect_uri);
		
		$element->setDisabled('disabled');
		$element->setValue($redirect_uri);
		
		return parent::_getElementHtml($element);
	}	 
}