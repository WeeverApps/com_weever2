<?php

/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter (rob.porter@weever.ca)
*	Version: 	2.0 alpha 1
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

class WeeverModelConfig extends JModel
{

	public $json		= null;
	
	public function __construct()
	{
        
        parent::__construct();

		$this->key 	= comWeeverHelper::getKey();
        
	}
	
	public function getConfigData()
	{
	
		$this->json = $this->getConfig();
		
		return $this->json;
	
	}

	
	protected function getConfig() 
	{
	
		$api_endpoint 		= "config/get_config";
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
	
	
	public function saveConfig()
	{
		
		$row =& JTable::getInstance('WeeverConfig', 'Table');

		if(JRequest::getVar('granular_devices',0))
		{
		
			if(JRequest::getVar('DetectIphoneOrIpod',0))
				$devices .= "DetectIphoneOrIpod,";
			if(JRequest::getVar('DetectAndroid',0))
				$devices .= "DetectAndroid,";
			if(JRequest::getVar('DetectBlackBerryTouch',0))
				$devices .= "DetectBlackBerryTouch,";
			if(JRequest::getVar('DetectWebOSTablet',0))
				$devices .= "DetectWebOSTablet,";
			if(JRequest::getVar('DetectIpad',0))
				$devices .= "DetectIpad,";
			if(JRequest::getVar('DetectBlackBerryTablet',0))
				$devices .= "DetectBlackBerryTablet,";
			if(JRequest::getVar('DetectAndroidTablet',0))
				$devices .= "DetectAndroidTablet,";
			if(JRequest::getVar('DetectGoogleTV',0))
				$devices .= "DetectGoogleTV,";
			if(JRequest::getVar('DetectAppleTVTwo',0))
				$devices .= "DetectAppleTVTwo,";
				
			$devices = rtrim($devices,",");

			JRequest::setVar('devices',$devices);	
			
		}
		else
		{
		
			if(JRequest::getVar('DetectTierWeeverSmartphones',0))
				$devices .= "DetectTierWeeverSmartphones";
			if(JRequest::getVar('DetectTierWeeverTablets',0))
				$devices .= ",DetectTierWeeverTablets";		
				
			$devices = ltrim($devices,",");
				
			JRequest::setVar('devices',$devices);	
				
		}
		
		/* Local settings storage */
		for($i = 1; $i <= 15; $i++)
		{
		
			if($i == 2 || $i == 1 || $i == 6 || $i == 13 || $i == 14)
				continue;
		
			$row->load($i); 
			
			if($i == 11)
				$row->setting = JRequest::getVar($row->option,"", "post","string",JREQUEST_ALLOWHTML);
			else 
				$row->setting = JRequest::getVar($row->option);
			
			$row->store();
		
		}
		
		$options 	= new StdClass();

		$options->analytics = array();
		
		$options->analytics[0] 				= new StdClass();
		$options->analytics[0]->service 	= "google-analytics";
		$options->analytics[0]->code 		= JRequest::getVar('google_analytics');
		
		$options->custom_domains			= array();
		
		if( JRequest::getVar('domain') )
			$options->custom_domains[0]			= JRequest::getVar('domain');
			
		$options->devices					= JRequest::getVar('devices');
		$options->ecosystem					= JRequest::getVar('ecosystem');
		$options->online					= JRequest::getVar('app_enabled');
		$options->localization				= JRequest::getVar('local');
		
		$response = $this->setConfig( $options );
		
		return $response;
	
	}


	protected function setConfig( $options ) 
	{
	
		$api_endpoint 		= "config/set_config";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		$remote_query 		= array( 	
		
			'site_key' 			=> $this->key,
			'config'			=> json_encode( $options )
		
		);
		
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
	
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);

		return $response;
	
	}

}