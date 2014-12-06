<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?></li>
		<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="cities index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('name') ?></th>
			<th><?= $this->Paginator->sort('country_id') ?></th>
			<th><?= $this->Paginator->sort('district') ?></th>
			<th><?= $this->Paginator->sort('population') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($cities as $city): ?>
		<tr>
			<td><?= $this->Number->format($city->id) ?></td>
			<td><?= h($city->name) ?></td>
			<td>
				<?= $city->has('country') ? $this->Html->link($city->country->name, ['controller' => 'Countries', 'action' => 'view', $city->country->id]) : '' ?>
			</td>
			<td><?= h($city->district) ?></td>
			<td><?= $this->Number->format($city->population) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $city->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $city->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?>
			</td>
		</tr>

	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')); ?>
			<?= $this->Paginator->numbers(); ?>
			<?=	$this->Paginator->next(__('next') . ' >'); ?>
		</ul>
		<p><?= $this->Paginator->counter(); ?></p>
	</div>
</div>
