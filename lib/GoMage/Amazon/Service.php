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
 * @since        Class available since Release 1.2.0
 */ 
 
class GoMage_Amazon_Service extends GoMage_OAuth_Service
{
	const SERVICE_ENDPOINT			= 'https://www.amazon.com/ap/user/profile';
	const AUTHORIZATION_ENDPOINT	= 'https://www.amazon.com/ap/oa';
	const ACCESS_TOKEN_ENDPOINT		= 'https://www.amazon.com/ap/oatoken';
	
	public $useragent		= 'Amazon OAuth';
}