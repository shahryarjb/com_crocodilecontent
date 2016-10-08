<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_Crocodilecontent
 */
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
//$document->addStyleDeclaration('.icon-backpic {background-image: url(../media/com_backpic/images/tux-16x16.png);}');

if (!JFactory::getUser()->authorise('core.manage', 'com_crocodilecontent'))
{
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

JLoader::register('CrocodileContentHelper', JPATH_COMPONENT . '/helpers/crocodilecontent.php');

$controller = JControllerLegacy::getInstance('crocodilecontent');

$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

$controller->redirect();
