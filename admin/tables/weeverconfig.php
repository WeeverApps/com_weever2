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

class TableWeeverConfig extends JTable
{

	public $id 						= 0;
	public $option					= null;
	public $setting					= null;
	
	public function __construct(&$db)
	{
	
		parent::__construct('#__weever_config', 'id', $db);
			
	}


}

class TableWeeverMaps extends JTable
{

	public $id 						= 0;
	public $component_id			= 0;
	public $component				= null;
	public $altitude				= 0;
	public $address					= null;
	public $label					= null;
	public $kml						= null;
	public $marker					= null;
	public $location				= null;
	
	public function __construct(&$db)
	{
	
		parent::__construct('#__weever_maps', 'id', $db);
			
	}


}
