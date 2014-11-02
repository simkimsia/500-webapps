<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Bookmark'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('All Bookmarks'), ['action' => 'index']) ?></li>
		<?php if (!empty($authUser)) : ?>
		<li><?= $this->Html->link(__('My Bookmarks'), ['action' => 'mine']) ?></li>
		<?php endif; ?>		
		<?php if ($authUser['role'] == 'admin') : ?>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<?php endif; ?>
	</ul>
</div>
<div class="bookmarks view large-10 medium-9 columns">
	<h2><?= h($bookmark->title) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('User') ?></h6>
			<p><?= $bookmark->has('user') ? $this->Html->link($bookmark->user->username, ['controller' => 'Users', 'action' => 'view', $bookmark->user->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Title') ?></h6>
			<p><?= h($bookmark->title) ?></p>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Description') ?></h6>
			<?= $this->Text->autoParagraph(h($bookmark->description)); ?>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Url') ?></h6>
			<?= $this->Html->link($bookmark->url, $bookmark->url, ['target' => '_blank']); ?>
		</div>
	</div>
	<div class="row texts">
		<div class="columns large-9">
			<h6 class="subheader"><?= __('Tags') ?></h6>
			<?php foreach ($bookmark->tags as $tag): ?>
				<?= $this->Html->link(__($tag->title), ['controller' => 'Bookmarks', 'action' => 'tags', $tag->title]) ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>