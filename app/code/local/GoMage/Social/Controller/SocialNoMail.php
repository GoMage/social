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

abstract class GoMage_Social_Controller_SocialNoMail extends GoMage_Social_Controller_Social {

	
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

}