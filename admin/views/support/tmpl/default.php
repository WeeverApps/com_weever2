<?php
/*	
*	Weever appBuilder™ for Joomla
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

if( comWeeverHelper::joomlaVersion() < 3.0 )
	JHTML::_('behavior.mootools');
	
else 
	JHtmlBehavior::framework();

if(comWeeverHelper::joomlaVersion() != '1.5')  // ### non-1.5 only
	$jsJoomla = "Joomla.";
else 
	$jsJoomla = "";

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

<?php if(@$this->account->tier_number == 1) : ?>
	<div class="wx-promotion-basic<?php echo $dashWebKit; ?>">
	<span class="wx-promotion-basic-title"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION'); ?></span>
	<span class="wx-promotion-basic-link"><?php echo JText::_('WEEVER_PREMIUM_PROMOTION_LEARN_MORE'); ?></span></div>

<?php elseif(@$this->account->tier_number == 2.1) : ?>
	<span class="wx-promotion-trial<?php echo $dashWebKit; ?>"><a href="http://weeverapps.com/pricing" class="wx-promotion-trial-button" id="headerbutton"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BUTTON'); ?></a><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_CALL'); ?><br><span class="wx-promotion-trial-byline"><?php echo JText::_('WEEVER_PREMIUM_UPGRADE_BYLINE'); ?></span></span>
	
<?php endif; ?>
	

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

<?php 

echo "<div class='wx-full-container'>";

if( isset($this->sidebar) )
{

	echo "<div class='wx-j3-sidebar'>";
	
	echo $this->sidebar;
	
	echo "</div>";

}

?>

<div class="supportlist">

<div>
	<fieldset class='adminForm'>
	
		<legend>Coming soon!</legend>
		
		

        
</fieldset>
    
    
    
</div>
</div>

</div>
