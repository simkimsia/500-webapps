<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Bookmark'), ['action' => 'add'], ['class' => 'disabled']) ?></li>
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
<div class="bookmarks form large-10 medium-9 columns">
<?= $this->Form->create($bookmark) ?>
	<fieldset>
		<legend><?= __('Add Bookmark') ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('url');
		echo $this->Form->input('public', ['checked']);
		echo $this->Form->input('tag_string', ['type' => 'text']);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
