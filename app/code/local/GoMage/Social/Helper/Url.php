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

class GoMage_Social_Helper_Url extends Mage_Core_Helper_Abstract
{
	public function isSecure($url = null)
	{			
		return 
			($url)
				? (parse_url($url, PHP_URL_SCHEME) == 'https')
					: (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on');
	}
	
	public function getUrl($route = '', array $params = array())
	{		
		$this->detectProtocol();
		
		$params['_secure'] = $this->isSecure();;
		
		return Mage::getUrl($route, $params);
	}
}