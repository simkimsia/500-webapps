<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Bookmarks'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List My Bookmarks'), ['action' => 'index']) ?></li>
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
		echo $this->Form->input('tag_string', ['type' => 'text']);
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>