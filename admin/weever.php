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

/* Version compatibility stuffs */

$version 		= new JVersion;
$joomla 		= $version->getShortVersion();

# Joomla 3.0 nonsense
if( !defined('DS') )
	define( 'DS', DIRECTORY_SEPARATOR );

# Add localization capabilities to Javascript in Joomla 1.5
if(substr($joomla,0,3) == '1.5') 
	require_once( JPATH_COMPONENT . DS . 'helpers' . DS . 'jsjtext15.php' );

/* Requires */

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'helper'.'.php');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'config'.'.php');

JTable::addIncludePath( JPATH_COMPONENT . DS . 'tables' );
JHTML::_('behavior.modal', 'a.popup');
jimport('joomla.plugin.helper');

/* Find out if we're in staging mode */

$row 			= JTable::getInstance('WeeverConfig', 'Table');
$row->load(7); 
$staging 		= $row->setting;

comWeeverHelperJS::loadConfJS($staging);

JPluginHelper::importPlugin( 'weever' );
$dispatcher = JDispatcher::getInstance();

$document 			= JFactory::getDocument();

if($staging)
{

	$weeverIcon = "weever_toolbar_title_staging";
	$style = "#wx-app-status-button { visibility:hidden !important; }";
	$document->addStyleDeclaration($style);
	
}
else
	$weeverIcon = "weever_toolbar_title";

/* Load our Javascripts */

if( comWeeverHelper::joomlaVersion() > 2.9 )
	JHtml::_('jquery.framework');
	
else {
	
	$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/jquery.js?v='.comWeeverConst::VERSION );
	
	//for backbone UI
	$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/jquery-v1.8.3.js?v='.comWeeverConst::VERSION );
	
	$document->addCustomTag ('<script type="text/javascript">jQuery.noConflict();</script>');

}

$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/jquery-ui.js?v='.comWeeverConst::VERSION );

//for backbone UI
$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/underscore.min-v1.4.1.js?v='.comWeeverConst::VERSION );

//for backbone UI
$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/backbone.min-v0.9.2.js?v='.comWeeverConst::VERSION );

$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/jquery-impromptu.js?v='.comWeeverConst::VERSION );
$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/jq.common.js?v='.comWeeverConst::VERSION );
$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/weever.js?v='.comWeeverConst::VERSION );
$document->addScript	( JURI::base(true).'/components/com_weever/assets/js/wx.js?v='.comWeeverConst::VERSION );

/* Load our CSS */

$cssFile = JURI::base(true).'/components/com_weever/assets/css/ui-lightness/jquery-ui.css?v='.comWeeverConst::VERSION;

    $document->addStyleSheet($cssFile, 'text/css', null, array());

$cssFile = JURI::base(true).'/components/com_weever/assets/css/jquery-impromptu.css?v='.comWeeverConst::VERSION;

    $document->addStyleSheet($cssFile, 'text/css', null, array()); 
    
$cssFile = JURI::base(true).'/components/com_weever/assets/css/fileuploader.css?v='.comWeeverConst::VERSION;

    $document->addStyleSheet($cssFile, 'text/css', null, array()); 

$cssFile = JURI::base(true).'/components/com_weever/assets/css/weever.css?v='.comWeeverConst::VERSION;

	$document->addStyleSheet($cssFile, 'text/css', null, array());
	
/* Do our checks to see if certain things are working right */

if((ini_get('allow_url_fopen') != 1) && (!in_array('curl', get_loaded_extensions())) )
	JError::raiseNotice(100, JText::_('WEEVER_NOTICE_ALLOW_URL_FOPEN_OFF'));	
	
if(!JPluginHelper::isEnabled('system', 'mobileesp'))
	JError::raiseNotice(100, JText::_('WEEVER_ERROR_PLUGIN_DISABLED'));
	
# Zeroes out the title in favour of the logo
JToolBarHelper::title( '&nbsp;', $weeverIcon);

/* Give us a previewer if in Webkit */

if( comWeeverHelper::isWebKit() ) 
{

	$row->load(4); 		$keySiteDomain 	= $row->setting;
	
	if($staging)
		$weeverServer 	= comWeeverConst::LIVE_STAGE;

	else
		$weeverServer 	= comWeeverConst::LIVE_SERVER;

	$url 	= $weeverServer.'app/'.$keySiteDomain.'?cache_manifest=false';
	$bar 	= JToolBar::getInstance('toolbar');
	
	$bar->appendButton('Popup', 'preview', JText::_("WEEVER_PREVIEW_YOUR_APP"), $url, 320, 480);
	
} 

/* Load up our controller */

jimport('joomla.application.component.controller');

require_once (JPATH_COMPONENT.DS.'controller.php');

$controller 	= new WeeverController();

$controller->registerTask('unpublish', 'publish');
$controller->registerTask('apply', 'save');
$controller->execute(JRequest::getWord('task'));
$controller->redirect();

/* ## FOOTER REGION */

/* Checking our app variables */

$row->load(6);		$status 		= $row->setting;
$row->load(3); 		$key 			= $row->setting;
$row->load(4); 		$keySiteDomain 	= $row->setting;
$row->load(10); 	$domainMap 		= $row->setting;

if(!$key)
{

	$style = "#wx-app-status-button { display: none !important; }";
	$document->addStyleDeclaration($style);
	
}

/* Our QR Code & preview URLs region */

if($key)
{

	$siteDomain = comWeeverHelper::getSiteDomain();
	
	if($staging)
	{
	
		$weeverServer = comWeeverConst::LIVE_STAGE;
		$modetype = 'stage';
		
	}
	else
	{
	
		$weeverServer = comWeeverConst::LIVE_SERVER;
		$modetype = 'live';
		
	}
	
	$googleQRUrl 		= "http://chart.apis.google.com/chart?cht=qr&chs=140x140&choe=UTF-8&chld=H|0&chl=";
	$googleQRUrlHD 		= "http://chart.apis.google.com/chart?cht=qr&chs=480x480&choe=UTF-8&chld=H|0&chl=";
	
	if( $domainMap && !$staging )
		$privateUrl 	= "http://".$domainMap;
		
	else 
		$privateUrl = $weeverServer.'app/'.$keySiteDomain;
		
	$publicUrl = 'http://'.$siteDomain;

	include("views/modules/qr.php");
		
}

/* Insert our footers */

include("views/modules/footer.php");

