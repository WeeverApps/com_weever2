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


<div>

	<fieldset class='adminForm'>
	<legend><?php echo JText::_('WEEVER_LAUNCHSCREEN_SETTINGS'); ?></legend>
	
	<table class="admintable">
	
	<tr>
	<td class="key hasTip" title="<?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION'); ?></td>
	<td>
	<select name="animation" class="wx-220-select">
	<option value="fade" <?php echo ($this->design->animation->launch->type == 'fade' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_FADE'); ?></option>
	<option value="pop" <?php echo ($this->design->animation->launch->type == 'pop' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_POP'); ?></option>
	<option value="slide-left" <?php echo ($this->design->animation->launch->type == 'slide-left' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_RIGHT'); ?></option>
	<option value="slide-right" <?php echo ($this->design->animation->launch->type == 'slide-right' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_LEFT'); ?></option>
	<option value="slide-up" <?php echo ($this->design->animation->launch->type == 'slide-up' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_DOWN'); ?></option>
	<option value="slide-down" <?php echo ($this->design->animation->launch->type == 'slide-down' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_SLIDE_UP'); ?></option>
	<option value="none" <?php echo ($this->design->animation->launch->type == 'none' ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_NONE'); ?></option>
	</select>
	</td>
	</tr>

	
	<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT'); ?></td>
	<td>
	<select name="timeout" class="wx-220-select">
	<option value="1"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_NONE'); ?></option>
	<option value="325" <?php echo ($this->design->animation->launch->timeout == 325 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_SHORTER'); ?></option>
	<option value="650" <?php echo ($this->design->animation->launch->timeout == 650 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_NORMAL'); ?></option>
	<option value="995" <?php echo ($this->design->animation->launch->timeout == 995 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_TIMEOUT_LONGER'); ?></option>
	</select>
	</td>
	</tr>
	
	
	
	<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION'); ?></td>
	<td>
	<select name="duration" class="wx-220-select">
	<option value="350"><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_VERY_SHORT'); ?></option>
	<option value="850" <?php echo ($this->design->animation->launch->duration == 850 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_SHORTER'); ?></option>
	<option value="1350" <?php echo ($this->design->animation->launch->duration == 1350 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_NORMAL'); ?></option>
	<option value="1650" <?php echo ($this->design->animation->launch->duration == 1650 ? "selected='selected'":""); ?>><?php echo JText::_('WEEVER_LAUNCH_ANIMATION_DURATION_LONGER'); ?></option>
	</select>
	</td>
	</tr>		
	
	<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_IOS_INSTALL_PROMPT_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_IOS_INSTALL_PROMPT'); ?></td>
	<td>
	<select name="install_prompt">
	<option value="0"><?php echo JText::_('NO'); ?></option>
	<option value="1" <?php echo ($this->design->install->prompt ? "selected='selected'":""); ?>><?php echo JText::_('YES'); ?></option>
	</select>
	</td>
	</tr>
	
	
	</table>
	
	
	</fieldset>


</div>