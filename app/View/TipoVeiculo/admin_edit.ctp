<div class="tipoVeiculoss form">
<?php echo $this->Form->create('TipoVeiculos'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit Tipo Veiculos'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TipoVeiculos.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('TipoVeiculos.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Veiculoss'), array('action' => 'index')); ?></li>
	</ul>
</div>
