<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 1
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

jimport( 'joomla.application.component.helper' );
jimport( 'joomla.plugin.helper' );
jimport( 'joomla.html.html.tabs' );

class comWeeverHelper
{

	public static function isLegacyJoomla()
	{
	
		if( self::joomlaVersion() == "1.5" )
			return true;
			
		return false;	
	
	}


	public static function joomlaVersion() 
	{
	
		$version 	= new JVersion;
		$joomla 	= $version->getShortVersion();
		$joomla 	= substr($joomla,0,3);
		
		return $joomla;
	
	}
	
	
	public static function phpVersionCheck() 
	{
	
		if (!defined('PHP_VERSION_ID')) {
		
		    $version = explode('.', PHP_VERSION);
		
		    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
		    
		}
		
		/* PHP 5.2 added JSON support */
		if (PHP_VERSION_ID < 50200) {
		
		   JError::raiseNotice(100, JText::_('WEEVER_NOTICE_PHP_NO_JSON'));
		   
		}	
	
	}
	
	
	public static function jHtmlOptions() 
	{
	
		return array(
		    'onActive' => 'function(title, description){
		        description.setStyle("display", "block");
		        title.addClass("open").removeClass("closed");
		    }',
		    'onBackground' => 'function(title, description){
		        description.setStyle("display", "none");
		        title.addClass("closed").removeClass("open");
		    }',
		    'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
		    'useCookie' => true, // this must not be a string. Don't use quotes.
		);
	
	}
	
	
	public static function endJHtmlPane( $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )
			return $paneObj->endPane();
			
		return JHtml::_('tabs.end');
	
	}
	
	
	public static function endJHtmlTabPanel( $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )
			return $paneObj->endPanel();
	
	}
	
	
	public static function startJHtmlPane( $id, $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )
			return  $paneObj->startPane( $id );
			
		return JHtml::_( 'tabs.start', $id, self::jHtmlOptions() );
	
	}
	
	
	public static function startJHtmlTabPanel( $text, $id, $paneObj = null )
	{
	
		if( self::isLegacyJoomla() )		
			return $paneObj->startPanel( $text, $id );
		
		else 
			return JHtml::_( 'tabs.panel', $text, $id );
				
	}
	
	
	public static function getSetting($id)
	{
	
		$row = JTable::getInstance('WeeverConfig', 'Table');
		$row->load($id);
		
		return $row->setting;
	
	}

	
	public static function getKey() 			{ return self::getSetting(3); }	
	public static function getDeviceSettings() 	{ return self::getSetting(5); }
	public static function getAppStatus() 		{ return self::getSetting(6); }
	public static function getStageStatus()		{ return self::getSetting(7); }
	
	
	public static function isWebKit()
	{
	
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		
		return preg_match('/webkit/i', $u_agent);
	
	}
	
	
	public static function typeIsSupported($type) 
	{

		if( strstr(comWeeverConst::SUPPORTED_TYPES, "-".$type."-") )
			return true;
		else 
			return false;
	
	}
	
	
	public static function componentExists($component)
	{
		
		return JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.$component);
		
	}
	

	public static function isJson($string)
	{
		return !empty($string) && is_string($string) && preg_match('/^("(\\.|[^"\\\n\r])*?"|[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t])+?$/',$string);
	}


	public static function getSiteDomain()
	{
	
		$siteDomain = JURI::base();
		$siteDomain = str_replace("http://","",$siteDomain);
		$siteDomain = str_replace("administrator/","",$siteDomain);
		$siteDomain = rtrim($siteDomain, "/");
		
		return $siteDomain;
	
	}


	public static function getJsStrings()
	{

		$joomla = comWeeverHelper::joomlaVersion();
		
		if(substr($joomla,0,3) == '1.5')
		{
			
			jsJText::script('WEEVER_JS_ENTER_NEW_APP_ICON_NAME');
			jsJText::script('WEEVER_JS_APP_UPDATED');
			jsJText::script('WEEVER_JS_PLEASE_WAIT');
			jsJText::script('WEEVER_JS_SAVING_CHANGES');
			jsJText::script('WEEVER_JS_SERVER_ERROR');
			jsJText::script('WEEVER_JS_ENTER_NEW_APP_ITEM');
			jsJText::script('WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO');
			jsJText::script('WEEVER_JS_QUESTION_MARK');
			jsJText::script('WEEVER_JS_CHANGING_NAV_ICONS');
			jsJText::script('WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS');
			jsJText::script('WEEVER_JS_CHANGING_NAV_PASTE_CODE');
			jsJText::script('WEEVER_CONFIG_ENABLED');
			jsJText::script('WEEVER_CONFIG_DISABLED');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_ANIMATIONS');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_TOGGLE');
			jsJText::script('WEEVER_JS_PANEL_HEADERS_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_HEADERS');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_ANIMATIONS');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOGGLE');
			jsJText::script('WEEVER_JS_ABOUTAPP_HEADERS_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_HEADERS');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT');
			jsJText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_LONG');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_TOOLTIP');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_SHORT');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_DEFAULT');
			jsJText::script('WEEVER_JS_PANEL_TIMEOUT_LONG');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_SHORT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_DEFAULT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_LONG');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_TOOLTIP');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_SHORT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_DEFAULT');
			jsJText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_LONG');
			jsJText::script('WEEVER_JS_MAP_SETTINGS');
			jsJText::script('WEEVER_JS_MAP_START_LATITUDE_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_START_LATITUDE');
			jsJText::script('WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_START_LONGITUDE');
			jsJText::script('WEEVER_JS_MAP_START_ZOOM_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_START_ZOOM');
			jsJText::script('WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP');
			jsJText::script('WEEVER_JS_MAP_DEFAULT_MARKER');
			jsJText::script('WEEVER_UPLOAD_NEW');
			jsJText::script('WEEVER_UPLOAD_ICON');
			jsJText::script('WEEVER_DROP_TABLET_LANDSCAPE');
			jsJText::script('WEEVER_DROP_TABLET');
			jsJText::script('WEEVER_DROP_PHONE');
			jsJText::script('WEEVER_DROP_ICON');
			jsJText::script('WEEVER_DROP_TITLEBAR');		
			jsJText::script('WEEVER_UPLOAD_CANCEL');
			jsJText::script('WEEVER_UPLOAD_FAILED');
			
				
			jsJText::load();
		
		}
		else
		{
		
			JText::script('WEEVER_JS_ENTER_NEW_APP_ICON_NAME');
			JText::script('WEEVER_JS_APP_UPDATED');
			JText::script('WEEVER_JS_PLEASE_WAIT');
			JText::script('WEEVER_JS_SAVING_CHANGES');
			JText::script('WEEVER_JS_SERVER_ERROR');
			JText::script('WEEVER_JS_ENTER_NEW_APP_ITEM');
			JText::script('WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO');
			JText::script('WEEVER_JS_QUESTION_MARK');
			JText::script('WEEVER_JS_CHANGING_NAV_ICONS');
			JText::script('WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS');
			JText::script('WEEVER_JS_CHANGING_NAV_PASTE_CODE');
			JText::script('WEEVER_CONFIG_ENABLED');
			JText::script('WEEVER_CONFIG_DISABLED');
			JText::script('WEEVER_JS_PANEL_TRANSITION_ANIMATIONS');
			JText::script('WEEVER_JS_PANEL_TRANSITION_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_TRANSITION_TOGGLE');
			JText::script('WEEVER_JS_PANEL_HEADERS_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_HEADERS');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_ANIMATIONS');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_TOGGLE');
			JText::script('WEEVER_JS_ABOUTAPP_HEADERS_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_HEADERS');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT');
			JText::script('WEEVER_JS_PANEL_TRANSITION_DURATION_LONG');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_TOOLTIP');
			JText::script('WEEVER_JS_PANEL_TIMEOUT');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_SHORT');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_DEFAULT');
			JText::script('WEEVER_JS_PANEL_TIMEOUT_LONG');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_SHORT');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_DEFAULT');
			JText::script('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_LONG');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_TOOLTIP');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_SHORT');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_DEFAULT');
			JText::script('WEEVER_JS_ABOUTAPP_TIMEOUT_LONG');
			JText::script('WEEVER_JS_MAP_SETTINGS');
			JText::script('WEEVER_JS_MAP_START_LATITUDE_TOOLTIP');
			JText::script('WEEVER_JS_MAP_START_LATITUDE');
			JText::script('WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP');
			JText::script('WEEVER_JS_MAP_START_LONGITUDE');
			JText::script('WEEVER_JS_MAP_START_ZOOM_TOOLTIP');
			JText::script('WEEVER_JS_MAP_START_ZOOM');
			JText::script('WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP');
			JText::script('WEEVER_JS_MAP_DEFAULT_MARKER');
			JText::script('WEEVER_UPLOAD_NEW');
			JText::script('WEEVER_UPLOAD_ICON');
			JText::script('WEEVER_DROP_TABLET_LANDSCAPE');
			JText::script('WEEVER_DROP_TABLET');
			JText::script('WEEVER_DROP_PHONE');
			JText::script('WEEVER_DROP_ICON');
			JText::script('WEEVER_DROP_TITLEBAR');
			JText::script('WEEVER_UPLOAD_CANCEL');
			JText::script('WEEVER_UPLOAD_FAILED');
		
		}

	}
		
	
	public static function parseVersion($str)
	{
		
		$version = array(0,0,0,0);
	
		$ver = explode( ".", $str );
	
		foreach((array)$ver as $k=>$v)
		{
			
			if(!$v)
				$v = 0;
				
			$version[$k] = $v;
		}
		
		return $version;
	
	}
	
	
	public static function updateTabSettings()
	{
	
		$type = JRequest::getVar("type");
		
		switch($type)
		{
		
			case "map":
			
				$var 					= new StdClass();
				$var->start 			= new StdClass();
				
				$submittedVars 			= explode(",",JRequest::getVar("var"));
				
				$var->start->latitude 	= $submittedVars[0];
				$var->start->longitude 	= $submittedVars[1];
				$var->start->zoom 		= $submittedVars[2];
				$var->marker 			= $submittedVars[3];
				
				$var_json 				= json_encode($var);
			
				break;
				
			case "panel": 
			case "aboutapp":
			
				$var 							= new StdClass();
				$var->animation 				= new StdClass();
				
				$submittedVars 					= explode(",",JRequest::getVar("var"));
				
				
				$var->animation->type 			= $submittedVars[0];
				$var->animation->duration 		= $submittedVars[1];
				$var->animation->timeout 		= $submittedVars[2];
				$var->content_header 			= $submittedVars[3];
			
				$var_json 						= json_encode($var);
			
				break;
		
		}
		
		$response = comWeeverHelper::pushTabSettingsToCloud($var_json);
	
		return $response;
	
	}
	
	
	public static function enableStagingMode()
	{
	
		$row 			=& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		$row->setting 	= 1;
		$row->store();

		$msg 			= JText::_('WEEVER_STAGING_MODE_ACTIVE');

		return $msg;
		
	}
	
	
	public static function disableStagingMode()
	{
	
		$row 			=& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(7);
		$row->setting 	= 0;
		$row->store();

		$msg 			= JText::_('WEEVER_LIVE_MODE_ACTIVE');

		return $msg;	
		
	}
	
	
	public static function saveAccount()
	{
	
		$site_key = JRequest::getVar('site_key','');
		
		$db = JFactory::getDBO();		

		$query = "		UPDATE	#__weever_config".
				"		SET		`setting` = ".$db->Quote($site_key)." ".
				"		WHERE	`option` = ".$db->Quote("site_key")." ";
		
		$db->setQuery($query);
		$db->loadObject();
		
		$api_endpoint 		= "account/get_account";
		$remote_url 		= comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . $api_endpoint;
		$stage_url 			= '';
		$remote_query 		= array( 	
		
			'app_key' 		=> $site_key
		
		);
		
		if( comWeeverHelper::getStageStatus() )
			$remote_url = comWeeverConst::LIVE_STAGE . comWeeverConst::API_VERSION . $api_endpoint;
	
		$postdata 	= comWeeverHelper::buildWeeverHttpQuery($remote_query);
		$response	= comWeeverHelper::sendToWeeverServer($postdata, $remote_url);
		
		$json		= json_decode( $response );
		
		$row 		= JTable::getInstance('WeeverConfig', 'Table');
		
		$row->load(4);
		$row->setting = $json->account->site;
		
		$row->setting = rtrim( str_replace( "http://", "", $row->setting ), "/" );
		
		$row->store();

	}	
	

	public static function buildWeeverHttpQuery($array, $ajax = false)
	{

	//	$array['version'] 		= comWeeverConst::VERSION;
		$array['user_agent'] 	= comWeeverConst::NAME . " v" . comWeeverConst::VERSION;
	//	$array['cms'] 			= 'joomla';
	//	$array['cms_version']	= self::joomlaVersion();
		
		if($ajax == true)
		{
		
			$array['app']	= 'ajax';
			$array['site_key'] = self::getKey();
		
		}
		
		return http_build_query($array);	
	
	}
	
	
	public static function buildAjaxQuery($query)
	{
	
		$postdata = self::buildWeeverHttpQuery($query, true);
		
		return comWeeverHelper::sendToWeeverServer($postdata);
	
	}
	

	public static function sendToWeeverServerCurl($context, $url = null)
	{
	
		if( !$url ) 
		{

			if(self::getStageStatus())
				$weeverServer = comWeeverConst::LIVE_STAGE;
			else
				$weeverServer = comWeeverConst::LIVE_SERVER;
				
			$url = $weeverServer.comWeeverConst::API_VERSION;
			
		}
		
		$ch = curl_init($url);
		
		curl_setopt($ch,	CURLOPT_POST,			true);
		curl_setopt($ch,	CURLOPT_POSTFIELDS,		$context);
		curl_setopt($ch,	CURLOPT_RETURNTRANSFER,	true);

		$response 		= curl_exec($ch);
		$error 			= curl_error($ch);

		curl_close($ch);
        
        if ($error != "")
            return $error;
       
		return $response;

	}
	
	
	public static function sendToWeeverServer($postdata, $url = null)
	{

		if(in_array('curl', get_loaded_extensions()))
		{
		
			$context 	= $postdata;
			$response 	= comWeeverHelper::sendToWeeverServerCurl($context, $url);
			
		}
		
		elseif(ini_get('allow_url_fopen') == 1)
		{
		
			$context 	= comWeeverHelper::buildPostDataContext($postdata);
			$response 	= comWeeverHelper::sendToWeeverServerFOpen($context, $url);
			
		}
		
		else 
			$response 	= JText::_('WEEVER_ERROR_NO_CURL_OR_FOPEN');
			
		if( JRequest::getVar("wxAPI") )
			die($response);
			
		if( JRequest::getVar("wxAPIInline") )
			echo "<textarea>" . $response . "</textarea>";

		return $response;
	
	}
	

	public static function sendToWeeverServerFOpen($context, $url = null)
	{
		
		if( !$url ) 
		{

			if(self::getStageStatus())
				$weeverServer = comWeeverConst::LIVE_STAGE;
				
			else
				$weeverServer = comWeeverConst::LIVE_SERVER;
				
			$url 	= $weeverServer . comWeeverConst::API_VERSION;
			
		}
		
		return file_get_contents($url, false, $context);
	
	}
	
	
	public static function buildPostDataContext($postdata)
	{
	
		$opts = array(

			'http'	=> array(
			
				'method'	=>"POST",
				'header'	=>"User-Agent: ".comWeeverConst::NAME." version: ". 
							comWeeverConst::VERSION."\r\n"."Content-length: " .
							strlen($postdata)."\r\n".
				         	"Content-type: application/x-www-form-urlencoded\r\n",
				'content' 	=> $postdata
			
			)
			
		);
	
		return stream_context_create($opts);
	
	}
	

	public static function buildQuery($query, $start, $limit, $where, $order)
	{
	
		$query_lim = "";
		
		if($where)
			$query .= " WHERE ".$where;

		if($order)
			$query .= " ORDER BY ".$order." ";

		if($limit)
			$query_lim = " LIMIT ".$limit. " ";

		if($start && $limit)
			$query_lim = " LIMIT ".$start.", ".$limit." ";
			
		$query .= $query_lim;

		return $query;
		
	}
	
	
	public static function _buildProximityFeedURL() 
	{
	
		$tag = JRequest::getVar('component_behaviour');
	
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildMapFeedURL() 
	{
	
		$tag = JRequest::getVar('component_behaviour');
		
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildDirectoryFeedURL() 
	{
		
		$tag = JRequest::getVar('component_behaviour');
	
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildBlogFeedURL() 
	{
	
		$tag = JRequest::getVar('component_behaviour');
	
		if($tag)
		{
			JRequest::setVar('cms_feed', 'index.php?option=com_k2&view=itemlist&task=tag&layout=blog&tag='.urlencode($tag).'&template=weever_cartographer');
		}
			
		return true;
	
	}
	
	
	public static function _buildPageFeedURL() 
	{
	
		$service = JRequest::getVar('cms_feed');			
		
		if($var = JRequest::getVar("tags"))	
		{
		
			$var 	= str_replace(",,","[[comma]]",$var);
			$var 	= explode( ",", $var );
			$var 	= json_encode($var);
			
			JRequest::setVar("var", $var);
			
		}
			
		return true;
		
	}
	
	
	public static function _buildComponentFeedURL() 
	{
	
		$service = JRequest::getVar('cms_feed');
			
		return true;
		
	}


	public static function _buildContactFeedURL() 
	{
	
		$config 	= JRequest::getVar('config');
		$id 		= json_decode($config)->component_id;

		if(JRequest::getVar('weever_action') == 'add')
		{

			$query 	= 	
				"SELECT #__contact_details.* ".
				"FROM #__contact_details ".
				"WHERE #__contact_details.id = '".$id."' ";
			
			$db		= &JFactory::getDBO();
			
			$db->setQuery($query);
			
			$contact 	= $db->loadObject();
			
			$json = new StdClass();
			
			$json->telephone 		= $contact->telephone;
			$json->email_to 		= $contact->email_to;
			$json->address 			= $contact->address;
			$json->town 			= $contact->suburb;
			$json->state 			= $contact->state;
			$json->country 			= $contact->country;
			$json->googlemaps 		= JRequest::getVar('googlemaps', 0);
			
			$joomla 				= comWeeverHelper::joomlaVersion();
			
			if(substr($joomla,0,3) == '1.5')
				$json->image = "images/stories/".$contact->image;
				
			else 
				$json->image = $contact->image;
				
			$json->misc 	= $contact->misc;
			
			// destringify our options
			
			if($json->googlemaps == "0")
				$json->googlemaps = 0;
				
			$json->emailform = JRequest::getVar('emailform', 0);
			
			if($json->emailform == "0")
				$json->emailform = 0;
				
			$contacts				= array();
			$contacts[] 			= $json;
			$json_result			= new stdClass();
			$json_result->contacts	= $contacts;
			$json_result 			= json_encode($json_result);
			
			JRequest::setVar('config_cache', $json_result);
			JRequest::setVar('config', null);
			
		}
		
		return null;		
	
	}
	

}


