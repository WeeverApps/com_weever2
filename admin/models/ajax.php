<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 4
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

jimport('joomla.application.component.model');

if( !class_exists("JModelLegacy") ) 
{

	class JModelLegacy extends JModel{};
	
}

class WeeverModelAjax extends JModelLegacy
{

	protected $key;

	public function __construct() {
	
		parent::__construct();
		
		$this->key 	= comWeeverHelper::getKey();

	}
	
	
	protected function makeAPICall( $api_endpoint, $remote_query )
	{

		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
	
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		$json		= json_decode( $response );

		if( isset($json->error) && $json->error == true  )
		{
		
			 JError::raiseNotice(100, JText::_( "Server replied: " . $json->message ));
			 return false;
			 
		}
		
		return $json;

	}
	
	
	public function saveTabName( $name, $tab_id ) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'tabTitle'		=> $name,
			'tab_id'		=> $tab_id
		
		);
	
		return $this->makeAPICall( "tabs/set_tabTitle", $remote_query );
	
	}


	public function saveTabIcon() 
	{
	
		$remote_query 		= array( 	
			
			'app_key' 		=> $this->key,
			'icon_id'		=> JRequest::getVar("icon_id", 1),
			'tab_id'		=> JRequest::getVar("tab_id")
		
		);
	
		return $this->makeAPICall( "tabs/set_icon_id", $remote_query );
	
	}	
	
	
	public function saveTabItemName( $name, $tab_id ) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'title'			=> $name,
			'tab_id'		=> $tab_id
		
		);
	
		return $this->makeAPICall( "tabs/set_title", $remote_query );
	
	}
	
	
	public function saveTabLayout( $tabLayout, $tab_id )
	{
	
		$remote_query		= array(
		
			'site_key'		=> $this->key,
			'tabLayout'		=> $tabLayout,
			'tab_id'		=> $tab_id
		
		);
		
		return $this->makeAPICall( "tabs/set_tabLayout", $remote_query );
	
	}
	
	
	public function saveTabOrder( $order ) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'order'			=> $order
		
		);
	
		return $this->makeAPICall( "tabs/sort_tabs", $remote_query );
	
	}
	
	
	public function saveTabPublish( $id, $publish ) 
	{
	
		if( is_array($id) )
			$id = implode( ",", $id );
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'tab_id'		=> $id,
			'published'		=> $publish
		
		);
		
		return $this->makeAPICall( "tabs/set_published", $remote_query );
	
	}


	public function deleteTab( $id ) 
	{
	
		if( is_array($id) )
			$id = implode( ",", $id );

		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'tab_id'		=> $id
		
		);
		
		return $this->makeAPICall( "tabs/delete", $remote_query );
	
	}
	
	
	public function moveTab( $tab_id, $parent_id ) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'tab_id'		=> $tab_id,
			'parent_id'		=> $parent_id
		
		);
		
		return $this->makeAPICall( "tabs/set_parent_id", $remote_query );
	
	}
	
	
	public function saveImageUrl( $url )
	{
	
		$remote_query = array( 
		
			"type" 			=> JRequest::getVar("type"),
			'site_key' 		=> $this->key,
			
		);
		
		switch( $remote_query["type"] )
		{
		
			case "phone_load":
			
				$remote_query["launchscreen_phone"]		= $url;
			
				return $this->makeAPICall( "design/set_launchscreen_phone", $remote_query );
				
				break;
				
			
			case "icon":
			
				$remote_query["app_icon"]		= $url;
				
				return $this->makeAPICall( "design/set_app_icon", $remote_query );
				
				break;
				
			
			case "tablet_load":
			
				$remote_query["launchscreen_tablet"]		= $url;
			
				return $this->makeAPICall( "design/set_launchscreen_tablet", $remote_query );
				
				break;
				
			
			case "tablet_landscape_load":
			
				$remote_query["launchscreen_tablet_landscape"]		= $url;
			
				return $this->makeAPICall( "design/set_launchscreen_tablet_landscape", $remote_query );
				
				break;
				
				
			case "titlebar_image":
			
				$remote_query["titlebar_image"]		= $url;
				
				return $this->makeAPICall( "design/set_titlebar_image", $remote_query );
				
				break;
		
		}
	
	}
	
	
	public function saveNewTab( $config, $title, $content, $layout, $tabLayout, $icon_id, $published, $parent_id, $config_cache, $geo ) 
	{

		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'config'		=> $config,
			'title'			=> $title,
			'content'		=> $content,
			'layout'		=> $layout,
			'tabLayout'		=> $tabLayout,
			'icon_id'		=> $icon_id,
			'published'		=> $published,
			'parent_id'		=> $parent_id,
			'config_cache'	=> $config_cache,
			'geo'			=> $geo
		
		);
		
		return $this->makeAPICall( "tabs/add_tab", $remote_query );
	
	}
	
	
	public function saveAppStatus()
	{

		$row =& JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(6);
		
		if($row->setting)
			$row->setting = 0;
		else 
			$row->setting = 1;
			
		$remote_query		= array(
		
			'online'		=> $row->setting,
			'site_key' 		=> $this->key,
		
		);

		$response = $this->makeAPICall( "config/set_online", $remote_query );
		
		if( isset($response->success) )
			$row->store();
			
		return $response;
	
	}

}