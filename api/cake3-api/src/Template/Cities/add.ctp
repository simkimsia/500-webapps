<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="cities form large-10 medium-9 columns">
	<?= $this->Form->create($city); ?>
	<fieldset>
		<legend><?= __('Add City') ?></legend>
		<?php
			echo $this->Form->input('name');
			echo $this->Form->input('country_id', ['options' => $countries]);
			echo $this->Form->input('district');
			echo $this->Form->input('population');
		?>
	</fieldset>
	<?= $this->Form->button(__('Submit')) ?>
	<?= $this->Form->end() ?>
</div>
