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

var wx	= wx || {};

wx.activeTypeDialog	= null;

/* IE 8 and Camino give errors if a console.log is left in the code */
/* Let's fix that: */

if (typeof console == "undefined") {

    this.console = { log: function() {} };
    
}

//unused so far
wx.checkR3SGeo 		= function( url, callback ) {

	var xmlhttp 		= new XMLHttpRequest(),
		xmlhttpCall		= url;

	xmlhttp.open("GET", xmlhttpCall );	
	xmlhttp.send();

	xmlhttp.onreadystatechange = function()	{
	
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
		
			var response 	= JSON.parse( xmlhttp.responseText ) || null,
				item_count	= 0;
				
			if( !response )
				return;
				
			if( !!response.items ) {
			
				for( var i = 0; i < response.items.length; i++ ) {
				
					var item 	= response.items[i],
						geo;		

					if( !item.geo )
						continue;
						
					if( !item.geo instanceof Array )
						geo = [item.geo]
					else 
						geo = item.geo;
						
					item_count += geo.length;

				}
			
			}
			
			else {

				var geo = response.results[0].geo || null;
			
				if( !geo )
					return;

				if( !geo instanceof Array )
					geo = [geo];	
					
				if( !geo.length )
					return;
					
				item_count += geo.length;
			
			}
			
			if( !item_count )
				return;
		
			callback( item_count );
			
		}
		
	}

}

wx.addGeoFromWeeverMaps	= function() {

	if( !!!wmx || !!!wmx.markers || !wmx.markers.length )
		return null;
		
	var geo = [];

	for( var i = 0; i < wmx.markers.length; i++ ) {
	
		marker 	= wmx.markers[i];
		geo[i]	= {};
		
		geo[i].latitude 	= marker.position.lat();
		geo[i].longitude 	= marker.position.lng();
		geo[i].label		= marker.labelContent;
		geo[i].marker_url	= marker.icon.url;
		
		if( jQuery('#wmx-kml-url').val() ) {
		
			geo[i].kml = jQuery('#wmx-kml-url').val();
			
			jQuery('#wmx-kml-url').val( null );
		
		}
	
	}
	
	wmx.clearMap();

	return geo;

}

/* Prep our Ajax call to the CMS */

wx.ajaxAddTabItem	= function(a) {

	var ajaxUrls	= [],
		returned	= 0,
		addAjaxUrl	= function(type, data) {

			var newType = new wx.ajaxUrl({ 
			
				type:		type,
				content:	data.content,
				config:		data.config,
				geo:		wx.addGeoFromWeeverMaps(),
				layout:		jQuery('#wxLayoutType option:selected').val(),
				tabLayout:	jQuery('#wxTabLayoutType option:selected').val(),
				icon_id:	data.icon_id,
				published:	1
				
			});
			
			/* If there's no user-entered title, use the default; e.g., Facebook */
			if( undefined != data.defaultTitle && !( jQuery('#wx-add-title-tab-item').val() ) )
				newType.title = "&name=" + encodeURIComponent( data.defaultTitle );
		 
		 	/* get all the fields we need */
			for( var ii in data.fields ) {

				newType[ii]	= jQuery( data.fields[ ii ] ).val();
				
			}
			
			/* for those where we're just going to set the title as a Twitter handle, etc */
			if( "component_behaviour" == data.defaultTitle )
				newType.title = "&name=" + encodeURIComponent( newType.component_behaviour );
				
			if(data.options) {
			
				for( var ii in data.options ) {
				
					newType.extra += "&" + ii + "=";
				
					if( jQuery('#wx-add-source-option-' + ii ).is(':checked') )
						newType.extra += "1";
					else	
						newType.extra += "0";
				
				}
			
			}
			
			ajaxUrls.push( newType.getParams() );
		
		};
	
	if( a.featureData.types instanceof Array ) {
	
		/* for each type checked */
		for( var i=0; i < a.featureData.types.length; i++ ) {
		
			if ( jQuery('#wx-add-source-check-' + a.featureData.types[i] + ':checked').length > 0 ) {
			
				addAjaxUrl(a.featureData.types[i], a.featureData);
			
			}
			
		}
	
	} else {
	
		addAjaxUrl(a.featureData.types, a.featureData);	
	
	}
	
	//console.log(ajaxUrls);
	
	for( var i=0; i < ajaxUrls.length; i++ ) {
	
		jQuery.ajax({
		
		   type: 	"POST",
		   url: 	"index.php",
		   data: 	ajaxUrls[i],
		   success: function(msg) {
		   
		     jQuery('#wx-modal-loading-text').html(msg);
		     
		     returned++;
		     
		     if( returned == ajaxUrls.length ) {
		     
			     if(msg == "Item Added")
			     {

			     	var hashTab;
			     	
			     	if( wx.activeTypeDialog != null )
			     		hashTab	= "&refresh=" + Math.random() + "#" + wx.activeTypeDialog + "Tab";
			     	else 
			     		hashTab = "&swipe_page=" + wx.swipe.getPos() + "&refresh=" + Math.random() + "#addTab";
			     
			     	jQuery('#wx-modal-secondary-text').html('Reloading page..');
			     	document.location.href = wx.baseExtensionUrl + hashTab;
			     	
			     	//setTimeout( function() { document.location.reload(true); }, 25 );
			     	
			     }
			     else
			     {
			     
			     	jQuery('#wx-modal-secondary-text').html('');
			     	jQuery('#wx-modal-error-text').html( Joomla.JText._('WEEVER_JS_SERVER_ERROR') );
			     	
			     }
			     
			 }
		     
		   }
		   
		 });
	
	}
	
}

/* Confirmation dialog, skipped if we don't ask about a title (wx.features [title] property is undefined) */

wx.confirmAddTabItem	= function(a) {

	var dialogId		= '#wx-add-title-tab-dialog',
		titlebarHtml	= "Confirm";
		
	if( undefined != a.featureData.defaultTitle )
		jQuery('input#wx-add-title-tab-item').val(a.featureData.defaultTitle);
	else
		jQuery('input#wx-add-title-tab-item').val('');
		
	if( undefined != a.featureData.titleUse )
		jQuery('p#wx-add-title-use').html(a.featureData.titleUse);
	else
		jQuery('p#wx-add-title-use').html(
		
			'This title will be just above your content, keep it short so it will fit easily on a small screen.'
		
		);

	jQuery(dialogId).dialog({
		
		modal: 		true, 
		resizable: 	false,
		width: 		'auto',
		height: 	'auto',
		title:		titlebarHtml,
		show:		'fade',
		hide:		'drop',
		buttons: 	wx.setButtonActions({
			
			buttonName:		['Finish', 'Cancel'],
			dialogId:		dialogId,
			backAction:		function() { 
			
				jQuery(a.previousDialog).dialog('open'); 
			
			},
			action:			wx.ajaxAddTabItem, 
			actionArg:		{
			
				previousDialog: 	a.dialogId,
				featureData:		a.featureData
				
			}
			
		}),
		open:		function(e, ui) {
		
			/* click outside dialog to close */
		
			jQuery('.ui-widget-overlay').bind('click', function() { 
			
				jQuery(dialogId).dialog('destroy');
				
			});
			
		}
			
	}); 		

}

/* object to create a set of buttons, one cancel, one for action */

wx.setButtonActions		= function(a) {

	var buttons		= {};

	if( undefined != a.buttonName[1] ) {
		
		/* action button */
		buttons[ a.buttonName[0] ] = {
			
			id:		'wxui-action',
			text:	a.buttonName[0],
			click:	function() {
			
				jQuery(a.dialogId).dialog( "destroy" );
	
				a.action(a.actionArg);
				
			}
		
		};
		
		/* cancel button */
		buttons[ a.buttonName[1] ] = function() {
		
			jQuery(a.dialogId).dialog( "destroy" );
			
			if( isFunction(a.backAction) )
				a.backAction();
		
		};
	
	} 
	else {
	
		/* solo cancel button */
		buttons[ a.buttonName[0] ] = function() {
		
			jQuery(a.dialogId).dialog( "destroy" );
			
			if( isFunction(a.backAction) )
				a.backAction();
		
		};
	
	}
	
	return buttons;

};

/* Create our dialog, with localization */

wx.localizedConditionalDialog	= function (buttonName, dialogId, backAction, populateOptions, single) {

	var	type 			= dialogId.replace('#wx-add-', '').replace('-dialog', '').replace(/\-/, '.'),
		subType 		= type.split('.'),
		titlebarHtml	= '',
		featureData,
		parentFeatureData,
		actionArg,
		action,
		getFeatureData	= function() {	
		
			for( var i=0; i < wx.features.length; i++ ) {
			
				if( wx.features[i].id == subType[0] && wx.features[i].items && subType[1] ) {
				
					parentFeatureData = wx.features[i];

					for (var ii=0; ii < wx.features[i].items.length; ii++ ) {
					
						if( wx.features[i].items[ii].id == subType[1] )
							featureData = wx.features[i].items[ii];
					
					}
				
				}
				else if( wx.features[i].id == subType[0] )
					featureData = wx.features[i];
			
			}
			
			if( undefined == featureData ) {
			
				console.log('Failed with type ' + type );
				return;
				
			}
			
			if( undefined != parentFeatureData ) {
			
				titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' src='" + wx.navIconDir + parentFeatureData.id + ".png' /> " + parentFeatureData.name + ": " + featureData.name;
			
			}
			else
			{
			
				titlebarHtml += "<img class='wx-jquery-dialog-titlebar-icon' src='" + wx.navIconDir + featureData.id + ".png' /> " + featureData.name;
			
			}
		
		};
	
	/* Services only */
	
	if( subType[1] != 'type' ) {
	
		getFeatureData();
		
		/* So correct tab type is checkboxed if we got here via Tab Types */
		if( true == populateOptions && true == single ) {

			wx.activeTypeDialog = null;

		}
		
		if( wx.activeTypeDialog != null ) {
		
			jQuery('.wx-sub-item-option').hide();
			jQuery('.wx-type-' + wx.activeTypeDialog + '-option').show();
		
		}
		
		if( true === featureData.title ) 
			action 	= wx.confirmAddTabItem;
		else 
			action	= wx.ajaxAddTabItem;
			
		/* add any default values for the input */
		
		if( undefined != featureData.defaultValue ) {
		
			for( var i in featureData.defaultValue ) {
			
				jQuery( featureData.fields[i] ).val( featureData.defaultValue[i] );
				
			}
		
		}
		
		
	}	
	/* Tab Types only; no action button, use Tab Name for icon */
	else { 
	
		wx.activeTypeDialog = subType[0];
		
		//alert(wx.activeTypeDialog);
		
		titlebarHtml 	+= "<img class='wx-jquery-dialog-titlebar-icon' src='" + wx.navIconDir +  subType[0] + ".png' /> " + wx.types[ subType[0] ].name;
		
		action 			= function(a) { null; };
	
	}
	
	/* build checkbox options; if only one option, do not display checkbox */
	
	if( true == populateOptions && jQuery(dialogId + ' > div#wx-added-elems').length == 0 && undefined != featureData.types ) {
	
		var checkboxOptions	= '<div id="wx-added-elems"></div>', // hidden div to detect repetition
			serviceTypes	= featureData.types;
			
		/* if it's a string, convert it */
		if( typeof serviceTypes === "string" ) {
			
			oldString 		= serviceTypes;
			
			serviceTypes	= [];				
			serviceTypes[0] = oldString;
			
		}

		if( serviceTypes.length == 1 ) {
		
			if( undefined == featureData.labels )
				checkboxOptions 	+= "<p>" + wx.tabTypes[ serviceTypes[0] ].label.futurePassive;
			else
				checkboxOptions		+= "<p>" + featureData.labels[ serviceTypes[0] ].futurePassive;
		
			checkboxOptions 	+= " in the tab \"" + wx.types[ serviceTypes[0] ].name + "\".</p>";	
			
		}
		else
		{
		
			/****** */
		
			var layoutOptions = "",
				initLayoutVal = 0;
			
			if( featureData.layouts instanceof Array ) {
			
				for( var i = 0; i < featureData.layouts.length; i ++ ) {
				
					selectedText = ( 0 == i ) ? " selected='selected'" : "";
					
					initLayoutVal = featureData.layouts[i];
				
					layoutOptions += "<option "+ selectedText +" value='" + featureData.layouts[i] + "'>" + wx.layoutTypes[  featureData.layouts[i] ] + "</option>";
				
				}	
				
			}
			
			else {
			
				layoutOptions = "<option selected='selected' value='" + featureData.layouts + "'>" + wx.layoutTypes[ featureData.layouts ] + "</option>";
			
			}
			
			// kill old version		
			jQuery(dialogId).append( "<h4>How should this content by displayed?</h4><div class='wx-add-layout-dropdown-container'>" +
			
				"<form name='wxLayoutForm'><select id='wxLayoutType' name='wxLayoutType' autocomplete='off'>" + 
			
					layoutOptions +
			
				"</select></form></div>"	
				
			);
			
			jQuery('#wxLayoutType').val( initLayoutVal );
		
			/****** */
			var checked, label, disabled, tabList = [], tabDropdown,
				extraClass		= '';
				
			if( featureData.options ) {
			
				for( var i in featureData.options ) {
				
					checkboxOptions		+= "<div>"+
									
							"<input type='checkbox' class='wx-add-source-check' id='wx-add-source-option-" + i + "' value='" + i + "' />" +
							
							"<label for='wx-add-source-option-" + i + "'>"+ featureData.options[i] +"</label>" +
			
						"</div>"
				
				}			
			
			}
			
				
			tabDropdown 		= "<select id='wxSelectOldTab'>";

			
			for( var i=0; i < wx.tabSyncData.tabs.length; i++ ) {
			
				var mapClass = "";
			
				if( wx.tabSyncData.tabs[i].parent_id != null || wx.tabSyncData.tabs[i].layout == "share" )
					continue;
					
				var name = wx.tabSyncData.tabs[i].tabTitle || wx.tabSyncData.tabs[i].title;
				
				name += " (" + (wx.tabSyncData.tabs[i].tabLayout || "sub-tab") + " layout)";
				
				if( wx.tabSyncData.tabs[i].tabLayout == "map" ) 
					mapClass = "class='wx-map-select' ";
					
				tabDropdown += "<option " + mapClass + "value='" + wx.tabSyncData.tabs[i].id + "'>" + name + "</option>";
			
			}
			
			tabDropdown += "</select>";

			for( var i=0; i < serviceTypes.length; i++ ) {
			
				if( i == 0 && wx.tabSyncData.tabs.length < 2 ) {
				
					tabDropdown 	= "";
					continue;
					
				}
			
				if( ( i == 0 && wx.activeTypeDialog == null ) || ( wx.tabSyncData.tabs.length < 2 ) )
					checked = " checked='checked'";
					
				else {
				
					checked 		= 0;
					tabDropdown 	= "<select id='wxTabLayoutType'><option value=''>sub-tab (default)</option><option value='list'>list</option><option value='map' class='wx-map-select'>map</option></select>";
					
				}

				if( undefined == featureData.labels )
					label	= wx.tabTypes[ serviceTypes[i] ].label;
				else
					label	= featureData.labels[ serviceTypes[i] ];
			
				extraClass	= '';	
				disabled 	= '';
					
				checkboxOptions += "<div class='wx-add-source-check-container" + extraClass + "'>" +
				
						"<input type='radio' class='wx-add-source-check' id='wx-add-source-check-" +
						 	serviceTypes[i] + "' value='" + serviceTypes[i] + 
						 		"' " + checked + disabled + " name='wxRadioType' />" +
						
						"<label for='wx-add-source-check-" +  serviceTypes[i] + "'>" + label.active + "</label>" +
						
					 	tabDropdown +
					 	
				 	"</div>";
			
			}
			
		}
		
		jQuery(dialogId).append( checkboxOptions );
		jQuery('#wx-geotag-new-item').remove();
		jQuery(dialogId).append( "<button id='wx-geotag-new-item' style='display:none;' class='blue button wmx-geocoder-launch wx-geotag-new-item'>+ Add Map Markers</button>" );
		jQuery('#wx-geotag-new-item').click( wmx.openWindow );
		
	}
	
	jQuery(dialogId).dialog({
		
		modal: 		true, 
		resizable: 	false,
		width: 		'auto',
		height: 	'auto',
		title:		titlebarHtml,
		show:		'fade',
		hide:		'drop',
		buttons: 	wx.setButtonActions({
			
			buttonName:		buttonName,
			dialogId:		dialogId,
			backAction:		backAction,
			action:			action, 
			actionArg:		{
			
				previousDialog: 	dialogId,
				featureData:		featureData
				
			}
			
		}),
		open:		function(e, ui) {
		
			var actionButton 	= 'div.ui-dialog-buttonset button#wxui-action',
				allButtons		= 'div.ui-dialog-buttonset button'
			
			jQuery(actionButton).attr('disabled', 'disabled');
			jQuery(allButtons).removeClass('blue');
			jQuery(allButtons).addClass('white');

			/* click outside dialog to close */
			jQuery('.ui-widget-overlay').bind('click', function() { 
			
				jQuery(dialogId).dialog('destroy');
				
			});
			
			jQuery( 'input:first-child', jQuery(this) ).blur();
			
			if( jQuery('select#wxSelectOldTab, select#wxTabLayoutType').find("option:selected").hasClass("wx-map-select") )
				jQuery("#wx-geotag-new-item").css('display', 'block');
			
			jQuery('select#wxSelectOldTab, select#wxTabLayoutType').change(function() {

				if( jQuery(this).find("option:selected").hasClass("wx-map-select") )
					jQuery("#wx-geotag-new-item").css('display', 'block');
					
				else 
					jQuery("#wx-geotag-new-item").css('display', 'none');
			
			});

		}
			
	}); 		
	

}

/* helper for finding if something is a function */

function isFunction(functionToCheck) {

 	var getType = {};
 	
	return functionToCheck && getType.toString.call(functionToCheck) == '[object Function]';
	
}
