<div class="tipoVeiculos view">
<h2><?php echo __('Tipo Veiculo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tipoVeiculo['TipoVeiculo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($tipoVeiculo['TipoVeiculo']['nome']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipo Veiculo'), array('action' => 'edit', $tipoVeiculo['TipoVeiculo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tipo Veiculo'), array('action' => 'delete', $tipoVeiculo['TipoVeiculo']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $tipoVeiculo['TipoVeiculo']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Veiculos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Veiculo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
