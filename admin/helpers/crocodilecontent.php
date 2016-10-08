<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_crocodilecontent
 */
defined('_JEXEC') or die('Restricted access');

abstract class CrocodileContentHelper {

	public static function addSubmenu($submenu) 
	{

		JSubMenuHelper::addEntry(
			'<i class="fa fa-angle-double-left"></i>' . JText::_("COM_BACKPIC_ADMIN_PANEL_HOME"),
			'index.php?option=com_crocodilecontent',
			$submenu == 'home'
		);
		
		JSubMenuHelper::addEntry(
			'<i class="fa fa-angle-double-left"></i>' . JText::_("COM_CROCODILECONTENT_ADMIN_PANEL_LABEL"),
			'index.php?option=com_crocodilecontent&view=labels',
			$submenu == 'label'
		);

		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-crocodileContent ' .
		                               '{background-image: url(../media/com_crocodilecontent/images/tux-48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_BACKPIC_ADMINISTRATION_CATEGORIES'));
		}
	}

	public static function getActions($messageId = 0) {	
		$result	= new JObject;

		if (empty($messageId)) {
			$assetName = 'com_crocodilecontent';
		}
		else {
			$assetName = 'com_crocodilecontent.message.'.(int) $messageId;
		}

		$actions = JAccess::getActions('com_crocodilecontent', 'component');

		foreach ($actions as $action) {
			$result->set($action->name, JFactory::getUser()->authorise($action->name, $assetName));
		}

		return $result;
	}
}
