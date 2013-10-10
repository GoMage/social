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

abstract class GoMage_Social_Controller_SocialNoMail extends Mage_Core_Controller_Front_Action {
		
	abstract function getSocialType();
	
	protected function getSession(){
		return Mage::getSingleton('customer/session');
	}
	
	protected function createSocial($social_id, $customer_id){
		return Mage::getModel('gomage_social/entity')
					->setData('social_id', $social_id)
					->setData('type_id', $this->getSocialType())
					->setData('customer_id', $customer_id)
					->setData('website_id', Mage::app()->getWebsite()->getId())
					->save();
	}
	
	protected function createCustomer($profile){

		$customer = Mage::getModel('customer/customer');
		$password =  $customer->generatePassword(8);

		if (is_array($profile)){
			$profile = (object)$profile;
		}
		
        $customer->setData('firstname', $profile->first_name)
        		 ->setData('lastname', $profile->last_name)
        		 ->setData('email', $profile->email)
        		 ->setData('password', $password)
        		 ->setConfirmation($password);
        
        $errors = $customer->validate();

        if (is_array($errors) && count($errors)){
        	$this->getSession()->addError(implode(' ', $errors));
        	return false; 
        }

        $customer->save();

            $customer->sendNewAccountEmail(
                'confirmation',
                Mage::getSingleton('core/session')->getBeforeAuthUrl(),
                Mage::app()->getStore()->getId()
            );
        Mage::getSingleton('core/session')->addSuccess($this->__('Account confirmation is required. Please, check your email for the confirmation link. To resend the confirmation email please <a href="%s">click here</a>.', Mage::helper('customer')->getEmailConfirmationUrl($customer->getEmail())));

        return $customer;
        
	}

	protected function _getRedirectUrl($url){
		if (!$url){
    		$url = $this->getRequest()->getParam('gs_url', '');
    		
    		if (!$url && Mage::getSingleton('core/session')->getData('gs_url')){
    			$url = Mage::getSingleton('core/session')->getData('gs_url');
    			Mage::getSingleton('core/session')->unsetData('gs_url');	
    		}
    		
    		if ($url){
    			$url = Mage::helper('core')->urlDecode($url);
    		}     		
    	}
    	if (!$url){
    		$url = Mage::getBaseUrl();
    	}
		
    	return $url;
	}
	
	protected function _redirectUrl($url='')
    {
    	return parent::_redirectUrl($this->_getRedirectUrl($url));
    }

}