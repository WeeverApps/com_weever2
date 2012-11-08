<?php
/*	
*	Weever Apps Administrator Component for Joomla
*	(c) 2010-2012 Weever Apps Inc. <http://www.weeverapps.com/>
*
*	Authors: 	Robert Gerald Porter 	<rob@weeverapps.com>
*				Aaron Song 				<aaron@weeverapps.com>
*	Version: 	2.0 Beta 1
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
				
	
		<fieldset class='adminForm'><legend><?php echo JText::_('WEEVER_CSS_TEMPLATE_OVERRIDES'); ?></legend>
		
		<!--div style="margin-left:1em;"><input type="checkbox" class="wx-check" value="1" id="wx-template-overrides" name="useCssOverride" <?php echo ($this->design->css->useCssOverride == '1' ? "checked='checked'":""); ?> /><label for="wx-template-overrides" class="wx-check-label"><?php echo JText::_('WEEVER_USE_CSS_TEMPLATE_OVERRIDES'); ?></label></div>
		<p><?php echo JText::_('WEEVER_USE_CSS_TEMPLATE_OVERRIDES_DESCRIPTION'); ?></p-->
		<table class="admintable">
			

		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_CSS_OVERRIDES_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CSS_OVERRIDES'); ?></td>
		<td>
		<textarea name="css" id="wx-css-overrides"><?php echo $this->design->css->styles; ?></textarea>
		</td>
		</tr>
		
		
		<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_CSS_URL_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CSS_URL'); ?></td>
		<td>
		<input type="text" placeholder="http://" name="css_url" id="wx-css-url" value="<?php echo $this->design->css->url; ?>" />
		</td>
		</tr>	
	
		</table>
		
		</fieldset>
		
		<fieldset class='adminForm wx-theme-fieldset'><legend><?php echo JText::_('WEEVER_WHITE_LABELLING'); ?></legend>
		
			<div class="wx-theme-screen">
			
			
				<div class="wx-theme-caption"><?php echo JText::_('WEEVER_LOADING_SPINNER_TEXT'); ?></div>
				<div class="wx-theme-note"><?php echo JText::_('WEEVER_LOADING_SPINNER_TOOLTIP'); ?></div>
				
				<textarea type="textbox" name="loadspinner_text" id="wx-load-spinner" placeholder="<?php echo JText::_("WEEVER_LOADING_SPINNER_PLACEHOLDER"); ?>"><?php echo htmlspecialchars($this->design->loadspinner->text); ?></textarea>
			
			</div>
			
	
		</fieldset>
		
		<fieldset class='adminForm wx-theme-fieldset'>
			<legend><?php echo JText::_('WEEVER_DOMAIN_MAPPING'); ?></legend>
		
			<p><?php echo JText::_("WEEVER_DOMAIN_MAPPING_INSTRUCTIONS"); ?></p>
		
			<table class="admintable">
			
			<tr>
			<td class="key hasTip" title="<?php echo JText::_("WEEVER_DOMAIN_MAPPING_TOOLTIP"); ?>"><?php echo JText::_('WEEVER_DOMAIN_MAPPING'); ?></td>
			<td><input type="textbox" name="domain"  value="<?php echo isset($this->design->domain[0]->domain) ? $this->design->domain[0]->domain : ""; ?>" id="wx-domain-map-input" placeholder="app.yourdomain.com" /> </td>	
			</tr>		
			
			</table>
		
		</fieldset>
		
		
	<!--fieldset class='adminForm'>
	<legend><?php echo JText::_('WEEVER_TITLEBAR_CUSTOM_HTML'); ?></legend>
	
	<p><?php echo JText::_('WEEVER_TITLEBAR_CUSTOM_HTML_DESCRIPTION'); ?></p>
	<table class="admintable">
	
	<tr>
	<td class="key"><?php echo JText::_('WEEVER_TITLEBAR_CUSTOM_HTML_TEXTAREA_DESCRIPTION'); ?></td>
	<td><textarea name="titlebarHtml" rows="7" cols="50"><?php echo htmlspecialchars($this->design->titlebar->html); ?></textarea></td>	
	</tr>
	
	</table>
	
	
	</fieldset-->
	
</div>