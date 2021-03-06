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

jQuery(function() {

	jQuery('div#wx-list-workspace').css({ 'opacity': 1 });

	if( wxComK2 == false ) {
	
		jQuery('.wx-require-extension-com_k2').css({ 'opacity': 0.45  });
		jQuery('.wx-require-extension-com_k2').addClass('wx-missing-extension');
		
	}
		
	if( wxComEasyBlog == false ) {
	
		jQuery('.wx-require-extension-com_easyblog').css({ 'opacity': 0.45 });
		jQuery('.wx-require-extension-com_easyblog').addClass('wx-missing-extension');
		
	}

	jQuery("#listTabs").tabs({
		
		select: 	function(e, ui) {

			var t 		= String(ui.tab),
				tpos 	= strpos(t, '#');
				
			t 		= t.substring(tpos + 1);
			tpos 	= strpos(t, 'Tab');
			t 		= t.substring(0, tpos);
			
			jQuery( '.wx-title' ).attr('name','noname');
			jQuery( '#wx-' + t + '-title' ).attr('name', 'name');
			jQuery( '#wx-select-' + t ).val(0).change();
			jQuery( '.wx-title').attr('name','noname');
			jQuery( '.wx-reveal').hide();
			jQuery( '.wx-dummy').hide();
			jQuery( '.wx-' + t + '-dummy').show();
		
		}
	
	});

	jQuery("#listTabsSortable").sortable({ 
	
		axis: 		"x",
		cancel:		'.wx-nosort',
		update: 	function(event, info) {
							
			var str 	= String(jQuery(this).sortable('toArray')).replace('addTabID,', ''),
				siteKey = jQuery("input#wx-site-key").val();
				
			jQuery.ajax({
			
			   type: 		"POST",
			   url: 		"index.php",
			   data: 		"option=com_weever&task=ajaxSaveTabOrder&site_key=" + siteKey + 
			   					"&order=" + str,
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

});

/* Joomla specific vars */

wx.navIconDir 			= "components/com_weever/assets/icons/nav/";
wx.baseExtensionUrl 	= "index.php?option=com_weever";

/* Assembles the URL params */

wx.ajaxUrl			= function(a) {

	this.title					= "&title=" + encodeURIComponent( jQuery('#wx-add-title-tab-item').val() );
	this.content				= "&content=" +  encodeURIComponent( a.content );
	this.appKey					= "&site_key=" + jQuery("input#wx-site-key").val();
	this.config					= a.config;
	this.icon_id				= "&icon_id=" + a.icon_id;
	this.published				= "&published=" + a.published;
	this.layout					= "&layout=" + a.layout;
	this.tabLayout				= "&tabLayout=" + a.tabLayout;
	this.cms_feed				= "";
	this.geo					= "&geo=" + ( encodeURIComponent(JSON.stringify(a.geo)) ) || null;
	this.type 					= a.type;
	this.parent_id				= "";
	this.component_behaviour	= "";
		
	this.getParams		= function() {
	
		if( this.cms_feed && this.cms_feed.search("http") == -1 ) {
		
			this.cms_feed = JURI_base + this.cms_feed;
		
		}
			
		/* if we're adding this under an existing tab */
		if( this.type == "oldtabs" ) {
		
			this.parent_id 	= "&parent_id=" + jQuery('#wxSelectOldTab').val();
			this.tabLayout	= "&tabLayout=";
		
		}

		for( var key in this.config ) {

			if( this.config[key][0] == ":" ) {
			
				var value = this.config[key].replace(":","");
			
				this.config[key] = this[ value ]; // if ":cms_feed", will grab this.cms_feed
				
				continue;
			
			}

		}

		if(this.config) 
			this.config					= "&config=" + encodeURIComponent( JSON.stringify(this.config) );
		else 
			this.config					= "";
	
		var url = "option=com_weever&task=ajaxSaveNewTab" + this.title + 
						this.content + this.config + "&weever_action=add" +
					 	this.appKey + this.published + this.layout + this.tabLayout + this.icon_id + this.parent_id + this.geo;		
		
		return url;

	}
	
}

/* Change Tab Name */

wx.navLabelDialog	= function(e) {

	var tabId 		= jQuery(this).attr('title').replace("ID #", ""),
		siteKey 	= jQuery( 'input#wx-site-key' ).val(),
		htmlName 	= jQuery( '#wx-nav-label-' + tabId ).html(),
		clickedElem	= jQuery( '#wx-nav-label-' + tabId ),
		txt 		= '<h3 class="wx-imp-h3">' + 
							Joomla.JText._('WEEVER_JS_ENTER_NEW_APP_ICON_NAME') + 
						'</h3>' +
						'<input type="text" id="alertName" name="alertName" value="' + 
							htmlName + 
						'" />',
		myCallbackForm 	= function(v,m,f) {
		
			if( false == v )
				return;
			
			var tabName 	= f["alertName"];
			
			jQuery.ajax({
			
			   type: 	"POST",
			   url: 	"index.php",
			   data: 	"option=com_weever&task=ajaxSaveTabName&name=" + 
			   				encodeURIComponent( tabName ) + 
			   			"&id=" + tabId + '&site_key=' + siteKey,
			   success: function(msg) {
			   
				 jQuery('#wx-modal-loading-text').html(msg);
				 
				 if(msg == "Tab Changes Saved")
				 {
				 
				 	jQuery('#wx-modal-secondary-text').html( Joomla.JText._('WEEVER_JS_APP_UPDATED') );
				 	clickedElem.html( tabName );
				 	
				 }
				 else
				 {
				 
				 	jQuery('#wx-modal-secondary-text').html('');
				 	jQuery('#wx-modal-error-text').html( Joomla.JText._('WEEVER_JS_SERVER_ERROR') );
				 	
				 }

			   }
			   
			});
		
		},
		submitCheck 	= function(v,m,f) {
			
			var an 	= m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
		
		},
		tabName 		= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
			
		});
			
	jQuery('input#alertName').select();
	
	/* hit 'enter/return' to save */
	
	jQuery("input#alertName").bind("keypress", function (e) {
	
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
		
			jQuery('button#jqi_state0_buttonSubmit').click();
			return false;
			
		} else {
		
			return true;
			
		}
			
	});
	
	e.preventDefault();

};

wx.iconBase64		= "";

wx.updateIconPreview = function(evt) {

	// nav-icons when creating a new tab
	var val = jQuery("select#wx-icons-dropdown-select").val() || jQuery("select#wx-nav-icons-dropdown-select").val();

	var xmlhttp 		= new XMLHttpRequest();
	
	xmlhttp.open("GET", Joomla.comWeeverConst.server + "api/v2/icons/get_icon_base64?icon_id=" + val );	
	xmlhttp.send();
	
	xmlhttp.onreadystatechange = function()	{
	
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
		
			jQuery("img.wx-nav-icon-preview").attr(
				"src", 
				"data:image/png;base64," + 
					xmlhttp.responseText
				);
			
			wx.iconBase64 = xmlhttp.responseText;
		
		}
		
	}


};

/* Change Tab Layout */

wx.navTabLayoutDialog	= function(e) {

	var xmlhttp 		= new XMLHttpRequest(),
		tabLayout		= jQuery(this).attr('ref');
		
		console.log( tabLayout );

	// perhaps add in future -- server-determined layouts
	//xmlhttp.open("GET", Joomla.comWeeverConst.server + "api/v2/icons/get_icons");	
	//xmlhttp.send();
	
	//jQuery("select#wx-tablayout-dropdown-select").change(wx.updateIconPreview)
	//jQuery("select#wx-tablayout-dropdown-select").bind("keyup", wx.updateIconPreview);

	var tabType 		= jQuery(this).attr('title'),
		siteKey 		= jQuery("input#wx-site-key").val(),
		tabId			= jQuery(this).attr('title'),
		txt 			= '<h3 class="wx-imp-h3">' + 
							'Tab Layout' + 
						'</h3>'+
						'<p>Choose how content added to this tab is displayed.</p>'+
						'<div id="wx-tablayout-dropdown"><select id="wx-tablayout-dropdown-select" name="tablayout">'+
						'<option value="">Sub-tabs (default)</option>'+
						'<option value="list">List</option>'+
						'<option value="map">Map</option>'+
						'</select></div>',		
		myCallbackForm 	= function(v,m,f) {

			if( false == v )
				return;

			var tabLayout = f.tablayout;
		//	var tabElem = jQuery( '#wx-nav-icon-' + tabId );

			jQuery.ajax({

			   type: 	"POST",
			   url: 	"index.php",
			   data: 	"option=com_weever&task=ajaxSaveTabLayout&tabLayout=" + 
			   				tabLayout + 
			   			"&tab_id=" + tabId,
			   success: function(msg) {

				   jQuery('#wx-modal-loading-text').html(msg);

				   if(msg == "Tab Changes Saved")
				   {

				   		jQuery('#wx-modal-secondary-text').html( Joomla.JText._('WEEVER_JS_APP_UPDATED') );

					}
					else
					{

						jQuery('#wx-modal-secondary-text').html('');
					 	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));

					}

			 	}

			});

		},	
		submitCheck 	= function(v,m,f) {

			return true;

		},		
		tabLayoutLaunch		= jQuery.prompt(txt, {

			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{ 'cancel': false, 'Save': true },
			focus: 			1

		});	

	e.preventDefault();

};

/* Change Tab Icon */

wx.navIconDialog	= function(e) {

	var xmlhttp 		= new XMLHttpRequest(),
		iconId			= jQuery(this).attr('ref');
	
	xmlhttp.open("GET", Joomla.comWeeverConst.server + "api/v2/icons/get_icons");	
	xmlhttp.send();
	
	xmlhttp.onreadystatechange = function()	{
	
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
		
			insert 			= document.getElementById("wx-icons-dropdown");
			json 			= jQuery.parseJSON( xmlhttp.responseText );
			icons 			= json.icons;
			dropdownHtml 	= "<select id='wx-icons-dropdown-select' name='nav_icon'>";
			
			for( var i = 0; i < icons.length; i++ ) {
			
				var selectedText = "";
			
				if( iconId == icons[i].id )
					selectedText = " selected='selected'";
			
				dropdownHtml += "<option value='"+ icons[i].id +"'"+ selectedText +">" + icons[i].name + "</option>";
			
			}			
			
			insert.innerHTML 	= dropdownHtml + "</select>";	
			
			wx.updateIconPreview();
			
			jQuery("select#wx-icons-dropdown-select").change(wx.updateIconPreview)
			jQuery("select#wx-icons-dropdown-select").bind("keyup", wx.updateIconPreview);
			
		
		}
		
	}
	
	var tabType 		= jQuery(this).attr('title'),
		siteKey 		= jQuery("input#wx-site-key").val(),
		tabId			= jQuery(this).attr('title'),
		txt 			= 	'<div class="jqimessage">'+
						'<h3 class="wx-imp-h3">' + 
							Joomla.JText._('WEEVER_JS_CHANGING_NAV_ICONS') + 
						'</h3>'+
						'<div class="wx-nav-icon-preview-wrapper">'+
							'<img class="wx-nav-icon-preview" src="">'+
							'<img id="wx-nav-icon-no-image" src="components/com_weever/assets/icons/no-image.png">'+
						'</div>'+
						'<div id="wx-icons-dropdown"></div><div></div></div>',		
		myCallbackForm 	= function(v,m,f) {
	
			if( false == v )
				return;
		
			var tabIcon = f.nav_icon;
			var tabElem = jQuery( '#wx-nav-icon-' + tabId );

			jQuery.ajax({
			
			   type: 	"POST",
			   url: 	"index.php",
			   data: 	"option=com_weever&task=ajaxSaveTabIcon&icon_id=" + 
			   				tabIcon + 
			   			"&tab_id=" + tabId,
			   success: function(msg) {
			   
				   jQuery('#wx-modal-loading-text').html(msg);
					 
				   if(msg == "Icon Saved")
				   {
					 
				   		jQuery('#wx-modal-secondary-text').html( Joomla.JText._('WEEVER_JS_APP_UPDATED') );
				   		
					 	tabElem.html(
					 	
					 		'<img class="wx-nav-icon-img" src="data:image/png;base64,' + wx.iconBase64 + '" />'
					 	
					 	);
					 	
					}
					else
					{
					 
						jQuery('#wx-modal-secondary-text').html('');
					 	jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
					 	
					}
				 
			 	}
			   
			});

		},	
		submitCheck 	= function(v,m,f) {
		
			
			return true;
	
		},		
		tabIcon 		= jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{ Cancel: false, Submit: true },
			focus: 			2
			
		});	
				
	e.preventDefault();
	
};

/* Tab Settings Dialogs */

wx.settingsDialog	= {

	aboutapp:		function(e) {
	
		e.preventDefault();
			
		var panelAnimate 			= jQuery("input#wx-aboutapp-animate").val(),
			panelHeaders 			= jQuery("input#wx-aboutapp-headers").val(),
			panelAnimateDuration 	= jQuery("input#wx-aboutapp-animate-duration").val(),
			timeout 				= jQuery("input#wx-aboutapp-timeout").val(),
			siteKey 				= jQuery("input#wx-site-key").val(),
			tabId 					= jQuery("input#wx-aboutapp-tab-id").val();
		
		if(panelAnimate == "fade") 
			var selected = 'selected="selected"';
		else
			var selected = null;	
		
		if(panelHeaders == "true") 
			var selectedHeader = 'selected="selected"';
		else 
			var selectedHeader = null;	
		
		switch(panelAnimateDuration) {
		
			case "1450": 
			
				var defaultDuration = 'selected="selected"';
				break;
				
			case "1925":
			
				var longDuration = 'selected="selected"';
				break;
				
			case "725":
			
				var shortDuration = 'selected="selected"';
				break;
				
			default:	
			
				var defaultDuration = 'selected="selected"';
				break;
				
		}	
		
		switch(timeout) {
		
			case "4500": 
			
				var shortTimeout = 'selected="selected"';
				break;
				
			case "7250":
			
				var defaultTimeout = 'selected="selected"';
				break;
				
			case "10000":
			
				var longTimeout = 'selected="selected"';
				break;
				
			default:	
			
				var defaultTimeout = 'selected="selected"';
				break;
				
		}	
		
		var txt = 	'<table class="admintable">'+
					'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_ANIMATIONS')+'</h3>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_TOGGLE')+'</td>'+
					'<td><select name="wx-input-aboutapp-animate"><option value="none">'+
					Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
					'<option value="fade" '+selected+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+'</option></select>'+
					'</td></tr>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION')+'</td>'+
					'<td><select name="wx-input-aboutapp-animate-duration"><option value="725" '+shortDuration+'>'+
					Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_SHORT')+'</option>'+
					'<option value="1450" '+defaultDuration+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_DEFAULT')+
					'</option>'+
					'<option value="1925" '+longDuration+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TRANSITION_DURATION_LONG')+
					'</option></select>'+
					'</td></tr>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT')+'</td>'+
					'<td><select name="wx-input-aboutapp-timeout"><option value="4500" '+shortTimeout+'>'+
					Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_SHORT')+'</option>'+
					'<option value="7250" '+defaultTimeout+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_DEFAULT')+
					'</option>'+
					'<option value="10000" '+longTimeout+'>'+Joomla.JText._('WEEVER_JS_ABOUTAPP_TIMEOUT_LONG')+
					'</option></select>'+
					'</td></tr>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_ABOUTAPP_HEADERS_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_ABOUTAPP_HEADERS')+'</td>'+
					'<td><select name="wx-input-aboutapp-headers"><option value="false">'+
					Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
					'<option value="true" '+selectedHeader+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+
					'</option></select>'+
					'</td></tr></table>';
	
		myCallbackForm = function(v,m,f) {
		
			if( false == v )
				return;
			
			var animate 		= encodeURIComponent(f["wx-input-aboutapp-animate"]),
				animateDuration = encodeURIComponent(f["wx-input-aboutapp-animate-duration"]),
				timeout 		= encodeURIComponent(f["wx-input-aboutapp-timeout"]),
				headers 		= encodeURIComponent(f["wx-input-aboutapp-headers"]);
			
			jQuery.ajax({
			
				type: 		"POST",
				url: 		"index.php",
				data: 		"option=com_weever&task=ajaxUpdateTabSettings&type=aboutapp&var=" + 
								animate + "," + animateDuration + "," + timeout + "," + headers +
									"&id=" + tabId + '&site_key=' + siteKey,
				success: function(msg) {
				
					jQuery('#wx-modal-loading-text').html(msg);
					
					if(msg == "Tab Settings Saved")
					{
					
						jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
						
						document.location.href = "index.php?option=com_weever#aboutappTab";
						document.location.reload(true);
						
					}
					else
					{
					
						jQuery('#wx-modal-secondary-text').html('');
						jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
						
						document.location.href = "index.php?option=com_weever#aboutappTab";
						document.location.reload(true);
						
					}
				
				}
			
			});	
			
		}
		
		submitCheck = function(v,m,f) {
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
		
		};	
		
		var aniSettings = jQuery.prompt(txt, {
		
			callback: 		myCallbackForm, 
			submit: 		submitCheck,
			overlayspeed: 	"fast",
			buttons: 		{  Cancel: false, Submit: true },
			focus: 			1
				
		});
				
		jQuery('input#alertName').select();
	
	},

	panel:	 	function(e) {
	
		e.preventDefault();
			
		var panelAnimate 			= jQuery("input#wx-panel-animate").val(),
			panelAnimateDuration 	= jQuery("input#wx-panel-animate-duration").val(),
			panelHeaders 			= jQuery("input#wx-panel-headers").val(),
			timeout 				= jQuery("input#wx-panel-timeout").val(),
			siteKey 				= jQuery("input#wx-site-key").val(),
			tabId 					= jQuery("input#wx-panel-tab-id").val();
		
		if(panelAnimate == "fade") 
			var selected = 'selected="selected"';
		else
			var selected = null;	
		
		if(panelHeaders == "true") 
			var selectedHeader = 'selected="selected"';
		else 
			var selectedHeader = null;	
		
		switch(panelAnimateDuration) {
		
			case "1450": 
			
				var defaultDuration = 'selected="selected"';
				break;
				
			case "1925":
			
				var longDuration = 'selected="selected"';
				break;
				
			case "725":
			
				var shortDuration = 'selected="selected"';
				break;
				
			default:	
			
				var defaultDuration = 'selected="selected"';
				break;
		}	
		
		switch(timeout) {
		
			case "4500":
			 
				var shortTimeout = 'selected="selected"';
				break;
				
			case "7250":
			
				var defaultTimeout = 'selected="selected"';
				break;
				
			case "10000":
			
				var longTimeout = 'selected="selected"';
				break;
				
			default:	
			
				var defaultTimeout = 'selected="selected"';
				break;
				
		}	
		
		var txt = 	'<table class="admintable">'+
					'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_ANIMATIONS')+'</h3>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_TOGGLE')+'</td>'+
					'<td><select name="wx-input-panel-animate"><option value="none">'+
					Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
					'<option value="fade" '+selected+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+'</option></select>'+
					'</td></tr>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION')+'</td>'+
					'<td><select name="wx-input-panel-animate-duration"><option value="725" '+shortDuration+'>'+
					Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_SHORT')+'</option>'+
					'<option value="1450" '+defaultDuration+'>'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_DEFAULT')+
					'</option>'+
					'<option value="1925" '+longDuration+'>'+Joomla.JText._('WEEVER_JS_PANEL_TRANSITION_DURATION_LONG')+
					'</option></select>'+
					'</td></tr>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT')+'</td>'+
					'<td><select name="wx-input-panel-timeout"><option value="4500" '+shortTimeout+'>'+
					Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_SHORT')+'</option>'+
					'<option value="7250" '+defaultTimeout+'>'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_DEFAULT')+
					'</option>'+
					'<option value="10000" '+longTimeout+'>'+Joomla.JText._('WEEVER_JS_PANEL_TIMEOUT_LONG')+
					'</option></select>'+
					'</td></tr>'+
					'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_PANEL_HEADERS_TOOLTIP')+
					'">'+Joomla.JText._('WEEVER_JS_PANEL_HEADERS')+'</td>'+
					'<td><select name="wx-input-panel-headers"><option value="false">'+
					Joomla.JText._('WEEVER_CONFIG_DISABLED')+'</option>'+
					'<option value="true" '+selectedHeader+'>'+Joomla.JText._('WEEVER_CONFIG_ENABLED')+
					'</option></select>'+
					'</td></tr></table>';
					
		myCallbackForm = function(v,m,f) {
		
			if( false == v )
				return;
	
			var animate 		= encodeURIComponent(f["wx-input-panel-animate"]),
				animateDuration = encodeURIComponent(f["wx-input-panel-animate-duration"]),
				timeout 		= encodeURIComponent(f["wx-input-panel-timeout"]),
				headers 		= encodeURIComponent(f["wx-input-panel-headers"]);
			
			jQuery.ajax({
			
				type: 		"POST",
				url: 		"index.php",
				data: 		"option=com_weever&task=ajaxUpdateTabSettings&type=panel&var=" + 
								animate + "," + animateDuration + "," + timeout + 
								"," + headers + "&id=" + tabId + '&site_key=' + siteKey,
				success: 	function(msg) {
				
					jQuery('#wx-modal-loading-text').html(msg);
					
					if(msg == "Tab Settings Saved")
					{
					
						jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
						document.location.href = "index.php?option=com_weever#panelTab";
						document.location.reload(true);
						
					}
					else
					{
					
						jQuery('#wx-modal-secondary-text').html('');
						jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
						
						document.location.href = "index.php?option=com_weever#panelTab";
						document.location.reload(true);
						
					}
				
				}
				
			});
			
		}	
		
		submitCheck = function(v,m,f){
			
			an = m.children('#alertName');
		
			if(f.alertName == "" && v == true) {
			
				an.css("border","solid #ff0000 1px");
				return false;
				
			}
			
			return true;
		
		}		
		
		var aniSettings = jQuery.prompt(txt, {
		
				callback: myCallbackForm, 
				submit: submitCheck,
				overlayspeed: "fast",
				buttons: {  Cancel: false, Submit: true },
				focus: 1
				
		});
				
		jQuery('input#alertName').select();
	
	},

	map: 	function(e, tabId) {
	
		e.preventDefault();

		var xmlhttp 		= new XMLHttpRequest(),
			xmlhttpCall		= Joomla.comWeeverConst.server + "api/v2/tabs/get_map_config?tab_id=" + tabId + "&app_key=" + jQuery("input#wx-site-key").val(),
			mapConfig,
			callback		= function( responseText ) {
			
				mapConfig = JSON.parse( responseText ).map_config || null;
				
				var txt = 	'<table class="admintable">'+
							'<h3 class="wx-imp-h3">'+Joomla.JText._('WEEVER_JS_MAP_SETTINGS')+'</h3>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_LATITUDE_TOOLTIP')+
							'">'+Joomla.JText._('WEEVER_JS_MAP_START_LATITUDE')+'</td>'+
							'<td><input type="text" name="wx-input-map-start-lat" value="'+( mapConfig.start_latitude || "" )+'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_LONGITUDE_TOOLTIP')+
							'">'+Joomla.JText._('WEEVER_JS_MAP_START_LONGITUDE')+'</td>'+
							'<td><input type="text" name="wx-input-map-start-long" value="'+( mapConfig.start_longitude || "" )+'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Force starting Zoom level (1-22)</td>'+
							'<td><input type="text" name="wx-input-map-start-zoom" value="'+( mapConfig.start_zoom|| "") +'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_DEFAULT_MARKER_TOOLTIP')+
							'">Fit all markers within initial map frame (1: on, 0: off)</td>'+
							'<td><input type="text" name="wx-input-map-start-zoom-enabled" value="'+(mapConfig.start_zoom_enabled || 0)+'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Maximum initial zoom (1-22)</td>'+
							'<td><input type="text" name="wx-input-map-max-zoom" value="'+(mapConfig.maxZoom || "")+'" />'+
							'</td></tr>'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Minimum initial zoom (1-22)</td>'+
							'<td><input type="text" name="wx-input-map-min-zoom" value="'+(mapConfig.minZoom || "")+'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Enable clustering of markers (1: on, 0: off)</td>'+
							'<td><input type="text" name="wx-input-map-cluster" value="'+(mapConfig.cluster || 0) +'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Automatically ping user\'s GPS (1: on, 0: off)</td>'+
							'<td><input type="text" name="wx-input-map-auto-gps" value="'+(mapConfig.autoGPS || 0)+'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Draw radius circle around user\'s GPS position (enter radius of circle in metres)</td>'+
							'<td><input type="text" name="wx-input-map-gps-radius" value="'+( mapConfig.gpsRadius || 0 )+'" />'+
							'</td></tr>'+
							'<tr><td class="key hasTip" title="'+Joomla.JText._('WEEVER_JS_MAP_START_ZOOM_TOOLTIP')+
							'">Colour of radius circle (hex colours only)</td>'+
							'<td><input type="text" name="wx-input-map-gps-radius-colour" value="'+(mapConfig.gpsRadius_colour || "")+'" />'+
							'</td></tr>'+
							'</table>';
							
				myCallbackForm = function(v,m,f) {
				
					if( false == v )
						return;
						
					console.log(f);
			
					var mapConfig = {
				
						start_latitude:		f["wx-input-map-start-lat"],
						start_longitude:	f["wx-input-map-start-long"],
						start_zoom:			f["wx-input-map-start-zoom"],
						start_zoom_enabled:	f["wx-input-map-start-zoom-enabled"],
						cluster:			f["wx-input-map-cluster"],
						maxZoom:			f["wx-input-map-max-zoom"],
						minZoom:			f["wx-input-map-min-zoom"],
						autoGPS:			f["wx-input-map-auto-gps"],
						gpsRadius:			f["wx-input-map-gps-radius"],
						gpsRadius_colour:	f["wx-input-map-gps-radius-colour"]
							
					};
					
					jQuery.ajax({
					
						type: 		"GET",
						url: 		Joomla.comWeeverConst.server + "api/v2/tabs/set_map_config",
						data: 		"tab_id=" + tabId + "&app_key=" + jQuery("input#wx-site-key").val() + "&map_config=" + encodeURIComponent( JSON.stringify( mapConfig ) ),
						success: 	function(msg) {
						
							jQuery('#wx-modal-loading-text').html(msg);

							//var response = JSON.parse( msg )
							
							if( msg.success ) {
							
								jQuery('#wx-modal-secondary-text').html(Joomla.JText._('WEEVER_JS_APP_UPDATED'));
								//document.location.href = "index.php?option=com_weever";
								//document.location.reload(true);
								
							} else {
							
								jQuery('#wx-modal-secondary-text').html('');
								jQuery('#wx-modal-error-text').html(Joomla.JText._('WEEVER_JS_SERVER_ERROR'));
								//document.location.href = "index.php?option=com_weever";
								//document.location.reload(true);
								
							}
						
						}
					   
					 });
			
				}	
				
				submitCheck = function(v,m,f){
					
					return true;
				
				}		
				
				var mapSettings = jQuery.prompt(txt, {
			
					callback: 		myCallbackForm, 
					submit: 		submitCheck,
					overlayspeed: 	"fast",
					width: 			500,
					buttons: 		{  Cancel: false, Submit: true },
					focus: 			1
			
				});
				
			
			};
		
		xmlhttp.open("GET", xmlhttpCall );	
		xmlhttp.send();
	
		xmlhttp.onreadystatechange = function()	{
		
			if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) 
				callback( xmlhttp.responseText );
			
		}

	}
	
};