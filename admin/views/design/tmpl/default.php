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

$plugin_html_enabled = "";
$plugin_html_disabled = "";
JHTML::_('behavior.mootools');
JHTML::_('behavior.modal', 'a.popup');
JHTML::_('behavior.tooltip');

$document = &JFactory::getDocument();
	
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/fileuploader.js' );
$document->addScript( JURI::base(true).'/components/com_weever/assets/js/design/design.js?v='.comWeeverConst::VERSION );

if(comWeeverHelper::joomlaVersion() != '1.5')  // ### non-1.5 only
{
	$jsJoomla = "Joomla.";
	jimport( 'joomla.html.html.tabs' );
	$pane = null;
}
else 
{
	$jsJoomla = "";
	jimport('joomla.html.pane');
	$pane = &JPane::getInstance('tabs');
}

$onlineSpan = "";
$offlineSpan = "";

$themeDir = "http://weeverapp.com/media/themes/";

if( !strstr($this->devices, 'DetectTierWeeverTablets') && !strstr($this->devices, 'DetectIpad') && !strstr($this->devices, 'DetectAndroidTablet') )
	$noTablet = 1;
else 
	$noTablet = null;
	
if(!$this->design->launchscreen->phone)
	$this->design->launchscreen->phone = "../images/com_weever/phone_load_live.png";

if(!$this->design->launchscreen->tablet)
	$this->design->launchscreen->tablet = "../images/com_weever/tablet_load_live.png";

if(!$this->design->launchscreen->tablet_landscape)
	$this->design->launchscreen->tablet_landscape = "../images/com_weever/tablet_landscape_load_live.png";
	
if(!$this->design->install->icon)
	$this->design->install->icon = "../images/com_weever/icon_live.png";
	
if(!$this->design->titlebar->image)
	$this->design->titlebar->image = "../images/com_weever/titlebar_logo_live.png";
	
//if(!$this->design->title)
//	$this->design->title = "Untitled";

echo $this->loadTemplate('banner');

?>

<div id='wx-modal-loading'>
    <div id='wx-modal-loading-text'></div>
    <div id='wx-modal-secondary-text'></div>
    <div id='wx-modal-error-text'></div>
</div>

<form action='index.php' enctype='multipart/form-data' method='post' name='adminForm' id='adminForm'>	

	<?php echo comWeeverHelper::startJHtmlPane( 'theme', $pane ); ?>
	<?php echo comWeeverHelper::startJHtmlTabPanel( JText::_('WEEVER_BASIC_SETTINGS'), 'basic-settings', $pane ); ?>
        
    <div class="wx-submitcontainer">
            <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wxui-btn orange medium radius3">&#x2713; &nbsp;<?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
    </div>    

    <?php echo $this->loadTemplate('titlebar'); ?>

    <?php echo $this->loadTemplate('images'); ?>
    	
	<div style="clear:both;"></div>
		
	<?php echo comWeeverHelper::endJHtmlTabPanel( $pane ); ?>
	<?php 
	
	//echo comWeeverHelper::startJHtmlTabPanel( JText::_("WEEVER_ADVANCED_LAUNCHSCREEN_SETTINGS"), 'advanced-launch-settings', $pane ); 
	
	?>
	
	<!--div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wxui-btn orange medium radius3">&#x2713; &nbsp;<?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
	</div-->    
	    		
	
   		<?php 
   		
   		//echo $this->loadTemplate('launchsettings'); 
   		
   		?>
   		
	
	<?php 
	
	//echo comWeeverHelper::endJHtmlTabPanel( $pane ); 
	
	?>
	
	<?php echo comWeeverHelper::startJHtmlTabPanel( JText::_("WEEVER_ADVANCED_THEME_SETTINGS"), 'advanced-settings', $pane ); ?>

	<div class="wx-submitcontainer">
	        <a href="#" onclick="javascript:<?php echo $jsJoomla; ?>submitbutton('apply')"><button class="wxui-btn orange medium radius3">&#x2713; &nbsp;<?php echo JText::_('WEEVER_SAVE_BUTTON'); ?></button></a>
	</div>    
	    		

   		<?php echo $this->loadTemplate('advanced'); ?>
   		
	
	<?php echo comWeeverHelper::endJHtmlTabPanel( $pane ); ?>
	<?php echo comWeeverHelper::endJHtmlPane( $pane); ?>

	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $this->site_key; ?>" />
	<input type="hidden" name="view" value="design" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_('form.token'); ?>
	 
</form>
