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

class WeeverModelList extends JModelLegacy
{

	public $sortOrder	= null;
	public $components 	= null;
	public $json		= null;
	public $jsonTheme 	= null;
	public $jsonAccount = null;
	public $data		= null;
	protected	$key	= null;
	
	public function __construct()
	{
        
        parent::__construct();
        
        $this->key 			= comWeeverHelper::getKey();
        $this->json 		= $this->getNavTabs();
        $application 		= JFactory::getApplication();
        $option 			= JRequest::getCmd('option');
        $filter_order  		= $application->getUserStateFromRequest($option.'filter_order', 'filter_order', 'ordering', 'cmd');
        $filter_order_Dir 	= $application->getUserStateFromRequest($option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word');
 
        $this->setState( 'filter_order', 		$filter_order );
        $this->setState( 'filter_order_Dir', 	$filter_order_Dir );
        $this->setState( 'site_key', 			$this->key );
        
	}
	
	private function _buildContentOrderBy()
	{
    	
    	$application 	= JFactory::getApplication();
    	$option 		= JRequest::getCmd('option');

        $orderby 			= '';
        $filter_order     	= $this->getState('filter_order');
        $filter_order_Dir 	= $this->getState('filter_order_Dir');

        if(!empty($filter_order) && !empty($filter_order_Dir) ){
                $orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
        }

        return $orderby;
	}
	
	
	protected function getNavTabs() 
	{
	
		$api_endpoint 		= "tabs/get_tabs";
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
	
	public function getMapsData()
	{
	
		$db = &JFactory::getDBO();	
			
		$query = "	SELECT	* ".
				"	FROM	#__weever_maps ";
				
		$db->setQuery($query);
		
		$rows 		= $db->loadObjectList();
		$map_items	= array();
		
		foreach( (array) $rows as $k=>$v )
		{
		
			if( !isset($map_items[$v->component]) )
				$map_items[ $v->component ] = array();
			
			if( !isset( $map_items[$v->component][$v->component_id] ) )
				$map_items[$v->component][$v->component_id] = 1;
			else 
				$map_items[$v->component][$v->component_id]++;
		
		}
		
		return $map_items;
	
	}	
	
	public function getAccountData()
	{
		
		return $this->jsonAccount;
	
	}
	
		
	public function getTabsData()
	{
		
		return $this->json;
	
	}
	
	
	public function getContactItems()
	{
	
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__contact_details WHERE published = '1' AND access = '0'"; 
		 	
		else 
		 	$query = "SELECT * FROM #__contact_details WHERE published = '1' AND access < '2'"; 

	
		return $this->_getList($query);		

	}

	
	public function getMenuJoomlaBlogs()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE ( link LIKE '%option=com_content&view=category%' OR  link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=frontpage%' OR link LIKE '%option=com_content&view=article%' ) AND published = '1' AND access = '0'";
		 	  
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE ( link LIKE '%option=com_content&view=category%' OR link LIKE '%option=com_content&view=section%' OR link LIKE '%option=com_content&view=featured%' ) AND published = '1' AND access < '2'";  

		return $this->_getList($query);		

	}
	
	
	public function getMenuK2Blogs()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE ( link LIKE '%option=com_k2&view=itemlist%' ) AND published = '1' AND access = '0'";  
		 	
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE link LIKE '%option=com_k2&view=itemlist%' AND published = '1' AND access < '2'";  

		return $this->_getList($query);		

	}
	

	public function getMenuEasyBlogBlogs()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE ( link LIKE '%option=com_easyblog&view=categories%' OR link LIKE '%option=com_easyblog&view=tags%'
							OR link LIKE '%option=com_easyblog&view=latest%' OR link LIKE '%option=com_easyblog&view=archive%' OR link LIKE '%option=com_easyblog&view=featured%'
							OR link LIKE '%option=com_easyblog&view=myblog%' OR link LIKE '%option=com_easyblog&view=subscription%' OR link LIKE '%option=com_easyblog&view=teamblog%' ) AND published = '1' AND access = '0'";  
							
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE ( link LIKE '%option=com_easyblog&view=categories%' OR link LIKE '%option=com_easyblog&view=tags%' OR link LIKE '%option=com_easyblog&view=latest%' ) AND published = '1' AND access < '2'";  

		return $this->_getList($query);		

	}
	
	
	public function getContentCategories()
	{
	
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access = '0'"; 
		 	 
		else 
		 	$query = "SELECT *, title AS name FROM #__categories WHERE published = '1' AND access < '2'";  
	
		return $this->_getList($query);
	
	}
	
/*
	public function getK2Categories()
	{
		
		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access = '0'";  
		else 
		 	$query = "SELECT * FROM #__k2_categories WHERE published = '1' AND access < '2'";  
	
		return $this->_getList($query);
	
	}
*/	
	
	public function getMenuItems()
	{

		if(comWeeverHelper::joomlaVersion() == "1.5")
		 	$query = "SELECT * FROM #__menu WHERE (link LIKE '%option=com_content&view=article%' OR link LIKE '%option=com_k2&view=item&layout=item%') AND published = '1' AND access = '0'"; 
		 	
		else 
		 	$query = "SELECT *, title AS name FROM #__menu WHERE (link LIKE '%option=com_content&view=article%' OR link LIKE '%option=com_k2&view=item&layout=item%') AND published = '1' AND access < '2'"; 
		
		return $this->_getList($query);		

	}



}