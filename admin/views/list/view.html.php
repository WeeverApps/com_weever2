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

jimport('joomla.application.component.view');

if( !class_exists("JViewLegacy") ) 
{

	class JViewLegacy extends JView{};
	
}

class WeeverViewList extends JViewLegacy
{

	public function display($tpl = null)
	{
	
		comWeeverHelper::phpVersionCheck();
		
		$document 		= JFactory::getDocument();

		JRequest::setVar( 'layout', 'default' );
		
		$state 			= $this->get( 'state' );
		$nav_tabs 		= $this->get( 'tabsdata' );
		//$accountData 	= $this->get('AccountData');
		
		if( !comWeeverHelper::getKey() )
		{
			
			echo "<div style='font-size: 1.5em;'>You need to <a href='index.php?option=com_weever&view=account'>enter a valid app key</a> to use appBuilder.</div>";
			
			return;
			
		}
			
	//	print_r($nav_tabs);
			
		// fix for broken URLs *** GET FROM ACCOUNT DATA
		/*$row			=& JTable::getInstance('WeeverConfig', 'Table');
		$row->load(4);
		
		if( $row->setting != $appData->config->primary_domain ) {
		
			$row->setting 	= $appData->config->primary_domain;		
			$row->store();
			
		}*/

		$document->addCustomTag (
		
			'<script type="text/javascript">'.
			
				'wx.tabSyncData = ' . json_encode( $nav_tabs ) .
			
			'</script>'
			
		);
	
		$tabs			= array();
		$parent_tabs	= array();

		/* First pass for tab parents and orphans */
		foreach( (array) $nav_tabs->tabs as $k=>$v )
		{
		
			if( $v->parent_id )
				continue;

			$tabs[][] 				= $v;
			
			end($tabs);
			$parent_tabs[ $v->id ]	= key($tabs);

		}
		
		/* Second pass for the rest */
		foreach( (array) $nav_tabs->tabs as $k=>$v )
		{
		
			if( !$v->parent_id )
				continue;
		
			$tabs[ $parent_tabs[$v->parent_id] ][]	= $v;
			
		}
		
		$tier = 2;
		
		$this->assignRef( 'tabs', 		$tabs/*$appData->config->tier*/ );
		$this->assignRef( 'tier', 		$tier/*$appData->config->tier*/ );
	//	$this->assignRef( 'theme',		$appData->theme_params );
		
		$contentCategories 	= $this->get('contentCategories');
		$menuItems 			= $this->get('menuItems');
		$menuJoomlaBlogs	= $this->get('menuJoomlaBlogs');
		$menuK2Blogs		= $this->get('menuK2Blogs');
		$menuEasyBlogBlogs	= $this->get('menuEasyBlogBlogs');
		$contactItems		= $this->get('contactItems');

		/* Data from Joomla about existing categories and articles */
		$this->assignRef( 'contentCategories', 	$contentCategories );
		$this->assignRef( 'menuJoomlaBlogs', 	$menuJoomlaBlogs );
		$this->assignRef( 'menuK2Blogs', 		$menuK2Blogs );
		$this->assignRef( 'menuEasyBlogBlogs', 	$menuEasyBlogBlogs );
		$this->assignRef( 'contactItems', 		$contactItems );
		
		$this->assign( 	'site_key', 	$state->get('site_key') );

		$lists['order_Dir'] = $state->get( 'filter_order_Dir' );
		$lists['order']     = $state->get( 'filter_order' );
		
		$this->assignRef( 'lists', $lists );
		
		$this->assign('appEnabled', comWeeverHelper::getAppStatus() );
		
		comWeeverHelper::getJsStrings();			
		
		if( JRequest::getVar("wxTabDump") )
			var_dump($nav_tabs);
	
		JSubMenuHelper::addEntry( JText::_('WEEVER_TAB_ITEMS'), 	'index.php?option=com_weever', true);
		JSubMenuHelper::addEntry( JText::_('WEEVER_THEMING'), 		'index.php?option=com_weever&view=design&task=design', false);
		JSubMenuHelper::addEntry( JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		JSubMenuHelper::addEntry( JText::_('WEEVER_ACCOUNT'), 		'index.php?option=com_weever&view=account&task=account', false);
		JSubMenuHelper::addEntry( JText::_('WEEVER_SUPPORT_TAB'), 	'index.php?option=com_weever&view=support&task=support', false);

		parent::display($tpl);
	
	}

}