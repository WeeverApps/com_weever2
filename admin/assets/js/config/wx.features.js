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
				types:			['oldtabs', 'newtab'],
				layouts:		['list','grid','carousel'],
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
				layouts:		['list','grid','carousel'],
				types:			['oldtabs', 'newtab'],
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
				layouts:		'panel',
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				types:			['oldtabs', 'newtab'],
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
		
	
	},
	{

		id:			'k2',
		extension:	'com_k2',
		name:		'K2 Content',
		splitTypes:	true,
		description:'Add content from the K2 extension.',
		items:	[
		
			{
			
				id:				'blog',
				name:			'K2 Blog',
				extension:		'com_k2',
				title:			true,
				content:		'html',
				layouts:		['list','grid','carousel'],
				types:			['oldtabs', 'newtab'],
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		5,				
				fields:			{
				
					cms_feed:	'#wx-add-k2-blog-select',
					
				}
			
			},
			{
			
				id:				'category',
				name:			'K2 Category',
				extension:		'com_k2',
				title:			true,
				content:		'html',
				layouts:		['list','grid','carousel'],
				types:			['oldtabs', 'newtab'],
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		5,	
				fields:			{
				
					cms_feed:	'#wx-add-k2-category-url',
					
				}
			
			},
			{
			
				id:				'item',
				name:			'K2 Item',
				extension:		'com_k2',
				title:			true,
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				types:			['oldtabs', 'newtab'],
				content:		'htmlPage',
				layouts:		'panel',
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		12,					
				fields:			{
				
					cms_feed:		'#wx-add-k2-item-url',
					
				}
			
			}
		
		]
	
	},
	{
	
		id:				'easyblog',
		extension:		'com_easyblog',
		//unavailable:	'Coming soon!',
		name:			'EasyBlog Content',
		description:	'Add content from the easyblog extension.',
		items:	[
		
			{
			
				id:				'blog',
				name:			'EasyBlog Blog',
				extension:		'com_easyblog',
				title:			true,
				//unavailable:	'Coming soon!',
				types:			['oldtabs', 'newtab'],
				content:		'html',
				layouts:		['list','grid','carousel'],
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		5,			
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-blog-select',
					
				}
			
			},
			{
			
				id:				'category',
				name:			'EasyBlog Category',
				extension:		'com_easyblog',
				title:			true,
				//unavailable:	'Coming soon!',
				types:			['oldtabs', 'newtab'],
				content:		'html',
				layouts:		['list','grid','carousel'],
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		5,			
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-category-url',
					
				}
			
			},
			{
			
				id:				'item',
				name:			'EasyBlog Entry',
				extension:		'com_easyblog',
				title:			true,
				titleUse:		'Change only if you think a shorter title is more appropriate for a mobile app.',
				types:			['oldtabs', 'newtab'],
				content:		'htmlPage',
				layouts:		'panel',
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
					
				},
				icon_id:		5,			
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-item-url',
					
				}
			
			}
					
		]
	
	},{
	
		id:				'google_calendar',
		name:			'Google Calendar',
		types:			['oldtabs', 'newtab'],
		defaultTitle:	'Calendar',
		content:		'googleCalendar',
		layouts:		'list',
		title:			true,
		fields:			{
		
			component_behaviour: 	'#wx-google-calendar-email'
		
		},
		config:			{
		
			calendar_id:			':component_behaviour'
		
		},
		icon_id:		29
	
	},
	{
	
		vertical:		'all',
		id:				'twitter',
		name:			'Twitter',
		url:			'http://twitter.com/',
		description:	'<p>Twitter offers businesses an easy way to communicate with an engaged mobile audience.</p>' +
		
					'<h4>Mobile App Features</h4>'+
					
					   '<ul><li>Display Twitter user streams, #hashtag(s) or search results</li>'+
					    '<li>Share Blog Post or Pages via Twitter (options button)</li>'+
					    '<li>Share App via Twitter (from the "Share App" tab)</li>'+
					    '</ul></p>',
					
		items:	[
		
			{
			
				id:				'user',
				name:			'Twitter User',
				defaultTitle:	'On Twitter',
				content:		'twitter',
				title:			true,
				types:			['oldtabs', 'newtab'],
				layouts:		'list',
				icon_id:		22,
				config:			{
				
					'screen_name':			':component_behaviour',
					'include_entities':		1
				
				},
				fields:			{
				
					component_behaviour: 	'#wx-twitter-user-value'
				
				},
				defaultValue:	{
				
					component_behaviour:	'@'
					
				}
			
			},
			{
				
				id:				'hashtag',
				name:			'Hash Tag',
				content:		'twitter',
				title:			true,
				types:			['oldtabs', 'newtab'],
				layouts:		'list',
				icon_id:		22,
				config:			{
				
					'screen_name':			':component_behaviour',
					'include_entities':		1
				
				},
				fields:			{
				
					component_behaviour: 	'#wx-twitter-hashtag-value'
				
				},
				defaultValue:	{
				
					component_behaviour:	'#'
					
				}
			
			},
			{
			
				id:				'search',
				name:			'Search Term',
				content:		'twitter',
				title:			true,
				types:			['oldtabs', 'newtab'],
				layouts:		'list',
				icon_id:		22,
				config:			{
				
					'screen_name':			':component_behaviour',
					'include_entities':		1
				
				},
				defaultTitle:	'Twitter',
				fields:			{
				
					component_behaviour: 	'#wx-twitter-search-value'
				
				}
			
			}			
		
		]
	
	}

];
