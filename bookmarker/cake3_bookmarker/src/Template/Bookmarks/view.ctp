<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit Bookmark'), ['action' => 'edit', $bookmark->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete Bookmark'), ['action' => 'delete', $bookmark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmark->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Bookmarks'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Bookmark'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List BookmarksTags'), ['controller' => 'BookmarksTags', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Bookmarks Tag'), ['controller' => 'BookmarksTags', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="bookmarks view large-10 medium-9 columns">
	<h2><?= h($bookmark->title) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('User') ?></h6>
			<p><?= $bookmark->has('user') ? $this->Html->link($bookmark->user->id, ['controller' => 'Users', 'action' => 'view', $bookmark->user->id]) : '' ?></p>
			<h6 class="subheader"><?= __('Title') ?></h6>
			<p><?= h($bookmark->title) ?></p>
		</div>
		<div class="large-2 large-offset-1 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($bookmark->id) ?></p>
		</div>
		<div class="large-2 columns dates end">
			<h6 class="subheader"><?= __('Created') ?></h6>
			<p><?= h($bookmark->created) ?></p>
			<h6 class="subheader"><?= __('Updated') ?></h6>
			<p><?= h($bookmark->updated) ?></p>
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
			<?= $this->Text->autoParagraph(h($bookmark->url)); ?>
		</div>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related BookmarksTags') ?></h4>
	<?php if (!empty($bookmark->bookmarks_tags)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Bookmark Id') ?></th>
			<th><?= __('Tag Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($bookmark->bookmarks_tags as $bookmarksTags): ?>
		<tr>
			<td><?= h($bookmarksTags->bookmark_id) ?></td>
			<td><?= h($bookmarksTags->tag_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'BookmarksTags', 'action' => 'view', $bookmarksTags->bookmark_id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'BookmarksTags', 'action' => 'edit', $bookmarksTags->bookmark_id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'BookmarksTags', 'action' => 'delete', $bookmarksTags->bookmark_id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmarksTags->bookmark_id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
<div class="related row">
	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Tags') ?></h4>
	<?php if (!empty($bookmark->tags)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Title') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Updated') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($bookmark->tags as $tags): ?>
		<tr>
			<td><?= h($tags->id) ?></td>
			<td><?= h($tags->title) ?></td>
			<td><?= h($tags->created) ?></td>
			<td><?= h($tags->updated) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
