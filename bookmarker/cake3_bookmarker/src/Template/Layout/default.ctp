<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$websiteDescription = 'Bookmarker: a way to save your favorite websites';
?>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $websiteDescription ?>:
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('base.css') ?>
	<?= $this->Html->css('cake.css') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
	<header>
		<div class="header-title">
			<span><?= $this->fetch('title') ?></span>
		</div>
		<div class="header-help">
			<span><a target="_blank" href="https://github.com/simkimsia/500-webapps/tree/master/bookmarker/cake3_bookmarker">Code</a></span>
			<?php if (!empty($authUser)) : ?>
			<span><?= $authUser['username'] ?></span>
			<span><a href="/users/logout">Logout</a></span>
			<?php endif; ?>
		</div>
	</header>
	<div id="container">
		
		<div id="content">
			<?= $this->Flash->render() ?>
			<?= $this->Flash->render('auth') ?>

			<div class="row">
				<?= $this->fetch('content') ?>
			</div>
		</div>
		<footer>
		</footer>
	</div>
</body>
</html>
