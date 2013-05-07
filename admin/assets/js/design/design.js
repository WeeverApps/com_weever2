/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 3
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
	var weever = weever || {};
	
	weever.checkTabletImg = function(src) {
	
		var tabletImg = new Image();
		
		tabletImg.onload = function() {
			if(tabletImg.width != 1536 || tabletImg.height != 2008) {
				jQuery("#wx-image-size-tablet").show();
			}
		}
		
		tabletImg.src = src || "<?php echo $this->theme->launchscreens->tablet; ?>";
	
	}
	
	weever.checkTabletLandscapeImg = function(src) {
	
		var tabletLandscapeImg = new Image();
	
		tabletLandscapeImg.onload = function() {
			if(tabletLandscapeImg.width != 1496 || tabletLandscapeImg.height != 2048) {
				jQuery("#wx-image-size-tablet-landscape").show();
			}
		}
		
		tabletLandscapeImg.src = src || "<?php echo $this->theme->launchscreens->tablet_landscape; ?>";
	
	}
	
	weever.checkPhoneImg = function(src) {
	
		var phoneImg = new Image();
	
		phoneImg.onload = function() {
			if(phoneImg.width != 640 || phoneImg.height != 920) {
				jQuery("#wx-image-size-phone").show();
			}
		}
		
		phoneImg.src = src || "<?php echo $this->theme->launchscreens->phone; ?>";
	
	}		
	
	
	weever.checkIconImg = function(src) {
	
		var iconImg = new Image();
	
		iconImg.onload = function() {
			if(iconImg.width != 144 || iconImg.height != 144) {
				jQuery("#wx-image-size-icon").show();
			}
		}
		
		iconImg.src = src || "<?php echo $this->theme->install->icon; ?>";
	
	}	
	
	weever.checkTitlebarImg = function(src) {
	
		var titlebarImg = new Image();
	
		titlebarImg.onload = function() {
			if(titlebarImg.width != 600 || titlebarImg.height != 64) {
				jQuery("#wx-image-size-titlebar").show();
			}
		}
		
		titlebarImg.src = src || "<?php echo $this->theme->titlebar_logo; ?>";
						
	
	}
	
	weever.checkTabletImg();
	weever.checkTabletLandscapeImg();
	weever.checkPhoneImg();
	weever.checkIconImg();
	weever.checkTitlebarImg();
	
	function themeUploadTemplate(text) {
	return '<div class="qq-uploader">' + 
		'<div class="qq-upload-drop-area '+text.dropClass+'"><span>'+text.dropUpload+'</span></div>' +
	    '<div class="qq-upload-button"><img src="components/com_weever/assets/icons/upload.png" class="qq-upload-icon" />'+text.uploadButton+'</div>' +
	    '<ul class="qq-upload-list"></ul>' + 
	 	'</div>';
	};
	
	function themeUploadIconTemplate(text) {
	return '<div class="qq-uploader">' + 
		'<div class="qq-upload-drop-area '+text.dropClass+'"><span>'+text.dropUpload+'</span></div>' +
	    '<div class="qq-upload-button qq-upload-icon-button"><img src="components/com_weever/assets/icons/upload.png" class="qq-upload-icon" />'+text.uploadButton+'</div>' +
	    '<ul class="qq-upload-list"></ul>' + 
	 	'</div>';
	};
	
	function fileUploadTemplate() {
	return '<li id="wx-upload-info">' +
	    '<div class="qq-upload-file"></div>' +
	    '<div class="qq-upload-spinner"></div>' +
	    '<div class="qq-upload-size"></div>' +
	    '<button class="qq-upload-cancel"><a href="#">' + Joomla.JText._('WEEVER_UPLOAD_CANCEL') + '</a></button>' +
	    '<div class="qq-upload-failed-text">' + Joomla.JText._('WEEVER_UPLOAD_FAILED') + '</div>' +
	'</li>';
	}; 
	
	function createUploader() {            
	var tabletUploader = new qq.FileUploader({
	    element: document.getElementById('wx-tablet-upload'),
	    action: 'index.php?option=com_weever&task=upload&type=tablet_load&site_key=' + jQuery("input#wx-site-key").val(),
	    template: themeUploadTemplate({
	    	uploadButton: Joomla.JText._('WEEVER_UPLOAD_NEW'),
	    	dropUpload: Joomla.JText._('WEEVER_DROP_TABLET'),
	    	dropClass: 'qq-upload-drop-tablet'
	    }),
	    fileTemplate: fileUploadTemplate(),
	    debug: true,
	    callback: function(url) {
	    	jQuery("#wx-theme-tablet-load").attr("src", url);
	    	jQuery("#wx-theme-tablet-load-link").attr("href", url);
	    	jQuery("#wx-upload-info").remove();
	    	jQuery("#wx-image-size-tablet").hide();
	    	weever.checkTabletImg(url);
	    }
	});   
	var tabletLandscapeUploader = new qq.FileUploader({
	    element: document.getElementById('wx-tablet-landscape-upload'),
	    action: 'index.php?option=com_weever&task=upload&type=tablet_landscape_load&site_key=' + jQuery("input#wx-site-key").val(),
	    template: themeUploadTemplate({
	    	uploadButton: Joomla.JText._('WEEVER_UPLOAD_NEW'),
	    	dropUpload: Joomla.JText._('WEEVER_DROP_TABLET_LANDSCAPE'),
	    	dropClass: 'qq-upload-drop-tablet-landscape'
	    }),
	    fileTemplate: fileUploadTemplate(),
	    debug: true,
	    callback: function(url) {
	    	jQuery("#wx-theme-tablet-landscape-load").attr("src", url);
	    	jQuery("#wx-theme-tablet-landscape-load-link").attr("href", url);
	    	jQuery("#wx-upload-info").remove();
	    	jQuery("#wx-image-size-tablet-landscape").hide();
	    	weever.checkTabletLandscapeImg(url);
	    }
	}); 
	var phoneUploader = new qq.FileUploader({
	    element: document.getElementById('wx-phone-upload'),
	    action: 'index.php?option=com_weever&task=upload&type=phone_load&site_key=' + jQuery("input#wx-site-key").val(),
	    template: themeUploadTemplate({
	    	uploadButton: Joomla.JText._('WEEVER_UPLOAD_NEW'),
	    	dropUpload: Joomla.JText._('WEEVER_DROP_PHONE'),
	    	dropClass: 'qq-upload-drop-phone'
	    }),
	    fileTemplate: fileUploadTemplate(),
	    debug: true,
	    callback: function(url) {
	    	jQuery("#wx-theme-phone-load").attr("src", url);
	    	jQuery("#wx-theme-phone-load-link").attr("href", url);
	    	jQuery("#wx-upload-info").remove();
	    	jQuery("#wx-image-size-phone").hide();
	    	weever.checkPhoneImg(url);
	    }
	});         
	var iconUploader = new qq.FileUploader({
	    element: document.getElementById('wx-icon-upload'),
	    action: 'index.php?option=com_weever&task=upload&type=icon&site_key=' + jQuery("input#wx-site-key").val(),
	    template: themeUploadIconTemplate({
	    	uploadButton: Joomla.JText._('WEEVER_UPLOAD_ICON'),
	    	dropUpload: Joomla.JText._('WEEVER_DROP_ICON'),
	    	dropClass: 'qq-upload-drop-icon'
	    }),
	    fileTemplate: fileUploadTemplate(),
	    debug: true,
	    callback: function(url) {
	    	jQuery("#wx-theme-icon").attr("src", url);
	    	jQuery("#wx-theme-icon-link").attr("href", url);
	    	jQuery("#wx-upload-info").remove();
	    	jQuery("#wx-image-size-icon").hide();
	    	weever.checkIconImg(url);
	    }
	}); 
	var titlebarUploader = new qq.FileUploader({
	    element: document.getElementById('wx-titlebar-upload'),
	    action: 'index.php?option=com_weever&task=upload&type=titlebar_image&site_key=' + jQuery("input#wx-site-key").val(),
	    template: themeUploadTemplate({
	    	uploadButton: Joomla.JText._('WEEVER_UPLOAD_NEW'),
	    	dropUpload: Joomla.JText._('WEEVER_DROP_TITLEBAR'),
	    	dropClass: 'qq-upload-drop-titlebar'
	    }),
	    fileTemplate: fileUploadTemplate(),
	    debug: true,
	    callback: function(url) {
	    	jQuery("#wx-theme-titlebar-logo").attr("src", url);
	    	jQuery("#wx-theme-titlebar-logo-preview").attr("src", url);
	    	jQuery("#wx-theme-titlebar-logo-link").attr("href", url);
	    	jQuery("#wx-upload-info").remove();
	    	jQuery("#wx-image-size-titlebar").hide();
	    	weever.checkTitlebarImg(url);
	    }
	}); 
	}
	
	window.onload = createUploader;   