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

jQuery( document ).ready( function() {

	jQuery('.wx-add-source-icon').click(function(e) {
	
		var typeRef 		= jQuery(this).attr('ref'),
			typeRel			= jQuery(this).attr('rel'),
			dialogId,
			buttonNames		= ["Cancel", "Add to App"],
			backAction,
			buttons			= {};
			
		if( jQuery(this).is('.wx-missing-extension') ) {
		
			alert("You must install this extension before you can add it to your app.");
			return;
		
		}
			
		if( jQuery(this).is('.wx-unavailable') ) {
		
			alert("This feature is coming soon! See http://www.weeverapps.com/mobile/tour for details.");
			return;
		
		} else if( jQuery(this).is('.wx-upgrade-prompt') ) {
			
			dialogId	=  '#wx-upgrade-notice';
			
			wx.localizedConditionalDialog( ["Cancel"], dialogId );
			
			return;
		
		}
		
		backAction		= function() { 
		
			jQuery( "#wx-add-" + typeRel + "-type-dialog" ).dialog('open'); 
		
		}
		
		dialogId = "#wx-" + typeRef + "-dialog";
		
		jQuery('.wx-jquery-dialog').dialog('close');
		
		buttons[ buttonNames[0] ] 		= function() {
		
			jQuery(this).dialog( "close" );
		
		}
		
		if( jQuery(this).hasClass('wx-add-single') && !( jQuery(this).hasClass('wx-special-notice') ) ) {
		
			buttons[ buttonNames[1] ] 	= function() {
			
				jQuery(this).dialog( "close" );
			
			}
			
			wx.localizedConditionalDialog(["Add to App", "Cancel"], dialogId, backAction, true, true );
			
			return;
		
		}
	
		wx.localizedConditionalDialog( ["Cancel"], dialogId, backAction );
		
		e.preventDefault();
	
	});	
	
	
	jQuery('div.wx-add-item-icon').click(function() {

		var typeId		= jQuery(this).attr('id'),
			dialogId,
			backAction,
			service		= typeId.split('-')[1];
			
		backAction		= function() { 
		
			jQuery('#wx-add-'+ service +'-dialog').dialog('open'); 
		
		}
		
		jQuery('.wx-jquery-dialog').dialog('close');
		
		dialogId = "#wx-" + typeId + "-dialog";
		
		wx.localizedConditionalDialog( ["Add to App", "« Back"], dialogId, backAction, true );
		
	});		
	

	jQuery('div.wx-nav-label').dblclick( wx.navLabelDialog );
	jQuery('button.wx-nav-label').click( wx.navLabelDialog );
	
	jQuery('div.wx-nav-icon').dblclick( wx.navIconDialog );
	jQuery('button.wx-nav-icon').click( wx.navIconDialog );
	
	jQuery('button.wx-nav-tablayout').click( wx.navTabLayoutDialog );
	
	jQuery('button.wx-tab-settings').click( function(e) {
	
		wx.settingsDialog[ jQuery(this).attr('rel') ](e, jQuery(this).attr('ref'));
		
	});
	
	jQuery('select#wx-add-contact-joomla-select').change( function() {
	
		var actionButton = 'div.ui-dialog-buttonset button#wxui-action';
	    
		jQuery(actionButton).removeAttr('disabled');
		jQuery(actionButton).removeClass('white');
		jQuery(actionButton).addClass('blue'); 

	});
	
	jQuery('select.wx-cms-feed-select').change( function() {
	
		var actionButton = 'div.ui-dialog-buttonset button#wxui-action';

		/* if no value='', some browsers take the text inside the option */
		
	    if(jQuery(this).val() != jQuery(this).find("option:selected").text() && jQuery(this).val() != '') {
	    
			jQuery(actionButton).removeAttr('disabled');
			jQuery(actionButton).removeClass('white');
			jQuery(actionButton).addClass('blue');
			
			jQuery('#wx-geotag-new-item')
				.removeAttr('disabled')
				.html('+ Add Map Markers');
			
			wx.checkR3SGeo( wx.juriBase + jQuery(this).val() + "&geotag=true", function( item_count ) {
			
				jQuery('#wx-geotag-new-item')
					.attr('disabled', 'disabled')
					.html('Content is already geotagged');
			
			});
	       
		}
		else {
		
			jQuery('#wx-geotag-new-item')
				.html('---');
		
			jQuery(actionButton).attr('disabled', 'disabled');
			jQuery(actionButton).removeClass('blue');
			jQuery(actionButton).addClass('white');
			
		}
	    
	});
	
	jQuery('#wx-add-k2-category-name').change( function() {
	
		jQuery('#wx-geotag-new-item')
			.removeAttr('disabled')
			.html('+ Add Map Markers');
	
		wx.checkR3SGeo( wx.juriBase + jQuery('#wx-add-k2-category-url').val() + "&geotag=true", function( item_count ) {
		
			jQuery('#wx-geotag-new-item')
				.attr('disabled', 'disabled')
				.html('Content is already geotagged');
		
		});	
	
	});
	
	jQuery('a.modal').click( function() {
	
		var actionButton = 'div.ui-dialog-buttonset button#wxui-action';
	
		jQuery(actionButton).removeAttr('disabled');
		jQuery(actionButton).removeClass('white');
		jQuery(actionButton).addClass('blue');
	
	});
	
	jQuery('input.wx-dialog-input').keyup( function() {
	
		var actionButton = 'div.ui-dialog-buttonset button#wxui-action';
	
	    if( jQuery(this).val() != '' ) {
	    
	    	jQuery(actionButton).removeAttr('disabled');
	    	jQuery(actionButton).removeClass('white');
	    	jQuery(actionButton).addClass('blue');
	    
	    } else {
	    
		    jQuery(actionButton).attr('disabled', 'disabled');
		    jQuery(actionButton).removeClass('blue');
		    jQuery(actionButton).addClass('white');
	    
	    }
	    
	});
	
	jQuery('.wx-table-sort').sortable({
	
	    cursor:     			'move',
	    axis:       			'y',
	    revert:  				true,
	    forcePlaceholderSize: 	true,
	    placeholder: 			'group_move_placeholder',
	    items: 					'tr',
	    update: 				function(e, ui) {
	    
			jQuery(this).sortable("refresh");
			
			var siteKey 	= jQuery("input#wx-site-key").val();
			var str 		= String(jQuery(this).sortable('toArray'));
			
			jQuery.ajax({
			
				type: 		"POST",
				url: 		"index.php",
				data: 		"option=com_weever&task=ajaxSaveTabOrder&site_key="+siteKey+"&order="+str,
				success: 	function(msg) {
				
					jQuery('#wx-modal-loading-text').html(msg);
					
					if(msg == "Order Updated")
						jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
					
					else {
					
						jQuery('#wx-modal-secondary-text').html('');
						jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					
					}
				
				}
			
			});
	      	 
	    }
	    
	});
		
	jQuery('.wx-table-sort').disableSelection();
	
	jQuery('a.wx-subtab-link').click(function() {
	
		var tabId 		= jQuery(this).attr('title');
			tabId 		= tabId.substring(4);
		
		var siteKey		= jQuery("input#wx-site-key").val(),
			htmlName 	= jQuery(this).html(),
			txt 		= '<h3 class="wx-imp-h3">' + Joomla.JText._('WEEVER_JS_ENTER_NEW_APP_ITEM') + '</h3>' +
			'<input type="text" id="alertName" name="alertName" value="'+htmlName+'" />',
			clickedElem = jQuery(this);
		
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true) { 
			
				tabName = f["alertName"];
				
				jQuery.ajax({
				
					type: 		"POST",
					url: 		"index.php",
					data: 		"option=com_weever&task=ajaxSaveTabItemName&name=" + encodeURIComponent(tabName) + "&id=" + tabId + '&site_key=' + siteKey,
					success: 	function(msg) {
					
						jQuery('#wx-modal-loading-text').html(msg);
						
						if(msg == "Tab Changes Saved") {
						
							jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
							clickedElem.html(tabName);
							
						}
						else {
						
							jQuery('#wx-modal-secondary-text').html('');
							jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
							
						}
						
					}
					
				});
			
			}
			
		}	
		
		submitCheck = function(v,m,f) {
		
			an = m.children('#alertName');
			
			if(f.alertName == "" && v == true) {
			
				an.css("border", "solid #ff0000 1px");
				
				return false;
				
			}
			
			return true;
		
		}		
		
		var tabName 	= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
			
		});
		
		jQuery('input#alertName').select();
		// hit 'enter/return' to save
		jQuery("input#alertName").bind("keypress", function (e) {
		
			if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
				
				jQuery('button#jqi_state0_buttonSubmit').click();
				return false;
				
			} else {
			
			return true;
			
			}
			
		});
		
	});
	
	
	jQuery("a.wx-subtab-sort").click(function() {
	
		var tabId 			= jQuery(this).attr('title'),
			gpsSetting		= ( jQuery(this).attr('rel') == "true" ? true : false ),			
			siteKey 		= jQuery("input#wx-site-key").val(),
			clickedElem 	= jQuery(this),	
			htmlName 		= jQuery(this).html();
			
		tabDropdown = "<select id='wxSelectSortTab'><option value='null'>Default</option><option value='gps' "+ (gpsSetting ? "selected='selected' " : "" ) + ">GPS/Nearby</option><input type='hidden' id='gps' name='gps' value='"+gpsSetting+"' />";
		
		tabDropdown += "</select>";
		
		var txt 	= '<h3 class="wx-imp-h3">Change Sort Method for Lists, Grids, and Carousels</h3> ' + tabDropdown;
		
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true) { 
			
				gps = f['gps'] || false;
				
				jQuery.ajax({
				
					type: 		"POST",
					url: 		Joomla.comWeeverConst.server + "api/v2/tabs/set_gps",
					data: 		"gps="+ gps +"&tab_id=" + tabId+ '&site_key=' + siteKey,
					success: 	function(msg) {
					
						jQuery('#wx-modal-loading-text').html(msg);
						
						if(msg.success) {
						
							jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
							setTimeout("document.location.reload(true);",20);
							
						} else {
						
							jQuery('#wx-modal-secondary-text').html('');
							jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
							
						}
					
					}
					
				});
			
			}
			
		}	
		
		submitCheck = function(v,m,f) {
		
			console.log(f);
			
			return true;
		
		}		
		
		var tabName 	= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			loaded:			function() {
		
				jQuery('select#wxSelectSortTab').change( function() {
				
					jQuery('#gps').val( jQuery(this).val() );
			
				});
			
			},
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
			
		});
		
		jQuery('#wxSelectSortTab').select();
		// hit 'enter/return' to save
		jQuery("#wxSelectSortTab").bind("keypress", function (e) {
		
			if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
				
				jQuery('button#jqi_state0_buttonSubmit').click();
				return false;
				
			} else {
			
			return true;
			
			}
			
		});
	
	});
	
	
	jQuery("a.wx-subtab-movetab").click(function() {
	
		var tabId 			= jQuery(this).attr('title').substring(4),			
			siteKey 		= jQuery("input#wx-site-key").val(),
			clickedElem 	= jQuery(this),	
			htmlName 		= jQuery(this).html();
			
		tabDropdown = "<select id='wxSelectTab'><option value='null'>Promote to New Tab</option>";
		
		for( var i=0; i < wx.tabSyncData.tabs.length; i++ ) {
		
			if( wx.tabSyncData.tabs[i].parent_id != null )
				continue;
				
			var name = wx.tabSyncData.tabs[i].tabTitle || wx.tabSyncData.tabs[i].title;
				
			tabDropdown += "<option value='" + wx.tabSyncData.tabs[i].id + "'>" + name + "</option>";
		
		}
		
		tabDropdown += "</select>";
		
		var txt 	= '<h3 class="wx-imp-h3">Move Tabs or Create New Tab</h3><input type="hidden" id="parentId" name="parentId" value="" /> ' + tabDropdown;
		
		myCallbackForm = function(v,m,f) {
		
			if(v != undefined && v == true) { 
			
				parentId = f['parentId'];
				
				jQuery.ajax({
				
					type: 		"POST",
					url: 		"index.php",
					data: 		"option=com_weever&task=ajaxTabMove&parent_id="+ parentId +"&tab_id=" + tabId+ '&site_key=' + siteKey,
					success: 	function(msg) {
					
						jQuery('#wx-modal-loading-text').html(msg);
						
						if(msg == "Item Moved") {
						
							jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
							setTimeout("document.location.reload(true);",20);
							
						} else {
						
							jQuery('#wx-modal-secondary-text').html('');
							jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
							
						}
					
					}
					
				});
			
			}
			
		}	
		
		submitCheck = function(v,m,f) {
		
			console.log(f);
			
			return true;
		
		}		
		
		var tabName 	= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			loaded:			function() {
		
				jQuery('select#wxSelectTab').change( function() {
				
					jQuery('#parentId').val( jQuery(this).val() );
			
				});
			
			},
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
			
		});
		
		jQuery('#wxSelectTab').select();
		// hit 'enter/return' to save
		jQuery("#wxSelectTab").bind("keypress", function (e) {
		
			if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
				
				jQuery('button#jqi_state0_buttonSubmit').click();
				return false;
				
			} else {
			
			return true;
			
			}
			
		});
	
	});
			
	jQuery("a.wx-subtab-publish").click(function() {
	
		var tabId 	= jQuery(this).attr('title');
			tabId = tabId.substring(4);
			
		var siteKey 		= jQuery("input#wx-site-key").val(),
			clickedElem 	= jQuery(this),
			pubStatus 		= jQuery(this).attr('rel'),
			unpublishedIcon = '<img src="components/com_weever/assets/icons/publish_x.png" border="0" alt="Unpublished">',
			publishedIcon 	= '<img src="components/com_weever/assets/icons/tick.png" border="0" alt="Published">';
		
		jQuery.ajax({
		
			type: 		"POST",
			url: 		"index.php",
			data: 		"option=com_weever&task=ajaxTabPublish&status=" + pubStatus + "&id=" + tabId+ '&site_key=' + siteKey,
			success: 	function(msg) {
			
				jQuery('#wx-modal-loading-text').html(msg);
				
				if(msg == "Item Status Updated") {
				
					jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
				
					if(pubStatus == 1) {
					
						clickedElem.html(unpublishedIcon);
						clickedElem.attr('rel', 0);
						
					} else {
					
						clickedElem.html(publishedIcon);
						clickedElem.attr('rel', 1);
						
					}
					
				} else {
				
					jQuery('#wx-modal-secondary-text').html('');
					jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					
				}
			
			}
			
		});
	
	});
			
	
	jQuery("a.wx-subtab-delete").click(function() {
	
		var tabId = jQuery(this).attr('title');
			tabId = tabId.substring(4);
			
		var siteKey 	= jQuery("input#wx-site-key").val(),
			tabType 	= jQuery(this).attr('rel'),
			tabName 	= jQuery(this).attr('alt'),		
			confDelete 	= confirm( Joomla.JText._('WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO') + tabName + Joomla.JText._('WEEVER_JS_QUESTION_MARK') );
		
		if(!confDelete)
			return false;
		
		jQuery.ajax({
			
			type: 		"POST",
			url: 		"index.php",
			data: 		"option=com_weever&task=ajaxTabDelete&id="+tabId+'&site_key='+siteKey,
			success: 	function(msg) {
			
				jQuery('#wx-modal-loading-text').html(msg);
				
				if(msg == "Item Deleted")
				{
				
					jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
					document.location.href = "index.php?option=com_weever#"+tabType+"Tab";
					setTimeout("document.location.reload(true);",20);
					
				}
				else
				{
				
					jQuery('#wx-modal-secondary-text').html('');
					jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					
				}
			
			}
			
		});
	
	});

});