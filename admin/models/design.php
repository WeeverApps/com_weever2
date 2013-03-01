<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 2
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

class WeeverModelDesign extends JModelLegacy
{

	public 		$json = null;
	protected	$key;
	public 		$account;

	public function __construct()
	{
       
    	parent::__construct();
    	
    	$this->key 	= comWeeverHelper::getKey();
       
	}
	
	
	public function getDesignData()
	{
	
		$this->json = $this->getDesign();
	
		return $this->json;
	
	}
	
	
	protected function getDesign()
	{
	
		$api_endpoint 		= "design/get_design";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		$remote_query 		= array( 	
		
			'site_key' 		=> $this->key
		
		);
		
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
	
	
	public function saveDesign()
	{
			
		$row 			=& JTable::getInstance( 'WeeverConfig', 'Table');
		
		$row->load(2);
		$row->setting 	= JRequest::getVar($row->option);		
		$row->store();
		
		$row->load(1);
		$row->setting 	= JRequest::getVar($row->option);		
		$row->store();
		
		$design 				= new StdClass();
		$design->titlebar		= new StdClass();
		
		$design->titlebar
					->html		= JRequest::getVar("titlebarHtml", "", "post", "string", JREQUEST_ALLOWHTML);
		$design->titlebar
					->text		= JRequest::getVar("titlebar_title");
		
		if( trim($design->titlebar->html) )
			$design->titlebar->type		= "html";
			
		else if(JRequest::getVar("titlebar_title_enabled") == 1)
			$design->titlebar->type		= "text";
			
		else
			$design->titlebar->type 	= "image";			
	
		$design->css 			= new StdClass();
		$design->css->styles	= JRequest::getVar("css");
		$design->css->url 		= JRequest::getVar("css_url");
		
		$design->animations						= new StdClass();
		$design->animation->launch				= new StdClass();
		$design->animation->launch->type		= JRequest::getVar("animation");
		$design->animation->launch->duration	= JRequest::getVar("duration");
		$design->animation->launch->timeout		= JRequest::getVar("timeout");
		
		$design->install			= new StdClass();
		$design->install->prompt	= JRequest::getVar("install_prompt");
		$design->install->name		= JRequest::getVar('title');
		
		$design->loadspinner		= new stdClass();
		$design->loadspinner->text	= JRequest::getVar("loadspinner_text");
		
		$design->domain					= array();
		
		if( JRequest::getVar('domain') )
			$design->domain[0]				= JRequest::getVar('domain');

		$response					= $this->setDesign( $design );
		
		return $response;	
		
	}
	
	
	protected function setDesign( $options ) 
	{
	
		$api_endpoint 		= "design/set_design";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		$remote_query 		= array( 	
		
			'site_key' 			=> $this->key,
			'design'			=> json_encode( $options )
		
		);
		
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
	
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);

		return $response;
	
	}
	
}