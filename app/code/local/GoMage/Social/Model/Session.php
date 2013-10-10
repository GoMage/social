<?php
/**
 * GoMage Social Connector Extension
 *
 * @category     Extension
 * @copyright    Copyright (c) 2013 GoMage (http://www.gomage.com)
 * @author       GoMage
 * @license      http://www.gomage.com/license-agreement/  Single domain license
 * @terms of use http://www.gomage.com/terms-of-use
 * @version      Release: 1.1
 * @since        Class available since Release 1.1
 */ 

class GoMage_Social_Model_Session extends Mage_Customer_Model_Session {


    public function setCustomerAsLoggedIn($customer)
    {

        if($profile = Mage::getSingleton('core/session')->getProfile() && Mage::getSingleton('core/session')->getProfile()->url == null ){
        $this->createSocial($customer->getId());
        }
      return parent::setCustomerAsLoggedIn($customer);

    }

    private  function createSocial( $customer_id){

        return Mage::getModel('gomage_social/entity')
            ->setData('social_id', Mage::getSingleton('core/session')->getProfile()->id)
            ->setData('type_id', Mage::getSingleton('core/session')->getProfile()->type_id)
            ->setData('customer_id', $customer_id)
            ->setData('website_id', Mage::app()->getWebsite()->getId())
            ->save();

    }

}
	 