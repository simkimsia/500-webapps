<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="cities view large-10 medium-9 columns">
	<h2><?= h($city->name) ?></h2>
	<div class="row">
		<div class="large-5 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p><?= h($city->name) ?></p>
			<h6 class="subheader"><?= __('Country') ?></h6>
			<p><?= $city->has('country') ? $this->Html->link($city->country->name, ['controller' => 'Countries', 'action' => 'view', $city->country->id]) : '' ?></p>
			<h6 class="subheader"><?= __('District') ?></h6>
			<p><?= h($city->district) ?></p>
		</div>
		<div class="large-2 columns numbers end">
			<h6 class="subheader"><?= __('Id') ?></h6>
			<p><?= $this->Number->format($city->id) ?></p>
			<h6 class="subheader"><?= __('Population') ?></h6>
			<p><?= $this->Number->format($city->population) ?></p>
		</div>
	</div>
</div>
