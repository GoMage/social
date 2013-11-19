<?php
/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.1.0
 * @since        Class available since Release 1.0.0
 */
	
class GoMage_Social_Block_Head extends Mage_Core_Block_Template{
	
	protected function _prepareLayout()
    { 
        parent::_prepareLayout();
        if (Mage::helper('gomage_social')->isActive()) {
        if(Mage::getVersion() < 1.7){
            $this->getLayout()->getBlock('head')->addItem('js_css', 'prototype/windows/themes/magento.css');
        }else{
            $this->getLayout()->getBlock('head')->addItem('skin_css', 'lib/prototype/windows/themes/magento.css');
        }
        $this->getLayout()->getBlock('head')->addItem('js_css', 'prototype/windows/themes/magento.css');
        }
    } 
	
}