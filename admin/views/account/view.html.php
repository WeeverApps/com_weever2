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

jimport('joomla.application.component.view');
jimport('joomla.plugin.helper');

if( !class_exists("JViewLegacy") ) 
{

	class JViewLegacy extends JView{};
	
}

class WeeverViewAccount extends JViewLegacy
{

	public function display($tpl = null)
	{

		$this->assign( 'appEnabled', 	comWeeverHelper::getAppStatus() );
		$this->assign( 'stagingMode', 	comWeeverHelper::getStageStatus() );		
		$this->assign( 'site_key', 		comWeeverHelper::getKey() );
		
		$accountData	= $this->get('accountdata');
		
		if( !$accountData )
		{
			
			echo "<div style='font-size: 1.5em;'>You need to enter a valid app key to use appBuilder.</div>";
			
			$account = new stdClass();
			
			$account->tier 			= "";
			$account->site			= "";
			$account->expiry		= "";
			
			$this->assignRef('account', $account);
			
		}
		
		else 
			$this->assignRef('account', $accountData->account);

		comWeeverHelper::getJsStrings();

		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_TAB_ITEMS'), 'index.php?option=com_weever', false);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_THEMING'), 'index.php?option=com_weever&view=design&task=design', false);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_ACCOUNT'), 'index.php?option=com_weever&view=account&task=account', true);
		comWeeverHelper::addJAdminMenuEntry(JText::_('WEEVER_SUPPORT_TAB'), 'index.php?option=com_weever&view=support&task=support', false);

		if( comWeeverHelper::joomlaVersion() > 2.9 )
			$this->assign( 'sidebar', JHtml::_('sidebar.render') );
			
		parent::display($tpl);
	
	}



}