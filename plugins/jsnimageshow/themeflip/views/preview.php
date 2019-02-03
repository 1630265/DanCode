<?php
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow - Theme Flip
 * @version $Id: preview.php 14473 2012-07-27 09:30:24Z haonv $
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.plugin.plugin' );
if (!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}
?>
<div style="width: 600px; overflow: hidden">
    <div class="jsn-flip-page-name" onclick="jQuery.JSNISThemeFlip.toogleTab(0);">LEFT PAGE</div>
    <div class="jsn-flip-page-name" onclick="jQuery.JSNISThemeFlip.toogleTab(1);">RIGHT PAGE</div>
</div>
<div class="jsn-flip-preview" style="float: left">
    <div class="jsn-flip-preview-ls">
        <div class="jsn-flip-preview-page" style="background: url('../plugins/jsnimageshow/themeflip/assets/images/demo/demo1.jpg')">
                <div class="jsn-flip-preview-content"  onclick="jQuery.JSNISThemeFlip.toogleTab(3);">
                    <h3 class="jsn-flip-preview-title">
                        <a href="javascript:void(0);" title="Lorem Ipsum is simply dummy text">Lorem Ipsum is simply dummy text</a>
                    </h3>
                    <p class="jsn-flip-preview-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                </div>
            <div class="jsn-flip-preview-page-number" onclick="jQuery.JSNISThemeFlip.toogleTab(4);">1</div>
        </div>
    </div>
    <div class="jsn-flip-preview-rs">

        <div class="jsn-flip-preview-page" style="background: url('../plugins/jsnimageshow/themeflip/assets/images/demo/demo2.jpg')">
            <div class="jsn-flip-preview-content" onclick="jQuery.JSNISThemeFlip.toogleTab(3);">
                <h3 class="jsn-flip-preview-title">
                    <a href="javascript:void(0);" title="Lorem Ipsum is simply dummy text">Lorem Ipsum is simply dummy text</a>
                </h3>
                <p class="jsn-flip-preview-description">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                </p>
            </div>
            <div class="jsn-flip-preview-page-number" onclick="jQuery.JSNISThemeFlip.toogleTab(4);">2</div>
        </div>
    </div>
</div>
<div id="lorem_ipsum">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</div>