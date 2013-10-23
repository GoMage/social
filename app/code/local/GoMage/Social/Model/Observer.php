<?php
/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.0
 * @since        Class available since Release 1.0
 */ 

class GoMage_Social_Model_Observer {
	
	public static function saveConfig() {
		
		Mage::helper('gomage_social')->setInformation();
		
	}


    public function GSCustomerLoggedIn($customer)
    {
        if($profile = Mage::getSingleton('core/session')->getGsProfile() && Mage::getSingleton('core/session')->getGsProfile()->url == null ){
            $this->createSocial($customer->getId());
        }


    }

    private  function createSocial( $customer_id){

        return Mage::getModel('gomage_social/entity')
            ->setData('social_id', Mage::getSingleton('core/session')->getGsProfile()->id)
            ->setData('type_id', Mage::getSingleton('core/session')->getGsProfile()->type_id)
            ->setData('customer_id', $customer_id)
            ->setData('website_id', Mage::app()->getWebsite()->getId())
            ->save();

    }
}