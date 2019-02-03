<?php 
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow - Theme Classic
 * @version $Id: default_folder.php 6411 2011-05-27 07:09:16Z trungnq $
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die('Restricted access'); 
$act = JRequest::getCmd('act','custom');
?>
<div class="item">
	<a href="index.php?option=com_imageshow&amp;controller=media&amp;view=imageslist&amp;act=<?php echo $act;?>&amp;tmpl=component&amp;event=loadMediaImagesList&amp;theme=<?php echo $this->_showcaseThemeName; ?>&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>">
		<img src="<?php echo dirname(JURI::base()); ?>/media/media/images/folder.gif" width="80" height="80" alt="<?php echo $this->_tmp_folder->name; ?>" />
		<span><?php echo $this->_tmp_folder->name; ?></span></a>
</div>
