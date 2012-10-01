/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
				Aaron Song	<aaron@weeverapps.com>
*	Version: 	2.0 alpha 0
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

wx.labelText = function(active, futurePassive) {

	this.active 		= active;
	this.futurePassive 	= futurePassive;

};

/* Language for checkboxes; note there are many overrides for specific services in the wx.features object */

wx.tabTypes = {

	'oldtabs':		{
	
		label:	new wx.labelText('Display under existing tab: ', 'This content will be displayed under the tab: ')
	
	},
	'newtab':		{
	
		label:	new wx.labelText('Display as a new tab', 'This content will be displayed as a new tab: ')
	
	}

};