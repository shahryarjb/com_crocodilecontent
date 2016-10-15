<?php
/**
 * @package		Joomla.Site
 * @subpackage	plg_content_contentforcrocodile
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.utilities.date');
jimport( 'joomla.form.form' );

/**
 * An example custom profile plugin.
 *
 * @package		Joomla.Plugin
 * @subpackage	User.profile
 * @version		1.6
 */
class plgContentContentforcrocodile extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       2.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	 * @param	string	$context	The context for the data
	 * @param	int		$data		The user id
	 * @param	object
	 *
	 * @return	boolean
	 * @since	2.5
	 */
	function onContentPrepareData($context, $data)
	{
		if (is_object($data))
		{
			$articleId = isset($data->id) ? $data->id : 0;
			if (!isset($data->contentforcrocodile) and $articleId > 0)
			{
				// Load the profile data from the database.
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select('profile_key, profile_value');
				$query->from('#__user_profiles');
				$query->where('user_id = ' . $db->Quote($articleId));
				$query->where('profile_key LIKE ' . $db->Quote('rating.%'));
				$query->order('ordering');
				$db->setQuery($query);
				$results = $db->loadRowList();

				// Check for a database error.
				if ($db->getErrorNum())
				{
					$this->_subject->setError($db->getErrorMsg());
					return false;
				}

				// Merge the profile data.
				$data->contentforcrocodile = array();

				foreach ($results as $v)
				{
					$k = str_replace('contentforcrocodile.', '', $v[0]);
					$data->contentforcrocodile[$k] = json_decode($v[1], true);
					if ($data->contentforcrocodile[$k] === null)
					{
						$data->contentforcrocodile[$k] = $v[1];
						
						
					}
				}
			}
		}
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('contentforcrocodile');

		
		return true;
		

	}

	/**
	 * @param	JForm	$form	The form to be altered.
	 * @param	array	$data	The associated data for the form.
	 *
	 * @return	boolean
	 * @since	2.5
	 */
	function onContentPrepareForm($form, $data)
	{

		if (!($form instanceof JForm))
		{
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}
		//------------------load form from file-----------------------------
		JForm::addFormPath(dirname(__FILE__) . '/contentforcrocodile');
		$form->loadFile('contentforcrocodile', false);
		//-----------------get data from form--------------------------------
		
		
			
		foreach ($data as $field) {
			if(gettype($field) == "array") {
				foreach($field as $key => $value) {
					
					if($key == "published") {
						$published = $value;
					}
					if($key == "pic") {
						$pic = $value;
					}
					if($key == "width") {
						$width = $value;
					}
					if($key == "height") {
						$height = $value;
					}
					if($key == "type") {
						$type = $value;
					}
					if($key == "custom") {
						$custom = $value;
					}
					if($key == "template_name") {
						$template_name = $value;
					}
					if($key == "label_name") {
						$label_name = $value;
					}
					if($key == "first_day") {
						$first_day = $value;
					}
					if($key == "last_day") {
						$last_day = $value;
					}
					if($key == "second_ttl") {
						$second_ttl = $value;
					}
					if($key == "sign") {
						$sign = $value;
					}
					if($key == "attached_file") {
						$attached_file = $value;
					}
					if($key == "show_id") {
						$show_id = $value;
					}
				}
			}
		}
	
		//------------------------------------------------------------------------------------------------Upload
		
						jimport('joomla.filesystem.file'); // for file upload

						// Include dependancy of the dispatcher
						if (!defined( 'DS' )) define('DS',DIRECTORY_SEPARATOR);
						jimport('joomla.filesystem.folder');
						JFolder::create(JPATH_ROOT.DS.'media'.DS.'plg_crocodile');
					
						$target_dir = "media/plg_crocodile/";
						$target_file = $target_dir . basename($_FILES["attached_file"]["name"]);
						//echo $_FILES[$attached_file]["name"];
						//$file_tmp =$_FILES[$attached_file]['tmp_name'];
						if(move_uploaded_file($_FILES["attached_file"]['tmp_name'],$target_file)){
							echo "File is valid, and was successfully uploaded.\n";
						} else {
							echo "Possible file upload attack!\n";
						}
						
						//------------------------------------------------------------------------------------------------Upload
		//-------------------get article_id from database to know that if there is Duplicate information---------------------------------
		$db = JFactory::getDbo();
		$queryy = $db->getQuery(true);
		$queryy->select('article_id');
		$queryy->from('#__crocodilecontent');
		$queryy->where('published=1');
		$db->setQuery($queryy);
		$results = $db->loadRowList();
		//-------------------------check if admin is in article view--------------------------------------------
		if (JRequest::getVar('option')==='com_content' && JRequest::getVar('view')==='article') {
			$idd = $data->id;
			//--------------------------loop to check if there is Duplicate information---------------------------------
			foreach($results as $res) {
				foreach ($res as $key => $value) {
					if ($value == $idd) {
						$exist = $idd;  // $idd is not important I just wanted to set sth 
					} else {
						$notexist = $idd; // $idd is not important I just wanted to set sth 
					}	
				}
			} 
			//-------------------------------UPDATE database----------------------------------------------------------------
			
			if (isset($exist)) {
				if(isset($published)) {
					$db = JFactory::getDBO();
					$queryyy = $db->getQuery(true);
					$queryyy->update('#__crocodilecontent');
					$queryyy->set("pic='" . $pic."',width='" .$width. "',height='" .$height. "',type=" .$type. ",custom='" .$custom. "',template_name='" .$template_name. "',label_name='" .$label_name. "',published=" .$published. ",first_day='" .$first_day. "',last_day='" .$last_day. "',second_ttl='" .$second_ttl. "',sign='" .$sign. "',attached_file='" .$attached_file. "',show_id='" .$show_id. "'");
					$queryyy->where('article_id=' . $exist); 
					$db->setQuery($queryyy);
					$db->query();
				}
			//----------------------------------INSERT in database----------------------------------------------------------------	
			}else if (isset($notexist) || $results = "Array ( )") {
				if(isset($published)) {
					$db = JFactory::getDbo();
					$db->setQuery("INSERT INTO #__crocodilecontent SET name='" .$data->title. "',pic='" . $pic."',article_id=" . $data->id . ",width='" .$width. "',height='" .$height. "',type=" .$type. ",custom='" .$custom. "',template_name='" .$template_name. "',label_name='" .$label_name. "',published=" .$published. ",first_day='" .$first_day. "',last_day='" .$last_day. "',second_ttl='" .$second_ttl. "',sign='" .$sign. "',attached_file='" .$attached_file. "',show_id='" .$show_id. "'");
					$db->execute();
				} // end if
			} // end of else
		 } // end of article view
		 
		
		 
		return true;
	}

	/**
	 * Example after save content method
	 * Article is passed by reference, but after the save, so no changes will be saved.
	 * Method is called right after the content is saved
	 *
	 * @param	string		The context of the content passed to the plugin (added in 1.6)
	 * @param	object		A JTableContent object
	 * @param	bool		If the content is just about to be created
	 * @since	2.5
	 */

public function onContentAfterDelete($context, $article)
  {
    
    $articleId  = $article->id;
    if ($articleId) {
      try
      {
        
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);
        $query->delete($db->quoteName('#__crocodilecontent'));
        $query->where('article_id = ' . $db->Quote($articleId));
        $db->setQuery($query);
        
        $db->execute(); 

      }

      catch (RuntimeException $e) { 
        echo $e->getMessage(); 
      }
    }

    return true;
  }
	
	
//--------------------------------PLG Scmlabel-------------------------------------------------------	
public function onContentPrepare($context, &$article, &$params, $limitstart) {
	

//---------------------------get id from #__content for count---------------------------------
    $db = JFactory::getDbo();
    $queryy = $db->getQuery(true);

      $queryy->select('id');
	  $queryy->from('#__content');
      $queryy->order('id DESC');
	  $db->setQuery($queryy);
      $row = $db->loadAssocList();
      $count = $row[0]["id"];
//---------------------------------------------------------------------------------------------
  $document = JFactory::getDocument();

//--------------------------get data from #__crocodilecontent-------------------------------------------
  $db = JFactory::getDbo();
  $query = $db->getQuery(true); 
  
      $query->select('co.*,b.label as labelname,b.type as labeltype,c.id as conid');
	  $query->from('#__crocodilecontent as co');
      $query->where('published = 1');
	  $query->leftJoin('#__content as c ON co.article_id=c.id');
      $query->leftJoin('#__label as b ON co.label_name=b.id');		  
      $db->setQuery($query);
      $varDB = $db->loadAssocList();
//----------------------------------------------------------------------------------------------

//------------------------------check if user is in article view--------------------------------
    if (JRequest::getVar('option')==='com_content' && JRequest::getVar('view')==='article') {
    
        //-----------------------------show label in article view-----------------------------------


        for($i = 0; $i < $count; $i++) {
            if(isset($varDB[$i]["labelname"])) {
                 if(isset($varDB[$i]["first_day"]) && isset($varDB[$i]["last_day"]) && strtotime($varDB[$i]["first_day"]) <= strtotime(date("Y/m/d")) && strtotime(date("Y/m/d")) <= strtotime($varDB[$i]["last_day"])) {
                    if($article->title == $varDB[$i]["name"]) {
                        $article->title = $varDB[$i]["name"] . " ".$varDB[$i]["labelname"].$varDB[$i]["labeltype"];
						if( $varDB[$i]["show_id"] == 1){
							$article->text = "شناسه متن : ".$article->id.$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}else {
							$article->text =$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}
                    }
                 } else if(strtotime($varDB[$i]["first_day"]) < 0 || strtotime($varDB[$i]["last_day"]) < 0){
                     if($article->title == $varDB[$i]["name"]) {
                        $article->title = $varDB[$i]["name"] . " ".$varDB[$i]["labelname"].$varDB[$i]["labeltype"];
						if( $varDB[$i]["show_id"] == 1){
							$article->text = "شناسه متن : ".$article->id.$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}else {
							$article->text =$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}
                    }
                 }
            }
        }
        //------------------------------------------------------------------------------------------         
    }
//----------------------------------end of article view-----------------------------------------

//----------------------------------check if user is in front page------------------------------
    $app = JFactory::getApplication();
    $menu = $app->getMenu();
    if ($menu->getActive() == $menu->getDefault()) {
    //------------------------show label in front page------------------------------------------


		

        for($i = 0; $i <= $count; $i++) {
            if(isset($varDB[$i]["labelname"]) || isset($varDB[$i]["second_ttl"]) || isset($varDB[$i]["sign"])) {
                if(isset($varDB[$i]["first_day"]) && isset($varDB[$i]["last_day"]) && strtotime($varDB[$i]["first_day"]) <= strtotime(date("Y/m/d")) && strtotime(date("Y/m/d")) <= strtotime($varDB[$i]["last_day"])) {
                    if($article->title == $varDB[$i]["name"]) {  
                        $article->title = $varDB[$i]["name"] . " ".$varDB[$i]["labelname"].$varDB[$i]["labeltype"];
						if( $varDB[$i]["show_id"] == 1){
							$article->text = "شناسه متن : ".$article->id.$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}else {
							$article->text =$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}
                    }
                }else if(strtotime($varDB[$i]["first_day"]) < 0 || strtotime($varDB[$i]["last_day"]) < 0){
                     if($article->title == $varDB[$i]["name"]) {
                        $article->title = $varDB[$i]["name"] . " ".$varDB[$i]["labelname"].$varDB[$i]["labeltype"];
						if( $varDB[$i]["show_id"] == 1){
							$article->text = "شناسه متن : ".$article->id.$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}else {
							$article->text =$varDB[$i]["second_ttl"]. $article->text.$varDB[$i]["sign"];
						}
						
                    }
                 }
            }   
        }
		
    //-------------------------------------------------------------------------------------------
    }
    //-----------------------------end of PLG Scmlabel-----------------------------------------  
	//----------------------------PLG BackPic--------------------------------------------------
	if (JRequest::getVar('option')==='com_content' && JRequest::getVar('view')==='article') {
			$articleId = JRequest::getInt('id');
			//$db =& JFactory::getDBO();
		}else {
			return false;	
		}
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			
		
			$query->select('*');
			$query->from('#__backpic');
			$query->where('article_id = ' . $articleId);
			$query->where('published = 1');
			$query->where('type = 1');
				 
			$db->setQuery($query);
			$row = $db->loadAssoc();

			if ($row['published'] == 1 AND $row['type'] == 1) {
				
				$row['pic'] 			= htmlspecialchars($row['pic'], ENT_QUOTES, 'UTF-8');
				$row['width'] 			= htmlspecialchars($row['width'], ENT_QUOTES, 'UTF-8');
				$row['height'] 			= htmlspecialchars($row['height'], ENT_QUOTES, 'UTF-8');
				$row['custom'] 			= htmlspecialchars($row['custom'], ENT_QUOTES, 'UTF-8');
				$row['menudbid']		= htmlspecialchars($row['menudbid'], ENT_QUOTES, 'UTF-8');
				$row['template_name']	= htmlspecialchars($row['template_name'], ENT_QUOTES, 'UTF-8');

				//echo $row['template_name'];

				if (!empty($row['template_name']) AND !empty($row['template_name'] == 0)) {

					$selectsetTemplate = JFactory::getApplication();
			 		$selectsetTemplate->setTemplate("{$row['template_name']}", null);
				}
			
			$doc = JFactory::getDocument();
			$UrlSite = JURI::root();
				if (!empty($row['pic'])) {
					$doc->addStyleDeclaration("
						body {background: url('{$UrlSite}{$row['pic']}') no-repeat ;background-size: {$row['width']} {$row['height']};}
				");
				}
				
				if (!empty($row['custom'])) {
					$doc->addStyleDeclaration("
						{$row['custom']}
				");
				}
			}
			

	
} // end function
	
}
