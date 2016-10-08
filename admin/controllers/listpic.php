<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_MiniUniversity
 */
defined('_JEXEC') or die('Restricted access');

class CrocodileContentControllerListpic extends JControllerForm {

	protected function allowAdd($data = array()) {
		return parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id') {
		//========================================================================= add by mojtaba
		// Check for request forgeries.
		// Initialise variables.
		$app	= JFactory::getApplication('site');
		$model	= $this->getModel('listpic');
		$id = $app->input->getInt('id');
		$jinput = JFactory::getApplication()->input;
		$files = $jinput->files->get('jform');
        $upditem	= $model->uploads($files);  // toye in khat maghadir ro be function 'uploads' ke toye file model ma hast mifrestim
		$link = JRoute::_('index.php?option=com_crocodilecontent&view=listpic&layout=edit&id='. $id,false);
		//========================================================================= add by mojtaba

		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) ) {
			return JFactory::getUser()->authorise( "core.edit", "com_crocodilecontent.message." . $id );
		}
	}
	
	protected function postSaveHook(JModelLegacy &$model, $validData = array()) {
		if(isset($validData['cat_id'])){
		$data['cat_id'] = implode(',', $validData['cat_id']);
		
		return $model->save($data);
		}
	}

}
