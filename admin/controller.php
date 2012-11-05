<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0
*   License: 	GPL v3.0
*
*   This extension is free software: you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation, either version 3 of the License, or
*   (at your option) any later version.
*
*   This extension is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*   GNU General Public License for more details <http://www.gnu.org/licenses/>.
*
*/

defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

JTable::addIncludePath( JPATH_COMPONENT.DS.'tables' );

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper'.'.php');

class WeeverController extends JController
{

	public function phpinfo()
	{
	
		phpinfo();
		jexit();
		
	}

	
	public function upload()
	{
		
		require_once ( JPATH_COMPONENT . DS . 'classes' . DS . 'fileuploader.php' );
	
		# Images must be png, jpg, jpeg, gif, or svg and less than 1.5 MB 
		$allowedExtensions 	= array("png", "jpg", "jpeg", "gif", "svg");
		$sizeLimit 			= 1536000;
		
		$uploader 			= new qqFileUploader( $allowedExtensions, $sizeLimit );
		$result 			= $uploader->handleUpload( JPATH_ROOT . DS . 'images' . DS .'com_weever'. DS );
		
		if( isset($result['success']) )
		{

			$result['url'] 	= 'http://' . comWeeverHelper::getSiteDomain() . '/images/com_weever/' . $result['filename'];
			$model 			= $this->getModel( 'ajax' );

			$response 		= $model->saveImageUrl( $result['url'] );
			
		}	

		echo htmlspecialchars( json_encode($result), ENT_NOQUOTES );
		
		jexit();
	
	}
	

	public function ajaxSaveTabName()
	{
	
		$model = $this->getModel('ajax');
	
		$result = $model->saveTabName( JRequest::getVar("name"), JRequest::getVar("id") );
	
		if( $result->success )
			echo "Tab Changes Saved";
		
		jexit();
	
	}
	
	public function ajaxSaveTabItemName()
	{
	
		$model = $this->getModel('ajax');
	
		$result = $model->saveTabItemName( JRequest::getVar("name"), JRequest::getVar("id") );
	
		if( $result->success )
			echo "Tab Changes Saved";
		
		jexit();
	
	}
	
	
	public function ajaxTabDelete()
	{

		$model = $this->getModel('ajax');
	
		$result = $model->deleteTab( JRequest::getVar("id") );

		if( $result->success )
			echo "Item Deleted";
		
		jexit();
	
	}
	
	
	public function ajaxTabPublish()
	{

		$status 	= JRequest::getVar('status');
		$id 		= JRequest::getVar('id');
		
		if($status == 1)		
			$publish = 0;
		else
			$publish = 1;
			
		$model 		= $this->getModel('ajax');
		$result 	= $model->saveTabPublish( $id, $publish );
		
		if( $result->success )
			echo "Item Status Updated";
	
		jexit();		
	
	}
	

	public function ajaxSaveTabIcon()
	{
	
		$jsonResult = comWeeverHelper::pushTabIconToCloud();

		echo "Icon Saved";
		
		jexit();
	
	}
	
	public function ajaxSaveTabOrder()
	{
	
		$model = $this->getModel('ajax');
	
		$result = $model->saveTabOrder( JRequest::getVar("order") );
		
		if( $result->success )
			echo "Order Updated";
	
		jexit();
	
	}
	
	public function ajaxToggleAppStatus()
	{
	
		$model = $this->getModel('ajax');
		
		if( JRequest::getVar("app_enabled") == 1 )
			$r_str	= "App Online";
		else 
			$r_str	= "App Offline";
	
		$result		= $model->saveAppStatus();
		$response 	= isset( $result->success ) 	? $r_str 	: "Server Error Occurred";
		
		echo $response;
		
		jexit();
	
	}
	
	public function ajaxUpdateTabSettings()
	{
	
		//$response = comWeeverHelper::updateTabSettings();
		
		echo $response;
		
		jexit();
	
	}
	
	public function ajaxSaveNewTab()
	{
	
		$model = $this->getModel('ajax');
		
		if(  JRequest::getVar("content") == "contact" ) {
				
			$type_method = "_buildContactFeedURL";
			comWeeverHelper::$type_method();
			
		}
	
		$result = $model->saveNewTab( 
		
			JRequest::getVar("config"), 
			JRequest::getVar("title"), 
			JRequest::getVar("content"), 
			JRequest::getVar("layout"), 
			JRequest::getVar("icon_id"), 
			JRequest::getVar("published"),
			JRequest::getVar("parent_id"),
			JRequest::getVar("config_cache")
			
		);

		if( $result->success )
			echo "Item Added";
	
		jexit();
	
	}


	public function ajaxTabMove()
	{
	
		$model = $this->getModel('ajax');
	
		$result = $model->moveTab( 
		
			JRequest::getVar("tab_id"), 
			JRequest::getVar("parent_id")
			
		);

		if( $result->success )
			echo "Item Moved";
	
		jexit();
	
	}	

	public function remove()
	{
		
		JRequest::checkToken() or jexit('Invalid Token');
		
		$model 		= $this->getModel('ajax');
		$option 	= JRequest::getCmd('option');
		
		$result 	= $model->deleteTab( JRequest::getVar('cid', array(0)) );

		if($result->success)
			$this->setRedirect('index.php?option='.$option.'&view=list', JText::_('WEEVER_SERVER_RESPONSE').$result->message);	
		else
			$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');
	
	}
	
	public function staging()
	{
	
		$row =& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		
		$staging = $row->setting;
		
		if($staging)
			$msg = comWeeverHelper::disableStagingMode();
		else
			$msg = comWeeverHelper::enableStagingMode();
			
		$this->setRedirect('index.php?option=com_weever&view=account&task=account',$msg);
		return;
	
	}
	
	public function save()
	{
		
		$option = JRequest::getCmd('option');
		JRequest::checkToken() or jexit('Invalid Token');
	
		if(JRequest::getVar('view') == "config")
		{
		
			$model 		= $this->getModel( 'config' );
			$json 		= $model->saveConfig();
			$response	= json_decode( $json );
			$message	= JText::_('WEEVER_CONFIG_SAVED');
			
			if( $response->error == true )
				$message	= JText::_('WEEVER_SERVER_ERROR') . $response->message;
			
			if( comWeeverConst::API_DEBUG == true )
				$message 	.= "[API_DEBUG] - Executed in " . $response->call->execution_time . 
								"; JSON RESPONSE: <input type='text' value='" . $json ."' />";
			
			$this->setRedirect( 'index.php?option=com_weever&view=config&task=config', $message );
			
			return;
			
		}
		
		if(JRequest::getVar('view') == "design")
		{
		
			$model 		= $this->getModel( 'design' );
			$json 		= $model->saveDesign();
			$response	= json_decode( $json );
			$message	= JText::_('WEEVER_THEME_SAVED');
		
			if( $response->error == true )
				$message	= JText::_('WEEVER_SERVER_ERROR') . $response->message;
			
			if( comWeeverConst::API_DEBUG == true )
				$message 	.= "[API_DEBUG] - Executed in " . $response->call->execution_time . 
								"; JSON RESPONSE: <input type='text' value='" . $json ."' />";
						
			$this->setRedirect('index.php?option=com_weever&view=design&task=design', $message);
			
			return;
			
		}
		
		if(JRequest::getVar('view') == "account")
		{
			if(JRequest::getVar('staging') == 1)
			{
				$row =& JTable::getInstance('WeeverConfig', 'Table');
				$row->load(7);
				$row->setting = 1;
				$row->store();			
			}
				
			comWeeverHelper::saveAccount();
			
			if(JRequest::getVar("install"))
				$this->setRedirect('index.php?option=com_weever&view=list',JText::_('WEEVER_ACCOUNT_SAVED'));
			else
				$this->setRedirect('index.php?option=com_weever&view=account&task=account',JText::_('WEEVER_ACCOUNT_SAVED'));
				
			return;
		}
		
		$tab_id = null;
		$hash = md5(microtime() . JRequest::getVar('name'));
		
		$type = JRequest::getWord('type', 'tab');
				
		$type_method = "_build".$type."FeedURL";
		
		// ### check later
		if(JRequest::getVar('view' == "contact"))
		{
			comWeeverHelper::getContactInfo();		
		}
		
		$rss = comWeeverHelper::$type_method();
		
		if($rss === false)
		{
			$this->setRedirect('index.php?option=com_weever&view=tab&task=add&layout='.JRequest::getVar('layout', 'blog'), JText::_('WEEVER_MUST_CHOOSE_OPTION_FROM_DROPDOWN'), 'error');
			return;
		}
		
		
		JRequest::setVar('rss', $rss, 'post');
		JRequest::setVar('hash', $hash, 'post');
		JRequest::setVar('weever_server_response', comWeeverHelper::pushSettingsToCloud(), 'post');
		
		if(JRequest::getVar('weever_server_response') == "Site key missing or invalid.")
		{
			$this->setRedirect('index.php?option='.$option.'&view=list', JText::_('WEEVER_SERVER_ERROR').JRequest::getVar('weever_server_response'), 'notice');	
			return;
		}
		
		$row =& JTable::getInstance('weever','Table');

		
		if(!$row->bind(JRequest::get('post')))
		{
			JError::raiseError(500, $row->getError());
		}
		
		$row->ordering = $row->ordering + 0.1; // for later reorder to sort well if it is in collision with another.
		
		if(!$row->store())
		{
			JError::raiseError(500, $row->getError());
		}
		
		comWeeverHelper::reorderTabs($type);
		comWeeverHelper::pushLocalIdToCloud($row->id, JRequest::getVar('hash'), JRequest::getVar('site_key'));
		
		if(JRequest::getVar('weever_server_response'))
		{
				
			if($this->getTask() == 'apply')
				$this->setRedirect('index.php?option='.$option.'&view=tab&task=edit'.'&cid[]='.$row->id,
					JText::_('WEEVER_SERVER_RESPONSE').JRequest::getVar('weever_server_response'));
			else		
				$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_SERVER_RESPONSE').JRequest::getVar('weever_server_response'));
				
			return;
		}
		else
		{
			$this->setRedirect('index.php?option='.$option.'&view=list',JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');
			
			return;
		}
	
	}

	
	public function display()
	{
	
		$view = JRequest::getVar('view');
		
		if(!$view)
		{
			JRequest::setVar('view','list');
		}
		
		parent::display();
	
	}
	
	
	public function publish()
	{

		JRequest::checkToken() or jexit('Invalid Token');
		
		$model 		= $this->getModel( 'ajax' );
		$option 	= JRequest::getCmd( 'option' );
		$cid 		= JRequest::getVar( 'cid', array() );
		$publish 	= 1;
		
		if( $this->getTask() == 'unpublish' )
			$publish = 0;
		
		if(!$cid)
			$cid[] = JRequest::getVar( 'id', array() );

		$result 	= $model->saveTabPublish( $cid, $publish );

		if($result->success)
			$this->setRedirect('index.php?option='.$option, JText::_('WEEVER_SERVER_RESPONSE').$result->message);
		else
			$this->setRedirect('index.php?option='.$option, JText::_('WEEVER_ERROR_COULD_NOT_CONNECT_TO_SERVER'), 'error');

	
	}


}
