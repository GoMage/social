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

require_once (Mage::getBaseDir('lib') . DS . 'GoMage' . DS . 'Twitter' . DS . 'tumblroauth.php');

class GoMage_Social_TwitterController extends GoMage_Social_Controller_SocialNoMail {

    protected $_confirm ;

    public function getSocialType() {
        return GoMage_Social_Model_Type::TWITTER;
    }

    public function loginAction() {

        if ($this->getSession()->isLoggedIn()) {
            return $this->_redirectUrl();
        }

        $connection = new TwitterOAuth(Mage::getStoreConfig('gomage_social/twitter/id'), Mage::getStoreConfig('gomage_social/twitter/secret'));

        $callback_params = array('_secure' => true);
        if ($this->getRequest()->getParam('gs_url', '')) {
            $callback_params['gs_url'] = $this->getRequest()->getParam('gs_url');
        }


        $callback_url = Mage::getUrl('gomage_social/twitter/callback', $callback_params);
        $request_token = $connection->getRequestToken($callback_url);

        switch ($connection->http_code) {
            case 200:
                Mage::getSingleton('core/session')->setData('oauth_token', $request_token['oauth_token']);
                Mage::getSingleton('core/session')->setData('oauth_token_secret', $request_token['oauth_token_secret']);

                $url = $connection->getAuthorizeURL($request_token['oauth_token']);
                return $this->_redirectUrl($url);
                break;
            default:
                $this->getSession()->addError($this->__('Could not connect to Twitter. Refresh the page or try again later.'));
        }

        return $this->_redirectUrl();

    }

    public function callbackAction(){

        $oauth_token = $this->getRequest()->getParam('oauth_token');
        $oauth_verifier = $this->getRequest()->getParam('oauth_verifier');

        if (!$oauth_token || !$oauth_verifier){
            return $this->_redirectUrl();
        }


        if ($oauth_token != Mage::getSingleton('core/session')->getData('oauth_token')){
            return $this->_redirectUrl();
        }

        $connection = new TwitterOAuth(Mage::getStoreConfig('gomage_social/twitter/id'), Mage::getStoreConfig('gomage_social/twitter/secret'), Mage::getSingleton('core/session')->getData('oauth_token'), Mage::getSingleton('core/session')->getData('oauth_token_secret'));
        $access_token = $connection->getAccessToken($oauth_verifier);

        Mage::getSingleton('core/session')->unsetData('oauth_token');
        Mage::getSingleton('core/session')->unsetData('oauth_token_secret');

        $profile = null;

        switch ($connection->http_code) {
            case 200:
                $profile =  $connection->get('account/verify_credentials');

                break;
            default:
                $this->getSession()->addError($this->__('Could not connect to Twitter. Refresh the page or try again later.'));
                return $this->_redirectUrl();
        }


        if ($profile) {
            if ($profile->id){
                $social_collection = Mage::getModel('gomage_social/entity')
                    ->getCollection()
                    ->addFieldToFilter('social_id', $profile->id)
                    ->addFieldToFilter('type_id', GoMage_Social_Model_Type::TWITTER);
                if(Mage::getSingleton('customer/config_share')->isWebsiteScope()) {
                    $social_collection->addFieldToFilter('website_id', Mage::app()->getWebsite()->getId());
                }
                $social = $social_collection->getFirstItem();
                if ($social && $social->getId()){
                if($social->social_id == $profile->id){
                    $customer = Mage::getModel('customer/customer');
                    if (Mage::getSingleton('customer/config_share')->isWebsiteScope()) {
                        $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
                    }
                    $customer->load($social->getData('customer_id'));

                        if ($customer && $customer->getId()){
                            if (!$customer->getConfirmation()) {
                            $this->getSession()->loginById($customer->getId());
                            }

                        }
                      }
                }else{
                    $profile->url = Mage::getUrl('gomage_social/twitter/checkingEmail');
                    $profile->type_id =  GoMage_Social_Model_Type::TWITTER;
                    Mage::getSingleton('core/session')->setGsProfile($profile);
                }

            }
        }

      return $this->_redirectUrl();
    }

    public function checkingEmailAction(){
           $message  = array();
       if($customer_email = $this->getRequest()->getParam('email')){
           $customer = Mage::getModel("customer/customer");
           $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
           $customer->loadByEmail($customer_email);
           if($profile = Mage::getSingleton('core/session')->getGsProfile()){
               if($customer->getId()){
                   $message['redirect'] = '/customer/account/login/';
                   Mage::getSingleton('core/session')->addNotice('There is already an account with this email address. We suggest using the standard login form.');
                   $profile->url = null;
                   Mage::getSingleton('core/session')->setGsProfile($profile);
               }else{
                       $social_collection = Mage::getModel('gomage_social/entity')
                           ->getCollection()
                           ->addFieldToFilter('social_id', $profile->id)
                           ->addFieldToFilter('type_id', GoMage_Social_Model_Type::TWITTER);

                       if(Mage::getSingleton('customer/config_share')->isWebsiteScope()) {
                           $social_collection->addFieldToFilter('website_id', Mage::app()->getWebsite()->getId());
                       }
                       $social = $social_collection->getFirstItem();

                       $customer = null;

                       if ($social && $social->getId()){
                           $customer = Mage::getModel('customer/customer');
                           if (Mage::getSingleton('customer/config_share')->isWebsiteScope()) {
                               $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
                           }
                           $customer->load($social->getData('customer_id'));
                       }

                       if ($customer && $customer->getId()){
                           if (!$customer->getConfirmation()) {
                        $this->getSession()->loginById($customer->getId());
                           }
                       } else {

                           $customer = Mage::getModel('customer/customer');
                           if (Mage::getSingleton('customer/config_share')->isWebsiteScope()) {
                               $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
                           }

                           $name = explode(" ", $profile->name);
                           $profile->email = $customer_email;
                           $profile->first_name =  $name[0];
                            if(isset($name[1])){
                               $profile->last_name = $name[1];
                           }else{
                               $profile->last_name = $name[0];
                           }



                           $customer->loadByEmail($profile->email);

                           if (!$customer->getId()){
                               $customer = $this->createCustomer($profile);
                           }

                           if ($customer && $customer->getId()){
                               $this->createSocial($profile->id, $customer->getId());
                               $customer->setConfirmation(true);
                               if (!$customer->getConfirmation()) {
                              $this->getSession()->loginById($customer->getId());
                               }
                           }
                           Mage::getSingleton('core/session')->unsGsProfile();
                       }

               }
           }
       }

        $message['success'] = true;
        return $this->getResponse()->setBody(Zend_Json::encode($message));
    }
}