<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

?>
<div class="com-users-logout logout">
	<?php // if ($this->params->get('show_page_heading')) : ?>
	<!-- <div class="page-header">
		<h1>
			<?php // echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	</div> -->
	<?php // endif; ?>

	<?php if (($this->params->get('logoutdescription_show') == 1 && str_replace(' ', '', $this->params->get('logout_description')) != '')|| $this->params->get('logout_image') != '') : ?>
		<div class="com-users-logout__description logout-description">
	<?php endif; ?>

	<?php if ($this->params->get('logoutdescription_show') == 1) : ?>
		<?php echo $this->params->get('logout_description'); ?>
	<?php endif; ?>

	<?php if ($this->params->get('logout_image') != '') : ?>
		<?php $alt = empty($this->params->get('logout_image_alt')) && empty($this->params->get('logout_image_alt_empty'))
			? ''
			: 'alt="' . htmlspecialchars($this->params->get('logout_image_alt'), ENT_COMPAT, 'UTF-8') . '"'; ?>
		<img src="<?php echo $this->escape($this->params->get('logout_image')); ?>" class="com-users-logout__image thumbnail float-end logout-image" <?php echo $alt; ?>>
	<?php endif; ?>

	<?php if (($this->params->get('logoutdescription_show') == 1 && str_replace(' ', '', $this->params->get('logout_description')) != '')|| $this->params->get('logout_image') != '') : ?>
		</div>
	<?php endif; ?>

	<form action="<?php echo Route::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="com-users-logout__form form-horizontal well">
		<div class="com-users-logout__submit text-center">
			<button type="submit" class="btn btn-light">
				<!-- <span class="icon-backward-2 icon-white" aria-hidden="true"></span> -->
				<?php echo Text::_('JLOGOUT'); ?>
			</button>
		</div>
		<?php if ($this->params->get('logout_redirect_url')) : ?>
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_url', $this->form->getValue('return'))); ?>">
		<?php else : ?>
			<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('logout_redirect_menuitem', $this->form->getValue('return'))); ?>">
		<?php endif; ?>
		<?php echo HTMLHelper::_('form.token'); ?>
	</form>
</div>
