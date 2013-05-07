<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 3
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

jimport('joomla.application.component.view');

if( !class_exists("JViewLegacy") ) 
{

	class JViewLegacy extends JView{};
	
}

class WeeverViewConfig extends JViewLegacy
{

	public function display($tpl = null)
	{

		$config			= $this->get('configdata');
		$configData 	= is_object($config) ? $config->config : null;
		
		if( !comWeeverHelper::getKey() )
		{
			
			echo "<div style='font-size: 1.5em;'>You need to <a href='index.php?option=com_weever&view=account'>enter a valid app key</a> to use appBuilder.</div>";
			
			return;
			
		}
		
		if( JRequest::getVar("wxConfigSync") )
		{
			var_dump($configData);
		}
		
		$this->assignRef('local', 			$configData->localization);
		$this->assignRef('locales', 		$configData->available_locales);
		$this->assign('appEnabled', 		comWeeverHelper::getAppStatus() );
		$this->assign('ecosystem', 			$configData->syndication->ecosystem );
		$this->assign('google_analytics', 	isset($configData->analytics[0]) ? $configData->analytics[0]->code : null );
		$this->assign('site_key', 			comWeeverHelper::getKey() );
		
		$this->assign('granular',				'');
		$this->assign('DetectIphoneOrIpod',		'');
		$this->assign('DetectAndroid',			'');
		$this->assign('DetectBlackBerryTouch',	'');
		$this->assign('DetectTouchPad',			'');
		$this->assign('DetectIpad',				'');
		$this->assign('DetectBlackBerryTablet',	'');
		$this->assign('DetectAndroidTablet',	'');
		$this->assign('DetectGoogleTV',			'');
		$this->assign('DetectAppleTVTwo',		'');
		$this->assign('DetectTierWeeverTablets','');
		$this->assign('DetectTierWeeverSmartphones','');
	
		$devices = explode("," , $configData->device);
		
		foreach((array)$devices as $v)
		{
			if($v)
			{
				$this->assign($v,'selected="selected"');
				if($v == "DetectIphoneOrIpod" ||
						$v == "DetectAndroid" ||
						$v == "DetectBlackBerryTouch" ||
						$v == "DetectTouchPad" ||
						$v == "DetectIpad" ||
						$v == "DetectBlackBerryTablet" ||
						$v == "DetectAndroidTablet" ||
						$v == "DetectGoogleTV" ||
						$v == "DetectAppleTVTwo")
				{
					$this->assign('granular','checked="checked"');
				}
			}
		}
		
		comWeeverHelper::getJsStrings();
		
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_TAB_ITEMS'), 		'index.php?option=com_weever', false);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_THEMING'), 		'index.php?option=com_weever&view=design&task=design', false);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_CONFIGURATION'), 	'index.php?option=com_weever&view=config&task=config', true);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_ACCOUNT'), 		'index.php?option=com_weever&view=account&task=account', false);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_SUPPORT_TAB'), 	'index.php?option=com_weever&view=support&task=support', false);

		if( comWeeverHelper::joomlaVersion() > 2.9 )
			$this->assign( 'sidebar', JHtml::_('sidebar.render') );
		
		parent::display($tpl);
	
	}



}