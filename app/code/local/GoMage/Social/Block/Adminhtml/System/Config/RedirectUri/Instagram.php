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
class GoMage_Social_Block_Adminhtml_System_Config_RedirectUri_Instagram
    extends GoMage_Social_Block_Adminhtml_System_Config_AbstractRedirectUri
{
    public function getTypeService()
    {
        return GoMage_Social_Model_Type::getTypeService(GoMage_Social_Model_Type::INSTAGRAM);
    }
}