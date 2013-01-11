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

$option 		= JRequest::getCmd('option');
$document 		= JFactory::getDocument();

$extraScript	= '';

if( comWeeverHelper::joomlaVersion() < 3.0 )
	JHTML::_('behavior.mootools');
	
else 
	JHtmlBehavior::framework();

JHTML::_('behavior.tooltip');
JHTML::_('behavior.modal', 'a.modal');

jimport('joomla.html.pane');

echo $this->loadTemplate('js');

jimport('joomla.filter.output');


$child_html 		= "";
$rowshade			= 0; // for alternating shaded rows
$iii 				= 0; // for making checkboxes line up right
$tabsUnpublished 	= 0;
$onlineSpan 		= "";
$offlineSpan 		= "";

echo $this->loadTemplate('banner');

echo "<div class='wx-full-container'>";

if( isset($this->sidebar) )
{

	echo "<div class='wx-j3-sidebar'>";
	
	echo $this->sidebar;
	
	echo "</div>";

}

?>

<div id="wx-list-workspace">

	<div id="listTabs">
	
		<ul id="listTabsSortable" style="padding-right: 5%">
		
			<li id="addTabID" class="wx-nav-tabs wx-nosort">
				
				<a href="#addTab" class="wx-tab-sortable">
				
					<div class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="Add">
						<span style="display: block; margin: 0pt auto; position: relative; font-weight: bold; font-size: 2.75em; line-height: normal;">+</span>
					</div>
					
					<div class="wx-nav-label">New Feature</div>
					
				</a>
				
			</li>

<?php 

/* Parent Tabs and Orphans */
foreach( (array) $this->tabs as $k=>$v ) 
{

	$tab_active		= 0;

	/* Check to see if parent or orphan, if published */
	foreach( (array) $v as $kk=>$vv )
	{
	
		if( $vv->published )
			$tab_active = 1;
	
	}
	
	// readd later
//	if($this->tier == 2.1 && $v[0]->tier > 1)
//		$trialClass = " trial-feature";
//	else 
		$trialClass = "";

	/* When there are items, but none are published */
	if( count($v) && $tab_active == 0 )
		echo '<li class="wx-nav-tabs wx-sort" id="' . $v[0]->id . '" rel="unpublished" style="float:center;">
				<a href="#Tab-' . $v[0]->id . '" class="wx-tab-sortable' . $trialClass.'">
				
					<div id="wx-nav-icon-' . $v[0]->id . '" ref="' . $v[0]->icon_id . '"  title="' . $v[0]->id . '" class="wx-grayed-out wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center">
					
						<img class="wx-nav-icon-img" src="data:image/png;base64,' . file_get_contents(comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . "/icons/get_icon_base64?icon_id=" . $v[0]->icon_id) . '" />
						
					</div>
					
					<div id="wx-nav-label-' . $v[0]->id . '" class="wx-nav-label wx-grayed-out" ref="' . $v[0]->id . '" title="ID #' . $v[0]->id . '">' . ( $v[0]->tabTitle ? $v[0]->tabTitle : $v[0]->title ) . '</div>
					
				</a>
				
			</li>';	
	
		else
			echo '<li class="wx-nav-tabs wx-sort" id="' . $v[0]->id . '">
						<a href="#Tab-' . $v[0]->id . '" class="wx-tab-sortable' . $trialClass.'">
						
							<div id="wx-nav-icon-' . $v[0]->id . '" ref="' . $v[0]->icon_id . '" title="' . $v[0]->id . '" class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center">
							
								<img class="wx-nav-icon-img" src="data:image/png;base64,'.file_get_contents(comWeeverConst::LIVE_SERVER . comWeeverConst::API_VERSION . "/icons/get_icon_base64?icon_id=" . $v[0]->icon_id).'" />
							
							</div>
							
							<div id="wx-nav-label-' . $v[0]->id . '" ref="' . $v[0]->icon_id . '" class="wx-nav-label" title="ID #'.$v[0]->id.'">'.( $v[0]->tabTitle ? $v[0]->tabTitle : $v[0]->title ).'</div>
							
						</a>
					</li>';	

}

?>
 
		</ul>
		 
		<?php echo $this->loadTemplate('addtab'); ?>
		
		<div id="wx-overlay-drag">
		
			<div id="wx-overlay-unpublished"><?php echo JText::_('WEEVER_ICON_HAS_NO_PUB_ITEMS'); ?></div>
			<img id="wx-overlay-drag-img" src="components/com_weever/assets/icons/drag.png" />
			<div><?php echo JText::_('WEEVER_DOUBLE_CLICK_EDIT'); ?></div>
			
		</div>
		
		<div id='wx-modal-loading'>
		
		    <div id='wx-modal-loading-text'></div>
		    <div id='wx-modal-secondary-text'></div>
		    <div id='wx-modal-error-text'></div>
		    
		</div>

		<form action='<?php echo JRoute::_( 'index.php' );?>' method='post' name='adminForm' id='adminForm'>
	
<?php

foreach( (array) $this->tabs as $k=>$v ) 
{

	$link = JFilterOutput::ampReplace('index.php?option=' . $option . '&task=edit&layout=tab&cid[]='.$v[0]->id);
	
//	if(count($componentRows))
//	{
//		
//		$published = JHTML::_('grid.published', $row, $iii);
//		$checked = JHTML::_('grid.id', $iii, $row->id);
//		
//		if($row->published == 0)
//			$tabsUnpublished++;
//			
//	}
//	else
//	{
//	
//		$published = JText::_('WEEVER_NOT_APPLICABLE');
//		$checked = null;
//		$tabsUnpublished++;
//		
//	}

?>
	
		<div id="<?php echo 'Tab-'.$v[0]->id ?>">
		
			<div class="wx-tab-top-buttons-container">
			
				<button class="wxui-btn white medium radius3 wx-nav-label" style="margin-right:1.5em;" title="<?php echo $v[0]->id; ?>">&bull; &nbsp;Change Tab Name</button>
				<button class="wxui-btn white medium radius3 wx-nav-icon" style="margin-right:1.5em;" ref="<?php echo $v[0]->icon_id; ?>" title="<?php echo $v[0]->id; ?>">&bull; &nbsp;Change Tab Icon</button>
				
				<?php if( $row->component == "panel" || $row->component == "aboutapp" || $row->component == "map" ) : ?>
				
					<button class="wxui-btn white medium radius3 wx-tab-settings" rel="<?php echo $v[0]->id; ?>">&bull; &nbsp;Change Tab Settings</button>
					
				<?php endif; ?>
			
			</div>
			
			<input type="hidden" name="boxchecked-<?php echo $v[0]->id; ?>" id="boxchecked-<?php echo $v[0]->id; ?>" value="0" />
	
			<table class='adminlist' id='wx-adminlist-<?php echo $v[0]->id; ?>'>
	
				<thead>
				
					<tr>
						<th width='20'>
						
							<input type='checkbox' name='toggle-<?php echo $v[0]->id; ?>' id='toggle-<?php echo $v[0]->id; ?>' value='' onclick='checkAllTab(<?php echo count($v[0]); ?>, "cb", document.getElementById("boxchecked-<?php echo $v[0]->id; ?>"), document.getElementById("toggle-<?php echo $v[0]->id; ?>"), <?php echo $iii; ?> + 1);' />
							
						</th>
						
						<th class='title'>
						
							<?php echo JHTML::_('grid.sort', JText::_('WEEVER_NAME'), 'name', $this->lists['order_Dir'], $this->lists['order']); ?> &nbsp; (<a target="_blank" href="http://weeverapps.com/mobile-app-layout" style="color:#1C94C4;">?</a>)
							
						</th>
						
						<th width='9%' nowrap='nowrap'>
						
							<?php echo JText::_('Move to Tab'); ?>
							
						</th>
						
						<th width='9%' nowrap='nowrap'>
						
							<?php echo JHTML::_('grid.sort', JText::_('WEEVER_PUBLISHED'), 'published', $this->lists['order_Dir'], $this->lists['order']); ?>
							
						</th>
						
						<th width='9%' nowrap='nowrap'><?php echo JText::_('WEEVER_DELETE_TH'); ?></th>
						
					</tr>
					
				</thead>
				
				<tfoot>
				
					<tr>
					
						<td colspan='5'>
						
							<div class="wx-list-actions">
				
								<div class="wx-button-option" style="margin:0; padding:0;width: 110px;">
									<img  style="margin:0;" src="components/com_weever/assets/icons/arrow_leftup.png" />
									<span style="float:right; margin-top:.75em;">with selected:</span>
								</div>
								
								<div class="wx-button-option" id='wx-toolbar-publish'>
									<a href="#" onclick="javascript:if(document.getElementById('boxchecked-<?php echo $v[0]->id; ?>')==0){alert('Please make a selection from the list to publish');}else{  submitbutton('publish')}" class="toolbar">
										
										<img class="wx-button-option-icon" src="components/com_weever/assets/icons/tick.png" id="wx-publish-selected" title="Publish" /><?php echo JText::_('WEEVER_PUBLISH'); ?>
									
									</a>
									
								</div>
								
								<div class="wx-button-option" id='wx-toolbar-unpublish'>
								
									<a href="#" onclick="javascript:if(document.getElementById('boxchecked-<?php echo $v[0]->id; ?>')==0){alert('Please make a selection from the list to unpublish');}else{  submitbutton('unpublish')}" class="toolbar">
									<img class="wx-button-option-icon" src="components/com_weever/assets/icons/publish_x.png" id="wx-unpublish-selected" title="Unpublish" /><?php echo JText::_('WEEVER_UNPUBLISH'); ?>
									</a>
									
								</div>
								
								<div  class="wx-button-option" id="wx-toolbar-delete">
								
									<a href="#" onclick="javascript:if(document.getElementById('boxchecked-<?php echo $v[0]->id; ?>')==0){alert('Please make a selection from the list to delete');}else{if(confirm('Are you sure you want to delete these tabs? (Note that navigation tabs selected will not be deleted.)')){submitbutton('remove');}}" class="toolbar">
										<img class="wx-button-option-icon" src="components/com_weever/assets/icons/wx-delete-mark.png" id="wx-delete-selected" title="Delete" /><?php echo JText::_('WEEVER_DELETE_TH'); ?>
									</a>
									
								</div>
								
							</div>
							
						</td>
						
					</tr>
					
				</tfoot>

	<?php
	$rowshade = 1 - $rowshade;
	$sub = 0;
	?>
	
				<tbody class="wx-table-sort" id='wx-table-<?php echo $v[0]->id; ?>'>
	
	<?php
	
	foreach( (array) $v as $kk=>$vv )
	{
	
		$iii++; $sub++;		
		
		if( $vv->layout == "share" ) 
		{
		
			?>
			
			<tr class='row<?php echo $vv->id; ?>'>
				<td></td>
				<td><img class="wx-sort-icon" title="Drag to sort the order of items" src="components/com_weever/assets/icons/sort.png" /> <a href='#' title="ID #<?php echo $vv->id; ?>" class="wx-subtab-link">&nbsp;<?php echo $vv->title; ?>&nbsp;</a></td>
				<td></td>
				<td></td>
				<td></td>			
			</tr>
			
			<?php
			
			continue; 
		
		}
		
		?>
		
					<tr id='<?php echo $vv->id; ?>' class='row<?php echo $vv->id; ?>'>
					
						<td>
							<?php echo JHTML::_('grid.id', $iii, $vv->id); ?>
						</td>
						
						<td>
							<img class="wx-sort-icon" title="Drag to sort the order of items" src="components/com_weever/assets/icons/sort.png" /> <a href='#' title="ID #<?php echo $vv->id; ?>" class="wx-subtab-link">&nbsp;<?php echo $vv->title; ?>&nbsp;</a>
						</td>
						
						<td align='center'>
						
							
							 <a href="#" title="ID #<?php echo $vv->id; ?>" class="wx-subtab-movetab"><?php echo '<img src="components/com_weever/assets/icons/move.png" border="0" style="width:24px;" alt="Move to Tab">'; ?></a>
							 
							 
						</td>
						
						<td align='center'>
						
							 <a href="#" title="ID #<?php echo $vv->id; ?>" class="wx-subtab-publish"<?php echo ($vv->published ? 'rel="1"><img src="components/com_weever/assets/icons/tick.png" border="0" alt="Published">' : 'rel="0"><img src="components/com_weever/assets/icons/publish_x.png" border="0" alt="Unpublished">'); ?></a>
							 
						</td>
						
						<td align='center'>
						
							<a href="#" title="ID #<?php echo $vv->id; ?>" class="wx-subtab-delete" rel="<?php echo $vv->layout; ?>" alt=" <?php echo JText::_('WEEVER_DELETE'); ?> &quot;<?php echo htmlentities($vv->title); ?>&quot;"><img src="components/com_weever/assets/icons/wx-delete-mark.png" /></a>
							
						</td>
						
					</tr>
		
		<?php
		$rowshade = 1 - $rowshade;
		
	}
	
	?>
	
				</tbody>
		
			</table>
			
		</div>
	
	<?php

}

?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="site_key" id="wx-site-key" value="<?php echo $this->site_key; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="legacyAPI" value="2" />
		<input type="hidden" name="view" value="list" />
		<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
		<?php echo JHTML::_('form.token'); ?>
		</form>
		
	</div>
	
</div>

</div>

<?php echo $this->loadTemplate('dialogs'); ?>
