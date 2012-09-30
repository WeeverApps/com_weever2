/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	1.8
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

wx.features = [

	{
	
		id:			'joomla',
		name:		'Joomla Content',
		description:'Add Content from your Joomla website.',
		splitTypes:	true,
		items:	[
		
			{
			
				id:				'blog',
				content:		'html',
				name:			'Blog',
				title:			true,
				types:			'alltabs',
				layout:			'list',
				fields:			{
				
					'cms_feed':	'#wx-add-joomla-blog-select',
					
				},
				config:			{
				
					'url':		':cms_feed',
					'template':	'weever_cartographer'	
					
				},
				icon_id:		5
			
			},
			{
			
				id:				'category',
				content:		'html',
				name:			'Category',
				title:			true,
				layout:			'list',
				types:			'alltabs',
				fields:			{
				
					cms_feed:	'#wx-add-joomla-category-select',
					
				},
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		5
			
			},
			{
			
				id:				'article',
				name:			'Article',
				content:		'htmlPage',
				title:			true,
				layout:			'panel',
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				types:			'alltabs',
				fields:			{
				
					cms_feed:	'#wx-add-joomla-article-url',
					
				},
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		12
			
			}
		
		]
		
	
	}
	
];
