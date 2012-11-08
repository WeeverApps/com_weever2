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

$option = JRequest::getCmd('option');
JHTML::_('behavior.mootools');
JHTML::_('behavior.tooltip');

if( comWeeverHelper::isLegacyJoomla() )  // ### 1.5 only
{

	$jsJoomla 	= "";
	jimport('joomla.html.pane');
	$pane 		= &JPane::getInstance('tabs');
	
}
else
{
 
 	$jsJoomla 	= "Joomla.";
 	jimport( 'joomla.html.html.tabs' );
 	$pane		= null;
	
}

$plugin_html_enabled = "";
$plugin_html_disabled = "";
	
$onlineSpan = "";
$offlineSpan = "";

if($this->appEnabled)
{
	$offlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "";
}
else 
{
	$onlineSpan = 'class="wx-app-hide-status"';
	$offlineStatusClass = "class=\"wx-app-status-button-offline\"";
}

if(comWeeverHelper::isWebKit())
	$dashWebKit = "-webkit";
else 
	$dashWebKit = "";

?>

<span id="wx-admin-topbar-left" class="wx-admin-topbar">
			<a href="http://weeverapps.com/pricing"><?php echo JText::_('WEEVER_PLANS_AND_PRICING'); ?></a> &nbsp; | &nbsp; <a href="http://twitter.com/weeverapps"><?php echo JText::_('WEEVER_FOLLOW_TWITTER'); ?></a> &nbsp;</a>

</span>
    

<div id="wx-admin-topbar-right" class="wx-admin-topbar">

<span <?php echo $offlineStatusClass; ?> id="wx-app-status-button">
    
  <span <?php echo $onlineSpan; ?> id="wx-app-status-online">
	<span id="wx-status-current"><?php echo JText::_('WEEVER_APP_STATUS'); ?></span>
    <span id="wx-status-boldonline"><strong><?php echo JText::_('WEEVER_ONLINE'); ?></strong></span>
    <span id="wx-status-current"><?php echo JText::_('WEEVER_FOR_MOBILE_VISITORS'); ?></span>
	<span id="wx-status-takeoffline"><?php echo JText::_('WEEVER_TAKE_OFFLINE'); ?></span>
  </span>
    
  <span <?php echo $offlineSpan; ?> id="wx-app-status-offline">
    <span id="wx-status-current"><?php echo JText::_('WEEVER_APP_STATUS'); ?></span>
    <span id="wx-status-boldoffline"><strong><?php echo JText::_('WEEVER_OFFLINE'); ?></strong></span>
    <span id="wx-status-current"><?php echo JText::_('WEEVER_FOR_MOBILE_VISITORS'); ?></span>
	<span id="wx-status-turnonline"><?php echo JText::_('WEEVER_TURN_APP_ONLINE'); ?></span>
  </span>

</span>
</div>




<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>


<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>
	

	<?php echo comWeeverHelper::startJHtmlPane( 'config', $pane ); ?>
	<?php echo comWeeverHelper::startJHtmlTabPanel( JText::_("WEEVER_BASIC_SETTINGS"), 'basic-settings', $pane ); ?>
	
	<div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wxui-btn orange medium radius3">&#x2713; &nbsp;<?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
	</div>   
	
	
	<div>
	
	
	
		<fieldset class='adminForm'><legend><?php echo JText::_('WEEVER_CONFIG_SIMPLE_DEVICE_SETTINGS'); ?></legend>
				
			<table class="admintable">
			
			<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_ENABLE_SMARTPHONES_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CONFIG_ENABLE_SMARTPHONES_Q'); ?></td>
			<td>
			<select name="DetectTierWeeverSmartphones">
			<option value="0"><?php echo JText::_('NO'); ?></option>
			<option value="1" <?php echo $this->DetectTierWeeverSmartphones; ?>><?php echo JText::_('YES'); ?></option>
			</select>
			</td>
			</tr>
			
			<tr><td class="key hasTip" title="<?php echo JText::_('WEEVER_ENABLE_TABLETS_TOOLTIP'); ?>"><?php echo JText::_('WEEVER_CONFIG_ENABLE_TABLETS_AND_IPADS_Q'); ?></td>
			<td>
			<select name="DetectTierWeeverTablets">
			<option value="0"><?php echo JText::_('NO'); ?></option>
			<option value="1" <?php echo $this->DetectTierWeeverTablets; ?>><?php echo JText::_('YES'); ?></option>
			</select>
			</td>
			</tr>
			
			</table>
		
		</fieldset>
	

		<fieldset class='adminForm'>
		
			<legend><?php echo JText::_('WEEVER_CONFIG_ADDITIONAL_SERVICES'); ?></legend>
		
			<table class="admintable">
			
			<tr>
			<td class="key hasTip" title="<?php echo JText::_("WEEVER_LOCALIZATION_TOOLTIP"); ?>"><?php echo JText::_('WEEVER_LOCALIZATION_SETTING'); ?></td>
			<td>
			
				<select name="local" id="wx-local-select">
				
				<?php foreach( (object) $this->locales as $k=>$v) : ?>
				
					<option value="<?php echo $k; ?>"<?php echo ( ($this->local == $k) ? " selected='selected'" : ""); ?>>
						<?php echo $v; ?>
					</option>
					
				<?php endforeach; ?>
				
				</select>
			
			</td>	
			</tr>
			
			<tr>
			<td class="key hasTip" title="<?php echo JText::_("WEEVER_GOOGLE_ANALYTICS_TOOLTIP"); ?>"><?php echo JText::_('WEEVER_GOOGLE_ANALYTICS_UA_CODE'); ?></td>
			<td><input type="textbox" name="google_analytics" value="<?php echo $this->google_analytics; ?>" id="wx-google-analytics-input" placeholder="UA-XXXXXX-XX" /></td>	
			</tr>
			
			<tr>
			<td class="key hasTip" title="<?php echo JText::_("WEEVER_ECOSYSTEM_TOOLTIP"); ?>"><?php echo JText::_('WEEVER_ECOSYSTEM'); ?></td>
			<td><input type="checkbox" name="ecosystem" value="1" <?php echo ($this->ecosystem == 1 ? "checked='checked'":""); ?> /> <label for="checkEcosystem"><?php echo JText::_('WEEVER_ECOSYSTEM_ENABLE'); ?></label></td>	
			</tr>
			</table>
			
			
			<p><b><?php echo ( comWeeverHelper::componentExists('com_weeverlogin') ) ? "<a href='index.php?option=com_weeverlogin'>".JText::_("WEEVER_LOGIN_SETTINGS")."</a>" : "<a href='http://weeverapps.com/downloads/' target='_blank'>".JText::_('WEEVER_LOGIN_DOWNLOAD')."</a>"; ?></b></p>
			
			
		</fieldset>


	</div>
	
	<?php echo comWeeverHelper::endJHtmlTabPanel( $pane ); ?>
	<?php echo comWeeverHelper::startJHtmlTabPanel( JText::_("WEEVER_ADVANCED_DEVICE_SETTINGS_TAB"), 'advanced-settings', $pane ); ?>
			
			<div class="wx-submitcontainer">
			        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wxui-btn orange medium radius3">&#x2713; &nbsp;<?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
			</div>   
			
		<div>
	
		<fieldset class='adminForm'><legend><?php echo JText::_('WEEVER_CONFIG_ADVANCED_DEVICE_SETTINGS'); ?></legend>
		
		<div style="margin-left:1em;"><input type="checkbox" value="1" class="wx-check" name="granular_devices" id="wx-granular-devices" <?php echo $this->granular; ?> /><label class="wx-check-label" for="wx-granular-devices"><?php echo JText::_('WEEVER_CONFIG_USE_ADVANCED_DEVICE_SETTINGS'); ?></label></div>
		
		<table class="admintable">
		
		<tr><th>&nbsp;</th>
		<th><?php echo JText::_('WEEVER_CONFIG_FORWARING'); ?></th>
		</tr>
		

		
		<tr><td class="key"><?php echo JText::_('WEEVER_CONFIG_APPLE_IPOD_IPHONE'); ?></td>
		<td>
		<select name="DetectIphoneOrIpod">
		<option value="0"><?php echo JText::_('WEEVER_CONFIG_DISABLED'); ?></option>
		<option value="1" <?php echo $this->DetectIphoneOrIpod; ?>><?php echo JText::_('WEEVER_CONFIG_ENABLED'); ?></option>
		</select>
		</td>
		</tr>
		
		<tr><td class="key"><?php echo JText::_('WEEVER_CONFIG_GOOGLE_ANDROID'); ?></td>
		<td>
		<select name="DetectAndroid">
		<option value="0"><?php echo JText::_('WEEVER_CONFIG_DISABLED'); ?></option>
		<option value="1" <?php echo $this->DetectAndroid; ?>><?php echo JText::_('WEEVER_CONFIG_ENABLED'); ?></option>
		</select>
		</td>
		</tr>
		
		<tr><td class="key"><?php echo JText::_('WEEVER_CONFIG_BLACKBERRY_SIX_TOUCH'); ?></td>
		<td>
		<select name="DetectBlackBerryTouch">
		<option value="0"><?php echo JText::_('WEEVER_CONFIG_DISABLED'); ?></option>
		<option value="1" <?php echo $this->DetectBlackBerryTouch; ?>><?php echo JText::_('WEEVER_CONFIG_ENABLED'); ?></option>
		</select>
		</td>
		</tr>
		
		<tr><td class="key"><?php echo JText::_('WEEVER_CONFIG_BLACKBERRY_PLAYBOOK'); ?></td>
		<td>
		<select name="DetectBlackBerryTablet">
		<option value="0"><?php echo JText::_('WEEVER_CONFIG_DISABLED'); ?></option>
		<option value="1" <?php echo $this->DetectBlackBerryTablet; ?>><?php echo JText::_('WEEVER_CONFIG_ENABLED'); ?></option>
		</select>
		</td>
		</tr>
		
		
		<tr><td class="key"><?php echo JText::_('WEEVER_CONFIG_APPLE_IPAD'); ?></td>
		<td>
		<select name="DetectIpad">
		<option value="0"><?php echo JText::_('WEEVER_CONFIG_DISABLED'); ?></option>
		<option value="1" <?php echo $this->DetectIpad; ?>><?php echo JText::_('WEEVER_CONFIG_ENABLED'); ?></option>
		</select>
		</td>
		</tr>
		
		
		<tr><td class="key"><?php echo JText::_('WEEVER_CONFIG_GOOGLE_ANDROID_TABLETS'); ?></td>
		<td>
		<select name="DetectAndroidTablet">
		<option value="0"><?php echo JText::_('WEEVER_CONFIG_DISABLED'); ?></option>
		<option value="1" <?php echo $this->DetectAndroidTablet; ?>><?php echo JText::_('WEEVER_CONFIG_ENABLED'); ?></option>
		</select>
		</td>
		</tr>

		</table>
		
		</fieldset>
		</div>
		
	<?php echo comWeeverHelper::endJHtmlTabPanel( $pane ); ?>
	<?php echo comWeeverHelper::endJHtmlPane( $pane ); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="app_enabled" value="<?php echo $this->app_enabled; ?>" />
	<input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $this->site_key; ?>" />
	<input type="hidden" name="view" value="config" />
	<input type="hidden" name="legacyAPI" value="1" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>