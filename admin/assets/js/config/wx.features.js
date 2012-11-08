/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2011 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Author: 	Robert Gerald Porter <rob@weeverapps.com>
				Aaron Song	<aaron@weeverapps.com>
*	Version: 	2.0 beta 1
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
				layouts:		['list'],
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
				layouts:		['list'],
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
	
		id:				'joomla_contact',
		name:			'Contact',
		content:		'contact',
		title:			true,
		defaultTitle:	'Contact Us',
		icon_id:		34,
		layouts:		['panel'],
		config:			{
		
			component_id:	':component_id'
		
		},
		fields:			{
		
			component_id:	'#wx-add-contact-joomla-select'
		
		},
		options:		{
		
			'emailform':	'Display a form instead of my email address',	
			'googlemaps':	'Show my location on a Google Map',
			'showimages':	'Add the image from my Joomla contact'
		
		},
		types:			['oldtabs', 'newtab']
		
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
				layouts:		['list'],
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
				layouts:		['list'],
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
			
			},{
			
				id:				'tag',
				name:			'K2 Tag',
				extension:		'com_k2',
				content:		'html',
				title:			true,
				types:			['oldtabs', 'newtab'],
				layouts:		['list'],
				icon_id:		12,
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-k2-tag-url',
					
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
				layouts:		['list'],
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
				layouts:		['list'],
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
			
			},
			{
			
				id:				'tag',
				name:			'EasyBlog Tag',
				extension:		'com_easyblog',
				content:		'html',
				title:			true,
				//unavailable:	'Coming soon!',
				types:			['oldtabs', 'newtab'],
				layouts:		['list'],
				config:			{
				
					url:		':cms_feed',
					template:	'weever_cartographer'
				
				},
				fields:			{
				
					cms_feed:	'#wx-add-easyblog-tag-url',
					
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
				content:		'twitterUser',
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
	
	},
	{
	
		id:				'facebook',
		defaultTitle:	'Facebook',
		vertical:		'all',
		name:			'Facebook',
		description:	'<p>Add a stream of Facebook updates to your mobile app!</p>' +
			
				'<h4>Mobile App Features</h4>'+
				
				   '<ul><li>Display Facebook updates instantly</li>'+
				    '<li>Share App via Facebook (from the "Share App" tab)</li>'+
				    '<li>Display your Facebook Photos</li>'+
				    '<li>Display your Facebook Events</li>'+
				    
				    '</ul>'+
				 
				' <p><em>It is recommended you add Pages, rather than personal profiles. Due to privacy settings, personal profiles may not work in the app.</em></p>	',
				
		url:			'http://facebook.com/',
		items:			[{
		
			id:				'albums',
			name:			'Facebook Albums',
			content:		'facebookAlbums',
			title:			true,
			defaultTitle:	'Photos',
			types:			['oldtabs', 'newtab'],
			layouts:		['list'],
			icon_id:		15,
			config:			{
			
				user_id:		':component_behaviour'
			
			},
			fields:			{
			
				component_behaviour: 	'#wx-facebook-albums-value'
			
			},
			defaultValue:	{
			
				component_behaviour:	'http://facebook.com/'
				
			}
		
		},{
		
			id:				'statuses',
			name:			'Facebook Statuses',
			content:		'facebookStatuses',
			title:			true,
			defaultTitle:	'Facebook',
			types:			['oldtabs', 'newtab'],
			layouts:		['list'],
			icon_id:		16,
			config:			{
			
				user_id:		':component_behaviour'
			
			},
			fields:			{
			
				component_behaviour: 	'#wx-facebook-statuses-value'
			
			},
			defaultValue:	{
			
				component_behaviour:	'http://facebook.com/'
				
			}
		
		},{
		
			id:				'events',
			name:			'Facebook Events',
			content:		'facebookEvents',
			title:			true,
			defaultTitle:	'Events',
			types:			['oldtabs', 'newtab'],
			layouts:		['list'],
			icon_id:		29,
			config:			{
			
				user_id:		':component_behaviour'
			
			},
			fields:			{
			
				component_behaviour: 	'#wx-facebook-events-value'
			
			},
			defaultValue:	{
			
				component_behaviour:	'http://facebook.com/'
				
			}
		
		}]
			
	},
	{
	
		vertical:		'all',
		id:				'flickr',
		name:			'Flickr',
		url:			'http://flickr.com/',
		description:	'<p>Add Flickr Photo streams, sets (galleries) and even group pools to your app!</p>' +
		
			'<h4>Mobile App Features</h4>' +
			
			'<ul>' +
			
				    '<li>Flickr User Photo Streams</li>'+
				    '<li>Flickr Photo Sets (galleries)</li>'+
				    '<li>Coming soon: Flickr Group Pools (a stream of photos from multiple Flickr users)</li>'+
				    '<li>Albums display in a swipe-to-see-next photo stream</li>'+
				    '<li>Double-tap to display photos at full-screen size</li>'+
			
			'</ul>'+
			
			'<p>Compatible with all <em>publicly available</em> photos on Flickr. Note that photos uploaded prior to April 2011 may not display as gallery thumbnails – simply rotate and save these photos to fix.</p>',
			
		items:			[
		
			{
			
				id:				'photostream',
				name:			'Latest Photos',
				title:			true,
				defaultTitle:	'Latest Photos',
				content:		'flickrPhotostream',
				types:			['oldtabs', 'newtab'],
				layouts:		['carousel'],
				icon_id:		19,
				config:			{
				
					user_id:		':component_behaviour'
				
				},
				fields:			{
				
					component_behaviour:	'#wx-flickr-photostream-photo-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://flickr.com/photos/'
					
				}
			
			},
			{
			
				id:				'photosets',
				name:			'All Photosets',
				defaultTitle:	'Photos',
				title:			true,
				content:		'flickrPhotosets',
				types:			['oldtabs', 'newtab'],
				icon_id:		15,
				layouts:		['list'],
				config:			{
				
					user_id:		':component_behaviour'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://flickr.com/photos/'
					
				},
				fields:			{
				
					component_behaviour:	'#wx-flickr-photosets-photo-url'
				
				}
			
			},
			{
			
				id:				'galleries',
				name:			'All Galleries',
				defaultTitle:	'Photos',
				title:			true,
				content:		'flickrGalleries',
				types:			['oldtabs', 'newtab'],
				icon_id:		15,
				layouts:		['list'],
				config:			{
				
					user_id:		':component_behaviour'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://flickr.com/photos/'
					
				},
				fields:			{
				
					component_behaviour:	'#wx-flickr-galleries-photo-url'
				
				}
			
			}
		
		]
	
	},
	{
	
		id:				'picasa',
		name:			'Picasa',
		url:			'http://picasa.google.com/',
		description:	'<p>Fast and easy photo sharing from Google.</p>'+
		
			'<h4>Mobile App Features</h4>' +
			
			'<ul>' +
			
				'<li>Add your Picasa Web Albums to your mobile app</li>'+
				'<li>Albums display in a gallery and swipe-to-see-next photo stream</li>'+
				'<li>Double-tap to display photos at full-screen size</li>'+
			
			'</ul>', 
		items:			[{
		
			name:			'All Albums',
			id:				'albums',
			defaultTitle:	'Photo Albums',
			title:			true,
			content:		'picasaAlbums',
			types:			['oldtabs', 'newtab'],
			layouts:		['list'],
			icon_id:		17,
			config:			{
			
				user_id:		':component_behaviour'
			
			},
			fields:			{
			
				component_behaviour:	'#wx-picasa-albums-url'
			
			}
		
		
		}/*,{
		
			name:			'Photos From Album',
			id:				'albumphotos',
			defaultTitle:	'Photo Album',
			title:			true,
			content:		'picasaAlbumPhotos',
			types:			['oldtabs', 'newtab'],
			layouts:		['carousel', 'list', 'grid'],
			icon_id:		15,
			unavailable:	'Feature coming soon!',
			config:			{
			
				user_id:		':component_behaviour'
			
			},
			fields:			{
			
				component_behaviour:	'#wx-picasa-albumphotos-url'
			
			}
		
		
		}*/]
	
	},
	{
	
		vertical:		'all',
		id:				'youtube',
		name:			'Youtube',
		url:			'http://youtube.com/',
		description:	'<p>Share your YouTube video channels, playlists and embeds inside your app.</p>'+
			
			'<h4>Mobile App Features</h4>'+
			
			'<ul>'+
			'<li>Display YouTube Channel videos</li>'+
			'<li>Display YouTube Playlist videos</li>'+
			'<li>Play videos embedded in articles</li>'+
			'<li>Videos play in full screen</li>'+
			'</ul>',

		items:			[
		
			{
			
				id:				'channel',
				name:			'User / Channel',
				types:			['oldtabs', 'newtab'],
				title:			true,
				defaultTitle:	'Videos',
				icon_id:		18,
				content:		'youtube',
				layouts:		['list'],
				config:			{
				
					url:		':component_behaviour'
				
				},
				fields:			{
				
					component_behaviour:	'#wx-youtube-channel-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://youtube.com/'
				
				}
			
			},
			{
			
				id:				'playlist',
				name:			'Playlist',
				types:			['oldtabs', 'newtab'],
				content:		'youtubePlaylist',
				title:			true,
				defaultTitle:	'Videos',
				icon_id:		18,
				layouts:		['list'],
				config:			{
				
					url:		':component_behaviour'
				
				},
				fields:			{
				
					component_behaviour:	'#wx-youtube-playlist-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://youtube.com/playlist?list='
				
				}
			
			}
		
		]
	
	},
	{
	
		id:				'vimeo',
		name:			'Vimeo',
		content:		'vimeo',
		url:			'http://vimeo.com/',
		description:	'<p>Add Vimeo video channels to your mobile app – share your media!</p>'+
		
			'<h4>Mobile App Features</h4>'+
			
			'<ul>'+
			
			    '<li>Display Vimeo channel videos</li>'+
			    '<li>Display Vimeo user videos</li>'+
			    '<li>Play videos embedded in articles</li>'+
			    '<li>Videos play in full screen</li>'+
			    
			'</ul>',
			
		types:			['oldtabs', 'newtab'],
		title:			true,
		defaultTitle:	'Videos',
		icon_id:		35,
		layouts:		['list'],
		config:			{
		
			url:		':component_behaviour'
		
		},
		fields:			{
		
			component_behaviour:	'#wx-vimeo-channel-url'
		
		},
		defaultValue:	{
		
			component_behaviour:	'http://vimeo.com/'
		
		}
	
	
	}/*,
	{
	
		id:				'bitsontherun',
		name:			'BitsOnTheRun',
		content:		'bitsontherunPlaylist',
		unavailable:	'Coming soon!',
		url:			'http://www.longtailvideo.com/bits-on-the-run',
		description:	'<p><b>Bits on the Run</b> manages the complete video workflow: upload, transcode, stream, and analyze. We handle the complexities so that you don\'t have to. With just a few clicks you can design your own video player, encode to multiple bitrates, deliver to the iPad, and more.</p>',			
		types:			['oldtabs', 'newtab'],
		title:			true,
		defaultTitle:	'Videos',
		icon_id:		35,
		layouts:		['list'],
		config:			{
		
			url:		':component_behaviour'
		
		},
		fields:			{
		
			component_behaviour:	'#wx-bitsontherun-playlist-url'
		
		}	
	
	}*//*,
	{
	
		id:				'ustream',
		name:			'Ustream',
		url:			'http://ustream.tv/',
		description:	'<p>Share both live and recorded video feeds with your users!</p>',
		items:			[
		
			{
			
				id:				'uservideos',
				name:			'User Videos',
				types:			['oldtabs', 'newtab'],
				title:			true,
				defaultTitle:	'My Videos',
				icon_id:		35,
				content:		'ustreamUserVideos',
				layouts:		['list'],
				config:			{
				
					url:		':component_behaviour'
				
				},
				fields:			{
				
					component_behaviour:	'#wx-ustream-uservideos-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://www.ustream.tv/user/'
				
				}
			
			},
			{
			
				id:				'userchannels',
				name:			'User Channels',
				types:			['oldtabs', 'newtab'],
				content:		'ustreamChannel',
				title:			true,
				defaultTitle:	'My Shows',
				icon_id:		35,
				layouts:		['list'],
				config:			{
				
					url:		':component_behaviour'
				
				},
				fields:			{
				
					component_behaviour:	'#wx-ustream-userchannels-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://www.ustream.tv/user/'
				
				}
			
			},
			{
			
				id:				'channel',
				name:			'Channel',
				types:			['oldtabs', 'newtab'],
				content:		'ustreamChannel',
				title:			true,
				defaultTitle:	'My Shows',
				icon_id:		35,
				layouts:		['list'],
				config:			{
				
					url:		':component_behaviour'
				
				},
				fields:			{
				
					component_behaviour:	'#wx-ustream-userchannels-url'
				
				},
				defaultValue:	{
				
					component_behaviour:	'http://www.ustream.tv/user/'
				
				}
			
			}
		
		]
	
	}*/,
	{
	
		vertical:		'all',
		id:				'wufoo',
		name:			'Wufoo Forms',
		content:		'wufoo',
		url:			'http://wufoo.com/',
		description:	'<p>Use Wufoo\'s free online form creator to power your Weever App\'s contact forms, online surveys, and event registrations.</p>'+
		
			'<p>Wufoo Forms connect to many free and paid services on the web.</p>'+
			
			'<h4>Integrates With:</h4>'+
			
			'<ul>'+
			
				    '<li>MailChimp Newsletters</li>'+
				    '<li>Campaign Monitor Newsletters</li>'+
				    '<li>PayPal Donations and Payments</li>'+
				    '<li>SalesForce CRM</li>'+
				    '<li>Freshbooks Accounting &amp; Billing</li>'+
				    '<li>Highrise Contact Management</li>'+
				    '<li>Twitter "Auto Form Tweets"</li>'+
				
			'</ul>'+
			
			'<p>For more information check out: <a href="http://wufoo.com/integrations" target="_blank">http://wufoo.com/integrations</a></p>',
			
		types:			['oldtabs', 'newtab'],
		title:			true,
		defaultTitle:	'Forms',
		tier:			2,
		icon_id:		30,
		layouts:		['list'],
		config:			{
		
			url:		':component_behaviour',
			apikey:		':var'
		
		},
		fields:			{
		
			component_behaviour:	'#wx-wufoo-form-url',
			var:					'#wx-wufoo-form-api-key'
		
		}
	
	},
	{
	
		vertical:		'all',
		id:				'foursquare',
		name:			'Foursquare',
		defaultTitle:	'Foursquare Photos',
		url:			'http://foursquare.com/',
		description:	'<p>Foursquare is a location-based social networking website for mobile devices. Users "check-in" at venues by selecting from a list of venues the app locates nearby. Each check-in awards the user points and sometimes "badges".</p>' +
		
			'<p>With Weever Apps, you can add a real-time photo stream for a Foursquare location.'+
			
			'<ul>'+
			
				    '<li>Add a real-time stream of user-generated Foursquare Venue Photos to your mobile app.</li>'+
				    '<li>Albums display in a swipe-to-see-next photo stream</li>'+
				    '<li>Double-tap to display photos at full-screen size</li>'+
				
			
			'</ul>',
		items:			[{
		
			id:				'photos',
			name:			'Foursquare Photos',
			content:		'foursquarePhotos',
			title:			true,
			types:			['oldtabs', 'newtab'],
			layouts:		'carousel',
			icon_id:		25,
			config:			{
			
				venue_id:		':component_behaviour',
				group:			'venue'
			
			},
			fields:			{
			
				component_behaviour:	'#wx-foursquare-photo-url'
			
			},
			defaultValue:	{
			
				component_behaviour:	'https://foursquare.com/v/'
			
			}
		
		},{
		
			id:				'tips',
			name:			'Foursquare Tips',
			content:		'foursquareTips',
			title:			true,
			types:			['oldtabs', 'newtab'],
			layouts:		'list',
			icon_id:		25,
			config:			{
			
				venue_id:		':component_behaviour',
				group:			'venue'
			
			},
			fields:			{
			
				component_behaviour:	'#wx-foursquare-tips-url'
			
			},
			defaultValue:	{
			
				component_behaviour:	'https://foursquare.com/v/'
			
			}
		
		}]
	
	},
	{
	
		id:				'blogger',
		name:			'Blogger',
		content:		'blogger',
		title:			true,
		defaultTitle:	'My Blog',
		types:			['oldtabs', 'newtab'],
		layouts:		'list',
		icon_id:		6,
		config:			{
		
			blog_url:	':cms_feed'
		
		},
		fields:			{
		
			cms_feed: 	'#wx-add-blog-blogger-url-input'
		
		}
	
	},

];
