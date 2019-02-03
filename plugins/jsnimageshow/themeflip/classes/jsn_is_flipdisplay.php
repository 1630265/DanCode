<?php
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow - Theme Flip
 * @version $Id: jsn_is_flipdisplay.php 16894 2016-12-27 04:49:55Z giangth $
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');
if (!defined('DS'))
{
    define('DS', DIRECTORY_SEPARATOR);
}
class JSNISFlipDisplay extends JObject
{
    var $_themename 	= 'themeflip';
    var $_themetype 	= 'jsnimageshow';
    var $_assetsPath 	= 'plugins/jsnimageshow/themeflip/assets/';
    function __construct() {}

    function standardLayout($args)
    {
        $objJSNShowlist	= JSNISFactory::getObj('classes.jsn_is_showlist');
        $showlistInfo 	= $objJSNShowlist->getShowListByID($args->showlist['showlist_id'], true);
        $dataObj 		= $objJSNShowlist->getShowlist2JSON($args->uri, $args->showlist['showlist_id']);
        $images			= $dataObj->showlist->images->image;
        $document 		= JFactory::getDocument();

        if (!count($images)) return '';
        switch ($showlistInfo['image_loading_order'])
        {
            case 'backward':
                krsort($images);
                $images = array_values($images);
                break;
            case 'random':
                shuffle($images);
                break;
            case 'forward':
                ksort($images);
        }

        JHTML::stylesheet($this->_assetsPath.'css/' . 'styleflip.css',array('media'=>'screen','charset'=>'utf-8'));
        $this->loadjQuery();
        JHTML::script($this->_assetsPath.'js/' . 'jsn_is_conflict.js');
        JHTML::script($this->_assetsPath.'js/' . 'jquery-ui-1.8.9.custom.js');
        JHTML::script($this->_assetsPath.'js/' . 'jquery.booklet.latest.min.js');
        JHTML::script($this->_assetsPath.'js/' . 'jsn_is_themeflip.js');

        $percent  			    = strpos($args->width, '%');
        $args->width 			= ($percent === false) ? $args->width.'px' : $args->width;
        $pluginOpenTagDiv       = '<div style="max-width:'.$args->width.'; margin: 0 auto;">';
        $pluginCloseTagDiv      = '</div>';
        $themeData 		   	    = $this->getThemeDataStandard($args);
        $themeData->total_image = count($images);
        $wrapClass 		   	    = 'jsn-'.$this->_themename.'-container-'.$args->random_number;

        //Booklet options
        $bookletOptions = '';
        $bookletOptions .= 'pagePadding: '.$themeData->padding.',';
        $bookletOptions .= 'speed: '.$themeData->speed.',';
        if($themeData->auto_play == 'yes')
        {
            $bookletOptions .= 'auto: true, delay: '.($themeData->slide_timing*1000).',';
        }
        if($themeData->closed == 'yes')
        {
            $bookletOptions .= 'closed: true,';
        }
        if($themeData->show_page_number == 'no')
        {
            $bookletOptions .= 'pageNumbers: false,';
        }

        //Open link in (current browser OR new tab)
        $openLinkIn = '';
        if($themeData->open_link_in == 'new_browser')
        {
            $openLinkIn = 'target="_blank"';
        }

        //Custom CSS define by user
        $customCss = '';
        //Left page
        if($themeData->container_transparent_background == 'yes')
        {
            $customCss .= '.'.$wrapClass.' .b-wrap-left{background: none!important;}';
        } else {
            $customCss .=  '.'.$wrapClass.' .b-wrap-left{background: '.$themeData->background_color.'!important;}';
            $customCss .= '.'.$wrapClass.' .b-wrap-left .b-counter{background: '.$themeData->background_color.'!important; bottom: '.$themeData->padding.'px; left: '.$themeData->padding.'px}';
        }
        //Right page
        if($themeData->container_transparent_background_right == 'yes')
        {
            $customCss .=  '.'.$wrapClass.' .b-wrap-right{background: none!important;}';
        } else {
            $customCss .=  '.'.$wrapClass.' .b-wrap-right{background: '.$themeData->background_color_right.'!important;}';
            $customCss .=  '.'.$wrapClass.' .b-wrap-right .b-counter{background: '.$themeData->background_color_right.'!important; bottom: '.$themeData->padding.'px; right: '.$themeData->padding.'px}';
        }
        //Caption CSS (contain of title and description)
        if($themeData->caption_css == '') {
            $captionCss = 'jsn-flip-content';
        } else
        {
            $captionCss = 'custom_css_content';
            $customCss .=  '.'.$wrapClass.' .custom_css_content {'.$themeData->caption_css.'}';
        }
        //Title CSS
        if($themeData->title_css == '') {
            $titleCSS = 'jsn-flip-title';
        } else
        {
            $titleCSS = 'custom_css_title';
            $customCss .=  '.'.$wrapClass.' .custom_css_title {'.$themeData->title_css.'}';

        }
        //Description CSS
        if($themeData->description_css == '') {
            $descriptionCss = 'jsn-flip-description';
        } else
        {
            $descriptionCss = 'custom_css_description';
            $customCss .=  '.'.$wrapClass.' .custom_css_description {'.$themeData->description_css.'}';
        }
        //Add style declaration
        if($customCss != '')
        {
            $document->addStyleDeclaration($customCss);
        }

        $imageSource		= 'image';
        $html  = $pluginOpenTagDiv.'<div class="jsn-themeflip-container '.$wrapClass.'">';
        $html .= '<div class="jsn-themeflip-items" id="jsn-themeflip-items" style="margin:0 auto;overflow:hidden;display:inline-block;" >';
        foreach ($images as $image)
        {
            $html .= '<div class="jsn-themeflip-box" style="background: url('.$image->$imageSource.'); background-size: '.$themeData->img_layout.'; background-repeat: no-repeat; background-position: center;">';
            $html .= '<div class="'.$captionCss.'">';
            if($themeData->show_title == 'yes')
            {
                $html .= '<h3 class="'.$titleCSS.'">';
                if($themeData->apply_link_title == 'yes')
                {
                    $html .= '<a class="'.$titleCSS.'" href="'.$image->link.'" '.$openLinkIn.' rev="'.htmlspecialchars(strip_tags(trim($image->description), '<b><i><s><strong><em><strike><u><br><span>')).'" title="'.htmlspecialchars($image->title, ENT_QUOTES).'">';
                    $html .= $image->title.'</a>';
                } else
                {
                    $html .= $image->title;
                }
                $html .= '</h3>';
            }
            if($themeData->caption_show_description == 'yes')
            {
                $html .= '<p class="'.$descriptionCss.'">'.$this->_wordLimiter($image->description, $themeData->description_limit).'</p>';
            }
            $html .= '</div></div>';
        }
        $html .= '</div>';
        $html .= '</div>'.$pluginCloseTagDiv;
        //$bookletOptions .= 'width: "'.$args->width.'", height: "'.$args->height.'",';
        $bookletOptions .= 'hoverWidth: 75, ';
        $html .= '<script>function booklet'.$args->random_number.'() {var bookletWidth = 600; var bookletHeight = 400; var parentWidth = jsnThemeFlipjQuery("#jsn-themeflip-items").parent().width();';
        if($percent === false)
        {
            $html .= 'if(parentWidth < parseInt("'.$args->width.'")){bookletWidth = parentWidth; bookletHeight = parentWidth *  parseInt("'.$args->height.'")/ parseInt("'.$args->width.'");} else{bookletWidth = "'.$args->width.'"; bookletHeight = "'.$args->height.'px";}';
        } else
        {
            $html .= 'bookletWidth = parentWidth; bookletHeight = '.$args->height.';';
        }

        $html .='jsnThemeFlipjQuery(".'.$wrapClass.' .jsn-themeflip-items").booklet({width:bookletWidth, height: bookletHeight, '.$bookletOptions.'})};
        booklet'.$args->random_number.'();
        jsnThemeFlipjQuery(window).resize(function (e) {jsnThemeFlipjQuery(".'.$wrapClass.' .jsn-themeflip-items").booklet("disable"); booklet'.$args->random_number.'();})</script>';
        return $html;
    }

    function displayAlternativeContent()
    {
        return '';
    }

    function displaySEOContent($args)
    {
        $html    = '<div class="jsn-'.$this->_themename.'-seocontent">'."\n";
        if (count($args->images))
        {
            $html .= '<div>';
            $html .= '<p>'.@$args->showlist['showlist_title'].'</p>';
            $html .= '<p>'.@$args->showlist['description'].'</p>';
            $html .= '<ul>';

            for ($i = 0, $n = count($args->images); $i < $n; $i++)
            {
                $row 	=& $args->images[$i];
                $html  .= '<li>';
                if ($row->image_title != '')
                {
                    $html .= '<p>'.$row->image_title.'</p>';
                }
                if ($row->image_description != '')
                {
                    $html .= '<p>'.$row->image_description.'</p>';
                }
                if ($row->image_link != '')
                {
                    $html .= '<p><a href="'.$row->image_link.'">'.$row->image_link.'</a></p>';
                }
                $html .= '</li>';
            }
            $html .= '</ul></div>';
        }
        $html   .='</div>'."\n";
        return $html;
    }
    function mobileLayout($args){
        return '';
    }
    function display($args)
    {
        $string		= '';
        $args->uri	= JURI::base();
        $string .= $this->standardLayout($args);
        $string .= $this->displaySEOContent($args);
        return $string;
    }

    function getThemeDataStandard($args)
    {
        if (is_object($args))
        {
            $path = JPath::clean(JPATH_PLUGINS.DS.$this->_themetype.DS.$this->_themename.DS.'models');
            JModelLegacy::addIncludePath($path);

            $model 		= JModelLegacy::getInstance($this->_themename);
            $themeData  = $model->getTable($args->theme_id);
            return $themeData;
        }
        return false;
    }

    function getThemeDataMobile($args)
    {
        return false;
    }

    function loadjQuery()
    {
        $loadJoomlaDefaultJQuery = true;
        if (class_exists('JSNConfigHelper')) {
            $objConfig = JSNConfigHelper::get('com_imageshow');
            if ($objConfig->get('jquery_using') != 'joomla_default') {
                $objUtils = JSNISFactory::getObj('classes.jsn_is_utils');

                if (method_exists($objUtils, 'loadJquery')) {
                    $objUtils->loadJquery();
                }
                else {
                    JHTML::script($this->_assetsPath . 'js/jsn_is_jquery_safe.js');
                    JHTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.4/jquery.min.js');
                }
                $loadJoomlaDefaultJQuery = false;
            }
        }
        if ($loadJoomlaDefaultJQuery) {
            JHTML::script($this->_assetsPath . 'js/jsn_is_jquery_safe.js');
            JHtml::_('jquery.framework');
        }
    }

    function _wordLimiter($str, $limit = 100, $endChar = '&#8230;')
    {
        if (trim($str) == '')
        {
            return $str;
        }
        $append = '';
        $str 	= strip_tags(trim($str));
        $words 	= explode(" ", $str);
        if(count($words) > $limit)
        {
            $append = $endChar;
        }

        return implode(" ", array_splice($words, 0, $limit)) . $append;
    }
}