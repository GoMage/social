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

class GoMage_Social_Model_Adminhtml_System_Config_Source_Login_Type{

	const TEXT = 1;
	const IMAGE = 2;
	const BUTTON = 3;
	
    public function toOptionArray()
    {
    	$helper = Mage::helper('gomage_social');
    	
        return array(        	
            array('value' => self::TEXT, 'label' => $helper->__('Text')),            
            array('value' => self::IMAGE,'label' => $helper->__('Image')),
        );
    }

}