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
		$map_items		= $this->get( 'mapsdata' );

		if( !comWeeverHelper::getKey() )
		{

			echo "<div style='font-size: 1.5em;'>You need to <a href='index.php?option=com_weever&view=account'>enter a valid app key</a> to use appBuilder.</div>";

			return;

		}
		
		/*************/
		// TODO: Add dependencies between files? (They should be enqueued in this order regardless)
        wp_register_script( 'collections.subtab.js', plugins_url( 'static/js/collections/subtab.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'models.tab.js', plugins_url( 'static/js/models/tab.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'models.subtab.js', plugins_url( 'static/js/models/subtab.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );

        // include additional subtab models
        foreach( glob( dirname(__FILE__) . '/static/js/models/subtab.*.js' ) as $model_js_file )
            wp_register_script( 'models.' . basename( $model_js_file ), plugins_url( 'static/js/models/' . basename( $model_js_file ), __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );

        wp_register_script( 'models.formbuilder.control.js', plugins_url( 'static/js/models/formbuilder.control.js', __FILE__ ), array( 'jquery', 'backbone', 'models.subtab.formbuilder.js' ), WeeverConst::VERSION, true );
        wp_register_script( 'models.formbuilder.control.label.js', plugins_url( 'static/js/models/formbuilder.control.label.js', __FILE__ ), array( 'jquery', 'backbone', 'models.subtab.formbuilder.js' ), WeeverConst::VERSION, true );
        wp_register_script( 'models.formbuilder.control.textinput.js', plugins_url( 'static/js/models/formbuilder.control.textinput.js', __FILE__ ), array( 'jquery', 'backbone', 'models.subtab.formbuilder.js' ), WeeverConst::VERSION, true );
        wp_register_script( 'models.formbuilder.control.radio.js', plugins_url( 'static/js/models/formbuilder.control.radio.js', __FILE__ ), array( 'jquery', 'backbone', 'models.subtab.formbuilder.js' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.tab.js', plugins_url( 'static/js/views/tab.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.subtab.js', plugins_url( 'static/js/views/subtab.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.subtab.edit.js', plugins_url( 'static/js/views/subtab.edit.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );

        // include additional edit views
        foreach( glob( dirname(__FILE__) . '/static/js/views/subtab.*.edit.js' ) as $view_js_file )
            wp_register_script( 'views.' . basename( $view_js_file ), plugins_url( 'static/js/views/' . basename( $view_js_file ), __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );

        foreach( glob( dirname(__FILE__) . '/static/js/views/edit.*.js' ) as $view_js_file )
            wp_register_script( 'edit.' . basename( $view_js_file ), plugins_url( 'static/js/views/' . basename( $view_js_file ), __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );

        wp_register_script( 'views.formbuilder.control.js', plugins_url( 'static/js/views/formbuilder.control.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.formbuilder.control.textinput.js', plugins_url( 'static/js/views/formbuilder.control.textinput.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.formbuilder.control.radio.group.js', plugins_url( 'static/js/views/formbuilder.control.radio.group.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.formbuilder.control.radio.js', plugins_url( 'static/js/views/formbuilder.control.radio.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.subtabs.js', plugins_url( 'static/js/views/subtabs.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.subtabscontainer.js', plugins_url( 'static/js/views/subtabscontainer.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'collections.tab.js', plugins_url( 'static/js/collections/tab.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'collections.formbuilder.controls.radio.group.js', plugins_url( 'static/js/collections/formbuilder.controls.radio.group.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.tabs.js', plugins_url( 'static/js/views/tabs.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
        wp_register_script( 'views.app.js', plugins_url( 'static/js/views/app.js', __FILE__ ), array( 'jquery', 'backbone' ), WeeverConst::VERSION, true );
		/*************/

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

				'wx.tabSyncData = ' . json_encode( $nav_tabs ) . ';' .
				'wx.juriBase	= "' . JURI::root() . '";'.

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

		$latestVersion 		= comWeeverHelper::parseVersion( $nav_tabs->joomla_latest_version );
		$currentVersion 	= comWeeverHelper::parseVersion( comWeeverConst::VERSION );

		if( $latestVersion[0] > $currentVersion[0] ||
			($latestVersion[0] == $currentVersion[0] && $latestVersion[1] > $currentVersion[1]) ||
			($latestVersion[0] == $currentVersion[0] && $latestVersion[1] == $currentVersion[1] && $latestVersion[2] > $currentVersion[2]) ||
			($latestVersion[0] == $currentVersion[0] && $latestVersion[1] == $currentVersion[1] && $latestVersion[2] == $currentVersion[2] && $latestVersion[3] > $currentVersion[3]) )
		{

			$version = str_replace( "2.0.0.", "2.0 Beta ", $nav_tabs->joomla_latest_version );

			if( strpos($nav_tabs->joomla_latest_version, "2.0.1") !== false )
				$version = "2.0 Release";

			JRequest::setVar( "upgrade",			$nav_tabs->joomla_download );
			JRequest::setVar( "upgradeVersion",		$version );

		}

		comWeeverHelper::addJAdminMenuEntry( JText::_('WEEVER_TAB_ITEMS'), 	'index.php?option=com_weever', true);
		comWeeverHelper::addJAdminMenuEntry( JText::_('WEEVER_THEMING'), 		'index.php?option=com_weever&view=design&task=design', false);
		comWeeverHelper::addJAdminMenuEntry( JText::_('WEEVER_CONFIGURATION'), 'index.php?option=com_weever&view=config&task=config', false);
		comWeeverHelper::addJAdminMenuEntry( JText::_('WEEVER_ACCOUNT'), 		'index.php?option=com_weever&view=account&task=account', false);
		comWeeverHelper::addJAdminMenuEntry( JText::_('WEEVER_SUPPORT_TAB'), 	'index.php?option=com_weever&view=support&task=support', false);

		if( comWeeverHelper::joomlaVersion() > 2.9 )
			$this->assign( 'sidebar', JHtml::_('sidebar.render') );

		parent::display($tpl);

	}

}