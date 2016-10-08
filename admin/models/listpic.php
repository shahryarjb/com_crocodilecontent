<?php
/**
 * @copyright   Copyright (C) 2016 Open Source Matters, Inc. All rights reserved. ( https://trangell.com )
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @subpackage  com_crocodilecontent
 */

		
defined('_JEXEC') or die('Restricted access');

//========================================================================= add by mojtaba
//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file'); // for file upload

// Include dependancy of the dispatcher
if (!defined( 'DS' )) define('DS',DIRECTORY_SEPARATOR);
//========================================================================= add by mojtaba

class CrocodileContentModelListpic extends JModelAdmin
{

	public function getTable($type = 'listpic', $prefix = 'CrocodileContentTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm(
			'com_crocodilecontent.listpic',
			'listpic',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	public function getScript() 
	{
		return 'administrator/components/com_crocodilecontent/models/forms/listpic.js';
	}

	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_crocodilecontent.edit.listpic.data',
			array()
		);

		if (empty($data)) {
			$data = $this->getItem();
		}

		// if($data->cat_id){
		// $data->cat_id = explode(',', $data->cat_id);
		// }
		return $data;
	}

	protected function canDelete($record) {
		if( !empty( $record->id ) ) {
			return JFactory::getUser()->authorise( "core.delete", "com_crocodilecontent.message." . $record->id );
		}
	}
	
	public function uploads($files) { //============================ edit by mojtaba
		// toye in function dige moshakhas has ma file ro upload mikonim 
		$file = $files['attached_file'] ;
		$ext = JFile::getExt($file['name']) ; 
	
		if (sizeof($files) === 1) {
			$filename = 'test'.'.'.$ext;  // toye in khat man esme file ro dadam 'test' shoma bar asase chizi ke mad nazar darin avaz konid
			$src = $file['tmp_name'];
		    $dest =  JPATH_SITE . DS .  "media" . DS . 'com_crocodileContent' . DS . 'images' . DS  ;
			//------------------
			$this->uploadImage($ext,$src,($dest.$filename));
		}
			
	}
	//======================================================================= upload file 
	public function uploadImage($ext,$src,$dest) {
		
		if ( strtolower($ext == 'jpg') ||  strtolower($ext == 'jpeg') || strtolower($ext == 'png') ||  strtolower($ext == 'zip')) {
			if ( JFile::upload($src, $dest) ) {
				return true; // upload ok
			} else {
				return false; // upload error
			}
		} else {
			return false;
		}
	}
}
