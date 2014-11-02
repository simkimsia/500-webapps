<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New Bookmark'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('All Bookmarks'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('My Bookmarks'), ['controller' => 'Bookmarks', 'action' => 'mine'], ['class' => 'disabled']) ?></li>
		<?php if ($authUser['role'] == 'admin') : ?>
		<li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
		<?php endif; ?>
	</ul>
</div>
<div class="bookmarks index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('user_id') ?></th>
			<th><?= $this->Paginator->sort('title') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($bookmarks as $bookmark): ?>
		<tr>
			<td>
				<?= $this->Html->link($authUser['username'], ['controller' => 'Users', 'action' => 'view', $authUser['id']]) ?>
			</td>
			<td><?= h($bookmark->title) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $bookmark->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $bookmark->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bookmark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookmark->id)]); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
