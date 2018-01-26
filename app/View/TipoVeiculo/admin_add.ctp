<div class="tipoVeiculos form">
<?php echo $this->Form->create('TipoVeiculo'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Tipo Veiculo'); ?></legend>
	<?php
		echo $this->Form->input('nome');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tipo Veiculos'), array('action' => 'index')); ?></li>
	</ul>
</div>
