<?php
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow - Theme Flip
 * @version $Id: themeflip.php 14559 2016-12-27 11:50:34Z giangth $
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die('Restricted access');
class TableThemeFlip extends JTable
{
	var $theme_id 					= null;
	var $show_title 				= 'yes';
	var $caption_show_description	= 'yes';
	var $apply_link_title           = 'yes';
    var $description_limit          = '20';
	var $open_link_in				= 'current_browser';
	var $img_layout					= 'cover';
	var $background_color			= '#FFFFFF';
    var $background_color_right		= '#EEEEEE';
	var $container_transparent_background = 'no';
    var $container_transparent_background_right = 'no';
	var $auto_play					= 'no';
	var $slide_timing				= '3';
	var $title_css                  = "font-family: Verdana;\nfont-size: 12px;\nfont-weight: bold;\nline-heigth: 14px;\nmargin: 0;\ntext-align: left;\ncolor: #FFFFFF;";
	var $description_css            = "font-family: Arial;\nfont-size: 11px;\nfont-weight: normal;\nmargin: 0;\ntext-align: left;\ncolor: #FFFFFF;";
	var $caption_css                = "background-color: rgba(55,55,55,0.4);\npadding: 5px;";
	var $padding                    = '10';
	var $closed                     = 'no';
	var $speed                      = '500';
	var $show_page_number           = 'yes';

	function __construct(& $db) {
		parent::__construct('#__imageshow_theme_flip', 'theme_id', $db);
	}
}
?>