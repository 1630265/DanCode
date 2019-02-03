<?php
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow - Theme Flip
 * @version $Id: helper.php 14559 2016-12-27 11:50:34Z giangth $
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die( 'Restricted access' );
$objJSNShowcaseTheme = JSNISFactory::getObj('classes.jsn_is_showcasetheme');
$objJSNShowcaseTheme->importTableByThemeName($this->_showcaseThemeName);
$objJSNShowcaseTheme->importModelByThemeName($this->_showcaseThemeName);
$modelShowcaseTheme = JModelLegacy::getInstance($this->_showcaseThemeName);
$items = $modelShowcaseTheme->getTable($themeID);

JSNISFactory::importFile('classes.jsn_is_htmlselect');

/**
 * /////////////////////////////////////////////////////////Image Panel Begin////////////////////////////////////////////////////////////////////////////
 */
$imgLayout = array(
	'0' => array('value' => 'contain', 'text' => JText::_('THEME_FLIP_LAYOUT_CONTAIN')),
	'1' => array('value' => 'cover', 'text' => JText::_('THEME_FLIP_LAYOUT_COVER')),
    '2' => array('value' => 'inherit', 'text' => JText::_('THEME_FLIP_LAYOUT_INHERIT')),
    '3' => array('value' => 'initial', 'text' => JText::_('THEME_FLIP_LAYOUT_INITIAL'))
);
$lists['imgLayout'] = JHTML::_('select.genericList', $imgLayout, 'img_layout', 'class="inputbox imagePanel"', 'value', 'text', $items->img_layout );
$lists['showTitle'] 	= JHTML::_('jsnselect.booleanlist', 'show_title', 'class="inputbox captionPanel"', $items->show_title, 'JYES', 'JNO', false, 'yes', 'no');
$lists['applyLink'] 	= JHTML::_('jsnselect.booleanlist', 'apply_link_title', 'class="inputbox captionPanel"', $items->apply_link_title, 'JYES', 'JNO', false, 'yes', 'no');
$lists['captionShowDescription'] = JHTML::_('jsnselect.booleanlist', 'caption_show_description', 'class="inputbox captionPanel"', $items->caption_show_description, 'JYES', 'JNO', false, 'yes', 'no');

$openLinkIn = array(
	'0' => array('value' => 'current_browser', 'text' => JText::_('THEME_FLIP_OPEN_LINK_IN_CURRENT_BROWSER')),
	'1' => array('value' => 'new_browser', 'text' => JText::_('THEME_FLIP_OPEN_LINK_IN_NEW_BROWSER'))
);
$lists['openLinkIn'] = JHTML::_('select.genericList', $openLinkIn, 'open_link_in', 'class="inputbox"', 'value', 'text', ($items->open_link_in == '')?'current_browser':$items->open_link_in);

$lists['containerTransparentBackground']	= JHTML::_('jsnselect.booleanlist', 'container_transparent_background', 'class="inputbox containerPanel"', $items->container_transparent_background, 'JYES', 'JNO', false, 'yes', 'no');
$lists['containerTransparentBackgroundRight']	= JHTML::_('jsnselect.booleanlist', 'container_transparent_background_right', 'class="inputbox containerPanel"', $items->container_transparent_background_right, 'JYES', 'JNO', false, 'yes', 'no');
$lists['showPageNumber'] = JHTML::_('jsnselect.booleanlist', 'show_page_number', 'class="inputbox captionPanel"', $items->show_page_number, 'JYES', 'JNO', false, 'yes', 'no');
$lists['autoPlay'] = JHTML::_('jsnselect.booleanlist', 'auto_play', 'class="inputbox slideshow-panel"', $items->auto_play, 'JYES', 'JNO', false, 'yes', 'no');
$lists['closed'] = JHTML::_('jsnselect.booleanlist', 'closed', 'class="inputbox slideshow-panel"', $items->closed, 'JYES', 'JNO', false, 'yes', 'no');

