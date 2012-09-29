<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0
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

$document 		= &JFactory::getDocument();

if(comWeeverHelper::joomlaVersion() == '1.5')  // ### 1.5 only
	$js_close = "document.getElementById('sbox-window').close();";
else 
	$js_close = "window.parent.SqueezeBox.close();";
	
if( !comWeeverHelper::componentExists("com_k2") )
	$extraScript .= "var wxComK2	= false;";
else 
	$extraScript .= "var wxComK2	= true;";
	
if( !comWeeverHelper::componentExists("com_easyblog") )
	$extraScript .= "var wxComEasyBlog	= false;";
else 
	$extraScript .= "var wxComEasyBlog	= true;";
	
if( JRequest::getVar('swipe_page') )
	$js_swipe_page = " wx.swipe.slide( " . JRequest::getVar('swipe_page') . ", 400 ); ";
else 
	$js_swipe_page = "";

$document->addCustomTag ('<script type="text/javascript">

				function jSelectItem(id, title, object) {
			
                    jQuery(\'#wx-add-k2-item-url\').val(\'index.php?option=com_k2&view=item&id=\' + id);
                    jQuery(\'#wx-add-k2-item-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectItem(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-item-url\').val(\'index.php?option=com_easyblog&view=entry&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-item-name\').val(title);
                   '.$js_close.'
                       
                }

				function jSelectCategory(id, title, object) {
			
                    jQuery(\'#wx-add-k2-category-url\').val(\'index.php?option=com_k2&view=itemlist&layout=category&task=category&template=weever_cartographer&id=\' + id);
                    jQuery(\'#wx-add-k2-category-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectCategory(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-category-url\').val(\'index.php?option=com_easyblog&view=categories&layout=listings&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-category-name\').val(title);
                   '.$js_close.'
                       
                }

				function jSelectTag(id, title, object) {
			
                    jQuery(\'#wx-add-k2-tag-url\').val(\'index.php?option=com_k2&view=itemlist&task=tag&template=weever_cartographer&tag=\' + title);
                    jQuery(\'#wx-add-k2-tag-name\').val(title);
                   '.$js_close.'
                       
                }
				
				function jEasyblogSelectTag(id, title, object) {
			
                    jQuery(\'#wx-add-easyblog-tag-url\').val(\'index.php?option=com_easyblog&view=tags&layout=tag&format=weever&id=\' + id);
                    jQuery(\'#wx-add-easyblog-tag-name\').val(title);
                   '.$js_close.'
                       
                }
                
                function jSelectArticle(id, title, object) {
                
            		jQuery(\'#wx-add-joomla-article-name\').val(title);
            		jQuery(\'#wx-add-joomla-article-url\').val(\'index.php?option=com_content&view=article&id=\' + id);
            		'.$js_close.'
                		
                }
                
                function jSelectArticleNew(id, title, catid, object) {
					
					jQuery(\'#wx-add-joomla-article-name\').val(title);
					jQuery(\'#wx-add-joomla-article-url\').val(\'index.php?option=com_content&view=article&id=\' + id);
					'.$js_close.'
					
                }
                
                jQuery( document ).ready( function() {
                
                	'.$js_swipe_page.'
                	
                	jQuery(\'html, body\').animate({scrollTop:0}, \'fast\');
                
                });
                
                '.$extraScript.'
                
                </script>
                
	');
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list_icons.js?v='.comWeeverConst::VERSION );
//99$document->addScript( JURI::base(true).'/components/com_weever/assets/js/list.js?v='.comWeeverConst::VERSION );

$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.tabtypes.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.features.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.swipepages.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/config/wx.tabcomponents.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/wx.build.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/wx.list.joomla.ini.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/jq.list.js?v='.comWeeverConst::VERSION );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/swipe.js?v='.comWeeverConst::VERSION );
