<?php
    defined('_JEXEC') or die;
    use Joomla\CMS\Factory;
    $app = Factory::getApplication();
    $option = $app->input->getCmd('option', '');
    $view = $app->input->getCmd('view', '');
    $layout = $app->input->getCmd('layout', '');
    $task = $app->input->getCmd('task', '');
    $itemid = $app->input->getCmd('Itemid', '');
    $sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
    $menu = $app->getMenu()->getActive();
    $pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
	$lang = explode('-', $this->language);
	$headerclass='';
	if ($this->params->get('sticky-header') == 1) {
		$headerclass = 'sticky-top';
	}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang[0]; ?>" dir="<?php echo $this->direction; ?>">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <jdoc:include type="metas"/>
    </head>
    <body class="<?php echo $option . ' ' . $view . ($layout ? ' layout-' . $layout : ' no-layout') . ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') . ($pageclass ? ' ' . $pageclass : '') . ($this->direction == 'rtl' ? ' rtl' : ''); ?>">
		<?php if ($this->countModules('header')): ?>
			<header class="header <?php echo $headerclass; ?>">
                <div class="<?php echo $this->params->get('container-class'); ?>">
                    <div class="row">
                        <jdoc:include type="modules" name="header" style="none"/>
                    </div>
                </div>
            </header>
		<?php endif; ?>
        <?php if ($this->countModules('below-header')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
                <div class="row">
                    <jdoc:include type="modules" name="below-header" style="none"/>
                </div>
            </div>
		<?php endif; ?>
        <?php if (($this->countModules('left-sidebar')) && ($this->countModules('right-sidebar'))): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<div class="row">
					<aside class="col-auto">
						<jdoc:include type="modules" name="left-sidebar" style="none"/>
					</aside>
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="none"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="none"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="none"/>
					</div>
					<aside class="col-auto">
						<jdoc:include type="modules" name="right-sidebar" style="none"/>
					</aside>
				</div>
			</div>
		<?php elseif ($this->countModules('left-sidebar')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<div class="row">
					<aside class="col-auto">
						<jdoc:include type="modules" name="left-sidebar" style="none"/>
					</aside>
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="none"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="none"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="none"/>
					</div>
				</div>
			</div>
		<?php elseif ($this->countModules('right-sidebar')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<div class="row">
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="none"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="none"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="none"/>
					</div>
					<aside class="col-auto">
						<jdoc:include type="modules" name="right-sidebar" style="none"/>
					</aside>
				</div>
			</div>
        <?php else: ?>
			<jdoc:include type="modules" name="above-main" style="none"/>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<main>
					<?php if ($this->countModules('content')): ?>
						<jdoc:include type="modules" name="content" style="none"/>
					<?php else: ?>
						<jdoc:include type="component"/>
					<?php endif; ?>
				</main>
			</div>
			<jdoc:include type="modules" name="below-main" style="none"/>
        <?php endif; ?>
        <?php if ($this->countModules('above-footer')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
                <div class="row">
                    <jdoc:include type="modules" name="above-footer" style="none"/>
                </div>
            </div>
		<?php endif; ?>
        <?php if ($this->countModules('footer')): ?>
			<footer class="footer">
                <div class="<?php echo $this->params->get('container-class'); ?>">
                    <div class="row">
                        <jdoc:include type="modules" name="footer" style="none"/>
                    </div>
                </div>
            </footer>
		<?php endif; ?>
    </body>
</html>