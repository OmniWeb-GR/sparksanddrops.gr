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
	// $vnqs = $this->params->get('vnqs');
	$vnqs = '2';
	$headerclass='';
	if ($this->params->get('sticky-header') == 1) {
		if ($this->params->get('responsive-sticky-header') == 1) {
			$headerclass = 'sticky-top';
		}
		elseif ($this->params->get('responsive-sticky-header') == 2) {
			$headerclass = 'sticky-sm-top';
		}
		elseif ($this->params->get('responsive-sticky-header') == 3) {
			$headerclass = 'sticky-md-top';
		}
		elseif ($this->params->get('responsive-sticky-header') == 4) {
			$headerclass = 'sticky-lg-top';
		}
		elseif ($this->params->get('responsive-sticky-header') == 5) {
			$headerclass = 'sticky-xl-top';
		}
	}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang[0]; ?>" dir="<?php echo $this->direction; ?>">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <jdoc:include type="metas"/>
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css?v=<?php echo $vnqs; ?>">
    </head>
    <body class="bg-primary text-light <?php echo $option . ' ' . $view . ($layout ? ' layout-' . $layout : ' no-layout') . ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') . ($pageclass ? ' ' . $pageclass : '') . ($this->direction == 'rtl' ? ' rtl' : ''); ?>">
		<?php if ($this->countModules('header')): ?>
			<header class="header <?php echo $headerclass; ?>">
                <div class="<?php echo $this->params->get('container-class'); ?>">
                    <div class="row">
                        <jdoc:include type="modules" name="header" style="html5"/>
                    </div>
                </div>
            </header>
		<?php endif; ?>
        <?php if ($this->countModules('below-header')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
                <div class="row">
                    <jdoc:include type="modules" name="below-header" style="html5"/>
                </div>
            </div>
		<?php endif; ?>
        <?php if (($this->countModules('left-sidebar')) && ($this->countModules('right-sidebar'))): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<div class="row">
					<aside class="col-auto">
						<jdoc:include type="modules" name="left-sidebar" style="html5"/>
					</aside>
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="html5"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="html5"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="html5"/>
					</div>
					<aside class="col-auto">
						<jdoc:include type="modules" name="right-sidebar" style="html5"/>
					</aside>
				</div>
			</div>
		<?php elseif ($this->countModules('left-sidebar')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<div class="row">
					<aside class="col-auto">
						<jdoc:include type="modules" name="left-sidebar" style="html5"/>
					</aside>
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="html5"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="html5"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="html5"/>
					</div>
				</div>
			</div>
		<?php elseif ($this->countModules('right-sidebar')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<div class="row">
					<div class="col">
						<jdoc:include type="modules" name="above-main" style="html5"/>
						<main>
							<?php if ($this->countModules('content')): ?>
								<jdoc:include type="modules" name="content" style="html5"/>
							<?php else: ?>
								<jdoc:include type="component"/>
							<?php endif; ?>
						</main>
						<jdoc:include type="modules" name="below-main" style="html5"/>
					</div>
					<aside class="col-auto">
						<jdoc:include type="modules" name="right-sidebar" style="html5"/>
					</aside>
				</div>
			</div>
        <?php else: ?>
			<jdoc:include type="modules" name="above-main" style="html5"/>
			<div class="<?php echo $this->params->get('container-class'); ?>">
				<main>
					<?php if ($this->countModules('content')): ?>
						<jdoc:include type="modules" name="content" style="html5"/>
					<?php else: ?>
						<jdoc:include type="component"/>
					<?php endif; ?>
				</main>
			</div>
			<jdoc:include type="modules" name="below-main" style="html5"/>
        <?php endif; ?>
        <?php if ($this->countModules('above-footer')): ?>
			<div class="<?php echo $this->params->get('container-class'); ?>">
                <div class="row">
                    <jdoc:include type="modules" name="above-footer" style="html5"/>
                </div>
            </div>
		<?php endif; ?>
        <?php if ($this->countModules('footer')): ?>
			<footer class="footer">
                <div class="<?php echo $this->params->get('container-class'); ?>">
                    <div class="row">
                        <jdoc:include type="modules" name="footer" style="html5"/>
                    </div>
                </div>
            </footer>
		<?php endif; ?>
		<div class="fixed-bottom d-md-none">
			<jdoc:include type="modules" name="mobile-menu" style="html5"/>
		</div>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/popper.min.js"></script>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
		<?php if ($pageclass == 'home'): ?>
			<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/instafeed.min.js?v=<?php echo $vnqs; ?>"></script>
		<?php endif; ?>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/template.js?v=<?php echo $vnqs; ?>"></script>
    </body>
</html>