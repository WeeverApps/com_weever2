<?php
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

defined('_JEXEC') or die;

?>

<div class=" wx-theme-float">

 	<fieldset class='adminForm wx-theme-fieldset'>
 	
 		<legend><?php echo JText::_('WEEVER_INSTALL_TEXT_AND_ICON'); ?></legend>

		<div class="wx-theme-note"><?php echo JText::_('WEEVER_ICON_HELP'); ?></div>
		
		<div class="wx-image-size-warning" id="wx-image-size-icon"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div> 
		
        <div id="wx-icon-upload"></div>

		<div class="wx-theme-image-container wx-theme-image-container-icon">
			<img class="wx-theme-icon-image" id="wx-theme-icon" src="<?php echo $this->design->install->icon; ?>" />
		</div>
		
		<div id="wx-install-text-container"><input type="text" name="title" maxlength="10" id="wx-install-text" value="<?php echo htmlentities($this->design->install->name, ENT_QUOTES, "UTF-8"); ?>" /></div>
		
		<div id="wx-install-text-save-reminder"><?php echo JText::_('WEEVER_INSTALL_TEXT_SAVE_REMINDER'); ?></div>
 					
 	
 	</fieldset>
 	

	<fieldset class='adminForm wx-theme-fieldset'>
	
		<legend><?php echo JText::_('WEEVER_DESIGN_TITLEBAR'); ?></legend>
	
			
			<div class="wx-theme-titlebar-logo-container">
			
				<div id="wx-theme-titlebar-logo-options">
				<div class="wx-theme-caption"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_IMAGE'); ?></div>
				
				<div class="wx-image-size-warning" id="wx-image-size-titlebar"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
				<?php if($this->design->titlebar->type == "html") : ?>
				
				<div class="wx-notice" id="wx-titlebar-html-notice"><?php echo JText::_('WEEVER_TITLEBAR_HTML_NOTICE'); ?></div>
				
				<?php endif; ?>
				
				<div class="wx-theme-image-container wx-theme-image-container-titlebar"><a href='<?php echo $this->design->titlebar->image; ?>' id="wx-theme-titlebar-logo-link" class='popup' rel='{handler: "iframe", size:  { x: 600, y: 64}}'>
				<img class="wx-theme-titlebar-image " id="wx-theme-titlebar-logo" src="<?php echo $this->design->titlebar->image; ?>" />
				</a></div>
				
				<div id="wx-titlebar-upload"></div>
				
				
				<div class="wx-theme-note wx-theme-note-titlebar"><?php echo JText::_('WEEVER_TITLEBAR_LOGO_DESCRIPTION'); ?></div>
		                
				
				<div class="wx-theme-note wx-theme-note-titlebar-2"><?php echo JText::_('WEEVER_TITLEBAR_TEXT_HELP'); ?></div>
				</div>
				
				
				<div class="wx-theme-caption" id="wx-theme-caption-titlebar-text" style="margin-top:1em;"><input id="wx-enable-titlebar-text" type="checkbox" value="1" name="titlebar_title_enabled" <?php echo ($this->design->titlebar->type == 'text' ? "checked='checked'":""); ?> /> <?php echo JText::_('WEEVER_TITLEBAR_LOGO_TEXT'); ?></div>
				
				<div class="wx-theme-note wx-theme-note-titlebar" id="wx-theme-note-titlebar-text"><?php echo JText::_('WEEVER_TITLEBAR_TEXT_DESCRIPTION'); ?></div>
				
				<div class="wx-titlebar-text-container"><input type="text" id="wx-titlebar-text" name="titlebar_title" value="<?php echo htmlentities($this->design->titlebar->text, ENT_QUOTES, "UTF-8"); ?>" /></div>
				
				<div id="wx-titlebar-text-save-reminder"><?php echo JText::_('WEEVER_TITLEBAR_TEXT_SAVE_REMINDER'); ?></div>
				
			</div>
			
			
			<?php if($this->design->titlebar->type == 'text') : ?>
			
				<script>
					
					jQuery(document).ready(function(){ 
					
					
					jQuery("#wx-theme-titlebar-logo-options").hide();
					jQuery("#wx-theme-titlebar-logo-preview").hide();
					jQuery("#wx-theme-note-titlebar-text").show();
					jQuery(".wx-titlebar-text-container").show();
					jQuery("#wx-theme-titlebar-text-preview").show();
					
					
					});
				
				</script>
	
			<?php endif; ?>
						
 	</fieldset>
 	
</div>