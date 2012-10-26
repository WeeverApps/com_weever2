<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 beta 1
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

class WeeverModelAjax extends JModel
{

	protected $key;

	public function __construct() {
	
		parent::__construct();
		
		$this->key 	= comWeeverHelper::getKey();

	}
	
	
	protected function makeAPICall($api_endpoint, $remote_query)
	{
	
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
	
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		$json		= json_decode( $response );

		if( isset($json->error) && $json->error == true )
		{
		
			 JError::raiseNotice(100, JText::_( "Server replied: " . $json->message ));
			 return false;
			 
		}
		
		return $json;

	}
	
	
	public function saveTabName($name, $tab_id) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'tabTitle'		=> $name,
			'tab_id'		=> $tab_id
		
		);
	
		return $this->makeAPICall( "tabs/set_tabTitle", $remote_query );
	
	}
	
	
	public function saveTabItemName($name, $tab_id) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'title'			=> $name,
			'tab_id'		=> $tab_id
		
		);
	
		return $this->makeAPICall( "tabs/set_title", $remote_query );
	
	}
	
	
	public function saveTabOrder($order) 
	{
	
		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'order'			=> $order
		
		);
	
		return $this->makeAPICall( "tabs/sort_tabs", $remote_query );
	
	}
	
	
	public function saveTabPublish($id, $publish) 
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


	public function deleteTab($id) 
	{
	
		if( is_array($id) )
			$id = implode( ",", $id );

		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'tab_id'		=> $id
		
		);
		
		return $this->makeAPICall( "tabs/delete", $remote_query );
	
	}
	
	
	public function moveTab($tab_id, $parent_id) 
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
	
		$remote_query = array();
		
		switch( $remote_query["type"] )
		{
		
			case "phone_load":
			
				$remote_query["launchscreen_type"]	= "phone";
				$remote_query["launchscreen"]		= $url;
			
				return $this->makeAPICall( "design/set_launchscreen", $remote_query );
				
				break;
				
			
			case "icon":
			
				$remote_query["app_icon"]		= $url;
				
				return $this->makeAPICall( "design/set_app_icon", $remote_query );
				
				break;
				
			
			case "tablet_load":
			
				$remote_query["launchscreen_type"]	= "tablet";
				$remote_query["launchscreen"]		= $url;
			
				return $this->makeAPICall( "design/set_launchscreen", $remote_query );
				
				break;
				
			
			case "tablet_landscape_load":
			
				$remote_query["launchscreen_type"]	= "tablet_landscape";
				$remote_query["launchscreen"]		= $url;
			
				return $this->makeAPICall( "design/set_launchscreen", $remote_query );
				
				break;
				
				
			case "titlebar_logo":
			
				$remote_query["titlebar_logo"]		= $url;
				
				return $this->makeAPICall( "design/set_titlebar_logo", $remote_query );
				
				break;
		
		}
	
	}
	
	
	public function saveNewTab($config, $title, $content, $layout, $icon_id, $published, $parent_id) 
	{

		$remote_query 		= array( 	
			
			'site_key' 		=> $this->key,
			'config'		=> $config,
			'title'			=> $title,
			'content'		=> $content,
			'layout'		=> $layout,
			'icon_id'		=> $icon_id,
			'published'		=> $published,
			'parent_id'		=> $parent_id
		
		);
		
		return $this->makeAPICall( "tabs/add_tab", $remote_query );
	
	}

}