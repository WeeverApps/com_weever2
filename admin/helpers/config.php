<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2013 Weever Apps Inc. <http://www.weeverapps.com/>
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

jimport('joomla.application.component.helper');
jimport('joomla.plugin.helper');


final class comWeeverConst
{

	const VERSION			= "2.0";
	const RELEASE_TYPE		= "Beta Release 4";
	const RELEASE_NAME		= "<a href='http://www.pc.gc.ca/eng/pn-np/ab/elkisland/index.aspx' target='_blank'>Elk Island</a>";
	const NAME				= "Weever appBuilder&trade; for Joomla!";
	const COPYRIGHT_YEAR	= "(c) 2010-2013";
	const COPYRIGHT			= "Weever Apps Inc.";
	const COPYRIGHT_URL		= "http://www.weeverapps.com/";
	const LICENSE			= "GPL v3.0";
	const LICENSE_URL		= "http://www.gnu.org/licenses/gpl-3.0.html";
	const RELEASE_DATE		= "May 7, 2013";
	const SUPPORT_WEB		= "http://support.weeverapps.com/";
	const LIVE_SERVER		= "http://weeverapp.com/";
	const LIVE_STAGE		= "http://cetus.weeverapp.com/";
	const API_VERSION		= "api/v2/";
	const SUPPORTED_TYPES	= "-oldtabs--newtab-";
	const API_DEBUG			= false;

}


class comWeeverHelperJS
{

	public static function loadConfJS($staging = null)
	{
	
		
		$document = JFactory::getDocument();
		
		if($staging)
			$server = comWeeverConst::LIVE_STAGE;
		else 
			$server = comWeeverConst::LIVE_SERVER;
		
		$document->addCustomTag (
			'<script type="text/javascript">
			
			if (typeof(Joomla) === "undefined") {
				var Joomla = {};
			}
			
			Joomla.comWeeverConst = {
				VERSION: "'.		comWeeverConst::VERSION.'",
				RELEASE_TYPE: "'.	comWeeverConst::RELEASE_TYPE.'",
				RELEASE_NAME: "'.	comWeeverConst::RELEASE_NAME.'",
				NAME: "'.			comWeeverConst::NAME.'",
				COPYRIGHT_YEAR: "'.	comWeeverConst::COPYRIGHT_YEAR.'",
				COPYRIGHT: "'.		comWeeverConst::COPYRIGHT.'",
				COPYRIGHT_URL: "'.	comWeeverConst::COPYRIGHT_URL.'",
				LICENSE: "'.		comWeeverConst::LICENSE.'",
				LICENSE_URL: "'.	comWeeverConst::LICENSE_URL.'",
				RELEASE_DATE: "'.	comWeeverConst::RELEASE_DATE.'",
				SUPPORT_WEB: "'.	comWeeverConst::SUPPORT_WEB.'",
				LIVE_SERVER: "'.	comWeeverConst::LIVE_SERVER.'",
				LIVE_STAGE: "'.		comWeeverConst::LIVE_STAGE.'",
				server: "'.			$server.'"
			};
			
			</script>');
		
	
	}

}