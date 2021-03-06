<?php
/**
 * @version     $Id$
 * @package     JSN_Mobilize
 * @subpackage  SystemPlugin
 * @author      JoomlaShine Team <support@joomlashine.com>
 * @copyright   Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license     GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */
// no direct access
defined('_JEXEC') or die;

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2UserBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
<?php if($userGreetingText): ?>
<p class="ubGreeting"><?php echo $userGreetingText; ?></p>
<?php endif; ?>
<div class="k2UserBlockDetails">
	<?php if($params->get('userAvatar')): ?>
	<a class="k2Avatar ubAvatar" href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id)); ?>" title="<?php echo JText::_('K2_MY_PAGE'); ?>"> <img src="<?php echo K2HelperUtilities::getAvatar($user->id, $user->email); ?>" alt="<?php echo K2HelperUtilities::cleanHtml($user->name); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" /> </a>
	<?php endif; ?>
	<span class="ubName"><?php echo $user->name; ?></span> <span class="ubCommentsCount"><?php echo JText::_('K2_YOU_HAVE'); ?> <b><?php echo $user->numOfComments; ?></b>
	<?php if($user->numOfComments==1) echo JText::_('K2_PUBLISHED_COMMENT'); else echo JText::_('K2_PUBLISHED_COMMENTS'); ?>
	</span>
	<div class="clr"></div>
</div>
<ul class="k2UserBlockActions">
	<?php if(is_object($user->profile) && isset($user->profile->addLink)): ?>
	<li> <a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $user->profile->addLink; ?>"><?php echo JText::_('K2_ADD_NEW_ITEM'); ?></a> </li>
	<?php endif; ?>
	<li> <a href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id)); ?>"><?php echo JText::_('K2_MY_PAGE'); ?></a> </li>
	<li> <a href="<?php echo $profileLink; ?>"><?php echo JText::_('K2_MY_ACCOUNT'); ?></a> </li>
	<li> <a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&tmpl=component'); ?>"><?php echo JText::_('K2_MODERATE_COMMENTS_TO_MY_PUBLISHED_ITEMS'); ?></a> </li>
</ul>
<form action="<?php echo JURI::root(true); ?>/index.php" method="post">
	<input type="submit" name="Submit" class="button ubLogout" value="<?php echo JText::_('K2_LOGOUT'); ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="<?php echo $task; ?>" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
</div>
