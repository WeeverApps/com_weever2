<?php
/*	
*	Weever appBuilder™ for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 2
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


	<div class=" wx-theme-float-line-2" style="clear:both;">

			<fieldset id="wx-images-fieldset">
			
			<legend><?php echo JText::_('WEEVER_DESIGN_LAUNCHSCREEN'); ?></legend>
						
			
			<div class="wx-theme-screen">
			
				
	
				<div class="wx-theme-caption"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN'); ?></div>
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_PHONE_LAUNCHSCREEN_DESCRIPTION'); ?></div>
				
				<div class="wx-image-size-warning" id="wx-image-size-phone"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
				        <div id="wx-phone-upload"></div>
				<div class="wx-theme-image-container wx-theme-image-container-phone"><a href='<?php echo $this->design->launchscreen->phone; ?>' class='popup' id="wx-theme-phone-load-link" rel='{handler: "iframe", size:  { y: 460, x: 320}}'>
				<img class="wx-theme-image" id="wx-theme-phone-load" src="<?php echo $this->design->launchscreen->phone; ?>" />
				</a></div>

			</div>
			
			
			<div class="wx-theme-screen <?php echo $noTablet ? 'wx-theme-disable' : ''; ?>">

				<?php echo $noTablet ? "<div class='wx-tablet-warning'>".JText::_('WEEVER_TABLET_DISABLED').'</div>' : '<div class="wx-theme-caption">'.JText::_('WEEVER_TABLET_LAUNCHSCREEN').'</div>'; ?>
				
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_TABLET_LAUNCHSCREEN_DESCRIPTION'); ?></div>
				
				
				<div class="wx-image-size-warning" id="wx-image-size-tablet"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
		                <div id="wx-tablet-upload"></div>
		                
				<div class="wx-theme-image-container wx-theme-image-container-tablet"><a href='<?php echo $this->design->launchscreen->tablet; ?>' class='popup' id="wx-theme-tablet-load-link" rel='{handler: "iframe", size:  { y: 512, x: 374}}'>
				<img class="wx-theme-image" id="wx-theme-tablet-load" src="<?php echo $this->design->launchscreen->tablet; ?>" />
				</a></div>

			
			</div>
			
			
			<div class="wx-theme-screen <?php echo $noTablet ? 'wx-theme-disable' : ''; ?>">

				
				<?php echo $noTablet ? "<div class='wx-tablet-warning'>".JText::_('WEEVER_TABLET_DISABLED').'</div>' : '<div class="wx-theme-caption">'.JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN').'</div>'; ?>
				
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_TABLET_LANDSCAPE_LAUNCHSCREEN_DESCRIPTION'); ?></span><span class="wx-theme-description"></div>
				
				<div class="wx-image-size-warning" id="wx-image-size-tablet-landscape"><?php echo JText::_('WEEVER_IMAGE_SIZE_WARNING'); ?></div>
				
		                <div id="wx-tablet-landscape-upload"></div>
		                
				<div class="wx-theme-image-container wx-theme-image-container-tablet-landscape"><a href='<?php echo $this->design->launchscreen->tablet_landscape; ?>' class='popup' id="wx-theme-tablet-landscape-load-link" rel='{handler: "iframe", size: { y: 512, x: 374}}'>
				<img class="wx-theme-image" id="wx-theme-tablet-landscape-load" src="<?php echo $this->design->launchscreen->tablet_landscape; ?>" />
				</a></div>

			
			</div>
			
			</fieldset>
	

	
	</div>
