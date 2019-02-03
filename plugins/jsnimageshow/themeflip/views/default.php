<?php
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow - Theme Flip
 * @version $Id: default.php 16892 2016-12-27 04:07:40Z giangth $
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die( 'Restricted access' );
if (!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}
$objJSNUtils = JSNISFactory::getObj('classes.jsn_is_utils');
$url 		 = $objJSNUtils->overrideURL();
$user 		 = JFactory::getUser();
?>
<script type="text/javascript">
    (function($){
        $(document).ready(function ()
        {
            $('#jsn-is-themeflip').tabs();
            $.JSNISThemeFlip.initialize();
            $.JSNISThemeFlip.visual();

            $('#background-color-selector').ColorPicker({
                color: $('#background_color').val(),
                onShow: function (colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    $('#background_color').val('#' + hex);
                    $('#background-color-selector div').css('backgroundColor', '#' + hex);
                    $('.jsn-flip-preview-ls').css('background-color', '#' + hex);
                    $('.jsn-flip-preview-ls .jsn-flip-preview-page-number').css('background-color', '#' + hex);
                }
            });

            $('#background-color-right-selector').ColorPicker({
                color: $('#background_color_right').val(),
                onShow: function (colpkr) {
                    $(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    $('#background_color_right').val('#' + hex);
                    $('#background-color-right-selector div').css('backgroundColor', '#' + hex);
                    $('.jsn-flip-preview-rs').css('background-color', '#' + hex);
                    $('.jsn-flip-preview-rs .jsn-flip-preview-page-number').css('background-color', '#' + hex);
                }
            });
        })
    })(jQuery);
</script>
<table class="jsn-showcase-theme-settings">
	<tr>
		<td valign="top" id="jsn-theme-parameters-wrapper">
			<div id="jsn-is-themeflip" class="jsn-tabs">
				<ul>
					<li><a href="#themeflip-left-side-tab"><?php echo JText::_('THEME_FLIP_IMAGE_LEFT_PAGE'); ?></a></li>
                    <li><a href="#themeflip-right-side-tab"><?php echo JText::_('THEME_FLIP_IMAGE_RIGHT_PAGE'); ?></a></li>
					<li><a href="#themeflip-image-tab"><?php echo JText::_('THEME_FLIP_IMAGE_PRESENTATION'); ?></a></li>
                    <li><a href="#themeflip-caption-tab"><?php echo JText::_('THEME_FLIP_CAPTION'); ?></a></li>
                    <li><a href="#themeflip-slideshow-tab"><?php echo JText::_('THEME_FLIP_SLIDESHOW')?></a></li>
				</ul>
				<div id="themeflip-left-side-tab" class="jsn-bootstrap">
					<div class="form-horizontal">
						<div class="row-fluid show-flip">
							<div class="span12">
								<div class="control-group">
									<label class="control-label hasTip"
										title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_BACKGROUND_COLOR_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_BACKGROUND_COLOR_DESC')); ?>"><?php echo JText::_('THEME_FLIP_BACKGROUND_COLOR_TITLE');?>
									</label>
									<div class="controls">
										<input type="text"
											value="<?php echo (!empty($items->background_color))?$items->background_color:'#ffffff'; ?>"
											readonly="readonly" name="background_color"
											id="background_color" class="input-mini containerPanel" />
										<div class="color-selector" id="background-color-selector">
											<div style="background-color: <?php echo (!empty($items->background_color))?$items->background_color:'#ffffff'; ?>"></div>
										</div>
									</div>
								</div>
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_TRANSPARENT_BACKGROUND_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_TRANSPARENT_BACKGROUND_DESC')); ?>"><?php echo JText::_('THEME_FLIP_TRANSPARENT_BACKGROUND_TITLE');?></label>
                                    <div class="controls">
                                        <?php echo $lists['containerTransparentBackground']; ?>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
                <div id="themeflip-right-side-tab" class="jsn-bootstrap">
                    <div class="form-horizontal">
                        <div class="row-fluid show-flip">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label hasTip"
                                           title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_BACKGROUND_COLOR_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_BACKGROUND_COLOR_DESC')); ?>"><?php echo JText::_('THEME_FLIP_BACKGROUND_COLOR_TITLE');?>
                                    </label>
                                    <div class="controls">
                                        <input type="text"
                                               value="<?php echo (!empty($items->background_color_right))?$items->background_color_right:'#ffffff'; ?>"
                                               readonly="readonly" name="background_color_right"
                                               id="background_color_right" class="input-mini containerPanel" />
                                        <div class="color-selector" id="background-color-right-selector">
                                            <div style="background-color: <?php echo (!empty($items->background_color_right))?$items->background_color_right:'#ffffff'; ?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_TRANSPARENT_BACKGROUND_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_TRANSPARENT_BACKGROUND_DESC')); ?>"><?php echo JText::_('THEME_FLIP_TRANSPARENT_BACKGROUND_TITLE');?></label>
                                    <div class="controls">
                                        <?php echo $lists['containerTransparentBackgroundRight']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div id="themeflip-image-tab" class="jsn-bootstrap">
					<div class="form-horizontal">
						<div class="row-fluid show-flip">
							<div class="span12">

								<div class="control-group">
									<label class="control-label hasTip"
										title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_LAYOUT_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_LAYOUT_DESC')); ?>"><?php echo JText::_('THEME_FLIP_LAYOUT_TITLE');?>
									</label>
									<div class="controls">
									<?php echo $lists['imgLayout']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="themeflip-caption-tab" class="jsn-bootstrap">
					<div class="form-horizontal">
						<div class="row-fluid show-flip">
							<div class="span12">
								<div class="control-group">
									<label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_SHOW_TITLE_TITLE')?>::<?php echo JText::_('THEME_FLIP_SHOW_TITLE_DESC')?>"><?php echo JText::_('THEME_FLIP_SHOW_TITLE_TITLE') ?></label>
									<div class="controls">
										<?php echo $lists['showTitle'] ?>
									</div>
								</div>
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_APPLY_IMAGE_LINK_TITLE')?>::<?php echo JText::_('THEME_FLIP_APPLY_IMAGE_LINK_DESC')?>"><?php echo JText::_('THEME_FLIP_APPLY_IMAGE_LINK_TITLE') ?></label>
                                    <div class="controls">
                                        <?php echo $lists['applyLink'] ?>
                                    </div>
                                </div>
                                <div id="jsn-open-link-in" class="control-group">
                                    <label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_OPEN_LINK_IN_TITLE');?>::<?php echo JText::_('THEME_FLIP_OPEN_LINK_IN_DESC'); ?>"><?php echo JText::_('THEME_FLIP_OPEN_LINK_IN_TITLE');?></label>
                                    <div class="controls">
                                        <?php echo $lists['openLinkIn']; ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label hasTip"
                                           title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_TITLE_CSS_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_TITLE_CSS_DESC')); ?>"><?php echo JText::_('THEME_FLIP_TITLE_CSS_TITLE'); ?>
                                    </label>
                                    <div class="controls">
                                        <textarea class="input-xlarge captionPanel" name="title_css" rows="3"><?php echo (!empty($items->title_css))?$items->title_css:''; ?></textarea>
                                    </div>
                                </div>
                                <hr/>
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_CAPTION_SHOW_DESCRIPTION_TITLE');?>::<?php echo JText::_('THEME_FLIP_CAPTION_SHOW_DESCRIPTION_DESC'); ?>"><?php echo JText::_('THEME_FLIP_CAPTION_SHOW_DESCRIPTION_TITLE');?></label>
                                    <div class="controls">
                                        <?php echo $lists['captionShowDescription'] ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_DESCRIPTION_LIMIT_TITLE');?>::<?php echo JText::_('THEME_FLIP_DESCRIPTION_LIMIT_DESC'); ?>"><?php echo JText::_('THEME_FLIP_DESCRIPTION_LIMIT_TITLE');?></label>
                                    <div class="controls">
                                        <input type="number"
                                               min="1"
                                               value="<?php echo (!empty($items->description_limit))?$items->description_limit:'20'; ?>"
                                               name="description_limit"
                                               id="description_limit" class="input-mini captionPanel" /> <?php echo JText::_('THEME_FLIP_WORDS');?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label hasTip"
                                           title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_DESCRIPTION_CSS_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_DESCRIPTION_CSS_DESC')); ?>"><?php echo JText::_('THEME_FLIP_DESCRIPTION_CSS_TITLE'); ?>
                                    </label>
                                    <div class="controls">
                                        <textarea class="input-xlarge captionPanel" name="description_css" rows="3"><?php echo (!empty($items->description_css))?$items->description_css:''; ?></textarea>
                                    </div>
                                </div>
                                <hr/>
                                <div class="control-group">
                                    <label class="control-label hasTip"
                                           title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_CAPTION_CSS_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_CAPTION_CSS_DESC')); ?>"><?php echo JText::_('THEME_FLIP_CAPTION_CSS_TITLE'); ?>
                                    </label>
                                    <div class="controls">
                                        <textarea class="input-xlarge captionPanel" name="caption_css" rows="3"><?php echo (!empty($items->caption_css))?$items->caption_css:''; ?></textarea>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
				<div id="themeflip-slideshow-tab" class="jsn-bootstrap">
					<div class="form-horizontal">
						<div class="row-fluid show-flip">
							<div class="span12">
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_CLOSED_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_CLOSED_DESC')); ?>"><?php echo JText::_('THEME_FLIP_CLOSED_TITLE');?></label>
                                    <div class="controls">
                                        <?php echo $lists['closed']; ?>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_PAGE_NUMBER_TITLE');?>::<?php echo JText::_('THEME_FLIP_PAGE_NUMBER_DESC'); ?>"><?php echo JText::_('THEME_FLIP_PAGE_NUMBER_TITLE');?></label>
                                    <div class="controls">
                                        <?php echo $lists['showPageNumber']; ?>
                                    </div>
                                </div>
								<div class="control-group">
									<label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_AUTO_PLAY_TITLE');?>::<?php echo JText::_('THEME_FLIP_AUTO_PLAY_DESC'); ?>"><?php echo JText::_('THEME_FLIP_AUTO_PLAY_TITLE');?></label>
									<div class="controls">
										<?php echo $lists['autoPlay']; ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label hasTip" title="<?php echo JText::_('THEME_FLIP_SLIDE_TIMING_TITLE');?>::<?php echo JText::_('THEME_FLIP_SLIDE_TIMING_DESC'); ?>"><?php echo JText::_('THEME_FLIP_SLIDE_TIMING_TITLE');?></label>
									<div class="controls">
										<input type="number" id="slide_timing" name="slide_timing" class="input-mini effect-panel" min="1" value="<?php echo $items->slide_timing; ?>" /> <?php echo JText::_('SECONDS'); ?>
									</div>
								</div>
                                <div class="control-group">
                                    <label class="control-label hasTip"
                                           title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_SPEED_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_SPEED_DESC')); ?>"><?php echo JText::_('THEME_FLIP_SPEED_TITLE');?>
                                    </label>
                                    <div class="controls">
                                        <input type="number"
                                               value="<?php echo (!empty($items->speed))?$items->speed:'500'; ?>"
                                               name="speed"
                                               id="speed" class="input-mini slideshow-panel" min="10"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label hasTip"
                                           title="<?php echo htmlspecialchars(JText::_('THEME_FLIP_PADDING_TITLE'));?>::<?php echo htmlspecialchars(JText::_('THEME_FLIP_PADDING_DESC')); ?>"><?php echo JText::_('THEME_FLIP_PADDING_TITLE');?>
                                    </label>
                                    <div class="controls">
                                        <input type="number"
                                               value="<?php echo (isset($items->padding))?$items->padding:'10'; ?>"
                                               name="padding"
                                               id="padding" class="input-mini captionPanel" /> <?php echo JText::_('THEME_FLIP_PIXEL'); ?>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</td>
		<td id="jsn-theme-preview-wrapper">
			<div>
				<?php include dirname(__FILE__).DS.'preview.php'; ?>
			</div>
		</td>
	</tr>
</table>
<!--  important -->
<input
	type="hidden" name="theme_name"
	value="<?php echo strtolower($this->_showcaseThemeName); ?>" />
<input
	type="hidden" name="theme_id"
	value="<?php echo (int) @$items->theme_id; ?>" />
<!--  important -->
<div style="clear: both;"></div>
