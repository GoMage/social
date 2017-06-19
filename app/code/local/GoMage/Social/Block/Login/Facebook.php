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

class GoMage_Social_Block_Login_Facebook extends GoMage_Social_Block_Login {
	
	public function __construct() {
		parent::__construct();	
		$this->setTemplate('gomage/social/login/facebook.phtml');
	}
}
