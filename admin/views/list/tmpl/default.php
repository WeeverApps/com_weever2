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
<script type="text/javascript">
    wx.navIconDir = "static/images/icons/nav/";
    wx.baseExtensionUrl = "<?php echo 'http://aaron.myweeverapp.com/joomla2511/administrator/index.php?option=com_weever'; ?>";
    wx.siteKey = "<?php echo 'xOUNs3cIQMERqID4gNNrAJITtJQPlkWJ'; ?>";
    wx.apiUrl = "<?php echo 'http://hydrus.weeverapp.com/api/v2'; ?>";
</script>

<div id="listTabs">
    <ul id="listTabsSortable" class="list-items-sortable list-main-tabs">
        <li id="addFeatureID" class="wx-nav-tabs wx-nosort"><a href="#addTab" class="wx-tab-sortable" style="padding-top: 14px;" title="Drag New Features to this Location"><div class="wx-nav-icon" style="height:32px;width:auto;min-width:32px;text-align:center" title="Add"><span id="addtabspan" style="display: block; margin: 0 auto; font-weight: bold; color: #666; position: relative; line-height: 1.5; white-space: normal;">Drag New Features Here</span><span style="display:none; margin: 0 auto; text-align: left; font-weight: bold; color: #666; position: relative; line-height: 1.5; white-space: normal;" id="edittabspan">&lsaquo; back to "Build"</span></div></a></li>
        <li style="width:80px; height:60px; border-style: dashed; margin-left: 5px; border-width: 2px 2px 0; border-color: #666; color: #666; padding: 5px 0 0 5px; box-sizing: border-box; -webkit-box-sizing: border-box; display: none;" id="dropTab">Drop Here</li>
        <span id="wx-note-tabs-id" class="wx-note-tabs-class wx-nosort">&larr; <?php echo JText::_( 'Drag and drop tabs to re-order!' );?></span>
    </ul>

    <!-- TABS -->
    <div id="addTab">
        <!-- START: INTERFACE FOR THE WEEVER APP BUILDER UI V2 -->
        <div id="wx-add-OneView">
            <!-- START: Add to App Button Sets -->
            <div id="wx-add-content-to-app-buttons">
                <!-- 0.  Empty State Message for Newbies -->

                <div class="wx_box wxblk" id="wxnavtip-empty">
                    <h2 style="display: block; margin: 0px;"><?php echo JText::_( '<strong>Get started</strong> by selecting app features below!' );?></h2>
                </div>

                <ul id="wxui-addbuttons-content" class="wxui-btnwrapper list-items-sortable list-add-content-items">
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-FormBuilder">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/form_icon.png">
                        <span><?php echo JText::_( 'Form Builder' ); ?></span>
                    </li>

                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon" id="add-Twitter">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/twitter.png">
                        <span><?php echo JText::_( 'Twitter' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-FacebookWall">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/facebook.png">
                        <span><?php echo JText::_( 'Facebook Wall' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon" id="add-Youtube">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/youtube.png">
                        <span><?php echo JText::_( 'YouTube' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-Vimeo">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/vimeo.png">
                        <span><?php echo JText::_( 'Vimeo' ); ?></span>
                    </li>
                    
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon" id="add-Flickr">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/flickr.png">
                        <span><?php echo JText::_( 'Flickr' ); ?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-PicasaAlbums">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/picasa.png">
                        <span><?php echo JText::_( 'Picasa' ); ?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-FoursquarePhotos">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/foursquare.png">
                        <span><?php echo JText::_( 'Foursquare' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-FacebookAlbums">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/facebook.png">
                        <span><?php echo JText::_( 'Facebook Photos' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-GoogleCalendar">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/google_calendar.png"><span>Google Calendar</span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-FacebookEvents">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/facebook.png">
                        <span><?php echo JText::_( 'Facebook Events' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-WordpressContacts">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/wordpress_contact.png">
                        <span><?php echo JText::_( 'Tap-to-Call and Email' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-Wufoo">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/form_icon.png">
                        <span><?php echo JText::_( 'Wufoo Forms' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-RSS">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/r3s.png">
                        <span><?php echo JText::_( 'RSS Code' );?></span>
                    </li>
                    
                        <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-r3s">
                            <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/r3s.png">
                            <span><?php echo JText::_( 'R3S Code' );?></span>
                        </li>

                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-add-single" id="add-Blogger">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/blogger.png">
                        <span><?php echo JText::_( 'Blogger' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-unavailable wx-add-single" id="add-google_plus">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/google_plus.png">
                        <span><?php echo JText::_( 'Google+' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-unavailable wx-add-single" id="add-tumblr">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/tumblr.png">
                        <span><?php echo JText::_( 'Tumblr' );?></span>
                    </li>                        <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-unavailable" id="add-soundcloud">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/soundcloud.png">
                        <span><?php echo JText::_( 'SoundCloud' );?></span>
                    </li>
                    <li class="wxui-btn white large radius3 wx-floatleft wx-add-source-icon wx-unavailable" id="add-bandcamp">
                        <img src="http://weeverapps.com/wp-content/plugins/weever-apps-for-wordpress/static/images/icons/nav/bandcamp.png">
                        <span><?php echo JText::_( 'BandCamp' );?></span>
                    </li>
                </ul>
                <!-- END: Add to App Buttons -->
            </div>
        </div>
        <!-- wx-add-OneView -->
    </div>
    <!-- END: INTERFACE FOR THE WEEVER APP BUILDER UI V2 -->

    <div id="wx-overlay-drag">
        <div id="wx-overlay-unpublished">
            <?php echo JText::_( 'This tab has no published items' ); ?>
        </div>
        <img id="wx-overlay-drag-img" src="static/images/icons/drag.png" />
    </div>

    <div id="wx-modal-loading">
        <div id="wx-modal-msgcontainer">
        <img src="static/images/loading.gif" style="float: right; margin-left: 16px;" />
            <div id="wx-modal-loading-text"></div>
            <div id="wx-modal-secondary-text"></div>
            <div id="wx-modal-error-text"></div>
        </div>
    </div>

    <!-- END TABS -->
</div>

<div class="clear"></div>
