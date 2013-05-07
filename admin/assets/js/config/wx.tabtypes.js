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

wx.labelText = function(active, futurePassive) {

	this.active 		= active;
	this.futurePassive 	= futurePassive;

};

/* Language for checkboxes; note there are many overrides for specific services in the wx.features object */

wx.tabTypes = {

	'oldtabs':		{
	
		label:	new wx.labelText('Add to existing tab: ', 'This content will be displayed under the tab: ')
	
	},
	'newtab':		{
	
		label:	new wx.labelText('Add as a new tab, using the layout: ', 'This content will be displayed as a new tab: ')
	
	}

};

wx.layoutTypes = {


	'list':		'Display in a List format',
	'grid':		'Display in a Grid format',
	'carousel':	'Display as a "Carousel" that users swipe through item by item',
	'map':		'Display on a Map',
	'panel':	'Display as a single page panel'

};

